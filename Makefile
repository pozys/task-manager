PORT ?= 8000

console:
	docker exec -it application php artisan tinker

build:
	docker compose build

start-app:
	php artisan serve --host 0.0.0.0 --port ${PORT}

db-prepare:
	php artisan migrate:fresh --force --seed

compose: compose-clear compose-setup compose-start

compose-start:
	docker compose up --abort-on-container-exit

compose-setup: compose-build
	docker compose run --rm app make setup

compose-stop:
	docker compose stop || true

compose-down:
	docker compose down --remove-orphans || true

compose-clear:
	docker compose down -v --remove-orphans || true

compose-build:
	docker compose build

setup: env-prepare install key db-prepare

install:
	composer install

env-prepare:
	cp -n .env.example .env || true

key:
	php artisan key:generate

test:
	php artisan test
