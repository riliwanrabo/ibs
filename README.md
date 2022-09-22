## IBS Assessment ~ Riliwan Balogun 
Built with LaravelPHP 9.x<br />

## Setup :)

```bash
git clone { repo url }

composer install

cp .env.example .env

sail up -d

sail artisan migrate:fresh --seed

```

## Test Credentials
After running the `sail artisan migrate:fresh --seed`, you are provided with sample data for (users, books, comments, authors).

the user nomenclature is `user<count>.ibs.test` where count is a number from 1 to 20. password is `password`

## Problem Statement
- The movie data can be fetched online from https://anapioficeandfire.com/
OR You can make an API locally to satisfy books, authors and comments.
- Book names in the book list endpoint should be sorted by release date from earliest to
newest and each book should be listed along with authors and count of comments.
- Comments should be stored in a database.
- Error responses should be returned in case of errors

From the requirements above, I chose to create a local API that allows me to perform CRUD on Books, Authors, Users and Comments

## Application Structure

While sticking with the default laravel structure, there a notable additions I made while executing these tasks. These additions are listed below.

- **Factories**: To enable rapid development.
- **Macros**: I added a Macro named "whereLike" inside my AppServiceProvider. This will aid eradicate duplicates such as `where('field', 'LIKE', '%$searchTerm%')`
- **Exceptions**: I caught most of my exceptions inside my Handler.php to give more easy to read/understand descriptions 
- **Observers**: A comment observer was needed to automatically store the commenter's public Ip




## API endpoints and verbs

- `GET {{base-url}}/health` Site Health (Useful but not entirely necessary): This allows you to know the application environment and uptime.

```json
{
    "status": "ok",
    "app_name": "IBS ASSESSMENT ~ Riliwan Balogun",
    "php_version": "8.1.9",
    "app_version": "9.31.0",
    "in_maintainance_mode": false,
    "message": "up and running",
    "timezone": {
        "timezone_type": 3,
        "timezone": "UTC"
    }
}
```

Others endpoints 

## Auth
- `POST {{base-url}}/auth/register` Create a user/commenter account
- `POST {{base-url}}/auth/login` Login
- `GET {{base-url}}/auth/me` Profile

## Books
- `GET {{base-url}}/books` Books collection
- `GET {{base-url}}/books/{id}` A book resource
- `POST {{base-url}}/books` Create book resource
- `DELETE {{base-url}}/book/{id}` Delete a book resource

## Authors
- `GET {{base-url}}/authors` author collection
- `GET {{base-url}}/authors/{id}` A author resource
- `POST {{base-url}}/authors` Create author resource
- `DELETE {{base-url}}/authors/{id}` Delete a author resource

## Comments
- `GET {{base-url}}/comments` author collection
- `POST {{base-url}}/comments` Create author resource
- `DELETE {{base-url}}/comments/{id}` Delete a author resource

The postman collection with complete request and response can be found <a href="https://www.getpostman.com/collections/2934c4bef61857417666" target="_blank">here</a>




