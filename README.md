# Template

This template provides you with the following:

* Inertia w/ SSR running on AWS Lambda
* Typescript everywhere
* Tailwind
* PHPStan / Pest / Pint
* Updated stubs (removes the `down` migration, useless PHPDoc)
* Removes the `routes/console.php` file.
* Remove the `test/Unit` directory and the associated configuration (write integration tests instead!)
* Removes any PHPDoc that does not provide any additional type information
* **WARNING:** By default, trusts all proxies. see `app/Http/Middleware/TrustProxies.php` to change that.
* Removes `public/.htaccess`
