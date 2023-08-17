<?php

// URL DATA
define('BASE_URL','http://localhost/fine_renovation/index.php');
define('BASE_ACTION_URL','http://localhost/fine_renovation/index.php?action=');

// TABLE NAMES
define('WORKERS_TABLE','workers');
define('REGEX_EMAIL',"/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/");

define('REGEX_MOBILE',"/^[789]\d{9}$/");
// FULL NAME should contain more than one word
define('REGEX_FULL_NAME',"/^[a-zA-z]+([\s][a-zA-Z]+)+$/");
// FULL NAME can contain one word
define('REGEX_FULL_NAME1',"/^[a-zA-z]+([\s][a-zA-Z]+)*$/");