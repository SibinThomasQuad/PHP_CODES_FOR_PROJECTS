<?php

// File path for the JSON data
$jsonFilePath = 'data.json';

// Read JSON data from file
function readData() {
    global $jsonFilePath;
    if (file_exists($jsonFilePath)) {
        $jsonData = file_get_contents($jsonFilePath);
        return json_decode($jsonData, true);
    }
    return [];
}

// Write JSON data to file
function writeData($data) {
    global $jsonFilePath;
    $jsonData = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents($jsonFilePath, $jsonData);
}

// Create a new record
function createRecord($record) {
    $data = readData();
    $data[] = $record;
    writeData($data);
}

// Read all records
function readAllRecords() {
    return readData();
}

// Read a single record by ID
function readRecord($id) {
    $data = readData();
    foreach ($data as $record) {
        if ($record['id'] == $id) {
            return $record;
        }
    }
    return null;
}

// Update a record by ID
function updateRecord($id, $updatedRecord) {
    $data = readData();
    foreach ($data as &$record) {
        if ($record['id'] == $id) {
            $record = array_merge($record, $updatedRecord);
            writeData($data);
            return true;
        }
    }
    return false;
}

// Delete a record by ID
function deleteRecord($id) {
    $data = readData();
    foreach ($data as $key => $record) {
        if ($record['id'] == $id) {
            unset($data[$key]);
            writeData(array_values($data));
            return true;
        }
    }
    return false;
}

// Example usage:

// Create a new record
$record1 = ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com'];
createRecord($record1);

// Create another record
$record2 = ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@example.com'];
createRecord($record2);

// Read all records
$allRecords = readAllRecords();
foreach ($allRecords as $record) {
    echo "ID: " . $record['id'] . "\n";
    echo "Name: " . $record['name'] . "\n";
    echo "Email: " . $record['email'] . "\n";
    echo "\n";
}

// Read a single record by ID
$recordId = 1;
$singleRecord = readRecord($recordId);
if ($singleRecord) {
    echo "ID: " . $singleRecord['id'] . "\n";
    echo "Name: " . $singleRecord['name'] . "\n";
    echo "Email: " . $singleRecord['email'] . "\n";
    echo "\n";
} else {
    echo "Record not found.\n";
}

// Update a record by ID
$recordIdToUpdate = 2;
$updatedRecord = ['name' => 'Updated Name', 'email' => 'updated@example.com'];
if (updateRecord($recordIdToUpdate, $updatedRecord)) {
    echo "Record updated successfully.\n";
} else {
    echo "Failed to update record.\n";
}

// Delete a record by ID
$recordIdToDelete = 1;
if (deleteRecord($recordIdToDelete))
