<?php

namespace App;

use PDO;

class Enquiry extends Model
{
    protected $table = 'enquiries';

    public function createEnquiry(array $input)
    {
        $sql = "INSERT INTO $this->table 
            (first_name, last_name, email, phone, subject, message)
            VALUES (:first_name, :last_name, :email, :phone, :subject, :message)";
        $res = $this->db->prepare($sql);

        $res->execute([
            ':first_name' => $input['first_name'],
            ':last_name' => $input['last_name'],
            ':email' => $input['email'],
            ':phone' => $input['phone'],
            ':subject' => $input['subject'],
            ':message' => $input['message'],
        ]);
    }
}
