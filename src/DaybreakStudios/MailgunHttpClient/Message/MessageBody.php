<?php
	namespace DaybreakStudios\MailgunHttpClient\Message;

	class MessageBody implements MessageBodyInterface {
		/**
		 * @var string
		 */
		private $type;

		/**
		 * @var string
		 */
		private $content;

		/**
		 * MessageBody constructor.
		 *
		 * @param string $type
		 * @param string $content
		 */
		public function __construct($type, $content) {
			$this->type = $type;
			$this->content = $content;
		}

		/**
		 * {@inheritdoc}
		 */
		public function getContent() {
			return $this->content;
		}

		/**
		 * {@inheritdoc}
		 */
		public function setContent($content) {
			$this->content = $content;

			return $this;
		}

		/**
		 * {@inheritdoc}
		 */
		public function getType() {
			return $this->type;
		}

		/**
		 * {@inheritdoc}
		 */
		public function setType($type) {
			$this->type = $type;

			return $this;
		}
	}