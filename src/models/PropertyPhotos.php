<?php
class PropertyPhotos {
    private ?int $id = null;
    private ?string $url = null;
    private ?Property $property = null;
    private ?DateTime $createdAt = null;

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function getUrl(): ?string {
        return $this->url;
    }

    public function setUrl(?string $url): void {
        $this->url = $url;
    }

    public function getProperty(): ?Property {
        return $this->property;
    }

    public function setProperty(?Property $property): void {
        $this->property = $property;
    }

    public function getCreatedAt(): ?DateTime {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTime $createdAt): void {
        $this->createdAt = $createdAt;
    }
}
