<?php
//criação da classe home que estende para a classe controller
Class Home extends Controller
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
        $data['page_title'] = "Home - Dashboard";
        $this->view("home",$data);
    }
}