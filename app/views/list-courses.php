<?php
require_once("../../db.php");
require_once("../dao/CourseDAO.php");

$courseDAO = new CourseDAO($connect, $BASE_URL);
$allCourses = $courseDAO->getAllCourses();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Mini Cursos</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- BOOTSTRAP ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- STYLES -->
    <link rel="stylesheet" href="../styles/styles.css">
</head>

<body>
    <div class="fluid-container d-flex justify-content-center align-items-center flex-column  mt-5">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../../index.php">Início</a></li>
                <li class="breadcrumb-item active" aria-current="page">Listar Cursos</li>
            </ol>
        </nav>

        <ul class="nav nav-tabs mb-5">
            <li class="nav-item">
                <a class="nav-link" href="?page=student">Painel do Aluno</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?page=adm">Painel Adm</a>
            </li>
        </ul>

        <h2>Mini Cursos Alfa Unipac</h2>

        <?php
        switch (@$_REQUEST["page"]) {
            case "student":
                include("./list-course-student.php");
                break;

            case "adm":
                include("./list-course-adm.php");
                break;

            default:
                echo "
            <div class=\"spinner-border mt-5\" role=\"status\">
                <span class=\"visually-hidden\">Loading...</span>
            </div> ";
        }
        ?>


    </div>

    <!-- BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</body>

</html>