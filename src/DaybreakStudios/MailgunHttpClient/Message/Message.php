<?php
	namespace DaybreakStudios\MailgunHttpClient\Message;

	use DaybreakStudios\MailgunHttpClient\Exceptions;

	class Message implements MessageInterface {
		/**
		 * @var AddressInterface|null
		 */
		private $from = null;

		/**
		 * @var AddressInterface[]
		 */
		private $to = [];

		/**
		 * @var AddressInterface[]
		 */
		private $cc = [];

		/**
		 * @var AddressInterface[]
		 */
		private $bcc = [];

		/**
		 * @var string|null
		 */
		private $subject = null;

		/**
		 * @var MessageBodyInterface|null
		 */
		private $body = null;

		/**
		 * {@inheritdoc}
		 */
		public function setFrom($address, $name = null) {
			$this->from = new Address($address, $name);

			return $this;
		}

		/**
		 * {@inheritdoc}
		 */
		public function getFrom() {
			return $this->from;
		}

		/**
		 * {@inheritdoc}
		 */
		public function setTo(array $addresses) {
			return $this->setAddressList($this->to, [$this, 'addTo'], $addresses);
		}

		/**
		 * {@inheritdoc}
		 */
		public function addTo($address, $name = null) {
			return $this->addToAddressList($this->to, $address, $name);
		}

		/**
		 * {@inheritdoc}
		 */
		public function getTo() {
			return $this->to;
		}

		/**
		 * {@inheritdoc}
		 */
		public function setCarbonCopy(array $addresses) {
			return $this->setAddressList($this->cc, [$this, 'addCarbonCopy'], $addresses);
		}

		/**
		 * {@inheritdoc}
		 */
		public function addCarbonCopy($address, $name = null) {
			return $this->addToAddressList($this->cc, $address, $name);
		}

		/**
		 * {@inheritdoc}
		 */
		public function getCarbonCopy() {
			return $this->cc;
		}

		/**
		 * {@inheritdoc}
		 */
		public function setBlindCarbonCopy(array $addresses) {
			return $this->setAddressList($this->bcc, [$this, 'addBlindCarbonCopy'], $addresses);
		}

		/**
		 * {@inheritdoc}
		 */
		public function addBlindCarbonCopy($address, $name = null) {
			return $this->addToAddressList($this->bcc, $address, $name);
		}

		/**
		 * {@inheritdoc}
		 */
		public function getBlindCarbonCopy() {
			return $this->bcc;
		}

		/**
		 * {@inheritdoc}
		 */
		public function setSubject($subject) {
			$this->subject = $subject;

			return $this;
		}

		/**
		 * {@inheritdoc}
		 */
		public function getSubject() {
			return $this->subject;
		}

		public function setBody($content, $type = null) {
			$this->body = new MessageBody($type ?: BodyTypes::TEXT, $content);

			return $this;
		}

		/**
		 * {@inheritdoc}
		 */
		public function getBody() {
			return $this->body;
		}

		/**
		 * @param array    $list
		 * @param callable $adder
		 * @param array    $addresses
		 *
		 * @return $this
		 */
		protected function setAddressList(array &$list, callable $adder, array $addresses) {
			$list = [];

			foreach ($addresses as $name => $address)
				call_user_func($adder, $address, is_int($name) ? null : $name);

			return $this;
		}

		/**
		 * @param array       $list
		 * @param string      $address
		 * @param string|null $name
		 *
		 * @return $this
		 */
		protected function addToAddressList(array &$list, $address, $name = null) {
			$address = trim($address) ?: null;

			if (!$address)
				throw Exceptions::mustNotBeEmpty('address');

			$list[$address] = new Address($address, $name);

			return $this;
		}

		/**
		 * @return static
		 */
		public static function create() {
			return new static();
		}
	}