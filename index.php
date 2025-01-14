<?php
require_once("./db.php");
require_once("./app/dao/CourseDAO.php");
require_once("./app/models/message.php");

$courseDAO = new CourseDAO($connect, $BASE_URL);
$allCourses = $courseDAO->getAllCourses();
$totalCourses = $courseDAO->getTotalCourses();

$message = new Message($BASE_URL);
$msg = $message->getMessage();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-store" />
    <title>Listagem de Mini Cursos</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- BOOTSTRAP ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- STYLES -->
    <link rel="stylesheet" href="./app/styles/styles.scss">
</head>


<body>
    <div class="d-flex justify-content-center align-items-center flex-column">
        <?php
        switch (@$_REQUEST["page"]) {
            case "student":
                include("./app/views/list-course-student.php");
                break;

            case "adm":
                include("./app/views/list-course-adm.php");
                break;

            default:
                echo "
                    <div class=\" d-flex flex-column justify-content-center align-items-center min-vh-100 \">
                        <h1>Página inicial de mini cursos</h1>
                        <ul class=\"nav mb-5\">
                            <li class=\"nav-item\">
                                <a class=\"nav-link\" href=\"?page=student\">Painel do Aluno</a>
                            </li>
                            <li class=\"nav-item\">
                                <a class=\"nav-link\" href=\"?page=adm\">Painel do Administrador</a>
                            </li>
                        </ul>
                    </div>";
        }
        ?>


    </div>

    <!-- BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    <!-- SWEET ALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(event) {
            event.preventDefault();

            Swal.fire({
                title: "Tem certeza que deseja excluir este curso?",
                text: "Você não poderá reverter esta ação!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sim, excluir!"
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.submit();
                }
            });

        }
    </script>

    <?php if ($msg): ?>
        <script>
            Swal.fire({
                title: "<?= $msg['msg']; ?>",
                icon: "<?= $msg['type']; ?>",
                text: "<?= $msg['text']; ?>",
                draggable: true
            });
        </script>
        <?php
        $message->clearMessage();
        ?>
    <?php endif; ?>

</body>
</html>