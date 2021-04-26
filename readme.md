CRUD PHP
=============

Página web com CRUD de médicos

 - Para realizar o bakend projeto foi utilizado o PHP seguindo 
 os padrões MVC.

 - A linguagem utilizada para a manipulação do banco de dados foi SQL,
 as instruções para a execução do mesmo estarão abaixo.

## Executando o Projeto

 - Crie o arquivo .env com as seguintes informações:
 
```
 DB_HOST=
 DB_USER=
 DB_PASS=
 DB_DATABASE=
 DB_PORT=
```
 - Em seguida execute:

```bash
composer install
```

 - Após a instalação do composer dentro de /App inicie a aplicação: 

```bash
php -S localhost:8080 -t public
```
 - Ou abra o arquivo index.php dentro de App/public

 - Na raiz do projeto é possivel encontrar a pasta SQLScripts, nela contên o arquivo
 db_master.sql contêndo o sql do banco de dados.







