<?php


Class Category
{

    private $error = "";

    public function create($data)
    {

        $DB = Database::getInstance();

        if (!empty($data->data) && $data->data_type == 'add_servico') {

            $servico = ucwords(trim($data->servico));
            $datainicio = ucwords(trim($data->datainicio));
            $datafim = ucwords(trim($data->datafim));
            $taskid = $data->task;
            // $url_add = trim($data->user);
            if(!preg_match("/^[a-zA-Z]+$/", $servico)) {
                $_SESSION['error'] = "Por favor insira um nome de serviço correto!";
                return false;
            }

            $query = "INSERT INTO service (idService, TipoServico, DataInicio, DataFim, status, Task_idTask) VALUES (:idService, :TipoServico, :DataInicio, :DataFim, :status, :Task_idTask);";
            $params = array(':idService' => NULL,
                            ':TipoServico' => $servico,
                            ':DataInicio' => $datainicio,
                            ':DataFim' => $datafim,
                            ':status' => 0,
                            ':Task_idTask' => $taskid
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

    public function get_categories()
    {
        $DB = Database::getInstance();

        $query = "select * from service"; 
        $result = $DB->read($query);

        //show($result);
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

    public function edit($id, $new_servico, $datainicio, $datafim, $taskid) {
        $DB = Database::getInstance();

        $new_servico = is_string($new_servico) ? ucwords(trim($new_servico)) : '';
        $datainicio = is_string($datainicio) ? ucwords(trim($datainicio)) : '';
        $datafim = is_string($datafim) ? ucwords(trim($datafim)) : '';
        $taskid = is_string($taskid) ? trim($taskid) : '';
    
        if (!preg_match("/^[a-zA-Z]+$/", $new_servico)){
            $_session['error'] = "Por favor insira um serviço valido!";
            return false;
        }
        
        $query = "UPDATE from service set TipoServico = :TipoServico, DataInicio = :DataInicio, DataFim = :DataFim, Task_idTask	= :Task_idTask WHERE idService = :idService LIMIT 1";
        $params = array(':TipoServico' => $new_servico, 
                        ':DataInicio' => $datainicio,
                        ':DataFim' => $datafim,
                        ':Task_idTask' => $taskid,
                        ':idService' => $id
                        );
        console.log($params);
        return $DB->write($query, $params);
    }

    public function get_task()
    {
        $DB = Database::getInstance();

        $query = "select * from task"; 
        $result = $DB->read($query);

        //show($result);
        return json_decode(json_encode($result), true);
        

    }

}