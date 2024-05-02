<?php

/**
 * The OrganizationLogin class provides methods for handling organization login requests.
 * 
 * This class contains methods that validate user input, store error messages in sessions, and store login data in sessions.
 * 
 * @author Winfrey De Vera
 * @version 1.0
 * @since 2024
 */

declare(strict_types=1);

namespace Tomconnect\Controllers;

use Tomconnect\Controllers\Controller;
use Tomconnect\Models\UserModel;

class OrganizationLogin extends Controller
{
    /**
     * The $identifier variable stores a unique identifier.
     * 
     * This variable is used to store a unique identifier, such as an email or username,
     * inputted by the user. It can be accessed within the class or its subclasses.
     * 
     * @var string The unique identifier, typically an email or username.
     * @access private
     * @static
     */
    private static string $identifier;

    /**
     * Error messages used for form validation and error handling.
     *
     * This constant defines an array of error messages commonly used for form validation and error handling.
     * Each error message is associated with a specific validation rule or error condition encountered during form processing.
     * These messages provide feedback to users regarding input errors and guide them in correcting their submissions.
     *
     * @var array Error messages for form validation and error handling.
     */
    const ERROR_MESSAGES = [
        "invalid_credentials" => "Invalid username or password. Please try again.",
        "account_locked" => "Your account is locked. Please contact support for assistance.",
        "inactive_account" => "Your account is inactive. Please contact support to activate your account.",
        "missing_fields" => "Please fill in all required fields.",
    ];

    /**
     * Suffix used for error message session keys.
     *
     * This constant defines the suffix appended to form field names to construct session keys
     * for storing error messages related to those fields. It is commonly used in form validation
     * and error handling mechanisms to associate error messages with specific form fields.
     *
     * @var string Suffix used for error message session keys.
     */
    const ERROR_MESSAGE_SUFFIX = "_error_message";

    /**
     * Handles the login process.
     * 
     * This method validates the input fields and, if successful, stores the logged-in user's data in the session.
     * 
     * @return bool True if the login process is successful and false otherwise.
     * @access public
     */
    public function handle_login(): bool
    {
        if ($this->validate_fields()) {
            $this->store_logged_user_to_session();
            return true;
        }
        return false;
    }

    /**
     * Validates input fields for the login process.
     * 
     * This method checks if the credentials and password fields are empty. If they are empty, it stores an error message in the session and returns false.
     * 
     * If the fields are not empty, it sets the identifier and checks if both the identifier and password are valid. If they are not valid, it stores an error message in the session and returns false.
     * 
     * @return bool True if the input fields are valid and false otherwise.
     * @access private
     */
    private function validate_fields(): bool
    {
        if ($this->is_credential_empty() || $this->is_password_empty()) {
            $this->store_error_message_to_session('login', self::ERROR_MESSAGES['missing_fields']);
            return false;
        }

        $this->set_identifier();

        if (!$this->is_valid_identifier() || !$this->is_valid_password()) {
            $this->store_error_message_to_session('login', self::ERROR_MESSAGES['invalid_credentials']);
            return false;
        }

        return true;
    }

    /**
     * Stores logged-in user data in the session.
     * 
     * This method sets the 'is_logged_in' session variable to true to indicate that the user is logged in.
     * 
     * If the user's identifier is an email, it retrieves the username associated with that email from the UserModel
     * and stores it in the 'logged_user' session variable. If the identifier is a username, it retrieves the same username
     * and stores it in the session.
     * 
     * @return void
     * @access private
     */
    private function store_logged_user_to_session(): void
    {
        $_SESSION['is_logged_in'] = true;
        if ($this->is_email()) {
            $_SESSION['logged_user'] = UserModel::find('email', self::$identifier)['username'];
        } else {
            $_SESSION['logged_user'] = UserModel::find('username', self::$identifier)['username'];
        }
    }

