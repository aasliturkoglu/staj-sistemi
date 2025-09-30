<?php
/*var_dump(password_verify("admin123", "$2y$10$XusO2bgQsGnCnecm4lPY3OXM03zHdXD9tYdW7hImgeREtMeh81zAG"));*/

/** şifre hash */
/**echo password_hash("admin123", PASSWORD_DEFAULT);**/




session_start();
require_once "../includes/db.php";

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=? AND role='admin'");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_name'] = $admin['name'];
        header("Location: ../admin/dashboard.php");
        exit;
    } else {
        $message = "Email veya şifre yanlış!";
    }
}

$page_title = "Admin Giriş";
include "../includes/header.php";
?>

<div class="page page-center">
    <div class="container container-tight py-4">
        <form class="card card-md" action="" method="post" autocomplete="off">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Admin Giriş</h2>
                <?php if($message): ?>
                    <div class="alert alert-danger"><?php echo $message; ?></div>
                <?php endif; ?>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="mb-2">
                    <label class="form-label">Şifre</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Giriş Yap</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include "../includes/footer.php"; ?>
