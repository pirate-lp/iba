# Intearactive Books' Atelier (IBA)

Interactive Books' Atelier, an alternative to conventional CMS, a highly extensible package for Laravel opening doors of unlitmed possibilities to design and develop an _interactive book_ (= website).

By [Hossein]
------

# What is in the box

- **Basics**
    - A Laravel 5.5 package
    - Example packages: so you can see how it IBA's funcationality can be implemented
- **Details (standards used)**
    - Multiple content (page) type
    - Built in static website generation
    - HTML and Markdown support
    - Hybrid storage: Database and Flatfile architectures combined
    - image and `.mp4` support
- **Best to combine with**
    - Laravel project
    - VueJS or any other api-style front-end manipulation for the website
- **what is not there**
    - `delete function`: cuz we believe even bad works that have been published in the past should be presereved for the purpose of archiving the past, of course, if you disagree you can write the function yourself
    
-------

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

-------

