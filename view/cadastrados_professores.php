<?php
    session_start();
    require '../model/Professor.class.php';

  
    $professor = new Professor();
    
    $pdo = $professor->getPdo(); 
    
    if(!empty($_GET['search'])) {
        $data = $_GET['search'];
        $sql = "SELECT * FROM professor WHERE 
        id LIKE :search
        OR nome     LIKE :search
        OR email    LIKE :search
        OR senha    LIKE :search
        OR materia  LIKE :search
        OR dataNasc LIKE :search
        OR telefone LIKE :search
        ORDER BY id DESC";

        $stmt = $pdo->prepare($sql);
        $param = "%$data%"; // Corrigido: era "%data%"
        $stmt->bindParam(':search', $param);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        
        $result = $professor->listarTodosProfessores(); 
    }
    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTEMA | RC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body{
            background: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
            color: white;
            text-align: center;
        }

        .table-bg{
            background: rgba(0,0,0,0.3);
            border-radius: 15px 15px 0 0;
        }

        .box-search{
            display: flex;
            justify-content: center;
            gap: .1%;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="d-flex">
            <a href="sair.php" class="btn btn-danger me-5">Sair</a>
        </div>
    </nav>
    <br>
    <br>
    <div class="box-search">
        <input type="search" class="form-control w-25" placeholder="Pesquisar" id="pesquisar">
        <button class="btn btn-primary" onClick="searchData()">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
</svg>
        </button>
    </div>
    <div class="m-5">
    <table class="table text-white table-bg">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nome</th>
      <th scope="col">Email</th>
      <th scope="col">Senha</th>
      <th scope="col">Materia</th>
      <th scope="col">Data de nascimento</th>
      <th scope="col">Telefone</th>
      <th scope="col">...</th>
    </tr>
  </thead>
  <tbody>
    <?php
        foreach($result as $user_data) {
            echo "<tr>";
            echo "<td>" .$user_data['id']."</td>" ;
            echo "<td>" .$user_data['nome']."</td>" ;
            echo "<td>" .$user_data['email']."</td>" ;
            echo "<td>" .$user_data['senha']."</td>" ;
            echo "<td>" .$user_data['materia']."</td>" ;
            echo "<td>" .$user_data['dataNasc']."</td>" ;
            echo "<td>" .$user_data['telefone']."</td>" ;
            echo "<td> 
             <a class='btn btn-sm btn-primary' href='edit.php?id={$user_data['id']}'>
             <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
            <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325'/>
            </svg>
            </a>
            <a class='btn btn-sm btn-danger' href='delete.php?id={$user_data['id']}'>
            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
            <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0'/>
            </svg>
            </a>
            </td>";
            echo "</tr>";
        }
    ?>
  </tbody>
</table>
    </div>
</body>
<script>
    var search = document.getElementById('pesquisar');
    
    search.addEventListener("keydown", function(event){
        if (event.key == "Enter"){
            searchData()
        }
    });

    function searchData()
        {
            window.location = 'cadastrados_alunos.php?search='+search.value;
        } 
</script>
</html>