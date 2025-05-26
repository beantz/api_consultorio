
# api_clinica

Decidi desenvolver esse projeto para facilitar o agendamento de pacientes em uma clinica, o objetivo é fazer algo funcional e de facil compreensão para o publico alvo, vou usar tecnologias como Laravel 12, MySQL, JWT, Docker. Diferente de outros projetos desenvolvidos com essa mesma temática, o diferencial dessa vai ser que as regras de negocio vão ser mais bem definidas e melhor estruturadas.

## Funcionalidades

- Agendamento de pacientes
- Categorização de pacientes
- Triagem automatica


## Stack utilizada

**Front-end:** HTML, CSS

**Back-end:** PHP, Laravel, Docker

**Autenticação:** JWT

**Testes de rotas:** Postman


## Instalação

Clone o projeto:
```
    git clone https://github.com/beantz/api_consultorio
    cd api_consultorio
```

## Deploy

Para fazer o deploy desse projeto rode

Instale as dependências do Composer
```
    composer install
```

Gere a chave da aplicação
```
    php artisan key:generate
```

Crie as tabelas no banco
```
    php artisan migrate
```

Suba a aplicação
```
    php artisan serve
```

Edite o **.env** com as credenciais corretas:
```
    DB_CONNECTION=mysql
    DB_HOST=db
    DB_PORT=3306
    DB_DATABASE=nome_do_banco
    DB_USERNAME=usuario
    DB_PASSWORD=senha
```

## ps:
Conforme a ideia for amadurecendo e o projeto evoluindo, vou está documentando tudo no readme <3
