# Mini E-Commerce

Adalah project latihan aplikasi e-commerce sederhana.

Set configuration Environment
create file ```.env```
copy ```.env.example``` to ```.env``` or use bash
```bash
cp .env.example .env
```

Lakukan setting database pada ```.env```

```bash
composer install
php artisan key:generate
```

Migrate database
```bash
php artisan migrate
```

Passport Install
```bash
php artisan passport:install --uuids
> type yes [enter]
```

Run application
- Setup vhost and host (webservice)
  OR
- Run php artisan serve
