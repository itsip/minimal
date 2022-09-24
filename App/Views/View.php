<?php

class View {
    /**
     * Renders the main view, and allows for a subview and data
     * to be injected into the main view.
     *
     * @param mixed $view
     * @param mixed $vars
     */
    public static function render($view, $vars = []) {
        $vars['view'] = $view;
        extract($vars);
        include 'main.php';
    }
}

?>
