<?php

namespace Makkari\Helpers;

function uploadFile($fileInputName, $targetDirectory, $allowedFileTypes = [])
{
    $result = []; // Initialize an array to store the result

    // Check if file input exists and is not empty
    if (isset($_FILES[$fileInputName]) && !empty($_FILES[$fileInputName])) {
        $file = $_FILES[$fileInputName];

        // Check for errors during file upload
        if ($file['error'] === UPLOAD_ERR_OK) {
            // Extract file information
            $fileName = basename($file['name']);
            $targetFilePath = $targetDirectory . '/' . $fileName;

            // Get file extension
            $fileExtension = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

            // Check if file type is allowed
            if (!empty($allowedFileTypes) && !in_array($fileExtension, $allowedFileTypes)) {
                $result['success'] = false;
                $result['message'] = "Only " . implode(', ', $allowedFileTypes) . " files are allowed.";
                return $result;
            }

            // Generate a unique filename
            $uniqueFileName = uniqid('', true) . '.' . $fileExtension;
            $targetFilePath = $targetDirectory . '/' . $uniqueFileName;

            // Move the uploaded file to the target directory
            if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
                $result['success'] = true;
                $result['message'] = "File uploaded successfully.";
                $result['filePath'] = $targetFilePath;
            } else {
                $result['success'] = false;
                $result['message'] = "Failed to move the uploaded file.";
            }
        } else {
            // Handle file upload errors
            $result['success'] = false;
            switch ($file['error']) {
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    $result['message'] = "Uploaded file exceeds the maximum file size limit.";
                    break;
                case UPLOAD_ERR_PARTIAL:
                    $result['message'] = "Uploaded file was only partially uploaded.";
                    break;
                case UPLOAD_ERR_NO_FILE:
                    $result['message'] = "No file was uploaded.";
                    break;
                case UPLOAD_ERR_NO_TMP_DIR:
                    $result['message'] = "Missing temporary folder.";
                    break;
                case UPLOAD_ERR_CANT_WRITE:
                    $result['message'] = "Failed to write file to disk.";
                    break;
                case UPLOAD_ERR_EXTENSION:
                    $result['message'] = "File upload stopped by extension.";
                    break;
                default:
                    $result['message'] = "Unknown file upload error.";
                    break;
            }
        }
    } else {
        // File input does not exist or is empty
        $result['success'] = false;
        $result['message'] = "No file uploaded.";
    }

    return $result;
}
