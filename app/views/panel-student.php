<div class="container-fluid p-0">
    <?php
    require_once("./app/layout/header.php");
    ?>

    <section class="home-slider owl-carousel">
        <div class="slider-item slider-img-1">
            <div class="overlay"></div>
            <div class="container">
                <div class="row no-gutters slider-text align-items-center justify-content-start" data-scrollax-parent="true">
                    <div class="col-md-6 ftco-animate">
                        <h1 class="mb-4">Explore nossos minicursos</h1>
                        <p>Com conteúdos preparados especialmente para você se desenvolver ainda mais!</p>
                        <p><a href="#courses_section" class="btn btn-primary px-4 py-3 mt-3">Explorar minicursos</a></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="slider-item slider-img-2">
            <div class="overlay"></div>
            <div class="container">
                <div class="row no-gutters slider-text align-items-center justify-content-start" data-scrollax-parent="true">
                    <div class="col-md-6 ftco-animate">
                        <h1 class="mb-4">Já conhece nossa revista acadêmica?</h1>
                        <p>Descubra artigos exclusivos que vão impulsionar sua carreira!</p>
                        <p><a href="https://revista.unipacto.com.br/" target="_blank" class="btn btn-primary px-4 py-3 mt-3">Conhecer revista acadêmica</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-services ftco-no-pb">
        <div class="container-wrap">
            <div class="row no-gutters">
                <div class="col-md-3 d-flex services align-self-stretch py-5 px-4 ftco-animate bg-primary">
                    <div class="media block-6 d-block text-center">
                        <div class="icon d-flex justify-content-center align-items-center">
                            <span class="flaticon-teacher"></span>
                        </div>
                        <div class="media-body p-2 mt-3">
                            <h3 class="heading">Professores Especialistas</h3>
                            <p>Equipe de professores altamente qualificados, prontos para oferecer o melhor ensino.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex services align-self-stretch py-5 px-4 ftco-animate bg-darken">
                    <div class="media block-6 d-block text-center">
                        <div class="icon d-flex justify-content-center align-items-center">
                            <span class="flaticon-reading"></span>
                        </div>
                        <div class="media-body p-2 mt-3">
                            <h3 class="heading">Conteúdo Atualizado</h3>
                            <p>Conteúdo com base nas tendências de mercado, garantindo que você esteja sempre atualizado.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex services align-self-stretch py-5 px-4 ftco-animate bg-primary">
                    <div class="media block-6 d-block text-center">
                        <div class="icon d-flex justify-content-center align-items-center">
                            <span class="flaticon-books"></span>
                        </div>
                        <div class="media-body p-2 mt-3">
                            <h3 class="heading">Ensino de Qualidade</h3>
                            <p>Salas equipadas e materiais de apoio garantindo o conforto e a eficácia do seu aprendizado.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex services align-self-stretch py-5 px-4 ftco-animate bg-darken">
                    <div class="media block-6 d-block text-center">
                        <div class="icon d-flex justify-content-center align-items-center">
                            <span class="flaticon-diploma"></span>
                        </div>
                        <div class="media-body p-2 mt-3">
                            <h3 class="heading">Certificado de Conclusão</h3>
                            <p>Conclua nossos cursos e receba um certificado autenticado para compartilhar nas redes sociais!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section bg-light" id="courses_section">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-2">
                <div class="col-md-8 text-center heading-section ftco-animate">
                    <h2 class="mb-4"><span>Minicursos</span> Alfa</h2>
                </div>
            </div>

            <div class="d-flex justify-content-between gap-3 mb-5">
                <div class="form-floating input-search">
                    <input type="text" class="form-control" placeholder="Digite aqui o que você procura..." id="searchInput"></input>
                    <label for="searchInput"><i class="bi bi-search me-2"></i>Digite aqui o que você procura</label>
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

            <div class="row" id="coursesContainer">
                <?php foreach ($allCourses as $course):
                    // FORMATANDO DATAS
                    setlocale(LC_TIME, 'pt_BR.UTF-8', 'pt_BR', 'Portuguese_Brazil.1252');
                    $dateCourse = new DateTime($course->date);
                    $timeInit = new DateTime($course->time);
                    $durationCourse = new DateTime($course->duration);
                    $dataAc = new DateTime();

                    $dateDayFormat = $dateCourse->format("d");
                    $dateMonthFormat = ucfirst(strtolower(strftime('%b', $dateCourse->getTimestamp())));
                    $dateYearFormat = $dateCourse->format("Y");

                    $timeInitFormat = str_replace("00", "", $timeInit->format("H\hi"));
                    $durationFormat = str_replace("00", "", $durationCourse->format("h\hi"));


                    if ($course->open == 1 && !($dateCourse < $dataAc && $dateCourse->format("Y-m-d") !== $dataAc->format("Y-m-d"))) {
                ?>
                        <div class="col-md-6 col-lg-4 ftco-animate course-card">
                            <div class="blog-entry">
                                <a href="./app/views/registration.php?id=<?= $course->id ?>" class="block-20 d-flex align-items-end" style="background-image: url(./app/assets/img/<?= $course->image ?>);">
                                    <div class="meta-date text-center p-2 course-date">
                                        <span class="day"><?= $dateDayFormat ?></span>
                                        <span class="mos"><?= $dateMonthFormat ?></span>
                                        <span class="yr"><?= $dateYearFormat ?></span>
                                    </div>

                                    <div class="meta-date text-center p-2 ma-5 detail-course-hour">
                                        <span class="mos">ás <?= $timeInitFormat ?></span>
                                    </div>
                                </a>
                                <div class="text bg-white d-flex justify-content-start gap-3 pb-2 px-4 pt-4">
                                    <div
                                        class="d-flex align-items-center gap-2"
                                        style="font-size: 12px; font-weight: bold;">
                                        <i
                                            class="bi bi-person-square icon-detail-course"
                                            style="color: #fd7e14;"></i>
                                        <p class="card-title mb-0">
                                            <?= $course->minister ?>
                                        </p>
                                    </div>

                                    <div
                                        class=" d-flex align-items-center gap-2"
                                        style="font-size: 12px; font-weight: bold;">
                                        <i
                                            class="bi bi-clock-fill icon-detail-course"
                                            style="color: #fd7e14;"></i>
                                        <p class="card-title mb-0 text-detail-course">
                                            <?= $durationFormat ?></p>
                                    </div>
                                </div>

                                <div class="text bg-white px-4">
                                    <h3 class="heading">
                                        <a href="./app/views/registration.php?id=<?= $course->id ?>"><?= $course->name ?></a>
                                    </h3>

                                    <div class="card-text card-description mb-2"
                                        title="<?php echo str_replace("&nbsp;", "&#13• ", strip_tags($course->description)); ?>">
                                        <?= $course->description ?>
                                    </div>

                                    <div class="d-flex align-items-center mt-4 pb-4 justify-content-between">
                                        <?php
                                        if ($course->available_vacancies > 0) {
                                            echo '
                                            <p class="mb-0"><a href="./app/views/registration.php?id=' . $course->id . '" class="btn btn-primary">Inscreva-se <span class="ion-ios-arrow-round-forward"></span></a></p>';
                                        }
                                        ?>

                                        <p class="m-0 d-flex align-items-center gap-2">
                                            <?php
                                            if ($course->available_vacancies === 0) {
                                                echo
                                                '<i class="bi bi-person-exclamation fs-5"
                                                 style="color: #fd7e14;"></i>' .
                                                    '<span>Vagas esgotadas</span>';
                                            } else if ($course->available_vacancies == 1) {
                                                echo
                                                '<i class="bi bi-person fs-5"
                                                 style="color: #fd7e14;"></i>' .
                                                    $course->available_vacancies . " vaga";
                                            } else {
                                                echo
                                                '<i class="bi bi-person fs-5"
                                                 style="color: #fd7e14;"></i>' . $course->available_vacancies . " vagas";
                                            }
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php }
                endforeach; ?>

            </div>

            <div class="alert alert-warning no-result d-none" id="noResult" role="alert">
                <i class="bi bi-x-circle me-2"></i>
                Oops... Sinto muito, nenhum curso com este nome foi encontrado.
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
    </section>

    <section class="ftco-section ftco-no-pt ftc-no-pb">
        <div class="container">
            <div class="row d-flex">
                <div class="col-md-5 order-md-last wrap-about wrap-about d-flex align-items-stretch">
                    <div class="img" style="background-image: url(./app/assets/img/img2.jpg);"></div>
                </div>
                <div class="col-md-7 wrap-about py-5 pr-md-4 ftco-animate">
                    <h2 class="mb-4">Dúvidas Frequêntes</h2>
                    <p>Sabemos que durante sua jornada podem surgir algumas dúvidas, e estamos aqui para ajudar. Aqui, você encontrará respostas rápidas e detalhadas para as perguntas mais comuns dos nossos alunos.</p>
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
                                    Já fiz a minha inscrição, posso editá-la depois de ter sido enviada?
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
                                    <strong>Sim!</strong> Nossos mini cursos são uma iniciativa em prol da livre aducação para a comunidade, para realizá-los <b>não é necessário estar matriculado em nossa instituição</b>.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section testimony-section">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-2">
                <div class="col-md-8 text-center heading-section ftco-animate">
                    <h2 class="mb-4">Quem é aluno indica!</h2>
                    <p>Nos orgulhamos em fazer parte da jornada acadêmica de cada um de nossos alunos. Confira o que eles têm a dizer sobre nossa metodologia de ensino!</p>
                </div>
            </div>
            <div class="row ftco-animate justify-content-center">
                <div class="col-md-12">
                    <div class="carousel-testimony owl-carousel">
                        <div class="item">
                            <div class="testimony-wrap d-flex">
                                <div class="text ml-2">
                                    <span class="quote d-flex align-items-center justify-content-center">
                                        <i class="icon-quote-left"></i>
                                    </span>
                                    <p>Diz o ditado chinês que uma longa caminhada começa com o primeiro passo. E a escolha de uma boa Faculdade para a graduação.</p>
                                    <p class="name">Breno Gil de Carvalho</p>
                                    <span class="position">Ex-Aluno do Curso de Direito</span>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap d-flex">
                                <div class="text ml-2">
                                    <span class="quote d-flex align-items-center justify-content-center">
                                        <i class="icon-quote-left"></i>
                                    </span>
                                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                                    <p class="name">Ivny Metzker</p>
                                    <span class="position">Aluna do Curso de Sistemas de Informação</span>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap d-flex">
                                <div class="text ml-2">
                                    <span class="quote d-flex align-items-center justify-content-center">
                                        <i class="icon-quote-left"></i>
                                    </span>
                                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                                    <p class="name">Fulana de Tal</p>
                                    <span class="position">Aluna do Curso de Odontologia</span>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap d-flex">
                                <div class="text ml-2">
                                    <span class="quote d-flex align-items-center justify-content-center">
                                        <i class="icon-quote-left"></i>
                                    </span>
                                    <p>Estudar na AlfaUnipac foi muito importante para minha formação profissional, pois adquiri conhecimentos não só teóricos como também práticos.</p>
                                    <p class="name">Moisés Borges</p>
                                    <span class="position">Ex-Aluno do curso de Sistemas de Informação</span>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap d-flex">
                                <div class="text ml-2">
                                    <span class="quote d-flex align-items-center justify-content-center">
                                        <i class="icon-quote-left"></i>
                                    </span>
                                    <p>O Curso de Administração da Faculdade Presidente Antônio Carlos oferece realmente os elementos básicos necessários à formação de um bom profissional da área.</p>
                                    <p class="name">Bruna Doehler Santos</p>
                                    <span class="position">Ex-Aluna do Curso de Administração</span>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap d-flex">
                                <div class="text ml-2">
                                    <span class="quote d-flex align-items-center justify-content-center">
                                        <i class="icon-quote-left"></i>
                                    </span>
                                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                                    <p class="name">Saimon Tal</p>
                                    <span class="position">Aluno do Curso de Administração</span>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="testimony-wrap d-flex">
                                <div class="text ml-2">
                                    <span class="quote d-flex align-items-center justify-content-center">
                                        <i class="icon-quote-left"></i>
                                    </span>
                                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                                    <p class="name">Fulano de Tal</p>
                                    <span class="position">Aluno do Curso de Medicina</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-gallery">
        <div class="container-wrap">
            <div class="row no-gutters">
                <div class="col-md-3 ftco-animate">
                    <a href="https://www.instagram.com/p/C8re6HHgiP5/?img_index=1" target="_blank" class="gallery img d-flex align-items-center bg-img-footer5">
                        <div class="icon mb-4 d-flex align-items-center justify-content-center">
                            <span class="icon-instagram"></span>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 ftco-animate">
                    <a href="https://www.instagram.com/p/DAb0ocVvYGp/?img_index=1" target="_blank" class="gallery img d-flex align-items-center bg-img-footer2">
                        <div class="icon mb-4 d-flex align-items-center justify-content-center">
                            <span class="icon-instagram"></span>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 ftco-animate">
                    <a href="https://www.instagram.com/p/DDhhg99xGuL/" target="_blank" class="gallery img d-flex align-items-center bg-img-footer3">
                        <div class="icon mb-4 d-flex align-items-center justify-content-center">
                            <span class="icon-instagram"></span>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 ftco-animate">
                    <a href="https://www.instagram.com/p/DChoGSuPnQl/?img_index=1" target="_blank" class="gallery img d-flex align-items-center bg-img-footer4">
                        <div class="icon mb-4 d-flex align-items-center justify-content-center">
                            <span class="icon-instagram"></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <?php
    require_once("./app/layout/footer.php");
    ?>
</div>