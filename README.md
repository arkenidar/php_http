# php_http

It uses HTTP's request/response model, both for JSON API and for templatized MVC. It supports hard-coded input e.g. for testing. It is written in PHP7 with no special dependancies. Run with: "sudo php -S 0.0.0.0:88" (after going into the project directory) or use "php -a".

Features:
- it has some routing
- it can output JSON or HTML
- it uses PHP for templating
- it handles POST and other HTTP verbs
- a view can have sub-views
- it works with PHP's built-in server
- it can be used with PHP's interactive mode ("php -a")

In a command prompt:
- run "git clone https://github.com/arkenidar/php_http.git"
- run "cd php_http"
- run "sudo php -S 0.0.0.0:88" # 'sudo' must be omitted on windows
- open your web-browser (e.g. Firefox) and go to http://0.0.0.0:88
- test it
