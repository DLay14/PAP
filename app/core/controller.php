<?php

Class Controller
{

    public function view($path, $data = [])
    {
        if(file_exists("../app/views/admin/" . $path . ".php"))
        {
            include "../app/views/admin/" . $path . ".php";
        }
        else
        {
            $this->view("404");
        }
    }
}