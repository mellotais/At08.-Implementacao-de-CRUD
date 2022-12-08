

<?php
require 'banco.php';
//Acompanha os erros de validação

// Processar so quando tenha uma chamada post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeErro = null;
    $enderecoErro = null;
    $telefoneErro = null;
    $emailErro = null;
    $sexoErro = null;

    if (!empty($_POST)) {
        $validacao = True;
        $novoUsuario = False;
        if (!empty($_POST['nome'])) {
            $nome = $_POST['nome'];
        } else {
            $nomeErro = 'Por favor digite o seu nome!';
            $validacao = False;
        }


        if (!empty($_POST['endereco'])) {
            $endereco = $_POST['endereco'];
        } else {
            $enderecoErro = 'Por favor digite o seu endereço!';
            $validacao = False;
        }


        if (!empty($_POST['telefone'])) {
            $telefone = $_POST['telefone'];
        } else {
            $telefoneErro = 'Por favor digite o número do telefone!';
            $validacao = False;
        }


        if (!empty($_POST['email'])) {
            $email = $_POST['email'];
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $emailErro = 'Por favor digite um endereço de email válido!';
                $validacao = False;
            }
        } else {
            $emailErro = 'Por favor digite um endereço de email!';
            $validacao = False;
        }


        if (!empty($_POST['sexo'])) {
            $sexo = $_POST['sexo'];
        } else {
            $sexoErro = 'Por favor seleccione um campo!';
            $validacao = False;
        }
    }

//Inserindo no Banco:
    if ($validacao) {
        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO pessoa (nome, endereco, telefone, email, sexo) VALUES(?,?,?,?,?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($nome, $endereco, $telefone, $email, $sexo));
        Banco::desconectar();
        header("Location: index.php");
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="pagina.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <title> Cadastro </title>
</head>
<body>
    <header class="bg-dark">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <h2><i class="bi bi-person-square"></i> Cadastro de Contato</h2>
            </nav>
            
        </div>
    </header>
    <main>
  
<div class="container">
<div>
    <form class="form-horizontal" action="create.php" method="post">
    <div class="mb-3<?php echo !empty($nomeErro) ? 'error' : ''; ?>">
            <label class="form-label" for="nome">Nome</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                <input class="form-control" type="text" name="nome" required
                value="<?php echo !empty($nome) ? $nome : ''; ?>">
                            <?php if (!empty($nomeErro)): ?>
                                <span class="text-danger"><?php echo $nomeErro; ?></span>
                            <?php endif; ?>
            </div>
        </div>
        <div class="mb-3 <?php echo !empty($emailErro) ? 'error' : ''; ?>">
            <label class="form-label" for="email">E-Mail</label>
            <div class="input-group">
                <span class="input-group-text">@</span>
                <input class="form-control" type="email" name="email" required
                value="<?php echo !empty($email) ? $email : ''; ?>">
                            <?php if (!empty($emailErro)): ?>
                                <span class="text-danger"><?php echo $emailErro; ?></span>
                            <?php endif; ?>
            </div>
        </div>
        <div class="mb-3 <?php echo !empty($telefoneErro) ? 'error' : ''; ?>">
            <label class="form-label" for="telefone">Telefone</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                <input class="form-control" type="text" name="telefone" required
                                                   value="<?php echo !empty($telefone) ? $telefone : ''; ?>">
                            <?php if (!empty($telefoneErro)): ?>
                                <span class="text-danger"><?php echo $telefoneErro; ?></span>
                            <?php endif; ?>
            </div>
        </div>
        <div class="mb-3 <?php echo !empty($enderecoErro) ? 'error' : ''; ?>">
            <label class="form-label" for="endereco">Endereço</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-mailbox2"></i></span>
                <input class="form-control" type="text" name="endereco" required           
                 value="<?php echo !empty($endereco) ? $endereco : ''; ?>">
                            <?php if (!empty($enderecoErro)): ?>
                                <span class="text-danger"><?php echo $enderecoErro; ?></span>
                            <?php endif; ?>
            </div>

        </div>
        <div class="row">
        <div class="control-group <?php !empty($sexoErro) ? 'echo($sexoErro)' : ''; ?>">
                        <div class="controls">
                            <label class="control-label">Sexo</label>
                            <div class="form-check">
                                <p class="form-check-label">
                                    <input class="form-check-input" type="radio" name="sexo" id="sexo"
                                           value="M" <?php isset($_POST["sexo"]) && $_POST["sexo"] == "M" ? "checked" : null; ?>/>
                                    Masculino</p>
                            </div>
                            <div class="form-check">
                                <p class="form-check-label">
                                    <input class="form-check-input" id="sexo" name="sexo" type="radio"
                                           value="F" <?php isset($_POST["sexo"]) && $_POST["sexo"] == "F" ? "checked" : null; ?>/>
                                    Feminino</p>
                            </div>
                            <?php if (!empty($sexoErro)): ?>
                                <span class="help-inline text-danger"><?php echo $sexoErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
        
        <div class="mb-3">
            <input class="btn btn-success" type="submit" value="Adicionar" name="btnAdicionar">
             <a href="index.php" type="btn" class="btn btn-default">Voltar</a>
        </div>
    </form>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<script src="./js/validation.js"></script>
</body>

</html>

