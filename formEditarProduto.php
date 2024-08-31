<?php include("validarSessao.php")?>
<?php include("header.php") ?>

    <div class="container-fluid text-center">
        <div class='row text-center'>
            <div class='d-flex justify-content-center mb-3'>
                <div class='row'>
                    <div class='col-sm-12'>

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
                                        $idProduto           = $registro['idProduto'];
                                        $fotoProduto         = $registro['fotoProduto'];
                                        $nomeProduto         = $registro['nomeProduto'];
                                        $descricaoProduto    = $registro['descricaoProduto'];
                                        $categoriaProduto    = $registro["categoriaProduto"];
                                        $valorProduto        = $registro["valorProduto"];
                                        $condicaoProduto     = $registro["condicaoProduto"];
                                        $dataCadastroProduto = $registro["dataCadastroProduto"];
                                        $horaCadastroProduto = $registro["horaCadastroProduto"];
                                        $statusProduto       = $registro["statusProduto"];

                                        echo "
                                            <h2>Editar Produto:</h2>

                                            <form action='editarProduto.php' class='was-validated' method='POST' enctype='multipart/form-data'>

                                                <div class='form-floating mb-3 mt-3'> <!-- Exibe o ID do produto apenas como leitura -->
                                                    <input type='text' class='form-control' name='idProduto' value='$idProduto' readonly>
                                                    <label for='idProduto' class='form-label'>ID:</label>
                                                </div>

                                                <div class='form-group'>
                                                    <img src='$fotoProduto' width='100' title='Foto de $nomeProduto'>
                                                    <input type='hidden' name='fotoAtual' value='$fotoProduto'>
                                                    <input type='file' class='btn btn-link' name='fotoProduto'>
                                                </div>

                                                <div class='form-floating mb-3 mt-3'>
                                                    <input type='text' class='form-control' id='nomeProduto' placeholder='Informe o nome do Produto' name='nomeProduto' value='$nomeProduto' required>
                                                    <label for='nomeProduto' class='form-label'>Nome do Produto:</label>
                                                    <div class='valid-feedback'></div>
                                                    <div class='invalid-feedback'></div>
                                                </div>

                                                <div class='form-floating mb-3 mt-3'>
                                                    <textarea class='form-control' id='descricaoProduto' placeholder='Informe uma descrição do Produto' name='descricaoProduto' required>$descricaoProduto</textarea>
                                                    <label for='descricaoProduto' class='form-label'>Descrição do Produto:</label>
                                                    <div class='valid-feedback'></div>
                                                    <div class='invalid-feedback'></div>
                                                </div>

                                                <div class='form-floating mb-3 mt-3'>
                                                    <select class='form-select' id='categoriaProduto' name='categoriaProduto' required>
                                                        <option value='alimentos'>Alimentos</option>
                                                        <option value='eletronicos'>Eletrônicos</option>
                                                        <option value='vestuario'>Vestuário</option>
                                                    </select>
                                                    <label for='categoriaProduto' class='form-label'>Categoria:</label>
                                                    <div class='valid-feedback'></div>
                                                    <div class='invalid-feedback'></div>
                                                </div>

                                                <div class='form-floating mb-3 mt-3'>
                                                    <input type='text' class='form-control' id='valorProduto' placeholder='Informe o valor do Produto' name='valorProduto' value='$valorProduto' required>
                                                    <label for='valorProduto' class='form-label'>Valor do Produto:</label>
                                                    <div class='valid-feedback'></div>
                                                    <div class='invalid-feedback'></div>
                                                </div>

                                                <div class='form-check form-switch'>
                                                    <input class='form-check-input' type='checkbox' id='condicaoProduto' name='condicaoProduto' value='yes' checked>
                                                    <label class='form-check-label' for='condicaoProduto'>Produto novo</label>
                                                </div>

                                                <div class='form-group'>
                                                    <input type='hidden' name='statusProduto' value='$statusProduto'>
                                                </div>

                                                <br>

                                                <button type='submit' class='btn btn-primary'>Salvar Alterações</button>
                                            </form>";
                                    }
                                }
                                else{
                                    echo "<div class='alert alert-danger text-center'>Infelizmente não foi possível carregar o Produto!</div>";
                                }
                            }
                            else{
                                echo "<div class='alert alert-danger text-center'>Infelizmente não foi possível carregar o Produto!</div>";
                            }
                        ?>
                        
                    </div> 
                </div>
            </div>
        </div> 
    </div>

<?php include("footer.php") ?>