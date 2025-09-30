<?php

echo password_hash("123456", PASSWORD_DEFAULT);


session_start();
require_once "../includes/db.php";

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']); // kullanıcı sadece baş kısmı yazacak
    $email = $username . "@example.com";  // email tamamlanıyor

    $password = $_POST['password'];

    // Sadece öğrenciler için sorgu
    $stmt = $conn->prepare("SELECT * FROM users WHERE email=? AND role='ogrenci'");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $ogrenci = $result->fetch_assoc();

    if ($ogrenci && password_verify($password, $ogrenci['password'])) {
        $_SESSION['ogrenci_id'] = $ogrenci['id'];
        $_SESSION['ogrenci_name'] = $ogrenci['name'];
        header("Location: ../ogrenci/dashboard.php"); // öğrenci paneli
        exit;
    } else {
        $message = "Email veya şifre yanlış!";
    }
}

$page_title = "Öğrenci Giriş";
include "../includes/header.php";
?>

<div class="page page-center">
    <div class="container container-tight py-4">
        <form class="card card-md" action="" method="post" autocomplete="off">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Öğrenci Giriş</h2>
                <?php if($message): ?>
                    <div class="alert alert-danger"><?php echo $message; ?></div>
                <?php endif; ?>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="username" required placeholder="kullanıcı adınız">
                        <span class="input-group-text">@example.com</span>
                    </div>
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
