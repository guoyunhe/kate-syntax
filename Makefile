css-base=syntax/css-properties.php syntax/css-values.php syntax/css-functions.php \
syntax/css-pseudoclasses.php syntax/css-entities.php

install: build
	install -d ~/.local/share/katepart5/syntax
	install syntax/*.xml ~/.local/share/katepart5/syntax

build: syntax/css.xml syntax/less.xml syntax/pug.xml

syntax/css.xml: syntax/css.php $(css-base)
	php syntax/css.php | xmllint --format - > syntax/css.xml

syntax/less.xml: syntax/less.php $(css-base)
	php syntax/less.php | xmllint --format - > syntax/less.xml

syntax/pug.xml: syntax/pug.php syntax/html-entities.php
	php syntax/pug.php | xmllint --format - > syntax/pug.xml

test-css: syntax/css.xml
	kwrite tests/css/standard.css

test-less: syntax/less.xml
	kwrite tests/less/standard.less

test-pug: syntax/pug.xml tests/pug/standard.pug
	kwrite tests/pug/standard.pug
