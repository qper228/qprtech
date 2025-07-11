COMPOSE=docker-compose -f compose/docker-compose.yml
PROJECT=yii2_app

.PHONY: start
start:
	@$(COMPOSE) -p $(PROJECT) up -d

.PHONY: stop
stop:
	@$(COMPOSE) -p $(PROJECT) down

.PHONY: rebuild
rebuild:
	@$(COMPOSE) -p $(PROJECT) down -v
	@$(COMPOSE) -p $(PROJECT) build --no-cache


.PHONY: migrate
migrate:
	docker exec -it $(PROJECT)-dev-1 php yii migrate --interactive=0


.PHONY: app
app:
	docker exec -it $(PROJECT)-dev-1 bash
