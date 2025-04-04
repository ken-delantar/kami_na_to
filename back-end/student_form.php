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
        $sql = "INSERT INTO students (name, lrn, sex, school_origin, `condition`, status, created_at, updated_at, id) 
                VALUES (:name, :lrn, :sex, :school_origin, :condition, :status, NOW(), NOW(), :student_number)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':lrn', $lrn);
        $stmt->bindParam(':sex', $sex);
        $stmt->bindParam(':school_origin', $school_origin);
        $stmt->bindParam(':condition', $condition);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':student_number', $student_number);

        if ($stmt->execute()) {

            $strand = $_POST['strand_id'];
            $school_year = $_POST['school_year_id'];
            $section = $_POST['section_id'];
            $year_end_status = 'Not Specified';

            $sql = "INSERT INTO academic_records (student_id, strand_id, school_year_id, section_id, year_end_status) VALUES (:student_id, :strand_id, :school_year_id, :section_id, :year_end_status)";
            
            $params = [
                ':student_id' => $student_number,
                ':strand_id' => $strand,
                ':school_year_id' => $school_year,
                ':section_id' => $section,
                ':year_end_status' => $year_end_status,
            ];
            $result = executeQuery($sql, $params);
            
            if($result){
                $_SESSION['success'] = 'Inserted Successfully failed.';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            } else {
                new Exception('Error: Unable to insert student.');
            }
        } else {
            new Exception('Error: Unable to insert student.');
        }
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        echo $e->getMessage();
        // header('Location: ' . $_SERVER['HTTP_REFERER']);
        // exit;
    }
}
?>