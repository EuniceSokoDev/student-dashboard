
<?php
include 'db.php';

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");


// Fetch all students
$sql = "SELECT * FROM students ORDER BY full_name ASC";
$result = $conn->query($sql);

$students = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $students[] = [
            'id' => $row['id'],
            'full_name' => $row['full_name'],
            'student_id' => $row['student_id'],
            'email' => $row['email'],
            'course_of_study' => $row['course_of_study'],
            'date_of_birth' => $row['date_of_birth'],
            'enrollment_date' => $row['enrollment_date'],
            'status' => $row['status']
        ];
    }
}

// Return JSON
echo json_encode($students);

$conn->close();
?>