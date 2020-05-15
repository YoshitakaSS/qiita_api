### Task Shedulers List
detail: https://packagist.org/packages/hmazter/laravel-schedule-list


```
+------------+---------------------+-----------------------+-------------+
| expression | next run at         | command               | description |
+------------+---------------------+-----------------------+-------------+
| 0 10 * * * | 2020-05-15 10:00:00 | command:insertAuthors |             |
+------------+---------------------+-----------------------+-------------+
```


how to install
```bash
$ composer require hmazter/laravel-schedule-list --dev
```


usage

```bash
php artisan schedule:list
```
