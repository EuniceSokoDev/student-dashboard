<?php
include 'db.php';

// Define constants for status
define("STATUS_ACTIVE", "Active");
define("STATUS_PENDING", "Pending");
define("STATUS_INACTIVE", "Inactive");

// Get student_id from GET
if (!isset($_GET['student_id'])) {
    die("Student ID not provided.");
}

$student_id = $_GET['student_id'];

// Fetch current student data
$stmt = $conn->prepare("SELECT * FROM students WHERE student_id = ?");
$stmt->bind_param("s", $student_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    die("Student not found.");
}

$student = $result->fetch_assoc();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $date_of_birth = $_POST['date_of_birth'];
    $course_of_study = trim($_POST['course_of_study']);
    $enrollment_date = $_POST['enrollment_date'];
    $status = $_POST['status'];

    // Validation
    $errors = [];
    if (empty($full_name)) $errors[] = "Full Name is required";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email format";
    if (empty($course_of_study)) $errors[] = "Course of Study is required";

    if (count($errors) === 0) {
        // Update student info securely
        $update = $conn->prepare("UPDATE students SET full_name=?, email=?, date_of_birth=?, course_of_study=?, enrollment_date=?, status=? WHERE student_id=?");
        $update->bind_param("sssssss", $full_name, $email, $date_of_birth, $course_of_study, $enrollment_date, $status, $student_id);

        if ($update->execute()) {
            echo "<p style='color:green;'>Student updated successfully!</p>";
            echo "<p><a href='profile.php?student_id=student_id'>View Profile</a></p>";
        } else {
            echo "<p style='color:red;'>Error: " . $update->error . "</p>";
        }
        $update->close();
    } else {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
}

$stmt->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Student</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>
<body>
<div class="container">
    <h3 class="center-align">Update Student Information</h3>

    <form method="post">
        <div class="input-field">
            <input type="text" name="full_name" value="<?php echo htmlspecialchars($student['full_name']); ?>" required>
            <label class="active">Full Name</label>
        </div>

        <div class="input-field">
            <input type="email" name="email" value="<?php echo htmlspecialchars($student['email']); ?>" required>
            <label class="active">Email</label>
        </div>

        <div class="input-field">
            <input type="date" name="date_of_birth" value="<?php echo htmlspecialchars($student['date_of_birth']); ?>" required>
            <label class="active">Date of Birth</label>
        </div>

        <div class="input-field">
            <input type="text" name="course_of_study" value="<?php echo htmlspecialchars($student['course_of_study']); ?>" required>
            <label class="active">Course of Study</label>
        </div>

        <div class="input-field">
            <input type="date" name="enrollment_date" value="<?php echo htmlspecialchars($student['enrollment_date']); ?>" required>
            <label class="active">Enrollment Date</label>
        </div>

        <div class="input-field">
            <select name="status" required>
                <option value="Active" <?php if($student['status']=='Active') echo 'selected'; ?>>Active</option>
                <option value="Pending" <?php if($student['status']=='Pending') echo 'selected'; ?>>Pending</option>
                <option value="Inactive" <?php if($student['status']=='Inactive') echo 'selected'; ?>>Inactive</option>
            </select>
            <label>Status</label>
        </div>

        <button class="btn waves-effect waves-light" type="submit">Update Student</button>
        <a href="dashboard.php" class="btn grey">Back to Dashboard</a>
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('select');
        M.FormSelect.init(elems);
    });
</script>
</body>
</html>