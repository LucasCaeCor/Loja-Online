<?php include "header.php"; ?>



<div class='row text-center'>
    <div class='d-flex justify-content-center mb-3'>
        <div class='card mb-5' style='width:40%; border-style:none;'>

            <?php
                //Verifica se há parâmetro por GET sendo recebido
                if(isset($_GET['idProduto'])){

                    //Variável PHP para armazenar o parâmetro recebido
                    $idProduto = $_GET['idProduto'];

                    //Inclui o arquivo de conexão com o BD
                    include "conexaoBD.php";

                    $exibirProduto = "SELECT * FROM Produtos WHERE idProduto = $idProduto";
                    $res = mysqli_query($conn, $exibirProduto); //Executa o comando de listagem
                    $totalProdutos = mysqli_num_rows($res); //Retornar a quantidade de registros

                    if($totalProdutos > 0){
                        
                        //Caso encontre o id, armazena os campos em um array
                        if($registro = mysqli_fetch_assoc($res)){
                            //Cria variáveis PHP e armazen os registros nelas
                            $idProduto           = $registro["idProduto"];
                            $fotoProduto         = $registro["fotoProduto"];
                            $nomeProduto         = $registro["nomeProduto"];
                            $descricaoProduto    = $registro["descricaoProduto"];
                            $categoriaProduto    = $registro["categoriaProduto"];
                            $valorProduto        = $registro["valorProduto"];
                            $condicaoProduto     = $registro["condicaoProduto"];
                            $dataCadastroProduto = $registro["dataCadastroProduto"];
                            $horaCadastroProduto = $registro["horaCadastroProduto"];
                            $statusProduto       = $registro["statusProduto"];
                                
                            //Monta o slider caso hajam produtos
                            echo "
                                <!-- Carousel -->
                                <div id='Produto' class='carousel slide' data-bs-ride='carousel'>

                                    <!-- Indicators/dots -->
                                    <div class='carousel-indicators'>
                                        <button type='button' data-bs-target='#Produto' data-bs-slide-to='0' class='active'></button>
                                        <button type='button' data-bs-target='#Produto' data-bs-slide-to='1'></button>
                                        <button type='button' data-bs-target='#Produto' data-bs-slide-to='2'></button>
                                    </div>
                                                
                                    <!-- The slideshow/carousel -->
                                    <div class='carousel-inner'>
                                        <div class='carousel-item active'>
                                            <img src='$fotoProduto' alt='$nomeProduto' class='d-block' style='width:100%'>
                                        </div>
                                        <div class='carousel-item'>
                                            <img src='$fotoProduto' alt='$nomeProduto' class='d-block' style='width:100%'>
                                        </div>
                                        <div class='carousel-item'>
                                            <img src='$fotoProduto' alt='$nomeProduto' class='d-block' style='width:100%'>
                                        </div>
                                    </div>
                                                
                                    <!-- Left and right controls/icons -->
                                    <button class='carousel-control-prev' type='button' data-bs-target='#Produto' data-bs-slide='prev'>
                                        <span class='carousel-control-prev-icon'></span>
                                    </button>
                                    <button class='carousel-control-next' type='button' data-bs-target='#Produto' data-bs-slide='next'>
                                        <span class='carousel-control-next-icon'></span>
                                    </button>

                                </div>

                                <div class='card-body'>
                                    <h4 class='card-title'><b>$nomeProduto</b></h4>
                                    <p class='card-text'>$descricaoProduto</p>
                                    <p class='card-text'>R$ <b>$valorProduto</b></p>
                                </div> 
                            ";
                                    
                            session_start();
                            if(isset($_SESSION['logado']) && $_SESSION['logado'] === true){
                                $tipoUsuario = $_SESSION['tipoUsuario'];
                                if($tipoUsuario == "administrador"){
                                    echo "
                                        <a href='formEditarProduto.php?idProduto=$idProduto' title='Editar Produto'>
                                            <button class='btn btn-outline-primary'>
                                                <i class='bi bi-gear' style='font-size:16pt;'></i>
                                                <p>Editar Produto</p>
                                            </button>
                                        </a>
                                    ";
                                }
                                else{
                                    if($statusProduto == 'disponivel'){
                                        echo "
                                            <a href='efetuarPedido.php?idProduto=$idProduto' title='Efetuar Pedido'>
                                                <button class='btn btn-outline-primary'>
                                                    <i class='bi bi-gear' style='font-size:16pt;'></i>
                                                    <p>Efetuar Pedido</p>
                                                </button>
                                            </a>
                                        ";
                                    }
                                    else{
                                        echo"
                                            <div class='alert alert-danger'>
                                                Produto Esgotado!
                                            </div>
                                        ";
                                    }
                                }
                            }
                            else{
                                echo "<div class='alert alert-info'><a href='formLogin.php' class='alert-link'>Clique aqui</a> para acessar o sistema e efetuar pedidos!</div>";
                            }
                        }
                    }
                }
            ?>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>