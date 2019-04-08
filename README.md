# Simple frameworck MVC with PHP and MySQL

A simple framework for MVC applications, totally made with pure PHP. 
The framework creates an easy, solid and fast foundation to start a 
well-organized, fast maintenance project.

Framewock has:
1. MySQL database support
2. Login and section management
3. Definition of restricted areas

## Installation

The installation is very simple, just download the project folder and 
apply to the public folder of your server or local server

After the folder is in the correct place, apply the connection information 
to your database through the file located in: Classes > class-CoreDB.php

To get a sense of how to start developing a look at my BCC_AIA_MVC project located at: https://github.com/LeoAltissimo/BCC_AIA_MVC
This project is an institutional system for the course of a university. 
It was created entirely based on this framework and uses practically all its features, such as Abstraction in connection with database, login system and sections, private access areas, among others

## Implementation

The framework can be divided into two parts, the first is the core of the system, where it does not need to be edited or changed, except for the configuration of access to the database as mentioned above.
This part consists of the root folder, folder, and classes.
 
In the functions folder is where is the starting engine of our system, responsible for making the imports and calling the main classes.

In the classes folder is where the base of every system is found, the parent objects for the MVC

And the second part is where the developer will work the system. implementing business rules, views and their use cases. The MODEL, VIEW, and CONTROLER folders.

## Development guidelines

In this part the programmer is totally free to show his field, however if he is still new in PHP development, you can take a look at the system that was quoted above https://github.com/LeoAltissimo/BCC_AIA_MVC, where I use all and only the to develop an institutional system for a university course. is an optical case study. any issuses will be happy to solve. 

May the force be with you and have a good codification

