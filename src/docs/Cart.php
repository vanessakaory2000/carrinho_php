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

    public function removeProduct(Product $product): string
    {
        foreach ($this->cartItems as $index => $item) {
            if ($item['id_produto'] === $product->getId()) {
                $product->increaseStock($item['quantidade']);
                $this->total -= $item['subtotal'];
                unset($this->cartItems[$index]);
                $this->cartItems = array_values($this->cartItems);
                return "{$product->getName()} removido do carrinho.";
            }
        }
        return "Produto não encontrado no carrinho.";
    }

    public function applyCoupon(string $coupon): string
    {
        if ($coupon === "DESCONTO10") {
            $this->coupon = $coupon;
            return "Cupom aplicado: 10% de desconto.";
        }
        return "Cupom inválido.";
    }

    public function calculateTotal(): float
    {
        $total = $this->total;
        if ($this->coupon === "DESCONTO10") {
            $total *= 0.9;
        }
        return $total;
    }

    public function listItems(): array
    {
        return [
            "ItensCarrinho" => $this->cartItems,
            "Total" => $this->calculateTotal()
        ];
    }
}
