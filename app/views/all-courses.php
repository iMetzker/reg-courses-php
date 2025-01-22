<div class="mb-3 d-flex justify-content-between align-items-end gap-3">

    <div class="form-floating input-search">
        <input type="text" class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></input>
        <label for="floatingTextarea"><i class="bi bi-search me-2"></i>Buscar curso</label>
    </div>
    <div class="d-flex align-items-center gap-3 fs-5 filter-group">
        <div class="d-flex align-items-center form-select">
            <i class="bi bi-calendar-week me-2"></i>
            <select aria-label="Seleção de mês">
                <option selected>Mês</option>
                <option value="1">Janeiro</option>
                <option value="2">Fevereiro</option>
            </select>
        </div>

        <div class="d-flex align-items-center form-select">
            <i class="bi bi-filter me-2"></i>
            <select aria-label="Seleção de status">
                <option selected>Status</option>
                <option value="1">Aberto</option>
                <option value="2">Fechado</option>
                <option value="2">Vagas Esgotadas</option>
                <option value="2">Encerrado</option>
            </select>
        </div>
    </div>
</div>

<div class="col-md-12" id="all-courses">
    <table class="table edit-table table-bordered">
        <thead>
            <th scope="col">Nome do Curso</th>
            <th scope="col" class="text-center">Data de Realização</th>
            <th scope="col" class="text-center">Vagas</th>
            <th scope="col" class="text-center">Status</th>
            <th scope="col" class="text-center"></th>
        </thead>

        <tbody>
            <?php foreach ($allCourses as $course):
                $dateCourse = new DateTime($course->date);
                $dateFormat = $dateCourse->format("d/m/Y");
            ?>
                <tr>
                    <td scope="row"><?= $course->name ?></td>
                    <td scope="row" class="text-center"><?= $dateFormat ?></td>
                    <td scope="row" class="text-center"><?= $course->vacancies ?></td>
                    <td scope="row" class="text-center">
                        <?php
                        if ($course->open === 1) {
                            echo "<span class=\"tag open\">Aberto</span>";
                        } else {
                            echo "<span class=\"tag close\">Fechado</span>";
                        }
                        ?>
                    </td>
                    <td scope="row" class="fs-5 icon-list text-center d-flex align-items-center">
                        <a href="<?= $BASE_URL ?>registration.php?id=<?= $course->id ?>" title="Adicionar aluno">
                            <i class="bi bi-person-add fs-4"></i>
                        </a>

                        <a href="<?= $BASE_URL ?>all-students.php?id=<?= $course->id ?>" title="Visualizar todas as inscrições">
                            <i class="bi bi-people fs-4"></i>
                        </a>

                        <a href="<?= $BASE_URL ?>app/views/update-course.php?id=<?= $course->id ?>" title="Editar curso">
                            <i class="bi bi-pencil-square"></i>
                        </a>

                        <form action="<?= $BASE_URL ?>app/controller/course_process.php" method="POST" onsubmit="return confirmDelete(event)" class="delete-form">
                            <input type="hidden" name="type" value="delete">
                            <input type="hidden" name="id" value="<?= $course->id ?>">

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