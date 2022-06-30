# Repositório criado para um teste em symfony

Objetivo:
Desafio: Desenvolver uma API RESTful,com envio e retorno de informações no formato JSON, e banco de dados para um e-commerce qualquer contendo rotas para as funcionalidades abaixo.
     
1. Produtos: Criar,editar e inativar os produtos da loja. Também deve ser possível listá-los, sejam eles ativos ou inativos, retornando as informações ID, descrição,valor e status do produto.
2. Usuário: Criar,editar e inativar os usuários da API.Também deve ser possível listá-los, sejam eles ativos ou inativos,retornando as informações ID, nome,  e-mail e status do usuário.
3. Pedido: Criar, editar e inativar os pedidos da loja. Também deve ser possível listá-los sejam eles ativos, inativos, pagos e não pagos retornando as informações ID,número do pedido, status do pedido, produto, descrição do produto e usuário comprador.

Diferencial (não obrigatório): Será considerado um diferencial, se você implementar as seguintes funcionalidades e validações:
Login: Criar uma rota de autenticação com usuário e senha, editar permissões de acesso do usuário as rotas da API(produtos, usuário e pedido) e validar se o usuário tem acesso as rotas.  

# Passo 1: Listando as rotas:

###### Produtos ######
/product -> get:
Lista os produtos (ID, descricao, valor e status do produto)

/product/{id}:
Lista um id em específico

/product -> post:
Cria um novo produto, esperando como parâmetro (ID (provavelmente autoincrement?), descricao, valor, status do produto)

/product -> patch:
Edita um produto existente, esperando como parâmetro (ID, descricao, valor, status do produto), mesma rota pra inativar ou ativar

###### Usuario ######
/usuario -> get:
Lista todos os usuarios cadastrados (id, nome, email, status do usuario)

/usuario/{id}:
Lista um id em específico

/usuario -> post:
Cria um novo usuario, esperando como parâmetro ID, nome, email e status do usuario

/usuario -> patch:
Edita um usuario existente, esperando como parametro ID, nome, email e status do usuario, mesma roda pra inativar ou ativar


###### Pedido ######
/pedidos -> get:
Lista todos os pedidos cadastrados (ID, numero do pedido, status do pedido, produto, descrição do produto, e usuario comprador)

/pedidos/{id}:
Lista um id em específico

/pedidos -> post:
Cria um novo pedido, esperando como parâmetro ID, numero do pedido, status do pedido, produto, descricao do produto e usuario comprador.

/pedidos -> patch:
Edita um pedido existente, esperando com parâmetro ID, numero do pedido, status do pedido, produto, descricao do produto e usuario comprador.

# Passo 2: Banco de dados

###### Produto ######
ID -> auto increment
descricao -> varchar
valor -> float
status do produto -> bool

Criando a tabela product
'CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, status VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;'

###### Usuario ######
ID -> auto increment
nome -> varchar
email -> varchar
status do cliente -> bool

###### Pedido ######
ID -> auto increment
numero do pedido -> int
status do pedido -> bool
produto -> varchar
descricao do produto -> varchar
usuario comprador -> varchar



# Links de apoio 
https://blog.codeexpertslearning.com.br/symfony-4-trabalhando-com-banco-de-dados-6a093adac9da

