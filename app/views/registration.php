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

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscrever-se em Minicursos</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- BOOTSTRAP ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- STYLES -->
    <link rel="stylesheet" href="../styles/styles.scss">
</head>

<body>

    <div class="container-enrollment container-fluid d-flex align-items-center justify-content-center gap-5">

        <div class="p-5 content-enrollment">
            <div>
                <nav aria-label="breadcrumb" class="container p-0">
                    <ol class="breadcrumb text-light">
                        <li class="breadcrumb-item"><a href="http://localhost/php-sty/gitHub/reg-courses-php/?page=student">Voltar</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Inscrição</li>
                    </ol>
                </nav>
                <span class="fs-6 fw-semibold">Minicurso Alfa</span>
                <h2 class="fs-1"><?= $course->name ?></h2>
            </div>

            <div class="mt-4 mb-4">
                <h3 class="fs-5">O que você vai aprender?</h3>
                <div><?= $course->description ?></div>
            </div>

            <form class="mt-3 form-floating" method="POST" action="">
                <h4>Increver-se neste curso</h4>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="id_student_name" placeholder="name@example.com" name="student_name">
                    <label for="student_name">Nome Completo</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="id_student_email" placeholder="name@example.com" name="student_email">
                    <label for="student_email">E-mail</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="id_student_cpf" placeholder="name@example.com" maxlength="14">
                    <label for="student_cpf">CPF</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="id_student_phone" placeholder="name@example.com" name="student_phone" maxlength="15">
                    <label for="student_phone">Telefone de contato</label>
                </div>

                <div class="form-floating mb-3 d-flex gap-5  align-items-end">
                    <input type="date" class="form-control date-btn-student" id="id_student_bth" placeholder="name@example.com">
                    <label for="student_bth">Data de Nascimento</label>

                    <div class="form-floating ">
                        <div class="col select-gender">
                            <label for="student_gender" class="form-label text-secondary m-0">Gênero</label>
                            <select id="student_gender" class="form-select" name="student_gender">
                                <option selected>Selecione</option>
                                <option>Feminino</option>
                                <option>Masculino</option>
                                <option>Transgênero</option>
                                <option>Gênero Neutro</option>
                                <option>Não-binário</option>
                                <option>Prefiro não Informar</option>
                            </select>
                        </div>
                    </div>
                </div>

                <button class="rounded-pill mt-3 btn-add-course fs-6" type="submit">Inscrever-se</button>
            </form>
        </div>

        <div class="image-container-enrollment position-relative">

            <div class="card-img-top position-relative img-header-enrollment">
                <img class="rounded-4 card-img-top" src="../assets/img/<?= $course->image ?>" alt="Imagem ilustrativa do curso">
            </div>

            <div class="details-enrollment position-absolute p-4 rounded-4 bg-light-subtle">
                <div class="d-flex gap-4 align-items-center">
                    <div class="d-flex flex-column align-items-center">
                        <div class="d-flex gap-2 align-items-center justify-content-center">
                            <i class="bi bi-calendar3"></i>
                            <h6 class="m-0">Data de Realização</h6>
                        </div>
                        <?= $dateFormat . ' às ' . $timeInitFormat ?>
                    </div>
                    <div class="d-flex flex-column align-items-center">
                        <div class="d-flex gap-2 align-items-center justify-content-center">
                            <i class="bi bi-clock-history"></i>
                            <h6 class="m-0">Duração</h6>
                        </div>
                        <?= $durationFormat ?>
                    </div>
                </div>

                <div class="mt-3">
                    <div class="d-flex gap-2 align-items-center justify-content-start">
                        <i class="bi bi-file-person-fill"></i>
                        <h6 class="m-0">Ministrante</h6>
                    </div>
                    <?= $course->minister ?>
                </div>

                <div class="mt-2">
                    <p class="card-text m-0">
                        <b class="fs-3">
                            <?= $course->vacancies ?></b> Vagas
                    </p>
                    <footer class="blockquote-footer m-0">
                        28 vagas restantes
                    </footer>
                </div>
            </div>
        </div>

    </div>

    <footer class="footer-list-courses mt-5 p-5">
        <div class="container">

            <div class="row d-flex justify-content-between gap-3">
                <div class="col-lg-2 logo-content">
                    <img src="../assets/img/logo-white-orange.png" alt="logo Alfa Unipac">
                    <p class="mt-3"> Rua Engenheiro Celso Murta, 600 <br>
                        Dr. Laerte Laender, Teófilo Otoni <br>
                        MG - 39803-087
                    </p>

                    <span>Direito Autoral © 2025 Alfaunipac, Todos os direitos reservados.</span>
                </div>

                <div class="col-lg-2 contact-us">
                    <h5>Siga-nos nas nossas redes!</h5>
                    <div class="d-flex gap-3 fs-4 links-container">
                        <a href="https://www.linkedin.com/company/alfaunipac" target="_blank"><i class="bi bi-linkedin"></i></a>
                        <a href="https://www.instagram.com/alfaunipac.oficial/" target="_blank"><i class="bi bi-instagram"></i></a>
                        <a href="https://www.youtube.com/c/FaculdadeAlfaUnipac" target="_blank"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 regularidade footer-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <a target="_blank" href="https://emec.mec.gov.br/emec/consulta-cadastro/detalhamento/d96957f455f6405d14c6542552b0f6eb/MTQxNTY">
                                <figure>
                                    <img src="https://alfaunipac.com.br/./site/images/emec.png" alt="AlfaUnipac Emec">
                                </figure>
                            </a>

                        </div>
                        <div class="col-lg-12 mt-2">
                            <a href="https://alfaunipac.com.br/./site/file/portaria-758.pdf" target="_blank" class="text-white">PORTARIA Nº 758, DE 20 DE JUNHO DE 2017<br>
                                Publicada em: 23 de junho de 2017</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </footer>

    <!-- BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    <script src="../assets/js/mask_inputs.js"></script>

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