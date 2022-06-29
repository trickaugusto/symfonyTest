# Repositório criado para um teste em symfony

Objetivo:
Desafio: Desenvolver uma API RESTful,com envio e retorno de informações no formato JSON, e banco de dados para um e-commerce qualquer contendo rotas para as funcionalidades abaixo.
     
1. Produtos: Criar,editar e inativar os produtos da loja. Também deve ser possível listá-los, sejam eles ativos ou inativos, retornando as informações ID, descrição,valor e status do produto.
2. Usuário: Criar,editar e inativar os usuários da API.Também deve ser possível listá-los, sejam eles ativos ou inativos,retornando as informações ID, nome,  e-mail e status do usuário.
3. Pedido: Criar, editar e inativar os pedidos da loja. Também deve ser possível listá-los sejam eles ativos, inativos, pagos e não pagos retornando as informações ID,número do pedido, status do pedido, produto, descrição do produto e usuário comprador.

Diferencial(não obrigatório): Será considerado um diferencial, se você implementar as seguintes funcionalidades e validações:

Login:Criar uma rota de autenticação com usuárioesenha,editar permissões de acesso do usuário as rotas da API(produtos,usuárioepedido)evalidar seousuário tem acesso as
rotas.  

# Passo 1: Listando as rotas:
/produtos -> get:
Lista os produtos (ID, descricao, valor e status do produto)

/produtos -> post:
Cria um novo produto, esperando como parâmetro 