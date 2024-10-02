<?php
    class Role {
        private int|null $id=null;
        private string|null $name=null;

        function __construct(int|null $id=null, string|null $name=null) {
            $this->id=$id;
            $this->name=$name;
        }

        function getId():int|null {
            return $this->id;
        }

        function getName():string|null {
            return $this->name;
        }

        function setId(int|null $id):void {
            $this->id = $id;
        }

        function setName(string|null $name):void {
            $this->name =$name;
        }
    }