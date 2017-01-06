<?php
	namespace DaybreakStudios\MailgunHttpClient\Message;

	interface AddressInterface {
		/**
		 * Returns the address part (username@domain) of the email address.
		 *
		 * @return string
		 */
		public function getAddress();

		/**
		 * @return string
		 */
		public function getDomainPart();

		/**
		 * @return string
		 */
		public function getLocalPart();

		/**
		 * Returns the name part of the email address, or null if one does not exist.
		 *
		 * @return string|null
		 */
		public function getName();

		/**
		 * Returns the full email address, with address and name parts combined.
		 *
		 * @return string
		 */
		public function getFullAddress();
	}