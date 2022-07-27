PROJECT=cms

.PHONY: start
start:
	@docker-compose -p $(PROJECT) up -d

.PHONY: stop
stop:
	@docker-compose -p $(PROJECT) stop

.PHONY: rebuild
rebuild:
	@docker-compose -p $(PROJECT) down
	@docker-compose -p $(PROJECT) pull --include-deps
	@docker-compose -p $(PROJECT) build
