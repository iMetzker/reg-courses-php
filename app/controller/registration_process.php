<?php
require_once("../../db.php");
require_once("../models/message.php");
require_once("../models/registration.php");
require_once("../dao/RegistrationDAO.php");
require_once("../dao/ContactDAO.php");


$registrationDAO = new RegistrationDAO($connect, $BASE_URL);
$contactDAO = new ContactDAO($connect, $BASE_URL);
$message = new Message($BASE_URL);


$timeZone = new DateTimeZone('America/Sao_Paulo');
$dateAc = new DateTime('now', $timeZone);

$dateAcFormat = $dateAc->format("Y-m-d H:i:s");

$idContact = filter_input(INPUT_GET, "id_contact", FILTER_VALIDATE_INT);
$idCourse = filter_input(INPUT_GET, "id_course", FILTER_VALIDATE_INT);
$typeAdd = filter_input(INPUT_GET, "action");

$type = filter_input(INPUT_POST, "type");

if ($typeAdd == "register") {

    if ($idContact && $idCourse) {

        $registrationDAO->createCourseRegistration($idContact, $idCourse, $dateAcFormat);

        $registrationDAO->message->setMessage("Inscrição realizada com sucesso!", "success", "", "back");
    } else {
        $registrationDAO->message->setMessage("Dados inválidos. Não foi possível realizar a inscrição.", "error", "", "back");
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

    $contactData = $contactDAO->findByIdContact($id);

    if ($contactData) {
        $contactData->name = $name;
        $contactData->email = $email;
        $contactData->cpf = $cpf;
        $contactData->phone = $phone;
        $contactData->dateBth = $dateBth;
        $contactData->gender = $gender;
        $contactData->updated_at = $dateAc->format("Y-m-d H:i:s");

        $contactDAO->updateContact($contactData);
        $registrationDAO->updateCourseRegistration($contactData);
    }
}
