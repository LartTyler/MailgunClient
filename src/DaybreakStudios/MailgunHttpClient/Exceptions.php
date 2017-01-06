<?php
	namespace DaybreakStudios\MailgunHttpClient;

	class Exceptions {
		/**
		 * @param string $field
		 *
		 * @return \InvalidArgumentException
		 */
		public static function mustNotBeEmpty($field) {
			return new \InvalidArgumentException(sprintf('$%s must not be empty', $field));
		}

		/**
		 * @return \InvalidArgumentException
		 */
		public static function missingRequiredMessageFields() {
			return new \InvalidArgumentException('A message must have at least a from and to address set');
		}
	}