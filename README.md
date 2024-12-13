# Desafio da Vaga - PHP Master

## 📜 Descrição 

Este repositório contém a solução para o desafio técnico proposto para a vaga de **desenvolvedor PHP Master**. 

O objetivo do desafio era criar um projeto que consiste em um cadastro de livros, utilizando as boas práticas de mercado.

## 📌 Demonstração

O projeto pode ser acessado em: [https://desafio-tj.crthiago.com.br/](https://desafio-tj.crthiago.com.br/)

## 🔧 Tecnologias

### Frontend

<div>
    <a href="https://vuejs.org/">
        <img src="https://img.shields.io/badge/Vue.js-4FC08D?style=for-the-badge&logo=vue.js&logoColor=white" />
    </a>
    <a href="https://vuetifyjs.com/">
        <img src="https://img.shields.io/badge/Vuetify-1867C0?style=for-the-badge&logo=vuetify&logoColor=white" />
    </a>
    <a href="https://router.vuejs.org/">
        <img src="https://img.shields.io/badge/Vue_Router-4FC08D?style=for-the-badge&logo=vue.js&logoColor=white" />
    </a>
    <a href="https://vuex.vuejs.org/">
        <img src="https://img.shields.io/badge/Vuex-4FC08D?style=for-the-badge&logo=vuex&logoColor=white" />
    </a>
    <a href="https://www.typescriptlang.org/">
        <img src="https://img.shields.io/badge/Typescript-007ACC?style=for-the-badge&logo=typescript&logoColor=white" />
    </a>
    <a href="https://axios-http.com/">
        <img src="https://img.shields.io/badge/Axios-5A29E4?style=for-the-badge&logo=axios&logoColor=white" />
    </a>
</div>

### Backend

<div>
    <a href="https://laravel.com/">
        <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" />
    </a>
    <a href="https://www.php.net/">
        <img src="https://img.shields.io/badge/PHP-4F5B93?style=for-the-badge&logo=php&logoColor=white" />
    </a>
    <a href="https://www.mysql.com/">
        <img src="https://img.shields.io/badge/MySQL-0D6EFD?style=for-the-badge&logo=mysql&logoColor=white" />
    </a>
</div>

## 📦 Instalação

1. Clonar o repositório
```bash
git clone https://github.com/crthiago/desafio-tj.git

cd desafio-tj
```

2. Instalar imagens do docker
```bash
docker compose up -d
```

3. Acessar container `laravel.test` e instalar dependências
```bash
docker exec -it laravel.test bash
su sail
composer install
npm install
```

4. Configurar `.env`, rodar as migrations e seeds
```bash
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
```

5. Criar link simbólico para o storage
```bash
php artisan storage:link
```

6. Rodar o projeto
```bash
npm run dev
```

7. Acessar [http://localhost](http://localhost)

## 🧪 Testes 

Para rodar os testes, basta rodar o comando abaixo:
```bash
php artisan test
```

## 🤝 Considerações Finais 

O código foi desenvolvido pensando em um sistema escalável e de fácil manutenção, utilizei ao 
máximo as boas práticas de mercado aproveitando os recursos do framework Laravel e Vue.

Obrigado por conferir! 👋

