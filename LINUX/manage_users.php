<?php

class UserManagement
{
    // Function to create a user
    public function createUser($username, $password)
    {
        // Execute the command to create the user
        $command = "useradd $username";
        exec($command);

        // Set the user's password
        $command = "echo '$username:$password' | chpasswd";
        exec($command);

        echo "User $username created with password $password.";
    }

    // Function to delete a user
    public function deleteUser($username)
    {
        // Execute the command to delete the user
        $command = "userdel -r $username";
        exec($command);

        echo "User $username deleted.";
    }

    // Function to change a user's password
    public function changePassword($username, $newPassword)
    {
        // Set the user's new password
        $command = "echo '$username:$newPassword' | chpasswd";
        exec($command);

        echo "Password changed for user $username.";
    }

    // Function to deactivate a user
    public function deactivateUser($username)
    {
        // Lock the user's account
        $command = "passwd -l $username";
        exec($command);

        echo "User $username deactivated.";
    }

    // Function to activate a user
    public function activateUser($username)
    {
        // Unlock the user's account
        $command = "passwd -u $username";
        exec($command);

        echo "User $username activated.";
    }
}

// Usage example:
$userManagement = new UserManagement();

$username = "exampleuser";
$password = "examplepassword";

// Create a user
$userManagement->createUser($username, $password);

// Delete a user
$userManagement->deleteUser($username);

// Change a user's password
$newPassword = "newpassword";
$userManagement->changePassword($username, $newPassword);

// Deactivate a user
$userManagement->deactivateUser($username);

// Activate a user
$userManagement->activateUser($username);

?>
