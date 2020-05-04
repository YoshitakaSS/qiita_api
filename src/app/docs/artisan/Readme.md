## Laravel Aritsan Cmd

### Make Contoroller

```bash
php artisan make:controller {Controller_Name}
```

### Make Request

```bash
php artisan make:request {Request_Name}
```

### Make Model

```bash
php artisan make:model {Model_Name}
```

If you also want to create a migration

```bash
php artisan make:model {Model_Name} --migration
```


#### Migration Filed List
Detail: https://readouble.com/laravel/5.8/ja/migrations.htmlp

For Example...
```php
$table->integer('filed name');
$table->bigInteger('filed name');
$table->float('filed name');
$table->char('filed name');
$table->string('filed name');
$table->text('filed name');
$table->longText('filed name');
$table->boolean('filed name');
$table->date('filed name');
$table->dateTime('filed name');
```

### Make Seeding

Seeding is dummy data to use migration
Initially, the table has no records, so we'll use the seed function to create dummy data.

```bash
php artisan make:seeder {Table_Name}Seeder
```

#### To use {Table_Name}Seeder
You need to register with DatabaseSeeder to execute the seeder file you created

```php
public function run()
{
    $this->call(SeederClassName::class);
}
```

Excute Seeding
```
php artisan db:seed;
```
