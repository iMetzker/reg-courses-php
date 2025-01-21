<?php

class Registration
{
    public $id;
    public $name;
    public $cpf;
    public $phone;
    public $email;
    public $dateBth;
    public $gender;
    public $created_at;
    public $deleted_at;
    public $updated_at;
}

interface RegistrationDAOInterface
{

    public function buildRegistration($data);
    public function findByIdRegistration($id);
    public function getAllRegistrations();
    public function getTotalRegistrations();
    public function createRegistration(Registration $registration);
    public function createCourseRegistration(Course $course, Registration $registration, $createdAt);
    public function updateRegistration(Registration $registration);
    public function deleteRegistration(Registration $registration, $id);
}
