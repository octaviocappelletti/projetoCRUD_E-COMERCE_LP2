# ProjetoCRUD — Sistema de Gestão de Produtos

Projeto educacional desenvolvido para a disciplina de **Desenvolvimento Web com PHP**, com foco em operações CRUD, arquitetura modular e boas práticas de desenvolvimento back-end.

---

## Objetivo educacional

Este projeto tem como finalidade demonstrar, de forma prática e progressiva, os principais conceitos do desenvolvimento web com PHP:

- Estruturação de um sistema em **módulos por papel de usuário**
- Implementação completa de **CRUD** (Create, Read, Update, Delete)
- Uso de **sessões** para autenticação e controle de acesso
- Uso de **cookies** para persistência de dados no cliente
- Conexão com banco de dados **MySQL via MySQLi**
- Uso de **prepared statements** para prevenção de SQL Injection
- Separação de responsabilidades com **includes e layouts reutilizáveis**
- Passagem de dados entre páginas via **GET e POST**

---

## Tecnologias utilizadas

| Tecnologia | Finalidade |
|---|---|
| PHP 8+ | Linguagem principal back-end |
| MySQL | Banco de dados relacional |
| HTML/CSS | Interface do usuário |
| XAMPP | Ambiente local de desenvolvimento |

---

## Arquitetura do projeto

O sistema é dividido em dois módulos independentes, cada um representando um papel de usuário:

```
projetocrud/
├── index.php               # Ponto de entrada — redireciona para /comprador
├── style.css               # Estilos globais
├── layout/
│   ├── header.php          # Cabeçalho HTML reutilizável
│   └── footer.php          # Rodapé HTML reutilizável
├── comprador/              # Módulo do comprador (acesso público)
│   ├── config.php          # Define o papel e o tema visual
│   ├── index.php           # Catálogo de produtos com busca
│   ├── categorias.php      # Produtos filtrados por categoria
│   └── carrinho.php        # Carrinho de compras (via cookies)
├── vendedor/               # Módulo do vendedor (acesso autenticado)
│   ├── config.php          # Define o papel e o tema visual
│   ├── session.php         # Funções de autenticação e sessão
│   ├── login.php           # Formulário de login
│   ├── logout.php          # Encerramento de sessão
│   ├── menu.php            # Navegação do painel
│   ├── cat/                # CRUD de categorias
│   │   ├── index.php
│   │   ├── add.php
│   │   ├── edit.php
│   │   └── delet.php
│   └── prod/               # CRUD de produtos
│       ├── index.php
│       ├── add.php
│       ├── edit.php
│       └── delet.php
└── schemas/                # Scripts SQL para criação do banco
    ├── account.sql
    ├── cat.sql
    └── prod.sql
```

### Padrão arquitetural

O projeto adota uma abordagem **modular por papel**, onde cada módulo (`/comprador` e `/vendedor`) possui seu próprio `config.php` que define variáveis de contexto (papel do usuário, cor de tema) consumidas pelo layout compartilhado. Isso demonstra o conceito de **configuração por inclusão de arquivo**, um padrão comum em sistemas PHP antes do uso de frameworks.

O layout é componentizado em `header.php` e `footer.php`, incluídos em todas as páginas, o que elimina duplicação de HTML e ilustra o princípio **DRY** (Don't Repeat Yourself).

A lógica de autenticação é centralizada em `session.php`, que expõe funções reutilizáveis (`validaSessao()`, `contaValida()`, `registraConta()`), introduzindo o conceito de **separação de responsabilidades** mesmo em um ambiente sem framework.

---

## Conceitos PHP demonstrados

### 1. Inclusão de arquivos (`include` / `require`)
Usado para reutilizar o header, footer, configurações de módulo e funções de sessão, evitando repetição de código entre páginas.

### 2. Prepared Statements (MySQLi)
Todas as queries que recebem entrada do usuário utilizam prepared statements com `bind_param()`, prevenindo ataques de **SQL Injection**:

```php
$stmt = $conn->prepare("SELECT * FROM prod WHERE nome_prod LIKE ?");
$busca = "%$termo%";
$stmt->bind_param("s", $busca);
$stmt->execute();
```

### 3. Sessões PHP
O módulo do vendedor utiliza `$_SESSION` para manter o estado de autenticação entre requisições, com verificação em todas as páginas protegidas:

```php
function validaSessao() {
    if (!isset($_SESSION["CONTA_ID"])) {
        header("Location: ../login.php");
        exit();
    }
}
```

### 4. Cookies
O carrinho de compras do comprador é persistido em cookies do navegador, demonstrando armazenamento de estado **no lado do cliente** sem necessidade de banco de dados:

```php
setcookie("carrinho", $novoCarrinho, time() + (86400 * 30), "/");
```

### 5. Métodos HTTP (GET e POST)
- **GET** é usado para ações de leitura, filtragem e navegação (ex: `?id_cat=3`, `?del=yes`)
- **POST** é usado para envio de formulários de criação e edição de dados

### 6. Fluxo de confirmação de exclusão
O padrão de deleção em dois passos (exibir confirmação → executar exclusão via `?del=yes`) ilustra como proteger operações destrutivas em sistemas web sem JavaScript.

---

## Banco de dados

O sistema utiliza um banco chamado `sistema` com três tabelas:

- **account** — contas de vendedores (id, username, password)
- **cat** — categorias de produtos (id_cat, nome_cat)
- **prod** — produtos (id_prod, nome_prod, preco, id_cat)

`prod.id_cat` é chave estrangeira referenciando `cat.id_cat`, demonstrando o conceito de **relacionamento entre entidades** e a necessidade de integridade referencial.

---

## Como executar localmente

**Pré-requisitos:** XAMPP instalado com Apache e MySQL ativos.

1. Clone o repositório dentro da pasta `htdocs` do XAMPP:
   ```bash
   git clone https://github.com/SEU_USUARIO/projetocrud.git C:/xampp/htdocs/projetocrud
   ```

2. Importe os schemas no MySQL (via phpMyAdmin ou linha de comando):
   ```sql
   CREATE DATABASE sistema;
   USE sistema;
   -- importe os arquivos em schemas/ na ordem: account.sql, cat.sql, prod.sql
   ```

3. Acesse no navegador:
   ```
   http://localhost/projetocrud
   ```

4. Para acessar o painel do vendedor, use as credenciais da tabela `account` (usuário `demo` com a senha cadastrada no schema).

---

## Operações CRUD implementadas

| Entidade | Create | Read | Update | Delete |
|---|:---:|:---:|:---:|:---:|
| Categorias | ✅ | ✅ | ✅ | ✅ |
| Produtos | ✅ | ✅ | ✅ | ✅ |
| Carrinho (cookies) | ✅ | ✅ | — | ✅ |
| Contas | — | ✅ (login) | — | — |

---

## Aprendizados esperados

Ao estudar este projeto, o aluno será capaz de:

- Estruturar um sistema PHP em múltiplos módulos sem o uso de frameworks
- Implementar autenticação básica com sessões
- Escrever queries seguras com prepared statements
- Compreender o ciclo de vida de uma requisição HTTP em PHP
- Entender a diferença entre persistência de dados server-side (banco de dados, sessão) e client-side (cookies)
- Aplicar reuso de componentes de layout com `include`
