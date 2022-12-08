<?php 
 try{
    include_once('confg.php');
    // cria  a conexão com o banco de dados 
    
$conexao =  new PDO(MYSQL_DSN,DB_USER,DB_PASSWORD);
    // pega o valor informado pelo usuário no formulário de pesquisa
    $busca = isset($_GET['busca'])?$_GET['busca']:"";
    // monta consulta
    $query = 'SELECT * FROM pessoa';
    if ($busca != ""){ // se o usuário informou uma pesquisa
        $busca = '%'.$busca.'%'; // concatena o curiga * na pesquisa
        $query .= ' WHERE nome like :busca' ; // acrescenta a clausula where
    }
    // prepara consulta+
    $stmt = $conexao->prepare($query);
    // vincular variaveis com a consulta
    if ($busca != "") // somente se o usuário informou uma busca
        $stmt->bindValue(':busca',$busca);
    // executa a consuta 
    $stmt->execute();
    // pega todos os registros retornados pelo banco
    $usuarios = $stmt->fetchAll();
   // echo json_encode($usuarios);
    // foreach($usuarios as $usuario){ // percorre o array com todos os usuários imprimindo as linhas da tabela
    //     $editar = '<a href=cadUsuario.php?acao=editar&id='.$usuario['id'].'>Alt</a>';
    //     $excluir = "<a href='#' onclick=excluir('acao.php?acao=excluir&id={$usuario['id']}')>Excluir</a>";
    //     echo '<tr><td>'.$usuario['id'].'</td><td>'.$usuario['nome'].'</td><td>'.$usuario['email'].'</td><td>'.$usuario['senha'].'</td><td>'.$editar.'</td><td>'.$excluir.'</td></tr>';
    // }
}catch(PDOException $e){ // se ocorrer algum erro na execuçao da conexão com o banco executará o bloco abaixo
    print("Erro ao conectar com o banco de dados...<br>".$e->getMessage());
    die();
}
?>