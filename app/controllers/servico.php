<?php

class Servico extends Controller
{
    public function index()
    {
        // Carrega o modelo User
        $User = $this->load_model('User');

        // Verifica o login do usuário
        $data['user_data'] = $User->check_login(true, ["admin"]);

        if (is_array($data['user_data'])) {
            $data['user_data'] = $user_data;
            // show($data['user_data']);
        }

        // Carrega o modelo ServiceModel
        $ServiceModel = $this->load_model('ServiceModel');
        
        // Obtém os serviços
        $data['services'] = $ServiceModel->getServices();

        // Define o título da página
        $data['page_title'] = "Teste User Section";

        // Carrega a view com os dados
        $this->view("servico", $data);
    }
}
