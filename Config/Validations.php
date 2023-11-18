<?php

namespace Makkari\Config;

class Validations
{
    public static function validateData($data, $rules)
    {
        $errors = [];

        foreach ($rules as $field => $fieldRules) {
            // Ensure the field exists in the data array
            if (array_key_exists($field, $data)) {
                $value = $data[$field];
                $fieldErrors = [];

                foreach ($fieldRules as $rule) {
                    // Split the rule into the rule name and any additional parameters
                    list($ruleName, $ruleParameters) = self::parseRule($rule);

                    // Apply the validation rules to the field's value
                    if (!self::applyRule($field, $value, $ruleName, $ruleParameters)) {
                        $fieldErrors[] = self::getErrorMessage($field, $ruleName, $ruleParameters);
                    }
                }

                if (!empty($fieldErrors)) {
                    $errors[$field] = $fieldErrors;
                }
            } else {
                // Field not found in data
                $errors[$field] = ["$field is required"];
            }
        }
        $e = self::showErrorMessage($errors);

        $result = new \stdClass();
        $result->errors = $errors;
        $result->showErrors = $e;
        return $result;
    }

    // Parse a rule into its name and parameters
    private static function parseRule($rule)
    {
        $ruleParts = explode('=', $rule);
        $ruleName = array_shift($ruleParts);
        $ruleParameters = $ruleParts;
        return [$ruleName, $ruleParameters];
    }

    // Define specific validation rules for each field
    private static function applyRule($field, $value, $ruleName, $ruleParameters)
    {
        switch ($ruleName) {
            case 'required':
                return !empty($value);
            case 'min_length':
                return strlen($value) >= (int)$ruleParameters[0];
            case 'number_only':
                return preg_match('/^\d+$/', $value);
                // Add more validation rules as needed
            default:
                return true; // No specific rule for this field
        }
    }

    // Define error messages for specific rules
    private static function getErrorMessage($field, $ruleName, $ruleParameters)
    {
        switch ($ruleName) {
            case 'required':
                return "$field is required";
            case 'min_length':
                return "$field must be at least {$ruleParameters[0]} characters long.";
            case 'number_only':
                return "$field must contain only numbers.";
                // Add more error messages as needed
            default:
                return "Invalid $field";
        }
    }
    private static function showErrorMessage($errors)
    {
        $msg = "";
        foreach ($errors as $field => $fieldErrors) {
            $msg .= ucfirst($field) . ": ";
            foreach ($fieldErrors as $error) {
                $msg .= "- $error <br>";
            }
        }
        return $msg;
    }
}
