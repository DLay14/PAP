<?php
Class Register extends Controller
{
    public function index()
    {
        $this->title  = 'User - Register';

        if($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $User = $this->load_model("User");
            $User->signup($_POST);
        }
 
        $this->view("register");
    }
}