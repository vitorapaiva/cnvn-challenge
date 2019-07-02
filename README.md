# Teste Convenia
Neste teste você deve criar uma aplicação em que empresas possam gerir seus fornecedores e suas respectivas mensalidades. Para isso serão necessárias as seguintes as seguintes funcionalidades.

## Cadastro de usuários e empresas
Para utilizar a API o usuário deve estar cadastrado e autenticado no sistema. Você pode escolher tratar a empresa como usuário ou separar usuário de empresa, contudo é importante que o usuário cadastre uma senha e um e-mail no sistema. Também é necessário que se registre as seguintes informações da empresa:
- Nome 
- Telefone 
- Endereço 
- CEP 
- CNPJ

## Cadastro de fornecedores
Uma vez autenticado, o usuário/empresa poderá cadastrar, listar e deletar os seus fornecedores. Cada fornecedor deverá ter:
- Nome 
- E-mail 
- Mensalidade

## Ativação de fornecedores
Após o usuário cadastrar um fornecedor, o sistema deve enviar um e-mail para o mesmo, neste e-mail existirá um link de ativação do fornecedor.

## Total de mensalidades
Deve-se ter um endpoint em que um usuário pode verificar o custo total resultante da soma de todas as mensalidades dos fornecedores da empresa.

## Pontos obrigatórios
Os pontos abaixo devem ser obrigatoriamente contemplados no teste.
- Usar o framework Laravel
- Testes: sua aplicação deve conter testes, como você os faz fica a seu critério.
- Validação de input: todos os endpoints de criação e edição devem conter validações dos dados do input. 
- Job: Deve-se utilizar alguma forma de Job 
- Relacionamentos: deve-se utilizar algum forma de relacionamentos entre tabelas 
- Autenticação 
- Proteção de dados: usuários/diferentes empresas não devem poder acessar dados de outras empresas nem de fornecedores que não sejam os seus. 
- Cache: todas as chamadas ao banco de dados devem ser cacheadas. 

## Bônus 
Os pontos abaixo são bônus:
- SOLID 
- Design Patterns 
- Event Driven 
- GraphQL 
- OAuth2 ou JWT 
- Utilizar o ambiente em Docker
Divirta-se, seja criativo e sinta-se à vontade para tirar dúvidas.

----------------------------------------------------------------------------------------------------------

# Solução

## Para levantar projeto

* git clone https://github.com/vitorapaiva/cnvn-challenge
* composer install
* Criar arquivo .env
* php artisan key:generate
* php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
* php artisan jwt:secret
* Configurar informações de seu banco de dados no seu .env
* php artisan migrate
* php artisan serve

## Cadastro de usuários e empresas
* POST | api/auth/register

### Campos
* 'company_name'=>'required'
* 'company_email'=>'required|email|max:255|unique:company'
* 'company_phone'=>'required'
* 'company_cep'=>'required'
* 'company_tax_id'=>'required'
* 'email' => 'required|email|max:255|unique:users'
* 'name' => 'required|max:255'
* 'password' => 'required|min:8|confirmed'

## Autenticacao de usuários e empresas
* POST | api/auth/authenticate

### Campos
* 'email' => 'required|email'
* 'password'=> 'required'

## Cadastro de fornecedores
* POST | api/supplier/

### Campos
* 'suppliers_name' => 'required'
* 'suppliers_email' => 'required'
* 'suppliers_fee' => 'required'

## Edicao de fornecedores
* PUT | supplier/{supplier_id}

## Remocao de fornecedores
* DELETE | supplier/{supplier_id}




