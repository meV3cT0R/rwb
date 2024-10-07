<?php
class ResDTO
{
    private ?string $message = null;
    private $data = null;
    private ?ErrorDTO $errorDTO = null;

    public function __construct(?string $message = null, $data = null, ?ErrorDTO $errorDTO = null)
    {
        $this->data = $data;
        $this->message = $message;
        $this->errorDTO = $errorDTO;
    }

    public function getData(): mixed
    {
        return $this->data;
    }
    public function getMessage(): string
    {
        return $this->message;
    }
    public function getErrorDTO(): ?ErrorDTO
    {
        return $this->errorDTO;
    }

    public function setData($data): void
    {
        $this->data = $data;
    }
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }
    public function setErrorDTO(?ErrorDTO $errorDTO): void
    {
        $this->errorDTO = $errorDTO;
    }
}

