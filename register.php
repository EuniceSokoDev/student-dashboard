<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Register New Student</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>
<body>
<div class="container">
    <h3 class="center-align">Register New Student</h3>
   
    <form action="process_register.php" method="post">
        <div class="input-field">
            <input type="text" name="full_name" required>
            <label>Full Name</label>
        </div>
        <div class="input-field">
            <input type="text" name="student_id" required>
            <label>Student ID</label>
        </div>
        <div class="input-field">
            <input type="email" name="email" required>
            <label>Email</label>
        </div>
        <div class="input-field">
            <input type="date" name="date_of_birth" required>
            <label class="active">Date of Birth</label>
        </div>
        <div class="input-field">
             <input type="text" name="course_of_study" required>
            <label>Course of Study</label>
        </div>
        <div class="input-field">
            <input type="date" name="enrollment_date" required>
            <label class="active">Enrollment Date</label>
        </div>
        <div class="input-field">
            <select name="status" required>
                <option value="" disabled selected>Choose status</option>
                <option value="Active">Active</option>
                <option value="Pending">Pending</option>
                <option value="Inactive">Inactive</option>
            </select>
            <label>Status</label>
        </div>
        <button class="btn green" type="submit">Register</button>
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