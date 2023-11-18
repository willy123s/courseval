<?php

namespace Makkari\Controllers;

class View
{
    private $viewsDirectory;

    public function __construct($viewsDirectory)
    {
        $this->viewsDirectory = $viewsDirectory;
    }

    public function render($viewName, $data = array())
    {
        // Construct the full path to the view file
        $viewPath = $this->viewsDirectory . '/' . $viewName . '.php';

        // Check if the view file exists
        if (!file_exists($viewPath)) {
            throw new \Exception('View file not found: ' . $viewPath);
        }

        extract($data);
        // Escape user-generated data to prevent XSS
        $escapedData = $this->escapeData($data);

        // Start output buffering to capture the generated HTML
        ob_start();

        // Include the view file, which will output the HTML
        require_once $viewPath;

        // Get the generated HTML from the output buffer
        $content = ob_get_clean();

        // Return the processed HTML
        echo $content;
    }

    private function escapeData($data)
    {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                // Recursively escape string values
                if (is_string($value)) {
                    $data[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
                }
            }
        } elseif (is_string($data)) {
            // If it's a string, escape the value
            $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
        }

        return $data;
    }
}
