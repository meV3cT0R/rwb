<?php
   class Property {
    private ?int $id = null;
    private ?PropertyType $propertyType = null;
    private ?string $status = null;
    private ?int $yearBuilt = null;
    private ?User $marketedBy = null;
    private ?string $description = null;
    private ?float $price = null;
    private ?float $totalSqFt = null;
    private ?string $lotSizeUnit = null;
    private ?float $lotSize = null;
    private ?DateTime $createdAt = null;

    private ?string $address = null;
    private ?City $city = null;
    private ?array $propertyPhotos = null;

    private ?array $enquiry = null;

    public function __construct(
        ?int $id = null,
        ?PropertyType $propertyType = null,
        ?string $status = null,
        ?int $yearBuilt = null,
        ?User $marketedBy = null,
        ?string $description = null,
        ?float $price = null,
        ?float $totalSqFt = null,
        ?string $lotSizeUnit = null,
        ?float $lotSize = null,
        ?DateTime $createdAt = null,
        ?array $propertyPhotos= null,
        ?string $address = null,
        ?City $city = null,
    ) {
        $this->id = $id;
        $this->propertyType = $propertyType;
        $this->status = $status;
        $this->yearBuilt = $yearBuilt;
        $this->marketedBy = $marketedBy;
        $this->description = $description;
        $this->price = $price;
        $this->totalSqFt = $totalSqFt;
        $this->lotSizeUnit = $lotSizeUnit;
        $this->lotSize = $lotSize;
        $this->createdAt = $createdAt;
        $this->propertyPhotos = $propertyPhotos;
        $this->address = $address;
        $this->city = $city;
    }
    

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function getPropertyType(): ?PropertyType {
        return $this->propertyType;
    }

    public function setPropertyType(?PropertyType $propertyType): void {
        $this->propertyType = $propertyType;
    }

    public function getStatus(): ?string {
        return $this->status;
    }

    public function setStatus(?string $status): void {
        $this->status = $status;
    }

    public function getYearBuilt(): ?int {
        return $this->yearBuilt;
    }

    public function setYearBuilt(?int $yearBuilt): void {
        $this->yearBuilt = $yearBuilt;
    }

    public function getMarketedBy(): ?User {
        return $this->marketedBy;
    }

    public function setMarketedBy(?User $marketedBy): void {
        $this->marketedBy = $marketedBy;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function setDescription(?string $description): void {
        $this->description = $description;
    }

    public function getPrice(): ?float {
        return $this->price;
    }

    public function setPrice(?float $price): void {
        $this->price = $price;
    }

    public function getTotalSqFt(): ?float {
        return $this->totalSqFt;
    }

    public function setTotalSqFt(?float $totalSqFt): void {
        $this->totalSqFt = $totalSqFt;
    }

    public function getLotSizeUnit(): ?string {
        return $this->lotSizeUnit;
    }

    public function setLotSizeUnit(?string $lotSizeUnit): void {
        $this->lotSizeUnit = $lotSizeUnit;
    }

    public function getLotSize(): ?float {
        return $this->lotSize;
    }

    public function setLotSize(?float $lotSize): void {
        $this->lotSize = $lotSize;
    }

    public function getCreatedAt(): ?DateTime {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTime $createdAt): void {
        $this->createdAt = $createdAt;
    }

    public function getAddress(): ?string {
        return $this->address;
    }

    public function setAddress(?string $address): void {
        $this->address = $address;
    }

    public function getCity(): ?City {
        return $this->city;
    }

    public function setCity(?City $city): void {
        $this->city = $city;
    }
    public function getPropertyPhotos(): ?array {
        return $this->propertyPhotos;
    }

    public function setPropertyPhotos(?array $propertyPhotos): void {
        $this->propertyPhotos = $propertyPhotos;
    }

    public function getEnquiries(): ?array {
        return $this->enquiry;
    }

    public function setEnquiries(?array $enquiry): void {
        $this->enquiry = $enquiry;
    }
}
