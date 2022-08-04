<?php

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
        '' => 'ToDoController#tasks',
        'home' => 'ToDoController#tasks',
        'tasks' => 'ToDoController#tasks',
        'add' => 'ToDoController#add_task',
        'delete' => 'ToDoController#delete_task',
        'done' => 'ToDoController#done_task',
        'edit' => 'ToDoController#edit_task',
        'update' => 'ToDoController#update_task'
    ];
}
