<?php

class Auth
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function login($username, $password)
    {
        // Escape username untuk mencegah SQL injection
        $username = mysqli_real_escape_string($this->conn, $username);

        // Hash password menggunakan SHA-1
        $hashed_password = sha1($password);

        // Query untuk memeriksa username dan password
        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$hashed_password'";
        $result = mysqli_query($this->conn, $sql);

        // Periksa hasil query
        if ($result && mysqli_num_rows($result) == 1) {
            // Jika autentikasi berhasil, set session atau tindakan lain yang sesuai
            session_start();
            $_SESSION['username'] = $username;
            return true; // Login sukses
        }

        return false;
    }
}
?>
