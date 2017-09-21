# SeleniumSimpleSample_PHP
## Installation on Windows
* Load and install 'php VC11 x64 Thread Safe'. Add to system PATH.
[link](http://php.net/manual/ru/install.windows.legacy.index.php#install.windows.legacy.manual)
* Install msvcr110.dll if needed.
[link](https://www.microsoft.com/ru-ru/download/confirmation.aspx?id=30679)
* Install Composer-Setup.exe
[link](https://getcomposer.org/)
* Load server-standalone 2.53.1
[link](http://selenium-release.storage.googleapis.com/index.html?path=2.53/)
* Load and install java jdk.
[link](http://www.oracle.com/technetwork/java/javase/downloads/jdk8-downloads-2133151.html)
* Load compatible with php 5.6 version of phpunit 5.7.21. Place under C:\phpunit-5.7
[link](...)  
*Run to check*
> C:\phpunit-5.7>php phpunit-5.7.21.phar --version  
> PHPUnit 5.7.21 by Sebastian Bergmann and contributors.
* Load chromedriver and add to PATH
[link](...)

## Configuration
* Create phpunit.cmd and add to system PATH for easy use
[link](https://phpunit.de/manual/current/en/installation.html)
> cd C:\phpunit-5.7  
> echo @php "%~dp0phpunit.phar" %* > phpunit.cmd  
> exit  

* Start selenium-server for Chrome
> java -Dwebdriver.chrome.driver=C:\webdriver\chromedriver.exe -jar C:\selenium-server-standalone-2.53.1.jar

* Compile in repository composer.json (was taken from facebook/php-webdriver)
> composer install

## Execution

* Run test
> php C:\phpunit-5.7\phpunit-5.7.21.phar Test.php

## Allure
1. xml generated automatically after test run
2. to generate allure report use allure-comandline [link](https://github.com/allure-framework/allure1/wiki#generating-a-report)

![Generated report](https://github.com/alexKazarin/SeleniumSimpleSample_PHP/blob/allure/build/allure-example.jpg)

## TODO: organize PageObj structure
