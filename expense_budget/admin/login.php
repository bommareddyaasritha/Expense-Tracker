<?php 
require_once('../config.php');
$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    if (empty($username)) {
        $errors[] = "Email is required.";
    }
    if (empty($password)) {
        $errors[] = "Password is required.";
    }
    if (empty($errors)) {
        require_once('../classes/Login.php');
        $login = new Login();
        // Try admin login first
        $response = json_decode($login->login(), true);
        if ($response['status'] == 'success') {
            header("Location: home.php");
            exit;
        } else {
            // Try general user login
            $_POST['email'] = $username; // set email for login_user method
            $_POST['password'] = $password;
            $response = json_decode($login->login_user(), true);
            if ($response['status'] == 'success') {
                header("Location: home.php");
                exit;
            } else {
                $errors[] = "Incorrect email or password.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
<?php require_once('inc/header.php') ?>

<body class="hold-transition login-page bg-navy">
    <script>
    start_loader()
    </script>
    <h2 class="text-center mb-4 pb-3"><?php echo $_settings->info('name') ?></h2>
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-body">
                <p class="login-box-msg text-dark">Sign in to start your session</p>
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?php echo htmlspecialchars($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <form id="login-frm" action="" method="post">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="username" placeholder="Email" autofocus value="<?php echo isset($username) ? htmlspecialchars($username) : '' ?>" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-conten-center">
                        <!-- /.col -->
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        <!-- /.col -->
                    </div>
                </form>
                <p class="mb-1 mt-3">
                    <a href="register.php">Register a new membership</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>

    <script>
    $(document).ready(function() {
        end_loader();
    })
    </script>
</body>

</html>
