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
            $data['Serviço'] = $receiptModel->get_receipt();
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
            }

            $arr['data'] = "";
            echo json_encode($arr);
        }
    }
}