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

            
            $this->view("servico", $data);
    }
    
}