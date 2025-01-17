<?php
require_once("../../db.php");
require_once("../../app/models/message.php");

$message = new Message($BASE_URL);
$msg = $message->getMessage();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Minicursos</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- STYLES -->
    <link rel="stylesheet" href="../styles/styles.scss">
</head>

<body>
    <div class="fluid-container d-flex justify-content-center align-items-center min-vh-100 flex-column bg-light p-2">

        <form class="container bg-white form-add-course p-5 rounded" method="POST" action="../controller/course_process.php" enctype="multipart/form-data">
            
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../../index.php">Início</a></li>
                <li class="breadcrumb-item active" aria-current="page">Adicionar Curso</li>
            </ol>
        </nav>

            <h2>CADASTRO DE MINICURSO</h2>
            <hr class="mb-5">

            <input type="hidden" name="type" value="create">
            <div class="mb-3">
                <label for="course_name" class="form-label"><span class="text-danger">*</span>Nome do curso</label>
                <input type="text" class="form-control bg-light rounded-pill border-0" id="id_course_name" name="course_name">
            </div>
            <div class="mb-3">
                <label for="course_minister" class="form-label"><span class="text-danger">*</span>Prof. Ministrante</label>
                <input type="text" class="form-control bg-light rounded-pill border-0" id="id_course_minister" name="course_minister"></input>
            </div>
            <div class="mb-3">
                <label for="course_description" class="form-label"><span class="text-danger">*</span>Descrição do curso</label>
                <textarea type="text" class="form-control bg-light rounded border-0" id="id_course_description" name="course_description" rows="5"></textarea>
            </div>

            <div class="mb-3">
                <label for="course_image" class="form-label"><span class="text-danger">*</span>Imagem para capa</label>
                <input type="file" class="form-control form-control-sm rounded" name="course_image" id="id_course_image" required>
                <span class="input-image-formats">Formatos aceitos: .png, .jpeg e jpg</span>
            </div>

            <div class="mb-3 d-flex gap-3">
                <div>
                    <label for="course_date" class="form-label"><span class="text-danger">*</span>Data de Realização</label>
                    <input type="date" class="form-control input-date bg-light rounded-pill border-0" id="id_course_date" name="course_date" style="width: 145px;"></input>
                </div>

                <div>
                    <label for="course_time" class="form-label"><span class="text-danger">*</span>Horário de Início</label>
                    <input type="time" class="form-control input-time-as bg-light rounded-pill border-0" id="id_course_time" name="course_time"></input>
                </div>
            </div>
            <div class="mb-3">
                <label for="course_duration" class="form-label"><span class="text-danger">*</span>Duração Total</label>
                <input type="time" class="form-control input-time-as bg-light rounded-pill border-0" id="id_course_duration" name="course_duration"></input>
            </div>
            <div class="mb-3 row align-items-end">
                <div class="col" style="max-width: 200px;">
                    <label for="course_vacancies" class="form-label"><span class="text-danger">*</span>Quantidade de vagas</label>
                    <input type="number" class="form-control bg-light rounded-pill border-0" id="id_course_vacancies" name="course_vacancies">
                </div>
                <div class="form-check col" style="margin-bottom: -3px;">
                    <input type="checkbox" class="form-check-input" id="id_course_open" name="course_open" value="1">
                    <label class="form-check-label" for="course_open">Curso Aberto</label>
                </div>
            </div>
            <button type="submit" class="rounded-pill mt-3 btn-add-course fs-6">CADASTRAR</button>
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

    <!-- CKEDITOR 5 EDITOR DE TEXTO -->
    <!-- <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#id_course_description'), {
                toolbar: [
                    'bold',
                    'italic',
                    'link',
                    'bulletedList', 
                    'numberedList',
                    'undo',
                    'redo',
                ],
                heading: {
                    options: [{
                            model: 'paragraph',
                            title: 'Normal',
                            view: 'p'
                        },
                        {
                            model: 'heading1',
                            title: 'Cabeçalho 1',
                            view: 'h1'
                        },
                        {
                            model: 'heading2',
                            title: 'Cabeçalho 2',
                            view: 'h2'
                        },
                    ]
                },
            })
            .catch(error => {
                console.error(error);
            });
    </script> -->

</body>

</html>