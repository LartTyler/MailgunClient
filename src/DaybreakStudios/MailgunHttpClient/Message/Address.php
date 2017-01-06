<?php
	namespace DaybreakStudios\MailgunHttpClient\Message;

	use DaybreakStudios\MailgunHttpClient\Exceptions;

	class Address implements AddressInterface {
		/**
		 * @var string
		 */
		private $address;

		/**
		 * @var string|null
		 */
		private $name;

		/**
		 * @var string
		 */
		private $domainPart;

		/**
		 * @var string
		 */
		private $localPart;

		/**
		 * Address constructor.
		 *
		 * @param string     $address
		 * @param string|null $name
		 */
		public function __construct($address, $name = null) {
			$this->address = trim($address) ?: null;

			if (!$this->address)
				throw Exceptions::mustNotBeEmpty('address');

			$this->name = trim($name) ?: null;

			$this->localPart = strtok($this->address, '@');
			$this->domainPart = strtok('');
		}

		/**
		 * {@inheritdoc}
		 */
		public function getAddress() {
			return $this->address;
		}

		/**
		 * {@inheritdoc}
		 */
		public function getDomainPart() {
			return $this->domainPart;
		}

		/**
		 * {@inheritdoc}
		 */
		public function getLocalPart() {
			return $this->localPart;
		}

		/**
		 * {@inheritdoc}
		 */
		public function getName() {
			return $this->name;
		}

		/**
		 * {@inheritdoc}
		 */
		public function getFullAddress() {
			$addr = $this->getAddress();

			if ($name = $this->getName())
				$addr = sprintf('%s <%s>', $name, $addr);

			return $addr;
		}
	}