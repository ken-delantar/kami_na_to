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
            
            $_SESSION['success'] = 'Strand added successfully!';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        } else {
            throw new Exception('Strand name cannot be empty');
        }
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;  
    }
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'addSection'){
    $school_year = $_POST['school_year'] ?? '';
    $school_year = htmlspecialchars(trim($school_year));

    $strand = $_POST['strand'] ?? '';
    $strand = htmlspecialchars(trim($strand));

    $grade_level = $_POST['grade_level'] ?? '';
    $grade_level = htmlspecialchars(trim($grade_level));

    $section = $_POST['section'] ?? '';
    $section = htmlspecialchars(trim($section));


    try {
        if (!empty($school_year) && !empty($strand) && !empty($grade_level) && !empty($section)){
            $sql = "INSERT INTO sections (school_year_id, strand_id, section_name, grade_level) VALUES (:school_year, :strand, :section, :grade_level)";
            $params = [
                ':school_year' => $school_year,
                ':strand' => $strand,
                ':grade_level' => $grade_level,
                ':section' => $section,
            ];

            $result = executeQuery($sql, $params);

            if(!$result){
                throw new Exception('Something went wrong.');
            } else {
                echo 'Success';
            }

            // $_SESSION['success'] = "Section added successfully!";
            // header('Location: ' . $_SERVER['HTTP_REFERER']);
            // exit;
        } else {
            throw new Exception('All fields are required.');
        }
    } catch (\Exception $e) {
        echo $e->getMessage();
        // $_SESSION['error'] = $e->getMessage();
        // header('Location: ' . $_SERVER['HTTP_REFERER']); 
        // exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'addSchoolYear') {
    $year_start = $_POST['year_start'] ?? '';
    $year_start = htmlspecialchars(trim($year_start));

    $year_end = $_POST['year_end'] ?? '';
    $year_end = htmlspecialchars(trim($year_end));

    // $class_start = $_POST['class_start'] ?? null;
    // $class_start = htmlspecialchars(trim($class_start));

    try {
        if (!empty($year_start) && !empty($year_end)) {
  
            $sql = "INSERT INTO school_years (year_start, year_end) VALUES (:year_start, :year_end)";
            $params = [
                ':year_start' => $year_start,
                ':year_end' => $year_end,
                // ':class_start' => $class_start
            ];

            $result = executeQuery($sql, $params);

            $_SESSION['success'] = "School year added successfully!";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        } else {
            throw new Exception('All fields are required.');
        }
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        header('Location: ' . $_SERVER['HTTP_REFERER']); 
        exit;
    }
}

?>
