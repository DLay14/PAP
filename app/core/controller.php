<?php

//Criação da class controller
Class Controller
{
    //função view que carrega um if para verificar a existencia de um ficheiro
    public function view($path, $data = [])
    {  
        //se o ficheiro existir inclui na pagina inicial
        if(file_exists("../app/views/admin/" . $path . ".php"))
        {
            include "../app/views/admin/" . $path . ".php";
        }
        //se nao, é mostrado a pagina de erro 404 
        else
        {
            $this->view("404");
        }
    }
}