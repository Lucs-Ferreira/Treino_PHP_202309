<?php session_start();

require_once "Config.php";
require_once "Banco.php";
require_once "Ajudantes.php";
require_once "Classes\Tarefa.class.php";
require_once "Classes\Anexo.class.php";
require_once "Classes\RepositorioTarefa.php";

$repositorio_tarefa = new RepositorioTarefa($conexao);
$tarefa = new Tarefa();

$exibir_tabela = false;

$tem_erros = false;
$erros_validacao = [];

$tarefa = $repositorio_tarefa->buscar($_GET['id']);


if (tem_post()) {
    $tarefa->setId($_GET['id']);

    if (isset($_POST['nome']) && strlen($_POST['nome']) > 0) {
        $tarefa->setNome($_POST['nome']);
    } else {
        $tem_erros = true;
        $erros_validacao['nome'] = 'O nome da tarefa é obrigatório!';
    }
    if (isset($_POST['descricao'])) {
        $tarefa->setDescricao($_POST['descricao']);
    } else {
        $tarefa->setDescricao('');
    }
    if (isset($_POST['prazo']) && strlen($_POST['prazo']) > 0) {
        if (validar_data($_POST['prazo'])) {
            $tarefa->setPrazo(traduz_data_para_banco($_POST['prazo']));
        } else {
            $tem_erros = true;
            $erros_validacao['prazo'] = 'O prazo não é uma data válida!';
        }
    } else {
        $tem_erros = true;
        $erros_validacao['prazo'] = 'É obrigatório informar o prazo';
    }
    if (isset($_POST['prioridade'])) {
        $tarefa->setPrioridade($_POST['prioridade']);
    } else {
        $tarefa->setPrioridade(0);
    }
    if (isset($_POST['concluida'])) {
        $tarefa->setConcluida(true);
    } else {
        $tarefa->setConcluida(false);
    }
    if (!$tem_erros) {
        $repositorio_tarefa->atualizar($tarefa);
        if (isset($_POST['lembrete']) && $_POST['lembrete'] == '1') {
            enviar_email($tarefa);
        }
        header('Location: tarefas.php');
        die();
    }
}


$tarefa = $repositorio_tarefa->buscar($_GET['id']);
require "template.php";
