### Docker
Необходимо добавить в свой hosts файл — `127.0.0.1 api.local` 

Собрать: `docker-compose build`

Запустить: `docker-compose up -d`

### Preparation

В `.env` файле установить следующие значения
```
APP_URL=http://api.local

DB_CONNECTION=pgsql
DB_HOST=db
DB_PORT=5432
DB_DATABASE=db
DB_USERNAME=user
DB_PASSWORD=user
```

Миграции: выполнить внутри контейнера `php artisan migrate`

### Tests
Добавлено по одному happy-path тесту на каждый роут группы `guests`

Запустить: выполнить внутри контейнера `php artisan test`

### Headers
Добавлены заголовки `X-Debug-Time` и `X-Debug-Memory`, указывающие время выполнения запроса и затраченную память

### Docs
По пути `/docs` доступна документация в виде Swagger UI. http://api.local/docs

![img.png](img.png)

### Тестовое задание
Написать микросервис работы с гостями используя язык программирования, можно пользоваться любыми opensource пакетами, также возможно реализовать с использованием фреймворков или без них.

БД также любая на выбор, использующая SQL в качестве языка запросов.

Микросервис реализует API для CRUD операций над гостем. То есть принимает данные для создания, изменения, получения, удаления записей гостей хранящихся в выбранной базе данных.

Сущность «Гость»: Имя, фамилия и телефон — обязательные поля. А поля телефон и email уникальны. В итоге у гостя должны быть следующие атрибуты: идентификатор, имя, фамилия, email, телефон, страна. Если страна не указана, то доставать страну из номера телефона +7 - Россия и т.д. Правила валидации нужно придумать и реализовать самостоятельно.

Микросервис должен запускаться в Docker.

Результат опубликовать в Git репозитории, в него же положить README файл с описанием проекта. Описание не регламентировано, исполнитель сам решает что нужно написать (техническое задание, документация по коду, инструкция для запуска).

Также должно быть описание API (как в него делать запросы, какой формат запроса и ответа), можно в любом формате, в том числе в том же README файле.

В ответах сервера должны присутствовать два заголовка X-Debug-Time и X-Debug-Memory, которые указывают сколько миллисекунд выполнялся запрос и сколько Кб памяти потребовалось соответственно.
