<?php
	namespace DaybreakStudios\MailgunHttpClient;

	use DaybreakStudios\MailgunHttpClient\Message\AddressInterface;
	use DaybreakStudios\MailgunHttpClient\Message\MessageInterface;
	use Mailgun\Mailgun;
	use Mailgun\Messages\Exceptions\MissingRequiredMIMEParameters;
	use Psr\Log\LoggerInterface;

	class MailgunClient implements MailgunClientInterface {
		/**
		 * @var Mailgun
		 */
		private $client;

		/**
		 * @var LoggerInterface|null
		 */
		private $logger;

		/**
		 * MailgunClient constructor.
		 *
		 * @param Mailgun                     $client
		 * @param LoggerInterface             $logger
		 */
		public function __construct(Mailgun $client, LoggerInterface $logger = null) {
			$this->client = $client;
			$this->logger = $logger;
		}

		/**
		 * {@inheritdoc}
		 */
		public function send(MessageInterface $message) {
			if (!$message->getFrom() || !$message->getTo())
				throw Exceptions::missingRequiredMessageFields();

			$params = [
				'from' => $message->getFrom()->getFullAddress(),
				'to' => $this->joinAddresses($message->getTo()),
			];

			if ($cc = $message->getCarbonCopy())
				$params['cc'] = $this->joinAddresses($cc);

			if ($bcc = $message->getBlindCarbonCopy())
				$params['bcc'] = $this->joinAddresses($bcc);

			if ($subject = $message->getSubject())
				$params['subject'] = $subject;

			if ($body = $message->getBody())
				$params[$body->getType()] = $body->getContent();

			try {
				$this->client->sendMessage($message->getFrom()->getDomainPart(), $params);
			} catch (MissingRequiredMIMEParameters $e) {
				if ($this->logger)
					$this->logger->error($e, [
						'message' => $message,
					]);

				return false;
			} catch (\Exception $e) {
				if ($this->logger)
					$this->logger->error($e->getMessage());

				return false;
			}

			return true;
		}

		/**
		 * @param AddressInterface[] $addresses
		 * @param string             $glue
		 *
		 * @return string
		 */
		protected function joinAddresses(array $addresses, $glue = ', ') {
			return implode($glue, array_map(function(AddressInterface $address) {
				return $address->getFullAddress();
			}, $addresses));
		}
	}