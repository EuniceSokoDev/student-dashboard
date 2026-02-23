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
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile Summary</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>
<body>
<div class="container">
    <h3>Profile Summary</h3>
    <p><strong>Full Name:</strong> <?php echo htmlspecialchars($student['full_name']); ?></p>
    <p><strong>Student ID:</strong> <?php echo htmlspecialchars($student['student_id']); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($student['email']); ?></p>
    <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($student['date_of_birth']); ?></p>
    <p><strong>Course:</strong> <?php echo htmlspecialchars($student['course_of_study']); ?></p>
    <p><strong>Enrollment Date:</strong> <?php echo htmlspecialchars($student['enrollment_date']); ?></p>
    <p><strong>Status:</strong> <?php echo htmlspecialchars($student['status']); ?></p>

    <button id="downloadPdf" class="btn blue">Download PDF</button>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
document.getElementById('downloadPdf').addEventListener('click', () => {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    doc.setFontSize(16);
    doc.text("Student Profile Summary", 20, 20);

    doc.setFontSize(12);
    doc.text("Full Name: <?php echo $student['full_name']; ?>", 20, 40);
    doc.text("Student ID: <?php echo $student['student_id']; ?>", 20, 50);
    doc.text("Email: <?php echo $student['email']; ?>", 20, 60);
    doc.text("Date of Birth: <?php echo $student['date_of_birth']; ?>", 20, 70);
    doc.text("Course: <?php echo $student['course_of_study']; ?>", 20, 80);
    doc.text("Enrollment Date: <?php echo $student['enrollment_date']; ?>", 20, 90);
    doc.text("Status: <?php echo $student['status']; ?>", 20, 100);

    doc.save("Profile_Summary_<?php echo $student['student_id']; ?>.pdf");
});
</script>
</body>
</html>
