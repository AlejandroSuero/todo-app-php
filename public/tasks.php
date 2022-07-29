<?php

// require Smarty library
require_once 'libs/Smarty.class.php';

// require classes
require_once './classes/ToDoError.class.php';
require_once './classes/ConfigApp.class.php';
require_once './classes/Dbh.class.php';
/**
 * Función que muestra la página de inicio
 * 
 * @param array $params Array con los parámetros de la página
 * 
 * @return void HTML con la página de tareas
 */
function tasks(array $params = null): void
{
    // check if has params
    if (is_null($params)) {
        $dbh = new Dbh();
        $tasks = $dbh->get_tasks();
        $smarty = new Smarty();
        if (isset($_GET['error'])) {
            $smarty->assign('error', $_GET['error']);
        }
        $smarty->assign('page_title', 'ToDo App - Tasks');
        $smarty->assign('tasks', $tasks);
        $smarty->display('task.tpl');
    } else {
        $error = new ToDoError('No se encuentra la página', 404);
        $error->show_error();
    }
}

/**
 * Función que añade una nueva tarea a la base de datos
 * 
 * @return void Si se ha añadido correctamente, redirecciona a la página de inicio, si no, muestra un error
 */
function add_task(): void
{
    $dbh = new Dbh();
    if ($dbh->add_new_task($_POST['task_title'], $_POST['task_description'])) {
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
    $dbh = new Dbh();
    if ($dbh->get_task_by_id((int) $params[0]) === []) {
        $error = new ToDoError('La tarea que busca eliminar id: ' . $params[0] . ', no existe.', 404);
        $error->show_error();
    } else {
        if ($dbh->delete_task_by_id((int) $params[0])) {
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
    $dbh = new Dbh();
    if ($dbh->get_task_by_id((int) $params[0]) === []) {
        $error = new ToDoError('La tarea que busca marcar como completa id: ' . $params[0] . ', no existe.', 404);
        $error->show_error();
    } else {
        if ($dbh->done_task_by_id((int) $params[0])) {
            header('HTTP/1.1 200 OK');
            header('Location: ../tasks');
        } else {
            $error = new ToDoError('Fallo al marcar la tarea como realizada', 400);
            $error->show_error();
        }
    }
}

function edit_task(array $params): void
{
    $dbh = new Dbh();
    if ($dbh->get_task_by_id((int) $params[0]) === []) {
        $error = new ToDoError('La tarea que busca editar id: ' . $params[0] . ', no existe.', 404);
        $error->show_error();
    } else {
        $task = $dbh->get_task_by_id((int) $params[0]);
        $task_title = $task['task_title'];
        $task_description = $task['task_description'];
        $task_id = $task['task_id'];

        $smarty = new Smarty();
        $smarty->assign('page_title', 'ToDo App - Edit Task ' . $task_id);
        $smarty->assign('task_title', $task_title);
        $smarty->assign('task_description', $task_description);
        $smarty->assign('task_id', $task_id);
        $smarty->display('edit_task.tpl');
    }
}

function update_task(array $params): void
{
    $dbh = new Dbh();
    if ($dbh->get_task_by_id((int) $params[0]) === []) {
        $error = new ToDoError('La tarea que busca actualizar id: ' . $params[0] . ', no existe.', 404);
        $error->show_error();
    } else {
        $task = $dbh->get_task_by_id((int) $params[0]);
        $task_title = $task['task_title'];
        $task_description = $task['task_description'];
        $task_id = (int) $task['task_id'];

        if ($dbh->update_new_task($task_title, $task_description, $task_id)) {
            header('HTTP/1.1 200 OK');
            header('Location: ../tasks');
        } else {
            $error = new ToDoError('Fallo al editar la tarea', 400);
            $error->show_error();
        }
    }
}
