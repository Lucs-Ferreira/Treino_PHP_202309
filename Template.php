<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="estilo.css">
    <title>Gerenciador de Tarefas</title>
</head>

<body>

    <h1 id= "form">Gerenciador de Tarefas</h1>
    <?php include 'formulario.php'; ?>
    <?php if ($exibir_tabela) : ?>
        <h1 id="tabela">Tarefas Atuais</h1>
        <?php include 'tabela.php'; ?>
    <?php endif; ?>

</body>

</html>