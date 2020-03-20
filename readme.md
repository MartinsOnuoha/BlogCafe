# BlogCafé ☕️

BlogCafé is a simple Single Page Blog Application built with Laravel and VueJS.

`BlogCafé` allows users create accounts, create blog posts with multiple images upload feature, view all blog posts and view a single blog post content.

`BlogCafé` is a end product of a [blog tutorial](https://medium.com/@martinsOnuoha/building-a-simple-blog-with-multiple-image-upload-in-laravel-vue-5517de920796) I wrote detailing how to build and implement a blog system with multiple image upload using Vuejs(a frontend SPA) and Laravel.

### Features

> - Login
> - Register
> - Multiple Image upload
> - Create Blog Post
> - View Blog Post

### Preview

<img src="https://raw.githubusercontent.com/MartinsOnuoha/BlogCafe/master/public/home.png" />

<img src="https://raw.githubusercontent.com/MartinsOnuoha/BlogCafe/master/public/viewpost.png" />


### Installation

> Clone repository

clone repository to your local machine

```
git clone https://github.com/MartinsOnuoha/BlogCafe.git
```

> Change Directory

Navigate into the project directory

```bash
cd BlogCafe
```

> Copy .env file

copy content of the environment file

```bash
cp .env.example .env
```

> Edit .env file

Update .env file with DB information

```
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=blogcafe
  DB_USERNAME=root
  DB_PASSWORD=grimesBottom
```

> Generate Key

Generate application key from your terminal

```bash
php artisan key:generate
```

> Install laravel packages

Remove composer.lock file and install packages

```bash
rm composer.lock
```

```bash
composer install
```

> Install npm packages

Remove package-lock.json file and install npm packages

```bash
rm package-lock.json
```

```bash
npm i
```

> Run Migrations

Run database migrations and seed the post tables

```bash
php artisan migrate:fresh --seed
```

> Start Application

```bash
php artisan serve
```

> Go to localhost:8000 and register, start blogging 🎉
