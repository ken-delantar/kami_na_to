<?php
// Database configuration
define('DB_SERVER', '157.173.111.118');
define('DB_USERNAME', 'core3_shs_file');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'core3_shs_file');

// Attempt to connect to MySQL database
try {
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
}

// Function to execute prepared statements
function executeQuery($sql, $params = []) {
    global $pdo;
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    } catch(PDOException $e) {
        $_SESSION['error'] = $e->getMessage();
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}

function retrieve($sql, $params = []) {
    global $pdo;
    try {
        $stmt = $pdo->prepare($sql);
        
        if (!empty($params)) {
            foreach ($params as $key => $value) {
                $stmt->bindValue($key, $value);
            }
        }

        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? $result : null;
    } catch(PDOException $e) {
        $_SESSION['error'] = $e->getMessage();
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
}

?>