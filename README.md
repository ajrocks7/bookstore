# Indexing Products using Elasticcloud in Laravel

In this guide, we will be using Elasticcloud to index our products in the cloud.

## Prerequisites
- Import the database from the folder `dbdata`
- Setup the Laravel project
- npm and php installed

## Steps
1. Go to the project directory and open a terminal window.

 Run `composer install` and wait till all packages gets installed.

 Once all packages gets installed,create an .env file and configure your DB Details

 Now Run `php artisan key:generate`

Now open another terminal with the project directory and input command.
`npm install && npm run dev`

We are using vite so have to install it by the above command.

Once this all done.Start serve your application
 
`php artisan serve` to start the Laravel project.

2. Login to the admin panel by clicking on "Login" on the homepage.

3. Enter the following credentials to log in:
   - Email: `admin@gmail.com`
   - Password: `12345678`

4. Once logged in, click on "Products" to access the product list page.

5. To create products using an API call, click on "Bulkcreate". This will create 100 products for you.

6. You can create, update, or delete products from the admin panel.

7. Once the products have been created, go to the homepage and search for products using the search bar.

8. You can search and filter products from the homepage.

Note: This project does not use Vue JS,i have used only jquery.
i have worked on vue js only one project a year ago so i prefered to use jquery,
but i will be able to revamp all the basics in short time,
my skill is quick learning.
Hope this task impressed You :)

Happy coding!