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


    public static function uploadImage($files): string
    {
        logMessage("inside upload Image");
        logMessage(implode($files));
        $targetDir = "images/";
        $targetFile = $targetDir . basename($files["file"]);
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $maxFileSize = 5 * 1024 * 1024;

        if (isset($files)) {
            $check = getimagesize($files["tmp_name"]);
            if ($check !== false) {
                logMessage("File is an image - " . $check["mime"]);
            } else {
                throw new Exception("File is not an image.");
            }
        }

        if ($files["size"] > $maxFileSize) {
            throw new Exception("Sorry, your file is too large.");
        }

        $allowedTypes = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($fileType, $allowedTypes)) {
            throw new Exception("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
        }


        if (move_uploaded_file($files["tmp_name"], $targetFile)) {
            logMessage("The file " . basename($files["name"]) . " has been uploaded.");
        } else {
            throw new Exception("Sorry, there was an error uploading your file.");
        }

        return $targetFile;
    }
}