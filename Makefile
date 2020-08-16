up:
	docker-compose up -d
build:
	docker-compose build --no-cache --force-rm
down:
	docker-compose down
logs:
	docker-compose logs
migrate:
	docker-compose exec qiita_php php artisan migrate
seeder:
	docker-compose exec qiita_php php artisan db:seed
jobs_seeder:
	docker-compose exec qiita_php php artisan db:seed --class=JobsSeeder
authors_seeder:
	docker-compose exec qiita_php php artisan db:seed --class=AuthorsSeeder
batch_exec:
	docker-compose exec qiita_batch python py/article.py
insert_authors:
	docker-compose exec qiita_php php artisan insertAuthors
insert_tags:
	docker-compose exec qiita_php php artisan insertTags
php:
	docker-compose exec qiita_php bash
test:
	docker-compose exec qiita_php php artisan test
clear:
	docker-compose exec qiita_php php artisan config:clear
	docker-compose exec qiita_php php artisan cache:clear
help:
	cat ./Makefile