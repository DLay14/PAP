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

            $categoryModel = $this->load_model('Category');
            $data['TipoServico'] = $categoryModel->get_categories();
            $data['idTask'] = $categoryModel->get_task();
            // show(       "Estou no controlador");
            // show(        $data['categories']);
            // show($data);
            $this->view("servico", $data);
    }

    public function servico()
    {
        // Load the Category model
        $servico = $this->load_model('Category');

        //Get data from the view
        $data = file_get_contents("php://input");
        $data = json_decode($data);

        show($data);
        die;

        if(is_object($data) && isset($data->data_type) && $data->data_type == 'add_servico') {

            $check = $servico->create($data);

            if(!empty($_SESSION['error'])) {
                $arr['message'] =  $_SESSION['error'];
                $_SESSION['error'] = "";
                $arr['message_type'] = "error";
            } else {
                $arr['message'] = "Serviço adicionado com sucesso!";
                $arr['message_type'] = "info";
            }

            $arr['data'] = "";
            echo json_encode($arr);
        }
       // Handle deleting a category
        elseif ($data->data_type == 'delete_row') {
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
            $arr['data_type'] = "delete_row";
            
            echo json_encode($arr);
        }

        elseif($data->data_type == 'disabled_row') {

            $id = $data->id;
            $status = $data->current_state ? 0: 1;

            $query = "UPDATE service set status = :status Where idService = :idService Limit 1";
            $params = array(':status' => $status, ':idService' => $id);
            $DB = Database::getInstance();
            $DB->write($query, $params);

            $arr['message'] = "";
            $_SESSION['error'] = "";
            $arr['message_type'] = "info";
            $arr['data'] = "";
            $arr['data_type'] = "disabled_row";

            echo json_encode($arr);
        }

        elseif($data->data_type == 'edit_servico')
        {
            $id = $data->id;
            $new_servico = $data->data;
            $datainicio = $data->data;
            $datafim = $data->data;
            $taskid = $data->data;
            
            $check = $servico->edit($id, $new_servico, $datainicio, $datafim, $taskid);
            // var_dump($check);
            if($check) {
                $arr['message'] = "Serviço editado com sucesso!";
                $arr['message_type'] = "info";
            } else{
                $arr['message'] = "Erro ao editar o serviço!";
                $arr['message_type'] = "error";
            }
            $_session['error'] = "";
            $arr['data'] = "";
            $arr['data_type'] = "edit_row";

            echo json_encode($arr);
        }
    }
}