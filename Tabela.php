<table>
    <tr>
        <th>TAREFA</th>
        <th>DESCRIÇÃO</th>
        <th>PRAZO</th>
        <th>PRIORIDADE</th>
        <th>CONCLUIDA</th>
        <th colspan="2">OPÇÕES</th>
    </tr>
  
    <?php foreach ($lista_tarefas as $tarefa) : ?>
        <tr>
            <td id="tarefa"><a href="tarefa.php?id=<?php echo $tarefa->getId(); ?>"><?php echo htmlentities($tarefa->getNome()); ?></a></td>
            <td><?php echo htmlentities($tarefa->getDescricao()); ?></td>
            <td><?php echo traduz_data_para_exibir($tarefa->getPrazo()); ?></td>
            <td><?php echo traduz_prioridade($tarefa->getPrioridade()); ?></td>
            <td><?php echo traduz_conclusao($tarefa->getConcluida()); ?></td>
            <td id="editar"><a href="editar.php?id=<?php echo $tarefa->getId(); ?>">EDITAR</a></td>
            <td id="remover"><a href="remover.php?id=<?php echo $tarefa->getId(); ?>">REMOVER</a></td>
        </tr>
    <?php endforeach; ?>
</table>