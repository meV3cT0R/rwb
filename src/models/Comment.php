<?php
    class Comment {
        private int|null $id=null;
        private User|null $createdBy=null;
        private string|null $comment=null;

        private Enquiry|null $commentFor=null; //property
        
        function __construct(int|null $id=null,User|null $createdBy=null,string|null $comment,Property|null $commentFor) {
            $this->id=$id;
            $this->createdBy=$createdBy;
            $this->comment=$comment;
            $this->commentFor=$commentFor;
        }

        public function getId():int|null {
            return $this->id;
        }

        public function getCreatedBy():User|null {
            return $this->createdBy;
        }

        public function getComment():string|null {
            return $this->comment;
        }

        public function getCommentFor():Enquiry|null {
            return $this->commentFor;
        }


        public function setId(int|null $id) : void {
            $this->id = $id;
        }
        public function setCreatedBy(User|null $user) : void {
            $this->user = $user;
        }

        public function setComment(string|null $comment) : void {
            $this->comment = $comment;
        }

        public function setCommentFor(Enquiry|null $commentFor) : void {
            $this->commentFor = $commentFor;
        }
    }

