
<?php
class Ajax extends Controller
{

    public function index()
    {

         // Load the Category model
         $servico = $this->load_model('Category');

        $data = file_get_contents("php://input");

        //  print_r(json_decode($data));

        //print_r($_POST);

        $data = json_decode($data);



        if(is_object($data) && isset($data->data_type) && $data->data_type == 'add_servico') {


            //$category = $this->load_model('Category');
           // ESTA CATEGORY QUE CHAMA O MODEL PASSOU A SER PUBLIC

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
?>