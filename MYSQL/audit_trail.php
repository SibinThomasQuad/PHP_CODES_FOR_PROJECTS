<?php

// Database connection details
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'pyd';

// Table name to monitor
$tableName = 'employees';

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Create audit trail table
$createTableQuery = "
    CREATE TABLE IF NOT EXISTS audit_trail (
        id INT AUTO_INCREMENT PRIMARY KEY,
        table_name VARCHAR(100),
        action VARCHAR(10),
        old_data JSON,
        new_data JSON,
        change_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )
";
$conn->query($createTableQuery);

// Get column names of the table
$getColumnsQuery = "DESCRIBE $tableName";
$columnsResult = $conn->query($getColumnsQuery);
$columns = [];
while ($column = $columnsResult->fetch_assoc()) {
    $columns[] = $column['Field'];
}

// Create trigger for INSERT
$createInsertTriggerQuery = "
    CREATE TRIGGER trigger_audit_insert_$tableName
    AFTER INSERT ON $tableName
    FOR EACH ROW
    BEGIN
        INSERT INTO audit_trail (table_name, action, new_data)
        VALUES ('$tableName', 'INSERT', JSON_OBJECT(
            " . implode(", ", array_map(function($column) {
                return "'$column', NEW.$column";
            }, $columns)) . "
        ));
    END
";
$conn->query($createInsertTriggerQuery);

// Create trigger for UPDATE
$createUpdateTriggerQuery = "
    CREATE TRIGGER trigger_audit_update_$tableName
    AFTER UPDATE ON $tableName
    FOR EACH ROW
    BEGIN
        INSERT INTO audit_trail (table_name, action, old_data, new_data)
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
$conn->query($createUpdateTriggerQuery);

// Create trigger for DELETE
$createDeleteTriggerQuery = "
    CREATE TRIGGER trigger_audit_delete_$tableName
    AFTER DELETE ON $tableName
    FOR EACH ROW
    BEGIN
        INSERT INTO audit_trail (table_name, action, old_data)
        VALUES ('$tableName', 'DELETE', JSON_OBJECT(
            " . implode(", ", array_map(function($column) {
                return "'$column', OLD.$column";
            }, $columns)) . "
        ));
    END
";
$conn->query($createDeleteTriggerQuery);

$conn->close();

?>
