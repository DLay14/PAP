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

            $PaymentStatus_idPaymentStatus = 3;

            $query = "INSERT INTO receipt (servico, ValorPorHora, NumHoras, ValorFinal, PaymentStatus_idPaymentStatus) VALUES (:servico, :ValorPorHora, :NumHoras, :ValorFinal, :PaymentStatus_idPaymentStatus)";           
            
            $params = array(
                ':servico' => $servico2,
                ':ValorPorHora' => $Valor,
                ':NumHoras' => $Num,
                ':ValorFinal' => $ValorFinal, // Valor final é o valor por hora vezes o número de horas
                ':PaymentStatus_idPaymentStatus' => $PaymentStatus_idPaymentStatus
            );
            
            $check = $DB->write($query, $params);
            // show($check); // show the result


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

    public function delete($id)
    {
        $DB = Database::getInstance();
        $id = (int)$id;
        $query = "DELETE FROM receipt WHERE idReceipt = '$id' LIMIT 1";
        $result = $DB->write($query);
        return $result;
    }

    public function edit($id, $new_servico, $ValorPorHora, $NumHoras) {
        
        $DB = Database::getInstance();

        $new_servico = ucwords(trim($new_servico));
        $ValorPorHora = trim($ValorPorHora);
        $NumHoras = trim($NumHoras);

        if(empty($ValorPorHora)){
            $ValorPorHora = 0;
        }elseif(empty($NumHoras)){
            $NumHoras = 0;
        }

        $ValorFinal = (float) trim($NumHoras * $ValorPorHora);  


        if (!preg_match("/^[a-zA-Z]+$/", $new_servico)){
            $_session['error'] = "Por favor insira um serviço valido!";
            return false;
        }
        
        // Prepara a consulta SQL
        $query = "UPDATE receipt SET servico = :servico, ValorPorHora = :ValorPorHora, NumHoras = :NumHoras, ValorFinal = :ValorFinal WHERE idReceipt = :idReceipt LIMIT 1";
        $params = array(
            ':servico' => $new_servico,
            ':ValorPorHora' => $ValorPorHora,
            ':NumHoras' => $NumHoras,
            ':ValorFinal' => $ValorFinal,
            ':idReceipt' => $id
        );


        // Executa a consulta usando o método write do objeto Database
        return $DB->write($query, $params);
    }
    
}