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
      <a href="#" class="navbar-brand">
        <span class="navbar-brand-text">Staj Sistemi</span>
      </a>
      <div class="navbar-nav flex-row order-md-last">
        <a href="sc_login.php" class="nav-link">Oturum Aç</a>
        <a href="register.php" class="btn btn-primary ms-2">Kayıt Ol</a>
      </div>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="#">Firmalar</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Staj İlanları</a></li>
        </ul>
      </div>
    </div>
  </header>
  