<?php
//criação da classe home que estende para a classe controller
Class Home extends Controller
{
    //A funçao index vai buscar a view do ficheiro home
    public function index()
    {
        $this->view("home");
    }
}