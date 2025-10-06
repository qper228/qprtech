@echo off

set CONFIG=compose/docker-compose.yml
set PROJECT=qprtech

docker-compose -f %CONFIG% -p %PROJECT% up -d
