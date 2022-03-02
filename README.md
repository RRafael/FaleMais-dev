# FaleMais-dev

## Requisitos

Para executar o projeto, será necessário instalar os seguintes programas:

XAMPP (Apache + MariaDB + PHP) baixado em https://www.apachefriends.org/index.html que vem com Servidor Web Apache/2.4.52 (Win64), OpenSSL/1.1.1m, PHP/7.4.27 e Banco de Dados na Versão 10.4.22-MariaDB

Eclipse: Para desenvolvimento do projeto (Opcional)

DBeaver: Para desenvolvimento e administração de banco de dados (Opcional)

## Obtendo o Projeto

O projeto foi desenvolvido com o framewordk PHP Codeigniter 4

Para obter o projeto, é necessário clonar o projeto do GitHub num diretório de sua preferência:
https://github.com/RRafael/FaleMais-dev.git

## Construção do projeto e disponibilização para uso

Importe o banco de dados contido no arquivo falemais.sql localizado no diretório principal (raiz do projeto) em que contem os scripts sql necessários para construir a base de dados do projeto

A configuração para conectar-se com o banco de dados está contido no arquivo .env localizado no diretório principal (raiz do projeto) em que o nome do banco de dados é telzir com o usuário root e sem senha utilizando o drive MySQLi para conexão com o SGBD

database.default.hostname = localhost
database.default.database = telzir
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
database.default.DBPrefix = 

O CodeIgniter 4 vem com um servidor de desenvolvimento local e integrado. Você pode iniciá-lo com a seguinte linha de comando no diretório principal (raiz do projeto):

php spark serve 

O comando acima irá iniciar o servidor e agora você poderá visualizar o aplicativo em seu navegador em http://localhost:8080

## Testes

Foi utilizado o PHPUnit, que já vem com o Codeigniter, para os testes
Os tetes unitarios podem ser obtidos executando o seguinte comando no diretório principal (raiz do projeto)

 .\vendor\bin\phpunit tests/app/TestHomeTest.php

Serão executados 3 testes. Um que verifica se o controlador esta respondendo corretamente. O outro verifica se o tipo de dado de retorno é no formato json e o último verifica se o código de retorno HTTP é 200