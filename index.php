<?php
require_once("./db.php");

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de cursos</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="fluid-container d-flex justify-content-center align-items-center vh-100 flex-column">
        <h1>Página inicial de mini cursos</h1>

        <div class="container d-flex justify-content-center gap-4">
        <a href="?page=new-course">Adicionar curso</a>
        <a href="?page=list-courses">Listar mini cursos</a>
        </div>
    </div>

    <?php 
    if (isset($_GET['page'])) {
        $page = $_GET['page'];

        switch ($page) {
            case "new-course":
                header("Location: app/views/add-courses.php");
                break;
            case "add-student":
                header("Location: app/views/add-student.php");
                break;
            case "list-courses":
                header("Location: app/views/list-courses.php");
                break;
            default:
            header("Location: index.php");
        }
    }
    ?>

    <!-- BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</body>
</html>