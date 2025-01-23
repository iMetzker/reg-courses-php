<?php

class Registration
{
    public $id;
    public $candidate_id;
    public $candidate;
    public $cpf;
    public $phone;
    public $email;
    public $dateBth;
    public $gender;
    public $created_at;
    public $deleted_at;
    public $updated_at;
    public $course;
    public $course_id;
}

interface RegistrationDAOInterface
{
    public function buildRegistration($data);
    public function findByIdRegistration($id);
    public function getAllRegistrations();
    public function getTotalRegistrations();
    public function createCourseRegistration($idCourse, $idRegister, $createdAt);
    public function updateCourseRegistration(Contact $contact);
    public function deleteRegistration(Registration $registration, $id);
}