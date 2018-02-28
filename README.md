# BachelorProj
Bachelor project repository for Henrik Reff Snilsberg, Ole Martin Ibsen og Fredrik Paulsen

## General Information
Once set up, one can go to either localhost/oblig3/public or localhost/oblig3/public/home 
to get to the frontpage.

The website is optimized for 1920x1080, but should also look fine on lower resolutions.

If one wishes to make use of the user accounts in the database seeds, then the login information
can be found in the database/seeds/UserTableSeeder.php file.

## Setting up the project---
For this project we've used xampp, so this guide will be specific to that software.

Step 1:
	Copy the project folder to htdocs in the xampp folder.

Step 2:
	Install composer

Step 3:
	Open the command line/terminal and navigate to the project folder in htdocs.
	Once there, type 'composer install' and hit enter.

Thats it!

## Setting up the database

Step 1:
	Update the .env file in the project folder with the necessary database information.

Step 2:
	Open the command line/terminal and navigate to the project folder in htdocs.
	Once there, type 'php artisan make:database'. 
	This will create the database based on the details in the .env file, as well as run
the necessary migrations.

Step 3 (Optional):
	During the project, we've operated with a simple test environment.
	Simply type 'php artisan db:seed' to fill the database with dummy data.



