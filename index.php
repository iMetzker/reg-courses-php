<?php 
require_once("./db.php");
require_once("./app/models/message.php");

$message = new Message($BASE_URL);
$msg = $message->getMessage();
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
        <h2>Cadastrar Mini Curso</h2>
        <form class="mt-5 container" method="POST" action="<?= $BASE_URL ?>app/views/add-course.php">
        <input type="hidden" name="type" value="create">    
        <div class="mb-3">
                <label for="course_name" class="form-label">Nome do curso</label>
                <input type="text" class="form-control" id="id_course_name" name="course_name" required>
            </div>
            <div class="mb-3">
                <label for="course_description" class="form-label">Descrição do curso</label>
                <textarea type="text" class="form-control" id="id_course_description" name="course_description" rows="5" required></textarea>
            </div>
            <div class="mb-3 row align-items-end">
                <div class="col" style="max-width: 200px;">
                    <label for="course_vacancies" class="form-label">Quantidade de vagas</label>
                    <input type="number" class="form-control" id="id_course_vacancies" name="course_vacancies" required>
                </div>
                <div class="form-check col" style="margin-bottom: -3px;">
                    <input type="checkbox" class="form-check-input" id="id_course_open" name="course_open" value="1">
                    <label class="form-check-label" for="course_open">Curso Aberto</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
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
                draggable: true
            });
        </script>
        <?php 
        print_r($msg);
        ?>
    <?php endif; ?>
    
</body>
</html>