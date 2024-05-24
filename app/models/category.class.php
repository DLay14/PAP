<?php

Class Category{

    public function create($data)
    {
        $DB = Database::getInstance();

        if(!empty($data->data) && $data->data_type == 'add_category')
        {
            $category = ucwords(trim($data->data));

            if(!preg_match("/^[a-zA-Z]+$/", $category)){
                $_SESSION['error'] = "Por favor insira o serviço corretamente!";
                return false;
            }

            $query = "INSERT INTO categories (category) VALUES (:category)";
            $params = array(':category' => $category);
            
            $check = $DB->write($query, $params);
            if($check){
                return true;
            }   else{
                $_SESSION['error'] = "Erro ao inserir no banco de dados!";
            }

        }else {
            $_SESSION['error'] = "Dados invalidos para criar serviço.";
        }
        return false;
    }
}