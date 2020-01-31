# Aula Laravel / PHP - Jan. 2020
Aula completa backend/frontend Laravel/PHP com SQL Server rodando em Linux/Windows.

## Sumário

<h3>

- [Introdução](#Introdução)
- [Como instalar](#Como-instalar)
- [Configurando](#Configurando)
- [Iniciando o Projeto](#Iniciando-o-Projeto)
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

Como estamos usando o PHP 7.2, precisamos dos drives de acordo a nossa versão, <a href="https://docs.microsoft.com/en-us/sql/connect/php/system-requirements-for-the-php-sql-driver?view=sql-server-2017#driver-versions" target="blank">clique aqui</a> para ver a tabela que informando sobre.

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

Se a resposta for:
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

## Iniciando o Projeto
