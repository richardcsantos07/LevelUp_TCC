<?php

    if(isset($_POST['submit']))
    {
        include_once('config.php');

        $name = $_POST['name'];
        $data_nasc = $_POST['data_nasc'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $result = mysqli_query($conexao, "INSERT INTO cadastro(nome, data_nasc, email, senha) VALUES ('$name', '$data_nasc', '$email', '$senha')");

        header('Location: index.php');
    }
?>

<!DOCTYPE html>
<html lang="pt-br"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário | GN</title>
    <link rel="stylesheet" href="css/formulario.css">
    <script src="https://kit.fontawesome.com/dfc8dc048e.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="box">
        <form action="#" method="POST">
            <fieldset>
                <legend><b>Formulário Institucional</b></legend>
                
                
                <p class="description description-second">Insira seus dados:</p>

                <div class="toggle-group">
                    <div>
                        <p>Professor:</p>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox" checked>
                        <span class="slider"></span>
                    </label>
                </div>

                <label class="label-input" for="name">
                    <i class="far fa-user icon-modify"></i>
                    <input id="name" name="name" type="text" placeholder="Nome" required>
                </label>

                <br>

                <label class="label-input" for="email">
                    <i class="far fa-envelope icon-modify"></i>
                    <input id="email" name="email" type="email" placeholder="Email Institucional" required>
                </label>

                <br>

                <label class="label-input" for="senha">
                    <i class="fas fa-lock icon-modify"></i>
                    <input id="senha" name="senha" type="password" placeholder="Senha" required>
                </label>

                <br>

                <label class="label-input" for="data_nasc">
                    <i class="fa-solid fa-calendar-days icon-modify"></i>
                    <input id="data_nasc" name="data_nasc" type="date" required>
                </label>

                <br>
                
                <label class="label-input" for="estado">
                    <i class="fa-solid fa-earth-americas icon-modify"></i>
                    <input id="estado" name="estado" type="text" placeholder="Estado" required>
                </label>

                <br>
                
                <label class="label-input" for="nome_inst">
                    <i class="fa-solid fa-school icon-modify"></i>
                    <input id="nome_inst" name="nome_inst" type="text" placeholder="Nome da Instituição" required>
                </label>

                

                <button class="btn btn-second" type="submit">Enviar</button>
            </fieldset>
        </form>
    </div>
</body>
</html>