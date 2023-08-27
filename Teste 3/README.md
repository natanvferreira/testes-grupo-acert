# Teste 3

Construção de uma aplicação em PHP utilizando o framework Laravel que consome a API do ViaCep

## 🚀 Começando

Essas instruções permitirão que você obtenha uma cópia do projeto em operação na sua máquina local para fins de desenvolvimento e teste.


### 📋 Pré-requisitos

```
PHP 8.1
Composer
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

Ao fim de todos esses processos basta rodar o servidor:

```
php artisan serve
```
## ⚙️ Funcionamento da aplicação
Ao acessar a aplicação, o usuário se depara com um campo que solicita pelo menos um número de CEP. Se o usuário optar por não inserir nenhum CEP, o sistema permanece inativo. Por outro lado, se o usuário fornecer um ou mais CEPs, separados por vírgula, o sistema iniciará uma busca por todos os CEPs válidos, os quais serão listados em uma tabela. Quaisquer CEPs inválidos serão destacados em um alerta informativo.

Após a conclusão da pesquisa, na parte superior da tabela, surgem dois botões. O primeiro deles permite a exportação dos resultados para um arquivo no formato .CSV, facilitando a utilização posterior dos dados. O segundo botão, por sua vez, possibilita ao usuário limpar o conteúdo da tabela, tornando mais ágil o processo de iniciar uma nova pesquisa ou refinar os resultados existentes.