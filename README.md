![Logo OW Interactive](https://github.com/owInteractive/desafio-backend/raw/master/media/logo.jpg "OW Interactive")


# Desafio Back-End - OW Interactive 20/21 by Juan Garcia

## Recursos utilizados para testar a API
1.  XAMPP.
2.  INSOMNIA.
3. COMPOSER.

## Instalando o projeto
O projeto a seguir que encontra-se dentro de desafio_ruan/example-app,  foi desenvolvido em ambiente XAMPP com PHP 7.4 e LARAVEL 8, o mesmo foi instalado e executado com composer, por isso será necessario a instalação do composer juntamente ao XAMPP para executá-lo.

## Procedimentos de start da Aplicação
- Após instalar o XAMPP e o Composer navegue até a pagina do projeto.
- Importe o arquivo banco.sql no seu phpmyadmin.
- No arquivo .env confira se as conexões de banco condizem com seu ambiente.
- No insomnia importe o arquivo de configuração ("insomnia-configs.json") do workspace a ser usado para testar a api .
- Volte até a raiz do projeto e rode o comando `php artisan serve`

## Rotas
- USERS/GET - /users - retorna todos os usuários.
- USERS/CREATE - /users/create - cria um novo usuário
- USERS/EDIT - /users/edit/id - edita as informações do usuário
- USERS/DELETE - /users/delete/id - exclui um usuário
- USERS/ALTER_VALUE - /users/alter_value/id - altera o valor inicial do usuário passando seu id como parâmetro.
- USERS/TOTAL - /users/total/id - pega o saldo atual do usuário
--------------------------------------------------------------------------------------------------
- OPERATIONS/ADD OPERATION - /operations/user/id - adiciona uma nova operação atribuida aquele usuário, os tipos de operação são: "DEBIT","CREDIT","REFUND".
- OPERATIONS/GET ALL OPERATIONS - /operations/all - Pega todas as operações de todos os usuários, trazendo os dados do usuário junto.
- OPERATIONS/DELETE OPERATION - /operations/delete/id - Delete a operação pelo id da mesma.
- OPERATIONS/EXPORT CSV - /operations/csv/id_user/type - Devolve um arquivo csv daquele usuário com cabeçalho com os dados do usuário. Onde os tipos de filtros são:
type = 1('Todas as operações'); 2('Ultimos 30 dias'); 3('Filtros por mês e ano').

OBS: Todas as rotas possuem verificação de existência de usuário e de operação.

Vlw Galera...

[![Programadores rindo](https://i0.wp.com/media1.tenor.com/images/14623938aaa95cce97cc66b45ae55b51/tenor.gif?resize=270%2C270&ssl=1 "Programadores rindo")](http://https://i0.wp.com/media1.tenor.com/images/14623938aaa95cce97cc66b45ae55b51/tenor.gif?resize=270%2C270&ssl=1 "Programadores rindo")



