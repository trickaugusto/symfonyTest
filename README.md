# Atividade em symfony

Objetivo:
Desafio: Desenvolver uma API RESTful,com envio e retorno de informações no formato JSON, e banco de dados para um e-commerce qualquer contendo rotas para as funcionalidades abaixo.
     
1. Produtos: Criar,editar e inativar os produtos da loja. Também deve ser possível listá-los, sejam eles ativos ou inativos, retornando as informações ID, descrição,valor e status do produto.
2. Usuário: Criar,editar e inativar os usuários da API.Também deve ser possível listá-los, sejam eles ativos ou inativos,retornando as informações ID, nome,  e-mail e status do usuário.
3. Pedido: Criar, editar e inativar os pedidos da loja. Também deve ser possível listá-los sejam eles ativos, inativos, pagos e não pagos retornando as informações ID,número do pedido, status do pedido, produto, descrição do produto e usuário comprador.

# Rotas:

## Produtos
/products -> GET:
Lista todos os produtos (id, description, price, status, createdAt e updatedAt);

/product/{id} -> GET:
Lista um id em específico (id, description, price, status, createdAt e updatedAt);

/product -> POST:
Cria um novo produto, esperando como request:
```javascript
{
	"status": "Inativo",
	"price": 10.00,
	"description": "terceiro"
}
```

/product/{id} -> PATCH:
Edita um produto existente, esperando como request:
```javascript
{
	"status": "Ativo",
	"price": 10.00,
	"description": "terceiro"
}
```

## Usuario
/users -> GET:
Lista todos os usuarios cadastrados (id, name, email, status, createdAt e updatedAt);

/user/{id} -> GET:
Lista um id em específico (id, name, email, status, createdAt e updatedAt);

/user -> POST:
Cria um novo usuario, esperando como request:
```javascript
{
	"name": "Jão",
	"email": "teste@gmail.com",
	"status": "ativo"
}
```

/user{id} -> PATCH:
Edita um usuario existente, esperando como request:
```javascript
{
	"name": "Jão",
	"email": "teste@gmail.com",
	"status": "inativo"
}
```

## Pedido
/orders -> GET:
Lista todos os pedidos cadastrados (id, orderNumber, status, productId, productDescription, userId, createdAt e updatedAt);

/order/{id} -> GET:
Lista um id em específico

/order -> POST:
Cria um novo pedido, esperando como request:
```javascript
{
    "status": "inativo",
    "productId": "4",
    "userId": "5"
}
```

/order{id} -> PATCH:
Edita um pedido existente, esperando como request:
```javascript
{
    "status": "ativo",
    "productId": "4",
    "userId": "5"
}
```

# Rodando localmente

Clonando o projeto:
```bash
git clone git@github.com:trickaugusto/symfonyTest.git
```

Vá para o diretório:
```bash
cd symfonyTest
```

Instalando as dependências:
```bash
composer install
```

Criando a tabela:
```bash
bin/console doctrine:database:create
```

Criando as migrations:
```bash
php bin/console make:migration
```

```bash
php bin/console doctrine:migrations:migrate
```

Rodando o projeto
```bash
php -S 127.0.0.1:8080 -t public/
```

Agora só abrir um insomnia da vida e ser feliz!

# Diagrama de classes:
[UML](https://github.com/trickaugusto/symfonyTest/blob/master/UML%20Diagram.png)