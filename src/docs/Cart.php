<?php

require("./src/docs/Product.php");

class Cart
{
    private array $cartItems = [];
    private float $total = 0.0;
    private ?string $coupon = null;

    private array $coupons = [
        "DESCONTO10" => 10,
        "DESCONTO20" => 20,
        "DESCONTO30" => 30
    ];

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
        if (isset($this->coupons[$coupon])) {
            $this->coupon = $coupon;
            return "Cupom aplicado: {$coupon} - {$this->coupons[$coupon]}% de desconto.";
        }
        return "Cupom inválido.";
    }

    public function calculateTotal(): float
    {
        $total = $this->total;

        if ($this->coupon) {
            $desconto = $this->coupons[$this->coupon];
            $total = $total - ($total * $desconto / 100);
        }

        return $total;
    }

    public function listItems(): array
    {
        return [
            "ItensCarrinho" => $this->cartItems,
            "Total" => $this->calculateTotal(),
            "Cupom" => $this->coupon
        ];
    }
}
