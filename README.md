# Carrinho de Compras em PHP

## Integrantes

- **Estevão Alves dos Santos** – RA: 1990000
- **Vanessa Kaori Kurauchi** – RA: 2002344

---

## 📌 Instruções de execução

1. Instale o **XAMPP** (Apache + PHP).
2. Coloque o projeto na pasta `htdocs` do XAMPP.  
   Exemplo:
3. Inicie o Apache no painel do XAMPP.
4. Acesse no navegador:  
   👉 [http://localhost/carrinho_php](http://localhost/carrinho_php)

---

## ⚙️ Funcionalidades Implementadas

- Cadastro de produtos no sistema.
- Adição de produtos ao carrinho.
- Remoção de produtos do carrinho.
- Cálculo automático de subtotal e total.
- Validação de estoque antes da compra.
- Exibição do carrinho em formato de tabela.
- Retornos de mensagens de operação em português.

---

## 📖 Regras de Negócio

- Não é permitido adicionar quantidade maior que o estoque disponível.
- O estoque do produto é atualizado automaticamente quando o item é adicionado ou removido do carrinho.
- Cada produto pode aparecer no carrinho apenas uma vez (quantidade acumulada).
- O carrinho retorna mensagens de feedback.

---

## ⚠️ Limitações

- Os dados dos produtos não são persistidos em banco de dados, apenas em memória.
- O sistema não possui autenticação de usuários.
- O carrinho é reiniciado sempre que recarregar a página pois não tem sessão.
