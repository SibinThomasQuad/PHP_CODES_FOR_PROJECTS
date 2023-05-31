<?php

function create_json($data) {
    $json_data = json_encode($data);
    return $json_data;
}

function truncate_json($json_data) {
    $truncated_data = (object) array();
    return json_encode($truncated_data);
}

function update_json_with_key($json_data, $key, $value) {
    $data = json_decode($json_data, true);
    $data[$key] = $value;
    return json_encode($data);
}

function delete_json_with_key($json_data, $key) {
    $data = json_decode($json_data, true);
    if (isset($data[$key])) {
        unset($data[$key]);
    }
    return json_encode($data);
}

function add_data_and_key_to_json($json_data, $key, $value) {
    $data = json_decode($json_data, true);
    if (!isset($data[$key])) {
        $data[$key] = $value;
    }
    return json_encode($data);
}

// Example usage
$data = array(
    "name" => "John",
    "age" => 25
);

// Create JSON
$json_data = create_json($data);
echo $json_data . "\n";

// Truncate JSON
$truncated_json = truncate_json($json_data);
echo $truncated_json . "\n";

// Update JSON with Key
$updated_json = update_json_with_key($json_data, "age", 30);
echo $updated_json . "\n";

// Delete JSON with Key
$deleted_json = delete_json_with_key($json_data, "age");
echo $deleted_json . "\n";

// Add Data and New Key to JSON
$new_json = add_data_and_key_to_json($json_data, "city", "New York");
echo $new_json . "\n";

?>
