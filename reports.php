<?php
include 'db.php';

// Fetch all students
$sql = "SELECT * FROM students ORDER BY full_name ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Student Reports</title>
<style>
    body { font-family: Arial, sans-serif; margin: 0; }
    .wrapper { display: flex; min-height: 100vh; }
    .sidebar {
        width: 220px; background-color: #6a0dad; color: white; padding: 20px;
    }
    .sidebar ul { list-style: none; padding: 0; }
    .sidebar ul li { margin-bottom: 15px; }
    .sidebar ul li a { color: white; text-decoration: none; font-weight: bold; }
    .main-content { flex: 1; padding: 20px; background-color: #59afe4ff; }
    h2 { margin-top: 0; }
    table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
    th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
    th { background-color: #6a0dad; color: white; }
    .print-btn { padding: 8px 12px; background-color: #6a0dad; color: white; border: none; border-radius: 6px; cursor: pointer; }
    .print-btn:hover { background-color: #4b007f; }
</style>
</head>
<body>
<div class="wrapper">
    <div class="sidebar">
        <h2>Admin </h2>
        <ul>
        
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="reports.php">Reports</a></li>
        </ul>
    </div>

    <div class="main-content">
        <h2>Student Reports</h2>

        <?php if ($result->num_rows > 0): ?>
            <button class="print-btn" onclick="window.print()">Print Report</button>

            <h3>Profile Summary Report</h3>
            <table>
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Student ID</th>
                        <th>Email</th>
                        <th>DOB</th>
                        <th>Course</th>
                        <th>Enrollment Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['student_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['date_of_birth']); ?></td>
                            <td><?php echo htmlspecialchars($row['course_of_study']); ?></td>
                            <td><?php echo htmlspecialchars($row['enrollment_date']); ?></td>
                            <td><?php echo htmlspecialchars($row['status']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <h3>Registration Confirmation Slip</h3>
            <table>
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Full Name</th>
                        <th>Registration Timestamp</th>
                        <th>Course</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Reset result pointer to fetch rows again
                    $result->data_seek(0);
                    while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['student_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['enrollment_date']); ?></td>
                            <td><?php echo htmlspecialchars($row['course_of_study']); ?></td>
                            <td><?php echo htmlspecialchars($row['status']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

        <?php else: ?>
            <p>No student data available.</p>
        <?php endif; ?>

    </div>
</div>
</body>
</html>

<?php $conn->close(); ?>