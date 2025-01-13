<div class="container mt-5">

    <nav aria-label="breadcrumb mb-5">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $BASE_URL ?>">Início</a></li>
            <li class="breadcrumb-item active" aria-current="page">Painel do Aluno</li>
        </ol>
    </nav>

    <h2 class="text-center">Mini Cursos Alfa Unipac</h2>

    <div class="d-flex justify-content-center flex-wrap gap-5 mt-5">
        <?php foreach ($allCourses as $course):

            // FORMATANDO DATAS
            $dateCourse = new DateTime($course->date);
            $timeInit = new DateTime($course->time);
            $durationCourse = new DateTime($course->duration);


            $dateFormat = $dateCourse->format("d/m/Y");
            $timeInitFormat = str_replace("00", "", $timeInit->format("H\hi"));
            $durationFormat = str_replace("00", "", $durationCourse->format("h\hi"));

        ?>
            <div class="card">
                <img src="./app/assets/img/1.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">
                        <?= $course->name ?>
                    </h5>
                    <div class="card-text card-description mb-2"
                        title="<?php echo str_replace("&nbsp;", "&#13• ", strip_tags($course->description)); ?>">
                        <?= $course->description ?>
                    </div>
                    <hr>
                    <div class="d-flex card-text align-items-center gap-1">
                        <i class="bi bi-file-person-fill"></i>
                        <h6 class="card-title mb-0 ">Prof. Ministrante:
                            <?= $course->minister ?>
                        </h6>
                    </div>
                    <div class="mt-2 d-flex align-items-center gap-3">
                        <div class="d-flex card-text align-items-center gap-1">
                            <i class="bi bi-calendar3"></i>
                            <h6 class="card-title mb-0 ">
                                <?= $dateFormat . ' às ' . $timeInitFormat
                                ?>
                            </h6>
                        </div>
                        <div class="d-flex card-text align-items-center gap-1">
                            <i class="bi bi-clock-history"></i>
                            <h6 class="card-title mb-0 ">Duração: <?= $durationFormat ?></h6>
                        </div>
                    </div>
                    <p class="card-text mt-2">
                        <b class="fs-3">
                            <?= $course->vacancies ?></b> Vagas
                    </p>
                    <footer class="blockquote-footer">
                        <?php
                        if ($course->open === 1) {
                            echo "28 vagas restantes";
                        } else {
                            echo "Vagas esgotadas";
                        }
                        ?>
                    </footer>
                    <?php
                    if ($course->open === 1) {
                        echo "<a class=\"card-text card-icon fs-4\" href=\"<?= $BASE_URL ?>add-student.php?id=<?= $course->id ?>\">Inscrever-se <i class=\"bi bi-person-add\"></i></a>";
                    }
                    ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>