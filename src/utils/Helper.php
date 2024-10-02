<?php
    class Helper {
        public static function checkDependency(?object $service, string $serviceName): void {
            if ($service === null) {
                throw new ErrorException("Required Dependency '$serviceName' is not provided");
            }
        }
        public static function checkDependencies(array $arr): void {
            foreach ($arr as $name => $service) {
                Helper::checkDependency($service,$name);
            }
            
        }
    }