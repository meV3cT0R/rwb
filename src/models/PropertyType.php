<?php
class PropertyType {
    private ?int $id = null;
    private ?string $name = null;
    private ?User $createdBy = null;
    private ?DateTime $createdAt = null;

    public function __construct(
        ?int $id = null,
        ?string $name = null,
        ?User $createdBy = null,
        ?DateTime $createdAt = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->createdBy = $createdBy;
        $this->createdAt = $createdAt;
    }
    

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(?string $name): void {
        $this->name = $name;
    }

    public function getCreatedBy(): ?User {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): void {
        $this->createdBy = $createdBy;
    }

    public function getCreatedAt(): ?DateTime {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTime $createdAt): void {
        $this->createdAt = $createdAt;
    }
}
