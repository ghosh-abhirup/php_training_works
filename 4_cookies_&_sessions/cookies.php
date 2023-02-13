<?php
echo "Welcome to the worlds of cookies";

// Cookies are stored in our local storage with less important about our usage of different websites.
// Ex- I like to see books in  an e-commerce websites. So, that website will show me books when I login
// Setting up a cookie. 
// setcookie(name, type, time after which it expires, where we want to use it);
setcookie("category", "Books", time() + 86400, "/");
echo "The cookie is set"
    ?>