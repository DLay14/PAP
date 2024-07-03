<?php
//criação da classe home que estende para a classe controller
Class Clientes extends Controller
{
    //A funçao index vai buscar a view do ficheiro home
    public function index()
    {
        $User = $this->load_model('User');
        $user_data = $User->check_login(true);
        // show($user_data);
        //validate if the users is logged in
        if(is_object($user_data)){
            $data['user_data'] = $user_data;
        }
        
        $clienteModel = $this->load_model('Cliente');
        $data['idClient'] = $clienteModel->get_cliente();
        $this->view("cliente",$data);
    }

    public function cliente()
    {
        // Load the Service model
        $client = $this->load_model('Cliente');
    
        // Get the data sent from the client
        $data = file_get_contents("php://input");
        $data = json_decode($data);
        //show($data);
        // Verify if data is an object and contains data_type property
        if (is_object($data) && isset($data->data_type)) 
        {
            $arr = array();
    
            // Handle adding a new service
            if ($data->data_type == 'add_cliente') {
                // Attempt to create the service

                $check = $client->create($data);
                
                //show($data);
                // var_dump($data);
                if (!empty($_SESSION['error'])) {
                    $arr['message'] = $_SESSION['error'];
                    $_SESSION['error'] = "";
                    $arr['message_type'] = "error";
                    $arr['data_type'] = "add_cliente";
                } else {
                    $arr['message'] = "Cliente adicionado com sucesso!";
                    $arr['message_type'] = "info";
                    $arr['data_type'] = "add_cliente";
                }
                
                $arr['data'] = "";
                echo json_encode($arr);
            }
            elseif ($data->data_type == 'delete_cliente') {
                $check = $client->delete($data->id);
                if ($check === true) {
                    $arr['message'] = "O seu serviço foi removido com sucesso!";
                    $arr['message_type'] = "info";
                } else {
                    $arr['message'] = "Erro ao remover o serviço!";
                    $arr['message_type'] = "error";
                }
                $_SESSION['error'] = "";
                $arr['data'] = "";
                $arr['data_type'] = "delete_cliente";
    
                echo json_encode($arr);
            }
            elseif ($data->data_type == 'edit_cliente') {

                $id = $data->id; 

                $nome = $data->nome; 
                $telefone = $data->telefone; 
                $Morada = $data->Morada;
                
                
                $check = $client->edit($id, $nome, $telefone, $Morada);
    
                if ($check) {
                    $arr['message'] = "Cliente editado com sucesso!";
                    $arr['message_type'] = "info";
                } else {
                    $arr['message'] = "Erro ao editar o cliente!";
                    $arr['message_type'] = "error";
                }
                $_SESSION['error'] = "";
                $arr['data'] = "";
                $arr['data_type'] = "edit_cliente";
    
                echo json_encode($arr);
            }
        }
    }
}