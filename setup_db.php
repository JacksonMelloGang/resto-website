<?php
include_once "getRacine.php";
include "database/migration.php";
include "database/seeder.php";

// ensure user has entered the right password to run this script
if(isset($_GET['password']) && $_GET['password'] == "greATioGHRGRe5.4g56og"){
    // run migration
    migrate();
} else {
    echo "You are not allowed to run this script";
}
