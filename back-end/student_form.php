<?php 
include_once "../includes/db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['Fullname'];
    $student_number = $_POST['student_number'];
    $lrn = $_POST['LRN'];
    $sex = $_POST['sex'];
    $school_origin = $_POST['school_origin'];
    $condition = $_POST['condition'];
    $status = $_POST['status'];

    try {
        $sql = "INSERT INTO students (name, lrn, sex, school_origin, `condition`, status, created_at, updated_at) 
                VALUES (:name, :lrn, :sex, :school_origin, :condition, :status, NOW(), NOW())";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':lrn', $lrn);
        $stmt->bindParam(':sex', $sex);
        $stmt->bindParam(':school_origin', $school_origin);
        $stmt->bindParam(':condition', $condition);
        $stmt->bindParam(':status', $status);

        if ($stmt->execute()) {
            // echo "Student added successfully!";
            header("location: http://localhost/kami_na_to/?insert=success");
        } else {
            echo "Error: Unable to insert student.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
