<?php
// Variavel da pesquisa 
$txt_pesquisa = (isset($_POST['txt_pesquisa']))?$_POST['txt_pesquisa']:"";

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
    <title> Agenda de Contatos </title>
</head>
<body>
    <header class="bg-dark">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a href="#" class="navbar-brand">
                  
                </a>

                <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item"><a href="index.php?menuop=home" class="nav-link active">Home</a></li>
                        <li class="nav-item"><a href="index.php?menuop=contatos" class="nav-link">Contato</a></li>
                        <li class="nav-item"><a href="index.php?menuop=tarefas" class="nav-link">Tarefas</a></li>
                        <li class="nav-item"><a href="index.php?menuop=eventos" class="nav-link">Eventos</a></li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="container">
            <h3><i class="bi bi-person-square"></i> Contatos</h3>
         </div>
    </header>
    <div class="container">
        <a class="btn btn-outline-secondary mb-2" href="create.php"><i class="bi bi-person-plus-fill"></i> Novo Contato</a>
    </div>
    <main>
   
</div> 
   <div class="container">
        <div class="input-group">
            <input class="form-control" type="text" name="txt_pesquisa" value="<?=$txt_pesquisa?>">
            <button class="btn btn-outline-success btn-sm" type="submit"><i class="bi bi-search"></i> Pesquisar</button>
        </div>
        <table class="table table-dark table-striped table-bordered table-sm">
        <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Endereço</th>
                            <th scope="col">Telefone</th>
                            <th scope="col">Email</th>
                            <th scope="col">Sexo</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <?php
                        $txt_pesquisa = (isset($_POST['txt_pesquisa']))?$_POST['txt_pesquisa']:"";
                        $sql = "SELECT * FROM pessoa WHERE id = '{$txt_pesquisa}' or  nome LIKE '%{$txt_pesquisa}%'";
                        
                    ?>

                    <tbody>
                        <?php
                        include 'banco.php';
                        $pdo = Banco::conectar();
                        $sql = 'SELECT * FROM pessoa ORDER BY id DESC';

                        foreach($pdo->query($sql)as $row)
                        {
                            echo '<tr>';
			                      echo '<th scope="row">'. $row['id'] . '</th>';
                            echo '<td>'. $row['nome'] . '</td>';
                            echo '<td>'. $row['endereco'] . '</td>';
                            echo '<td>'. $row['telefone'] . '</td>';
                            echo '<td>'. $row['email'] . '</td>';
                            echo '<td>'. $row['sexo'] . '</td>';
                            echo '<td width=250>';
                            echo '<a class="btn btn-outline-info btn-sm" href="read.php?id='.$row['id'].'"><i class="bi bi-info-square"> Info</i></a>';
                            echo ' ';
                            echo '<a class="btn btn-outline-warning btn-sm" href="update.php?id='.$row['id'].'"><i class="bi bi-pencil-square"> Editar</i></a>';
                            echo ' ';
                            echo '<a class="btn btn-outline-danger btn-sm" href="delete.php?id='.$row['id'].'"><i class="bi bi-trash-fill"> Deletar</i></a>';
                            echo '</td>';
                            echo '</tr>';
                        }
                        Banco::desconectar();
                        ?>
                    </tbody>
        </table>
    </div>
    </div>
    </main>
    <footer class="container-fluid bg-dark text-light">
        <div class="text-center">Agenda</div>
    </footer>
    
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<p id="listagem"></p>
                
<script src="script.js"></script>
</body>
</html>
