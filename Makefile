INSTALL_BASE=../namedrop
SECRET=.secret
DBSECRET=`cat $(SECRET)`

install:
	cp ./*.xml ${INSTALL_BASE}/
	cp ./*.yml ${INSTALL_BASE}/
	cp ./*.json ${INSTALL_BASE}/
	cp ./public/* ${INSTALL_BASE}/public/
	cp ./src/* ${INSTALL_BASE}/src/
	cp ./templates/* ${INSTALL_BASE}/templates/
	cp  -r ./tests/* ${INSTALL_BASE}/tests/
	sed "s/{{ webpassword }}/${DBSECRET}/g" propel.yml > ${INSTALL_BASE}/propel.yml
	cd ../namedrop && ./vendor/bin/propel --overwrite sql:build
	cd ../namedrop && ./vendor/bin/propel model:build
	cd ../namedrop && ./vendor/bin/propel config:convert

start:
	php -S 0.0.0.0:8080 -t ../namedrop/public ../namedrop/public/index.php

dbconn:
	mysql -u app -h localhost -p namedrop
