<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");


if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

include 'db.php'; // database connection

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Get POST data (works for both form POST or JSON POST from React)
    $inputData = $_POST;
    if (empty($inputData)) {
        $json = file_get_contents('php://input');
        $inputData = json_decode($json, true);
    }

    // Validate required fields
    $required = ['full_name', 'student_id', 'email', 'date_of_birth', 'course_of_study', 'enrollment_date', 'status'];
    foreach ($required as $field) {
        if (!isset($inputData[$field]) || empty(trim($inputData[$field]))) {
            $response['message'] = "Field '$field' is required.";
            echo json_encode($response);
            exit;
        }
    }

    // Assign variables
    $full_name = trim($inputData['full_name']);
    $student_id = trim($inputData['student_id']);
    $email = trim($inputData['email']);
    $dob = trim($inputData['date_of_birth']);
    $course = trim($inputData['course_of_study']);
    $enroll_date = trim($inputData['enrollment_date']);
    $status = trim($inputData['status']);

    //  simple email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['message'] = "Invalid email address.";
        echo json_encode($response);
        exit;
    }

    // Prepare SQL to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO students (full_name, student_id, email, date_of_birth, course_of_study, enrollment_date, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $full_name, $student_id, $email, $dob, $course, $enroll_date, $status);

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = "Student registered successfully.";
    } else {
        $response['message'] = "Database error: " . $stmt->error;
    }

    $stmt->close();
} else {
    $response['message'] = "Invalid request method.";
}

$conn->close();
echo json_encode($response);
?>