<?php


Class Cliente
{

    private $error = "";

    public function create($data)
    {
        $DB = Database::getInstance();

        if (!empty($data->cliente) && $data->data_type == 'add_cliente') {
            
            $cliente = ucwords(trim($data->cliente));
            $Telefone = (int) trim($data->telefone);
            $Morada = ucwords(trim($data->morada));

            if(!preg_match("/^[a-zA-Z]+$/", $cliente)) {
                $_SESSION['error'] = "Por favor insira um nome de cliente correto!";
                return false;
            }

            $query = "INSERT INTO client (cliente, Telefone, Morada) VALUES (:cliente, :Telefone, :Morada)";           
            
            $params = array(
                ':cliente' => $cliente,
                ':Telefone' => $Telefone,
                ':Morada' => $Morada
            );
            
            $check = $DB->write($query, $params);
            // show($check); // show the result


            if($check) {
                return true;
            } else {
                $_SESSION['error'] = "Erro ao inserir o cliente na base de dados";
            }
            
        } else {
            $_SESSION['error'] = "Dados inválidos para inserir o cliente";
        }
        return false;
    }

    public function get_cliente()
    {
        $DB = Database::getInstance();

        $query = "select * from client"; 
        $result = $DB->read($query);

        return json_decode(json_encode($result), true);
    }

    public function delete($id)
    {
        $DB = Database::getInstance();
        $id = (int)$id;
        $query = "DELETE FROM client WHERE idClient = '$id' LIMIT 1";
        $result = $DB->write($query);
        return $result;
    }

    public function edit($id, $nome, $telefone, $Morada) {
        
        $DB = Database::getInstance();

        $nome = ucwords(trim($nome));
        $telefone = trim($telefone);
        $Morada = trim($Morada);

        if (!preg_match("/^[a-zA-Z]+$/", $nome)){
            $_session['error'] = "Por favor insira um nome valido!";
            return false;
        }
        
        // Prepara a consulta SQL
        $query = "UPDATE client SET cliente = :cliente, Telefone = :Telefone, Morada = :Morada WHERE idClient = :idClient LIMIT 1";
        $params = array(
            ':cliente' => $nome,
            ':Telefone' => $telefone,
            ':Morada' => $Morada,
            ':idClient' => $id
        );


        // Executa a consulta usando o método write do objeto Database
        return $DB->write($query, $params);
    }
}