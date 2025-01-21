
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
        <th scope="col" class="text-center">Curso</th>
        <th scope="col" class="text-center"></th>
    </thead>

    <tbody>
        <?php foreach ($allRegistrations as $register): ?>
            <tr>
                <td scope="row"><?= $register->name ?></td>
                <td scope="row" class="text-center"><?= $register->cpf ?></td>
                <td scope="row" class="text-center"><?= $register->phone ?></td>
                <td scope="row" class="text-center"><?= $register->email ?></td>
                <td scope="row" class="text-center"><?= $register->dateBth ?></td>
                <td scope="row" class="text-center"><?= $register->gender ?></td>
                <td scope="row" class="fs-5 icon-list text-center d-flex align-items-center">
                    <a href="<?= $BASE_URL ?>/app/views/update-registration.php?id=<?= $register->id ?>" title="Editar aluno">
                        <i class="bi bi-pencil-square"></i>
                    </a>

                    <form action="<?= $BASE_URL ?>app/controller/registration_process.php" method="POST" class="delete-form" onsubmit="return confirmDelete(event)">
                        <input type="hidden" name="type" value="delete">
                         <input type="hidden" name="id" value="<?= $register->id ?>"> 

                        <button class="trash" type="submit" class="delete-btn" title="Excluir curso">
                            <i class="bi bi-trash3"></i>
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>