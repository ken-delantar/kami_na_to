<?php
include_once "../includes/db_connection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['documents'])) {
    foreach ($_POST['documents'] as $student_id => $docs) {
        $pdo->prepare("DELETE FROM student_documents WHERE student_id = :student_id")
            ->execute(['student_id' => $student_id]);

        foreach ($docs as $doc) {
            $stmt = $pdo->prepare("INSERT INTO documents (student_id, document_name, submitted_at) VALUES (:student_id, :document_name, NOW())");
            $stmt->execute([
                'student_id' => $student_id,
                'document_name' => $doc
            ]);
        }
    }

    $_SESSION['success'] = "Documents submitted successfully.";
    header("Location: documents_page.php"); // redirect back to the form or listing page
    exit;
} else {
    $_SESSION['error'] = "No data submitted.";
    header("Location: documents_page.php");
    exit;
}
