<!--- Required Dependecies 
    Country
--->
<?php
    class State {
        private int|null $id;
        private string $name;
        private Country $country;

        public function __construct(int $id=null, string $name=null, Country $country=null) {
            if($id ===null && $name ===null && $country ===null) {
                return;
            }
            if(($name ===null && $country ===null)) {
                $this->id = $id;
                return;
            }
            if($country ===null) {
                $this->id = $id;
                $this->name = $name;
            }

            $this->id = $id;
            $this->name = $name;
            $this->country = $country;

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

        public function setId(int $id): void {
            $this->id = $id;
        }

        public function setName(string $name): void {
            $this->name = $name;
        }
        public function setCountry(Country $country): void {
            $this->country = $country;
        }

        public function __toString(): string {
            return $this->name;
        }
    }