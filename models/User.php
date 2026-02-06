<?php
require_once __DIR__ . '/../config/database.php';

class User {

public static function findByEmail($email) {
    $db = new Database();
    $conn = $db->getConnection();

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}


    public static function createLocal($name, $email, $password) {
        $db = new Database();
        $conn = $db->getConnection();

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (name, email, password, provider)
                VALUES (:name, :email, :password, 'local')";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hash);

        return $stmt->execute();
    }

    public static function findOrCreateSocial($name, $email, $provider, $provider_id) {
        $db = new Database();
        $conn = $db->getConnection();

        // Check existing user
        $sql = "SELECT * FROM users 
                WHERE provider = :provider AND provider_id = :provider_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':provider', $provider);
        $stmt->bindParam(':provider_id', $provider_id);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) return $user;

        // Create new social user
        $sql = "INSERT INTO users (name, email, provider, provider_id)
                VALUES (:name, :email, :provider, :provider_id)";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':provider', $provider);
        $stmt->bindParam(':provider_id', $provider_id);
        $stmt->execute();

        return [
            'id' => $conn->lastInsertId(),
            'name' => $name,
            'email' => $email
        ];
    }
}