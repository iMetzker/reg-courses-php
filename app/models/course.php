<?php 

class Course {
    public $id;
    public $name;
    public $description;
    public $vacancies;
    public $open = 0;
    public $date;
    public $minister;
    public $time;
    public $duration;
    public $created_at;
    public $updated_at;
    public $deleted_at;
}

interface CourseDAOInterface {

    public function buildCourse($data);
    public function getAllCourses();
    public function findByIdCourse($id);
    public function createCourse(Course $course);
    public function deleteViewCourse($id);
    public function updateCourse(Course $course);
}
