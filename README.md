### Docker
Необходимо добавить в свой hosts файл — `127.0.0.1 api.local` 

Собрать: `docker-compose build`

Запустить: `docker-compose up -d`

### Tests
Добавлено по одному happy-path тесту на каждый роут группы `guests`

Запустить: выполнить внутри контейнера `php artisan test`

### Headers
Добавлены заголовки `X-Debug-Time` и `X-Debug-Memory`, указывающие время выполнения запроса и затраченную память

### Docs
По пути `/docs` доступна документация в виде Swagger UI. http://api.local/docs

![img.png](img.png)
