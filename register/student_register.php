<?php
session_start();
require_once "../includes/db.php";

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']); // isim ve soyisim
    $surname = trim($_POST['surname']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Mail kontrolü
    if (!str_ends_with($email, '@hello.edu.tr')) {
        $message = "Sadece hello.edu.tr uzantılı e-posta kabul edilir!";
    } else {
        // Email daha önce kayıtlı mı kontrol et
        $stmt = $conn->prepare("SELECT id FROM users WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $message = "Bu e-posta zaten kayıtlı!";
        } else {
            // Şifreyi hashle
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $full_name = $name . ' ' . $surname;

            // users tablosuna ekle
            $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'ogrenci')");
            $stmt->bind_param("sss", $full_name, $email, $hashed_password);

            if ($stmt->execute()) {
                $user_id = $conn->insert_id;

                // students tablosuna ekle
                $stmt2 = $conn->prepare("INSERT INTO students (user_id) VALUES (?)");
                $stmt2->bind_param("i", $user_id);
                $stmt2->execute();

                // Oturum aç
                $_SESSION['ogrenci_id'] = $user_id;
                $_SESSION['ogrenci_name'] = $full_name;

                header("Location: ../ogrenci/dashboard.php");
                exit;
            } else {
                $message = "Kayıt sırasında bir hata oluştu!";
            }
        }
    }
}
?>

<?php $page_title = "Öğrenci Kayıt"; include "../includes/header.php"; ?>

<div class="page page-center">
    <div class="container container-tight py-4">
        <form class="card card-md" action="" method="post" autocomplete="off">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Öğrenci Kayıt</h2>
                <?php if($message): ?>
                    <div class="alert alert-danger"><?php echo $message; ?></div>
                <?php endif; ?>

                <div class="mb-3">
                    <label class="form-label">İsim</label>
                    <input type="text" class="form-control" name="name" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Soyisim</label>
                    <input type="text" class="form-control" name="surname" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">E-posta</label>
                    <input type="email" class="form-control" name="email" placeholder="hello@hello.edu.tr" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Şifre</label>
                    <input type="password" class="form-control" name="password" required>
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Kayıt Ol</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include "../includes/footer.php"; ?>
