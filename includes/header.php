<?php
session_start();
/*var_dump($_SESSION); */ // debug için


// Login sayfasının yolu
$login_page = "/staj/login/sc_login.php";
$register_page = "register.php";

// Eğer hali hazırda sc_login.php içindeysek linki sadece '#' yap
$current_file = basename($_SERVER['PHP_SELF']);
if ($current_file == "sc_login.php") {
    $login_page = "#"; // veya boş, sayfanın reload olmasını istemiyorsan
}

?>



<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title : "Staj Sistemi"; ?></title>

    <!-- Tabler CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.4.0/dist/css/tabler.min.css" />
</head>
<body class="antialiased border-top-wide border-primary d-flex flex-column">

<!-- Header -->
<header class="navbar navbar-expand-md navbar-light bg-light">
  <div class="container-xl">
    <a href="/staj/index.php" class="navbar-brand">
      <span class="navbar-brand-text">Staj Sistemi</span>
    </a>

    <div class="navbar-nav flex-row order-md-last">
  <?php if (isset($_SESSION['ogrenci_id']) || isset($_SESSION['firma_id'])): ?>
    <!-- Giriş yapıldıysa -->
    <a href="logout.php" class="btn btn-danger ms-2">Çıkış Yap</a>
  <?php else: ?>
    <!-- Giriş yapılmadıysa -->
    <a href="<?php echo $login_page; ?>" class="nav-link">Oturum Aç</a>

    <!-- Kayıt Ol Dropdown -->
    <div class="dropdown ms-2">
      <button class="btn btn-primary dropdown-toggle" type="button" id="registerDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        Kayıt Ol
      </button>
      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="registerDropdown">
        <li><a class="dropdown-item" href="/staj/register/student_register.php">Öğrenci Kayıt</a></li>
        <li><a class="dropdown-item" href="/staj/register/company_register.php">Firma Kayıt</a></li>
      </ul>
    </div>
  <?php endif; ?>
</div>



    <div class="collapse navbar-collapse">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="<?php echo isset($_SESSION['firma_id']) || isset($_SESSION['ogrenci_id']) ? 'firmalar.php' : '/staj/login/sc_login.php'; ?>">
            Firmalar
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo isset($_SESSION['firma_id']) || isset($_SESSION['ogrenci_id']) ? 'staj_ilanlari.php' : '/staj/login/sc_login.php'; ?>">
            Staj İlanları
          </a>
        </li>
      </ul>
    </div>
  </div>
</header>
