<?php
require_once("../../db.php");
require_once("../../app/models/message.php");
require_once("../../app/dao/CourseDAO.php");

$courseDao = new CourseDAO($connect, $BASE_URL);
$message = new Message($BASE_URL);
$msg = $message->getMessage();

$id = filter_input(INPUT_GET, "id");

if (empty($id)) {
    $message->setMessage("Oops...", "error", "Algo deu errado, o curso não foi encontrado", "back");
} else {
    $course = $courseDao->findByIdCourse($id);

    if (!$course) {
        $message->setMessage("Oops...", "error", "Algo deu errado, o curso não foi encontrado", "back");
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Mini Curso</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- STYLES -->
    <link rel="stylesheet" href="../styles/styles.scss">
</head>

<body>
    <div class="fluid-container d-flex justify-content-center align-items-center min-vh-100 flex-column bg-light p-2">

        <form class="container bg-white form-add-course p-5 rounded" method="POST" action="../controller/add-course_process.php" enctype="multipart/form-data">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= $_SERVER["HTTP_REFERER"] ?>">Voltar</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Editar Mini Curso</li>
                </ol>
            </nav>

            <h2>EDITAR MINI CURSO</h2>
            <hr class="mb-2">
            <span>Última edição: 15/01/25 às 14h</span>

            <input type="hidden" name="type" value="update">
            <input type="hidden" name="id" value="<?= $course->id ?>">
            <div class="mb-3 mt-4">
                <label for="course_name" class="form-label">Nome do curso</label>
                <input type="text" class="form-control bg-light rounded-pill border-0" id="id_course_name" name="course_name" value="<?= $course->name ?>">
            </div>
            <div class="mb-3">
                <label for="course_minister" class="form-label">Prof. Ministrante</label>
                <input type="text" class="form-control bg-light rounded-pill border-0" id="id_course_minister" name="course_minister" value="<?= $course->minister ?>"></input>
            </div>
            <div class="mb-3">
                <label for="course_description" class="form-label">Descrição do curso</label>
                <textarea type="text" class="form-control bg-light rounded border-0" id="id_course_description" name="course_description" rows="5"><?= $course->description ?></textarea>
            </div>

            <div class="mb-3 d-flex flex-column">
                <label for="course_image" class="form-label">Imagem de capa</label>
                <img class="rounded card-img-top mb-2 image-preview-course" src="../assets/img/<?= $course->image ?>" alt="preview da capa do curso" id="preview_img_course">
                <input type="file" class="form-control form-control-sm rounded" name="course_image" id="id_course_image">
                <span class="input-image-formats">Formatos aceitos: .png, .jpeg e jpg</span>
            </div>

            <div class="mb-3 d-flex gap-3">
                <div>
                    <label for="course_date" class="form-label">Data de Realização</label>
                    <input type="date" class="form-control input-date bg-light rounded-pill border-0" id="id_course_date" name="course_date" style="width: 145px;" value="<?= $course->date ?>"></input>
                </div>

                <div>
                    <label for="course_time" class="form-label">Horário de Início</label>
                    <input type="time" class="form-control input-time-as bg-light rounded-pill border-0" id="id_course_time" name="course_time" value="<?= $course->time ?>"></input>
                </div>
            </div>
            <div class="mb-3">
                <label for="course_duration" class="form-label">Duração Total</label>
                <input type="time" class="form-control input-time-as bg-light rounded-pill border-0" id="id_course_duration" name="course_duration" value="<?= $course->duration ?>"></input>
            </div>
            <div class="mb-3 row align-items-end">
                <div class="col" style="max-width: 200px;">
                    <label for="course_vacancies" class="form-label">Quantidade de vagas</label>
                    <input type="number" class="form-control bg-light rounded-pill border-0" id="id_course_vacancies" name="course_vacancies" value="<?= $course->vacancies ?>">
                </div>
                <div class="form-check col" style="margin-bottom: -3px;">
                    <input type="checkbox" class="form-check-input" id="id_course_open" name="course_open" value="1">
                    <label class="form-check-label" for="course_open">Curso Aberto</label>
                </div>
            </div>
            <button type="submit" class="rounded-pill mt-3 btn-add-course fs-6">SALVAR</button>
        </form>
    </div>

    <!-- BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

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

    <!-- ALTERANDO A PREVIEW DA IMG CAPA DO CURSO -->
    <script>
        const fileInput = document.getElementById("id_course_image");
        const previewImg = document.getElementById("preview_img_course");

        fileInput.addEventListener("change", function(event) {
            const fileImg = event.target.files[0];

            if (fileImg && fileImg.type.startsWith("image/")) { 
                const readerImg = new FileReader();

                readerImg.onload = function(element) {
                    previewImg.src = element.target.result;
                };

                readerImg.readAsDataURL(fileImg);
            } else {
                previewImg.src = ""; 
            }
        })
    </script>

</body>

</html>