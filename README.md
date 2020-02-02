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

You must have only Docker and Docker Compose installed on your system to run and develop this project.

## Setup

```sh
docker-compose up -d # start app and other services
docker-compose exec app bash -c "composer install" # install app's dependencies
```

Now you can see the application at [localhost:8000](http://localhost:8000/).

If you want manage the database by using a visual tool, you can use Adminer at [localhost:8080](http:localhost:8080).

> If you installed Docker by Docker Toolbox, you may need to replace `localhost` with the ip returned by `docker-machine ip`.

## Credits

The database dump was taken at https://www.mysqltutorial.org/mysql-sample-database.aspx.
