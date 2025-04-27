<?php

    if(isset($_POST['submit']))
    {
        include_once('config.php');

        $name = $_POST['name'];
        $data_nasc = $_POST['data_nasc'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $result = mysqli_query($conexao, "INSERT INTO alunos(nome, data_nasc, email, senha) VALUES ('$name', '$data_nasc', '$email', '$senha')");

        header('Location: ../html/Home.html ');
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://kit.fontawesome.com/dfc8dc048e.js" crossorigin="anonymous"></script>

</head>

<body>
    <!---tela de cadastro --->
    <div class="container">
        <div class="content first-content">

            <div class="first-column">
                <h2 class="title title-primary"> Game Shakers</h2>
                <p class="description description-primary">Entrar com E-mail institucional</p>
                <a class="description description-primary" href="formulario.html" target="_blank">Formulário Institucional</a>
                <br>
                <br>
                <p class="description description-primary">Já tenho conta:</p>
                <button id="signin" class="btn btn-primary">Entrar</button>
            </div> <!--- first-column --->

            <div class="second-column">
                <h2 class="title title-second">Cadastre-se</h2>

                    <!--- redes sociais --->
                    <div class="social-media">
                        <ul class="list-social-media">
                            <a class="link-social-media" href="#"> <li class="item-social-media" >  <i class="fa-brands fa-instagram"></i>  </li> </a>
                            <a class="link-social-media" href="#"> <li class="item-social-media" > <i class="fa-brands fa-facebook-f"></i> </li> </a>
                            <a class="link-social-media" href="#"> <li class="item-social-media" > <i class="fa-brands fa-whatsapp"></i>  </li> </a>
                        </ul>
                    </div><!--- social media --->

                <p class="description description-second">Use seu e-mail para cadastro:</p>
                <form class="form" method="POST">
                    <label class="label-input" for="">
                        <i class="far fa-user icon-modify"></i>
                        <input name="name" type="text" placeholder="Name">
                    </label>

                    <label class="label-input" for="">
                        <i class="fa-solid fa-calendar-days icon-modify"></i>
                        <input name="data_nasc" type="date" placeholder="Data de Nascimento">
                    </label>

                    <label class="label-input" for="">
                        <i class="far fa-envelope icon-modify"></i>
                        <input name="email" type="email" placeholder="Email">
                    </label>

                    <label class="label-input" for="">
                        <i class="fas fa-lock icon-modify"></i>
                        <input name="senha" type="password" placeholder="Senha">
                    </label>


                    <input type="submit" name="submit" id="submit" value="Entrar"></input>
                </form>
            </div><!-- second column -->
        </div><!-- first content -->

         <!---tela de login --->
        <div class="content second-content">

            <div class="first-column">
                <h2 class="title title-primary">Game Shakers!</h2>
                <p class="description description-primary">Entrar com E-mail institucional</p>
                <a class="description description-primary" href="formulario.html" target="_blank">Formulário Institucional</a>
                <br>
                <br>
                <p class="description description-primary">Não tenho conta ainda</p>
                <button id="signup" class="btn btn-primary">Cadastre-se</button>
            </div>  <!--- first-column --->

            <div class="second-column">
                <h2 class="title title-second">Login</h2>

               <!--- redes sociais --->
                <div class="social-media">
                    <ul class="list-social-media">
                        <a class="link-social-media" href="#"> <li class="item-social-media" >  <i class="fa-brands fa-instagram"></i>  </li> </a>
                        <a class="link-social-media" href="#"> <li class="item-social-media" > <i class="fa-brands fa-facebook-f"></i> </li> </a>
                        <a class="link-social-media" href="#"> <li class="item-social-media" > <i class="fa-brands fa-whatsapp"></i>  </li> </a>
                    </ul>
                </div><!--- social media --->

                <p class="description description-second">or use your email account:</p>
                <form class="form">

                    <label class="label-input" for="">
                        <i class="far fa-envelope icon-modify"></i>
                        <input type="email" placeholder="Email">
                    </label>

                    <label class="label-input" for="">
                        <i class="fas fa-lock icon-modify"></i>
                        <input type="password" placeholder="Senha">
                    </label>

                    <a class="password" href="#">Esqueceu sua senha?</a>
                    <button class="btn btn-second">Entrar</button>
                </form>
            </div><!-- second column -->
        </div><!-- second-content -->
    </div>  <!--- container --->

    <script src="../js/app.js"></script>
</body>
</html>

