<?php
require_once("../../db.php");
require_once("../models/message.php");
require_once("../models/course.php");
require_once("../DAO/CourseDAO.php");

$courseDAO = new CourseDAO($connect, $BASE_URL);
$message = new Message($BASE_URL);

$timeZone = new DateTimeZone('America/Sao_Paulo');
$dateAc = new DateTime('now', $timeZone);

// FILTRA O TIPO DO FORMULÁRIO, EVITANDO DADOS MALICIOSOS DE SEREM INSERIDOS
$type = filter_input(INPUT_POST, "type");

if ($type == "create") {

    // RECEBENDO OS DADOS DOS INPUTS
    $name = filter_input(INPUT_POST, "course_name");
    $description = filter_input(INPUT_POST, "course_description");
    $vacancies = filter_input(INPUT_POST, "course_vacancies");
    $open = filter_input(INPUT_POST, "course_open");
    $minister = filter_input(INPUT_POST, "course_minister");
    $date = filter_input(INPUT_POST, "course_date");
    $time = filter_input(INPUT_POST, "course_time");
    $duration = filter_input(INPUT_POST, "course_duration");

    // GARANTIR QUE RETORNARÁ BOOLEAN
    if ($open === null) {
        $open = 0;
    }

    $course = new Course;

    // VALIDANDO FORMULÁRIO ANTES DE CONCATENAR COM O DB
    if (!empty($name) && !empty($minister) && !empty($description) && !empty($vacancies) && !empty($date) && !empty($time) && !empty($duration)) {

        $course->name = $name;
        $course->description = $description;
        $course->vacancies = $vacancies;
        $course->open = $open;
        $course->date = $date;
        $course->minister = $minister;
        $course->time = $time;
        $course->duration = $duration;
        $course->created_at = $dateAc->format("Y/m/d H:i:s");

        // TRATANDO O ULPLOAD DA IMAGEM
        if (isset($_FILES["course_image"]) && !empty($_FILES['course_image']['tmp_name'])) {
            $image = $_FILES['course_image'];
            $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
            $jpgArray = ["image/jpeg", "image/jpg"];

            if (in_array($image["type"], $imageTypes)) {

                if (in_array($image["type"], $jpgArray)) {
                    $imageFile = imagecreatefromjpeg($image["tmp_name"]);
                } else {
                    $imageFile = imagecreatefrompng($image["tmp_name"]);
                }

                $imageName = $course->imageGenerateName();
                imagejpeg($imageFile, "../assets/img/" . $imageName, 100);

                $course->image = $imageName;
            } else {
                $message->setMessage("Tipo inválido de imagem", "error", "Envie uma imagem do tipo .png, .jpeg ou .jpg", "back");
            }
        }

        $courseDAO->createCourse($course);

        $courseDAO->message->setMessage("Curso cadastrado com sucesso!", "success", "", "back");
    } else {
        $courseDAO->message->setMessage("Cadastro de curso não realizado!", "error", "Você precisa adicionar pelo menos: nome do curso e quantidade de vagas.", "back");
    }
} else if ($type == "delete") {

    $id = filter_input(INPUT_POST, "id");
    $course = $courseDAO->findByIdCourse($id);

    if ($course) {
        $courseDAO->deleteViewCourse($course->id);
    }
} else if ($type == "update") {

    $name = filter_input(INPUT_POST, "course_name");
    $description = filter_input(INPUT_POST, "course_description");
    $vacancies = filter_input(INPUT_POST, "course_vacancies");
    $open = filter_input(INPUT_POST, "course_open");
    $minister = filter_input(INPUT_POST, "course_minister");
    $date = filter_input(INPUT_POST, "course_date");
    $time = filter_input(INPUT_POST, "course_time");
    $duration = filter_input(INPUT_POST, "course_duration");
    $id = filter_input(INPUT_POST, "id");


    $courseData = $courseDAO->findByIdCourse($id);

    if ($courseData) {

        // ATRIBUINDO NOVOS VALORES
        $courseData->name = $name;
        $courseData->minister = $minister;
        $courseData->description = $description;
        $courseData->date = $date;
        $courseData->time = $time;
        $courseData->duration = $duration;
        $courseData->vacancies = $vacancies;
        $courseData->open = $open;
        $courseData->updated_at = $dateAc->format("Y/m/d H:i:s");



        if (isset($_FILES["course_image"]) && !empty($_FILES['course_image']['tmp_name'])) {
            $image = $_FILES['course_image'];
            $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
            $jpgArray = ["image/jpeg", "image/jpg"];

            if (in_array($image["type"], $imageTypes)) {

                if (in_array($image["type"], $jpgArray)) {
                    $imageFile = imagecreatefromjpeg($image["tmp_name"]);
                } else {
                    $imageFile = imagecreatefrompng($image["tmp_name"]);
                }

                $course = new Course();

                $imageName = $course->imageGenerateName();
                imagejpeg($imageFile, "../assets/img/" . $imageName, 100);

                $courseData->image = $imageName;
                
            } else {
                $message->setMessage("Tipo inválido de imagem", "error", "Envie uma imagem do tipo .png, .jpeg ou .jpg", "back");
            }
        }

        $courseDAO->updateCourse($courseData);
    }
}
