<?php

require_once("../../db.php");
require_once("../models/message.php");
require_once("../models/registration.php");
require_once("../dao/RegistrationDAO.php");

$registrationDAO = new RegistrationDAO($connect, $BASE_URL);
$message = new Message($BASE_URL);

$timeZone = new DateTimeZone('America/Sao_Paulo');
$dateAc = new DateTime('now', $timeZone);

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

        $registrationDAO->createRegistration($register);

        $registrationDAO->message->setMessage("Inscrição realizada com sucesso!", "success", "", "back");
    } else {
        $registrationDAO->message->setMessage("Oops...", "error", "Ocorreu algum erro, não foi possível realizar inscrição.", "back");
    }
} else if ($type == "delete") {

    $id = filter_input(INPUT_POST, "id");

    $register = $registrationDAO->findByIdRegistration($id);

    if ($register) {

        $registrationDAO->deleteRegistration($register, $register->id);
    }
}
