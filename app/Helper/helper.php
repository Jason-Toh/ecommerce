<?php

// global function
// composer.jspn
/* 1) "autoload": {
        "files": [
            "app/Helper/helper.php" <-- add here
        ],
        "psr-4": {
            "App\\": "app/",
            "Database\\Factories\\": "database/factories/",
            "Database\\Seeders\\": "database/seeders/"
        }
    },
*/
// 2) composer dump-autoload

function presentPrice($price)
{
    return number_format($price, 2, '.', '');
}
