<?php

 class AdminEnquiryController {
    private EnquiryRepository $enquiryRepository;

    public function __construct(EnquiryRepository $enquiryRepository) {
        Helper::checkDependencies(array(
            "EnquiryRepository" => $enquiryRepository
        ));
        $this->enquiryRepository = $enquiryRepository;
    }


    public function home() {
        $enquiries = $this->enquiryRepository->getEnquiries();
        // echo implode($countries);
        $cols = ["Enquiry","Enquiry For","Posted By", "Actions"];
        $add = true;
        $arr = array_map(function(Enquiry $enquiry){
                $subArr = [];
                array_push($subArr, $enquiry->getEnquiry());
                if($enquiry->getEnquiryFor() != null){
                    array_push($subArr, $enquiry->getEnquiryFor()->getId());
                }else {
                    array_push($subArr,"-");
                }
                if($enquiry->getCreatedBy() != null){
                    array_push($subArr, $enquiry->getCreatedBy()->getUsername());
                }else {
                    array_push($subArr,"-");
                }
                array_push($subArr, "<a class='action-link delete' href='/realEstate/admin/enquiries/delete?id=".$enquiry->getId()."'>Delete</a>");

                return $subArr;
        },$enquiries);
        $title = "Enquiries";
        require_once __DIR__."/../../public/admin/table.php";
    }
 }