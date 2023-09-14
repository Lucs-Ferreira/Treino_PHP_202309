<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="estilo.css" type="text/css" />
    <title>Gerenciador de Tarefas</title>
</head>

<body>
    <div="bloco_principal">
        <h1>Tarefa: <?php echo htmlentities($tarefa->getNome()); ?></h1>
        <p>
            <a href="tarefas.php">
                Voltar para a lista de tarefas
            </a>
        </p>
        <p>
            <strong>Concluída:</strong>
            <?php echo
            traduz_conclusao($tarefa->getConcluida());    ?>
        </p>
        <p>
            <strong>Descrição:</strong>
            <?php echo    nl2br(htmlentities($tarefa->getDescricao()));    ?>
        </p>
        <p>
            <strong>Prazo:</strong>
            <?php echo
            traduz_data_para_exibir($tarefa->getPrazo()); ?>
        </p>
        <p>
            <strong>Prioridade:</strong>
            <?php echo
            traduz_prioridade($tarefa->getPrioridade());    ?>
        </p>
        <h2>Anexos</h2>
        <?php if (count($tarefa->getAnexos()) > 0) :    ?>
            <table>
                <tr>
                    <th>Arquivo</th>
                    <th>Opções</th>
                </tr>
                <?php foreach ($tarefa->getAnexos() as $anexo) :    ?>
                    <tr>
                        <td><?php echo $anexo->getNome();    ?></td>
                        <td>
                            <a href="Anexos/<?php echo $anexo->getArquivo(); ?>">
                                Download
                            </a>
                        </td>
                        <td>
                            <a href="remover_anexo.php?id=<?php echo $anexo->getId(); ?>">
                                Deletar
                            </a>
                        </td>
                    </tr>
                <?php endforeach;    ?>
            </table>
        <?php else :    ?>
            <p>Não há anexos para esta tarefa.</p>
        <?php endif;    ?>

        <form id="formularioAnexar" method="post" enctype="multipart/form-data">
            <fieldset>
                <legend>Novo anexo</legend>
                <input type="hidden" name="tarefa_id" value="<?php echo $tarefa->getId();    ?>" />
                <label for="selecao_arquivo">Selecionar um arquivo
                    <?php if ($tem_erros && array_key_exists('anexo', $erros_validacao)) : ?>
                        <span class="erro">
                            <?php echo $erros_validacao['anexo'];    ?>
                        </span>
                    <?php endif; ?>
                    <input id="botaoSelecionar" type="file" name="anexo" />
                </label>
                <input id="botaoAdicionar" type="submit" value="Adicionar" />
            </fieldset>
        </form>
        </div>
</body>

</html>