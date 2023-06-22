<?php
class HashTable {
    private $data = [];

    public function put($key, $value) {
        $this->data[$key] = $value;
    }

    public function get($key) {
        if ($this->contains($key)) {
            return $this->data[$key];
        }
        return null;
    }

    public function contains($key) {
        return isset($this->data[$key]);
    }

    public function remove($key) {
        if ($this->contains($key)) {
            unset($this->data[$key]);
        }
    }

    public function keys() {
        return array_keys($this->data);
    }

    public function values() {
        return array_values($this->data);
    }

    public function clear() {
        $this->data = [];
    }

    public function size() {
        return count($this->data);
    }
}

?>
