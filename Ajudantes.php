<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function traduz_prioridade($codigo)
{

    $prioridade = '';

    switch ($codigo) {
        case 1:
            $prioridade = 'Alta';
            break;
        case 2:
            $prioridade = 'Media';
            break;
        case 3:
            $prioridade = 'Baixa';
            break;
    }

    return $prioridade;
}

function traduz_data_para_banco($data)
{
    if ($data == "") {
        return "";
    }
    $partes = explode("/", $data);

    if (count($partes) != 3) {
        return $data;
    }

    $objeto_data = DateTime::createFromFormat('d/m/Y', $data);
    return $objeto_data->format('Y-m-d');
}

function traduz_data_para_exibir($data)
{
    if ($data == "" or $data == "0000-00-00") {
        return "";
    }
    $partes = explode("-", $data);

    if (count($partes) != 3) {
        return $data;
    }

    $objeto_data = DateTime::createFromFormat('Y-m-d', $data);
    return $objeto_data->format('d/m/Y');
}

function traduz_conclusao($concluido)
{
    $conclusao = '';

    switch ($concluido) {
        case 0:
            $conclusao = 'Nao';
            break;
        case 1:
            $conclusao = 'Sim';
            break;
    }

    return $conclusao;
}

function tem_post()
{
    if (count($_POST) > 0) {
        return true;
    }

    return false;
}

function validar_data($data)
{
    $padrao = '/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/';
    $resultado = preg_match($padrao, $data);

    if ($resultado == 0) {
        return false;
    }

    $dados = explode('/', $data);

    $dia = $dados[0];
    $mes = $dados[1];
    $ano = $dados[2];

    $resultado = checkdate($mes, $dia, $ano);

    return $resultado;
}

function tratarAnexo($anexo)
{
    $padrao = '/^[a-zA-Z0-9-_\.]+\.(pdf|zip|)$/';
    $resultado = preg_match($padrao, $anexo['name']);

    if ($resultado == 0) {
        return false;
    }

    move_uploaded_file($anexo['tmp_name'], "Anexos/{$anexo['name']}");
    return true;
}

function enviar_email(Tarefa $tarefa)
{
    
    require 'Bibliotecas/PHPMailer/src/Exception.php';
    require 'Bibliotecas/PHPMailer/src/PHPMailer.php';
    require 'Bibliotecas/PHPMailer/src/SMTP.php';

    try {
        $corpo = preparar_corpo_email($tarefa);
        $email = new PHPMailer(true);

        $email->isSMTP();
        $email->Host = "mail.pa.sumidenso.com.br";
        $email->Port = 587;
        $email->SMTPSecure = 'tls';
        $email->SMTPAuth = true;
        $email->Username = "lucas-ferreira@sumidenso.com.br";
        $email->Password = "lucs5841";
        $email->setFrom("lucas-ferreira@sumidenso.com.br", "Avisador de Tarefas");
        $email->addAddress(EMAIL_NOTIFICACAO);
        $email->Subject = "Aviso de Tarefa: {$tarefa->getNome()}";
        $email->msgHTML($corpo);

        foreach ($tarefa->getAnexos() as $anexo) {
            $email->addAttachment("Anexos/{$anexo->getArquivo()}");
        }
        
        $email->send();
        $_SESSION['erro'] = 0;
    } catch (Exception $e) {
        $_SESSION['erro'] = 1;
        $_SESSION['mensagemErro'] = 'Não foi possível enviar o email! Motivo: ' . $email->ErrorInfo;
    }
}

function preparar_corpo_email(Tarefa $tarefa)
{
    ob_start();

    include "template_email.php";

    $corpo = ob_get_contents();

    ob_end_clean();

    return $corpo;
}

function gravar_log($mensagemLog)
{
    $datahora = date("d/m/Y H:i:s");
    $mensagem = "{$datahora} - {$mensagemLog}\n";

    file_put_contents("Log/mensagens.log", $mensagem, FILE_APPEND);
}
