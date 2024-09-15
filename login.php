<?php
include_once 'classes/Database.php';
include_once 'classes/User.php';

session_start();

$database = new Database();

$user = new User($database);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user->username = $_POST['username'];
    $user->password = $_POST['password'];

    if ($user->login()) {
        $_SESSION['user_id'] = $user->id;

        header("Location: gallery-upload.php");
        exit();
    } else {
        $error = "Invalid login credentials.";
    }
}

if (isset($_GET['logout'])) {
    $user->logout();
}

if(isset($_SESSION['username'])){
    header("Location: gallery-upload.php");
    exit();
}

?>
<?php
    include_once('includes/header.php')
?>
        <!-- Hero Start -->
        <div class="sub-header">
            <h1>Login</h1>
        </div>
        <!-- Hero End -->


        <!-- Contact Start -->
        <form action="login.php" method="POST">
            <div class="container-fluid contact py-0">
                <div class="container py-5 login-container">
                    <div class="text-center mx-auto mb-5 wow fadeIn" data-wow-delay="0.1s" style="max-width: 700px;">
                        <p class="display-6">Please enter your login details</p>
                        <?php if (isset($error)) { echo "<p>$error</p>"; } ?>
                    </div>
                    <div class="row g-4 wow fadeIn" data-wow-delay="0.3s">
                        <div class="col-sm-12">
                            <input type="text" class="form-control bg-transparent p-3" placeholder="Your Email" name="username" id="username" required>
                        </div>
                        <div class="col-12">
                            <input type="password" class="form-control bg-transparent p-3" placeholder="Password" name="password" id="password" required>
                        </div>
                        <div class="col-12 text-center">
                            <button class="btn btn-primary border-0 py-3 px-5" type="submit">Login</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- Contact Start -->

<?php
    include_once('includes/footer.php')
?>