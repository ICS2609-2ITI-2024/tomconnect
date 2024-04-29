<?php
declare(strict_types=1);

namespace Tomconnect\Controllers;

use Tomconnect\Controllers\Controller;
use Tomconnect\Models\UserModel;


class OrganizationLogin extends Controller
{
    private static $identifier;
    const ERROR_MESSAGES = [
        "invalid_credentials" => "Invalid username or password. Please try again.",
        "account_locked" => "Your account is locked. Please contact support for assistance.",
        "inactive_account" => "Your account is inactive. Please contact support to activate your account.",
        "missing_fields" => "Please fill in all required fields.",
    ];

    const ERROR_MESSAGE_SUFFIX = "_error_message";

    public function handle_login()
    {
        if ($this->validate_fields()) {
            $this->store_logged_user_to_session();
            return true;
        }
        return false;
    }

    private function validate_fields()
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

    private function store_logged_user_to_session() 
    {
        $_SESSION['is_logged_in'] = true;
        if ($this->is_email()) {
            $_SESSION['logged_user'] = UserModel::find('email', self::$identifier)['username'];
        } else {
            $_SESSION['logged_user'] = UserModel::find('username', self::$identifier)['username'];
        }
    }

    private function is_valid_password()
    {
        if ($this->is_email()) {
            return password_verify($_POST['password'], UserModel::find('email', self::$identifier)['password_hash']);
        } else {
            return password_verify($_POST['password'], UserModel::find('username', self::$identifier)['password_hash']);
        }
    }

    private function is_valid_identifier()
    {
        if ($this->is_email()) {
            return $this->is_valid_email();
        } else {
            return $this->is_valid_username();
        }
    }

    private function is_credential_empty()
    {
        return (empty($_POST['identifier']) || !isset($_POST['identifier']));
    }

    private function is_email()
    {
        return filter_var(self::$identifier, FILTER_VALIDATE_EMAIL);
    }

    private function is_valid_username()
    {
        return (UserModel::find('username', self::$identifier));
    }

    private function is_valid_email()
    {
        return (UserModel::find('email', self::$identifier));
    }

    private function is_password_empty()
    {
        return (empty($_POST['password']) || !isset($_POST['password']));
    }

    private function set_identifier()
    {
        self::$identifier = strtolower(self::sanitize_input($_POST['identifier']));
    }
    private function store_error_message_to_session(string $field_name, string $error_message): void
    {
        $_SESSION[$field_name . self::ERROR_MESSAGE_SUFFIX] = $error_message;
    }
}
