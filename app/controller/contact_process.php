<?php

require_once("../../db.php");
require_once("../models/message.php");
require_once("../models/contact.php");
require_once("../dao/ContactDAO.php");

$contactDAO = new ContactDAO($connect, $BASE_URL);
$message = new Message($BASE_URL);

$timeZone = new DateTimeZone('America/Sao_Paulo');
$dateAc = new DateTime('now', $timeZone);

$dateAcFormat = $dateAc->format("Y-m-d H:i:s");

$type = filter_input(INPUT_POST, "type");

if ($type == "register") {

    $name = filter_input(INPUT_POST, "student_name");
    $email = filter_input(INPUT_POST, "student_email");
    $cpf = filter_input(INPUT_POST, "student_cpf");
    $phone = filter_input(INPUT_POST, "student_phone");
    $dateBth = filter_input(INPUT_POST, "student_bth");
    $gender = filter_input(INPUT_POST, "student_gender");

    $contact = new Contact;

    if ($contact) {

        $contact->name = $name;
        $contact->email = $email;
        $contact->cpf = $cpf;
        $contact->phone = $phone;
        $contact->dateBth = $dateBth;
        $contact->gender = $gender;
        $contact->created_at = $dateAc->format("Y-m-d H:i:s");

        $idContact = $contactDAO->createContact($contact);
        $idCourse = filter_input(INPUT_GET, "id_course");

        if ($idContact) {
            header("Location: registration_process.php?&action=$type&id_contact=$idContact&id_course=" . $idCourse);
            exit();

        } else {
            $contactDAO->message->setMessage("Erro ao criar o contato. Tente novamente.", "error", "", "back");
        }

    } else {
        $contactDAO->message->setMessage("Oops...", "error", "Ocorreu algum erro, não foi possível realizar inscrição.", "back");
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
