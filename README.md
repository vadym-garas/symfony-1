# Symfony Docker installer

## About 
Symfony 6.3.*@dev
php-fpm 8.1
Mysql latest
nginx latest

## Use
### Step 1
Copy `.env.install.dist` file to `.env.install`

Change `PROJECT_NAME` in `.env.install`

### Step 2
run `docker-compose --env-file .env.install up`

This may take a few minutes. Wait for completion.

### Step 3
Profit