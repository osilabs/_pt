INSTALL_BASE=../namedrop
SECRET=.secret
DBPassword=`cat $(SECRET)`

dbconn:
	mysql -u app -h localhost -p namedrop

full: pull install start

install:
	cp ./*.xml ${INSTALL_BASE}/
	cp ./*.yml ${INSTALL_BASE}/
	cp ./*.json ${INSTALL_BASE}/
	cp ./public/* ${INSTALL_BASE}/public/
	cp ./src/* ${INSTALL_BASE}/src/
	cp ./templates/* ${INSTALL_BASE}/templates/
	cp  -r ./tests/* ${INSTALL_BASE}/tests/
	sed "s/{{ webpassword }}/${DBPassword}/g" propel.yml > ${INSTALL_BASE}/propel.yml
	cd ${INSTALL_BASE} && ./vendor/bin/propel --overwrite sql:build
	cd ${INSTALL_BASE} && ./vendor/bin/propel model:build
	cd ${INSTALL_BASE} && ./vendor/bin/propel config:convert
	cd ${INSTALL_BASE} && composer dump-autoload --optimize # do after build

pull:
	git remote update; git pull --rebase

start:
	php -S 0.0.0.0:8080 -t ../namedrop/public ../namedrop/public/index.php

test:
	cd ../namedrop && ./vendor/bin/phpunit
