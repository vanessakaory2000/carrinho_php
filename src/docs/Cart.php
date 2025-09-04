<?php

require("./src/docs/Product.php");

class Cart
{
    private array $cartItems = [];
    private float $total = 0.0;
    private ?string $coupon = null;

    public function addProduct(Product $product, int $quantity): string
    {
        if ($product->getStock() < $quantity) {
            return "Estoque insuficiente para {$product->getName()}.";
        }

        $subtotal = $product->getPrice() * $quantity;
        $product->reduceStock($quantity);

        foreach ($this->cartItems as &$item) {
            if ($item['id_produto'] === $product->getId()) {
                $item['quantidade'] += $quantity;
                $item['subtotal'] += $subtotal;
                $this->total += $subtotal;
                return "{$product->getName()} atualizado no carrinho.";
            }
        }

        $this->cartItems[] = [
            'id_produto' => $product->getId(),
            'nome' => $product->getName(),
            'quantidade' => $quantity,
            'subtotal' => $subtotal
        ];

        $this->total += $subtotal;
        return "{$product->getName()} adicionado ao carrinho.";
    }
}

$banana = new Product(1, "Banana", 2, 10);
$morango = new Product(2, "Morango", 8, 16);

$carrinho = new Cart();

$carrinho->addProduct($banana, 5);
$carrinho->addProduct($banana, 2);
$carrinho->addProduct($morango, 2);
