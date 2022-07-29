<?php
require_once './classes/ConfigApp.class.php';
require_once './classes/ToDoError.class.php';
require_once 'tasks.php';

/**
 * Función que se encarga de gestionar las peticiones de la aplicación
 * 
 * @param string $url La url a la que se desea acceder
 * @return array Array con los datos de la acción a ejecutar y los parámetros
 */
function url_parse(string $url): array {
    $url_data = explode('/', $url);
    $data_array[ConfigApp::$ACTION] = $url_data[0];
    $data_array[ConfigApp::$PARAMS] = isset($url_data[1]) ? array_slice($url_data, 1) : null;

    return $data_array;
}

$url_data = url_parse($_GET[ConfigApp::$ACTION]);
$action_name = $url_data[ConfigApp::$ACTION];

// Si hay una acción a ejecutar y es válida, se ejecuta
if(array_key_exists($action_name, ConfigApp::$ACTIONS)) {
    $params = $url_data[ConfigApp::$PARAMS];
    $method_name = ConfigApp::$ACTIONS[$action_name];
    // Si hay parámetros, se los pasa al método
    if(isset($params) && $params !== null){
        echo $method_name($params);
    }else{ // Sino se ejecuta el método sin parámetros
        echo $method_name();
    }
}else{// Sino se muestra la página de error
    // Mostrar Error 404 (Página no encontrada)
    $error = new ToDoError('La página a la que quiere acceder no existe', 404);
    $error->show_error();
}