    /**
     * Checks if the password provided by the user is valid.
     * 
     * This method verifies the password provided by the user against the hashed password stored in the UserModel.
     * 
     * If the user's identifier is an email, it retrieves the hashed password associated with that email from the UserModel
     * and compares it with the provided password using the password_verify function. If the identifier is a username,
     * it performs the same verification process.
     * 
     * @return bool True if the password is valid, and false otherwise.
     * @access private
     */
    private function is_valid_password(): bool
    {
        if ($this->is_email()) {
            return password_verify($_POST['password'], UserModel::find('email', self::$identifier)['password_hash']);
        } else {
            return password_verify($_POST['password'], UserModel::find('username', self::$identifier)['password_hash']);
        }
    }

    /**
     * Checks if the identifier provided by the user is valid.
     * 
     * This method determines whether the identifier provided by the user (either an email or a username)
     * is valid. If the identifier is an email, it validates it using the is_valid_email method. If the
     * identifier is a username, it validates it using the is_valid_username method.
     * 
     * @return bool True if the identifier is valid, and false otherwise.
     * @access private
     */
    private function is_valid_identifier(): bool
    {
        if ($this->is_email()) {
            return $this->is_valid_email();
        } else {
            return $this->is_valid_username();
        }
    }

    /**
     * Checks if the credential field is empty.
     * 
     * This method determines whether the credential field (either email or username) provided by the user is empty
     * or not set. It checks if the 'identifier' field in the POST data is empty or not set.
     * 
     * @return bool True if the credential field is empty or not set, and false otherwise.
     * @access private
     */
    private function is_credential_empty(): bool
    {
        return (empty($_POST['identifier']) || !isset($_POST['identifier']));
    }

    /**
     * Checks if the identifier is in email format.
     * 
     * This method determines whether the identifier stored in the class variable is in email format.
     * It uses the FILTER_VALIDATE_EMAIL filter to validate the email format of the identifier.
     * 
     * @return bool True if the identifier is in email format, and false otherwise.
     * @access private
     */
    private function is_email(): bool
    {
        return filter_var(self::$identifier, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Checks if the provided username is valid.
     * 
     * This method queries the UserModel to check if the provided username (stored in the class variable) exists in the database.
     * If the username exists, it returns true, indicating that the username is valid.
     * 
     * @return bool True if the provided username exists in the database, and false otherwise.
     * @access private
     */
    private function is_valid_username(): bool
    {
        return (UserModel::find('username', self::$identifier));
    }

    /**
     * Checks if the provided email is valid.
     * 
     * This method queries the UserModel to check if the provided email (stored in the class variable) exists in the database.
     * If the email exists, it returns true, indicating that the email is valid.
     * 
     * @return bool True if the provided email exists in the database, and false otherwise.
     * @access private
     */
    private function is_valid_email(): bool
    {
        return (UserModel::find('email', self::$identifier));
    }

    /**
     * Checks if the password field is empty.
     * 
     * This method determines whether the password field provided by the user is empty or not set.
     * It checks if the 'password' field in the POST data is empty or not set.
     * 
     * @return bool True if the password field is empty or not set, and false otherwise.
     * @access private
     */
    private function is_password_empty(): bool
    {
        return (empty($_POST['password']) || !isset($_POST['password']));
    }

    /**
     * Setters
     * 
     * These functions sets the value of this class' attribute by sanitizing the input data obtained from the $_POST array.
     * Sanitization helps prevent security vulnerabilities such as cross-site scripting (XSS) attacks by removing potentially
     * harmful characters or tags from the input.
     */
    private function set_identifier(): void
    {
        self::$identifier = strtolower(self::sanitize_input($_POST['identifier']));
    }

    /**
     * Stores an error message related to a specific form field in the session.
     *
     * This function stores an error message associated with a particular form field in the session data.
     * It is commonly used in form validation to keep track of validation errors and display them to the user
     * when rendering the form again.
     *
     * @param string $field_name The name or identifier of the form field.
     * @param string $error_message The error message to be stored in the session.
     * @return void
     */
    private function store_error_message_to_session(string $field_name, string $error_message): void
    {
        $_SESSION[$field_name . self::ERROR_MESSAGE_SUFFIX] = $error_message;
    }
}
