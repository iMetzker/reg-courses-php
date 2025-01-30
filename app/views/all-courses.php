<div class="mb-3 d-flex justify-content-between align-items-end gap-3">
    <div class="form-floating input-search">
        <input type="text" class="form-control" placeholder="Buscar curso..." id="searchInputCourses"></input>
        <label for="searchInputCourses"><i class="bi bi-search me-2"></i>Buscar curso</label>
    </div>
    <div class="d-flex align-items-center gap-3 fs-5 filter-group">
        <button class="d-flex align-items-center btn form-button" id="orderCourseBtn">
            <i class="bi bi-arrow-down-up me-2"></i> Curso
        </button>

        <button class="d-flex align-items-center btn form-button" id="orderDateBtn">
            <i class="bi bi-calendar-week me-2"></i> Data
        </button>

        <button class="d-flex align-items-center btn form-button" id="orderStatusBtn">
            <i class="bi bi-filter me-2"></i> Status
        </button>
    </div>
</div>

<div class="alert alert-warning no-result d-none mt-3" id="noResult" role="alert">
    <i class="bi bi-x-circle me-2"></i>
    Oops... Sinto muito, nenhum curso com este nome foi encontrado.
</div>

<div class="col-md-12 p-0 view-table" id="all-courses">
    <table class="table edit-table table-bordered course-card" id="example">
        <thead>
            <th scope="col" class="block-click">Nome do Curso</th>
            <th scope="col" class="text-center dt-type-date block-click">Data de Realização</th>
            <th scope="col" class="text-center block-click">Vagas</th>
            <th scope="col" class="text-center block-click">Inscrições</th>
            <th scope="col" class="text-center status-course block-click">Status</th>
            <th scope="col" class="text-center block-click"></th>
        </thead>

        <tbody>
            <?php foreach ($allCourses as $course):
                $dateCourse = new DateTime($course->date);
                $dataAc = new DateTime();
                $dateFormat = $dateCourse->format("d/m/Y");

            ?>
                <tr>
                    <td scope="row" class="heading"><?= $course->name ?></td>
                    <td scope="row" class="text-center">
                        <?= $dateFormat ?>
                    </td>
                    <td scope="row" class="text-center"><?= $course->vacancies ?></td>
                    <td scope="row" class="text-center"><?= ($course->vacancies - $course->available_vacancies) ?></td>
                    <td scope="row" class="text-center">
                        <?php
                        if ($course->open == 1) {
                            if ($course->available_vacancies == 0) {
                                echo "<span class=\"tag soldout\">Vagas esgotadas</span>";
                            } else if ($dateCourse < $dataAc && $dateCourse->format("Y-m-d") !== $dataAc->format("Y-m-d")) {
                                echo "<span class=\"tag closed\">Fora do Período</span>";
                            } else {
                                echo "<span class=\"tag open\">Aberto</span>";
                            }
                        } else {
                            echo "<span class=\"tag close\">Fechado</span>";
                        }
                        ?>
                    </td>
                    <td scope="row" class="fs-5 icon-list text-center d-flex align-items-center border-0">

                        <?php
                        // CADASTRO DE ALUNO APENAS COM CURSO DISPONÍVEL
                        if (
                            $course->open == 1 && $course->available_vacancies > 0 &&
                            ($dateCourse >= $dataAc || $dateCourse->format("Y-m-d") === $dataAc->format("Y-m-d"))
                        ) {
                            echo "
                            <a href=\"./app/views/registration.php?id={$course->id}\" title=\"Adicionar aluno\">
                                <i class=\"bi bi-person-add fs-4\"></i>
                            </a>";
                        } else {
                            echo "<i class=\"bi bi-person-exclamation text-body-tertiary fs-4\" title=\"Cadastro indisponível\"></i>";
                        }
                        ?>

                        <a href="http://localhost/php-sty/gitHub/reg-courses-php/app/views/all-registrations-for-course.php?id=<?= $course->id ?>&curso=<?= $course->name ?>" title="Visualizar todas as inscrições">
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