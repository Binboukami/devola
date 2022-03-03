## Devola
A CRUD Todo application powered by VueJs and Laravel.

## Resources

[Insomnia Collection](#)

## Requirements
**NodeJS**: v16.0.0

**VueJS**:^2.6.14

**Axios**: 0.26.0

**PHP**: ^7.4.0

## Setup
The frontend intructions are the same for both setup types. To avoid repetition they stated once after the backend instructions.

### Backend With [XAMPP](https://www.apachefriends.org/index.html)
```bash
# Clone the repo in XAMPP's htdocs
$ cd C:\xampp\htdocs
$ git clone https://github.com/Binboukami/devola.git

# Start XAMPP's Apache server through the control panel and access the application the backend through the browser
$ http:/localhost/devola/api
```
If you encounter any erros while trying to run the application through XAMPP, please get in contact or refer to the [XAMP](https://www.apachefriends.org/docs/) documentation for possible details.

### Without XAMPP

```bash
# Clone the repo in your prefered working folder
$ git clone https://github.com/Binboukami/devola.git

# Start backend server at localhost:8000
$ cd api
$ php artisan serve

# Start front-end development server at localhost:8080
$ cd app
$ npm run dev

# Build front-end for production
$ npm run build

# Start front-end production server at an available port
$ npm run start
```

## Documentation

### API
As the default for laravel api applications, the endpoints are exposed through ```../api/resource```.
Below are the following resources and accepted endpoints for the api.

## Todos
### GET:
```../api/todos/```
Returns all todos from the database.

### POST:
``` ```../api/todos/```
Stores a todo in the database. Accepts the following data from the request:

  ##### title: ```string```

  ##### content: ```string``` (optional)

  ##### date: ```Date``` __(optional)__

### POST:
```../api/todos/{id}```
Updates the respective todo with the id received at the url with data from the request. Accepts the same field as the ```POST:``` method.

i.e:
```../api/todos/1```:

Updates the todo with ```id: 1```.

### DELETE:
```../api/todos/{id}```
Deletes the respective todo with the id received at the url.

i.e:
```../api/todos/16```:

Deletes the todo with ```id: 16```.
