<?php
include_once "./includes/header.php";
include_once "./includes/sidebar.php";
// Handle form submission
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     if (!empty($_POST['documents'])) {
//         $checkedDocs = $_POST['documents'];
//         echo "<h3>Submitted Documents:</h3><ul>";
//         foreach ($checkedDocs as $doc) {
//             echo "<li>$doc</li>";
//         }
//         echo "</ul>";
//     } else {
//         echo "<h3>No documents selected.</h3>";
//     }
// }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Checklist</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>

<h2>Student Checklist</h2>
<form method="POST">
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Form 137</th>
                <th>Form 138</th>
                <th>Good Moral</th>
                <th>PSA</th>
                <th>2x2 Picture</th>
                <th>ESC Certificate</th>
                <th>Diploma</th>
                <th>Barangay Clearance</th>
                <th>NCAE</th>
                <th>AF-5</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td><input type="checkbox" name="documents[]" value="Form 137"></td>
                <td><input type="checkbox" name="documents[]" value="Form 138"></td>
                <td><input type="checkbox" name="documents[]" value="Good Moral Certificate"></td>
                <td><input type="checkbox" name="documents[]" value="PSA"></td>
                <td><input type="checkbox" name="documents[]" value="2x2 Picture"></td>
                <td><input type="checkbox" name="documents[]" value="ESC Certificate"></td>
                <td><input type="checkbox" name="documents[]" value="Diploma"></td>
                <td><input type="checkbox" name="documents[]" value="Barangay Clearance"></td>
                <td><input type="checkbox" name="documents[]" value="NCAE"></td>
                <td><input type="checkbox" name="documents[]" value="AF-5"></td>
            </tr>
        </tbody>
    </table>
    <br>
    <button type="submit">Submit</button>
</form>

</body>
</html>
