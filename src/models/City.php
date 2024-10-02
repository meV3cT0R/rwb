<!--- Required Dependecies 
    Country
    State
--->
<?php
    class City {
        private int|null $id=null;
        private string|null $name=null;
        private Country|null $country=null;
        private State|null $state=null;

        public function __construct(int $id=null, string $name=null, Country $country=null,State $state=null) {
            if($id ===null && $name ===null && $country ===null && $state=null) {
                return;
            }
            if($name ===null && $country ===null && $state===null) {
                $this->id = $id;
                return;
            }
            if($country ===null && $state ===null) {
                $this->id = $id;
                $this->name = $name;
                return;
            }
            // if($state ===null) {
            //     $this->id = $id;
            //     $this->name = $name;
            //     $this->country = $country;
            //     return;
            // }
            $this->id = $id;
            $this->name = $name;
            $this->country = $country;
            $this->state = $state;

        }

        public function getId(): int|null {
            return $this->id;
        }

        public function getName(): string|null {
            return $this->name;
        }

        public function getCountry(): Country|null {
            return $this->country;
        }

        public function getState(): State|null {
            return $this->state;
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
        public function setState(State $state): void {
            $this->state = $state;
        }


        public function __toString(): string {
            return $this->name;
        }
    }