<?php
class Logout extends Controller
{
    //Public default metodo index, mesmo que o utilizador coloque ou não qualquer URL, o Index vai sempre correr
    public function index()
     {

               $User = $this->load_model("User");
               $User->logout();

     }
}