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
</head>

<body>
    <div class="fluid-container d-flex justify-content-center align-items-center vh-100 flex-column">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../../index.php">Início</a></li>
                <li class="breadcrumb-item active" aria-current="page">Listar Cursos</li>
            </ol>
        </nav>

        <h2>Mini Cursos Cadastrados</h2>

        <div class="col-md-12" id="all-courses">
            <table class="table">
                <thead>
                    <th scope="col">Cursos Disponíveis</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Vagas</th>
                    <th scope="col">Disponibilidade</th>
                    <th scope="col">Inscrever-se</th>
                    <th scope="col">Modificações</th>
                </thead>

                <tbody>
                    <?php foreach ($allCourses as $course): ?>
                        <tr>
                            <td scope="row"><?= $course->name ?></td>
                            <td scope="row"><?= $course->description ?></td>
                            <td scope="row"><?= $course->vacancies ?></td>
                            <td scope="row"><?= $course->open ?></td>
                            <td scope="row"><a href="<?= $BASE_URL ?>add-student.php?id=<?= $course->id ?>"><i class="bi bi-person-add"></i></a></td>
                            <td scope="row">
                                <a href="<?= $BASE_URL ?>updte-courses.php?id=<?= $course->id ?>"><i class="bi bi-pencil-square"></i></a>
                                <form action="<?= $BASE_URL ?>add-course_process.php" method="POST">
                                    <input type="hidden" name="type" value="delete">
                                    <input type="hidden" name="id" value="<?= $course->id ?>">
                                    <button type="submit" class="delete-btn">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>


    </div>

    <!-- BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    <!-- SWEET ALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>

?>