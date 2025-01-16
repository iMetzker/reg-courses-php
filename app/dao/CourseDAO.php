<?php
require_once(__DIR__ . "../../../db.php");
require_once(__DIR__ . "../../../app/models/course.php");
require_once(__DIR__ . "../../../app/models/message.php");

class CourseDAO implements CourseDAOInterface
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

    public function buildCourse($data)
    {
        $course = new Course;

        $course->id = $data['id'];
        $course->name = $data['nome'];
        $course->description = $data['descricao'];
        $course->vacancies = $data['vagas'];
        $course->open = $data['aberto'];
        $course->image = $data['imagem'];
        $course->date = $data['data'];
        $course->minister = $data['ministrante'];
        $course->time = $data['horario'];
        $course->duration = $data['duracao'];
        $course->created_at = $data['created_at'];

        return $course;
    }

    public function findByIdCourse($id)
    {

        $course = [];

        $con = $this->connect->prepare("
        SELECT * FROM cminicursos WHERE id = :id
        ");

        $con->bindParam(":id", $id);
        $con->execute();

        if ($con->rowCount() > 0) {

            $courseData = $con->fetch();
            $course = $this->buildCourse($courseData);

            return $course;
        } else {
            return false;
        }
    }

    public function getAllCourses()
    {

        $courses = [];

        $con = $this->connect->prepare("
        SELECT * FROM cminicursos
        WHERE deleted_at IS NULL
        ORDER BY id DESC
        ");

        $con->execute();

        if ($con->rowCount() > 0) {
            $coursesArray = $con->fetchAll();

            foreach ($coursesArray as $course) {
                $courses[] = $this->buildCourse($course);
            }
        }

        return $courses;
    }

    public function getTotalCourses()
    {
        $con = $this->connect->prepare("
        SELECT COUNT(*) FROM cminicursos
        WHERE deleted_at IS NULL
        ");
        $con->execute();

        $result = $con->fetchColumn();

        return $result;
    }

    public function createCourse(Course $course)
    {

        $con = $this->connect->prepare("
        INSERT INTO cminicursos (
        nome, descricao, vagas, aberto, imagem, data, ministrante, horario, duracao, created_at
        ) VALUES(
            :name, :description, :vacancies, :open, :image, :date, :minister, :time, :duration, :created_at
         )");

        $con->bindParam(":name", $course->name);
        $con->bindParam(":description", $course->description);
        $con->bindParam(":vacancies", $course->vacancies);
        $con->bindParam(":open", $course->open);
        $con->bindParam(":image", $course->image);
        $con->bindParam(":date", $course->date);
        $con->bindParam(":minister", $course->minister);
        $con->bindParam(":time", $course->time);
        $con->bindParam(":duration", $course->duration);
        $con->bindParam(":created_at", $course->created_at);

        $con->execute();
    }

    public function deleteViewCourse(Course $course, $id)
    {

        // $con = $this->connect->prepare("
        // DELETE FROM cminicursos WHERE id = :id
        // ");

        $con = $this->connect->prepare("
        UPDATE cminicursos SET
        deleted_at = :deleted_at
        WHERE id = :id
        ");

        $con->bindParam(":id", $id);
        $con->bindParam(":deleted_at", $course->deleted_at);

        $con->execute();

        $this->message->setMessage("Curso excluído com sucesso!", "success", "", "back");
    }

    public function updateCourse(Course $course)
    {
        // $img = empty($course->image) ? '' : 'imagem = :image,';

        $con = $this->connect->prepare("
        UPDATE cminicursos SET
        nome = :name,
        descricao = :description,
        vagas = :vacancies,
        aberto = :open,
        data = :date,
        ministrante = :minister,
        horario = :time,
        duracao = :duration,
        imagem = :image,
        updated_at = :updated_at
        WHERE id = :id
        ");

        // $con = $this->connect->prepare($sql);

        $con->bindParam(":name", $course->name);
        $con->bindParam(":description", $course->description);
        $con->bindParam(":vacancies", $course->vacancies);
        $con->bindParam(":open", $course->open);
        $con->bindParam(":date", $course->date);
        $con->bindParam(":minister", $course->minister);
        $con->bindParam(":time", $course->time);
        $con->bindParam(":duration", $course->duration);
        $con->bindParam(":image", $course->image);
        $con->bindParam(":updated_at", $course->updated_at);
        $con->bindParam(":id", $course->id);
        
        // if (!empty($course->image)) {
        //     $con->bindParam(":image", $course->image);
        // }

        $con->execute();

        $this->message->setMessage("Curso editado com sucesso!", "success", "", "back");
    }
}
