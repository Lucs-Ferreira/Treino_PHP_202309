<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<h1>Tarefa: <?php echo $tarefa->getNome(); ?></h1>
<p>
    <strong>Conclu&iacute;da:</strong>
    <?php echo traduz_conclusao($tarefa->getConcluida()); ?>
</p>
<p>
    <strong>Descri&ccedil;&atilde;o:</strong>
    <?php echo nl2br($tarefa->getDescricao()); ?>
</p>
<p>
    <strong>Prazo:</strong>
    <?php echo traduz_data_para_exibir($tarefa->getPrazo()); ?>
</p>
<p>
    <strong>Prioridade:</strong>
    <?php echo traduz_prioridade($tarefa->getPrioridade()); ?>
</p>
<?php if (count($tarefa->getAnexos()) > 0) : ?>
    <p><strong>Aten&ccedil;&atilde;o!</strong> Esta tarefa cont&eacute;m anexos!</p>
<?php endif; ?>
<p>
    Tenha um bom dia!
</p>