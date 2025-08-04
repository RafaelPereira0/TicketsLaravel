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

1. Clone o repositório
2. Configure seu `.env` com dados do banco
3. Rode as migrations: `php artisan migrate`
4. Inicie o servidor: `php artisan serve`
5. Acesse `http://localhost:8000`

## Próximos passos

- Melhorar frontend com Vue ou React
- API RESTful para integração com apps móveis
- Dashboard analítico com gráficos

---

**Autor:** Seu Nome  
**Contato:** seu.email@example.com
