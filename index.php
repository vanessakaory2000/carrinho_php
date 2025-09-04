<?php

require("./src/docs/Cart.php");

$banana = new Product(1, "Banana", 2.0, 10);
$morango = new Product(2, "Morango", 8.0, 5);
$uva = new Product(3, "Uva", 5.0, 3);

$carrinho = new Cart();

$carrinho->addProduct($banana, 2);
$carrinho->addProduct($banana, 1);
$carrinho->addProduct($morango, 1);
$carrinho->addProduct($uva, 2);
$carrinho->removeProduct($uva);

$carrinho->applyCoupon("DESCONTO10");

$itens = $carrinho->listItems();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de Compras</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <h1>Carrinho de Compras</h1>
    <table>
        <thead>
            <tr>
                <th>ID Produto</th>
                <th>Nome</th>
                <th>Quantidade</th>
                <th>Subtotal (R$)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($itens["ItensCarrinho"] as $item): ?>
                <tr>
                    <td><?= $item['id_produto'] ?></td>
                    <td><?= $item['nome'] ?></td>
                    <td><?= $item['quantidade'] ?></td>
                    <td><?= number_format($item['subtotal'], 2, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3" class="total">Total</td>
                <td class="total">R$ <?= number_format($itens["Total"], 2, ',', '.') ?></td>
            </tr>
        </tbody>
    </table>
</body>

</html>