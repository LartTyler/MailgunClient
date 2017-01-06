<?php
	namespace DaybreakStudios\MailgunHttpClient\Message;

	interface MessageBodyInterface {
		/**
		 * @param string $type one of the BodyTypes class constants
		 *
		 * @return $this
		 * @see BodyTypes
		 */
		public function setType($type);

		/**
		 * @return string one of the BodyTypes class constants
		 * @see BodyTypes
		 */
		public function getType();

		/**
		 * @param string $content
		 *
		 * @return $this
		 */
		public function setContent($content);

		/**
		 * @return string
		 */
		public function getContent();
	}