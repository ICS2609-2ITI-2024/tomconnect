<?php

/**
 * The OrganizationSignUp class provides methods for handling Organization Sign Up processes.
 * 
 * This class contains methods that validate user inputs, store error messages in sessions in case of validation errors,
 * and store valid user inputs to the database upon successful sign-up.
 * 
 * The validation methods ensure that the user provides necessary information such as organization name, email address,
 * password, etc., and that the provided data meets certain criteria (e.g., valid email format, strong password requirements).
 * 
 * Error messages generated during the validation process are stored in session variables, allowing for easy retrieval and
 * display to the user on subsequent pages or form submissions.
 * 
 * Upon successful validation of user inputs, the class stores the validated data, such as organization name and email address,
 * in the database, creating a new organization entry in the system.
 * 
 * @author Winfrey De Vera
 * @version 1.0
 * @since 2024
 */

declare(strict_types=1);

namespace Tomconnect\Controllers;

use Tomconnect\Models\OrganizationModel;
use Tomconnect\Models\UserModel;

class OrganizationSignUpForm extends Controller
{
    /**
     * Class properties for Organization Sign Up data.
     * 
     * These properties store the necessary information for organization sign-up process, including username,
     * email address, password, confirm password, organization name, and organization description.
     * 
     * @var string $username The username chosen by the user for their organization account.
     * @var string $email The email address provided by the user for their organization account.
     * @var string $password The password chosen by the user for their organization account.
     * @var string $confirm_password The confirmation of the password provided by the user.
     * @var string $organization_name The name of the organization provided by the user.
     * @var string $organization_description The description of the organization provided by the user.
     */
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

    /**
     * The minimum length required for a password.
     * 
     * This constant defines the minimum length required for a password during the organization sign-up process.
     * Passwords must be at least 8 characters long to meet the security requirements.
     * 
     * @var int MIN_PASSWORD_LENGTH
     */
    const MIN_PASSWORD_LENGTH = 8;

    /**
     * Regular expression pattern for validating the format of a username.
     * 
     * This constant defines a regular expression pattern used to validate the format of a username
     * during the organization sign-up process. Usernames must start with a letter (case-insensitive),
     * followed by 4 to 20 alphanumeric characters or underscores, with no trailing underscore.
     * 
     * @var string USERNAME_FORMAT_REGEX
     */
    const USERNAME_FORMAT_REGEX = "/^[a-z]\w{4,20}[^_]$/i";

    /**
     * Regular expression pattern for enforcing password complexity.
     * 
     * This constant defines a regular expression pattern used to enforce password complexity requirements
     * during the organization sign-up process. Passwords must contain at least one lowercase letter,
     * one uppercase letter, one digit, one special character, and be at least 8 characters long.
     * 
     * @var string PASSWORD_COMPLEXITY_REGEX
     */
    const PASSWORD_COMPLEXITY_REGEX = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/s";

    /**
     * Regular expression pattern for validating the format of an organization name.
     * 
     * This constant defines a regular expression pattern used to validate the format of an organization name
     * during the organization sign-up process. Organization names can contain alphanumeric characters,
     * spaces, periods, single quotes, parentheses, commas, hyphens, and apostrophes.
     * 
     * @var string ORGANIZATION_NAME_FORMAT_REGEX
     */
    const ORGANIZATION_NAME_FORMAT_REGEX = "/^[a-zA-Z0-9\s.'(),-]$/s";

    /**
     * Options for password hashing.
     * 
     * This constant defines options for password hashing, specifically the cost factor used by the password
     * hashing algorithm. A higher cost value results in stronger hash security, but also increases computation time.
     * 
     * @var array PASSWORD_OPTIONS
     */
    const PASSWORD_OPTIONS = ['cost' => 12];

    /**
     * Handles the organization sign-up process.
     * 
     * This method validates the input fields for organization sign-up. If the validation is successful,
     * it stores the validated data in the database and returns true to indicate a successful sign-up.
     * If the validation fails, it returns false, indicating that the sign-up process failed.
     * 
     * @return bool True if the organization sign-up process is successful, and false otherwise.
     * @access public
     */
    public function handle_sign_up(): bool
    {
        if ($this->validate_fields()) {
            $this->store_data_to_db();
            return true;
        }
        return false;
    }

    /**
     * Validates input fields for organization sign-up.
     * 
     * This method validates all input fields required for organization sign-up, including the username, email,
     * password, confirm password, organization name, and organization description.
     * 
     * It returns true if all input fields pass their respective validation checks, ensuring that the user-provided
     * data meets the necessary criteria for successful sign-up. Otherwise, it returns false, indicating validation failure.
     * 
     * @return bool True if all input fields pass validation checks, and false otherwise.
     * @access private
     */
    private function validate_fields(): bool
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

