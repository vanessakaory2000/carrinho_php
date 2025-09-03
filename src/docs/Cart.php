<?php

require("./src/docs/Product.php");

class Cart
{
    private array $cartItems = [];
    private array $products;
    private float $total = 0.0;
    private ?string $coupon = null;

    // private function itemExists(int $productId)
    // {
    //     foreach ($this->cartItems as $item) {
    //         if ($item["id_produto"] === $productId) {
    //             return $item;
    //         }
    //     }
    // }

    public function addProduct(Product $product, int $quantity)
    {
        if ($product->getStock() < $quantity) {
            return 'Estoque insuficiente.';
        }

        // $findedItem = $this->itemExists($product->getId());

        // if ($findedItem) {
        //     $product = $findedItem;
        // }

        $totalValue = $product->getPrice() * $quantity;

        $product->reduceStock($quantity);
        $this->cartItems[] = [
            'id_produto' => $product->getId(),
            'quantidade' => $quantity,
            'subtotal' => $totalValue
        ];

        $this->total += $totalValue;

        return 'Produto adicionado ao carrinho.';
    }

    public function returnTotal()
    {
        return ["ItemsCarrinho" => $this->cartItems, "PrecoTotal" => $this->total];
    }
}

$banana = new Product(1, "Banana", 2, 10);
$morango = new Product(2, "Morango", 8, 16);

$carrinho = new Cart();

$carrinho->addProduct($banana, 5);
$carrinho->addProduct($banana, 2);
$carrinho->addProduct($morango, 2);

print_r($carrinho->returnTotal());
