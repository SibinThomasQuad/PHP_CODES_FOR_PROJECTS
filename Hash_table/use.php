<?php
$hashTable = new HashTable();

$hashTable->put("name", "John Doe");
$hashTable->put("age", 30);
$hashTable->put("city", "New York");

echo $hashTable->get("name"); // Output: John Doe
echo $hashTable->get("age"); // Output: 30

$hashTable->remove("age");

echo $hashTable->contains("age") ? "Yes" : "No"; // Output: No

$keys = $hashTable->keys();
print_r($keys); // Output: Array ( [0] => name [1] => city )

$values = $hashTable->values();
print_r($values); // Output: Array ( [0] => John Doe [1] => New York )

$hashTable->clear();
echo $hashTable->size(); // Output: 0

?>
