# Laravel GraphQL Boilerplate
Web application boilerplate built with Laravel and GraphQL

## Summary

- [Stack](#stack)
- [Requirements](#requirements)
- [Setup](#setup)
- [Credits](#credits)

## Stack

![Laravel](https://raw.githubusercontent.com/lgcolella/laravel-graphql-boilerplate/master/repository/laravel.png "Laravel")
![GraphQL](https://raw.githubusercontent.com/lgcolella/laravel-graphql-boilerplate/master/repository/graphql.png "GraphQL")
![MySQL](https://raw.githubusercontent.com/lgcolella/laravel-graphql-boilerplate/master/repository/mysql.png "MySQL")
![Nginx](https://raw.githubusercontent.com/lgcolella/laravel-graphql-boilerplate/master/repository/nginx.png "Nginx")
![Docker](https://raw.githubusercontent.com/lgcolella/laravel-graphql-boilerplate/master/repository/docker.png "Docker")

## Requirements

- Docker Compose >= 3.3

## Setup

Start the application by using

```sh
docker-compose up -d # start app and other services
docker-compose exec app bash -c "composer install" # install app's dependencies
```

Then the following endpoints will be available:

Link | Description
---  | ---
[localhost:8000](http://localhost:8000) | Laravel application home
[localhost:8000/graphql](http://localhost:8000/graphql) | GraphQL endpoint
[localhost:4000](http://localhost:3000) | GraphQL Playground, a tool to test and explore the schema
[localhost:8080](http:localhost:8080) | Adminer, a visual database manager

> If you installed Docker by Docker Toolbox, you may need to replace `localhost` with the ip returned by `docker-machine ip`.

To run tests you can use

```sh
docker-compose exec app bash -c "vendor/bin/phpunit"
```

## Credits

The database dump was taken at https://www.mysqltutorial.org/mysql-sample-database.aspx.
