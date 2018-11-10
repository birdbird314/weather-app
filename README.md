weather-app
========================
Rest api to retrieve info about current weather

How to use
--------------------
Setup db with fixtures
```
php bin/console doctrine:schema:create
php bin/console doctrine:schema:update --force
php bin/console doctrine:fixtures:load
```

Users
---------------------
By default after executing `doctrine:fixtures:load` there will be one user with `ROLE_ADMIN` (username: admin, password... guess what: admin) that is able to access /admin/* routes, so he can:
* add new cities
* remove existing cities
* choose which `WeatherProvider` will be used

other users (one added by fixture, and any user you'll register) has role `ROLE_USER` which lets them view list of available cities and current weather in each of those cities.

Adding new weather providers
--------------------------------
To add new weather provider you need to add your implementation of `WeatherProvider` interface, create an alias for it in `services.yml` and add this alias to `CurrentlyUsedWeatherProvider::providerKeys`
<br> <br>
Right now we have 2 implementations:
* dummy - which responds with hardcoded value
* openWeatherMap - which fetches data from openWeatherMap.org

