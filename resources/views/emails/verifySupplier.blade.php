<!DOCTYPE html>
<html>
  <head>
    <title>Verificação de Email</title>
  </head>
  <body>
    <h2>Voce foi cadastro como fornecedor {{$supplier->suppliers_name}} da empresa {{$supplier->company->company_name}}.</h2>
    <br/>
    Seu email registrado foi {{$supplier->suppliers_email}}. <br>
    Caso este seja um email esperado, favor clicar no link abaixo para confirmar seu cadastro.
    <br/>
    <a href="{{url('supplier/verify', $supplier->verifySupplier->token)}}">Verificar email</a>
  </body>
</html>