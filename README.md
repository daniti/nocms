# Installation
- Clone the repository
- Copy ```admin-config.example.php``` to ```admin-config.php```, open it and type a salt and a username
- Run in terminal ```php sha.php <password>``` and copy the hash into ```admin-config.php```
- Copy ```/content/example.html``` to ```/content/home.html```
- Login to /admin and click on "Republish All"

# How does it work
The core of everything is inside /content/.
The html files correspond to the urls of the websites (example.html corresponds to ```website.com/example```).
Each file has an html comment on top with some meta data used to build the page, including which template to use.
Templates are inside the /templates/ folder.
You can run ```php pub.php``` to publish the whole website, or ```php pub.php file``` to publish a single page.
You can run ```php watch.php``` to publish the pages as you edit them.

You need to create a content called ```home.html``` and publish it 

**The documentation is a work in progress, feel free to contribute...**
