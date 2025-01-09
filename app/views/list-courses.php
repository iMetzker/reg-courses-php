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
    <link rel="stylesheet" href="../styles/styles.scss">
</head>

<body>
    <div class="fluid-container d-flex justify-content-center align-items-center flex-column  mt-5">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../../index.php">Início</a></li>
                <li class="breadcrumb-item active" aria-current="page">Listar Cursos</li>
            </ol>
        </nav>

        <h2>Mini Cursos Alfa Unipac</h2>
        
         <!-- <div class="col-md-12" id="all-courses">
            <table class="table">
                <thead>
                    <th scope="col">Cursos</th>
                    <th scope="col">Vagas</th>
                    <th scope="col">Disponibilidade</th>
                    <th scope="col">Inscrever-se</th>
                    <th scope="col">Modificações</th>
                </thead>

                <tbody>
                    <?php foreach ($allCourses as $course): ?>
                        <tr>
                            <td scope="row"><?= $course->name ?></td>
                            <td scope="row"><?= $course->vacancies ?></td>
                            <td scope="row"><?php
                                            if ($course->open === 1) {
                                                echo "Aberto";
                                            } else {
                                                echo "Fechado";
                                            }
                                            ?>
                            </td>
                            <td scope="row" class="fs-4 icon-list"><a href="<?= $BASE_URL ?>add-student.php?id=<?= $course->id ?>"><i class="bi bi-person-add"></i></a></td>
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
        </div> -->
        <div class="container">
            <div class="d-flex justify-content-center flex-row flex-wrap gap-5 mt-5">
                <?php foreach ($allCourses as $course): ?>
                    <div class="card">
                    <img src="../assets/img/1.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?= $course->name ?></h5>
                            <div class="card-text card-description mb-2" title="<?php echo str_replace("&nbsp;", "&#13• ",strip_tags($course->description)); ?>"><?= $course->description ?></div>
                            <div class="d-flex card-text align-items-center gap-1">
                                <i class="bi bi-file-person-fill"></i>
                                <h6 class="card-title mb-0 ">Prof. Ministrante: Faozi Figueiredo</h6>
                            </div>
                            <div class="mt-2">
                                <div class="d-flex card-text align-items-center gap-1">
                                <i class="bi bi-calendar3"></i>
                                <h6 class="card-title mb-0 ">12/01/2025 às 14h</h6>
                                </div>
                            </div>
                            <div class="d-flex card-text align-items-center gap-1 mt-2">
                                <i class="bi bi-clock-history"></i>
                                <h6 class="card-title mb-0 ">Duração: 8h</h6>
                                </div>
                            <p class="card-text mt-2">
                                <b class="fs-3"><?= $course->vacancies ?></b>
                                Vagas
                            </p>
                            <footer class="blockquote-footer">
                                <?php
                                    if ($course->open === 1) {
                                        echo "28 vagas restantes";
                                    } else {
                                        echo "Vagas esgotadas";
                                    }
                                ?> 
                            </footer>
                                <?php 
                                if($course->open === 1) {
                                    echo "<a class=\"card-text card-icon fs-4\" href=\"<?= $BASE_URL ?>add-student.php?id=<?= $course->id ?>\">Inscrever-se <i class=\"bi bi-person-add\"></i></a>";
                                }
                                ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
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