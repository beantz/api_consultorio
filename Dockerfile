#build estagio de dependencia
#runtime estagio de execução
FROM composer:2.8 AS builder

WORKDIR /app
COPY . .
#instala dependencias e otimiza o carregamento automatico das classes
RUN composer install --no-dev --optimize-autoloader

FROM php:8.4-cli

WORKDIR /app
#copia o builder definido no topo para dentro de app
COPY --from=builder /app .

#instala extensões PHP necessárias
#pdo é PHP Data Objects (interface de acesso a bancos de dados) e o pdo_mysql é o driver do mysql 
RUN docker-php-ext-install pdo pdo_mysql

#expõe a porta do servidor embutido
EXPOSE 8000

# Comando para iniciar o servidor
CMD ["sh", "-c", "php artisan serve --host=0.0.0.0 --port=8000"]