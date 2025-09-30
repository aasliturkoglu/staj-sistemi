<?php
$page_title = "Ana Sayfa";
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $page_title; ?></title>
  <!-- Tabler CSS -->
  <link href="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/css/tabler.min.css" rel="stylesheet">
</head>
<body>

<?php include "includes/header.php"; ?>

<!-- Hero -->
<div class="page-wrapper">
  <div class="page-body">
    <div class="container-xl">
      <div class="card card-cover h-100 overflow-hidden text-white bg-dark rounded-3 shadow-lg" 
           style="background-image: url('assets/hero-bg.jpg'); background-size: cover; background-position: center;">
        <div class="d-flex flex-column p-5 text-center">
          <h1 class="display-4 fw-bold">Stajını Bul, Geleceğini Kur</h1>
          <p class="lead">Firmalarla öğrencileri bir araya getiren en kolay staj platformu</p>
          <div class="mt-3">
            <!--<a href="student_register.php" class="btn btn-success btn-lg me-2">Öğrenci Kayıt</a>
            <a href="company_register.php" class="btn btn-primary btn-lg">Firma Kayıt</a>-->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include "footer.php"; ?>

<!-- Tabler JS -->
<script src="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/js/tabler.min.js"></script>
</body>
</html>
