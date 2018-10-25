#!/usr/bin/env bash
CMD=${1:-help}
shift

set -eu

PROJECT_NAME=workbook

usage () {
cat <<EOF
Development environment helper script

Usage: bin/dev command [arguments]

Available commands:
  init       Initializes dev environment
  build      Rebuilds the docker image for development
  run_single Run a standalone container for development

  start      Starts or updates the docker stack
  stop       Stops the docker stack
  status     Views the status of the docker stack
  shell      Starts a shell in the docker image

  dbdump     Creates an MySQL Dump

EOF
}

GREEN=`tput setaf 2`
RESET=`tput sgr0`

log_status () {
	echo -e "\n${GREEN}$@${RESET}"
}

init () {

	log_status "Building image ..."
	build


	log_status "Starting stack ..."
	start_stack

	log_status "Please make sure that 'pm.test' is is in your hosts file"
	log_status "You can view load balancer status at http://localhost:8080"
}

build () {
	docker build -t projectmanagement:dev --no-cache -f ./docker/dev/Dockerfile .
}

build_db () {
    (cd ./docker/testdb && ./make.sh)
}

run_single() {
    docker run --name pm_dev -d -t -i -v .:/www-root  -e VIRTUAL_HOST=pm.test  --link $1:mysql projectmanagement:dev
}


start_stack () {
	COMPOSE_FILE=docker/dev/docker-compose.yaml
	docker stack deploy -c ${COMPOSE_FILE} ${PROJECT_NAME}
}

stop_stack () {
	docker stack rm ${PROJECT_NAME}
}

shell () {
	instance=${PROJECT_NAME}_web.1.$(get_running_instance)
	if [[ -z "$@" ]]; then
		docker exec -it $instance /bin/bash
	else
		docker exec  $instance $@
	fi
}
dbdumb() {
    instance=${PROJECT_NAME}_db.1.$(get_running_db_instance)
    docker exec  $instance "sh -c 'exec mysqldump workbook -uroot -p\"root\"' > /tmp/backup.sql" $@
}


get_running_instance () {
	docker service ps -f "name=${PROJECT_NAME}_web.1" ${PROJECT_NAME}_web -q --no-trunc | head -n1
}
get_running_db_instance () {
	docker service ps -f "name=${PROJECT_NAME}_db.1" ${PROJECT_NAME}_db -q --no-trunc | head -n1
}


case $CMD in
	init)      init;;
	build)     build;;
	run_single) run_single $@;;

	start)     start_stack;;
	status)    docker stack ps -f "desired-state=running" ${PROJECT_NAME} $@;;
	shell|sh)  shell $@;;
	stop)      stop_stack;;

	dbdump)    dbdumb ;;


	*) usage;;
esac
