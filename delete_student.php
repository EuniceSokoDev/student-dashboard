<?php
include 'db.php';

// Check if student_id is provided
if (!isset($_GET['student_id'])) {
    die("Student ID not provided.");
}

$student_id = $_GET['student_id'];

// Fetch student info before deletion (for logging)
$stmt = $conn->prepare("SELECT * FROM students WHERE student_id = ?");
$stmt->bind_param("s", $student_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    die("Student not found.");
}

$student = $result->fetch_assoc();
$stmt->close();

// Delete student using prepared statement
$delete = $conn->prepare("DELETE FROM students WHERE student_id = ?");
$delete->bind_param("s", $student_id);

if ($delete->execute()) {
    // Log deleted record to a file
    $logFile = 'deleted_students_log.txt';
    $logData = date("Y-m-d H:i:s") . " - Deleted Student: " . $student['full_name'] . " | Student ID: " . $student['student_id'] . " | Email: " . $student['email'] . "\n";
    file_put_contents($logFile, $logData, FILE_APPEND);

    //Return JSON response for React
    echo json_encode(['success' => true, 'message' => 'student deleted successfully']);
} else {
    echo json_decode(['success' => false, 'message' => 'Error deleting student: '. $delete ->error]);

}
    

$delete->close();
$conn->close();
?>