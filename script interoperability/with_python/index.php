<?php

class PythonRunner {
    
    private $pythonExecutable;

    public function __construct($pythonExecutable = 'py') {
        $this->pythonExecutable = $pythonExecutable;
    }

    public function runPythonScript($scriptPath, $arguments = array()) {
        // Build the command to execute the Python script
        $command = $this->pythonExecutable . ' ' . escapeshellarg($scriptPath);

        // Add any arguments to the command
        foreach ($arguments as $argument) {
            $command .= ' ' . escapeshellarg($argument);
        }

        // Execute the command
        $output = array();
        $returnValue = null;
        exec($command, $output, $returnValue);

        // Check if the execution was successful
        if ($returnValue === 0) {
            // Return the output of the Python script
            return implode("\n", $output);
        } else {
            // Return an error message
            return "Error executing Python script. Return value: $returnValue";
        }
    }
}

// Example usage:
$pythonRunner = new PythonRunner();
$scriptPath = 'example.py';
$arguments = array(1, 4);
$result = $pythonRunner->runPythonScript($scriptPath, $arguments);
echo $result;

?>
