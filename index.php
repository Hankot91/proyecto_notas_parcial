<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="views/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="views/css/stylesIndex.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="icon" type="image/x-icon" href="views/img/favicon.svg">

  <title>SIAU 2.0</title>
</head>

<body>
  <header class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/index.php">INICIO</a>
    <?php require_once "views/header.php"; ?>
  </header>


  <main class="container mt-4 ">
    <div class="d-flex justify-content-center" style="margin-top: 40vh;">
      <div class="d-flex">
        <a href="/views/estudiantes_view.php" class="btn btn-primary me-3 ms-md-auto">Estudiantes <i
            class="fa-solid fa-eye" style="color: #ffffff;"></i></a>
      </div>
      <div class="d-flex">
        <a href="/views/cursos_view.php" class="btn btn-primary me-3 ms-md-auto">Cursos <i
            class="fa-solid fa-book"></i></a>
      </div>
      <div class="d-flex">
        <a href="/views/inscripciones_view.php" class="btn btn-primary me-3 ms-md-auto">Inscripciones <i
            class="fa-regular fa-pen-to-square" style="color: #ffffff;"></i></a>
      </div>
      <div class="d-flex">
        <a href="views/estudiantes_view.php?register=true" class="btn btn-primary me-3 ms-md-auto">Crear estudiante <i
            class="fa-solid fa-circle-plus"></i></a>
      </div>
      <div class="d-flex">
        <a href="views/cursos_view.php?register=true" class="btn btn-primary me-3 ms-md-auto">Agregar curso <i
            class="fa-solid fa-bookmark fa-lg" style="color: #ffffff;"></i></a>
      </div>
    </div>
  </main>
  <script src="views/js/bootstrap/popper.min.js"></script>
  <script src="views/js/bootstrap/bootstrap.min.js"></script>
  <?php require_once "views/footer.php"?>