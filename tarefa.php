<?php

require_once "Config.php";
require_once "Banco.php";
require_once "Ajudantes.php";
require_once "Classes\Tarefa.class.php";
require_once "Classes\Anexo.class.php";
require_once "Classes\RepositorioTarefa.php";

$repositorio_tarefa = new RepositorioTarefa($conexao);
$tarefa = new Tarefa();

$tem_erros = false;
$erros_validacao = [];

if (tem_post()) {
    $tarefa_id = $_POST['tarefa_id'];

    if (!array_key_exists('anexo', $_FILES)) {
        $tem_erros = true;
        $erros_validacao['anexo'] = 'Você deve selecionar um arquivo para anexar';
    } else {
        $dadosAnexo = $_FILES['anexo'];
        if (tratarAnexo($dadosAnexo)) {
            $anexo = new Anexo();
            $anexo->setTarefaId($tarefa_id);
            $anexo->setNome($dadosAnexo['name']);
            $anexo->setArquivo($dadosAnexo['name']);
        } else {
            $tem_erros = true;
            $erros_validacao['anexo'] = 'Envie anexos nos formatos .zip ou .pdf';
        }

        if (!$tem_erros) {
            $repositorio_tarefa->salvarAnexo($anexo);
        }
    }
}


$tarefa = $repositorio_tarefa->buscar($_GET['id']);

include "template_tarefa.php";
