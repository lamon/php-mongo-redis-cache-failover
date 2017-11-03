Minimum Requirements
---------
* PHP 5.4
* [MongoDB driver](http://php.net/manual/en/mongo.installation.php#mongo.installation.nix)
* Mongo 2.6
* Redis 3

Installation
------
* $ git clone git@github.com:lamon/php-mongo-redis-cache-failover.git
* $ cd php-mongo-redis-cache-failover
* $ composer install
* $ php app/console server:run
* Open http://127.0.0.1:8000/customers in your browser (check if everything is fine)
* You can test your database operation by doing a POST into /customers/
* $ curl http://127.0.0.1:8000/customers/ -X POST -d '[{"name":"lamon", "age":31}, {"name":"dany", "age":31}]'
* Then check your MongoDB collection to see if customers were created or just call the action
* $ curl http://127.0.0.1:8000/customers/

Running tests
------
* Install PHPUnit
* In project root run: phpunit
