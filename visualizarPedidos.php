<?php include "header.php" ?>

<?php
    session_start(); //Starta uma sessão
    if(isset($_SESSION['logado']) && $_SESSION['logado'] === true){
        $listarPedidos = "SELECT 
                            p.idPedido,
                            p.idUsuario,
                            u.nomeUsuario,
                            pr.idProduto,
                            pr.fotoProduto,
                            pr.nomeProduto,
                            pr.valorProduto,
                            pr.dataCadastroProduto,
                            pr.horaCadastroProduto,
                            pr.statusProduto,
                            p.dataPedido,
                            p.horaPedido,
                            p.statusPedido
                        FROM
                            Pedidos p
                        INNER JOIN
                            Produtos pr ON p.idProduto = pr.idProduto
                        INNER JOIN
                            Usuarios u ON p.idUsuario = u.idUsuario ";
                        //Query para selecionar dados de Usuarios, Produtos e Pedidos.

                        //Se for usuário consumidor, busca apenas os pedidos com o seu próprio id
                        if ($_SESSION['tipoUsuario'] == 'consumidor'){
                            $idUsuario = $_SESSION['idUsuario'];
                            $listarPedidos = $listarPedidos . "AND p.idUsuario = $idUsuario";
                        }
                    
                    include "conexaoBD.php";
                    $res = mysqli_query($conn, $listarPedidos) or die("Erro ao tentar listar pedidos!" . mysqli_error($conn));
                    $totalPedidos = mysqli_num_rows($res); //Retorna o total de registros encontrados pela Query

                    if($totalPedidos > 0){
                        if($totalPedidos == 1){
                            echo "<div class='alert alert-info text-center'>Você possui <b>$totalPedidos</b> pedido!</div>";
                        }
                        else{
                            echo "<div class='alert alert-info text-center'>Você possui <b>$totalPedidos</b> pedidos!</div>";
                        }

                        echo "
                            <table class='table'>
                                <thead class='table-dark'>
                                    <tr>
                                        <th>ID do Pedido</th>";
                                        if($_SESSION['tipoUsuario'] == "administrador"){
                                            echo "<th>Consumidor</th>";
                                        }
                                        echo "
                                        <th>Foto</th>
                                        <th>Produto</th>
                                        <th>Valor do Pedido</th>
                                        <th>Data do Pedido</th>
                                        <th>Hora do Pedido</th>
                                        <th>Status do Pedido</th>";
                                        if($_SESSION['tipoUsuario'] == "administrador"){
                                            echo "<th></th>";
                                        }
                                        echo"
                                    </tr>
                                </thead>
                                <tbody>
                        ";
                        while ($registro = mysqli_fetch_assoc($res)){
                            //Cria variáveis PHP e armazena os registros do BD nelas
                            $idPedido     = $registro['idPedido'];
                            $idusuario    = $registro['idUsuario'];
                            $nomeUsuario  = $registro['nomeUsuario'];
                            $fotoProduto  = $registro['fotoProduto'];
                            $nomeProduto  = $registro['nomeProduto'];
                            $valorProduto = $registro['valorProduto'];
                            $dataPedido   = $registro['dataPedido'];
                            $diaPedido    = substr($dataPedido, 8, 2);
                            $mesPedido    = substr($dataPedido, 5, 2);
                            $anoPedido    = substr($dataPedido, 0, 4);
                            $horaPedido   = $registro['horaPedido'];
                            $statusPedido = $registro['statusPedido'];

                            echo "
                                <tr>
                                    <td>$idPedido</td>";
                                    if($_SESSION['tipoUsuario'] == "administrador"){
                                        echo "<td>$nomeUsuario</td>";
                                    }
                                    echo "
                                    <td><img src='$fotoProduto' width='30' title='Foto de $nomeProduto'></td>
                                    <td>$nomeProduto</td>
                                    <td>$valorProduto</td>
                                    <td>$diaPedido/$mesPedido/$anoPedido</td>
                                    <td>$horaPedido</td>
                                    <td>$statusPedido</td>";
                                    if($_SESSION['tipoUsuario'] == "administrador"){
                                        echo "
                                            <td>
                                                <a href='#' class='btn btn-primary btn-sm' title='Atualizar Status do Pedido'>
                                                    Atualizar Status
                                                </a>
                                            </td>
                                        ";
                                    }
                                echo "</tr>
                            ";
                        }
                        echo "</tbody>";
                    echo "</table>";
                    }
                    else{
                        echo "<div class='alert alert-info text-center'>Você ainda <b>não possui</b> pedidos!</div>";
                    }
    }
?>

<?php include "footer.php" ?>