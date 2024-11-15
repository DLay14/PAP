<?php

class Profile extends Controller
{
    public function index()
    {
        $User = $this->load_model('User');

        $data['user_data'] = $User->check_login(true);

        if(is_array($data['user_data']))
        {
            $data['user_data'] = $user_data;
            show($data['user_data']);
        }

        if ($data['user_data']->role == 'admin') {
            $this->view("profile", $data);
        } else {
            $this->view("../users/profile", $data);
        }
        die;

        $data['page_title'] = "Teste User Section";
        
    }
}