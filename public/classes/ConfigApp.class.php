<?php

require '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT'] . dirname($_SERVER['SCRIPT_NAME']));
$dotenv->load();

/**
 * Clase que contiene los datos de configuración de la aplicación
 * 
 * @author Alejandro Suero Mejías ▓▒▒░░░青目░░░▒▒▓
 * @package     classes
 * 
 * @property    string _DB_HOST Nombre del host de la base de datos
 * @property    string _DB_USER Nombre de usuario de la base de datos
 * @property    string _DB_PASS Contraseña de la base de datos
 * @property    string _DB_NAME Nombre de la base de datos
 * 
 * @property    string $ACTION Nombre de la acción a ejecutar
 * @property    string $PARAMS Parámetros de la acción a ejecutar
 * 
 * @property    array $ACTIONS Array con los nombres de las acciones y sus métodos
 */
class ConfigApp
{

    /**
     * Nombre del host de la base de datos
     */
    protected $_DB_HOST = null;

    /**
     * Nombre del usuario de la base de datos
     */
    protected $_DB_USER = null;

    /**
     * Contraseña de la base de datos
     */
    protected $_DB_PASS = null;

    /**
     * Nombre de la base de datos
     */
    protected $_DB_NAME = null;
    function __construct()
    {
        $this->DB_HOST = getenv('DB_HOST');
        $this->DB_USER = getenv('DB_USER');
        $this->DB_PASS = getenv('DB_PASS');
        $this->DB_NAME = getenv('DB_NAME');
    }

    /**
     * Nombre de la acción a ejecutar
     */
    public static $ACTION = "action";

    /**
     * Parámetros de la acción a ejecutar
     */
    public static $PARAMS = "params";

    /**
     * Array con los nombres de las acciones y sus métodos
     * 
     * 'action' => 'controller#method'
     */
    public static $ACTIONS = [
        '' => 'ToDoController#tasks', // Default action
        'home' => 'ToDoController#tasks',
        'tasks' => 'ToDoController#tasks',
        'add' => 'ToDoController#add_task',
        'delete' => 'ToDoController#delete_task',
        'done' => 'ToDoController#done_task',
        'edit' => 'ToDoController#edit_task',
        'update' => 'ToDoController#update_task'
    ];
}
