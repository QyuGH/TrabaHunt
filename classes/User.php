<?php

class User {
    protected $username;
    protected $email;
    protected $password;
    protected $userType;

    private $userJson = __DIR__ . '/../data/users.json';

    public function __construct($username, $email, $password, $userType) {
        $this->username = $username;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->userType = $userType;
    }

    public function registerUser($userData) {
        $users = [];
        if (file_exists($this->userJson)) {
            $json = file_get_contents($this->userJson);
            $users = json_decode($json, true) ?? [];
        }

        foreach ($users as $user) {
            if ($user['email'] === $this->email) {
                return "Email already exists.";
            }
        }

        $users[] = $userData;

        file_put_contents($this->userJson, json_encode($users, JSON_PRETTY_PRINT));

        return true;
    }

    public function login($email, $inputPassword) {
        if (!file_exists($this->userJson)) {
            return "No users found.";
        }
    
        $json = file_get_contents($this->userJson);
        $users = json_decode($json, true) ?? [];
    
        foreach ($users as $user) {
            if (($user['email'] === $email)
                && password_verify($inputPassword, $user['password'])) {
    
                session_start();
                $_SESSION['user'] = [
                    'userId' => $user['userId'],
                    'username' => $user['username'],
                    'email' => $user['email'],
                    'user_type' => $user['user_type'],
                ];
    
                return true;
            }
        }
    
        return "Invalid login credentials.";
    }

    public function logout(){
        header("Location: ../../index.php");
        exit();
    }
    
}
