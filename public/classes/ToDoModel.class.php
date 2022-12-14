<?php

/**
 * Clase que gestiona la base de datos
 * 
 * @author Alejandro Suero Mejías ▓▒▒░░░青目░░░▒▒▓
 * @package     classes
 * 
 * @property    string _DB_HOST Nombre del host de la base de datos
 * @property    string _DB_USER Nombre de usuario de la base de datos
 * @property    string _DB_PASS Contraseña de la base de datos
 * @property    string _DB_NAME Nombre de la base de datos
 */
class ToDoModel extends ConfigApp
{

    private $DB_HOST = null;
    private $DB_USER = null;
    private $DB_PASS = null;
    private $DB_NAME = null;

    public function __construct()
    {
        $config = new ConfigApp();
        $this->DB_HOST = $config->_DB_HOST;
        $this->DB_USER = $config->_DB_USER;
        $this->DB_PASS = $config->_DB_PASS;
        $this->DB_NAME = $config->_DB_NAME;
    }

    public static function get_connection(): PDO
    {
        $config = new ConfigApp();
        $dbh = new ToDoModel();
        $dsn = "mysql:host=" . $dbh->DB_HOST . ";dbname=" . $dbh->DB_NAME;
        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        );
        try {
            $db = new PDO($dsn, $config->_DB_USER, $config->_DB_PASS, $options);
        } catch (\PDOException $e) {
            $error = new ToDoError($e->getMessage(), (int) $e->getCode(), $e);
            $error->show_error();
            throw $error;
        }
        return $db;
    }

    public function is_empty_string(string $string): bool
    {
        return strlen($string) == 0;
    }

    /**
     * Función que realiza una consulta para sacar todas las tareas de la base de datos
     * 
     * @return array Array con todas las tareas de la base de datos
     * @throws ToDoError Si no se puede realizar la consulta
     */
    public function get_all_tasks(): array
    {
        try {
            $db = $this->get_connection();
            $query = $db->prepare('SELECT * FROM task');
            $query->execute();
            $tasks = $query->fetchAll(PDO::FETCH_ASSOC);
            $db = null;
        } catch (PDOException $e) {
            $db = null;
            $error = new ToDoError('Fallo al consultar todas las tareas', 500, $e);
            $error->show_error();
            throw $e;
        }
        return $tasks;
    }

    /**
     * Función que realiza una consulta para sacar una tarea de la base de datos
     * 
     * @param int $task_id ID de la tarea a sacar
     * @return array Array con la tarea de la base de datos
     * @throws ToDoError Si no se puede realizar la consulta
     */
    public function get_task_by_id(int $task_id): array
    {
        try {
            $db = $this->get_connection();
            $query = $db->prepare('SELECT * FROM task WHERE task_id = :id');
            $query->bindParam(':id', $task_id);
            $query->execute();
            $task = $query->fetch(PDO::FETCH_ASSOC);
            $db = null;
            if ($task !== false) {
                return $task;
            } else {
                return [];
            }
        } catch (PDOException $e) {
            $db = null;
            $error = new ToDoError('Fallo al consultar una tarea concreta', 500, $e);
            $error->show_error();
            return null;
        }
    }

    /**
     * Función que añade una nueva tarea a la base de datos
     * 
     * @param string $title Título de la tarea
     * @param string $description Descripción de la tarea
     * 
     * @return bool TRUE si se ha añadido correctamente, FALSE si no se ha añadido
     */
    public function add_new_task(string $task_title, string $task_description): bool
    {
        try {
            if ($this->is_empty_string($task_title)) {
                // throw new ToDoError('El título de la tarea no puede estar vacío', 400);
                header('HTTP/1.1 400 Bad Request');
                header('Location: tasks?error=empty_title');
            } else {
                $db = $this->get_connection();
                $query = $db->prepare('INSERT INTO task (task_title, task_description) VALUES (:title, :description)');
                $query->bindParam(':title', $task_title);
                $query->bindParam(':description', $task_description);
                $query->execute();
                $db = null;
                return true;
            }
        } catch (ToDoError $e) {
            $db = null;
            $error = new ToDoError($e->getMessage(), $e->getCode());
            $error->show_error();
            return false;
        }
    }

    /**
     * Función que borra una tarea según su ID
     * 
     * @param int $task_id ID de la tarea a borrar
     * 
     * @return bool TRUE si se ha borrado correctamente, FALSE si no se ha borrado
     */
    public function delete_task_by_id(int $task_id): bool
    {
        try {
            $db = $this->get_connection();
            $query = $db->prepare('DELETE FROM task WHERE task_id = :id');
            $query->bindParam(':id', $task_id);
            $query->execute();
            $db = null;
        } catch (PDOException $e) {
            $db = null;
            $error = new ToDoError('Fallo al eliminar una tarea', 500, $e);
            $error->show_error();
            throw $e;
            return false;
        }
        return true;
    }

    /**
     * Función que actualiza una tarea según su ID
     * 
     * @param int $task_id ID de la tarea a actualizar
     * 
     * @return bool TRUE si se ha actualizado correctamente, FALSE si no se ha actualizado
     */
    public function done_task_by_id(int $task_id): bool
    {
        try {
            $task = $this->get_task_by_id($task_id);
            $db = $this->get_connection();
            if ($task['task_done'] == 0) {
                $query = $db->prepare('UPDATE task SET task_done = 1 WHERE task_id = :id');
            } else {
                $query = $db->prepare('UPDATE task SET task_done = 0 WHERE task_id = :id');
            }
            $query->bindParam(':id', $task_id);
            $query->execute();
            $db = null;
        } catch (PDOException $e) {
            $db = null;
            $error = new ToDoError('Fallo al marcar una tarea como realizada', 500, $e);
            $error->show_error();
            throw $e;
            return false;
        }
        return true;
    }

    public function update_new_task(string $task_title, string $task_description, int $task_id): bool
    {
        try {
            if ($this->is_empty_string($task_title)) {
                header('HTTP/1.1 400 Bad Request');
                header('Location: tasks?error=empty_title');
                $error = new ToDoError('Failed to update the task', 400);
                $error->show_error();
            } else {
                $db = $this->get_connection();
                $query = $db->prepare('UPDATE task SET task_title = :title, task_description = :description WHERE task_id = :id');
                $query->bindParam(':title', $task_title);
                $query->bindParam(':description', $task_description);
                $query->bindParam(':id', $task_id);
                $query->execute();
                $db = null;
                return true;
            }
        } catch (PDOException $e) {
            $db = null;
            $error = new ToDoError('Failed to update the task', 500, $e);
            $error->show_error();
            return false;
        }
    }
}
