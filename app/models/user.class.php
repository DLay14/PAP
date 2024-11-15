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


        /*
        * Check if the email exists
        */
        $sql = "select * from user where email = :email limit 1";
        $arr ['email']= $data['email'];
        $check = $db->read($sql,$arr);
        if(is_array($check))
        {
            $this->error .= "This email already exists! <br> ";
        }

        $data['url_address'] = $this->get_random_string_max(60);
        // show(get_random_string_max(60));
        /*
        * Check if the url_address exists
        */
        $arr = false;
        $sql = "select * from user  where url_address = :url_address limit 1";
        $arr['url_address']=$data['url_address'];
        $check = $db->read($sql, $arr);
        if (is_array($check)) {
            $data['url_address'] = $this->get_random_string_max(60);
        }


        if($this->error == "")
        {
            //save at database
            $data['idUser'] = "";
            $data['active'] = "";
            $data['date'] = date("Y-m-d H:i:s");
            $data['password'] = hash('sha1', $data['password']);
            $data['role'] = "user";
            
            $query = "insert into user (idUser,nome,telefone,email,password,active,url_address,date,role) values(:idUser,:name,:telefone,:email,:password, :active,:url_address, :date, :role)";            
            $result = $db->write($query,$data);
            // show($result);
            if($result)
            {
                header("Location: " . ROOT . "login");
                die;
            }
        }

        $_SESSION['error'] = $this->error;

    } 
    public function get_random_string_max($length)
    {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $random_string = '';

    for ($i = 0; $i < $length; $i++) {
        $random_string.= $characters[rand(0, strlen($characters) - 1)];
    }

    return $random_string;
    }

    function Login($POST)
    {
        $data = array();
        $db = Database::getInstance();

        $data['email']          = trim($POST['email']);
        $data['password']       = trim($POST['password']);

        if(empty($data['email']) || !preg_match("/^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/", $data['email']))
        {
            $this->error .= "Por favor insira um email válido! <br>";
        }

        if(strlen($data['password']) < 4 )
        {
            $this->error .= "Password tem que ser maior que 4 caracteres! <br>";
        }

        if($this->error == "")
        {
            //confirm
            $data['password'] = hash('sha1', $data['password']);

            $sql = "select * from user where email = :email && password = :password limit 1";
            $arr['email'] = $data['email'];
            $result= $db->read($sql,$data);
            if (is_array($result)) {
                $_SESSION['user_url'] = $result[0]->url_address;
                if ($result[0]->role == 'admin') {
                    header("Location: ". ROOT. "home");
                } else {
                    header("Location: ". ROOT. "users");
                }
                die;
            }
            $this->error .= "Email ou password inválidos! <br>";
        }
        $_SESSION['error'] = $this->error;
        
    }

    public function logout(){
        if(isset($_SESSION['user_url']))
        {
            unset($_SESSION['user_url']);
        }
        header("Location: " . ROOT . "login");
        die;
    }

    function check_login($redirect = false, $allowed = array())
    {
        if(!isset($_SESSION['user_url'])){
            if($redirect){
                header("Location: ". ROOT . "login");
                exit;
            }
            return false;
        }

        $db = Database::getInstance();
        $url = $_SESSION['user_url'];

        $query = "Select * From user Where url_address = :url LIMIT 1";
        $result = $db->read($query, array('url' => $url));

        if(!$result){
            if($redirect){
                header("Location: ". ROOT . "login");
                exit;
            }
            return false;
        }

        $user = $result[0];
        if(!empty($allowed) && !in_array($user->role, $allowed)){
            if($redirect){
                header("Location: ". ROOT . "login");
                exit;
            }
            return false;
        }
        return $user;
        
    }

}