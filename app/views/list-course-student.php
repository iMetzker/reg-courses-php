<div class="container-fluid p-0">
    <div class="p-5 header-container">
        <div class="z-2 position-relative container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb text-light">
                    <li class="breadcrumb-item"><a class="text-light" href="<?= $BASE_URL ?>">Início</a></li>
                    <li class="breadcrumb-item active text-light" aria-current="page">Painel do Aluno</li>
                </ol>
            </nav>

            <div class="mb-4">
                <h1>Experimente ir além da sala de aula com a Alfa</h1>
                <p class="fs-5 mb-4">Explore nossa plataforma além da sala de aula com conteúdos preparados especialmente para você se desenvolver ainda mais!</p>
                <a class="rounded text-light fw-semibold ms-2 btn-header" href="https://revista.unipacto.com.br/" target="_blank">Conheça nossa revista acadêmica</a>
            </div>

            <img class="logo-header" src="./app/assets/img/logo-white-orange.png" alt="logo AlfaUnipac">

        </div>
    </div>

    <div class="container mt-5">

        <h2 class="text-start">Minicursos, eventos e palestras</h2>
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

        <div class="d-flex justify-content-center flex-wrap gap-3 mt-5">
            <?php foreach ($allCourses as $course):

                // FORMATANDO DATAS
                $dateCourse = new DateTime($course->date);
                $timeInit = new DateTime($course->time);
                $durationCourse = new DateTime($course->duration);
                $dataAc = new DateTime();


                $dateFormat = $dateCourse->format("d/m/Y");
                $timeInitFormat = str_replace("00", "", $timeInit->format("H\hi"));
                $durationFormat = str_replace("00", "", $durationCourse->format("h\hi"));


                if ($course->open === 1 && !($dateCourse < $dataAc && $dateCourse->format("Y-m-d") !== $dataAc->format("Y-m-d"))) {
            ?>
                <div class="card">
                    <div class="image-container position-relative">
                        <img src="./app/assets/img/<?= $course->image ?>" class="card-img-top course-image" alt="imagem ilustrativa do curso">
                        <img src="./app/assets/img/logo-color.png" alt="logo AlfaUnipac" class="logo-cards position-absolute">
                    </div>
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
                            if ($course->available_vacancies === 0) {
                                echo "<span>Vagas encerradas</span>";
                            } else {
                                echo $course->available_vacancies . " vagas restantes";
                            }
                            ?>
                        </footer>
                        <?php
                        if ($course->available_vacancies > 0) {
                            echo '<a class="card-text card-icon fs-4" href="./app/views/registration.php?id=' . $course->id . '">
                            Inscrever-se <i class="bi bi-person-add"></i></a>';
                        }
                        ?>
                    </div>
                </div>
            <?php }
         endforeach; ?>
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

    <div class="container mt-5 d-flex p-5 gap-5 align-items-center justify-content-center flex-wrap">
        <div class="about-content">
            <h2>Transformando vidas por meio da educação</h2>
            <p class="fs-5">A AlfaUnipac é a melhor e maior faculdade do nordeste mineiro.</p>
            <p class="mb-5">Nosso propósito é formar profissionais por meio da oferta de cursos diferenciados e flexibilidade nos estudos. Com a AlfaUnipac você se tornará um profissional tecnicamente capaz e dotado de conhecimentos práticos para atuar no mercado de trabalho.</p>
            <a class="rounded-pill fs-6 text-light fw-semibold btn-about" href="https://alfaunipac.com.br/sobre-a-alfaunipac" target="_blank">Nossa história</a>
        </div>

        <div class="mt-5 custom-grid">
            <div class="grid-item-1">
                <img src="./app/assets/img/header-woman1.png" class="img-fluid" alt="aluna com cadernos">
            </div>
            <div class="grid-item-2">
                <img src="./app/assets/img/woman2.jpg" class="img-fluid" alt="aluna com cadernos">
            </div>
            <div class="grid-item-3">
                <img src="./app/assets/img/man1.jpg" class="img-fluid" alt="aluna com notebook">
            </div>
        </div>
    </div>

    <div class="container p-5 d-flex flex-column justify-content-center align-items-center gap-3">
        <h2>Dúvidas frequêntes</h2>
        <div class="accordion" id="accordionPanelsStayOpenExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                        Os cursos contam como hora complementar?
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                    <div class="accordion-body">
                        <strong>Sim! Todos os cursos podem valer como horas complementares na nossa instituição.</strong> Basta ao final do curso, protocolar o certificado de participação junto a ouvidoria. É importante, no entando, salientar que se o curso realizado for de acordo com sua formação a carga horária será totalmente aproveitada, se caso escolher um curso de um nicho diferente da sua formação poderá não ser aproveitado o total de horas do curso.
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
                        <strong>Sim!</strong> Todos os cursos possuem certificado de participação, basta se atentar a confirmação de presença que será solicitada durante a realização do mesmo.
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
                        <strong>Não.</strong> O aluno não tem acesso a edição de inscrições enviadas, se caso desistir de algum curso, entre em contato com a Ouvidoria para cancelar sua inscrição.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
                        Posso me candidatar a mais de um curso?
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        <strong>Sim!</strong> Você pode se candidatar em quantos cursos quiser. Se atente, no entando, para a data de realização dos cursos.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFive" aria-expanded="false" aria-controls="panelsStayOpen-collapseFive">
                        Posso realizar um curso diferente da minha formação?
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        <strong>Sim!</strong> Você pode realizar qualquer curso da nossa plataforma, <b>não sendo um pré requisito</b> ter nível superior cursando ou em curso.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseSix" aria-expanded="false" aria-controls="panelsStayOpen-collapseSix">
                        Não sou aluno Alfa, posso me inscrever em algum curso?
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseSix" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        <strong>Sim!</strong> Nossos mini cursos são uma iniciativa em prol da livre aducação para a comunidade, para realizá-los <b>não é necessário estar matriculado</b>.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer-list-courses mt-5 p-5">
        <div class="container">

            <div class="row d-flex justify-content-between gap-3">
                <div class="col-lg-2 logo-content">
                    <img src="./app/assets/img/logo-white-orange.png" alt="logo Alfa Unipac">
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