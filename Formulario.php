<form method="POST">
    <input type="hidden" name="id" value="<?php echo $tarefa->getId(); ?>" />
    <fieldset>
        <legend>NOVA TAREFA</legend>    
        <label>
            Tarefa:
            <?php if ($tem_erros && array_key_exists('nome', $erros_validacao)) : ?>
                <span class="erro"> <?php echo $erros_validacao['nome']; ?> </span>
            <?php endif; ?>
            <input type="text" name="nome" value="<?php echo htmlentities($tarefa->getNome()); ?>" />
        </label>
        <label>
            Descrição (Opcional):
            <textarea name="descricao"><?php echo htmlentities($tarefa->getDescricao()) ?></textarea>
        </label>
        <label>
            Prazo:
            <?php if ($tem_erros && array_key_exists('prazo', $erros_validacao)) : ?>
                <span class="erro"> <?php echo $erros_validacao['prazo']; ?> </span>
            <?php endif; ?>
            <input type="text" name="prazo" value="<?php echo traduz_data_para_exibir($tarefa->getPrazo()); ?>" />
        </label>
        <fieldset>
            <legend>Prioridade:</legend>
            <label>
                <input type="radio" name="prioridade" value="3" <?php echo ($tarefa->getPrioridade() == 3) ? 'checked' : ''; ?> /> Baixa
                <input type="radio" name="prioridade" value="2" <?php echo ($tarefa->getPrioridade() == 2) ? 'checked' : ''; ?> /> Média
                <input type="radio" name="prioridade" value="1" <?php echo ($tarefa->getPrioridade() == 1) ? 'checked' : ''; ?> /> Alta
            </label>
        </fieldset>
        <label>
            Tarefa concluida:
            <input type="checkbox" name="concluida" value="1" <?php echo ($tarefa->getConcluida() == 1) ? 'checked' : ''; ?> />
        </label>
        <label>
            Lembrete por e-mail:
            <input type="checkbox" name="lembrete" value="1" />
        </label>
        <input type="submit" value=<?php echo ($tarefa->getId() > 0) ? 'Atualizar' : 'Cadastrar'; ?> />
        
        <?php if ($exibir_tabela == false) : ?>
        <input type="submit" value=Cancelar onclick="location.href='Tarefas.php'" />
        <?php endif; ?>
    </fieldset>
</form>