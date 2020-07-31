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