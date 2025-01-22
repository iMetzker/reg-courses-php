<?php

class Contact
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
    
    public $student;
    public $course;
}

interface ContactDAOInterface
{
    public function buildContact($data);
    public function findByIdContact($id);
    public function createContact(Contact $registration);

    public function getAllRegistrations();
    public function getTotalRegistrations();
    public function createCourseRegistration($idCourse, $idRegister, $createdAt);
    public function updateContact(Contact $registration);
}
