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

Execute migration file
※Migration file cannot be executed in split

```bash
php artisan migrate
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
```bash
$ php artisan db:seed;
```

##### Seeder Option
◆If you want to run only a particular seeder

```bash
$ php artisan db:seed --class={SeederClassName}Seeder;
```

◆If you want to return the seeder with the migration

```bash
$ php artisan migrate:refresh --seed
```

◆Clear all data and run the seeder each time

```php
public function run()
{
    // データのクリア
    DB::table('table_name')->truncate();

    // データ挿入
        ・・・・・・
}
```

### Make Resource
detail: https://readouble.com/laravel/5.5/ja/eloquent-resources.html

```bash
$ php artisan make:resource Users --collection
```


### Make Batch Class
detail: https://readouble.com/laravel/5.5/ja/scheduling.html

in Creaing src/app/app/Console/Commands

```bash
$ php artisan make:command InsertAuthorsCommands --command="insertAuthors"
```

After the above command ends


After the above command ends, Add class define in app/Console/Kernel.php

```php

    protected $commands = [
        \App\Console\Commands\Inspire::class,
        \App\Console\Commands\InsertAuthorsCommands::class, // add
    ];
```

Exec Command

```bash
$ php artisan insertAuthors
```
