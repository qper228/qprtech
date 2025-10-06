@echo off

set CONFIG=compose/docker-compose.yml
set PROJECT=qprtech

docker-compose -f %CONFIG% -p %PROJECT% down
docker-compose -f %CONFIG% -p %PROJECT% pull --include-deps
docker-compose -f %CONFIG% -p %PROJECT% build
