## About

This is demo app for keeping track of contacts

### Options
- list of contacts,
- display details for contact,
- new contact,
- edit contact,
- delete contact
 
### Technologies
- Laravel framework
- Doctrine
- SQLlite

### Instalation

0)	assume you have PHP 8.1.x installed & added to PATH  :)  

1)	clone the repo  
	git clone https://github.com/ngaspari/laravel-demo-app.git

2)	position into cloned dir  
	cd laravel-demo-app

3)	run composer install  
	composer install

4)	populate database  
	php artisan app:seed:contacts

5)	start developer webserver (port number can be omitted, default is 8000)  
	php artisan serve --port 9500

6)	open in browser (adjust port number if needed - from step #5)  
	http://127.0.0.1:9500
	
