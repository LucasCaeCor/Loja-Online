<?php include "header.php" ?>

<?php
    //Se houver código identificador do Produto
    if(isset($_GET['idProduto'])){
        $idProduto = $_GET['idProduto'];
        session_start();
        if(isset($_SESSION['logado']) && $_SESSION['logado'] === true){
            $idUsuario    = $_SESSION['idUsuario']; //Pega o ID do Usuário pela sessão
            $dataPedido   = date('Y-m-d');
            $horaPedido   = date('H:i:s');
            $statusPedido = "Solicitado";

            //Converte a data para exibir na tabela final
            $dia = substr($dataPedido, 8, 2);
            $mes = substr($dataPedido, 5, 2);
            $ano = substr($dataPedido, 0, 4);
            
            //Cria a query para inserção dos registros na tabela Pedido
            $inserirPedido = "INSERT INTO Pedidos (idUsuario, idProduto, dataPedido, horaPedido, statusPedido)
                                VALUES ($idUsuario, $idProduto, '$dataPedido', '$horaPedido', '$statusPedido')";

            include "conexaoBD.php";

            if(mysqli_query($conn, $inserirPedido)){
                echo "<div class='alert alert-success text-center'>Pedido efetuado com sucesso!</div>";

                echo "
                    <table class='table'>
                        <thead class='table-dark'>
                            <tr>
                                <th>Produto</th>
                                <th>Data do Pedido</th>
                                <th>Hora do Pedido</th>
                                <th>Status do Pedido</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>$idProduto</td>
                                <td>$dia/$mes/$ano</td>
                                <td>$horaPedido</td>
                                <td>$statusPedido</td>
                            </tr>
                        </tbody>
                    </table>
                ";
            }
            else{
                echo "<div class='alert alert-danger text-center'>Erro ao tentar registrar pedido!</div>" . mysqli_error($conn) . "<br>" . $inserirPedido;
            }
        }
        else{
            echo "<div class='alert alert-danger text-center'>Usuário não logado!</div>";
        }
    }
    else{
        echo "<div class='alert alert-danger text-center'>Produto não localizado!</div>";
    }
?>

<?php include "footer.php" ?>