<?php

require_once("../../db.php");
require_once("../models/message.php");
require_once("../models/registration.php");
require_once("../dao/RegistrationDAO.php");
require_once("../dao/CourseDAO.php");

$registrationDAO = new RegistrationDAO($connect, $BASE_URL);
$message = new Message($BASE_URL);

$timeZone = new DateTimeZone('America/Sao_Paulo');
$dateAc = new DateTime('now', $timeZone);
$currentYearAc = $dateAc->format("Y");

$courseDAO = new CourseDAO($connect, $BASE_URL);

$type = filter_input(INPUT_POST, "type");

if ($type == "register") {

    $name = filter_input(INPUT_POST, "student_name");
    $email = filter_input(INPUT_POST, "student_email");
    $cpf = filter_input(INPUT_POST, "student_cpf");
    $phone = filter_input(INPUT_POST, "student_phone");
    $dateBth = filter_input(INPUT_POST, "student_bth");
    $gender = filter_input(INPUT_POST, "student_gender");

    $register = new Registration;

    if ($register) {

        $register->name = $name;
        $register->email = $email;
        $register->cpf = $cpf;
        $register->phone = $phone;
        $register->dateBth = $dateBth;
        $register->gender = $gender;
        $register->created_at = $dateAc->format("Y-m-d H:i:s");

        // VALIDAÇÃO DA DATA +10 OU -100
        $bthYearFormat = new DateTime($dateBth);

        if ($bthYearFormat->format("Y") <= ($currentYearAc - 10) && $bthYearFormat->format("Y") >= ($currentYearAc - 100)) {

           $registrationDAO->createRegistration($register);

           $idContact =  $registrationDAO->createRegistration($register);
           $registration = $registrationDAO->findByIdRegistration($idContact);

           $idCourse = filter_input(INPUT_GET, "id_course");
           $course = $courseDAO->findByIdCourse($idCourse);

           $createdAt = $dateAc->format("Y-m-d H:i:s");

           $registrationDAO->createCourseRegistration($course, $registration, $createdAt);
           
            var_dump( $idContact,  $idCourse, $registration->id, $course->name);
            exit();

            $registrationDAO->message->setMessage("Inscrição realizada com sucesso!", "success", "", "back");
        } else {
            $registrationDAO->message->setMessage("Oops...", "error", "Não foi possível realizar inscrição, data de nascimento inválida.", "back");
        }
    } else {
        $registrationDAO->message->setMessage("Oops...", "error", "Ocorreu algum erro, não foi possível realizar inscrição.", "back");
    }
} else if ($type == "delete") {

    $id = filter_input(INPUT_POST, "id");

    $register = $registrationDAO->findByIdRegistration($id);

    if ($register) {

        $registrationDAO->deleteRegistration($register, $register->id);
    }
} else if ($type == "update") {
    $name = filter_input(INPUT_POST, "student_name");
    $email = filter_input(INPUT_POST, "student_email");
    $cpf = filter_input(INPUT_POST, "student_cpf");
    $phone = filter_input(INPUT_POST, "student_phone");
    $dateBth = filter_input(INPUT_POST, "student_bth");
    $gender = filter_input(INPUT_POST, "student_gender");
    $id = filter_input(INPUT_POST, "id");

    $registerData = $registrationDAO->findByIdRegistration($id);

    if ($registerData) {
        $registerData->name = $name;
        $registerData->email = $email;
        $registerData->cpf = $cpf;
        $registerData->phone = $phone;
        $registerData->dateBth = $dateBth;
        $registerData->gender = $gender;
        $registerData->updated_at = $dateAc->format("Y-m-d H:i:s");

        $registrationDAO->updateRegistration($registerData);
    }
}
