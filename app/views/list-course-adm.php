<div class="container-fluid p-0">

    <?php
    require_once("./app/layout/provisorio.php");
    ?>

    <div class="container p-1 mt-5 mb-5">

        <nav aria-label="breadcrumb mb-5">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= $BASE_URL ?>">Início</a></li>
                <li class="breadcrumb-item active" aria-current="page">Painel do Administrador</li>
            </ol>
        </nav>

        <div class="d-flex align-items-start justify-content-between">
            <div>
                <h2>Minicursos Alfa Unipac</h2>
                <p>Painel do administrador</p>
            </div>

            <div class="d-flex gap-3 header-buttons">
                <div class="dropdown">
                    <button
                        class="dropdown-toggle btn btn-outline-secondary d-flex align-items-center header-export"
                        type="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="bi bi-folder-check me-2"></i>Exportar
                    </button>
                    <ul class="dropdown-menu">
                        <li><button class="dropdown-item" id="btnExcel">Excel</button></li>
                        <li><button class="dropdown-item" id="btnPdf">PDF</button></li>
                        <li><button class="dropdown-item" id="btnPrint">Imprimir</button></li>
                    </ul>
                </div>
                <a class="btn btn-primary d-flex align-items-center header-add-course" href="<?= $BASE_URL ?>app/views/add-courses.php" role="button">
                    <i class="bi bi-plus-lg me-2"></i>Novo Curso
                </a>
            </div>
        </div>

        <ul class="nav nav-tabs mb-5 mt-4 submenu-header">
            <li class="nav-item">
                <a class="nav-link <?= @$_REQUEST['action'] === 'courses' || empty($_REQUEST['action']) ? 'active' : '' ?>" aria-current="page" href="?page=adm&action=courses">Todos os Cursos
                    <span class="badge text-bg-secondary">
                        <?= $totalCourses ?>
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= @$_REQUEST['action'] === 'registrations' ? 'active' : '' ?>" href="?page=adm&action=registrations">Todas as Inscrições
                    <span class="badge text-bg-secondary"><?= $totalRegistrations ?></span>
                </a>
            </li>
        </ul>

        <div class="container p-0 font-table">
            <?php
            switch (@$_REQUEST["action"]) {
                case "courses":
                    include("./app/views/all-courses.php");
                    break;

                case "registrations":
                    include("./app/views/all-registrations.php");
                    break;

                default:
                    include("./app/views/all-courses.php");
                    break;
            }
            ?>
        </div>

    </div>

</div>

<div class="mt-5">
    <?php
    require_once("./app/layout/footer.php");
    ?>
</div>