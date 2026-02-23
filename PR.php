<?php
include 'db.php';

// Collect POST data
$full_name = trim($_POST['full_name']);
$student_id = trim($_POST['student_id']);
$email = trim($_POST['email']);
$date_of_birth = $_POST['date_of_birth'];
$course_of_study = trim($_POST['course_of_study']);
$enrollment_date = $_POST['enrollment_date'];
$status = $_POST['status'];

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format");
}

// Insert into database
$stmt = $conn->prepare("INSERT INTO students (student_id, full_name, email, date_of_birth, course_of_study, enrollment_date, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $student_id, $full_name, $email, $date_of_birth, $course_of_study, $enrollment_date, $status);

if ($stmt->execute()) {
    // Redirect to registration slip
    header("Location: registration_slip.php?student_id=" . $student_id);
    exit();
} else {
    echo "Error: " . $stmt->error;
    }

$stmt->close();
$conn->close();
?>