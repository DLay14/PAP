<?php

Class User
{
    private $error = "";

    function SignUp($POST)
    {
        $data = array();
        $db = Database::getInstance();

        $data['name']           = trim($POST['name']);
        $data['telefone']       = trim($POST['telefone']);
        $data['email']          = trim($POST['email']);
        $data['password']       = trim($POST['password']);
        $password2              = trim($POST['password2']);

        if(empty($data['email']) || !preg_match("/^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/", $data['email']))
        {
            $this->error .= "Please enter a valid email <br>";
        }

        //validation for you write a name corretly
        if(empty($data['name']) || !preg_match("/^[a-zA-Z]+$/", $data['name'] ))
        {
            $this->error .= "Please enter a valid name <br>";
        }

        //validation for password equal
        if($data['password'] !== $password2 )
        {
            $this->error .= "Password must to be equal! <br>";
        }

        //validation for minimal password lenght
        if(strlen($data['password']) < 4 )
        {
            $this->error .= "Password must be at last 4 characters long! <br>";
        }

        if(strlen($data['telefone']) = 9 && (strlen($data['telefone']) < 12 ))
        {
            $this->error .= "Password must be at last 4 characters long! <br>";
        }

        if($this->error == "")
        {
            //save at database
            $data['role'] = "costumer";
            $data['date'] = date("Y-m-d H:i:s");
            $data['password'] = hash('sha1', $data['password']);
            
            $query = "insert into users (url_address,name,email,password,date,role) values(:url_address,:name,:email,:password,:date,:role)";            
            $result = $db->write($query,$data);

            if($result)
            {
                header("Location: " . ROOT . "login");
                die;
            }
        }

            $_SESSION['error'] = $this->error;
    }
}