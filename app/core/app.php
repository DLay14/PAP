<?php
class App
{
    // Controlador padrão
    protected $controller = "login";
    // Método padrão
    protected $method = "index";
    // Parâmetros da URL
    protected $params;

    // Método construtor
    public function __construct()
    {
        // Obtém a URL parseada
        $url = $this->parseURL();
        

        // Verifica se o arquivo do controlador existe
        if(file_exists("../app/controllers/" . strtolower($url[0]) . ".php"))
        {
            // Define o controlador com base no primeiro segmento da URL
            $this->controller = strtolower($url[0]);
            // Remove o primeiro segmento da URL
            unset($url[0]);
        }

        // Inclui o arquivo do controlador
        require "../app/controllers/" . $this->controller . ".php";
        // Cria uma instância do controlador
        $this->controller = new $this->controller;

        // Verifica se há um método especificado na URL
        if(isset($url[1]))
        {
            // Verifica se o método existe no controlador
            $url[1] = strtolower($url[1]);
            if(method_exists($this->controller, $url[1]))
            {
                // Define o método
                $this->method = $url[1];
                // Remove o segundo segmento da URL
                unset($url[1]);
            }
        }

        // Se houver mais segmentos na URL, define-os como parâmetros
        if (count($url) > 0)
        {
            $this->params =$url;
        }
        else
        {
            // Se não houver mais segmentos, define "home" como parâmetro padrão
            $this->params = ["home"];
        }

        // Chama o método do controlador com os parâmetros fornecidos
        call_user_func_array([$this->controller,$this->method],$this->params);

    }

    // Método para analisar a URL
    private function parseURL()
    {
        // Obtém a URL da variável $_GET
        $url = isset($_GET['url']) ? $_GET['url'] : "home";
        // Limpa a URL e a divide em segmentos
        return explode("/", filter_var(trim($url,"/"),FILTER_SANITIZE_URL));
    }
}
?>
