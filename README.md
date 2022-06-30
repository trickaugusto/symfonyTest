# Atividade em symfony

Objetivo:
Desafio: Desenvolver uma API RESTful,com envio e retorno de informações no formato JSON, e banco de dados para um e-commerce qualquer contendo rotas para as funcionalidades abaixo.
     
1. Produtos: Criar,editar e inativar os produtos da loja. Também deve ser possível listá-los, sejam eles ativos ou inativos, retornando as informações ID, descrição,valor e status do produto.
2. Usuário: Criar,editar e inativar os usuários da API.Também deve ser possível listá-los, sejam eles ativos ou inativos,retornando as informações ID, nome,  e-mail e status do usuário.
3. Pedido: Criar, editar e inativar os pedidos da loja. Também deve ser possível listá-los sejam eles ativos, inativos, pagos e não pagos retornando as informações ID,número do pedido, status do pedido, produto, descrição do produto e usuário comprador.

# Rotas:

###### Produtos ######
/products -> get:
Lista os produtos (ID, descricao, valor e status do produto)

/product/{id}:
Lista um id em específico

/product -> post:
Cria um novo produto, esperando como request:
{
	"status": "Inativo",
	"price": 10.00,
	"description": "terceiro"
}

/product/{id} -> patch:
Edita um produto existente, esperando como request:
{
	"status": "Inativo",
	"price": 10.00,
	"description": "terceiro"
}

###### Usuario ######
/users -> get:
Lista todos os usuarios cadastrados (id, nome, email, status do usuario)

/user/{id}:
Lista um id em específico

/user -> post:
Cria um novo usuario, esperando como request:
{
	"name": "Jão",
	"email": "teste@gmail.com",
	"status": "ativo"
}

/user{id} -> patch:
Edita um usuario existente, esperando como request:
{
	"name": "Jão",
	"email": "teste@gmail.com",
	"status": "inativo"
}


###### Pedido ######
/orders -> get:
Lista todos os pedidos cadastrados (ID, numero do pedido, status do pedido, produto, descrição do produto, e usuario comprador)

/order/{id}:
Lista um id em específico

/order -> post:
Cria um novo pedido, esperando como parâmetro ID, numero do pedido, status do pedido, produto, descricao do produto e usuario comprador.

/order -> patch:
Edita um pedido existente, esperando com parâmetro ID, numero do pedido, status do pedido, produto, descricao do produto e usuario comprador.

# Banco de dados

Criadas via migrations:

'php bin/console make:migration'
'php bin/console doctrine:migrations:migrate'

# Rodando o projeto
Basicamente, depois de ter criado as tabelas localmente, só rodar
'php -S 127.0.0.1:8080 -t public/'