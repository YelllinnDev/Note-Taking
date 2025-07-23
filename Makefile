artisan := docker compose exec --user www-data app php artisan

all: containers
	${artisan} storage:link \
	&& ${artisan} key:generate \
	&& ${artisan} migrate \
	&& ${artisan} db:seed

containers: dependencies
	docker compose up -d --build

dependencies: php node

php:
	docker run --rm --interactive --tty \
	--volume $$PWD:/app \
	--volume $${COMPOSER_HOME:-$$HOME/.composer}:/tmp \
	composer install --ignore-platform-reqs

node:
	docker run --rm --interactive --tty \
	--volume $$PWD:/app \
	--workdir /app \
	node:lts-alpine npm install -g corepack \
	&& corepack enable \
	&& corepack prepare pnpm@latest --activate \
	&& pnpm install