    /**
     * Stores validated user and organization data to the database.
     * 
     * This method creates new records in the UserModel and OrganizationModel databases with the validated user and organization data.
     * 
     * It first creates a new user record using the generated user data array obtained from the generate_user_data_array method.
     * Next, it creates a new organization record using the generated organization user data array obtained from the generate_organization_user_data_array method.
     * Finally, it updates the description of the organization record to match the provided organization description.
     * 
     * @return void
     * @access private
     */
    private function store_data_to_db(): void
    {
        UserModel::create($this->generate_user_data_array());
        OrganizationModel::create($this->generate_organization_user_data_array());
        OrganizationModel::update(OrganizationModel::get_id($this->organization_name)['org_id'], ['description' => $this->organization_description]);
    }

    /**
     * Generates an array of user data for database insertion.
     * 
     * This method creates an associative array containing user data required for database insertion,
     * including the username, email, and hashed password.
     * 
     * The generated array is structured as follows:
     * - 'username': The username provided by the user during sign-up.
     * - 'email': The email address provided by the user during sign-up.
     * - 'password_hash': The hashed password obtained using the get_hash_password method.
     * 
     * @return array An associative array containing user data for database insertion.
     * @access private
     */
    private function generate_user_data_array(): array
    {
        return array('username' => $this->username, 'email' => $this->email, 'password_hash' => $this->get_hash_password());
    }

    /**
     * Generates an array of organization user data for database insertion.
     * 
     * This method creates an associative array containing organization user data required for database insertion,
     * including the organization name and the admin user ID.
     * 
     * The generated array is structured as follows:
     * - 'name': The name of the organization provided by the user during sign-up.
     * - 'admin_id': The user ID of the admin user associated with the organization. It is retrieved using the username or email
     *               provided during sign-up from the UserModel.
     * 
     * @return array An associative array containing organization user data for database insertion.
     * @access private
     */
    private function generate_organization_user_data_array(): array
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

    /**
     * Validates the email address provided during organization sign-up.
     * 
     * This method checks the validity of the email address provided by the user during organization sign-up.
     * It performs the following checks:
     * 
     * 1. Empty Check: Checks if the email field is empty. If empty, it stores an error message in the session
     *    and returns false.
     * 
     * 2. Format Check: Validates the format of the email address using the is_email_format_valid method.
     *    If the format is invalid, it stores an error message in the session and returns false.
     * 
     * 3. Unique Check: Checks if the email address is already taken by another user. If it is, it stores an error
     *    message in the session and returns false.
     * 
     * If all checks pass, indicating that the email address is valid, the method returns true.
     * 
     * @return bool True if the email address is valid, and false otherwise.
     * @access private
     */
    private function validate_email(): bool
    {
        if ($this->is_email_empty()) {
            $this->store_error_message_to_session('email', self::ERROR_MESSAGES['email_required']);
            return false;
        }

        $this->set_email();

        if (!$this->is_email_format_valid()) {
            $this->store_error_message_to_session('email', self::ERROR_MESSAGES['email_invalid']);
            return false;
        }

        if ($this->is_email_taken()) {
            $this->store_error_message_to_session('email', self::ERROR_MESSAGES['email_exists']);
            return false;
        }

        return true;
    }

    /**
     * Validates the password provided during organization sign-up.
     * 
     * This method checks the validity of the password provided by the user during organization sign-up.
     * It performs the following checks:
     * 
     * 1. Empty Check: Checks if the password field is empty. If empty, it stores an error message in the session
     *    and returns false.
     * 
     * 2. Length Check: Validates the length of the password using the is_password_length_valid method.
     *    If the length is invalid, it stores an error message in the session and returns false.
     * 
     * 3. Complexity Check: Validates the complexity of the password using the is_password_complexity_valid method.
     *    If the complexity requirements are not met, it stores an error message in the session and returns false.
     * 
     * If all checks pass, indicating that the password is valid, the method returns true.
     * 
     * @return bool True if the password is valid, and false otherwise.
     * @access private
     */
    private function validate_password(): bool
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

    /**
     * Validates the confirm password field during organization sign-up.
     * 
     * This method checks the validity of the confirm password field provided by the user during organization sign-up.
     * It performs the following checks:
     * 
     * 1. Empty Check: Checks if the confirm password field is empty. If empty, it stores an error message in the session
     *    and returns false.
     * 
     * 2. Match Check: Validates if the confirm password matches the original password provided during sign-up.
     *    If the passwords do not match, it stores an error message in the session and returns false.
     * 
     * If all checks pass, indicating that the confirm password is valid, the method returns true.
     * 
     * @return bool True if the confirm password is valid, and false otherwise.
     * @access private
     */
    private function validate_confirm_password(): bool
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

    /**
     * Validates the organization name field during organization sign-up.
     * 
     * This method checks the validity of the organization name field provided by the user during organization sign-up.
     * It performs the following check:
     * 
     * 1. Empty Check: Checks if the organization name field is empty. If empty, it stores an error message in the session
     *    and returns false.
     * 
     * If the organization name field is not empty, indicating that it is valid, the method returns true.
     * 
     * @return bool True if the organization name is valid, and false otherwise.
     * @access private
     */
    private function validate_organization_name(): bool
    {
        if ($this->is_organization_name_empty()) {
            $this->store_error_message_to_session('organization_name', self::ERROR_MESSAGES['organization_name_required']);
            return false;
        }

        $this->set_organization_name();

        return true;
    }

