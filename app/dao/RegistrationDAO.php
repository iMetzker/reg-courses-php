<?php
require_once(__DIR__ . "../../../db.php");
require_once(__DIR__ . "../../models/course.php");
require_once(__DIR__ . "../../models/registration.php");
require_once(__DIR__ . "../../models/message.php");

class RegistrationDAO implements RegistrationDAOInterface
{

    private $connect;
    private $url;
    public $message;

    public function __construct(PDO $connect, $url)
    {
        $this->connect = $connect;
        $this->url = $url;
        $this->message = new Message($url);
    }


    public function buildRegistration($data)
    {

        $register = new Registration;

        $register->id = $data['id'];
        $register->name = $data['nome'];
        $register->cpf = $data['cpf'];
        $register->phone = $data['telefone'];
        $register->email = $data['email'];
        $register->dateBth = $data['nascimento'];
        $register->gender = $data['sexo'];

        return $register;
    }

    public function findByIdRegistration($id) {}

    public function getAllRegistrations()
    {
        $registrations = [];

        $con = $this->connect->prepare("
        SELECT * FROM ccontato 
        ORDER BY id DESC
        ");

        $con->execute();

        if ($con->rowCount() > 0) {
            $registrationsArray = $con->fetchAll();

            foreach($registrationsArray as $register) {
                $registrations[] = $this->buildRegistration($register);
            }
        }

        return $registrations;
    }

    public function getTotalRegistrations() {
        
        $con = $this->connect->prepare("
        SELECT COUNT(*) FROM ccontato
        ");
        $con->execute();

        $result = $con->fetchColumn();

        return $result;
    }

    public function createRegistration(Registration $registration)
    {

        $con = $this->connect->prepare("
        INSERT INTO ccontato (
        nome, cpf, telefone, email, nascimento, sexo, created_at
        ) VALUES (
         :name, :cpf, :phone, :email, :dateBth, :gender, :created_at
        )");

        $con->bindParam(":name", $registration->name);
        $con->bindParam(":cpf", $registration->cpf);
        $con->bindParam(":phone", $registration->phone);
        $con->bindParam(":email", $registration->email);
        $con->bindParam(":dateBth", $registration->dateBth);
        $con->bindParam(":gender", $registration->gender);
        $con->bindParam(":created_at", $registration->created_at);

        $con->execute();
    }

    public function createCourseRegistration(Registration $registration, Course $course) {}

    public function updateRegistration(Registration $registration) {}

    public function deleteRegistration(Registration $registration) {}
}
