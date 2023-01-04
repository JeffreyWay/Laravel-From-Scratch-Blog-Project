# Laravel From Scratch Blog Demo Project

http://laravelfromscratch.com

## Installation

First clone this repository, install the dependencies, and setup your .env file.

```
git clone git@github.com:JeffreyWay/Laravel-From-Scratch-Blog-Project.git blog
composer install
cp .env.example .env
```

Then create the necessary database.

```
php artisan db
create database blog
```

And run the initial migrations and seeders.

```
php artisan migrate --seed
```

## Further Ideas

Of course we only had time in the Laravel From Scratch series to review the essentials of a blogging platform. You can certainly take this many 
steps further. Here are some quick ideas that you might play with.

1. Add a `status` column to the posts table to allow for posts that are still in a "draft" state. Only when this status is changed to "published" should they show up in the blog feed. 
2. Update the "Edit Post" page in the admin section to allow for changing the author of a post.
3. Add an RSS feed that lists all posts in chronological order.
4. Record/Track and display the "views_count" for each post.
5. Allow registered users to "follow" certain authors. When they publish a new post, an email should be delivered to all followers.
6. Allow registered users to "bookmark" certain posts that they enjoyed. Then display their bookmarks in a corresponding settings page.
7. Add an account page to update your username and upload an avatar for your profile.


## Docker (with -Compose) Setup

Docker and Docker Compose allow for an easier way to standup this demo application. We will create 3 containers (app, db, nginx) in order to get all this sample app stood up using Docker. 

To use `docker-compose up -d` in order to spin up the containers. We will first need to get a command prompt on the `app` container to generate a key and clear the cache. This can be done by running the following commands:

```
docker-compose exec app bash
```

Once you have a terminal on this container then you can run the following commands. 
```
php artisan key:generate

php artisan config:cache
```

Next we need to connect to the database container and create a user that we can use to migrate and seed the database. 

```
docker-compose exec db bash

mysql -u root -p laravel_web
Enter password: <password you create in docker-compose.yml>
```

After that, we create a mysql user and password for the laravel_web database for the project. This must be the same details that are specified in the `.env` file. 
```
GRANT ALL ON laravel_web.* TO 'laraveluser'@'%' IDENTIFIED BY '<laravel_docker_password>';

FLUSH PRIVILEGES;
```

Finally, lets get terminal access on the `app` container and use it to migrate and seed the database. 

```
php artisan migrate --seed
```