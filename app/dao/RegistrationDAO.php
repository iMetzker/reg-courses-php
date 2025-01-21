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
        $register->name = $data['candidato'];
        $register->cpf = $data['cpf'];
        $register->phone = $data['telefone'];
        $register->email = $data['email'];
        $register->dateBth = $data['nascimento'];
        $register->course = $data['curso'];

        return $register;
    }

    public function findByIdRegistration($id)
    {

        $register = [];

        $con = $this->connect->prepare("
        SELECT * FROM ccontato WHERE id = :id
        ");

        $con->bindParam(":id", $id);
        $con->execute();

        if ($con->rowCount() > 0) {
            $registerData = $con->fetch();
            $register = $this->buildRegistration($registerData);

            return $register;
        } else {
            return false;
        }
    }

    public function getAllRegistrations()
    {
        $registrations = [];

        $con = $this->connect->prepare("
        SELECT
        ccontato.id,
        ccontato.nome candidato,
        ccontato.cpf,
        ccontato.telefone,
        ccontato.email,
        ccontato.nascimento,
        cminicursos.nome curso
        FROM
        `cinscricoesminicurso` 
        JOIN ccontato on ccontato.id = cinscricoesminicurso.ccontato_id 
        JOIN cminicursos on cminicursos.id = cinscricoesminicurso.cminicurso_id
        ");

        $con->execute();

        if ($con->rowCount() > 0) {
            $registrationsArray = $con->fetchAll();

            foreach ($registrationsArray as $register) {
                $registrations[] = $this->buildRegistration($register);
            }
        }

        return $registrations;
    }

    public function getTotalRegistrations()
    {

        $con = $this->connect->prepare("
        SELECT COUNT(*) FROM cinscricoesminicurso
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

        return $this->connect->lastInsertId();
    }

    public function createCourseRegistration($register, $course, $createdAt) {

        $con = $this->connect->prepare("
        INSERT INTO cinscricoesminicurso (
        ccontato_id, cminicurso_id, created_at, updated_at
        ) VALUES (
        :ccontato_id, :cminicurso_id, :created_at, :updated_at
        )");

        $con->bindParam(":ccontato_id", $register);
        $con->bindParam(":cminicurso_id", $course);
        $con->bindParam(":created_at", $createdAt);
        $con->bindParam(":updated_at", $createdAt);

        $con->execute();
    }

    public function updateRegistration(Registration $registration) {

        $con = $this->connect->prepare("
        UPDATE ccontato SET
        nome = :name,
        email = :email,
        cpf = :cpf,
        telefone = :phone,
        nascimento = :dateBth,
        sexo = :gender,
        updated_at = :updated_at
        WHERE id = :id 
        ");

        $con->bindParam(":name", $registration->name);
        $con->bindParam(":email", $registration->email);
        $con->bindParam(":cpf", $registration->cpf);
        $con->bindParam(":phone", $registration->phone);
        $con->bindParam(":dateBth", $registration->dateBth);
        $con->bindParam(":gender", $registration->gender);
        $con->bindParam(":updated_at", $registration->updated_at);
        $con->bindParam(":id", $registration->id);

        $con->execute();

        $this->message->setMessage("Cadastro editado com sucesso!", "success", "", "back");
    }

    public function deleteRegistration(Registration $registration, $id)
    {

        $con = $this->connect->prepare("
        DELETE FROM ccontato WHERE id = :id
        ");

        $con->bindParam(":id", $id);

        $con->execute();

        $this->message->setMessage("Estudante excluído com sucesso!", "success", "", "back");
    }
}
