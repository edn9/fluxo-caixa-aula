# Aula Laravel / PHP - Jan. 2020
Aula completa backend/frontend Laravel/PHP com SQL Server rodando em Linux/Windows.

## Sumário

<h3>

- [Introdução](#Introdução)
- [Como instalar](#Como-instalar)
- [Configurando](#Configurando)
- [Iniciando o Projeto 1/2](#Iniciando-o-Projeto-1/2)
- [Iniciando o Projeto 2/2](#Iniciando-o-Projeto-2/2)
</h3>

## Introdução
Antes de tudo, essa aula ira focar na parte de Windows, embora tambem funciona no sistema Linux Ubuntu tranquilo.

Primeiramente iremos baixar os programas necessarios:

- <a href="https://gitforwindows.org/" target="blank">Git Bash</a> (Excelente terminal para Windows)
- <a href="https://nodejs.org/en/" target="blank">Node</a> 12.14.1
- <a href="https://windows.php.net/download#php-7.2" target="blank">PHP 7.2</a><i>^</i>
- <a href="https://getcomposer.org/" target="blank">Composer</a> (Gerenciador de pacotes PHP)
- <a href="https://code.visualstudio.com/" target="blank">Visual Code Studio</a>
- SQLServer
- Para manipulação dos dados por fora, pode usar o proprio SQL Server Management Studio (estou usando o 18) ou <a href="https://dbeaver.io/" target="blank">DBeaver</a> (ferramenta de administração de banco de dados gratuita open-source)


## Como instalar

No geral todos são bem *"straight foward"*, apenas baixe e instale clicando em next e pronto, só lembrar de ao instalar o composer escolha o php 7.2.^.

Lembrando que ao instalar o composer, você precisara instalar o laravel como global no teu sistema, só seguir a documentação no proprio <a href="https://laravel.com/docs/6.x" target="blank">site</a>, mas no resumo seria assim:

`composer global require laravel/installer`

## Configurando

Continue abaixo ao terminar a instalação de todos.

Para baixar o resultado final do material, abra o terminal Git Bash com botão direito do mouse na pasta desejada (clicando em `Git Bash Here`), cole e execute apertando [enter] o comando abaixo:

`git clone https://github.com/edn9/fluxo-caixa-aula`

![img](https://i.imgur.com/NrHXArm.png)

*`Git Clone` é um comando responsavel por baixar repositorios do github, ou qualquer outro site similar que utiliza da mesma ferramenta, exemplo gitlab ou notabug, etc.*

Como o repositorio é um repositorio privado, apenas as pessoas com acesso poderam baixar este projeto, portanto quando ao pedir insira teu email e senha do github.

Ao clonar o repositorio, abra a pasta com o Visual Code Studio, logo em seguida clique em ``terminal`` e ``new terminal``:

![img](https://i.imgur.com/SJskwyt.png)

Aqui na seta vermelha clique em select default shell e escolha ``Git Bash``. Estaremos trocando o terminal para o git bash devido a sua facilidade e ferramentas extras que ajudam muito no decorrer do desenvolvimento.

![intro](https://i.imgur.com/woIoQVB.png)

Antes de instalar, verifique se tudo esta ok:

```
node -v
v12.14.1

npm -v
6.13.4

composer -v
Composer version 1.9.0 2019-08-02 20:55:32

php -v
PHP 7.2.18 (cli) (built: Apr 30 2019 23:32:39) ( ZTS MSVC15 (Visual C++ 2017) x64 )
```

Se todos os programas mostrarem suas respectivas versões, então esta pronto para instalar os pacotes. Lembrando que você precisa estar DENTRO da pasta que voce baixou para poder fazer estes comandos:

`composer install`

![composer instal](https://i.imgur.com/YgqRJlb.png)
<center>*Baixando pacotes php, etc...*</center>

`npm i`

![npm](https://i.imgur.com/Hklo66N.png)
<center>*Baixando pacotes js, etc...*</center>


`npm run dev`

![npm compile](https://i.imgur.com/6KmjfhS.png)
<center>*Compilando os pacotes js, etc...*</center>


E para rodar o site, primeiro copie o `.env.example` com nome `.env`:

![env](https://i.imgur.com/SZ1Syyr.png)

O arquivo ``.env`` é responsavel por boa parte da configuração do seu sistema, então coisas como smtp, database, informações do programa/site, configurações de porta em geral vão aqui e na pasta ``config/``, mas por enquanto vamos só alterar alguns campos dele para conectar ao sqlserver.

*Para mais informações do ``.env`` <a href="https://laravel.com/docs/6.x/configuration" target="blank">clique aqui</a>.*

Aqui um exemplo de como fica o `.env`, no geral eu só configurei a conexão pro banco de dados mesmo:

![env](https://i.imgur.com/Xv5aPbD.png)

Antes de iniciar a chave, por medida de segurança é necessario criar uma chave padrão de criptografia, para criar a chave:

`php artisan key:generate`

*Para saber mais sobre o comando configura a documentação 'Application Key' clicando <a href="https://laravel.com/docs/6.x/installation#configuration" target="blank">aqui</a> .*

Por fim, você agora pode rodar este comando que serve para alimentar o seu banco de dados. No laravel é possivel automatizar a criação de tabelas usando o eloquent, uma ferramenta muito poderosa que, quando usada, é capaz de funcionar com qualquer linguagem de banco de dados, podendo assim você trocar sua linguagem de sqlserver pra mysql ou mariadb sem ter que refazer todas as suas tabelas.

*Lembrando que você precisa ter criado o banco de dados antes, ex: `DB_DATABASE=fluxoCaixa`*

```sql
CREATE DATABASE fluxoCaixa
```

`php artisan migrate:refresh --seed`

 - Migrate: Roda a migração, criando as tabelas.
 - Refresh: Caso as tabelas já tenha criado, atualiza novamente caso alguma tenha tido alteração.
 - Seed: No Laravel tambem é possivel alimentar suas tabelas e criar diversos "seeders", que seriam metodos de automatizar o processo de testes/criação de dados sem a necessidade de ficar recriando do zero tudo de novo.

Possiveis errors:

` Illuminate\Database\QueryException  : could not find driver (SQL: select * from sysobjects where type = 'U' and name = migrations)`

Isso acontece porque, pelo fato de você esta usando outra linguagem para seu banco de dados, sera necessario a instalação dos drivers especificos para o funcionamento do mesmo. (Isso em ambos sistemas Windows/Linux)

![sqlserver error](https://i.imgur.com/kQ8VxZN.png)

Como estamos usando o PHP 7.2 nts, precisamos dos drives de acordo a nossa versão, <a href="https://docs.microsoft.com/en-us/sql/connect/php/system-requirements-for-the-php-sql-driver?view=sql-server-2017#driver-versions" target="blank">clique aqui</a> para ver a tabela que informando sobre.

![bd drivers](https://i.imgur.com/G8K2RoE.png)

``Yes`` and ``No`` na imagem fala se o drive é Thread Safe ou não, aqui uma pequena explicação sobre qual usar:

<h5>

```
What is the meaning of TS and NTS in PHP?
Thread Safe (TS) and Non-Thread Safe (TS) are the two different PHP builds available.

Thread-safety ensures that when the shared data structure is manipulated by different threads, it is free from race conditions. This version is recommended where the web server run multiple threads of execution simultaneously for different requests.

For example, in Apache server, if we use mod_php as worker MPM, thread-safe version should be used.

Non-thread-safe version on the other hand is used where PHP is installed as a CGI binary. Here every request is handled separately which removes the need of thread-safe version. Moreover, using thread-safe version here degrade the performance due to unnecessary checks for thread safety. Servers like IIS & NGINX do not need thread safe versions.
```
<a href="https://www.quora.com/What-is-the-meaning-of-TS-and-NTS-in-PHP" target="blank">Fonte</a>, acessado 30/01/2020 as 20:26.
</h5>

Como este é um projeto local apenas para estudos, vamos com o NTS. Como eu estou usando a ultima versão do sqlserver irei baixar o de 2019, mas existem outras versões para baixar tambem:

![sqlserver drivers download versions](https://i.imgur.com/MdwJk7d.png)

<a href="https://docs.microsoft.com/pt-br/sql/connect/php/download-drivers-php-sql-server?view=sql-server-ver15" target="blank">Clique aqui</a> para baixar os drivers. Baixe e extraia para a pasta de instalação do PHP 7.2, ex: `C:\wamp64\bin\php\php7.2.18\ext`

Geralmente já vem os dois tipos de drivers ts e nts. Por fim edita o arquivo php.ini localizado na pasta do wamp, ex: `wamp/bin/apache/apache2.x.y/bin/php.ini`

`extension=php_sqlsrv_72_nts_x64.dll`
`extension=php_pdo_sqlsrv_72_nts_x64.dll`

Por fim, reinicie teu Windows.
Ao reiniciar, teste se o drive esta funcionando, abra o teu projeto no VSCode, e rode o arquivo check.php com o comando:

`php check.php`

Se a resposta aparecer ``sqlsrv``:
```php
Array
(
    [0] => mysql
    [1] => sqlsrv
    [2] => sqlite
)
```

É porque deu tudo certo, por fim, você podera finalmente iniciar o servidor do projeto com o comando:

`php artisan serve`

---

## Iniciando o Projeto 1/2

Depois de tudo configurado, iremos começar um novo projeto, primeiro escolha um local para a instalação do projeto, abra o git bash e rode:

`laravel new blog`

Blog seria o nome do projeto, você pode escolher qualquer um. Agora vamos criar um `.env` do copiando do `.env.example`, por fim configurare para usar o teu banco de dados:

![configurando db](https://i.imgur.com/KtudD5o.png)

Agora iremos criar a chave:

`php artisan key:generate`

Alimentar o banco:

`php artisan migrate:refresh --seed`

Por fim, vamos fazer um crud bem simple usando as ferramentas do laravel, como migration, eloquent, etc. Mas antes vamos entender melhor a respeito da estrutura geral do laravel.

Como funciona? Irei dar uma pequena introdução de todas as pastas abaixo para um melhor entendimento do projeto:

![alt](https://i.imgur.com/ga8ZcCM.png)

## App

No app é aonde esta localizado o arquivos para controllers, middleware, authenticação e models.

## Config

No config fica as configurações gerais do projeto.

## Database

Configurações do banco de dados, factories seria para gerar dados aleatorios como forma de alimentação automatica para os migrations. Migrations é aonde fica os arquivos para criação das tabelas do seu database, seeders são arquivos responsaveis por alimentar as tabelas.

## Resources

Aqui é onde fica a parte de frontend, como paginas blade, js, sass e views, etc.

## Routes

Routes é onde fica localizado as rotas do nosso projeto, em `web.php` é onde são declarada as rotas http aonde iremos chamar a nossa pagina/funções.

---

## Iniciando o Projeto 2/2
Por fim, iremos dar inicio ao nosso projeto. Primeiro iremos criar uma view para visualização, criação, edição e exclusão dos dados.

Mas antes abra o site digitando:

`php artisan serve`

![alt](https://i.imgur.com/UuBAZac.png)

Depois de iniciar o comando, o laravel ira subir o site usando o proprio `php artisan` na url `http://127.0.0.1:8000/` (caso a porta 8000 já esteja em uso, ele ira automaticamente mudar para outra, no meu caso 8001):

![alt](https://i.imgur.com/NDuKTqg.png)

Esta pagina esta localizada na pasta `resources/views/welcome.blade.php`. O Laravel utiliza Blade Templates para facilitar o uso da linguagem php. É possivel tambem implementar facilmente vue.js, react ou jquery/javascript em geral. Caso queira saber mais <a href="https://laravel.com/docs/6.x/blade" target="blank">clique aqui</a>.

Vamos criar uma nova pagina para nossa view do crud e fazer um form bem simples contento algumas ações. Na pasta `resources/views` crie um arquivo chamado `list.blade.php`.

```html
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Crud List</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="/css/all.css" rel="stylesheet">

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #F8F9FA;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="card" style="width:800px;height:auto">
                <br>
                <div class="container">
                    <div class="row">
                        <div class="col-10">
                            <h2>
                                Crud
                            </h2>
                        </div>
                        <div class="col-2">
                            <button class="btn btn-primary">
                                <i class="fas fa-plus"></i>
                                Criar
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Idade</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>38</td>
                                    <td>
                                        <button class="btn btn-success">
                                            <i class="far fa-eye"></i>
                                            Visualizar
                                        </button>
                                        <button class="btn btn-warning">
                                            <i class="fas fa-pencil-alt"></i>
                                            Editar
                                        </button>
                                        <button class="btn btn-danger">
                                            <i class="fas fa-trash"></i>
                                            Excluir
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>

```

<i>Obs: O Laravel já vem com diversos comandos e ferramentas para facilitar na criação de varias coisas, seja autenticação, migrations, seeders, models, etc... Para saber mais: `php artisan list`.</i>

Decidi usar bootstrap e font-awesome apenas para deixar mais bonito o projeto.
Enfim, feito a pagina, vá em `routes/web.php` e defina a rota para a mesma:

```php
Route::get('/', function () {
    return view('list');
});
```

Como funciona o routes do laravel, quando o usuario entra no site `http://127.0.0.1:8000/`, ele chama a rota `/` com o metodo get, que chama uma função e retorna a view `list`. Existe difersas formas de usar as routes, da pra fazer middleware de autenticação, tipo, se o usuario logou, toda rota que ele acessar ira fazer uma verificação se ele pode ou não estar ali, etc.

Agora vamos fazer nossas funções para chamar cada ação dos botões acima. Eu geralmente já deixo pronto o controller e só vou editando conforme vou criando as rotas, funções, etc. Para fazer um novo controller vamos usar o php artisan:

`php artisan make:controller AdminController`

Isso criara um arquivo chamado `AdminController.php` na pasta `app/Http/Controllers`, lá que iremos fazer nossas funções.

Voltando ao arquivo `web.php`, vamos criar as seguintes rotas:

```php

Route::get('/criar', 'AdminController@criar');

Route::get('/editar', 'AdminController@editar');

Route::post('/editar-salvar', 'AdminController@editarSalvar');

Route::get('/excluir', 'AdminController@excluir');

```

Você pode tanto fazer uma função no routes como também num controller especifico. Por fim dentro do Admin controller iremos colocar:

```php
 public function criar()
    {
        return 'criar';
    }

    public function editar()
    {
        return 'editar';
    }

    public function editarSalvar()
    {
        return 'salvar edição';
    }

    public function excluir()
    {
        return 'excluir';
    }
```

Como saber se esta funcionando? Geralmente você pode ir direto na URL e digitar o caminho que você definiu, como por exemplo o `/criar` ficaria: `http://127.0.0.1:8000/criar`

Se você ver a mensagem "criar" significa que de tudo certo.

![alt](https://i.imgur.com/6YDYDx4.png)

Só que não é assim que iremos ter que chamar as funções, obviamente. Tem varios modos de chamar uma função, seja por form, button, a, ajax, etc. Vamos pelo mais basico, voltando na nossa pagina `list.blade.php` iremos adicionar ao botão criar a função e chamar atraves do metodo get:

```html
    <form action="/criar" method="get">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-plus"></i>
            Criar
        </button>
    </form>
```

No momento que o usuario clicar no botão criar, o botão ira chamar a função e retornar o comando programado, no caso iremos chamar uma nova pagina para criação de um novo contato. Primeiro copie e cole a pagina `list.blade.php` e renomeie para `create.blade.php`: 

```html
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Crud List</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="/css/all.css" rel="stylesheet">

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #F8F9FA;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="card" style="width:800px;height:auto">
                <br>
                <div class="container">
                    <div class="row">
                        <div class="col-10">
                            <h2>
                                Criar novo Usuario
                            </h2>
                        </div>
                        <div class="col-2">
                            <form action="/" method="get">
                                <button type="submit" class="btn btn-info">
                                    <i class="fas fa-arrow-left"></i>
                                    Voltar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>
```

Em `AdminController.php` na função criar iremos redirecionar para esta nova pagina:

```php
public function criar()
    {
        return view('create');
    }
```

![alt](https://i.imgur.com/BlDn3l5.png)

Agora vamos criar o form de registro do novo usuario:

```html

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Crud List</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="/css/all.css" rel="stylesheet">

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #F8F9FA;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="card" style="width:800px;height:auto">
                <br>
                <div class="container">
                    <div class="row">
                        <div class="col-sm">
                            <h2>
                                Criar novo Usuario
                            </h2>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form action="/salvar" method="post">
                        <div class="container">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="name">Nome</label>
                                        <input type="text" class="form-control" name="name" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="age">Idade</label>
                                        <input type="number" class="form-control" name="age" required>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="phone">Telefone</label>
                                        <input type="text" class="form-control" name="phone" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" required>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="address">Endereço</label>
                                        <input type="text" class="form-control" name="adress" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success float-right">
                            <i class="far fa-save"></i>
                            Enviar
                        </button>
                    </form>
                    <form action="/" method="get">
                        <button type="submit" class="btn btn-light float-left">
                            <i class="fas fa-arrow-left"></i>
                            Voltar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>

```

E declarar a nova rota/função:

`web.php`
```php
Route::post('/salvar', 'AdminController@salvar');
```

`AdminController.php`
```php
public function salvar(Request $request)
    {
        dd($request->all());
    }
```

Se tudo der certo, sua pagina estara mais ou menos assim:

![alt](https://i.imgur.com/n38F5Ls.png)

Agora tente realizar um cadastro e ver o que acontece... Em teoria deveria pegar todos os dados do input, e na função, com o `Request $request` retornar esses valores direto na pagina em branco. Mas ainda falta uma coisa.

Provavelmente você ira receber este erro:

`419 | Page Expired`

Por que isso acontece? Bom, o Laravel ao utilizar metodos post, é necessario por um token de verificação junto ao envio do form, este token é chamado <a href="https://laravel.com/docs/6.x/csrf" type="blank">CSRF Protection</a> e é atraves dele que é possivel fazer os envios com post, para implementar ele é bem simples, basta ir embaixo do form e colocar o @csrf:

```html
<form action="/salvar" method="post">
    @csrf
```

Ao clicar em enviar, o request ira pegar os inputs pelo name e retornara as seguintes informações:

![alt](https://i.imgur.com/VSX28Jw.png)

Agora vem a parte mais legal, que é o tratamento dessas informações e envio para o banco de dados. Geralmente existe diversas formas de realizar isso, seja pela linguagem do sqlsrv direto, seja por eloquent, tem formas de verificação se os dados são congruentes, se esta faltando algo, como tratar esses dados/erros, etc, etc, etc.

Bom, vamos por partes e pelo mais basico antes. Como estamos fazendo cadastro simples de um contato, precisamos primeiro criar a tabela no nosso banco laravel e depois um model para utilizarmos no tratamento destes dados.

Para fazer uma tabela, vamos usar o migration do Laravel mesmo com o seguinte comando:

`php artisan make:model Usuarios -m`

O que esse comando faz? Bom, este comando esta criando um model de Usuarios e um migration ao mesmo com a opção `-m` no final. Os dois arquivos estão localizados:

Migration: `database/migrations/2020_02_27_014029_create_usuarios_table.php`

Model: `app/Usuarios.php`

Vamos abrir primeiro o migration e inserir o que ele vai fazer:

```php
public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('age');
            $table->string('phone');
            $table->string('email');
            $table->string('address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
```

Dentro da função de `Schema::create` eu adicionei as colunas `name, age, phone, email, address`. Na função `up` o migration cria uma tabela chamada `Usuarios` com as seguintes colunas, o `timestamps` cria duas colunas `created_at` e `updated_at`, é meio que padrão do laravel mas não é obrigatorio, na função `down` ele ira apagar a tabela.

O migration cria as tabelas em ordem de data, então para projetos maiores, é bom ter atenção a este detalhe caso for usar chave estrangeira da qual precisa de uma tabela, caso a mesma não tenha sido criada antes ira dar problema.

Feito as mudanças, salve e rode o comando:

`php artisan migrate:refresh --seed`

Pronto, temos nossa tabela no banco de dados para enviarmos os dados.

![alt](https://i.imgur.com/8XZTYqU.png)
<i>Programa acima: <a href="https://dbeaver.io/" target="blank">DBeaver</a>.</i>

Agora com a tabela pronta iremos tratar os dados, fazer o model e enviar para a mesma. Primeiro vamos modificar nosso model `Usuarios.php`:

app/Usuarios.php
```php
    protected $table = 'usuarios';

    protected $fillable = [
        'name', 'age', 'phone', 'email', 'address', 'created_at', 'updated_at'
    ];
```

Protected $table é o nome da tabela da qual ira enviar os dados e $fillable são os dados aonde iremos puxar para adicionar os valores e assim enviar ao banco.

Voltando ao `AdminController.php`, iremos fazer as seguintes modificações:

AdminController.php
```php
public function salvar(Request $request)
    {
        //recebe os valores e verifica cada input, da pra deixar bastante estrito conforme o nivel dos dados a serem tratados
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'age' => 'required|numeric|max:100',
            'phone' => 'required|numeric|digits:11',
            'email' => 'required',
            'address' => 'required',
        ]);

        //ele criou a variavel validator e verificou, caso alguma tiver error, ele volta pra pagina anterior com o erro e os inputs
        if (($validator->fails())) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        /*Agora, caso todos os dados tiverem corretos, iremos salvar-los na sua respectiva tabela
        Aqui criamos um novo model Usuarios*/
        $usuario = new Usuarios;

        $usuario->name = $request->name;
        $usuario->age = $request->age;
        $usuario->phone = $request->phone;
        $usuario->email = $request->email;
        $usuario->address = $request->address;
        $usuario->created_at = date('Y-m-d H:i:s.v');
        $usuario->updated_at = date('Y-m-d H:i:s.v');

        $usuario->save();

        $msg = 'O cadastro de ' . $request->name . ' foi realizado com sucesso!';
        session()->flash('message', $msg);

        return redirect()->route('list');
    }
```

E por fim vamos atualizar nossa view:

create.blade.php
```html
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Crud List</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="/css/all.css" rel="stylesheet">

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #F8F9FA;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="card" style="width:800px;height:auto">
                <br>
                <div class="container">
                    <div class="row">
                        <div class="col-sm">
                            <h2>
                                Criar novo Usuario
                            </h2>
                        </div>
                    </div>
                </div>

                @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </div>
                @endif

                <div class="card-body">
                    <form action="/salvar" method="post">
                        @csrf
                        <div class="container">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="name">Nome</label>
                                        <input type="text" class="form-control" name="name" value="{{old('name')}}" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="age">Idade</label>
                                        <input type="number" class="form-control" name="age" value="{{old('age')}}" required>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="phone">Telefone</label>
                                        <input type="text" class="form-control" name="phone" value="{{old('phone')}}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" value="{{old('email')}}" required>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="address">Endereço</label>
                                        <input type="text" class="form-control" name="address" value="{{old('address')}}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success float-right">
                            <i class="far fa-save"></i>
                            Enviar
                        </button>
                    </form>
                    <form action="/" method="get">
                        <button type="submit" class="btn btn-light float-left">
                            <i class="fas fa-arrow-left"></i>
                            Voltar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>
```

list.blade.php na linha 92 insira
```html
@if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif
```

E web.php:
```php
Route::get('/', function () {
    return view('list');
})->name('list');
```

Demos um nome a nossa rota, assim, caso for usado a função `return redirect()->route('list')`, o route ira pegar a rota pelo nome.

Caso surgir o seguinte problema:

```
SQLSTATE[22007]: [Microsoft][ODBC Driver 17 for SQL Server][SQL Server]A conversão de um tipo de dados nvarchar em um tipo de dados datetime resultou em um valor fora do intervalo.
```

Você precisara setar a linguagem do teu banco de dados sqlsrv para inglês:

`EXEC sp_defaultlanguage 'sa', 'us_english'`

Se tudo der certo:

![alt](https://i.imgur.com/fr0lbKz.png)

Só que tem um problema, não esta listando os dados na view list certo? Para isso precisamos pegar os dados do banco e assim enviar para a view, portanto precisaremos editar o AdminController e a pagina list.blade.php.

web.php
```php
Route::get('/', function () {
    $usuarios = \DB::table('usuarios')->get();

    return view('list', compact('usuarios'));
})->name('list');
```
<i>OBS: Geralmente é bom criar as funções separadas dentro de um controller pois nem sempre vai ser possivel usar certas bibliotecas dentro do web.php.</i>

list.blade.php
```php
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Crud List</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="/css/all.css" rel="stylesheet">

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #F8F9FA;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="card" style="width:800px;height:auto">
                <br>
                <div class="container">
                    <div class="row">
                        <div class="col-10">
                            <h2>
                                Crud
                            </h2>
                        </div>
                        <div class="col-2">
                            <form action="/criar" method="get">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-plus"></i>
                                    Criar
                                </button>
                            </form>
                        </div>
                    </div>

                    @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                    @endif
                </div>

                <div class="card-body">
                    @if(count($usuarios)>0)
                    <form>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Idade</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($usuarios as $u)
                                <tr>
                                    <th scope="row">{{$u->id}}</th>
                                    <td>{{$u->name}}</td>
                                    <td>{{$u->age}}</td>
                                    <td>
                                        <button class="btn btn-success">
                                            <i class="far fa-eye"></i>
                                            Visualizar
                                        </button>
                                        <button class="btn btn-warning">
                                            <i class="fas fa-pencil-alt"></i>
                                            Editar
                                        </button>
                                        <button class="btn btn-danger">
                                            <i class="fas fa-trash"></i>
                                            Excluir
                                        </button>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </form>
                    @else
                    <h1>Sem contatos no momento...</h1>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>
```

Resultado:

![alt](https://i.imgur.com/iQToWJu.png)

Agora iremos terminar nosso crud finalizando as funções dos três botões acima.

Primeiro vamos com o excluir, pois o visualizar e editar precisara de mais etapas.

Para excluir é bem simples, iremos apenas pegar o id do contato e atraves da função no controller remover ele do banco.

list.blade.php linha 127
```php
<form action="/excluir{{$u->id}}" method="get">
    <button type="submit" class="btn btn-danger">
        <i class="fas fa-trash"></i>
        Excluir
    </button>
</form>
```

web.php
```php
Route::get('/excluir{id}', 'AdminController@excluir');
```

AdminController.php
```php
 public function excluir($id)
    {
        //Usa o model e procura pelo id
        $usuario = Usuarios::find($id);

        $usuario->delete();

        //deleta e retorna a home list
        return redirect('/')->with('message', 'Contato Excluido!');
    }
```
Resultado:

![alt](https://i.imgur.com/PC2xV56.png)

<i>*OBS: Geralmente, caso for usar um form dentro de outro form, é necessario usar ou modal ou via a, por que? Bem... Digamos que você tenha um formulario 1 com button type submit, mas dentro deste formulario 1 tem outros formularios(1,2,3) com button type submit tambem:

Errado</i>
```html
    <form action="/buscar-dados" method="get">
        <form action="/ver">
            <button type="submit"></button>
        </form>
        <form action="/editar">
            <button type="submit"></button>
        </form>
        <form action="/excluir">
            <button type="submit"></button>
        </form>

        <button type="submit"></button>
    </form>
```

<i>Caso você clique para ver ou editar, o button ira ativar o form buscar-dados e não os que você criou para. Entretanto existe diversas maneiras de resolver isso então fique tranquilo.</i>

Agora vamos visualizar e editar.

list.blade.php linha 118
```html
 <button type="button" class="btn btn-success" data-toggle="modal" data-target="#view{{$u->id}}">
       <i class="far fa-eye"></i>
       Visualizar
   </button>
   <!--Visualizar Modal-->
   <div class="modal fade" id="view{{$u->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel">Detalhes da Conta <b>#{{$u->id}}</b></h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <div class="modal-body">
                   <div class="container">
                       <div class="row">
                           <div class="col-4">
                               <i class="fas fa-user">
                                    <b>{{$u->name}}</b>
                               </i>
                           </div>
                           <div class="col-4">
                               <i class="fas fa-id-card">
                                    <b>{{$u->age}}</b>
                               </i>
                           </div>
                           <div class="col-4">
                               <i class="fas fa-mobile-alt">
                                    <b>{{$u->phone}}</b>
                               </i>
                           </div>
                       </div>
                       <br>
                       <div class="row">
                           <div class="col-6">
                               <i class="fas fa-envelope">
                                    <b>{{$u->email}}</b>
                               </i>
                           </div>
                           <div class="col-6">
                               <i class="fas fa-home">
                                    <b>{{$u->address}}</b>
                               </i>
                           </div>
                       </div>
                   </div>
                   <br>
                   <div class="row">
                       <div class="col-12">
                           <i class="fas fa-calendar-alt">
                               <b>{{$u->created_at}}</b> -
                               <b>{{$u->updated_at}}</b>
                           </i>
                       </div>
                   </div>
               </div>
               <div class="modal-footer">
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       Fechar
                   </button>
               </div>
           </div>
       </div>
   </div>
```

Por fim, editar:

Geralmente tem como re-aproveitar uma pagina de como cadastro para fazer diferentes coisas, neste caso editar, mas pra não confudir demais as coisas vamos criar uma nova especifica para isso, copie o arquivo `create.blade.php` e renomeio para `edit.blade.php`.

edit.blade.php
```html
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Crud Edit</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="/css/all.css" rel="stylesheet">

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #F8F9FA;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="card" style="width:800px;height:auto">
                <br>
                <div class="container">
                    <div class="row">
                        <div class="col-sm">
                            <h2>
                                Editando Usuario
                            </h2>
                        </div>
                    </div>
                </div>

                @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </div>
                @endif

                <div class="card-body">
                    <form action="/editar-salvar" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$usuario[0]->id}}">
                        <div class="container">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="name">Nome</label>
                                        <input type="text" class="form-control" name="name" value="{{$usuario[0]->name}}" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="age">Idade</label>
                                        <input type="number" class="form-control" name="age" value="{{$usuario[0]->age}}" required>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="phone">Telefone</label>
                                        <input type="text" class="form-control" name="phone" value="{{$usuario[0]->phone}}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" value="{{$usuario[0]->email}}" required>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="address">Endereço</label>
                                        <input type="text" class="form-control" name="address" value="{{$usuario[0]->address}}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success float-right">
                            <i class="far fa-save"></i>
                            Salvar
                        </button>
                    </form>
                    <form action="/" method="get">
                        <button type="submit" class="btn btn-light float-left">
                            <i class="fas fa-arrow-left"></i>
                            Cancelar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>
```

list.blade.php linha 185
```html
 <!--Editar Button-->
<form action="/editar" method="post">
    @csrf
    <input type="hidden" name="id" value="{{$u->id}}">
    <button class="btn btn-warning">
        <i class="fas fa-pencil-alt"></i>
        Editar
    </button>
</form>
```

web.php - Eu iria fazer enviando o id pela url, mas tem como fazer com hidden input request tambem.
```php
Route::post('/editar', 'AdminController@editar');

Route::post('/editar-salvar', 'AdminController@editarSalvar');
```

AdminController.php
```php
public function editar(Request $request)
    {
        //pega o usuario no banco pelo id
        $usuario = \DB::table('usuarios')->where('id', $request->id)->get();

        return view('edit', compact('usuario'));
    }

    public function editarSalvar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'age' => 'required|numeric|max:100',
            'phone' => 'required|numeric|digits:11',
            'email' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        //atualiza os dados do usuario no banco pelo id
        \DB::table('usuarios')
            ->where('id', $request->id)
            ->update([
                'name' => $request->name,
                'age' => $request->age,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'updated_at' => date('Y-m-d H:i:s.v'),
            ]);

        $msg = 'O Usuario ' . $request->name . ' foi alterado!';
        session()->flash('message', $msg);

        return redirect()->route('list');
    }
```

Resultado final:

![alt](https://i.imgur.com/j11WVsF.png)

Enfim, no geral é isso, um crud completo com validação dos dados, daria pra fazer muito mais coisa também mas por hoje é só, qualquer duvida só perguntar!