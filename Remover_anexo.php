<?php 
require_once "Config.php";
require_once "Banco.php";
require_once "Classes\Anexo.class.php";
require_once "Classes\RepositorioTarefa.php";

$repositorioTarefa = new RepositorioTarefa($conexao);
$anexo = $repositorioTarefa->buscarAnexo($_GET['id']);
$repositorioTarefa->removerAnexo($anexo->getId());
unlink('Anexos/' . $anexo->getArquivo());

header('Location: tarefa.php?id=' . $anexo->getTarefaId());
