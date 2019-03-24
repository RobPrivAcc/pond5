# Pond5 interview test code
## Project objectives

The service should provide the following rest API and must be written in Python or PHP:

- GET /ping request should return “pong”.
- GET /system request should return JSON object with service version and system information.
- GET /mediainfo/<id> should return a JSON object with image filename, size, dimensions and image title.
    
 I tryed to keep this code as simple and small as possible. Didn't use any external libs, all functions and methods are provided from PHP.
    
## Project content

There are 4 files included in this project

* htaccess.txt (redirecting routes)
* index.php (web service landing file, calling request)
* requestClass.php (class handling all requests)
* README.md (this file)


## SETUP

### Setting PHP server
- If you have web server running on your machine please [click here](#setting-up-files-on-server)
- If server is not installed
    - **Windows** please go to https://www.apachefriends.org/index.html download and install XAMPP server
    - **Linux** depending from distribution please find LAMP server and install it _(example for Ubuntu https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-on-ubuntu-16-04#step-2-install-mysql)_

### Setting up files on server
On your web server please create folder ie 'pond5' so URL will be 
```
https://your.domain.com/pond5 or https://localserverName/pond5
```

After downloading zip from github please extract files and copy them to server to folder you created.
**Please change file name from '_htaccess.txt_' to '_.htaccess_' (make sure there is no extension)**

file structure after:

- server address
    - pond5
        - .htaccess
        - index.php
        - requestClass.php
        - README.md

## How to use

There are three requests implemented

* */ping*
```
https://your.domain.com/pond5/ping or http://localhost:8080/pond5/ping - will get JSON response 'pong'
```
* */system* 
```
https://your.domain.com/pond5/system or http://localhost:8080/pond5/system - you will get JSON response containing
```
       - version (PHP version)
       - server name
       - server software
       - browser (browser type)
* */mediainfo/&lt;id&gt;* -> (**Please replace _&lt;id&gt;_ with media number from https://www.pond5.com website**)
    ```
    https://your.domain.com/pond5/mediainfo/<id>;
    ```
    or
    ```
    http://localhost:8080/pond5/mediainfo/<id>;
    ```
    you will get JSON response containing
    	
    - title	
    - dimensions	
      - width
      - height
    - filename
    - file size in kB
    
    **Example response for media id '_44585699_'**
    ```
    http://localhost:8080/pond5/mediainfo/44585699
    ```
    or
    ```
    https://your.domain.com/pond5/mediainfo/44585699
    ```
    
    - title	"STS-27, Orbiter Atlantis, Liftoff"
    - dimensions	
       - width 480
       - height 308
    - filename	"sts-27-orbiter-atlantis-liftoff-photo-044585699_iconl.jpeg"
    - file size in kB	17.7
## Author

Robert Kocjan <br />
email: rkocjan@gmail.com
