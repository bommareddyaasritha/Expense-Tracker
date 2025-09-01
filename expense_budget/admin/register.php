<?php 
require_once('../config.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $errors = [];

    if (empty($firstname)) {
        $errors[] = "First name is required.";
    }
    if (empty($lastname)) {
        $errors[] = "Last name is required.";
    }
    if (empty($username)) {
        $errors[] = "Email (username) is required.";
    } elseif (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
    if (empty($password)) {
        $errors[] = "Password is required.";
    }
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    if (empty($errors)) {
        // Check if username already exists
        $check = $conn->query("SELECT * FROM users WHERE username = '{$conn->real_escape_string($username)}'");
        if ($check->num_rows > 0) {
            $errors[] = "Email is already registered.";
        } else {
            // Insert new user with type=0 (general user)
            $hashed_password = md5($password);
            $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, username, password, type, date_added) VALUES (?, ?, ?, ?, 0, NOW())");
            $stmt->bind_param("ssss", $firstname, $lastname, $username, $hashed_password);
if ($stmt->execute()) {
    $new_user_id = $stmt->insert_id;
    // Initialize budgets with zero amount for all categories for the new user
    $categories = $conn->query("SELECT id FROM categories WHERE status = 1");
    while ($cat = $categories->fetch_assoc()) {
        $cat_id = $cat['id'];
        $conn->query("INSERT INTO running_balance (user_id, category_id, amount, balance_type, remarks, date_created) VALUES ('{$new_user_id}', '{$cat_id}', 0, 1, 'Initial budget', NOW())");
    }
    header("Location: login.php?registered=1");
    exit;
} else {
    $errors[] = "Registration failed. Please try again.";
}
            $stmt->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php require_once('inc/header.php') ?>
<body class="hold-transition register-page bg-navy">
    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="#" class="h1"><?php echo $_settings->info('name') ?></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg text-dark">Register a new membership</p>
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?php echo htmlspecialchars($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <form action="" method="post" id="register-form">
                    <div class="input-group mb-3">
                        <input type="text" name="firstname" class="form-control" placeholder="First name" value="<?php echo isset($firstname) ? htmlspecialchars($firstname) : '' ?>" required>
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-user"></span></div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="lastname" class="form-control" placeholder="Last name" value="<?php echo isset($lastname) ? htmlspecialchars($lastname) : '' ?>" required>
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-user"></span></div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" name="username" class="form-control" placeholder="Email" value="<?php echo isset($username) ? htmlspecialchars($username) : '' ?>" required>
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-lock"></span></div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="confirm_password" class="form-control" placeholder="Retype password" required>
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-lock"></span></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <a href="login.php" class="text-center">I already have a membership</a>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
</body>
</html>
