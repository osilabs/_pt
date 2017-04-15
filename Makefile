INSTALL_BASE=../namedrop

install:
	cp ./*.xml ${INSTALL_BASE}/
	cp ./*.yml ${INSTALL_BASE}/
	cp ./*.json ${INSTALL_BASE}/
	cp ./public/* ${INSTALL_BASE}/public/
	cp ./src/* ${INSTALL_BASE}/src/
	cp ./templates/* ${INSTALL_BASE}/templates/
	cp  -r ./tests/* ${INSTALL_BASE}/tests/

start:
	php -S 0.0.0.0:8080 -t ../namedrop/public ../namedrop/public/index.php
