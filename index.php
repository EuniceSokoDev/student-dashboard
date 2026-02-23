<!DOCTYPE html>
<html>
<head>
    <title>Student Registration System</title>
    <!-- Materialize CSS for Material Design styling -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>
<body>
    <div class="container">
        <h2 class="center-align">Welcome to the Student Registration System</h2>

        <div class="row" style="margin-top:50px;">
            <!-- Register Student -->
            <div class="col s12 m6">
                <div class="card blue lighten-3">
                    <div class="card-content white-text">
                        <span class="card-title">Register Student</span>
                        <p>Add a new student to the system.</p>
                    </div>
                    <div class="card-action">
                        <a href="register.php" class="white-text">Go to Form</a>
                    </div>
                </div>
            </div>

            <!-- Student Dashboard -->
            <div class="col s12 m6">
                <div class="card green lighten-3">
                    <div class="card-content white-text">
                        <span class="card-title">Student Dashboard</span>
                        <p>View, update, or delete student records.</p>
                    </div>
                    <div class="card-action">
                        <a href="dashboard.php" class="white-text">Go to Dashboard</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Optional footer -->
        <footer class="page-footer grey lighten-2">
            <div class="container center-align">
                &copy; <?php echo date("Y"); ?> Student Registration System
            </div>
        </footer>
    </div>
</body>
</html>