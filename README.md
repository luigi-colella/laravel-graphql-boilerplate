# Laravel GraphQL Boilerplate
Web application boilerplate built with Laravel and GraphQL

## Summary

- [Setup](#setup)
- [Credits](#credits)

## Setup

```sh
docker-compose up -d # start app and other services
docker-compose exec app bash -c "composer install" # install app's dependencies
```

Now you can see the application at [localhost:8000](http://localhost:8000/)

> If you installed Docker by Docker Toolbox, you may need to replace `localhost` with the ip returned by `docker-machine ip`.

## Credits

The database dump was taken at https://www.mysqltutorial.org/mysql-sample-database.aspx
