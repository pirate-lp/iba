# Intearactive Book Publisher (IBA)

Interactive Book Publisher [an alternative to CMS, a project on top of Laravel ...]

# Digest Getting Started Guide

## Before start

You need to be familiar with Laravel (a bit) and be able to get your web projects up & running on your desired environment ...

## Quick start

- Install Laravel 5.5
- Install auth, and stup a user to be your admin
- Install Passport (follow the instructions in Laravel Documentation)
- Require LILPLP\IBA
- Require LILPLP\IBAsBlog
- install both
- run the command `php artisan vendor:publish --tag=public --force` to get everything published to your project
- run the command `php artisan vendor:publish` (and choose each) libraries, so the `config/` folder will contain `iba.php` and `iba-blog.php` and fill the respective fields, for example for IBAsBlog, you need to add "post" to the `iba.php::book_types` array.
- Run the migrations
I guess you should be set and ready to go
Enter 'http://your-project.com/api/home and you should be able to access the backend app

**Hey, give us a star to motivate us write more documentation, or alternatively become a contributor ...**

## More info

- please look at [our main page](http://lostideaslab.com/pirates-lost-pearl/interactive-books-atelier/)
