# Cadastro de Produtos - PHP

Projeto simples em PHP para cadastro, listagem e validação de produtos utilizando arquivos de texto como armazenamento.

---

## Estrutura do Projeto

```
/project-root
│
├─ public/
│  ├─ index.php        # Formulário de cadastro
│  ├─ create.php       # Lógica para criar produto
│  ├─ products.php     # Listagem de produtos
│
├─ src/
│  ├─ Application/
│  │  └─ ProductService.php
│  ├─ Domain/
│  │  └─ SimpleProductValidator.php
│  ├─ Contracts/
│  │  ├─ ProductRepository.php
│  │  └─ ProductValidator.php
│  └─ Infra/
│     └─ FileProductRepository.php
│
├─ storage/
│  └─ products.txt     # Armazena os produtos em JSON
│
├─ vendor/             # Composer
└─ composer.json
```

---

## Requisitos

* PHP >= 8.0
* Composer

---

## Instalação

1. Clone o repositório:

```bash
git clone <url-do-repositorio>
cd <nome-do-projeto>
```

2. Instale as dependências (se houver):

```bash
composer install
```

3. Certifique-se de que a pasta `storage/` exista e tenha permissão de escrita pelo PHP.

---

## Executando o Projeto

1. Inicie um servidor PHP local:

```bash
php -S localhost:8000 -t public
```

2. Acesse no navegador:

```
http://localhost:8000/index.php
```

3. Cadastre novos produtos ou veja a lista existente em:

```
http://localhost:8000/products.php
```

---

## Funcionalidades

* Cadastro de produtos (`name` e `price`)
* Validação de dados:

  * `name` obrigatório, entre 2 e 100 caracteres
  * `price` obrigatório, numérico e não negativo
* Listagem de produtos cadastrados
* Armazenamento em arquivo de texto (`storage/products.txt`)
* Geração automática de ID incremental para cada produto

---

## Estrutura de Produto

Cada produto é armazenado em JSON com a seguinte estrutura:

```json
{
  "id": 1,
  "name": "Nome do Produto",
  "price": 100.00
}
```

---

## Exemplos de Teste

Arquivo `storage/products.txt` inicial pode conter:

```json
{"id":1,"name":"tiger 900","price":1000}
{"id":2,"name":"bitelo","price":5}
{"id":3,"name":"fan 160","price":50000}
{"id":4,"name":"Notebook","price":2000}
{"id":5,"name":"bitelo","price":5}
{"id":6,"name":"Daniel Victor Costa","price":82}
```

### Cenários de Teste

1. **Cadastro válido**

   * Nome: `Moto X`
   * Preço: `12000`
   * Esperado: Produto criado e listado em `products.php`.

2. **Cadastro inválido (nome vazio)**

   * Nome: `""`
   * Preço: `100`
   * Esperado: Erro: "O campo name é obrigatório."

3. **Cadastro inválido (nome curto)**

   * Nome: `"A"`
   * Preço: `100`
   * Esperado: Erro: "O campo name deve ter pelo menos 2 caracteres."

4. **Cadastro inválido (preço negativo)**

   * Nome: `"Produto Teste"`
   * Preço: `-10`
   * Esperado: Erro: "O campo price não pode ser negativo."

5. **Listagem de produtos**

   * Todos os produtos cadastrados devem aparecer na tabela com ID, Nome e Preço fo

##  Alunos
 - **[Daniel Costa](https://www.linkedin.com/in/daniel-costa-b88a07198)**, RA: 1989218, E-mail: daniel0920.victor@gmail.com

 - **[Gustavo Henrique](https://www.linkedin.com/in/gustavo-henrique-vieira-da-silva-6284b7231)**, RA: 1992080, E-mail: gurednike@gmail.com
