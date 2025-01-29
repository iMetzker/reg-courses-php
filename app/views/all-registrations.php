<div class="mb-3 d-flex justify-content-between align-items-end gap-3">

    <div class="form-floating input-search">
        <input type="text" class="form-control" placeholder="Buscar aluno" id="searchInputCourses"></input>
        <label for="searchInputCourses"><i class="bi bi-search me-2"></i>Buscar Aluno</label>
    </div>
</div>

<div class="alert alert-warning no-result d-none mt-3" id="noResult" role="alert">
    <i class="bi bi-x-circle me-2"></i>
    Oops... Sinto muito, nenhum curso com este nome foi encontrado.
</div>

<div class="col-md-12 p-0 view-table" id="all-courses">
    <table class="table edit-table table-bordered course-card">
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
            <?php foreach ($allRegistrations as $register):
                $dateBthStudent = new DateTime($register->dateBth);
                $dateBthStudentFormat = $dateBthStudent->format("d/m/Y");
            ?>

                <tr>
                    <td scope="row" class="heading"><?= $register->candidate ?></td>
                    <td scope="row" class="text-center"><?= $register->cpf ?></td>
                    <td scope="row" class="text-center"><?= $register->phone ?></td>
                    <td scope="row" class="text-center" style="text-transform: lowercase;"><?= $register->email ?></td>
                    <td scope="row" class="text-center"><?= $dateBthStudentFormat ?></td>
                    <td scope="row" class="text-center"><?= $register->course ?></td>
                    <td scope="row" class="fs-5 icon-list text-center d-flex align-items-center mt-1 border-0">

                        <a href="<?= $BASE_URL ?>/app/views/update-registration.php?id=<?= $register->id ?>" title="Editar aluno">
                            <i class="bi bi-pencil-square"></i>
                        </a>

                        <form action="<?= $BASE_URL ?>app/controller/registration_process.php" method="POST" class="delete-form" onsubmit="return confirmDelete(event)">
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
