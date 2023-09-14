<?php

require_once "Config.php";
require_once "Banco.php";
require_once "Ajudantes.php";
require_once "Classes\Tarefa.class.php";
require_once "Classes\Anexo.class.php";
require_once "Classes\RepositorioTarefa.php";

$repositorio_tarefa = new RepositorioTarefa($conexao);

$exibir_tabela = true;

$tem_erros = false;
$erros_validacao = [];

$tarefa = new Tarefa();
$anexado = new Anexo();

$tarefa->setPrioridade(3);

$lista_tarefas = $repositorio_tarefa->buscar();


if (tem_post()) {

    if (array_key_exists('nome', $_POST) && strlen($_POST['nome']) > 0) {
        $tarefa->setNome($_POST['nome']);
    } else {
        $tem_erros = true;
        $erros_validacao['nome'] = 'O nome da tarefa é obrigatório!';
    }

    if (array_key_exists('descricao', $_POST)) {
        $tarefa->setDescricao($_POST['descricao']);
    } else {
        $tarefa->setDescricao('');
    }
    if (array_key_exists('prazo', $_POST) && strlen($_POST['prazo']) > 0) {
        if (validar_data($_POST['prazo'])) {
            $tarefa->setPrazo(traduz_data_para_banco($_POST['prazo']));
        } else {
            $tem_erros = true;
            $erros_validacao['prazo'] = 'O prazo não é uma data válida';
        }
    } else {
        $tem_erros = true;
        $erros_validacao['prazo'] = 'É obrigatório informar o prazo';
    }
    if (array_key_exists('prioridade', $_POST)) {
        $tarefa->setPrioridade($_POST['prioridade']);
    } else {
        $tarefa->setPrioridade('');
    }
    if (array_key_exists('concluida', $_POST)) {
        $tarefa->setConcluida($_POST['concluida']);
    } else {
        $tarefa->setConcluida(0);
    }

    if (!$tem_erros) {
        $repositorio_tarefa->salvar($tarefa);
        if (array_key_exists('lembrete', $_POST) && $_POST['lembrete'] == 1) {
            enviar_email($tarefa, $anexos = []);
        }
        header('Location: tarefas.php');
        die();
    }
}

include "template.php";
