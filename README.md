# BachelorProject - Colourlab Logging system
## Authors

* [Henrik Reff Snilsberg](https://github.com/HSnils)
* [Ole Martin Ibsen](https://github.com/omieh)
* [Fredrik Paulsen](https://github.com/freddypauls)

## Background

This project is made for the **ColorLab at NTNU Gjøvik**. The representative for the Color Lab and our client is *Marius Pedersen*. 

Our supervisor for the Bachelor project is *Carlos Vicient-Monllaó*.


## NTNU Color Lab and their needs
The Colorlab at NTNU Gjøvik is a research group that are currently specializing in colour science, colour imaging, image processing, and video processing. They have several rooms on campus dedicated to research and practical lectures. These rooms contain a lot of equipment, both mobile and immobile. The rooms and equipment are used by both students and employers, but also guests such as researchers that come from other locations than NTNU Gjøvik. 

The Colorlab has been using a book for 17 years when booking and cataloging the use of equipment. The facilities consists of different rooms, while the book is located in only one room. This requires someone who wants to book equipment to leave their current location and go look through the book, which is both time-consuming and inefficient. Furthermore, if someone wants to book a room they need to send emails to all participants of the Colorlab to notify them that the room is occupied. 

The Colorlab also needs to log hours that has been used in the lab and with equipment to know what is being used alot and what isn't being used as frequently. When there is a project with EU it is required to log all hours you have worked on the project.

The administrator can then see this log and figure out what equipment they need more of, — this will also help making an argument to the school administration as to why they could need more equipment.

Another issue brought up by the employer is that equipment which is broken or missing need to be brought to their attention. Currently there is no easy way to report this, which can cause problems when the equipment is needed by the Colorlab.

## The solution
To solve these issues, the Colorlab want a new, responsive system that works on all devices and is easy and fast to use to ensure that everyone uses it. They are going to put tablets outside (and inside) the labs so that you can easily log your usage even if you haven't booked it prior. The system needs to contain different roles so that they can log what equipment or rooms different roles use the most. They want it to be flexible for administrators to add new equipment and rooms if necessary.

## Built With

* [Laravel](https://laravel.com/) - The back-end framework
* PHP
* SQL (Eloquent ORM)
* [getMDL.io](http://getmdl.io) - A modern responsive front-end framework based on Material Design 
* [JQuery-UI](https://jqueryui.com/) - Mainly used JQuery which is a JavaScript Library
* JavaScript
* AJAX
* HTML5
* CSS3

## General Information
Once set up, one can go to either ```localhost/Bachelorproj/public/``` or ```localhost/Bachelorproj/public/home``` 
to get to the frontpage.

If one wishes to make use of the user accounts in the database seeds, then the login information
can be found in the ```database/seeds/UserTableSeeder``` php file.

## Setting up the project
For this project we've used **XAMMP** and **php artisan serve** as our server, so this guide will be specific to that software.

Step 1:
- Copy the repository/project folder to htdocs in the xampp folder.

Step 2: Install composer
- Open the command line/terminal and navigate to the project folder in htdocs.
- Once there, type ```composer install``` and hit enter.

Step 3: Install the package for creating CSV files.
- Open the command line/terminal and navigate to the project folder in htdocs.
- Once there, type ```composer require league/csv``` and hit enter

Step 4:
- Update the .env file in the project folder with the necessary database information.

Step 5: Start server.
- Start XAMPP mySQL and apache servers from the XAMPP application,
	or navigate to the folder using commandline/terminal and type:
	```php artisan serve``` and hit enter.
Step 5: 
- Open the command line/terminal and navigate to the project folder in htdocs.
- Once there, type ```php artisan make:database```. 
- This will create the database based on the details in the .env file, as well as run
the necessary migrations.

Step 6 (Optional): 
- During the project, we've operated with a simple test environment.
- Simply type ```php artisan db:seed``` to fill the database with dummy data.

Thats it!
