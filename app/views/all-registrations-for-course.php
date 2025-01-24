<?php
require_once("../../db.php");
require_once("../../app/dao/CourseDAO.php");
require_once("../../app/dao/RegistrationDAO.php");

require_once("../../app/models/message.php");

$registrationDAO = new RegistrationDAO($connect, $BASE_URL);

$message = new Message($BASE_URL);
$msg = $message->getMessage();

$course_name = filter_input(INPUT_GET, "curso");
$id = filter_input(INPUT_GET, "id");
$allRegistrations = $registrationDAO->getRegistrationsByCourseId($id);
$totalRegistrations = $registrationDAO->getTotalRegistrationsByCourseId($id);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-store" />
    <title>Inscrições de Mini Cursos</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- BOOTSTRAP ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- STYLES -->
    <link rel="stylesheet" href="../styles/styles.scss">
</head>


<body>

    <div class="container p-1 mt-5">

        <nav aria-label="breadcrumb mb-5">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="http://localhost/php-sty/gitHub/reg-courses-php/?page=adm">Voltar</a></li>
                <li class="breadcrumb-item active" aria-current="page">Inscrições do Curso</li>
            </ol>
        </nav>

        <div class="d-flex align-items-start justify-content-between">
            <div class="mb-4">
                <span class="fs-6 fw-semibold">Minicurso Alfa</span>
                <h2 class="fs-1">
                    <?= $course_name ?>
                </h2>
            </div>

            <div class="d-flex gap-3 header-buttons">
                <button class="btn btn-outline-secondary d-flex align-items-center header-export" type="submit">
                    <i class="bi bi-folder-check me-2"></i>Exportar
                </button>
            </div>
        </div>

        <ul class="nav nav-tabs mb-5 submenu-header">
            <li class="nav-item">
                <a class="nav-link active">Todas as Inscrições
                    <span class="badge text-bg-secondary"><?= $totalRegistrations ?></span>
                </a>
            </li>
        </ul>

        <div class="container">
            <div class="mb-3 d-flex justify-content-between align-items-end gap-3">

                <div class="form-floating input-search">
                    <input type="text" class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></input>
                    <label for="floatingTextarea"><i class="bi bi-search me-2"></i>Buscar Aluno</label>
                </div>
            </div>

            <div class="col-md-12" id="all-courses">
                <table class="table edit-table table-bordered">
                    <thead>
                        <th scope="col">Nome do Estudante</th>
                        <th scope="col" class="text-center">CPF</th>
                        <th scope="col" class="text-center">Telefone</th>
                        <th scope="col" class="text-center">E-mail</th>
                        <th scope="col" class="text-center">Data de Nascimento</th>
                        <th scope="col" class="text-center">Sexo</th>
                        <th scope="col" class="text-center"></th>
                    </thead>

                    <tbody>
                        <?php foreach ($allRegistrations as $register):
                            $dateBthStudent = new DateTime($register->dateBth);
                            $dateBthStudentFormat = $dateBthStudent->format("d/m/Y");
                        ?>

                            <tr>
                                <td scope="row"><?= $register->candidate ?></td>
                                <td scope="row" class="text-center"><?= $register->cpf ?></td>
                                <td scope="row" class="text-center"><?= $register->phone ?></td>
                                <td scope="row" class="text-center"><?= $register->email ?></td>
                                <td scope="row" class="text-center"><?= $dateBthStudentFormat ?></td>
                                <td scope="row" class="text-center"><?= $register->gender ?></td>
                                <td scope="row" class="fs-5 icon-list text-center d-flex align-items-center">
                                    <a href="<?= $BASE_URL ?>update-registration.php?id=<?= $register->id ?>" title="Editar aluno">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <form action="http://localhost/php-sty/gitHub/reg-courses-php/app/controller/registration_process.php" method="POST" class="delete-form" onsubmit="return confirmDelete(event)">
                                        <input type="hidden" name="type" value="delete">
                                        <input type="hidden" name="id" value="<?= $register->id ?>">

                                        <button class="trash" type="submit" class="delete-btn" title="Excluir inscrição">
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