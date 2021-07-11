##Application

#### Installation

You can use laravel sail to run the application `/vendor/bin/sail up -d` in root directory, but there is requirement of docker installed on your machine to do so.

Otherwise you need to have PHP8 and MYSQL 8 installed if you want to use `php artisan serve`

#### Usage

I completed task with creating employees, attaching and detaching it to and from restaurants.

I didn't create roots to create restaurants because it wasn't pointed out in task description, if You want to test the app please add them to the database first.

Created simple authentication mechanism with laravel sanctum to protect routes. If you want to test it, first create user with CreateUser command `php artisan create-user` and then login `php artisan login-user`. 
Output of second command is token which should be attached to request headers as Authentication header.

I also added simple swagger documentation to EmployeeController to show you that I am familiar with a tool.

What I didn't do is seeders and notes.
To implement notes I would use one to many laravel polymorphic relation.

Considering frontend application I am more of a backend developer with basic frontend javascript knowledge which I would define as on junior level, and it would take me quite a while to refresh the knowledge, but nothing impossible to achieve.
If you are looking more for a fullstack developer I am more than happy to learn and improve my skills in the future.
