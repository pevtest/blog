
To set up the Blog project, you should perform the following steps
Open the project:
https://github.com/pevtest/blog/
1. Click on the green “clone or download” button to Clone GitHub repository

2- On you local environment, open a command line and type 
cd projectName 
3- Install Composer dependencies:
/vendor folder is not under version control. You should run composer install, 
otherwise, PHP will throw a critical error saying that autoload.php could not be found.
composer install

6. Create your .env file
For security reasons .env files are not generally under version control. Make a 
copy of the .env.example file and create a .env file. Then, we are going to 
fill out this file to configure the database.

cp .env.example .env

7- Generate an app encryption key
If you don't have a value generated for the APP_KEY constant
 (in the .env file), you should execute step 7, otherwise, go to step 8
Run the following command to generate the app encryption key. Laravel requires 
you to have an app encryption key. If ou check the .env file, you'll see a 
random string of characters in the APP_KEY field.

php artisan key:generate

8- Create an empty  database called 'blog'
9- Open the .env file and set the following values:
DB_HOST, DB_PORT
DB_DATABASE=blog
DB_USERNAME=your_database_user
DB_PASSWORD=your_user_password

10- Execute the migration
php artisan migrate

11-Laravel includes a simple method of seeding your database 
with test data using seed classes. 

php artisan db:seed

Note:
You may also seed your database using the migrate:fresh command, which will drop
 all tables and re-run all of your migrations. This command is useful for 
completely re-building your database:

php artisan migrate:fresh --seed

12-To run the server and be able to see the site: