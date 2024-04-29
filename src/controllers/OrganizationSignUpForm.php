<?php
/* The class `OrganizationSignUpForm` in the namespace `Tomconnect\Controllers` handles validation and
processing of user input for organization sign-up form. */

namespace Tomconnect\Controllers;

use Tomconnect\Models\OrganizationModel;
use Tomconnect\Models\UserModel;

class OrganizationSignUpForm extends Controller
{
    private string $username;
    private string $email;
    private string $password;
    private string $confirm_password;
    private string $organization_name;
    private string $organization_description;

    /**
     * Error messages used for form validation and error handling.
     *
     * This constant defines an array of error messages commonly used for form validation and error handling.
     * Each error message is associated with a specific validation rule or error condition encountered during form processing.
     * These messages provide feedback to users regarding input errors and guide them in correcting their submissions.
     *
     * @var array Error messages for form validation and error handling.
     */
    const ERROR_MESSAGES = array(
        'username_required' => "Username is required.",
        'username_length' => "Username must be between 4 and 20 characters.",
        'username_format' => "Username can only contain letters, numbers, underscores, and dashes.",
        'username_taken' => "Username is already taken. Please choose another one.",
        'email_required' => "Email is required.",
        'email_invalid' => "Email is not valid.",
        'email_exists' => "Email is already registered. Please use another one.",
        'password_required' => "Password is required.",
        'password_length' => "Password must be at least 8 characters long.",
        'password_complexity' => "Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.",
        'confirm_password_required' => "Confirm Password is required.",
        'password_mismatch' => "Passwords do not match.",
        'organization_name_required' => "Organization Name is required",
        'terms_required' => "You must agree to the Terms and Conditions to sign up."
    );

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
     * Minimum length allowed for usernames
     * 
     * This constant defines the maximum length allowed for usernames in the application
     * Usernames exceeding this length will be considered invalid and may trigger validation errors
     * 
     * @var int Minimum length allowed for usernames
     */
    const MIN_USERNAME_LENGTH = 4;

    /**
     * Maximum length allowed for usernames.
     *
     * This constant defines the maximum length allowed for usernames in the application.
     * Usernames exceeding this length will be considered invalid and may trigger validation errors.
     *
     * @var int Maximum length allowed for usernames.
     */
    const MAX_USERNAME_LENGTH = 20;

    const MIN_PASSWORD_LENGTH = 8;

    const USERNAME_FORMAT_REGEX = "/^[a-z]\w{4,20}[^_]$/i";

    const PASSWORD_COMPLEXITY_REGEX = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/s";

    const ORGANIZATION_NAME_FORMAT_REGEX = "/^[a-zA-Z0-9\s.'(),-]$/s";

    const PASSWORD_OPTIONS = ['cost' => 12];

    public function handle_field()
    {
        if ($this->validate_fields()) {
            $this->store_data_to_db();
            return true;
        }
        return false;
    }

    private function validate_fields()
    {
        return (
            $this->validate_username() &&
            $this->validate_email() &&
            $this->validate_password() &&
            $this->validate_confirm_password() &&
            $this->validate_organization_name() &&
            $this->validate_organization_description()
        );
    }

    private function store_data_to_db()
    {
        UserModel::create($this->generate_user_data_array());
        OrganizationModel::create($this->generate_organization_user_data_array());
        OrganizationModel::update(OrganizationModel::get_id($this->organization_name)['org_id'], ['description' => $this->organization_description]);
    }

    private function generate_user_data_array()
    {
        return array('username' => $this->username, 'email' => $this->email, 'password_hash' => $this->get_hash_password());
    }

    private function generate_organization_user_data_array()
    {
        return array('name' => $this->organization_name, 'admin_id' => UserModel::get_id($this->username, $this->email)['user_id']);
    }

    /**
     * Validates the username submitted in the form.
     *
     * This method performs validation checks on the username submitted via a form, including checks for
     * emptiness, length validity, format validity, and uniqueness. If any validation check fails, an
     * appropriate error message is stored in the session, and the method returns false. Otherwise, if
     * all validation checks pass, the method returns true, indicating that the username is valid.
     *
     * @return bool True if the username is valid, false otherwise.
     */
    private function validate_username(): bool
    {
        if ($this->is_username_empty()) {
            $this->store_error_message_to_session('username', self::ERROR_MESSAGES['username_required']);
            return false;
        }

        // store the username if it is already set
        $this->set_username();

        if (!$this->is_username_length_valid()) {
            $this->store_error_message_to_session('username', self::ERROR_MESSAGES['username_length']);
            return false;
        }

        if (!$this->is_username_format_valid()) {
            $this->store_error_message_to_session('username', self::ERROR_MESSAGES['username_format']);
            return false;
        }

        if ($this->is_username_taken()) {
            $this->store_error_message_to_session('username', self::ERROR_MESSAGES['username_taken']);
            return false;
        }

        return true;
    }

    private function validate_email()
    {
        if ($this->is_email_empty()) {
            $this->store_error_message_to_session('email', self::ERROR_MESSAGES['email_required']);
            return false;
        }

        $this->set_email();

        if (!$this->is_email_format_valid()) {
            $this->store_error_message_to_session('email', self::ERROR_MESSAGES['email_format']);
            return false;
        }

        if ($this->is_email_taken()) {
            $this->store_error_message_to_session('email', self::ERROR_MESSAGES['email_exists']);
            return false;
        }

        return true;
    }

    private function validate_password()
    {
        if ($this->is_password_empty()) {
            $this->store_error_message_to_session('password', self::ERROR_MESSAGES['password_required']);
            return false;
        }

        $this->set_password();

        if (!$this->is_password_length_valid()) {
            $this->store_error_message_to_session('password', self::ERROR_MESSAGES['password_length']);
            return false;
        }

        if (!$this->is_password_complexity_valid()) {
            $this->store_error_message_to_session('password', self::ERROR_MESSAGES['password_complexity']);
            return false;
        }

        return true;
    }

    private function validate_confirm_password()
    {
        if ($this->is_confirm_password_empty()) {
            $this->store_error_message_to_session('confirm_password', self::ERROR_MESSAGES['confirm_password_required']);
            return false;
        }

        $this->set_confirm_password();

        if (!$this->is_confirm_password_match()) {
            $this->store_error_message_to_session('confirm_password', self::ERROR_MESSAGES['password_mismatch']);
            return false;
        }

        return true;
    }
    
    private function validate_organization_name()
    {
        if ($this->is_organization_name_empty()) {
            $this->store_error_message_to_session('organization_name', self::ERROR_MESSAGES['organization_name_required']);
            return false;
        }

        $this->set_organization_name();

        return true;
    }

    private function validate_organization_description()
    {
        if ($this->is_organization_description_empty()) {
            $this->organization_description = '';
        } else {
            $this->set_organization_description();
        }

        return true;
    }

    /**
     * Checks if the username field in the POST request is empty or not set.
     *
     * This function determines whether the 'username' field in the $_POST array is empty or not set.
     * It is commonly used in form validation to ensure that a required field is provided in the HTTP POST request.
     *
     * @return bool True if the 'username' field is empty and is not set, false otherwise.
     */
    private function is_username_empty(): bool
    {
        return (empty($_POST['username']) || !isset($_POST['username']));
    }

    /**
     * Checks if the format of the username is valid.
     *
     * This function validates the format of the username against a regular expression pattern.
     * The username must start with a letter (case-insensitive), followed by 2 to 23 alphanumeric characters or underscores,
     * and it must not end with an underscore.
     *
     * @return bool True if the username format is valid, false otherwise.
     */
    private function is_username_format_valid(): bool
    {
        return (preg_match(self::USERNAME_FORMAT_REGEX, $this->username));
    }

    /**
     * Checks if a username is already taken by another user.
     *
     * This function queries the database to determine if the provided username already exists in the user database.
     * It is commonly used during user registration to ensure that each username is unique and not already in use by another user.
     *
     * @return bool True if the username is taken, false otherwise.
     */
    private function is_username_taken(): bool
    {
        return (!empty(UserModel::find('username', $this->username)));
    }

    /**
     * Checks if the length of the username is within the valid range.
     *
     * This function validates the length of the username to ensure it meets the required criteria.
     * Usernames must be at least 4 characters long and no longer than 20 characters.
     *
     * @return bool True if the username length is valid, false otherwise.
     */
    private function is_username_length_valid(): bool
    {
        return strlen($this->username) >= self::MIN_USERNAME_LENGTH && strlen($this->username) <= self::MAX_USERNAME_LENGTH;
    }

    /**
     * Checks if the email field in the POST request is empty or not set.
     *
     * This function determines whether the 'email' field in the $_POST array is empty or not set.
     * It is commonly used in form validation to ensure that a required field is provided in the HTTP POST request.
     *
     * @return bool True if the 'email' field is empty and is not set, false otherwise.
     */
    private function is_email_empty(): bool
    {
        return (empty($_POST['email']) || !isset($_POST['email']));
    }

    private function is_email_format_valid()
    {
        return (filter_var($this->email, FILTER_VALIDATE_EMAIL));
    }

    private function is_email_taken()
    {
        return (!empty(UserModel::find('email', $this->email)));
    }

    private function is_password_empty()
    {
        return (empty($_POST['password']) || !isset($_POST['password']));
    }

    private function is_password_complexity_valid()
    {
        return preg_match(self::PASSWORD_COMPLEXITY_REGEX, $this->password);
    }

    private function is_password_length_valid()
    {
        return strlen($this->password) >= self::MIN_PASSWORD_LENGTH;
    }

    private function is_confirm_password_empty()
    {
        return (empty($_POST['confirm_password']) || !isset($_POST['confirm_password']));
    }

    private function is_confirm_password_match()
    {
        if (isset($this->password)) {
            return $this->password ==  $this->confirm_password;
        } 
        return false;
    }

    private function is_organization_name_empty()
    {
        return (empty($_POST['organization_name']) || !isset($_POST['organization_name']));
    }

    private function is_organization_description_empty()
    {
        return (empty($_POST['organization_description']) || !isset($_POST['organization_descriptionjk']));
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

    private function get_hash_password(): string
    {
        return password_hash($this->password, PASSWORD_BCRYPT, self::PASSWORD_OPTIONS);
    }

    /**
     * Setters
     * 
     * These functions sets the value of this class' attribute by sanitizing the input data obtained from the $_POST array.
     * Sanitization helps prevent security vulnerabilities such as cross-site scripting (XSS) attacks by removing potentially
     * harmful characters or tags from the input.
     */
    private function set_username(): void
    {
        $this->username = strtolower(self::sanitize_input($_POST['username']));
    }

    private function set_email(): void
    {
        $this->email = strtolower(self::sanitize_input($_POST['email']));
    }

    private function set_password(): void
    {
        $this->password = self::sanitize_input($_POST['password']);
    }

    private function set_confirm_password(): void
    {
        $this->confirm_password = self::sanitize_input($_POST['confirm_password']);
    }

    private function set_organization_name(): void
    {
        $this->organization_name = self::sanitize_input($_POST['organization_name']);
    }

    private function set_organization_description(): void
    {
        $this->organization_description = self::sanitize_input($_POST['organization_desciprtion']);
    }
}
