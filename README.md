# mvc-pix-app

##  Objetivo  
Avaliar e demonstrar a capacidade de implementar um **fluxo completo de desenvolvimento web**, com **arquitetura MVC**, **Test-Driven Development (TDD)** e **versionamento com Git e GitHub**.

---

## Visão Geral  
Aplicação web em **Laravel 12** para **geração e confirmação de cobranças PIX "fake"**, com:

- Autenticação de usuários
- Dashboard com gráficos dinâmicos
- Cobertura de testes automatizados
- Interface moderna com TailwindCSS

---

##  Funcionalidades

### Usuários
- Registro (nome, e-mail, senha)
- Login e logout com autenticação de sessão

### PIX Fake
- Geração de cobranças PIX com:
  - `user_id`
  - Token único (UUID)
  - Status inicial: `generated`
  - Expiração automática: +10 minutos
- Link e QR Code para visualização/validação

### Confirmação de Pagamento
- Ao acessar `/pix/{token}`:
  - Se expirado, status vira `expired`
  - Caso contrário, status vira `paid`
- Página de retorno exibe o status atualizado

### Dashboard (Protegido)
- Acesso restrito a usuários autenticados
- Cards com contagem total de:
  - Gerados
  - Pagos
  - Expirados
- Gráficos de pizza e barra com Chart.js

### Testes Automatizados (TDD)
- Testes cobrindo:
  - Registro e login
  - Geração de PIX
  - Confirmação de status
  - Dashboard
- Cobertura mínima: **80%**

### GitHub e Versionamento
- Organização com branches para features/correções
- Pull Requests com descrição clara e evidências/testes

---

##  Stack Utilizada

Backend       | Laravel 12 (MVC), PHP                 
Banco de Dados| SQLite                                
Autenticação  | Laravel Session                      
Testes        | PHPUnit + Laravel Test Factory       
Frontend      | Blade + TailwindCSS
Versionamento | Git + GitHub                        

---

## Instalação e Execução

```
# Clone o repositório
git clone https://github.com/purpesy/mvc-pix-app.git
cd mvc-pix-app

# Instale as dependências PHP
composer install

# Instale as dependências JavaScript
npm install

# Copie o arquivo .env e configure conforme seu ambiente
cp .env.example .env

# Gere a chave da aplicação
php artisan key:generate

# Rode as migrations (e seeders, se necessário)
php artisan migrate --seed

# Inicie o servidor local
php artisan serve

## Executando os Testes

# Rode os testes
php artisan test

# (Opcional) Gere relatório de cobertura (requer Xdebug ou PCOV)
php artisan test --coverage
```

## Xdebug no Windows (XAMPP)

- Baixe o DLL em: https://xdebug.org/download
- Coloque em: C:/xampp/php/ext
- No php.ini, adicione no final:
```
[XDebug]
zend_extension = xdebug
xdebug.mode = coverage,debug,develop
xdebug.start_with_request = yes
```
- Reinicie o Apache
- Verifique com php -v se aparece with Xdebug
- Rode os testes com cobertura novamente:
```php artisan test --coverage```

## Fluxo Principal

- Cadastro de usuário
- Login
- Geração de PIX (token + expiração automática)
- Acesso ao link para confirmação
- Visualização do dashboard com gráficos

## Demonstração
