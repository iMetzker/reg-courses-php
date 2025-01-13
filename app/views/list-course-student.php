<div class="container mt-5">

    <div class="p-5 header-container rounded">
        <div class="z-2 position-relative container">
            <nav aria-label="breadcrumb mb-5">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= $BASE_URL ?>">Início</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Painel do Aluno</li>
                </ol>
            </nav>

            <h1>Experimente ir além da sala de aula</h1>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis odit dolor in. Nam, accusantium atque cumque, sequi nihil quidem voluptatibus facilis perferendis ullam id nisi commodi quas possimus iste ex? <strong><a href="">Explore nossos mini cursos.</a></strong></p>
            <a href="http://">Projeto de Extensão</a>
        </div>
    </div>

    <div class="mt-5">

        <h2 class="text-start">Mini cursos, eventos e palestras</h2>
        <hr>

        <div class="d-flex justify-content-between gap-3">
            <div class="form-floating input-search">
                <input type="text" class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></input>
                <label for="floatingTextarea"><i class="bi bi-search me-2"></i>Digite aqui o que você procura</label>
            </div>

            <div class="d-flex gap-2 align-items-center">
                <p class="m-0">Ordenar por: </p>
                <select class="form-select filter-course" aria-label="filtrar curso">
                    <option selected>Mais recentes</option>
                    <option value="2">Cursos abertos</option>
                    <option value="2">Cursos encerrados</option>
                </select>
            </div>
        </div>

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
                    <img src="./app/assets/img/<?= $course->image ?>" class="card-img-top course-image" alt="...">
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
                            <h6 class="card-title mb-0 ">Ministrante:
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

        <nav aria-label="Page navigation" class="pagination-courses mt-5 d-flex justify-content-center">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <div class="mt-5">
        <div>
            <h2>Transformando vidas por meio da educação</h2>
            <p>A AlfaUnipac é a melhor e maior faculdade do nordeste mineiro.</p>
            <p>Nosso propósito é formar profissionais por meio da oferta de cursos diferenciados e flexibilidade nos estudos. Com a AlfaUnipac você se tornará um profissional tecnicamente capaz e dotado de conhecimentos práticos para atuar no mercado de trabalho.</p>
            <a href="">Nossa história</a>
        </div>
    </div>

    <div class="mt-5 mb-5">
        <h2>Dúvidas Frequêntes</h2>
        <div class="accordion" id="accordionPanelsStayOpenExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                        Os cursos contam como hora complementar?
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                    <div class="accordion-body">
                        <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                        É disponibilizado certificado de participação?
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                        Já fiz a minha inscrição. Posso editar a minha inscrição depois de ter sido enviada?
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                        Posso me candidatar a mais de um curso?
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer-list-courses mt-5 p-5">
        <div class="container">
            
            <div class="row d-flex justify-content-between gap-3">
                <div class="col-lg-2 logo-content">
                    <img src="./app/assets/img/logo-white-orange.png" alt="logo alfa unipac">
                    <p class="mt-3"> Rua Engenheiro Celso Murta, 600 <br>
                        Dr. Laerte Laender, Teófilo Otoni <br>
                        MG - 39803-087
                    </p>

                    <span>Direito Autoral © 2025 Alfaunipac, Todos os direitos reservados.</span>
                </div>

                <div class="col-lg-2 contact-us">
                    <h5>Siga-nos nas nossas redes!</h5>
                    <div class="d-flex gap-3 fs-4 links-container">
                        <a href="https://www.linkedin.com/company/alfaunipac" target="_blank"><i class="bi bi-linkedin"></i></a>
                        <a href="https://www.instagram.com/alfaunipac.oficial/" target="_blank"><i class="bi bi-instagram"></i></a>
                        <a href="https://www.youtube.com/c/FaculdadeAlfaUnipac" target="_blank"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 regularidade footer-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <a target="_blank" href="https://emec.mec.gov.br/emec/consulta-cadastro/detalhamento/d96957f455f6405d14c6542552b0f6eb/MTQxNTY">
                                <figure>
                                    <img src="https://alfaunipac.com.br/./site/images/emec.png" alt="AlfaUnipac Emec">
                                </figure>
                            </a>

                        </div>
                        <div class="col-lg-12 mt-2">
                            <a href="https://alfaunipac.com.br/./site/file/portaria-758.pdf" target="_blank" class="text-white">PORTARIA Nº 758, DE 20 DE JUNHO DE 2017<br>
                                Publicada em: 23 de junho de 2017</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </footer>

</div>