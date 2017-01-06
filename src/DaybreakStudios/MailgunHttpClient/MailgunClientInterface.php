<?php
	namespace DaybreakStudios\MailgunHttpClient;

	use DaybreakStudios\MailgunHttpClient\Message\MessageInterface;

	interface MailgunClientInterface {
		/**
		 * @param MessageInterface     $message
		 *
		 * @return bool
		 */
		public function send(MessageInterface $message);
	}