<?php 

class Course {
    public $id;
    public $name;
    public $description;
    public $vacancies;
    public $open = 0;
    public $created_at;
    public $updated_at;
    public $deleted_at;
}

interface CourseDAOInterface {

    public function createCourse(Course $course);
    public function deleteViewCourse(Course $course);
    public function updateCourse(Course $course);
}
