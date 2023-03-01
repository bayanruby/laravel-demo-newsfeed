include .env

up:
	docker compose up -d

down:
	docker compose down

build:
	docker compose up --build -d

reload-fpm:
	docker exec ${APP_ID}_app /bin/bash -c "kill -USR2 1"

reload-nginx:
	docker exec ${APP_ID}_webserver nginx -s reload
