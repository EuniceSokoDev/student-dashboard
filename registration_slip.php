<?php
include 'db.php';

if (!isset($_GET['student_id'])) {
    die("Student ID not provided.");
}

$student_id = $_GET['student_id'];

// Fetch student data
$stmt = $conn->prepare("SELECT * FROM students WHERE student_id = ?");
$stmt->bind_param("s", $student_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    die("Student not found.");
}

$student = $result->fetch_assoc();
$stmt->close();

$registration_time = date("Y-m-d H:i:s");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registration Confirmation Slip</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>
<body>
<div class="container">
    <h3>Registration Confirmation Slip</h3>
    <p><strong>Full Name:</strong> <?php echo htmlspecialchars($student['full_name']); ?></p>
    <p><strong>Student ID:</strong> <?php echo htmlspecialchars($student['student_id']); ?></p>
    <p><strong>Course:</strong> <?php echo htmlspecialchars($student['course_of_study']); ?></p>
    <p><strong>Status:</strong> <?php echo htmlspecialchars($student['status']); ?></p>
    <p><strong>Registration Timestamp:</strong> <?php echo $registration_time; ?></p>

    <button id="downloadPdf" class="btn blue">Download PDF</button>
    <a href="dashboard.php" class="btn grey">Back to Dashboard</a>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
document.getElementById('downloadPdf').addEventListener('click', () => {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    doc.setFontSize(16);
    doc.text("Registration Confirmation Slip", 20, 20);
     doc.setFontSize(12);
    doc.text("Full Name: <?php echo $student['full_name']; ?>", 20, 40);
    doc.text("Student ID: <?php echo $student['student_id']; ?>", 20, 50);
    doc.text("Course: <?php echo $student['course_of_study']; ?>", 20, 60);
    doc.text("Status: <?php echo $student['status']; ?>", 20, 70);
    doc.text("Registration Timestamp: <?php echo $registration_time; ?>", 20, 80);

    doc.save("Registration_Slip_<?php echo $student['student_id']; ?>.pdf");
});
</script>
</body>
</html>