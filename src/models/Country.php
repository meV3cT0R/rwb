<?php
    class Country {
        private int $id;
        private string $name;

        function __construct($name="") {
            $this->name = $name;
        }

        function setName($name):void {
            $this->name = $name;
        }

        function getName(): string {
            return $this->name;
        }
        function getId():int {
            return $this->id;
        }
        function setId(int $id):void { 
            $this->id = $id;
        }
    }