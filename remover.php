<?php

require_once "config.php";
require_once "banco.php";
require_once "Classes\RepositorioTarefa.php";

$repositorio_tarefa = new RepositorioTarefa($conexao);
$repositorio_tarefa->remover($_GET['id']);

header('Location:	tarefas.php');