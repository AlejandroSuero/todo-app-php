<?php
require_once 'libs/Smarty.class.php';

/**
 * Clase que gestiona las vistas de la aplicación
 * 
 * @author Alejandro Suero Mejías ▓▒▒░░░青目░░░▒▒▓
 * @package     classes
 * 
 * @property   class $smarty Objeto de la clase Smarty
 */
class ToDoView
{
    private $smarty;

    /**
     * Constructor de la clase
     * 
     * Crea un objeto Smarty y lo inicializa
     */
    function __construct()
    {
        $this->smarty = new Smarty();
        $this->smarty->setTemplateDir('templates');
        $this->smarty->setCompileDir('templates_c');
    }

    /**
     * Muestra la página de tareas
     * 
     * Asigna los datos a la plantilla y muestra la página de tareas
     * 
     * @param array $tasks Array con las tareas
     * 
     * @return void
     */
    public function display_tasks(array $tasks): void
    {
        $this->smarty->assign('page_title', 'ToDo App - Tasks');
        $this->smarty->assign('tasks', $tasks);
        $this->smarty->display('templates/tasks.tpl');
    }

    /**
     * Muestra la página de tareas
     * 
     * Asigna los datos a la plantilla y muestra la página de edición de la tarea
     * 
     * @param array $tasks Array con las tareas
     * 
     * @return void
     */
    public function display_edit_task(array $task): void
    {
        $task_title = $task['task_title'];
        $task_description = $task['task_description'];
        $task_id = $task['task_id'];

        $this->smarty->assign('page_title', 'ToDo App - Edit Task');
        $this->smarty->assign('task_title', $task_title);
        $this->smarty->assign('task_description', $task_description);
        $this->smarty->assign('task_id', $task_id);
        $this->smarty->display('templates/edit_task.tpl');
    }

    /**
     * Muestra la página de error
     * 
     * Asigna los datos a la plantilla y muestra la página de error
     * 
     * @param string $message Mensaje de error
     * @param int $code Código de error
     * 
     * @return void
     */
    public function display_error(string $message, int $code): void
    {
        $this->smarty->assign('page_title', 'ToDo App - Error ' . $code);
        $this->smarty->assign('error_code', $code);
        $this->smarty->assign('error_message', $message);
        $this->smarty->display('template/error.tpl');
    }
}
