<?php
	namespace DaybreakStudios\MailgunHttpClient\Message;

	interface MessageInterface {
		/**
		 * @param string      $address
		 * @param string|null $name
		 *
		 * @return $this
		 */
		public function setFrom($address, $name = null);

		/**
		 * @return AddressInterface|null
		 */
		public function getFrom();

		/**
		 * @param string[] $addresses an array of email addresses; for addresses with names, a non-integer key may be
		 *                            used (i.e. {"Tyler Lartonoix": "tyler@localhost"})
		 *
		 * @return $this
		 */
		public function setTo(array $addresses);

		/**
		 * @param string      $address
		 * @param string|null $name
		 *
		 * @return $this
		 */
		public function addTo($address, $name = null);

		/**
		 * @return AddressInterface[]
		 */
		public function getTo();

		/**
		 * @param string[] $addresses an array of email addresses; for addresses with names, a non-integer key may be
		 *                            used (i.e. {"Tyler Lartonoix": "tyler@localhost"})
		 *
		 * @return $this
		 */
		public function setCarbonCopy(array $addresses);

		/**
		 * @param string      $address
		 * @param string|null $name
		 *
		 * @return $this
		 */
		public function addCarbonCopy($address, $name = null);

		/**
		 * @return AddressInterface[]
		 */
		public function getCarbonCopy();

		/**
		 * @param string[] $addresses an array of email addresses; for addresses with names, a non-integer key may be
		 *                            used (i.e. {"Tyler Lartonoix": "tyler@localhost"})
		 *
		 * @return mixed
		 */
		public function setBlindCarbonCopy(array $addresses);

		/**
		 * @param string      $address
		 * @param string|null $name
		 *
		 * @return $this
		 */
		public function addBlindCarbonCopy($address, $name = null);

		/**
		 * @return AddressInterface[]
		 */
		public function getBlindCarbonCopy();

		/**
		 * @param string $subject
		 *
		 * @return $this
		 */
		public function setSubject($subject);

		/**
		 * @return string|null
		 */
		public function getSubject();

		/**
		 * @param string      $content
		 * @param string|null $type one of the BodyTypes class constants, or null to default to TEXT
		 *
		 * @return $this
		 *
		 * @see BodyTypes
		 */
		public function setBody($content, $type = null);

		/**
		 * @return MessageBodyInterface
		 */
		public function getBody();
	}