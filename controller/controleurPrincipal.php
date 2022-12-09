<?php

/**
 * Will always return an array of 2 elements: the controller (filename) & the function (name)
 * @param string $action
 * @return array
 */
function controleurPrincipal($action) {
    
    global $registered_routes;

    $registered_routes = array(
        "home" => "homeController",
        "cgu" => "homeController",

        // Restaurants controller
        "showRestaurants" => "restaurantController",
        "showRestaurant" => "restaurantController",

        // menu controller
        "showMenus" => "menuController",
        "showMenu" => "menuController",
        "showMenuByType" => "menuController",
        "showMenuByTypeAndResto" => "menuController",
        "showMenuByResto" => "menuController",

        // plat controller
        "showPlats" => "platController",
        "showPlat" => "platController",
        "showPlatByType" => "platController",
        "showPlatByTypeAndResto" => "platController",
        "showPlatByResto" => "platController",


        // critique Controller
        "showEditCritique" => "critiqueController",
        "addCritique" => "critiqueController",
        "delCritique" => "critiqueController",
        "editCritique" => "critiqueController",


        // user controller
        "monProfil" => "utilisateurController",
        "userProfil" => "utilisateurController", // see others profiles in condition that they are not private
        "editPassword" => "utilisateurController",
        "editUsername" => "utilisateurController",

        "updateUserProfil" => "utilisateurController",
        "updateUserPassword" => "utilisateurController",
        "updateUserMail" => "utilisateurController",
        "updatePseudo" => "utilisateurController",

        // aimer controller
        "aimerRestaurant" => "aimerController",


        // Authentication Controller
        "showLogin" => "authenticationController",
        "connect" => "authenticationController",
        "disconnect" => "authenticationController",
        
        "showRegister" => "authenticationController",
        "register" => "authenticationController",

        // Admin Controller => middleware: isAdminMiddleware
        "admin" => "adminController",
        
        "listUsers" => "adminController",
        "listRestaurants" => "adminController",
        "listPhotos" => "adminController",
        "listCritiques" => "adminController",

        "banUser" => "adminController",
        "unbanUser" => "adminController",
        
        "deleteUser" => "adminController",
        "deleteRestaurant" => "adminController",
        "deletePhoto" => "adminController",
        "deleteCritique" => "adminController",

        // error Controller
        "404" => "errorController",
        "missingController" => "errorController",
        "missingFunction" => "errorController",
        "missingRoute" => "errorController",
        "missingModele" => "errorController",
        "missingVue" => "errorController",

        "test" => "testController",
    );

    // if route is registered
    if(array_key_exists($action, $registered_routes)){
        
        // check if file exists
        if(!file_exists_in_folder("controller", $registered_routes[$action] . ".php")){
            // file not exists
            return array("errorController", "missingController", $registered_routes[$action]);
        }


        // require controller
        require("controller\\" . $registered_routes[$action] . ".php");

        if(function_exists($action)){
            // controller and function exist - normal operation
            return array($registered_routes[$action], $action);
        } else {
            // function not exist
            return array("errorController", "missingFunction");
        }
    } else {
        // route not exist
        return array("errorController", "error404");
    }
}

function register_route($action, $controller) {
    global $registered_routes;

    $registered_routes[$action] = $controller;
}

function get_controller($action) {
    global $registered_routes;

    if(array_key_exists($action, $registered_routes)){
        return $registered_routes[$action];
    } else {
        return null;
    }
}

function call_route($controller, $method){
// check if method is registered in route, if not, return error
    if(get_controller($method) == $controller){
        return call_user_func($method);
    } else {
        /*return call_user_func("error404");*/
    }
}

function file_exists_in_folder($folder, $file) {
    $files = scandir($folder);
    foreach($files as $f) {
        if($f == $file) {
            return true;
        }
    }
    return false;
}

?>