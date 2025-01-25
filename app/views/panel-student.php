<div class="container-fluid p-0">
    <div class="navbar navbar-expand-lg navbar-dark ftco-navbar-light container-fluid header-container" id="ftco-navbar">
        <div class="container d-flex justify-content-end align-items-center px-4 p-2">
            <div class="d-flex gap-3 fs-6 links-container">
                <a href="https://www.linkedin.com/company/alfaunipac" target="_blank" class="text-white">
                    <i class="bi bi-linkedin"></i>
                </a>
                <a href="https://www.instagram.com/alfaunipac.oficial/" target="_blank" class="text-white">
                    <i class="bi bi-instagram"></i>
                </a>
                <a href="https://www.youtube.com/c/FaculdadeAlfaUnipac" target="_blank" class="text-white">
                    <i class="bi bi-youtube"></i>
                </a>
            </div>
        </div>
    </div>
    <nav class="bg-top navbar-light">
        <div class="container">
            <div class="rows d-flex align-items-centers justify-content-between">
                <div class="col-md-4 d-flex align-items-center py-4">
                    <img class="logo-header" src="./app/assets/img/logo-color.png" alt="logo AlfaUnipac">
                </div>

                <div class="col-md-4 d-flex align-items-center justify-content-end p-0">
                    <a href="#" class="btn py-2 px-3 btn-primary d-flex align-items-center justify-content-center gap-2">
                        <i class="bi bi-person fs-5"></i>
                        <span>Entrar</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <!-- END NAV -->

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

            <div class="row">
                <?php foreach ($allCourses as $course):
                    // FORMATANDO DATAS
                    $dateCourse = new DateTime($course->date);
                    $timeInit = new DateTime($course->time);
                    $durationCourse = new DateTime($course->duration);
                    $dataAc = new DateTime();


                    $dateFormat = $dateCourse->format("d/m/Y");
                    $timeInitFormat = str_replace("00", "", $timeInit->format("H\hi"));
                    $durationFormat = str_replace("00", "", $durationCourse->format("h\hi"));


                    if ($course->open == 1 && !($dateCourse < $dataAc && $dateCourse->format("Y-m-d") !== $dataAc->format("Y-m-d"))) {
                ?>
                        <div class="col-md-6 col-lg-4 ftco-animate">
                            <div class="blog-entry">
                                <a href="blog-single.html" class="block-20 d-flex align-items-end" style="background-image: url(./app/assets/img/<?= $course->image ?>);">
                                    <div class="meta-date text-center p-2">
                                        <span class="day">26</span>
                                        <span class="mos">Julho</span>
                                        <span class="yr">2025</span>
                                    </div>
                                </a>
                                <div class="text bg-white d-flex justify-content-start gap-3 pb-2 px-4 pt-4">
                                        <div class=" d-flex align-items-center gap-2">
                                            <i class="bi bi-person-square icon-detail-course"></i>
                                            <p class="card-title mb-0 text-detail-course">
                                                <?= $course->minister ?>
                                            </p>
                                        </div>

                                        <div class=" d-flex align-items-center gap-2">
                                            <i class="bi bi-clock icon-detail-course"></i>
                                            <p class="card-title mb-0 text-detail-course"><?= $durationFormat ?></p>
                                        </div>
                                    </div>

                                <div class="text bg-white px-4">
                                    <h3 class="heading">
                                        <a href="#"><?= $course->name ?></a>
                                    </h3>

                                    <div class="card-text card-description mb-2"
                                        title="<?php echo str_replace("&nbsp;", "&#13• ", strip_tags($course->description)); ?>">
                                        <?= $course->description ?>
                                    </div>

                                    <p class="ml-auto mb-0 d-flex align-items-center gap-2">
                                        <?php
                                        if ($course->available_vacancies === 0) {
                                            echo "<span>Vagas esgotadas</span>";
                                        } else if ($course->available_vacancies == 1) {
                                            echo
                                            '<i class="bi bi-person fs-5"></i>' .
                                                $course->available_vacancies . " vaga restante";
                                        } else {
                                            echo
                                            '<i class="bi bi-person fs-5"></i>' . $course->available_vacancies . " vagas restantes";
                                        }
                                        ?>
                                    </p>

                                    <div class="d-flex align-items-center mt-4 pb-4">
                                        <?php
                                        if ($course->available_vacancies > 0) {
                                            echo '
                                            <p class="mb-0"><a href="./app/views/registration.php?id=' . $course->id . '" class="btn btn-primary">Inscreva-se <span class="ion-ios-arrow-round-forward"></span></a></p>';
                                        }
                                        ?>
                                    </div>
                                </div>
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
    </section>

    <section class="ftco-section ftco-no-pt ftc-no-pb">
        <div class="container">
            <div class="row d-flex">
                <div class="col-md-5 order-md-last wrap-about wrap-about d-flex align-items-stretch">
                    <div class="img" style="background-image: url(./app/assets/img/img2.jpg);"></div>
                </div>
                <div class="col-md-7 wrap-about py-5 pr-md-4 ftco-animate">
                    <h2 class="mb-4">Dúvidas Frequêntes</h2>
                    <p>On her way she met a copy. The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word.</p>
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
            </div>
        </div>
    </section>

    <!-- <section class="ftco-section ftco-no-pt ftc-no-pb">
        <div class="container">
            <div class="row d-flex">
                <div class="col-md-5 order-md-last wrap-about wrap-about d-flex align-items-stretch">
                    <div class="img" style="background-image: url(images/about.jpg); border"></div>
                </div>
                <div class="col-md-7 wrap-about py-5 pr-md-4 ftco-animate">
                    <h2 class="mb-4">What We Offer</h2>
                    <p>On her way she met a copy. The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word.</p>
                    <div class="row mt-5">
                        <div class="col-lg-6">
                            <div class="services-2 d-flex">
                                <div class="icon mt-2 d-flex justify-content-center align-items-center"><span class="flaticon-security"></span></div>
                                <div class="text pl-3">
                                    <h3>Safety First</h3>
                                    <p>Far far away, behind the word mountains, far from the countries Vokalia.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="services-2 d-flex">
                                <div class="icon mt-2 d-flex justify-content-center align-items-center"><span class="flaticon-reading"></span></div>
                                <div class="text pl-3">
                                    <h3>Regular Classes</h3>
                                    <p>Far far away, behind the word mountains, far from the countries Vokalia.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="services-2 d-flex">
                                <div class="icon mt-2 d-flex justify-content-center align-items-center"><span class="flaticon-diploma"></span></div>
                                <div class="text pl-3">
                                    <h3>Certified Teachers</h3>
                                    <p>Far far away, behind the word mountains, far from the countries Vokalia.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="services-2 d-flex">
                                <div class="icon mt-2 d-flex justify-content-center align-items-center"><span class="flaticon-education"></span></div>
                                <div class="text pl-3">
                                    <h3>Sufficient Classrooms</h3>
                                    <p>Far far away, behind the word mountains, far from the countries Vokalia.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="services-2 d-flex">
                                <div class="icon mt-2 d-flex justify-content-center align-items-center"><span class="flaticon-jigsaw"></span></div>
                                <div class="text pl-3">
                                    <h3>Creative Lessons</h3>
                                    <p>Far far away, behind the word mountains, far from the countries Vokalia.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="services-2 d-flex">
                                <div class="icon mt-2 d-flex justify-content-center align-items-center"><span class="flaticon-kids"></span></div>
                                <div class="text pl-3">
                                    <h3>Sports Facilities</h3>
                                    <p>Far far away, behind the word mountains, far from the countries Vokalia.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <section class="ftco-section testimony-section">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-2">
                <div class="col-md-8 text-center heading-section ftco-animate">
                    <h2 class="mb-4">Quem já foi aluno indica!</h2>
                    <p>Saiba o que nossos alunos falam sobre nossa metodologia de ensino.</p>
                </div>
            </div>
            <div class="row ftco-animate justify-content-center">
                <div class="col-md-12">
                    <div class="carousel-testimony owl-carousel">
                        <div class="item">
                            <div class="testimony-wrap d-flex">
                                <div class="user-img mr-4" style="background-image: url(images/teacher-1.jpg)">
                                </div>
                                <div class="text ml-2">
                                    <span class="quote d-flex align-items-center justify-content-center">
                                        <i class="icon-quote-left"></i>
                                    </span>
                                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                                    <p class="name">Racky Henderson</p>
                                    <span class="position">Father</span>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap d-flex">
                                <div class="user-img mr-4" style="background-image: url(images/teacher-2.jpg)">
                                </div>
                                <div class="text ml-2">
                                    <span class="quote d-flex align-items-center justify-content-center">
                                        <i class="icon-quote-left"></i>
                                    </span>
                                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                                    <p class="name">Henry Dee</p>
                                    <span class="position">Mother</span>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap d-flex">
                                <div class="user-img mr-4" style="background-image: url(images/teacher-3.jpg)">
                                </div>
                                <div class="text ml-2">
                                    <span class="quote d-flex align-items-center justify-content-center">
                                        <i class="icon-quote-left"></i>
                                    </span>
                                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                                    <p class="name">Mark Huff</p>
                                    <span class="position">Mother</span>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap d-flex">
                                <div class="user-img mr-4" style="background-image: url(images/teacher-4.jpg)">
                                </div>
                                <div class="text ml-2">
                                    <span class="quote d-flex align-items-center justify-content-center">
                                        <i class="icon-quote-left"></i>
                                    </span>
                                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                                    <p class="name">Rodel Golez</p>
                                    <span class="position">Mother</span>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap d-flex">
                                <div class="user-img mr-4" style="background-image: url(images/teacher-1.jpg)">
                                </div>
                                <div class="text ml-2">
                                    <span class="quote d-flex align-items-center justify-content-center">
                                        <i class="icon-quote-left"></i>
                                    </span>
                                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                                    <p class="name">Ken Bosh</p>
                                    <span class="position">Mother</span>
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
                    <a href="images/image_1.jpg" class="gallery image-popup img d-flex align-items-center" style="background-image: url(images/course-1.jpg);">
                        <div class="icon mb-4 d-flex align-items-center justify-content-center">
                            <span class="icon-instagram"></span>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 ftco-animate">
                    <a href="images/image_2.jpg" class="gallery image-popup img d-flex align-items-center" style="background-image: url(images/image_2.jpg);">
                        <div class="icon mb-4 d-flex align-items-center justify-content-center">
                            <span class="icon-instagram"></span>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 ftco-animate">
                    <a href="images/image_3.jpg" class="gallery image-popup img d-flex align-items-center" style="background-image: url(images/image_3.jpg);">
                        <div class="icon mb-4 d-flex align-items-center justify-content-center">
                            <span class="icon-instagram"></span>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 ftco-animate">
                    <a href="images/image_4.jpg" class="gallery image-popup img d-flex align-items-center" style="background-image: url(images/image_4.jpg);">
                        <div class="icon mb-4 d-flex align-items-center justify-content-center">
                            <span class="icon-instagram"></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>


    <footer class="ftco-footer ftco-bg-dark ftco-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-6 col-lg-3">
                    <div class="ftco-footer-widget mb-5">
                        <h2 class="ftco-heading-2">Have a Questions?</h2>
                        <div class="block-23 mb-3">
                            <ul>
                                <li><span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
                                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+2 392 3929 210</span></a></li>
                                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">info@yourdomain.com</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="ftco-footer-widget mb-5">
                        <h2 class="ftco-heading-2">Recent Blog</h2>
                        <div class="block-21 mb-4 d-flex">
                            <a class="blog-img mr-4" style="background-image: url(images/image_1.jpg);"></a>
                            <div class="text">
                                <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about</a></h3>
                                <div class="meta">
                                    <div><a href="#"><span class="icon-calendar"></span> June 27, 2019</a></div>
                                    <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                                    <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                                </div>
                            </div>
                        </div>
                        <div class="block-21 mb-5 d-flex">
                            <a class="blog-img mr-4" style="background-image: url(images/image_2.jpg);"></a>
                            <div class="text">
                                <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about</a></h3>
                                <div class="meta">
                                    <div><a href="#"><span class="icon-calendar"></span> June 27, 2019</a></div>
                                    <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                                    <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="ftco-footer-widget mb-5 ml-md-4">
                        <h2 class="ftco-heading-2">Links</h2>
                        <ul class="list-unstyled">
                            <li><a href="#"><span class="ion-ios-arrow-round-forward mr-2"></span>Home</a></li>
                            <li><a href="#"><span class="ion-ios-arrow-round-forward mr-2"></span>About</a></li>
                            <li><a href="#"><span class="ion-ios-arrow-round-forward mr-2"></span>Services</a></li>
                            <li><a href="#"><span class="ion-ios-arrow-round-forward mr-2"></span>Deparments</a></li>
                            <li><a href="#"><span class="ion-ios-arrow-round-forward mr-2"></span>Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="ftco-footer-widget mb-5">
                        <h2 class="ftco-heading-2">Subscribe Us!</h2>
                        <form action="#" class="subscribe-form">
                            <div class="form-group">
                                <input type="text" class="form-control mb-2 text-center" placeholder="Enter email address">
                                <input type="submit" value="Subscribe" class="form-control submit px-3">
                            </div>
                        </form>
                    </div>
                    <div class="ftco-footer-widget mb-5">
                        <h2 class="ftco-heading-2 mb-0">Connect With Us</h2>
                        <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-3">
                            <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </footer>

</div>

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
                <p class="fs-5 mb-4">Explore nossa plataforma com conteúdos preparados especialmente para você se desenvolver ainda mais!</p>
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


                if ($course->open == 1 && !($dateCourse < $dataAc && $dateCourse->format("Y-m-d") !== $dataAc->format("Y-m-d"))) {
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
                                    echo "<span>Vagas esgotadas</span>";
                                } else if ($course->available_vacancies == 1) {
                                    echo $course->available_vacancies . " vaga restante";
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