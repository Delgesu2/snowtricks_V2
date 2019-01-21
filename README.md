# snowtricks_V2

New version of OpenClassrooms project n°6

Community site for snowboard fans
---------------------------------
A Symfony project validated in January 2019

Getting started
---------------
You can download the project, or clone it with Git by using the green button "Clone or download". You can run it on your
 local machine for development and testing purposes.
 
Prerequisites
-------------
  - PHP 7.2.3
  - MySQL 5.6.35
Apache or you can use the intern Symfony server engine typing: `php bin/console server:run
`

Installing
----------
For installing the project, you have to clone or download it.
For running it on your local machine, you can install MAMP 
(or WAMP for Windows, or LAMP for Linux), and put it in the 
htdocs (or www) file.
 
1. Execute the command `composer update` to update the dependancies.
2. Execute `php bin/console doctrine:database:create` and 
`php bin/console doctrine:schema:update --force` to create database
and all the entities.
3. Execute `php bin/console doctrine:fixtures:load` to download some tricks.
 
Now, you can go on [http://localhost/](http://localhost/) and use the application !
(Or type `php bin/console server:run` in the console.)
  
Built with
----------
* [Bulma](https://bulma.io/) : free, open source & modern CSS framework based on Flexbox
* [Symfony](https://symfony.com/): High performance PHP framework for web development

Add-ons
-------
* [PHPUnit](https://phpunit.de/): the PHP testing framework

Here is the address for **Snowtricks** : [p6snowtricks.devxdemo.eu](p6snowtricks.devxdemo.eu)
