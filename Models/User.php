<?php
    class User{
        var $firstname;
        var $lastname;
        var $username;
        var $phone;
        var $email;
        var $position;
        
        function __construct($firstname, $lastname, $username, $phone, $email, $position){
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->username = $username;
            $this->phone = $phone;
            $this->email = $email;
        }
    }
?>