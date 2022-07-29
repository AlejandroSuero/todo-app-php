<?php

/**
 * Clase que contiene los datos de configuración de la aplicación
 * 
 * @author      Alejandro Suero
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
class ConfigApp {
    /**
     * Nombre del host de la base de datos
     */
    protected const _DB_HOST = 'localhost';
    /**
     * Nombre del usuario de la base de datos
     */
    protected const _DB_USER = 'root';
    /**
     * Contraseña de la base de datos
     */
    protected const _DB_PASS = 'abc123';
    /**
     * Nombre de la base de datos
     */
    protected const _DB_NAME = 'todo_app';

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
     */
    public static $ACTIONS = [
        '' => 'tasks',
        'home' => 'tasks',
        'tasks' => 'tasks',
        'add' => 'add_task',
        'delete' => 'delete_task',
        'done' => 'done_task',
        'edit' => 'edit_task',
        'update' => 'update_task'
    ];
}
