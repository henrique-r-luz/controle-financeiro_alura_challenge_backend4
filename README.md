<h1 align="center"!>Alura Challenge Back-End 4</h1>

<p align="center">
<img src="http://img.shields.io/static/v1?label=STATUS&message=BETA&color=GREEN&style=for-the-badge"/>
</p>

O projeto retrata uma API REST de controle financeiro proposto pelo Challenge Back-End 4 da Arula. O sistema possui as seguintes funcionalidade :

- CRUD de despesas.
- CRUD de despesas.
- Diferenciação de despesas por categoria.
- CRUD de usuário.
- Valida json de entrada através de schema.
- Sistema de autenticação utilizando JWT.
- Relatório de resumo de operações do mês, com os seguintes dados(Valor total das receitas no mês; Valor total das despesas no mês; Saldo final no mês; Valor total gasto no mês em cada uma das categorias) .
- Documentação da API feita com o swagger.


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
git clone https://github.com/henrique-r-luz/controle-financeiro_alura_challenge_backend4.git
~~~ 
Após a conclusão do download entre na pasta controle-financeiro_alura_challenge_backend4 e execute o comando abaixo.
Esse processo pode levar alguns minutos porque o docker irá criar e configurar
cada container. 
~~~
sudo docker-compose up
~~~ 
Com os contêineres ligados, acesse o app com o seguinte comando:
~~~
docker exec -it <nome do container app criado no seu sistema> bash
~~~
Executa o compose para instalar as dependências
~~~
composer install
~~~
Execute o Migrate para configurar a base de dados 
~~~
bin/console doctrine:migrations:migrate
~~~
É necessário criar as chaves RSA para o token JWT, para isso execute o seguinte comando:
~~~
bin/console lexik:jwt:generate-keypair
~~~
Para visualizar a documentação da API acesse:
~~~
localhost:81/api/doc
~~~

![Captura de tela de 2022-11-14 18-14-30](https://user-images.githubusercontent.com/12544898/201766884-8f00f31d-7eba-4185-aaa7-60813a4534e8.png)

## Autor

 [<img src="https://user-images.githubusercontent.com/12544898/174133076-fc3467c3-3908-436f-af3d-2635e4312180.png" width=115><br><sub>Henrique Rodrigues Luz</sub>](https://github.com/henrique-r-luz) 

