<?php

require_once 'ToDoError.class.php';
require_once 'ToDoView.class.php';
require_once 'ToDoModel.class.php';

/**
 * Clase que gestiona la lógica de la aplicación
 * 
 * @author Alejandro Suero Mejías ▓▒▒░░░青目░░░▒▒▓
 * 
 * @package    classes
 * 
 * @property   class $todo_view Objeto de la clase ToDoView
 * @property   class $todo_model Objeto de la clase ToDoModel
 */
class ToDoController
{

    /**
     * @var class ToDoView
     */
    private $todo_view;
    private $todo_model;

    function __construct()
    {
        $this->todo_view = new ToDoView();
        $this->todo_model = new ToDoModel();
    }

    /**
     * Recupera las tareas de la base de datos y las muestra en la vista
     * 
     * @return void Llama a la función show_tasks de la clase ToDoView
     */
    function tasks(): void
    {
        $tasks = $this->todo_model->get_all_tasks();
        $this->todo_view->display_tasks($tasks);
    }

    /**
     * Función que añade una nueva tarea a la base de datos
     * 
     * @return void Si se ha añadido correctamente, redirecciona a la página de inicio, si no, muestra un error
     */
    function add_task(): void
    {
        if ($this->todo_model->add_new_task($_POST['task_title'], $_POST['task_description'])) {
            header('HTTP/1.1 200 OK');
            header('Location: tasks');
        } else {
            $error = new ToDoError('Fallo al añadir una nueva tarea', 400);
            $error->show_error();
        }
    }

    /**
     * Función que elimina una tarea de la base de datos
     * 
     * @param array $params Array con los parámetros de la URL
     * 
     * @return void Si se ha eliminado correctamente, redirecciona a la página de inicio, si no, muestra un error
     */
    function delete_task(array $params): void
    {
        if ($this->todo_model->get_task_by_id((int) $params[0]) === []) {
            $error = new ToDoError('La tarea que busca eliminar id: ' . $params[0] . ', no existe.', 404);
            $error->show_error();
        } else {
            if ($this->todo_model->delete_task_by_id((int) $params[0])) {
                header('HTTP/1.1 200 OK');
                header('Location: ../tasks');
            } else {
                $error = new ToDoError('Fallo al eliminar la tarea', 400);
                $error->show_error();
            }
        }
    }

    /**
     * Función que marca una tarea como realizada
     * 
     * @param array $params Array con los parámetros de la URL
     * 
     * @return void Si se ha marcado correctamente, redirecciona a la página de inicio, si no, muestra un error
     */
    function done_task(array $params): void
    {
        if ($this->todo_model->get_task_by_id((int) $params[0]) === []) {
            $error = new ToDoError('La tarea que busca marcar como completa id: ' . $params[0] . ', no existe.', 404);
            $error->show_error();
        } else {
            if ($this->todo_model->done_task_by_id((int) $params[0])) {
                header('HTTP/1.1 200 OK');
                header('Location: ../tasks');
            } else {
                $error = new ToDoError('Fallo al marcar la tarea como realizada', 400);
                $error->show_error();
            }
        }
    }

    /**
     * Función que muestra la vista de edición de una tarea
     * 
     * @param array $params Array con los parámetros de la URL
     * 
     * @return void Llama a la función show_edit_task de la clase ToDoView
     */
    function edit_task(array $params): void
    {
        if ($this->todo_model->get_task_by_id((int) $params[0]) === []) {
            $error = new ToDoError('La tarea que busca editar id: ' . $params[0] . ', no existe.', 404);
            $error->show_error();
        } else {
            $task = $this->todo_model->get_task_by_id((int) $params[0]);
            $this->todo_view->display_edit_task($task);
        }
    }

    /**
     * Función que actualiza una tarea de la base de datos
     * 
     * @param array $params Array con los parámetros de la URL
     * 
     * @return void Si se ha actualizado correctamente, redirecciona a la página de inicio, si no, muestra un error
     */
    function update_task(array $params): void
    {
        if ($this->todo_model->get_task_by_id((int) $params[0]) === []) {
            $error = new ToDoError('La tarea que busca actualizar id: ' . $params[0] . ', no existe.', 404);
            $error->show_error();
        } else {
            $task = $this->todo_model->get_task_by_id((int) $params[0]);
            $task_title = $_POST['task_title'];
            $task_description = $_POST['task_description'];
            $task_id = (int) $task['task_id'];

            if ($this->todo_model->update_new_task($task_title, $task_description, $task_id)) {
                header('HTTP/1.1 200 OK');
                header('Location: ../tasks');
            } else {
                $error = new ToDoError('Fallo al actualizar la tarea', 400);
                $error->show_error();
            }
        }
    }
}
