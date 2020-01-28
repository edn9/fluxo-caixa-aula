# Aula Laravel / PHP - Jan. 2020
Aula completa backend/frontend Laravel/PHP com SQL Server rodando em Linux/Windows.

## Sumário

<h3>

- [Introdução](##Introdução)
- [Como instalar](##Como-instalar)
- [Configurando](##Configurando)
- [Iniciando o Projeto](##Iniciando-o-Projeto)
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

```js
node -v
v12.14.1

npm -v
6.13.4

composer -v
Composer version 1.9.0 2019-08-02 20:55:32
```

Se todos os programas mostrarem as versões, esta pronto para instalar os pacotes:

`composer install`

`npm i`

`npm run dev`

E para rodar o site, primeiro copie o `.env.example` com nome `.env`:

![env](https://i.imgur.com/SZ1Syyr.png)

O arquivo ``.env`` é responsavel por uma boa parte da configuração do seu sistema, então coisas como smtp, database, nome do programa, configurações de porta em geral vão aqui e na pasta ``config/``, mas por enquanto vamos só alterar alguns campos dele para conectar ao sqlserver.

*Para mais informações do ``.env``, <a href="https://laravel.com/docs/6.x/configuration" target="blank">clique aqui</a>.*

---

## Iniciando o Projeto