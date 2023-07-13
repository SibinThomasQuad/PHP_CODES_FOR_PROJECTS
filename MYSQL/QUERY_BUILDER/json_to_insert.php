<?php

function json_string_to_insert_query($table_name, $json_string) {
    $json_data = json_decode($json_string, true);
    $columns = implode(', ', array_keys($json_data));
    $values = implode(', ', array_map(function($value) {
        return "'" . addslashes($value) . "'";
    }, $json_data));

    $insert_query = "INSERT INTO $table_name ($columns) VALUES ($values);";
    return $insert_query;
}

// Example usage
$table_name = 'my_table';
$json_string = '{
    "column1": "value1",
    "column2": "value2",
    "column3": 123,
    "column4": "value4"
}';

$insert_query = json_string_to_insert_query($table_name, $json_string);
echo $insert_query;

?>
