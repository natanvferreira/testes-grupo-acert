# Teste 2

Construção de uma aplicação em PHP utilizando o framework Laravel que consome a API do Github

## 🚀 Começando

Essas instruções permitirão que você obtenha uma cópia do projeto em operação na sua máquina local para fins de desenvolvimento e teste.


### 📋 Pré-requisitos

```
PHP 8.1
Composer
Um token válido do github
```

### 🔧 Instalação

Primeiro clone o projeto em uma pasta de sua preferencia

```
git clone <link-do-repositorio> nome-da-pasta
```

Ao fim da clonagem do repositorio entre na pasta:

```
composer install
```
Depois copie e cole o .env.example e altere o *GITHUB_TOKEN* para o seu.

Ao fim de todos esses processos basta rodar o servidor:

```
php artisan serve
```
## ⚙️ Funcionamento da aplicação

Ao adentrar na aplicação, o usuário deparará com um campo que solicita a inserção de um nome de usuário válido. Caso o campo seja deixado em branco, a aplicação permanecerá inerte até que um nome seja fornecido. Entretanto, ao inserir um nome e acionar a opção de pesquisa ou pressionar a tecla ENTER, a aplicação imediatamente realizará uma consulta ao banco de dados do GitHub, visando obter os dados associados ao nome informado. Ao término da pesquisa, caso o usuário esteja cadastrado, todos os dados pertinentes serão exibidos na tela. Caso contrário, caso não haja correspondência, a mensagem "Usuário não encontrado" será apresentada de forma elegante e informativa.