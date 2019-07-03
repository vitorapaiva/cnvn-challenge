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
* Configurar informações do Redis no .env
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

Após a autenticacao, a api irá retornar o token. Este token deverá ser adicionado a cada requisicao como um header 'Authorization Bearer'

### Campos
* 'email' => 'required|email'
* 'password'=> 'required'

## Cadastro de fornecedores
* POST | api/supplier/add

### Campos
* 'suppliers_name' => 'required'
* 'suppliers_email' => 'required'
* 'suppliers_fee' => 'required'

## Edicao de fornecedores
* PUT | api/supplier/edit/{supplier_id}

## Remocao de fornecedores
* DELETE | api/supplier/delete/{supplier_id}

## Verificacao de email de fornecedores
* GET | supplier/verify/{token}

## Total de mensalidades
* GET | api/company/cost

## Pontos obrigatórios
Os pontos abaixo devem ser obrigatoriamente contemplados no teste.
- Usar o framework Laravel - Sistema feito com Laravel 5.8
- Testes: os testes se encontram dentro de tests/Feature.
- Validação de input: validacoes feitas com $request->validate(). 
- Job: Não implementado. Não consegui identificar aonde utilizar Job nesse cenário, aceito sugestões 
- Relacionamentos: as classes Model foram construidas com seus relacionamentos. Um exemplo de uso é na verificação do Supplier (SupplierController.php, linha 63)
- Autenticação: autenticacao feita com pacote tymon/jwt-auth
- Proteção de dados: consultas sao feitas amarrando informações do usuario autenticado, evitando que informacoes de outra empresa sejam utilizadas. Exemplo: CompanyController.php, linha 25
- Cache: cache de dados foi feito utilizando Redis com o pacote watson/rememberable, mas requer mais testes 

## Bônus 
Os pontos abaixo são bônus:
- SOLID - tentou-se aplicar os principios SOLID no desenvolvimento desse sistema, como o single responsibility (aplicado, por exemplo, nas classes Controller), interface segregation (na criacao de interfaces distintas para os Repositories) e dependency inversion principle (na injeção de dependencia dos construtores dos Controllers)
- Design Patterns - alguns design patterns aplicados: injeção de dependencia e repository pattern
- Event Driven - implementação futura, aceito sugestões
- GraphQL - implementação futura, aceito sugestões
- OAuth2 ou JWT - foi utilizado JWT através do pacote tymon/jwt-auth
- Utilizar o ambiente em Docker - ambiente Docker disponivel em: https://github.com/vitorapaiva/docker



