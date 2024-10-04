<?php
    class EnquiryRepository {
        private EnquiryDAO $enquiryDAO;
        private CommentDAO $commentDAO;
        public function __construct(
            EnquiryDAO $enquiryDAO,
            CommentDAO $commentDAO,
        ) {
            Helper::checkDependencies(array(
                "EnquiryDAO" => $enquiryDAO,
                "CommentDAO" => $commentDAO
            ));
            $this->enquiryDAO = $enquiryDAO;
            $this->commentDAO = $commentDAO;
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