<?php
include 'db.php'; // database connection

// Fetch students from database
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

$sql = "SELECT * FROM students";
if ($search != '') {
    $sql .= " WHERE full_name LIKE ? OR student_id LIKE ? OR course_of_study LIKE ? OR status LIKE ?";
}
$sql .= " ORDER BY full_name ASC";

$stmt = $conn->prepare($sql);
if ($search != '') {
    $likeSearch = "%$search%";
    $stmt->bind_param("ssss", $likeSearch, $likeSearch, $likeSearch, $likeSearch);
}
$stmt->execute();
$result = $stmt->get_result();
$students = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style>
        body {
            background-color: #73c2feff;
        }
        .sidebar {
            background-color: #b22aa9ff;
            min-height: 100vh;
            padding: 20px;
            color: white;
            width: 220px;
            float: left;
        }
        .content {
            margin-left: 240px;
            padding: 20px;
        }
        .students-table {
            width: 100%;
            border-collapse: collapse;
            background: #fd7e7eff;
            border-radius: 10px;
            overflow: hidden;
        }
        .students-table th, .students-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        .students-table th {
            background: #b23ba0ff;
            color: white;
        }
        .btn-action {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h4>Student Management</h4>
        <ul>
           
            <li><a href="dashboard.php" style="color:white;">Dashboard</a></li>
             <li><a href="register.php" style="color:white;">Register Student</a></li>
            <li><a href="reports.php" style="color:white;">Reports</a></li>
        </ul>
    </div>

    <div class="content">
        <h3>Student Dashboard</h3>
        <form method="GET">
            <input type="text" name="search" placeholder="Search by Name, ID, Course, or Status" value="<?php echo htmlspecialchars($search); ?>" class="light grey">
            <button type="submit" class="btn light purple">Search</button>
        </form>
        <br>
        <?php if(count($students) > 0): ?>
        <table class="students-table">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Student ID</th>
                    <th>Email</th>
                    <th>Course</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($students as $s): ?>
                <tr>
                    <td><?php echo htmlspecialchars($s['full_name']); ?></td>
                    <td><?php echo htmlspecialchars($s['student_id']); ?></td>
                    <td><?php echo htmlspecialchars($s['email']); ?></td>
                    <td><?php echo htmlspecialchars($s['course_of_study']); ?></td>
                    <td><?php echo htmlspecialchars($s['status']); ?></td>
                    <td>
                        <a href="profile.php?student_id=<?php echo $s['student_id']; ?>" class="btn green btn-action">View</a>
                        <a href="update_student.php?student_id=<?php echo $s['student_id']; ?>" class="btn orange btn-action">Update</a>
                        <a href="delete_student.php?student_id=<?php echo $s['student_id']; ?>" class="btn red btn-action" onclick="return confirm('Are you sure you want to delete this student?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
            <p>No students found.</p>
        <?php endif; ?>
    </div>
</body>
</html>