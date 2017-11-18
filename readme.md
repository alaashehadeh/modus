the application built by laravel framework
to install the application run
composer update
composer dump_autoload

at the root of the application

the structure of the classes as the following:
- Connectors (webservice layer) exists at app/Http/Connector
- Helpers (DTO layer) exists at app/Http/Helpers
- controllers (Businuess layer) exists at app/Http/Controllers

the routes exist at "Routes/web.php"
usually for RESTFUL API i put it at "Routes/api.php" but the routes should start with "api/"
as you requested to use routes without "api/" i moved to "Routes/web.php" but i stoped the CSRF protection to can enable post requests

