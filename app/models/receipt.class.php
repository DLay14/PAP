<?php


Class Receipt
{
    private $error = "";

    public function create($data)
    {
        $DB = Database::getInstance();

        if (!empty($data->servico) && $data->data_type == 'add_receipt') {
            
            $servico2 = ucwords(trim($data->servico));
            $Valor = (float) trim($data->Valor);
            $Num = (int) trim($data->Num);
            $ValorFinal = (float) trim($Num * $Valor);

            if(!preg_match("/^[a-zA-Z]+$/", $servico2)) {
                $_SESSION['error'] = "Por favor insira um nome de serviço correto!";
                return false;
            }

            $PaymentStatus_idPaymentStatus = 0;

            $query = "INSERT INTO receipt (servico, ValorPorHora, NumHoras, ValorFinal, PaymentStatus_idPaymentStatus) VALUES (:servico, :ValorPorHora, :NumHoras, :ValorFinal, :PaymentStatus_idPaymentStatus)";           
            
            $params = array(
                ':servico' => $servico2,
                ':ValorPorHora' => $Valor,
                ':NumHoras' => $Num,
                ':ValorFinal' => $ValorFinal, // Valor final é o valor por hora vezes o número de horas
                ':PaymentStatus_idPaymentStatus' => $PaymentStatus_idPaymentStatus
            );
            
            $check = $DB->write($query, $params);
            show($check); // show the result


            if($check) {
                return true;
            } else {
                $_SESSION['error'] = "Erro ao inserir o serviço na base de dados";
            }
            
        } else {
            $_SESSION['error'] = "Dados inválidos para inserir o recibo";
        }
        return false;
    }

    public function get_receipt()
    {
        $DB = Database::getInstance();

        $query = "select * from receipt"; 
        $result = $DB->read($query);

        return json_decode(json_encode($result), true);
    }
}