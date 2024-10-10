<?php
    class EnquiryRepository {
        private EnquiryDAO $enquiryDAO;
        private CommentDAO $commentDAO;
        private UserDAO $userDAO;

        public function __construct(
            EnquiryDAO $enquiryDAO,
            CommentDAO $commentDAO,
            UserDAO $userDAO
        ) {
            Helper::checkDependencies(array(
                "EnquiryDAO" => $enquiryDAO,
                "CommentDAO" => $commentDAO,
                "UserDAO" => $userDAO,

            ));
            $this->enquiryDAO = $enquiryDAO;
            $this->commentDAO = $commentDAO;
            $this->userDAO = $userDAO;
        }

        public function getEnquiries() : array {
            $enquiriesTemp = $this->enquiryDAO->getEnquiries();
            $enquiries = [];
            foreach ($enquiriesTemp as $enquiry) {
                $enquiry->setComments($this->commentDAO->getCommentsByEnquiryId($enquiry->getId()));
                array_push($enquiries, $enquiry);
                if($enquiry->getCreatedBy() !== null) {
                    $enquiry->setCreatedBy($this->userDAO->getUserById($enquiry->getCreatedBy()->getId()));
                }
            }
            return $enquiries;
        }

        public function getEnquiriesByPropertyId(int $id): array {
            $enquiriesTemp = $this->enquiryDAO->getEnquiriesByPropertyId($id);
            $enquiries = [];
            foreach ($enquiriesTemp as $enquiry) {
                $enquiry->setComments($this->commentDAO->getCommentsByEnquiryId($enquiry->getId()));
                array_push($enquiries, $enquiry);
            }
            return $enquiries;
        }

        public function getEnquiryById(int $enquiryId) : Enquiry {
            $enquiry = $this->enquiryDAO->getEnquiryById($enquiryId);
            $enquiry->setComments($this->commentDAO->getCommentsByEnquiryId($enquiry->getId()));
            return $enquiry;
        }

        public function postEnquiry(Enquiry $enquiry) : Enquiry {
            return $this->enquiryDAO->PostEnquiry($enquiry);
        }

        public function updateEnquiry(Enquiry $enquiry) : Enquiry {
            return $this->enquiryDAO->updateEnquiry($enquiry);
        }

        public function deleteEnquiry(int $id) : Enquiry {
            return $this->enquiryDAO->deleteEnquiry($id);
        }
    }