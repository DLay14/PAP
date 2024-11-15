<?php


Class Service
{

    private $error = "";

    public function create($data)
    {
        $DB = Database::getInstance();

        if (!empty($data->servico) && $data->data_type == 'add_service') {
            
            $servico = ucwords(trim($data->servico));
            $datainicio = trim($data->datainicio);
            $datafim = trim($data->datafim);

            if(!preg_match("/^[a-zA-Z]+$/", $servico)) {
                $_SESSION['error'] = "Por favor insira um nome de serviço correto!";
                return false;
            }

            $query = "INSERT INTO service (TipoServico, DataInicio, DataFim, status) VALUES (:TipoServico, :DataInicio, :DataFim, :status);";
            $params = array(
                ':TipoServico' => $servico,
                ':DataInicio' => $datainicio,
                ':DataFim' => $datafim,
                ':status' => 0,
            );

            $check = $DB->write($query, $params);
            
            if($check) {
                return true;
            } else {
                $_SESSION['error'] = "Erro ao inserir o serviço na base de dados";
            }
            
        } else {
            $_SESSION['error'] = "Dados inválidos para inserir o serviço";
        }

        return false;
    }

    public function get_servico()
    {
        $DB = Database::getInstance();

        $query = "select * from service"; 
        $result = $DB->read($query);

        return json_decode(json_encode($result), true);
        

    }

    public function delete($id)
    {
        $DB = Database::getInstance();
        $id = (int)$id;
        $query = "DELETE FROM service WHERE idService = '$id' LIMIT 1";
        $result = $DB->write($query);
        return $result;
    }

    public function edit($id, $new_servico, $datainicio, $datafim) {
        
        $DB = Database::getInstance();

        $new_servico = is_string($new_servico) ? ucwords(trim($new_servico)) : '';
        $datainicio = is_string($datainicio) ? ucwords(trim($datainicio)) : '';
        $datafim = is_string($datafim) ? ucwords(trim($datafim)) : '';    
        if (!preg_match("/^[a-zA-Z]+$/", $new_servico)){
            $_session['error'] = "Por favor insira um serviço valido!";
            return false;
        }
        
        // Prepara a consulta SQL
        $query = "UPDATE service SET TipoServico = :TipoServico, DataInicio = :DataInicio, DataFim = :DataFim WHERE idService = :idService LIMIT 1";
        $params = array(
            ':TipoServico' => $new_servico,
            ':DataInicio' => $datainicio,
            ':DataFim' => $datafim,
            ':idService' => $id
        );

        // Executa a consulta usando o método write do objeto Database
        return $DB->write($query, $params);
    }

}