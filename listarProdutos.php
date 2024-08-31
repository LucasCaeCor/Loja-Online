<?php include "header.php"; ?>

<?php

    include_once "conexaoBD.php"; //Inclui o arquivo de conexão com o BD
    $listarProdutos = "SELECT * FROM Produtos"; //Query para selecionar TODOS o Produtos
    $res = mysqli_query($conn, $listarProdutos) or die("Erro ao tentar listar produtos!" . mysqli_error($conn));

    $totalProdutos = mysqli_num_rows($res); //Retorna o total de registros retornado pela Query

    echo "<h2>Total de Produtos cadastrados: $totalProdutos</h2>";

    //Monta o cabeçalho da tabela para exibir os registros
    echo "
        <table class='table'>
            <thead class='thead-light'>
                <tr>
                    <th>ID</th>
                    <th>FOTO</th>
                    <th>NOME</th>
                    <th>DESCRIÇÃO</th>
                    <th>CATEGORIA</th>
                    <th>VALOR</th>
                    <th>CONDIÇÃO</th>
                    <th>DATA</th>
                    <th>HORA</th>
                    <th>STATUS</th>
                </tr>
            </thead>";

            //Varre a tabela enquanto houverem registros e armazena-os em um array
            while ($registro = mysqli_fetch_assoc($res)){
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

                echo "
                    <tbody>
                        <tr>
                            <td>$idProduto</td>
                            <td><img src='$fotoProduto' width='100'></td>
                            <td>$nomeProduto</td>
                            <td>$descricaoProduto</td>
                            <td>$categoriaProduto</td>
                            <td>$valorProduto</td>
                            <td>$condicaoProduto</td>
                            <td>$dataCadastroProduto</td>
                            <td>$horaCadastroProduto</td>
                            <td>$statusProduto</td>
                        </tr>
                    </tbody>
                ";
            }
        echo "</table>";

?>

<?php include "footer.php"; ?>