<?php

class Ajax extends Controller
{
    public function index(){
        $data = file_get_contents("php://input");
        $data = json_decode($data);

        if(is_object($data) && isset($data->data_type) && $data->data_type == 'add_category')
        {
            $category = $this->load_model('Category');
            $check = $category->create($data);

            //show($data);

            if(!empty($_SESSION['error']))
            {
                $arr['message'] = $_SESSION['error'];
                $_SESSION['error'] = "";
                $arr['message_type'] = "error";          
            }else{
                $arr['message'] = "Serviço adicionado com sucesso!";
                $arr['message_type'] = "info";
            }
            $arr['data'] = "";
            echo json_encode($arr);

        }
    }
}