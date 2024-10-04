<?php
    class CommentRepository {
        private CommentDAO $commentDAO;

        public function __construct(
            CommentDAO $commentDAO,
        ) {
            Helper::checkDependencies(array(
                "CommentDAO" => $commentDAO,
            ));
            $this->commentDAO = $commentDAO;
        }

        public function getCityById(int $id): Comment {
            return $this->commentDAO->getCommentById($id);
        }

        public function getCities(int $enquiryId) : array {
            return $this->commentDAO->getCommentsByEnquiryId($enquiryId);

        }

        public function postComment(Comment $comment) : Comment {
            return $this->commentDAO->postComment($comment);
        }

        public function updateComment(Comment $comment) : Comment {
            return $this->commentDAO->updateComment(comment: $comment);
        }

        public function deleteComment(int $id) : Comment {
            return $this->commentDAO->deleteComment($id);
        }
    }