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
        $register->candidate_id = $data['candidato_id'];
        $register->candidate = $data['candidato'];
        $register->cpf = $data['cpf'];
        $register->phone = $data['telefone'];
        $register->email = $data['email'];
        $register->dateBth = $data['nascimento'];
        $register->gender = $data['sexo'];
        $register->course_id = $data['curso_id'];
        $register->course = $data['curso'];

        return $register;
    }

    public function findByIdRegistration($id)
    {
        $register = [];

        $con = $this->connect->prepare("
        SELECT
        cinscricoesminicurso.id,
        ccontato.id candidato_id,
        ccontato.nome candidato,
        ccontato.cpf,
        ccontato.telefone,
        ccontato.email,
        ccontato.nascimento,
        ccontato.sexo,
        cminicursos.id curso_id,
        cminicursos.nome curso
        FROM
        `cinscricoesminicurso`
        JOIN ccontato on ccontato.id = cinscricoesminicurso.ccontato_id 
        JOIN cminicursos on cminicursos.id = cinscricoesminicurso.cminicurso_id WHERE cinscricoesminicurso.id = :id
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

    public function createCourseRegistration($register, $course, $createdAt)
    {
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

    public function getAllRegistrations()
    {
        $registrations = [];

        $con = $this->connect->prepare("
        SELECT
        cinscricoesminicurso.id,
        ccontato.id candidato_id,
        ccontato.nome candidato,
        ccontato.cpf,
        ccontato.telefone,
        ccontato.email,
        ccontato.nascimento,
        ccontato.sexo,
        cminicursos.id curso_id,
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

    public function updateCourseRegistration(Contact $contact)
    {
        $course_id = filter_input(INPUT_POST, "student_course");
        $register_id = filter_input(INPUT_POST, "register_id");

        $con = $this->connect->prepare("
        UPDATE cinscricoesminicurso SET 
        cminicurso_id = :course,
        updated_at = :updated_at
        WHERE id = :id
        ");

        $con->bindParam(":course", $course_id);
        $con->bindParam(":updated_at", $contact->updated_at);
        $con->bindParam(":id", $register_id);

        $con->execute();

        $this->message->setMessage("Cadastro editado com sucesso!", "success", "", "back");
    }

    public function deleteRegistration(Registration $registration, $id)
    {
        $con = $this->connect->prepare("
        DELETE FROM cinscricoesminicurso WHERE id = :id 
        ");

        $con->bindParam("id", $id);
        $con->execute();

        $this->message->setMessage("Inscrição excluída com sucesso!", "success", "", "back");
    }

    public function getRegistrationsByCourseId($id)
    {
        $registrations = [];

        $con = $this->connect->prepare("
        SELECT
        cinscricoesminicurso.id,
        ccontato.id candidato_id,
        ccontato.nome candidato,
        ccontato.cpf,
        ccontato.telefone,
        ccontato.email,
        ccontato.nascimento,
        ccontato.sexo,
        cminicursos.id curso_id,
        cminicursos.nome curso
        FROM
        `cinscricoesminicurso`
        JOIN ccontato on ccontato.id = cinscricoesminicurso.ccontato_id 
        JOIN cminicursos on cminicursos.id = cinscricoesminicurso.cminicurso_id
        WHERE cminicursos.id = :id
        ");

        $con->bindParam(":id", $id);
        $con->execute();

        if ($con->rowCount() > 0) {
            $registrationsArray = $con->fetchAll();

            foreach ($registrationsArray as $register) {
                $registrations[] = $this->buildRegistration($register);
            }
        }

        return $registrations;
    }

    public function getTotalRegistrationsByCourseId($id)
    {
        $registrations = [];

        $con = $this->connect->prepare("
        SELECT COUNT(*) AS total 
        FROM cinscricoesminicurso
        WHERE cminicurso_id = :id
        ");

        $con->bindParam(":id", $id);
        $con->execute();

        $result = $con->fetchColumn();

        return $result;
    }
}
