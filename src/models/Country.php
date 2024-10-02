<?php
    class Country {
        private int|null $id;
        private string $name;

        function __construct(int|null $id=null, string|null $name=null) {
            if($id===null && $name===null) {
                return;
            }
            if($name===null) {
                $this->id=$id;
                return;
            }
            $this->id=$id;
            $this->name = $name;
        }

        function setName($name):void {
            $this->name = $name;
        }

        function getName(): string {
            return $this->name;
        }
        function getId():int|null {
            return $this->id;
        }
        function setId(int $id):void { 
            $this->id = $id;
        }

        function __tostring() :string {
            return $this->name;
        }
    }