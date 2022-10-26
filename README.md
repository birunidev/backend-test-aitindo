# Documentation

Live Frontend URL: [Open](https://aitindo-todo-web-app.vercel.app)
Live Backend URL: [Open](https://birunidev.my.id/api)

### Backend

Requirement:

- PHP v8.1.9 or higher
- Composer
- MySQL

How to Install:

1. Create database in MySQL

```
CREATE DATABASE db_todo_app
```

2. Install all the packages (Inside Laravel Project)

```
composer update
```

3. Change database config based on your localhost config (Inside Laravel Project)

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_todo_app // your_database_name
DB_USERNAME=root
DB_PASSWORD=
```

4. Migrate database with

```
php artisan mirate
```

4. Run the API with

```
php artisan serve
```

5. The app will be listening at port 8000 http://localhost:8000
<hr>

#### Frontend

Requirement:

- Node JS [Download](https://nodejs.org/en/ "Download NodeJS").
- Yarn [Install](https://classic.yarnpkg.com/lang/en/docs/install/#windows-stable)

```
npm install --global yarn
```

How to install the frontend app:

1. Install Packages

```
yarn
```

2. Rename .env_copy to .env
3. Make sure you change the API URL to the correct one

Inside .env file

```
REACT_APP_API_URL=http://localhost:8000/api
```

4. Run app in http://localhost:3000

<hr>

# API DOCUMENTATION

###Get All Todos:
URL: https://birunidev.my.id/api/todos/all
method: GET

##### Example Response

```
[
    {
        "id": 1,
        "title": "My Todo",
        "date": 1666803600,
        "time": 1666771620,
        "status": "UNCOMPLETED",
        "description": "asdasdasd",
        "created_at": "2022-10-26T06:06:13.000000Z",
        "updated_at": "2022-10-26T06:06:13.000000Z"
    }
]
```

###Get Todo by Label:
URL: https://birunidev.my.id/api/todos
method: GET

##### Example Response

```
{
    "data": [
        {
            "id": "today",
            "label": "Today",
            "data": [
                {
                    "id": 13,
                    "title": "asdsadasdas asdsadasd",
                    "date": "2022-10-26",
                    "time": "18:30",
                    "status": "COMPLETED",
                    "description": "asdsad asdsadsad",
                    "created_at": "2022-10-26T07:27:07.000000Z",
                    "updated_at": "2022-10-26T07:27:32.000000Z"
                }
            ]
        },
        {
            "id": "tomorrow",
            "label": "Tomorrow",
            "data": [
                {
                    "id": 8,
                    "title": "Test for change",
                    "date": "2022-10-27",
                    "time": "05:49",
                    "status": "COMPLETED",
                    "description": "adasdasdasd asdasdsad",
                    "created_at": "2022-10-26T06:46:56.000000Z",
                    "updated_at": "2022-10-26T07:21:44.000000Z"
                }
            ]
        },
        {
            "id": "this-month",
            "label": "This Month",
            "data": []
        }
    ],
    "statusCode": 200,
    "success": true
}
```

###Create a Todo:
URL: https://birunidev.my.id/api/todos
method: POST

##### Example Request

```
{
    "title": "My Todo",
    "time": "08:00",
    "date": "2022-10-28",
    "description": "This is an example"
}
```

##### Example Response

```
{
    "statusCode": 200,
    "success": true,
    "data": {
        "title": "My Todo",
        "description": "This is an example",
        "date": 1666890000,
        "time": 1666746000,
        "status": "UNCOMPLETED",
        "updated_at": "2022-10-26T08:40:40.000000Z",
        "created_at": "2022-10-26T08:40:40.000000Z",
        "id": 14
    },
    "message": "Todo has been added successfully"
}
```

###Update a Todo:
URL: https://birunidev.my.id/api/todos/{id}
method: PUT

##### Example Request

```
{
    "title": "My Todo Testing Change",
    "time": "08:00",
    "date": "2022-10-28",
    "description": "This is an example of editing"
}
```

##### Example Response

```
{
    "statusCode": 200,
    "succces": true,
    "data": {
        "id": 14,
        "title": "My Todo Testing Change",
        "date": 1666890000,
        "time": 1666746000,
        "status": "UNCOMPLETED",
        "description": "This is an example of editing",
        "created_at": "2022-10-26T08:40:40.000000Z",
        "updated_at": "2022-10-26T08:41:22.000000Z"
    },
    "message": "Todo has been updated successfully"
}
```

###Delete a Todo:
URL: https://birunidev.my.id/api/todos/{id}
method: DELETE

##### Example Response

```
{
    "statusCode": 200,
    "succces": true,
    "message": "Todo has been deleted successfully"
}
```
