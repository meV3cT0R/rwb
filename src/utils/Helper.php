<?php
class Helper
{
    public static function checkDependency(?object $service, string $serviceName): void
    {
        if ($service === null) {
            throw new ErrorException("Required Dependency '$serviceName' is not provided");
        }
    }
    public static function checkDependencies(array $arr): void
    {
        foreach ($arr as $name => $service) {
            Helper::checkDependency($service, $name);
        }
    }

    public static function refValues(array $arr): array
    {
        $refs = [];
        foreach ($arr as $key => $value) {
            $refs[$key] = &$arr[$key];
        }
        return $refs;
    }


    public static function uploadImage($file): ?string
    {
        // logMessage("inside upload Image");
        if(basename($file["name"]=="")) {return null;}

        $targetDir = "images/";
        if(!is_dir($targetDir)){
            if (mkdir($targetDir, 0755, true)) {
                // logMessage("Directory created successfully.");
            } else {
                // logMessage("Failed to create directory.");
            }
        }
        $targetFile = $targetDir . basename($file["name"]);
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $maxFileSize = 5 * 1024 * 1024;

        if (isset($file)) {
            $check = getimagesize($file["tmp_name"]);
            if ($check !== false) {
                // logMessage("File is an image - " . $check["mime"]);
            } else {
                throw new Exception("File is not an image.");
            }
        }

        if ($file["size"] > $maxFileSize) {
            throw new Exception("Sorry, your file is too large.");
        }

        $allowedTypes = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($fileType, $allowedTypes)) {
            throw new Exception("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
        }


        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            // logMessage("The file " . basename($file["name"]) . " has been uploaded.");
        } else {
            throw new Exception("Sorry, there was an error uploading your file.");
        }

        return $targetFile;
    }

    public static function getParams(string $queryParams) : array {
        trim($queryParams);
        $arr = explode("&",$queryParams);
        $params  = array();

        foreach($arr as $val) {
                $val = trim($val);
                $arrVal = explode("=",$val);
                $params[$arrVal[0]] = $arrVal[1];
        }

        
        return $params;
    }

    public static function base64($file): string|null {
        if (isset($file) && $file["error"] == 0) {
            $fileContent = file_get_contents($file["tmp_name"]);
    
            $base64EncodedFile = base64_encode($fileContent);
            return $base64EncodedFile;
        }
        return null;
    }

    public static function base64_array($files): array {
        $base64EncodedFiles = [];
    
        // Check if files are set and valid
        if (isset($files) && is_array($files['tmp_name'])) {
            // Loop through each file
            for ($i = 0; $i < count($files['tmp_name']); $i++) {
                if ($files["error"][$i] == 0) {
                    $fileContent = file_get_contents($files["tmp_name"][$i]);
                    $base64EncodedFile = base64_encode($fileContent);
                    $base64EncodedFiles[] = $base64EncodedFile;
                } else {
                    $base64EncodedFiles[] = null; // Handle errors for specific files
                }
            }
        }
    
        return $base64EncodedFiles;
    }
}