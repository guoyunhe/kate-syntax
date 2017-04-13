install: build
	install -d ~/.local/share/katepart5/syntax
	install syntax/*.xml ~/.local/share/katepart5/syntax

build: syntax/css.xml syntax/less.xml

syntax/css.xml: syntax/css.php css-base
	php syntax/css.php | xmllint --format - > syntax/css.xml

syntax/less.xml: syntax/less.php css-base
	php syntax/less.php | xmllint --format - > syntax/less.xml

css-base: syntax/css-properties.php syntax/css-values.php syntax/css-functions.php \
syntax/css-pseudoclasses.php syntax/css-entities.php

test-css:
	kwrite tests/css/standard.css

test-less:
	kwrite tests/less/standard.less
