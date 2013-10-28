geekhub-advphp-hw-3
===================

Overview
--------

The program simulates a life of live creatures. Executes as CLI and Web application.

Now is implemented these of live creatures:

 1. Spherical horse in the vacuum

 2. Spherical cat at home (as home pet)

Installing
------

### Cloning the repository ###

Repository clones with one simple command:

~~~
$ git clone git@github.com:paulmaxwell/geekhub-advphp-hw-slice-1.git
~~~

If you need to clone release version, just use:

~~~
$ git clone -b homework-3 git@github.com:paulmaxwell/geekhub-advphp-hw-slice-1.git
~~~

### Installing dependencies ###

Just after cloning the repository install all of the dependencies via composer:

~~~
$ composer install
~~~

This command should be executed at the project root.

Using
------

### Launch as CLI ###

Test programs located in the **cli/** directory, they must be executed as:

~~~
$ cd cli/
$ php <program>.php
~~~

Program shows life status in every second.

### Setting up web server ###

Just point server's DocumentRoot into directory **webroot/** and enjoy.
