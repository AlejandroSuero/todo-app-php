# <center>ToDo App - Classes</center>

In this section you can find the classes for the backend.

## Configuration

A class that handles the configuration of the application. Like the database variables and the route handling variables.

```php
class ConfigApp {

    protected const _DB_HOST = 'yourbdhost';
    protected const _DB_USER = 'yourdbuser';
    protected const _DB_PASS = 'yourdbpass';
    protected const _DB_NAME = 'yourdbname';

    public static $ACTION = "action";
    public static $PARAMS = "params";

    // 'route' => 'controller#method'
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
```

## Error

A class that handles the error messages, also in contact with the view.

```php
class ToDoError extends Exception
{

    // Constructor for the class with the error message and the error code (optional) and the previous exception (optional)
    public function __construct(string $message, int $code = 400, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function __400(): void
    {
        $this->message = 'Bad Request'; // Set the error message
        $this->code = 400; // Set the error code
    }

    public function __401(): void
    {
        $this->message = 'Unauthorized'; // Set the error message
        $this->code = 401; // Set the error code
    }

    ...

    public function show_error(): void
    {
        $todo_view = new ToDoView(); // Initialize the view
        $todo_view->display_error(
            $this->get_error_message(),
            $this->get_error_code()
            ); // Display the error in the view
    }
}
```

## Model

A class that handles the database connection and the queries.

```php
class ToDoModel extends ConfigApp
{

    private $DB_HOST;
    private $DB_USER;
    private $DB_PASS;
    private $DB_NAME;

    public function __construct()
    {
        $this->DB_HOST = ConfigApp::_DB_HOST;
        $this->DB_USER = ConfigApp::_DB_USER;
        $this->DB_PASS = ConfigApp::_DB_PASS;
        $this->DB_NAME = ConfigApp::_DB_NAME;
    }

    public static function get_connection(): PDO
    {
        $dbh = new ToDoModel(); // Initialize the class
        $dsn = "mysql:host=" . $dbh->DB_HOST . ";dbname=" . $dbh->DB_NAME; // Create the DSN string for the PDO connection
        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ); // Set the options for the PDO connection
        try { // Try to connect to the database
            $db = new PDO(
                $dsn,
                $dbh->DB_USER,
                $dbh->DB_PASS,
                $options
                );
        } catch (\PDOException $e) { // If the connection fails, throw an error
            $error = new ToDoError(
                $e->getMessage(),
                (int) $e->getCode(),
                $e);
            $error->show_error(); // Show the error
            throw new $error; // Throw the error
        }
        return $db; // Return the connection
    }

    ...
}
```

## Views

A class that handles the views, what the user will see.

```php
class ToDoView
{
    private $smarty;

    function __construct()
    {
        $this->smarty = new Smarty(); // Initialize Smarty
        $this->smarty->setTemplateDir('templates'); // Set the template directory
        $this->smarty->setCompileDir('templates_c'); // Set the compile directory
    }

    public function display_tasks(array $tasks): void
    {
        $this->smarty->assign(
            'page_title',
            'yourtitle'
            ); // Set the page title
        $this->smarty->assign(
            'tasks',
            $tasks
            ); // Set the tasks
        $this->smarty->display('templates/yourtemplate.tpl'); // Display the template
    }
}
```

## Controller

A class that handles the logic between the model and the views.

```php
class ToDoController
{

    private $todo_view;
    private $todo_model;

    function __construct(){
        $this->todo_view = new ToDoView(); // Initialize the view
        $this->todo_model = new ToDoModel(); // Initialize the model
    }

    function tasks(): void
    {
        $tasks = $this->todo_model->get_all_tasks(); // Get all tasks from the model
        $this->todo_view->display_tasks($tasks); // Display the tasks in the view
    }
}
```
