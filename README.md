# mvc-pix-app

## Visão Geral
Aplicação web MVC para geração e confirmação de cobranças PIX "fake" com dashboard em tempo real, autenticação de usuários e cobertura de testes automatizados.

## Funcionalidades
- Cadastro e autenticação de usuários
- Geração de cobranças PIX com token único e expiração
- Confirmação automática de pagamento ao acessar o QR Code
- Dashboard com contagem de PIX gerados, pagos e expirados
- Testes automatizados (TDD)

## Stack
- **Backend:** Laravel 12
- **Banco:** MySQL (ou SQLite para testes)
- **Autenticação:** Laravel nativo
- **Testes:** PHPUnit

## Instalação
```bash
# Clone o repositório
$ git clone <repo-url>
$ cd mvc-pix-app

# Instale as dependências PHP
$ composer install

# Instale as dependências JS
$ npm install

# Copie o .env e configure o banco
$ cp .env.example .env
# Edite o .env conforme seu ambiente

# Gere a key
$ php artisan key:generate

# Rode as migrations e seeders
$ php artisan migrate --seed

# Rode o servidor
$ php artisan serve
```

## Testes
```bash
# Execute todos os testes
$ php artisan test

# (Opcional) Gere relatório de cobertura (requer Xdebug ou PCOV)
$ php artisan test --coverage
```

## Cobertura de Testes
- Cobertura mínima exigida: **80%**
- Para gerar o relatório, instale o Xdebug (veja instruções abaixo)

## Instruções para Xdebug (Windows/XAMPP)
1. Baixe o DLL em: https://xdebug.org/download
2. Coloque em `C:/xampp/php/ext`
3. No `php.ini`, adicione ao final:
   ```
   [XDebug]
   zend_extension = xdebug
   xdebug.mode = coverage,debug,develop
   xdebug.start_with_request = yes
   ```
4. Reinicie o Apache
5. Rode `php -v` e veja se aparece "with Xdebug"
6. Rode `php artisan test --coverage`

## Demonstração
- (Adicione aqui um GIF ou vídeo curto mostrando o fluxo: registro, login, geração de PIX, confirmação e dashboard)

## Contato
- Autor: Seu Nome
- Email: seu@email.com

---

> Projeto para fins de avaliação técnica. Não utilizar em produção.
