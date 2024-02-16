<?php
class App
{
    protected $controller = "home";
    protected $method = "index";
    protected $params;

    public function __construct()
    {
        $url = $this->parseURL();
        //print_r($url);

        if(file_exists("../app/controllers/" . strtolower($url[0]) . ".php"))
        {

            $this->controller = strtolower($url[0]);
            unset($url[0]);
        }

        require "../app/controllers/" . $this->controller . ".php";
        $this->controller = new $this->controller;
        //print_r($url);


        if(isset($url[1]))
        {
            //verificação da existencia de um metodo pos[2] da url
            $url[1] = strtolower($url[1]);
            if(method_exists($this->controller, $url[1]))
            {
                //remover
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        if (count($url) > 0)
        {
            $this->params =$url;
        }
        else
        {
            $this->params = ["home"];
        }

        call_user_func_array([$this->controller,$this->method],$this->params);

    }

    private function parseURL()
    {
        $url = isset($_GET['url']) ? $_GET['url'] : "home";
        return explode("/", filter_var(trim($url,"/"),FILTER_SANITIZE_URL));
    }
}
