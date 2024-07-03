<?php

class Receipts extends Controller
{
    public function index()
    {
        
        $User = $this->load_model('User');
    
            $data['user_data'] = $User->check_login(true, ["admin"]);

            if(is_array($data['user_data']))
            {
                $data['user_data'] = $user_data;
                //show($data['user_data']);
            }

            $receiptModel = $this->load_model('Receipt');
            $data['idReceipt'] = $receiptModel->get_receipt();
            // show($data);
            $this->view("receipt", $data);
    }

    public function receipt()
    {
        // Load the Service model
        $receipt = $this->load_model('Receipt');
    
        // Get the data sent from the client
        $data = file_get_contents("php://input");
        $data = json_decode($data);
        //show($data);
        // Verify if data is an object and contains data_type property
        if (is_object($data) && isset($data->data_type)) 
        {
            $arr = array();
    
            // Handle adding a new service
            if ($data->data_type == 'add_receipt') {
                // Attempt to create the service

                $check = $receipt->create($data);
                
                //show($data);
                // var_dump($data);
                if (!empty($_SESSION['error'])) {
                    $arr['message'] = $_SESSION['error'];
                    $_SESSION['error'] = "";
                    $arr['message_type'] = "error";
                    $arr['data_type'] = "add_receipt";
                } else {
                    $arr['message'] = "Serviço adicionado com sucesso!";
                    $arr['message_type'] = "info";
                    $arr['data_type'] = "add_receipt";
                }
                
                $arr['data'] = "";
                echo json_encode($arr);
            }
            elseif($data->data_type === 'payment_status') {
                $idReceipt = $data->idReceipt;
                
                if ($data->current_state == 1) {
                    $status = 3;
                } elseif ($data->current_state == 2) {
                    $status = 1;
                } else {
                    $status = 2;
                }

                $query = "UPDATE receipt SET PaymentStatus_idPaymentStatus = :PaymentStatus_idPaymentStatus Where idReceipt = :idReceipt Limit 1";
                $params = array(':PaymentStatus_idPaymentStatus' => $status, ':idReceipt' => $idReceipt);
                $DB = Database::getInstance();
                $DB->write($query, $params);
                // var_dump($params);
                $arr['message'] = "";
                $_SESSION['error'] = "";
                $arr['message_type'] = "info";
                $arr['data'] = "";
                $arr['data_type'] = "payment_status";

                echo json_encode($arr);
            }
            elseif ($data->data_type == 'delete_receipt') {
                $check = $receipt->delete($data->id);
                if ($check === true) {
                    $arr['message'] = "O seu serviço foi removido com sucesso!";
                    $arr['message_type'] = "info";
                } else {
                    $arr['message'] = "Erro ao remover o serviço!";
                    $arr['message_type'] = "error";
                }
                $_SESSION['error'] = "";
                $arr['data'] = "";
                $arr['data_type'] = "delete_receipt";
    
                echo json_encode($arr);
            } 
            elseif ($data->data_type == 'edit_receipt') {

                $id = $data->id; 

                $new_servico = $data->servico; 
                $ValorPorHora = $data->ValorPorHora; 
                $NumHoras = $data->NumHoras;
                
                
                $check = $receipt->edit($id, $new_servico, $ValorPorHora, $NumHoras);
    
                if ($check) {
                    $arr['message'] = "Recibo editado com sucesso!";
                    $arr['message_type'] = "info";
                } else {
                    $arr['message'] = "Erro ao editar o recibo!";
                    $arr['message_type'] = "error";
                }
                $_SESSION['error'] = "";
                $arr['data'] = "";
                $arr['data_type'] = "edit_receipt";
    
                echo json_encode($arr);
            }           
        }
        
    }
    
}