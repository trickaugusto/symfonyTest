# Atividade em symfony

Objetivo:
Desafio: Desenvolver uma API RESTful,com envio e retorno de informações no formato JSON, e banco de dados para um e-commerce qualquer contendo rotas para as funcionalidades abaixo.
     
1. Produtos: Criar,editar e inativar os produtos da loja. Também deve ser possível listá-los, sejam eles ativos ou inativos, retornando as informações ID, descrição,valor e status do produto.
2. Usuário: Criar,editar e inativar os usuários da API.Também deve ser possível listá-los, sejam eles ativos ou inativos,retornando as informações ID, nome,  e-mail e status do usuário.
3. Pedido: Criar, editar e inativar os pedidos da loja. Também deve ser possível listá-los sejam eles ativos, inativos, pagos e não pagos retornando as informações ID,número do pedido, status do pedido, produto, descrição do produto e usuário comprador.

# Rotas:

### Produtos
/products -> GET:
Lista os produtos (ID, descricao, valor e status do produto)

/product/{id} -> GET:
Lista um id em específico

/product -> POST:
Cria um novo produto, esperando como request:
{
	"status": "Inativo",
	"price": 10.00,
	"description": "terceiro"
}

/product/{id} -> PATCH:
Edita um produto existente, esperando como request:
{
	"status": "Inativo",
	"price": 10.00,
	"description": "terceiro"
}

### Usuario
/users -> GET:
Lista todos os usuarios cadastrados (id, nome, email, status do usuario)

/user/{id} -> GET:
Lista um id em específico

/user -> POST:
Cria um novo usuario, esperando como request:
{
	"name": "Jão",
	"email": "teste@gmail.com",
	"status": "ativo"
}

/user{id} -> PATCH:
Edita um usuario existente, esperando como request:
{
	"name": "Jão",
	"email": "teste@gmail.com",
	"status": "inativo"
}


### Pedido
/orders -> GET:
Lista todos os pedidos cadastrados (ID, numero do pedido, status do pedido, produto, descrição do produto, e usuario comprador)

/order/{id} -> GET:
Lista um id em específico

/order -> POST:
Cria um novo pedido, esperando como request:
{
    "status": "inativo",
    "productId": "4",
    "userId": "5"
}

/order{id} -> PATCH:
Edita um pedido existente, esperando como request:
{
    "status": "inativo",
    "productId": "4",
    "userId": "5"
}

# Banco de dados

Criadas via migrations:

'php bin/console make:migration'
'php bin/console doctrine:migrations:migrate'

# Rodando o projeto
Basicamente, depois de ter criado as tabelas localmente, só rodar
'php -S 127.0.0.1:8080 -t public/'