<?php
session_start();
require_once "../includes/db.php";

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Rolü email uzantısına göre belirle
    if (str_ends_with($email, '@hello.edu.tr')) {
        $role = 'ogrenci';
    } else {
        $role = 'firma';
    }

    // DB'den kullanıcıyı çek
    $stmt = $conn->prepare("SELECT * FROM users WHERE email=? AND role=?");
    $stmt->bind_param("ss", $email, $role);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        if ($role === 'ogrenci') {
            $_SESSION['ogrenci_id'] = $user['id'];
            $_SESSION['ogrenci_name'] = $user['name'];
            header("Location: ../ogrenci/dashboard.php");
            exit;
        } else {
            $_SESSION['firma_id'] = $user['id'];
            $_SESSION['firma_name'] = $user['name'];
            header("Location: ../firma/dashboard.php");
            exit;
        }
    } else {
        $message = "Email veya şifre yanlış!";
    }
}

$page_title = "Giriş Yap";
include "../includes/header.php";
?>



<div class="page page-center">
    <div class="container container-tight py-4">
        <form class="card card-md" action="" method="post" autocomplete="off">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Giriş Yap</h2>
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
