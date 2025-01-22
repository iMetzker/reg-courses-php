<?php
require_once("../../db.php");
require_once("../../app/models/message.php");
require_once("../../app/dao/RegistrationDAO.php");

$registerDao = new RegistrationDAO($connect, $BASE_URL);
$message = new Message($BASE_URL);

$msg = $message->getMessage();

$id = filter_input(INPUT_GET, "id");

if (empty($id)) {
    $message->setMessage("Oops...", "error", "Algo deu errado, o estudante não foi encontrado", "back");
} else {
    $register = $registerDao->findByIdRegistration($id);

    if (!$register) {
        $message->setMessage("Oops...", "error", "Algo deu errado, o estudante não foi encontrado", "back");
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Estudante</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- STYLES -->
    <link rel="stylesheet" href="../styles/styles.scss">
</head>

<body>
    <div class="fluid-container d-flex justify-content-center align-items-center min-vh-100 flex-column bg-light p-2">

        <form class="container bg-white form-add-course p-5 rounded" method="POST" action="../controller/registration_process.php">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="http://localhost/php-sty/gitHub/reg-courses-php/?page=adm&action=registrations">Voltar</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Editar Cadastro</li>
                </ol>
            </nav>

            <h2>EDITAR CADASTRO DO ESTUDANTE</h2>
            <hr class="mb-2">
            <span>Última edição: 15/01/25 às 14h</span>

            <input type="hidden" name="type" value="update">
            <input type="hidden" name="id" value="<?= $register->id ?>">

            <div class="mb-3 mt-4">
                <label for="student_name" class="form-label">Nome Completo</label>
                <input
                    class="form-control bg-light rounded-pill border-0"
                    type="text"
                    id="id_student_name"
                    name="student_name"
                    value="<?= $register->candidate ?>">
            </div>

            <div class="mb-3 mt-4">
                <label for="student_name" class="form-label">E-mail</label>
                <input
                    class="form-control bg-light rounded-pill border-0"
                    type="email"
                    id="id_student_email"
                    name="student_email"
                    value="<?= $register->email ?>">
            </div>


            <div class="mb-3">
                <label for="student_cpf" class="form-label">CPF</label>
                <input
                    class="form-control bg-light rounded-pill border-0"
                    type="text"
                    id="id_student_cpf"
                    maxlength="14"
                    name="student_cpf"
                    required
                    pattern="\d{3}\.\d{3}\.\d{3}-\d{2}"
                    value="<?= $register->cpf ?>">
            </div>

            <div class="mb-3">
                <label for="student_phone" class="form-label">Telefone de contato</label>
                <input
                    class="form-control bg-light rounded-pill border-0"
                    type="text"
                    id="id_student_phone"
                    name="student_phone"
                    maxlength="15"
                    required
                    pattern="\(\d{2}\) \d{5}-\d{4}"
                    value="<?= $register->phone ?>">
            </div>

            <div class="mb-3 d-flex gap-5 align-items-end">
                <div>
                    <label for="student_bth">Data de Nascimento</label>
                    <input
                        class="form-control bg-light rounded-pill border-0 mt-2 date-btn-student"
                        type="date"
                        id="id_student_bth"
                        name="student_bth"
                        value="<?= $register->dateBth ?>">

                </div>

                <div class="form-floating ">
                    <div class="col select-gender">
                        <label for="student_gender" class="form-label text-secondary m-0">Gênero</label>
                        <select
                            class="form-select bg-light rounded-pill border-0 mt-2 "
                            id="student_gender"
                            name="student_gender"
                            required>
                            <option value="" disabled>Selecione</option>
                            <option value="F"
                                <?= $register->gender == 'F' ? 'selected' : ''; ?>>Feminino</option>
                            <option value="M"
                                <?= $register->gender == 'M' ? 'selected' : ''; ?>>Masculino</option>
                        </select>
                    </div>
                </div>
            </div>

            <button class="rounded-pill mt-3 btn-add-course fs-6" type="submit">Salvar</button>
        </form>
    </div>

    </div>
    </form>
    </div>

    <!-- BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    <script src="../assets/js/mask_inputs.js"></script>

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
</body>

</html>