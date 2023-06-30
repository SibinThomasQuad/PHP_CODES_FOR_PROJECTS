<?php
class JSONUtils {
    public static function addKeyValue($jsonStr, $key, $value) {
        $jsonObj = json_decode($jsonStr, true);
        $jsonObj[$key] = $value;
        return json_encode($jsonObj);
    }

    public static function jsonToObject($jsonStr) {
        return json_decode($jsonStr);
    }

    public static function jsonToArray($jsonStr) {
        return json_decode($jsonStr, true);
    }

    public static function removeKey($jsonStr, $key) {
        $jsonObj = json_decode($jsonStr, true);
        if (isset($jsonObj[$key])) {
            unset($jsonObj[$key]);
        }
        return json_encode($jsonObj);
    }

    public static function arrayToJson($array) {
        return json_encode($array);
    }
}
?>
