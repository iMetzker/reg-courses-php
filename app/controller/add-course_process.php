<?php
require_once("../../db.php");
require_once("../models/course.php");
require_once("../DAO/CourseDAO.php");

$courseDAO = new CourseDAO($connect, $BASE_URL);

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

    if ($open === null) {
        $open = 0;
    }

    $course = new Course;

    // VALIDANDO FORMULÁRIO ANTES DE CONCATENAR COM O DB
    if (!empty($name) && !empty($vacancies)) {

        $course->name = $name;
        $course->description = $description;
        $course->vacancies = $vacancies;
        $course->open = $open;
        $course->date = $date;
        $course->minister = $minister;
        $course->time = $time;
        $course->duration = $duration;
        $course->created_at = $dateAc->format("Y/m/d H:i:s");


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
}
