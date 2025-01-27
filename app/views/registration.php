<?php
require_once("../../db.php");
require_once("../../app/dao/CourseDAO.php");
require_once("../../app/models/message.php");

$courseDAO = new CourseDAO($connect, $BASE_URL);

$message = new Message($BASE_URL);
$msg = $message->getMessage();

$id = filter_input(INPUT_GET, "id");

if (empty($id)) {

    $message->setMessage("Curso não encontrado!", "error", "", "");
} else {
    $course = $courseDAO->findByIdCourse($id);

    if (!$course) {

        $message->setMessage("Curso não encontrado!", "error", "", "");
    }
}


// FORMATANDO DATAS
$dateCourse = new DateTime($course->date);
$timeInit = new DateTime($course->time);
$durationCourse = new DateTime($course->duration);


$dateFormat = $dateCourse->format("d/m/Y");
$timeInitFormat = str_replace("00", "", $timeInit->format("H\hi"));
$durationFormat = str_replace("00", "", $durationCourse->format("h\hi"));
?>

<!-- AQUI COMEÇA -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscrição</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- BOOTSTRAP ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- STYLES -->
    <link rel="stylesheet" href="../styles/styles.scss">

    <!-- TEMPLATE -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../template/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="../template/css/animate.css">

    <link rel="stylesheet" href="../template/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../template/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../template/css/magnific-popup.css">

    <link rel="stylesheet" href="../template/css/aos.css">

    <link rel="stylesheet" href="../template/css/ionicons.min.css">

    <link rel="stylesheet" href="../template/css/flaticon.css">
    <link rel="stylesheet" href="../template/css/icomoon.css">
    <link rel="stylesheet" href="../template/css/style.css">
</head>

