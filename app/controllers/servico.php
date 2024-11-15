<?php

class Servico extends Controller
{
    public function index(){
        
        $User = $this->load_model('User');
    
            $data['user_data'] = $User->check_login(true, ["admin"]);

            if(is_array($data['user_data']))
            {
                $data['user_data'] = $user_data;
                show($data['user_data']);
            }

            $serviceModel = $this->load_model('Service');
            $data['TipoServico'] = $serviceModel->get_servico();
            // show($data);
            $this->view("servico", $data);
    }

    public function servico()
    {
        // Load the Service model
        $servico = $this->load_model('Service');
    
        // Get the data sent from the client
        $data = file_get_contents("php://input");
        $data = json_decode($data);
    
        // Verify if data is an object and contains data_type property
        if (is_object($data) && isset($data->data_type)) {
            $arr = array();
    
            // Handle adding a new service
            if ($data->data_type == 'add_service') {
                // Attempt to create the service
                $check = $servico->create($data);
    
                // Check if there is any error in session
                if (!empty($_SESSION['error'])) {
                    $arr['message'] = $_SESSION['error'];
                    $_SESSION['error'] = "";
                    $arr['message_type'] = "error";
                    $arr['data_type'] = "add_service";
                } else {
                    $arr['message'] = "Serviço adicionado com sucesso!";
                    $arr['message_type'] = "info";
                    $arr['data_type'] = "add_service";
                }
    
                $arr['data'] = "";
                echo json_encode($arr);
            }
    
            // Handle editing a service
            elseif ($data->data_type == 'edit_service') {

                $id = $data->id; 

                $new_servico = $data->servico; 
                $datainicio = $data->datainicio; 
                $datafim = $data->datafim;
    
                $check = $servico->edit($id, $new_servico, $datainicio, $datafim);
    
                if ($check) {
                    $arr['message'] = "Serviço editado com sucesso!";
                    $arr['message_type'] = "info";
                } else {
                    $arr['message'] = "Erro ao editar o serviço!";
                    $arr['message_type'] = "error";
                }
                $_SESSION['error'] = "";
                $arr['data'] = "";
                $arr['data_type'] = "edit_service";
    
                echo json_encode($arr);
            }

            elseif($data->data_type === 'disabled_row') {

                $idService = $data->idService;
                $status = $data->current_state ? 0: 1;
    
                $query = "UPDATE service SET status = :status Where idService = :idService Limit 1";
                $params = array(':status' => $status, ':idService' => $idService);
                $DB = Database::getInstance();
                $DB->write($query, $params);
    
                $arr['message'] = "";
                $_SESSION['error'] = "";
                $arr['message_type'] = "info";
                $arr['data'] = "";
                $arr['data_type'] = "disabled_row";
    
                echo json_encode($arr);
            }
    
            // Handle deleting a service
            elseif ($data->data_type == 'delete_service') {
                $check = $servico->delete($data->id);
                if ($check === true) {
                    $arr['message'] = "O seu serviço foi removido com sucesso!";
                    $arr['message_type'] = "info";
                } else {
                    $arr['message'] = "Erro ao remover o serviço!";
                    $arr['message_type'] = "error";
                }
                $_SESSION['error'] = "";
                $arr['data'] = "";
                $arr['data_type'] = "delete_service";
    
                echo json_encode($arr);
            }
        } else {
            // Handle invalid data
            $arr['message'] = "Dados inválidos recebidos!";
            $arr['message_type'] = "error";
            $arr['data'] = "";
            echo json_encode($arr);
        }
    }    
}