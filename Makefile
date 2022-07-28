PROJECT=cms

.PHONY: start
start:
	@docker-compose -p $(PROJECT) up -d
	@docker exec -it cms_php_1 composer install

.PHONY: stop
stop:
	@docker-compose -p $(PROJECT) stop

.PHONY: rebuild
rebuild:
	@docker-compose -p $(PROJECT) down
	@docker-compose -p $(PROJECT) pull --include-deps
	@docker-compose -p $(PROJECT) build

.PHONY: remove
remove:
	@docker rm $(PROJECT)_db_1
	@docker rm $(PROJECT)_php_1
	@docker rm $(PROJECT)_phpmyadmin_1