<body>

    <div class="containe-fluid p-0">
        <?php
        require_once("../layout/header_reg.php");
        ?>

        <section class="hero-wrap hero-wrap-2" style="background-image: url('../assets/img/heading-bg.jpg');">
            <div class="overlay"></div>
            <div class="container">
                <div class="row no-gutters slider-text align-items-center justify-content-center">
                    <div class="col-md-9 ftco-animate text-center">
                        <h1 class="mb-2 bread"><?= $course->name ?></h1>
                        <p class="breadcrumbs"><span class="mr-2"><a href="http://localhost/php-sty/gitHub/reg-courses-php/?page=student">Voltar <i class="ion-ios-arrow-forward"></i></a></span>
                            <span>Inscrição
                                <i class="ion-ios-arrow-forward"></i>
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="ftco-section contact-section">
            <div class="container">
                <div class="row d-flex contact-info">
                    <div class="col-md-3 d-flex">
                        <div class="bg-light align-self-stretch box p-4 text-center">
                            <h3 class="mb-4">Realização</h3>
                            <p><?= $dateFormat . ' às ' . $timeInitFormat ?></p>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex">
                        <div class="bg-light align-self-stretch box p-4 text-center">
                            <h3 class="mb-4">Duração</h3>
                            <p><?= $durationFormat ?></p>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex">
                        <div class="bg-light align-self-stretch box p-4 text-center">
                            <h3 class="mb-4">Ministrante</h3>
                            <p><?= $course->minister ?></p>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex">
                        <div class="align-self-stretch box p-4 text-center"
                            style="
                            background-color: <?= ($course->available_vacancies == 0) ? '#041c39' : '#fd7e14'; ?>;
                            color: white;">
                            <h3 class="mb-4"
                                style="color: white;">Vagas</h3>
                            <p>
                                <?php
                                if ($course->available_vacancies == 0) {
                                    echo "Vagas esgotadas " .
                                        '<i class="bi bi-exclamation-diamond"></i>';
                                } else if ($course->available_vacancies == 1) {
                                    echo $course->available_vacancies . " vaga restante";
                                } else {
                                    echo $course->available_vacancies . " vagas restantes";
                                }
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="ftco-section ftco-no-pt ftc-no-pb">
            <div class="container">
                <div class="row d-flex">
                    <div class="col-md-5 order-md-last wrap-about wrap-about d-flex align-items-stretch">
                        <div class="img" style="background-image: url(../assets/img/<?= $course->image ?>);"></div>
                    </div>
                    <div class="col-md-7 wrap-about py-5 pr-md-4 ftco-animate">
                        <h2 class="mb-4">O que você vai aprender?</h2>
                        <div><?= $course->description ?></div>
                        <div class="row">
                            <form class="mt-3 form-floating content-enrollment" method="POST" action="../controller/contact_process.php?id_course=<?= $id ?>">

                                <input type="hidden" name="type" value="register">

                                <h4>Increver-se neste curso</h4>
                                <div class="form-floating mb-3">
                                    <input
                                        class="form-control"
                                        type="text"
                                        id="id_student_name"
                                        placeholder="name@example.com"
                                        name="student_name"
                                        required>
                                    <label for="student_name">Nome Completo</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input
                                        class="form-control"
                                        type="email"
                                        id="id_student_email"
                                        placeholder="name@example.com"
                                        name="student_email"
                                        required>
                                    <label for="student_email">E-mail</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input
                                        class="form-control"
                                        type="text"
                                        id="id_student_cpf"
                                        placeholder="name@example.com"
                                        maxlength="14"
                                        name="student_cpf"
                                        required
                                        pattern="\d{3}\.\d{3}\.\d{3}-\d{2}">
                                    <label for="student_cpf">CPF</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input
                                        class="form-control"
                                        type="text"
                                        id="id_student_phone"
                                        placeholder="name@example.com"
                                        name="student_phone"
                                        maxlength="15"
                                        required
                                        pattern="\(\d{2}\) \d{5}-\d{4}">
                                    <label for="student_phone">Telefone de contato</label>
                                </div>

                                <div class="form-floating mb-3 d-flex gap-5  align-items-end">
                                    <input
                                        class="form-control date-btn-student"
                                        type="date"
                                        id="id_student_bth"
                                        placeholder="name@example.com"
                                        name="student_bth"
                                        required>
                                    <label for="student_bth">Data de Nascimento</label>
                                    <span id="birthdate-error" class="text-danger" style="display: none;">A idade deve ser entre 10 e 100 anos.</span>

                                    <div class="form-floating ">
                                        <div class="col select-gender">
                                            <label for="student_gender" class="form-label text-secondary m-0">Gênero</label>
                                            <select
                                                class="form-select"
                                                id="student_gender"
                                                name="student_gender"
                                                required>
                                                <option value="" selected disabled>Selecione</option>
                                                <option value="F">Feminino</option>
                                                <option value="M">Masculino</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <button
                                    class="btn btn-primary py-3 px-5 mt-3
                                    <?= ($course->available_vacancies == 0) ? 'btn-disabled' : '' ?>"
                                    type="submit"
                                    <?= ($course->available_vacancies == 0) ? 'disabled' : '' ?>>Inscrever-se</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php
        require_once("../layout/footer_reg.php");
        ?>
    </div>


    <!-- BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    <script src="../assets/js/mask_inputs.js"></script>
    <script src="../assets/js/validate_cpf.js"></script>
    <script src="../assets/js/validate_dateBth.js"></script>

    <!-- SWEET ALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    <!-- TEMPLATE -->
    <div id="ftco-loader" class="show fullscreen">
        <svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
        </svg>
    </div>

    <script src="../template/js/jquery.min.js"></script>
    <script src="../template/js/jquery-migrate-3.0.1.min.js"></script>
    <script src="../template/js/popper.min.js"></script>
    <script src="../template/js/bootstrap.min.js"></script>
    <script src="../template/js/jquery.easing.1.3.js"></script>
    <script src="../template/js/jquery.waypoints.min.js"></script>
    <script src="../template/js/jquery.stellar.min.js"></script>
    <script src="../template/js/owl.carousel.min.js"></script>
    <script src="../template/js/jquery.magnific-popup.min.js"></script>
    <script src="../template/js/aos.js"></script>
    <script src="../template/js/jquery.animateNumber.min.js"></script>
    <script src="../template/js/scrollax.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="../template/js/google-map.js"></script>
    <script src="../template/js/main.js"></script>
</body>

</html>