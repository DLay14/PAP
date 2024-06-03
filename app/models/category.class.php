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

            $query = "INSERT INTO servico (teste) VALUES (:teste)";
            $params = array(':teste' => $teste);
            
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

    public function get_categories()
    {
        $DB = Database::getInstance();

        $query = "Select * From servico";
        $result = $DB->read($query);

        return json_decode(json_encode($result), true);
    }

    public function delete($id)
    {
        $DB  = Database::getInstance();
        $id = (int)$id;
        $query = "delete from servico where id='$id' limit 1";
        $DB->write($query);
    }
}