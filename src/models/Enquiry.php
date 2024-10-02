<?php
class Enquiry {
    private ?int $id = null;
    private ?string $enquiry = null;
    private ?User $createdBy = null;
    private ?Property $enquiryFor = null;
    private ?DateTime $createdAt = null;

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function getEnquiry(): ?string {
        return $this->enquiry;
    }

    public function setEnquiry(?string $enquiry): void {
        $this->enquiry = $enquiry;
    }

    public function getCreatedBy(): ?User {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): void {
        $this->createdBy = $createdBy;
    }

    public function getEnquiryFor(): ?Property {
        return $this->enquiryFor;
    }

    public function setEnquiryFor(?Property $enquiryFor): void {
        $this->enquiryFor = $enquiryFor;
    }

    public function getCreatedAt(): ?DateTime {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTime $createdAt): void {
        $this->createdAt = $createdAt;
    }
}
