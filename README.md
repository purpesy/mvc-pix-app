# mvc-pix-app

## Objetivo

Avaliar a capacidade de implementar um fluxo completo de desenvolvimento back-end e front-end seguindo padrões MVC, práticas de Test-Driven Development (TDD) e versionamento no GitHub.

## Visão Geral

Aplicação web MVC em Laravel para geração e confirmação de cobranças PIX "fake", com autenticação de usuários, dashboard em tempo real e cobertura de testes automatizados.

## Funcionalidades

- Cadastro e autenticação de usuários (registro, login, logout)
- Geração de cobranças PIX vinculadas ao usuário, com token único (UUID) e expiração automática
- Confirmação automática de pagamento ao acessar a URL/QR Code do PIX
- Dashboard protegido exibindo contagem de PIX gerados, pagos e expirados, com gráficos em tempo real
- Testes automatizados cobrindo todos os fluxos principais (TDD)
- Versionamento no GitHub com uso de branches e pull requests

## Requisitos Funcionais

1. **Usuários**
   - Registro (nome, e-mail, senha)
   - Login e logout

2. **PIX Fake**
   - Endpoint para gerar novo PIX: cria registro com `user_id`, `token` (UUID), status inicial `generated`, `expires_at` (agora + 10 minutos)
   - Link e QR Code gerados a partir do token

3. **Confirmação de Pagamento**
   - Ao acessar `/pix/{token}`:
     - Se expirado, marca como `expired`
     - Caso contrário, marca como `paid`
     - Exibe página de confirmação com status atualizado

4. **Dashboard MVC**
   - Tela protegida para usuários autenticados
   - Cards e gráficos com contagem de PIX por status: Gerados, Pagos, Expirados

5. **Testes Automatizados (TDD)**
   - Cobertura de registro/login, geração de PIX, confirmação (paid/expired) e dashboard

6. **GitHub**
   - Repositório organizado, branches para features/correções, pull requests claros


## Stack Utilizada

- **Backend:** Laravel 12 (MVC)
- **Banco de Dados:** SQLite
- **Autenticação:** Laravel nativo (session)
- **Testes:** PHPUnit
- **Frontend:** Blade + TailwindCSS
- **Versionamento:** Git/GitHub

## Instalação e Execução

```bash
# Clone o repositório
git clone https://github.com/purpesy/mvc-pix-app.git
cd mvc-pix-app

# Instale as dependências PHP
composer install

# Instale as dependências JS
npm install

# Copie o .env e configure o banco
cp .env.example .env
# Edite o .env conforme seu ambiente

# Gere a key
php artisan key:generate

# Rode as migrations e seeders
php artisan migrate --seed

# Rode o servidor
php artisan serve
```

## Testes

```bash
# Execute todos os testes
php artisan test

# (Opcional) Gere relatório de cobertura (requer Xdebug ou PCOV)
php artisan test --coverage
```

- Cobertura mínima exigida: **80%**
- Para gerar o relatório, instale o Xdebug (veja instruções abaixo)

### Instruções para Xdebug (Windows/XAMPP)

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

## Fluxo Principal

1. Cadastro de usuário
2. Login
3. Geração de PIX (token + expiração)
4. Acesso ao link/QR Code para confirmação (pago/expirado)
5. Visualização do dashboard com gráficos

## GitHub

- Repositório público/privado organizado
- Uso de branches para features/correções
- Pull requests com descrição e evidências de testes

## Demonstração

- (Adicione aqui um GIF ou vídeo curto mostrando o fluxo: registro, login, geração de PIX, confirmação e dashboard)