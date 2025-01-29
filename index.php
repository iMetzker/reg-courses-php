<?php
require_once("./db.php");
require_once("./app/dao/CourseDAO.php");
require_once("./app/dao/RegistrationDAO.php");

require_once("./app/models/message.php");

$courseDAO = new CourseDAO($connect, $BASE_URL);
$allCourses = $courseDAO->getAllCourses();
$totalCourses = $courseDAO->getTotalCourses();

$registrationDAO = new RegistrationDAO($connect, $BASE_URL);
$allRegistrations = $registrationDAO->getAllRegistrations();
$totalRegistrations = $registrationDAO->getTotalRegistrations();

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

    <!-- TEMPLATE -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="./app/template/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="./app/template/css/animate.css">

    <link rel="stylesheet" href="./app/template/css/owl.carousel.min.css">
    <link rel="stylesheet" href="./app/template/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="./app/template/css/magnific-popup.css">

    <link rel="stylesheet" href="./app/template/css/aos.css">

    <link rel="stylesheet" href="./app/template/css/ionicons.min.css">

    <link rel="stylesheet" href="./app/template/css/flaticon.css">
    <link rel="stylesheet" href="./app/template/css/icomoon.css">
    <link rel="stylesheet" href="./app/template/css/style.css">

    <!-- <script src="https://cdn.jsdelivr.net/npm/wowjs@1.1.3/dist/wow.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/wowjs@1.1.3/css/libs/animate.min.css" rel="stylesheet"> -->

</head>


<body>
    <div class="d-flex justify-content-center align-items-center flex-column">

        <?php
        switch (@$_REQUEST["page"]) {
            case "student":
                include("./app/views/panel-student.php");
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
                title: "Tem certeza que deseja excluir?",
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

    <!-- MESSAGE ALERT -->
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

    <!-- WOW JS -->
    <script src="js/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>

    <!-- TEMPLATE -->

    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
        </svg></div>


    <script src="./app/template/js/jquery.min.js"></script>
    <script src="./app/template/js/jquery-migrate-3.0.1.min.js"></script>
    <script src="./app/template/js/popper.min.js"></script>
    <script src="./app/template/js/bootstrap.min.js"></script>
    <script src="./app/template/js/jquery.easing.1.3.js"></script>
    <script src="./app/template/js/jquery.waypoints.min.js"></script>
    <script src="./app/template/js/jquery.stellar.min.js"></script>
    <script src="./app/template/js/owl.carousel.min.js"></script>
    <script src="./app/template/js/jquery.magnific-popup.min.js"></script>
    <script src="./app/template/js/aos.js"></script>
    <script src="./app/template/js/jquery.animateNumber.min.js"></script>
    <script src="./app/template/js/scrollax.min.js"></script>
    <script src="./app/template/js/main.js"></script>

    <!-- FILTROS -->
    <script src="./app/assets/js/filterPanelStudent_input.js"></script>
    <script src="./app/assets/js/filterPanelStudent_select.js"></script>
    <script src="./app/assets/js/filterPanelAdmin.js"></script>
</body>

</html>