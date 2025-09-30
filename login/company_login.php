<?php

/*echo password_hash("company123", PASSWORD_DEFAULT);*/

session_start();
require_once "../includes/db.php";

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Firma rolü kontrolü
    $stmt = $conn->prepare("SELECT * FROM users WHERE email=? AND role='firma'");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $firma = $result->fetch_assoc();

    if ($firma && password_verify($password, $firma['password'])) {
        $_SESSION['firma_id'] = $firma['id'];
        $_SESSION['firma_name'] = $firma['name'];
        header("Location: ../firma/dashboard.php"); // firma paneli
        exit;
    } else {
        $message = "Email veya şifre yanlış!";
    }
}

$page_title = "Firma Giriş";
include "../includes/header.php";
?>

<div class="page page-center">
    <div class="container container-tight py-4">
        <form class="card card-md" action="" method="post" autocomplete="off">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Firma Giriş</h2>
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
