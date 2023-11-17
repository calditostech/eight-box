# Estágio 1: Instalação de Dependências e Configuração do Ambiente
FROM php:8.2-fpm AS builder

# Defina variáveis de ambiente
ARG user=default_user
ARG uid=1000

ENV USER=${user}
ENV UID=${uid}

# Instale as dependências necessárias
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# Instale extensões PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instale o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Adicione um usuário não privilegiado
RUN useradd -G www-data,root -u $UID -d /home/$USER -m $USER

# Crie diretórios e defina permissões
RUN mkdir -p /home/$USER/.composer && \
    chown -R $USER:$USER /home/$USER

# Defina o diretório de trabalho
WORKDIR /var/www/html

# Estágio 2: Instalação do Node.js e npm
FROM builder AS npm_stage

# Adicione os comandos npm (instalação do Node.js)
RUN apt-get update && \
    apt-get install -y npm && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* && \
    mkdir -p /var/lib/apt/lists/partial && \
    chmod 755 /var/lib/apt/lists /var/lib/apt/lists/partial || true

# Estágio 3: Instalação do Composer
FROM npm_stage AS composer_stage

# Adicione os comandos do Composer
RUN composer install --optimize-autoloader --no-dev --verbose || true

# Restante do Dockerfile

# Etapa final
FROM composer_stage AS final_stage

# Copie os arquivos do seu projeto
COPY . /var/www/html

# Exponha a porta necessária
EXPOSE 8080

# Comando para iniciar o servidor Laravel
CMD php artisan serve --host=0.0.0.0 --port=8080
