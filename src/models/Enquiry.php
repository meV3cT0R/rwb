<?php
class Enquiry {
    private ?int $id = null;
    private ?string $enquiry = null;
    private ?User $createdBy = null;
    private ?Property $enquiryFor = null;

    private ?Comment $comment = null;

    private ?DateTime $createdAt = null;


    public function __construct(
        ?int $id = null,
        ?string $enquiry = null,
        ?User $createdBy = null,
        ?Property $enquiryFor = null,
        ?DateTime $createdAt = null
    ) {
        $this->id = $id;
        $this->enquiry = $enquiry;
        $this->createdBy = $createdBy;
        $this->enquiryFor = $enquiryFor;
        $this->createdAt = $createdAt;
    }
    
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

    public function getComment(): ?Comment {
        return $this->comment;
    }

    public function setComment(?Comment $comment): void {
        $this->comment = $comment;
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
