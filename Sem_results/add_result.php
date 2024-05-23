<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_name = $_POST['student_name'];
    $student_id = $_POST['student_id'];
    $subject = $_POST['subject'];
    $grade = $_POST['grade'];

    $sql = "INSERT INTO results (student_name, student_id, subject, grade)
            VALUES ('$student_name', '$student_id', '$subject', '$grade')";

    if ($conn->query($sql) === TRUE) {
        echo "New result added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Result</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Add New Result</h2>
        <form method="POST" action="add_result.php">
            <div class="form-group">
                <label>Student Name:</label>
                <input type="text" name="student_name" required>
            </div>
            <div class="form-group">
                <label>Student ID:</label>
                <input type="text" name="student_id" required>
            </div>
            <div class="form-group">
                <label>Subject:</label>
                <input type="text" name="subject" required>
            </div>
            <div class="form-group">
                <label>Grade:</label>
                <input type="text" name="grade" required>
            </div>
            <button type="submit">Add Result</button>
        </form>
        <a href="index.php">Back to Results</a>
    </div>
</body>
</html>
