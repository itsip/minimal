<?php

class ExampleController {
    /**
     * Returns hello world
     *
     */
    public static function index() {
        $text = 'Hello World!';

        View::render('example/index', [
            'text' => $text,
        ]);
    }
}
?>
