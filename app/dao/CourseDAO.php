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
        SELECT * FROM cminicursos ORDER BY id DESC
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

    public function deleteViewCourse($id)
    {

        $con = $this->connect->prepare("
        DELETE FROM cminicursos WHERE id = :id
        ");

        $con->bindParam(":id", $id);
        $con->execute();

        $this->message->setMessage("Curso excluído com sucesso!", "success", "", "back");
    }

    public function updateCourse(Course $course) {}
}
