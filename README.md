# Help Desk - Sistema de Chamados

Sistema web desenvolvido em Laravel com autenticação Breeze, para gerenciamento de tickets de suporte.

## Funcionalidades

- Cadastro e login de usuários (com roles: admin e user)
- Usuários criam chamados (tickets) com título, descrição e status
- Admin pode visualizar, editar e excluir todos os tickets e usuários
- Usuários comuns visualizam e gerenciam apenas seus próprios tickets

## Tecnologias

- Laravel 10
- Breeze (autenticação)
- PHP 8.x
- Blade Templates
- Bootstrap 5

## Como usar

## Como rodar o projeto localmente

### Passo 1 - Clone o repositório

- git clone https://github.com/RafaelPereira0/TicketsLaravel.git
- cd seurepositorio
- composer install
- npm install
- cp .env.example .env
- php artisan key:generate
- touch database/database.sqlite
- php artisan migrate --seed
- npm run build
- php artisan serve


## Próximos passos


- Melhorar frontend com Vue ou React
- API RESTful para integração com apps móveis
- Dashboard analítico com gráficos

---

**Autor:** Rafael Pereira da Silva  
**Contato:** rafael_pereira5@outlook.com 
