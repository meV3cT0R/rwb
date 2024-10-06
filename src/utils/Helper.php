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

        public static function refValues(array $arr) :array {
            $refs = [];
            foreach ($arr as $key => $value) {
                $refs[$key] = &$arr[$key];
            }
            return $refs;
        }
    }