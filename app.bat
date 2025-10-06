@echo off

set CONFIG=compose/docker-compose.yml
set CONTAINER=qprtech-dev-1

docker exec -it %CONTAINER% bash
