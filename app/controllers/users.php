<?php

class Users extends Controller
{
    public function index()
    {
        $User = $this->load_model('User');

        $data['user_data'] = $User->checklogin(true, ["user"]);

        if(is_array($data['user_data']))
        {
            $data['user_data'] = $user_data;
            show($data['user_data']);
        }

        $data['page_title'] = "Teste User Section";
        $this->view("../users/user_test", $data);
    }
}