<?php

require_once("../../db.php");
require_once("../models/message.php");

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

    public function createCourse(Course $course)
    {

        $con = $this->connect->prepare("
        INSERT INTO cminicursos (
        nome, descricao, vagas, aberto, created_at
        ) VALUES(
            :name, :description, :vacancies, :open, :created_at
         )");

        $con->bindParam(":name", $course->name);
        $con->bindParam(":description", $course->description);
        $con->bindParam(":vacancies", $course->vacancies);
        $con->bindParam(":open", $course->open);
        $con->bindParam(":created_at", $course->created_at);

        $con->execute();
    }

    public function deleteViewCourse(Course $course){

    }

    public function updateCourse(Course $course){

    }
}
