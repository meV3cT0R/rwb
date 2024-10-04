<!--- Required Dependecies 
    Country
--->
<?php
    class State {
        private int|null $id=null;
        private ?string $name=null;
        private ?Country $country=null;
        
        private ?array $cities=null;

        public function __construct(int $id=null, string $name=null, Country $country=null,array $cities=null) {
            $this->id = $id;
            $this->name = $name;
            $this->country = $country;
            $this->cities = $cities;
        }

        public function getId(): int|null {
            return $this->id;
        }

        public function getName(): string {
            return $this->name;
        }

        public function getCountry(): Country {
            return $this->country;
        }
        public function getCities(): ?array {
            return $this->cities;
        }

        public function setId(int $id): void {
            $this->id = $id;
        }

        public function setName(string $name): void {
            $this->name = $name;
        }
        public function setCountry(Country $country): void {
            $this->country = $country;
        }


        public function setCities(array $cities): ?array {
            $this->cities = $cities;
        }


        public function __toString(): string {
            return $this->name;
        }
    }