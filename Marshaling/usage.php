<?php
$data = ['name' => 'John Doe', 'age' => 30, 'city' => 'New York'];
$marshaller = new DataMarshaller($data);

// JSON encoding/decoding
$jsonData = $marshaller->jsonEncode();
$decodedData = $marshaller->jsonDecode($jsonData);

// XML encoding/decoding
$xmlData = $marshaller->xmlEncode();
$decodedData = $marshaller->xmlDecode($xmlData);

// Base64 encoding/decoding
$base64Data = $marshaller->base64Encode();
$decodedData = $marshaller->base64Decode($base64Data);

// Pickle serialization/deserialization
$pickleData = $marshaller->pickleSerialize();
$decodedData = $marshaller->pickleDeserialize($pickleData);

?>
