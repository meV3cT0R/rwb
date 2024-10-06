<?php
    class ErrorDTO {
        private ?int $code = null;
        private ?string $message = null;

        public function __construct(?int $code,?string $message) {
            $this->code = $code;
            $this->message = $message;
        }

        public function getCode(): ?int {
            return $this->code;
        }

        public function getMessage(): ?string {
            return $this->message;
        }

        public function setCode(?int $code): void {
            $this->code = $code;
        }

        public function setMessage(?string $message): void {
            $this->message = $message;
        }

        public function __toString(): string {
            return sprintf("%d : %s<br/>", $this->code, $this->message);
        }
    }