<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
            //Código para deixar o title da página dinâmico

            if(isset($_GET['pagina'])){
                $pagina = $_GET['pagina']; //Pega o nome da página via GET

                switch($pagina){
                    case "index"       : echo "Página Inicial"; break;
                    case "formUsuario" : echo "Cadastrar Usuário"; break;
                    case "formProduto" : echo "Cadastrar Produto"; break;
                    case "formLogin"   : echo "Login"; break;

                    default            : echo "Genérico - Sistema de Vendas"; break;
                }
            }
            else{
                $pagina = "index";
                echo "Genérico - Sistemas de Vendas";
            }
        ?>
    </title>

    <!-- Úlitima versão compilada e minimizada CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Última versão compilada JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- CDNs para Máscaras JQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Script para Máscaras do Formulário -->
    <script>
        $(document).ready(function(){
            $("#telefoneUsuario").mask("(00) 00000-0000");
        });
    </script>

    <?php
        //Setar as configurações de horário para o fuso de América / São Paulo
        date_default_timezone_set('America/Sao_Paulo');
    ?>

</head>
<body>

    <!-- Container de Logotipo do Sistema -->
    <div class="container-fluid text-center">
        <a href="index.php" title="Retornar à Página Inicial">
            <img src="img/logo.png" width="100">
        </a>
        <h1>Genérico - Sistema Web para Vendas</h1>
    </div>

    <?php
        error_reporting(0); //Desabilita reportagem de erros de execução
        session_start(); //Inicia Sessão
        //Cria variáveis para receber os valores das variáveis de sessão
        $idUsuario    = $_SESSION["idUsuario"];
        $tipoUsuario  = $_SESSION["tipoUsuario"];
        $fotoUsuario  = $_SESSION["fotoUsuario"];
        $nomeUsuario  = $_SESSION["nomeUsuario"];
        $emailUsuario = $_SESSION["emailUsuario"];

        //Utiliza a função 'explode' para segmentar o nome completo e armazenar em um array
        $nomeCompleto = explode(' ', $nomeUsuario);
        $primeiroNome = $nomeCompleto[0];
    ?>

    <!-- Barra de Navegação do Sistema -->
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link <?php if($pagina == 'index'){ echo 'active'; } ?>" href="index.php?pagina=index" title="Ir para a Página Inicial">Home</a>
                    </li>

                    <?php
                        //Se o tipo de Usuario for administrador, exibe a opção Cadastrar Produto
                        if ($tipoUsuario == "administrador"){
                            echo "
                                <li class='nav-item'>
                                    <a class='nav-link "; if($pagina == 'formProduto'){ echo 'active'; } echo"' href='formProduto.php?pagina=formProduto' title='Cadastrar Produto'>Cadastrar Produto</a>
                                </li>
                            ";
                        }
                    ?>

                </ul>
            </div>
            <?php
                echo "<ul class='navbar-nav'>";
                    //Verifica se há sessão iniciada
                    if(isset($_SESSION['logado']) && $_SESSION['logado'] === true){
                        //Se houver sessão iniciada, exibe a foto do perfil, o email do usuário (amarelo, caso consumidor / vermelho, caso administrador) e troca a opção LOGIN por LOGOUT
                        echo "
                            <li>
                                <div class='container'>
                                    <img src='$fotoUsuario' class='img-fluid max-height rounded' title='Esta é a sua foto de perfil, $primeiroNome!' style='height:30px;'>
                                </div>
                            </li>
                            <li class='nav-item dropdown'>
                                <a class='nav-link dropdown-toggle' href='#' role='button' data-bs-toggle='dropdown' style='color: "; if($tipoUsuario == "administrador"){ echo "red'";} else{ echo "yellow'";} echo "><strong>$emailUsuario</strong></a>
                                <ul class='dropdown-menu'>
                                    <li><a class='dropdown-item' href='visualizarPerfil.php?pagina=formLogin&idUsuario=$idUsuario' title='Visualizar Perfil'>Meu Perfil</a></li>";
                                    if ($tipoUsuario == 'administrador'){ echo"
                                        <li><a class='dropdown-item' href='visualizarPedidos.php'>Visualizar Pedidos</a></li>";
                                    }else{
                                        echo"
                                        <li><a class='dropdown-item' href='visualizarPedidos.php?pagina=formProduto&idUsuario=$idUsuario'>Meus Pedidos</a></li>";
                                    }
                                    echo
                                    "<li><a class='dropdown-item' href='logout.php?pagina=formLogin' title='Sair do Sistema'>Logout</a></li>
                                </ul>
                            </li>
                        ";
                    }
                    else {
                        //Se não houver sessão iniciada, exibe a opção de acessar o sistema
                        echo "
                            <li class='nav-item'>
                                <a class='nav-link "; if($pagina == 'formLogin'){ echo 'active'; } echo "' href='formLogin.php?pagina=formLogin' title='Acessar o Sistema'>Login</a>
                            </li>
                        ";
                    }
                echo "</ul>";
            ?>
        </div>
    </nav>

    <!-- Container PRINCIPAL do Sistema-->
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">