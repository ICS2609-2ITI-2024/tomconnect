<?php
/**
 * The Controller class provides utility methods for data sanitization and validation.
 * 
 * This class contains methods that help sanitize user input to prevent common security vulnerabilities
 * such as SQL injection and cross-site scripting (XSS) attacks. The methods provided here can be used
 * across different parts of the application to ensure that input data is properly sanitized before
 * being processed or stored.
 * 
 * @author Group 3
 * @version version 1
 * @since 2024
 */
declare(strict_types=1);

namespace Tomconnect\Controllers;

class Controller
{
    /**
     * Sanitizes input data by removing leading/trailing whitespace, escaping special characters, and
     * removing backslashes. This method helps prevent common security vulnerabilities such as SQL injection
     * and cross-site scripting (XSS) attacks.
     *
     * @param string $data The input data to be sanitized.
     * @return string The sanitized input data.
     */
    protected static function sanitize_input($data): string
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
