<p align="center">
    <a href="https://qpr.technology" target="_blank">
        <img src="./web/logo.png">
    </a>
    <h1 align="center">Yii 2 Based Content Management System</h1>
    <br>
</p>

[Yii 2](http://www.yiiframework.com/) Based CMS is a good-to-go ground for you future website in Docker container. It contains the most 
common core features required for web-site building. Compatible with SEO and multiple languages. 

Out-the-box website contains the basic example features including admin user login/logout, contact page and blog.

DASHBOARD STRUCTURE (CRUDs)
-------------------

      Users             manage users/assign admin permission to a user
      Languages         manage languages/add new languages to the website
      Site sections     manage top & bottom navigation/add new sections to navigation
      Pages             manage content/add new pages/assign a home page
      Blog              manage content/add posts to the blog
      Themes            upload Bootstrap themes for the website (using css & js files)
      Settings          basic website settings/set up a name for website/theme/etc. 
      Social networks   manage social networks icons in website footer
      CSS               edit CSS file applied for the website
      Robots.txt        edit robots.txt file in SEO purposes
      Uploads           upload files to your website
      Contacts          see contact data left in contact form



REQUIREMENTS
------------

- Docker
- Docker compose


INSTALLATION
------------

### Install via Docker

If you do not have [Docker](https://www.docker.com/get-started/), you may install it by following the instructions
at [docker.com](https://www.docker.com/get-started/).

Clone files from the repository:
```shell
git clone https://github.com/qper228/qprtech.git
```

Start container within your working directory:
~~~
make start
~~~

To stop container:

~~~
make stop
~~~

To rebuild container:

~~~
make rebuild
~~~


CONFIGURATION
-------------

### Sendgrid
You can specify ```SENDGRID_API_KEY``` variable in ```.env``` file in order to send emails with SendGrid

### Shortcodes
You can render built-in components on your page content. Here is a list of all available shortcodes:
- ```{{ blog }}``` - renders a grid with yours posts
- ```{{ breadCrumbs }}``` - renders breadcrumbs
- ```{{ contactForm }}``` - renders a contact form
- ```{{ loginForm }}``` - renders a login form

**NOTES:**
- Probably you might need to set up permissions for the container:
```shell
sudo chown -R www-data:www-data ./web
```
