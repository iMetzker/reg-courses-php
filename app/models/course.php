<?php 

class Course {
    public $id;
    public $name;
    public $description;
    public $vacancies;
    public $open = 0;
    public $image;
    public $date;
    public $minister;
    public $time;
    public $duration;
    public $total_registrations;
    public $available_vacancies;
    public $created_at;
    public $updated_at;
    public $deleted_at;

    public function imageGenerateName() {
        return bin2hex(random_bytes(60)) . ".jpg";
    }
}

interface CourseDAOInterface {

    public function buildCourse($data);
    public function getAllCourses();
    public function getTotalCourses();
    public function findByIdCourse($id);
    public function createCourse(Course $course);
    public function deleteViewCourse(Course $course, $id);
    public function updateCourse(Course $course);
}
