<?php

include '../includes/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'addStrand') {
    $strandName = $_POST['strand'] ?? '';
    
    $strandName = htmlspecialchars(trim($strandName));

    try {
        if (!empty($strandName)) {
            $sql = "INSERT INTO strands (strand) VALUES (:strand)";
            
            $params = [':strand' => $strandName];
            $result = executeQuery($sql, $params);
    
            if ($result) {
                echo 'Strand added successfully.';
            } else {
                echo 'Error: Could not add the strand.';
            }
        } else {
            echo 'Error: Strand name cannot be empty.';
        }
    } catch (\Exception $e) {
        return header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}

?>
