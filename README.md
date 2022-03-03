## Devola

A crud todo app powered by Laravel and VueJS

## Requirements
**NodeJS**: v16.0.0

**VueJS**:^2.6.14

**Axios**: 0.26.0

**PHP**: ^7.4.0

## Setup

### With [XAMPP](https://www.apachefriends.org/index.html)
```bash
# Clone the repo in XAMPP's htdocs
$ cd C:\xampp\htdocs
$ git clone https://github.com/Binboukami/devola.git

# Start XAMPP's Apache server through the control panel and access the application the backend through the browser
$ http:/localhost/devola/api

# Start front-end development server at localhost:3000
$ cd app
$ npm run dev
```
If you encounter any erros while trying to run the application through XAMPP, please get in contact or refer to the [XAMP](https://www.apachefriends.org/docs/) documentation for possible details.

### Without XAMPP

```bash
# Clone the repo in your prefered working folder
$ git clone https://github.com/Binboukami/devola.git

# Start backend server at localhost:8000
$ cd api
$ php artisan serve

# Start front-end development server at localhost:3000
$ cd app
$ npm run dev
```

## Documentation

### API
As the default for laravel api applications, the endpoints are exposed through ```../api/resource```.
Below are the following resources and accepted endpoints for the api.

## Todos
```GET:```
```POST: ```
```PUT:```
```DELETE```
