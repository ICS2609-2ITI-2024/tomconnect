<?php

namespace Tomconnect\Controllers;

use Tomconnect\Models\UserModel;

class OrganizationSignUpForm extends Controller
{
    private $username;
    private $email;
    private $password;
    private $confirm_password;
    private $organization_name;
    private $organization_description;
    const FIELDs = [
        'username',
        'email',
        'password1',
        'password2',
        'organization_name',
        'organization_description'
    ];

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
        'terms_required' => "You must agree to the Terms and Conditions to sign up."
    );

    const ERROR_MESSAGE_SUFFIX = "_error_message";

    private  function store_error_message_to_session(string $field_name, string $error_message)
    {
        $_SESSION[$field_name . self::ERROR_MESSAGE_SUFFIX] = $error_message;
    }

    private function is_username_empty()
    {
        if (empty($_POST['username']) || !isset($_POST['username'])) {
            return false;
        }
        return true;
    }

    public function validate_username()
    {
        if (!$this->is_username_empty()) {
            $this->store_error_message_to_session('username', self::ERROR_MESSAGES['username_required']);
            return false;
        }
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

    private function is_username_format_valid()
    {
        if (preg_match('/^[a-z]\w{2,23}[^_]$/i', $this->username)) {
            return true;
        }
        return false;
    }

    private function is_username_taken()
    {
        if (empty(UserModel::find($this->username))) {
            return false;
        }
        return true;
    }

    private function is_username_length_valid()
    {
        if (strlen($this->username) < 4 || strlen($this->username) > 20) {
            return false;
        }
        return true;
    }

    private function set_username()
    {
        $this->username = $_POST['username'];
    }

}