    /**
     * Validates the organization description field during organization sign-up.
     * 
     * This method checks the validity of the organization description field provided by the user during organization sign-up.
     * It performs the following check:
     * 
     * 1. Empty Check: Checks if the organization description field is empty. If empty, it sets the organization description
     *    to an empty string. Otherwise, it sets the organization description using the set_organization_description method.
     * 
     * Since the organization description field is optional, this method always returns true, indicating that the validation
     * is successful.
     * 
     * @return bool Always returns true, as the organization description is optional and no validation failure can occur.
     * @access private
     */
    private function validate_organization_description(): bool
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
        return (preg_match(self::USERNAME_FORMAT_REGEX, $this->username) == 1);
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

    /**
     * Checks if the email address format is valid.
     * 
     * This method uses PHP's built-in filter_var function with the FILTER_VALIDATE_EMAIL flag
     * to validate the format of the email address stored in the $email property.
     * 
     * It returns true if the email address format is valid according to the FILTER_VALIDATE_EMAIL filter,
     * and false otherwise.
     * 
     * @return bool True if the email address format is valid, and false otherwise.
     * @access private
     */
    private function is_email_format_valid() 
    {
        return (filter_var($this->email, FILTER_VALIDATE_EMAIL));
    }

    /**
     * Checks if the email address is already taken by another user.
     * 
     * This method queries the UserModel to check if the provided email address ($email) is already
     * associated with an existing user account in the database.
     * 
     * It returns true if the email address is found in the UserModel database, indicating that it is already taken,
     * and false otherwise.
     * 
     * @return bool True if the email address is already taken, and false otherwise.
     * @access private
     */
    private function is_email_taken(): bool
    {
        return (!empty(UserModel::find('email', $this->email)));
    }

    /**
     * Checks if the password field is empty.
     * 
     * This method checks if the password field submitted via POST data is empty or not set.
     * 
     * It returns true if the password field is empty or not set, and false otherwise.
     * 
     * @return bool True if the password field is empty or not set, and false otherwise.
     * @access private
     */
    private function is_password_empty(): bool
    {
        return (empty($_POST['password']) || !isset($_POST['password']));
    }

    /**
     * Checks if the password meets complexity requirements.
     * 
     * This method uses a regular expression pattern defined in the PASSWORD_COMPLEXITY_REGEX constant
     * to check if the password meets the complexity requirements.
     * 
     * It returns true if the password meets the complexity requirements specified by the regular expression pattern,
     * and false otherwise.
     * 
     * @return bool True if the password meets complexity requirements, and false otherwise.
     * @access private
     */
    private function is_password_complexity_valid(): bool
    {
        return preg_match(self::PASSWORD_COMPLEXITY_REGEX, $this->password) == 1;
    }

    /**
     * Checks if the password meets the minimum length requirement.
     * 
     * This method compares the length of the password stored in the $password property with the minimum
     * password length requirement defined by the MIN_PASSWORD_LENGTH constant.
     * 
     * It returns true if the password length is equal to or greater than the minimum password length requirement,
     * and false otherwise.
     * 
     * @return bool True if the password meets the minimum length requirement, and false otherwise.
     * @access private
     */
    private function is_password_length_valid(): bool
    {
        return strlen($this->password) >= self::MIN_PASSWORD_LENGTH;
    }

    /**
     * Checks if the confirm password field is empty.
     * 
     * This method checks if the confirm password field submitted via POST data is empty or not set.
     * 
     * @return bool True if the confirm password field is empty or not set, and false otherwise.
     * @access private
     */
    private function is_confirm_password_empty(): bool
    {
        return (empty($_POST['confirm_password']) || !isset($_POST['confirm_password']));
    }

    /**
     * Checks if the confirm password matches the original password.
     * 
     * This method checks if the value of the confirm password field matches the value of the original password
     * provided during sign-up.
     * 
     * @return bool True if the confirm password matches the original password, and false otherwise.
     * @access private
     */
    private function is_confirm_password_match(): bool
    {
        if (isset($this->password)) {
            return $this->password ==  $this->confirm_password;
        }
        return false;
    }

    /**
     * Checks if the organization name field is empty.
     * 
     * This method checks if the organization name field submitted via POST data is empty or not set.
     * 
     * @return bool True if the organization name field is empty or not set, and false otherwise.
     * @access private
     */
    private function is_organization_name_empty(): bool
    {
        return (empty($_POST['organization_name']) || !isset($_POST['organization_name']));
    }

    /**
     * Checks if the organization description field is empty.
     * 
     * This method checks if the organization description field submitted via POST data is empty or not set.
     * 
     * @return bool True if the organization description field is empty or not set, and false otherwise.
     * @access private
     */
    private function is_organization_description_empty(): bool
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

    /**
     * Generates a hashed version of the password.
     * 
     * This method generates a hashed version of the original password using the PHP password_hash function
     * with the bcrypt algorithm and additional options specified by the PASSWORD_OPTIONS constant.
     * 
     * @return string The hashed version of the password.
     * @access private
     */
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
