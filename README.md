<h1 align="center"!>Alura Challenge Back-End 4</h1>

<p align="center">
<img src="http://img.shields.io/static/v1?label=STATUS&message=BETA&color=GREEN&style=for-the-badge"/>
</p>

O projeto retrara uma API REST de controle financeiro proposto pelo Challenge Back-End 4 da Arula. O sistema possui as seguintes funcionalidade :

- CRUD de despesas.
- CRUD de despesas.
- Diferenciação de despesas por categoria.
- CRUD de usuário.
- Sistema de autenticação utilizando JWT.
- Relatorio de resumo de operações do mês, com os seguintes dados(Valor total das receitas no mês; Valor total das despesas no mês; Saldo final no mês; Valor total gasto no mês em cada uma das categorias) .
- Decumentação da API feita com o swagger.


## Pré-requisito
- Git
- Docker
- Docker-compose

## Tecnologias utilizadas

- ``PHP 8``
- ``Symfony 6``
- ``JWT``
- ``swagger``
- ``PostgresSql``
- ``API REST``

## Instalação
Baixar o projeto no github.
~~~
git clone https://github.com/henrique-r-luz/transacoes_alura_challenge_backend3.git
~~~ 
Após a conclusão do download entre na pasta transacoes_alura_challenge_backend3 e execute o comando abaixo.
Esse processo pode levar alguns minutos porque o docker irá criar e configurar
cada container. 
~~~
sudo docker-compose up
~~~ 
Com os contêineres ligados, acesse o app com o seguinte comando:
~~~
docker exec -it <nome do container app criado no seu sistema> bash
~~~
Execute o compose para instalar as dependências
~~~
composer install
~~~
Execute o Migrate para configurar a base de dados 
~~~
bin/console doctrine:migrations:migrate
