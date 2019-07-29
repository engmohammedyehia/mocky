.PHONY: install
install: ## Install the project dependencies
	@composer install --ignore-platform-reqs

start: ## Start the Server
	@docker-compose up -d

run-with-logs: ## Start the Server with logging enabled
	@docker-compose up -d && docker logs -f mock_server_container

shutdown: ## Shutdown the Server
	@docker-compose down --remove-orphans

log: ## Show Server logs
	@docker logs -f mock_server_container

.PHONY: clean
clean: ## remove all the dependencies
	@rm composer.lock || true
	@rm -rf ./vendore || true

.PHONY: help
help:
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

.DEFAULT_GOAL := help
