<?php
class DataMarshaller {
    private $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function jsonEncode() {
        return json_encode($this->data);
    }

    public function jsonDecode($jsonStr) {
        return json_decode($jsonStr, true);
    }

    public function xmlEncode() {
        $root = new SimpleXMLElement('<data></data>');
        $this->encodeDict($this->data, $root);
        return $root->asXML();
    }

    public function xmlDecode($xmlStr) {
        $xml = simplexml_load_string($xmlStr);
        return $this->decodeDict($xml);
    }

    public function base64Encode() {
        $serializedData = serialize($this->data);
        return base64_encode($serializedData);
    }

    public function base64Decode($base64Str) {
        $serializedData = base64_decode($base64Str);
        return unserialize($serializedData);
    }

    public function pickleSerialize() {
        return serialize($this->data);
    }

    public function pickleDeserialize($pickleStr) {
        return unserialize($pickleStr);
    }

    private function encodeDict($data, &$parent) {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                if (is_array($value)) {
                    $child = $parent->addChild($key);
                    $this->encodeDict($value, $child);
                } else {
                    $parent->addChild($key, htmlspecialchars($value));
                }
            }
        } elseif (is_object($data)) {
            $vars = get_object_vars($data);
            foreach ($vars as $key => $value) {
                $child = $parent->addChild($key);
                $this->encodeDict($value, $child);
            }
        }
    }

    private function decodeDict($element) {
        $data = [];
        foreach ($element as $child) {
            $key = $child->getName();
            if ($key === 'item') {
                if (!isset($data['items'])) {
                    $data['items'] = [];
                }
                $data['items'][] = $this->decodeDict($child);
            } else {
                $data[$key] = $this->decodeDict($child->children());
            }
        }
        return $data;
    }
}

?>
