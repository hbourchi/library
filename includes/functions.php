<?php
function getConnection() {
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $dbName = "library";

    $pdo = new PDO("mysql:host=$serverName;dbname=$dbName", $userName, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $pdo;
}

function registerEmployee($name, $email, $pass) {
    $pdo = getConnection();

    $sql = "INSERT INTO employees (employee_name, email, password) VALUES (:name, :email, :pass)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':pass', $pass);
    $stmt->execute();
}

function loginEmployee($email) {
    $pdo = getConnection();
    
    $sql = "SELECT * FROM employees WHERE email = :email";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $employee = $stmt->fetch(PDO::FETCH_ASSOC);

    return $employee;
}

function loginUser($email){
    $pdo = getConnection();

    $sql = "SELECT * FROM clients WHERE email = :email";

    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    return $user;
}



