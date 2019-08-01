.PHONY: install
install: ## Install the project dependencies
	@composer install --ignore-platform-reqs

start: ## Start the Server
	@docker-compose up -d

start-log: ## Start the Server with logging enabled
	@docker-compose up -d && docker logs -f mock_server_container

shutdown: ## Shutdown the Server
	@docker-compose down --remove-orphans

log: ## Show Server logs
	@docker logs -f mock_server_container

.PHONY: shell
shell: ## Open the shell of the web container
	@docker exec -it mock_server_container bash

.PHONY: code-std
code-std: ## Standardize the PHP code according to PSR2
	@docker exec -it mock_server_container ./vendor/bin/phpcbf

.PHONY: code-chk
code-chk: ## Check the PHP code according to PSR2
	@docker exec -it mock_server_container ./vendor/bin/phpcs

.PHONY: unit-test
unit-test: ## Unit Testing
	@docker exec -it mock_server_container php -dxdebug.coverage_enable=1 ./vendor/bin/phpunit -v --colors=always ./tests

.PHONY: clean
clean: ## remove all the dependencies
	@rm ./composer.lock || true
	@rm -rf ./vendor || true

.PHONY: help
help:
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

.DEFAULT_GOAL := help
