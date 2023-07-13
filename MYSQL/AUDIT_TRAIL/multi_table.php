<?php

function createAuditTrail($connection, $tableName)
{
    $columns = array();
    
    // Get column names of the table
    $getColumnsQuery = "DESCRIBE $tableName";
    $result = $connection->query($getColumnsQuery);
    
    while ($row = $result->fetch_assoc()) {
        $columns[] = $row['Field'];
    }
    
    // Create the audit trail table for the specific table
    $createTableQuery = "
        CREATE TABLE IF NOT EXISTS audit_trail_$tableName (
            id INT AUTO_INCREMENT PRIMARY KEY,
            table_name VARCHAR(100),
            action VARCHAR(10),
            old_data JSON,
            new_data JSON,
            change_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ";
    $connection->query($createTableQuery);
    
    // Create the trigger to capture INSERT
    $createInsertTriggerQuery = "
        CREATE TRIGGER trigger_audit_insert_$tableName
        AFTER INSERT ON $tableName
        FOR EACH ROW
        BEGIN
            INSERT INTO audit_trail_$tableName (table_name, action, new_data)
            VALUES ('$tableName', 'INSERT', JSON_OBJECT(
                " . implode(", ", array_map(function($column) {
                    return "'$column', NEW.$column";
                }, $columns)) . "
            ));
        END
    ";
    $connection->query($createInsertTriggerQuery);
    
    // Create the trigger to capture UPDATE
    $createUpdateTriggerQuery = "
        CREATE TRIGGER trigger_audit_update_$tableName
        AFTER UPDATE ON $tableName
        FOR EACH ROW
        BEGIN
            INSERT INTO audit_trail_$tableName (table_name, action, old_data, new_data)
            VALUES ('$tableName', 'UPDATE', JSON_OBJECT(
                " . implode(", ", array_map(function($column) {
                    return "'$column', OLD.$column";
                }, $columns)) . ", 'change_date', NOW()), JSON_OBJECT(
                " . implode(", ", array_map(function($column) {
                    return "'$column', NEW.$column";
                }, $columns)) . "
            ));
        END
    ";
    $connection->query($createUpdateTriggerQuery);
    
    // Create the trigger to capture DELETE
    $createDeleteTriggerQuery = "
        CREATE TRIGGER trigger_audit_delete_$tableName
        AFTER DELETE ON $tableName
        FOR EACH ROW
        BEGIN
            INSERT INTO audit_trail_$tableName (table_name, action, old_data)
            VALUES ('$tableName', 'DELETE', JSON_OBJECT(
                " . implode(", ", array_map(function($column) {
                    return "'$column', OLD.$column";
                }, $columns)) . "
            ));
        END
    ";
    $connection->query($createDeleteTriggerQuery);
}

// Example usage
$servername = 'localhost';
$username = 'your_username';
$password = 'your_password';
$dbname = 'your_database';
$tables = array('table1', 'table2', 'table3');  // List of tables to monitor

// Create database connection
$connection = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connection->connect_error) {
    die('Connection failed: ' . $connection->connect_error);
}

try {
    foreach ($tables as $tableName) {
        createAuditTrail($connection, $tableName);
    }
    echo "Audit trail triggers created successfully!";
} catch (Exception $e) {
    echo "Error creating audit trail triggers: " . $e->getMessage();
}

$connection->close();

?>
