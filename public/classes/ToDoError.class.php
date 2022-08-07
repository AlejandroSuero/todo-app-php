<?php
// require Smarty library
require_once 'ToDoView.class.php';
/**
 * Clase para gestionar errores
 * 
 * @author Alejandro Suero Mejías ▓▒▒░░░青目░░░▒▒▓
 * @extends Exception
 */
class ToDoError extends Exception
{
    /**
     * Constructor de la clase
     * 
     * @param string $message Mensaje de error
     * @param int $code Código de error
     * @param Exception $previous Objeto de la clase Exception que generó el error
     */
    public function __construct(string $message, int $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    // -------------------------------------------------------------------------
    //                          Default code to display
    // -------------------------------------------------------------------------

    /**
     * Añade mensaje 400 predeterminado a la excepción
     */
    public function __400(): void
    {
        $this->message = 'Bad Request';
        $this->code = 400;
    }

    /**
     * Añade mensaje 401 predeterminado a la excepción
     */
    public function __401(): void
    {
        $this->message = 'Unauthorized';
        $this->code = 401;
    }

    /**
     * Añade mensaje 403 predeterminado a la excepción
     */
    public function __403(): void
    {
        $this->message = 'Forbidden';
        $this->code = 403;
    }


    /**
     * Añade mensaje 404 predeterminado a la excepción
     */
    public function __404(): void
    {
        $this->message = 'Not Found';
        $this->code = 404;
    }

    /**
     * Añade mensaje 500 predeterminado a la excepción
     */
    public function __500(): void
    {
        $this->message = 'Internal Server Error';
        $this->code = 500;
    }

    /**
     * Añade mensaje 501 predeterminado a la excepción
     */
    public function __501(): void
    {
        $this->message = 'Not Implemented';
        $this->code = 501;
    }

    /**
     * Añade mensaje 502 predeterminado a la excepción
     */
    public function __502(): void
    {
        $this->message = 'Bad Gateway';
        $this->code = 502;
    }

    /**
     * Añade mensaje 503 predeterminado a la excepción
     */
    public function __503(): void
    {
        $this->message = 'Service Unavailable';
        $this->code = 503;
    }

    // -------------------------------------------------------------------------
    //                          Display error
    // -------------------------------------------------------------------------

    /**
     * Recoge el mensaje de error
     */
    public function get_error_message(): string
    {
        return $this->message;
    }

    /**
     * Recoge el código de error
     */
    public function get_error_code(): int
    {
        return $this->code;
    }

    /**
     * Muestra una página de error personalizada
     */
    public function show_error(): void
    {
        $todo_view = new ToDoView();
        $todo_view->display_error($this->get_error_message(), $this->get_error_code());
    }
}
