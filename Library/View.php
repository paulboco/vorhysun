<?php

namespace Library;

class View
{
    /**
     * The template file path.
     *
     * @var string
     */
    private $path = '/app/views/';

    /**
     * The template file extension.
     *
     * @var string
     */
    private $extension = '.php';

    /**
     * Make a view.
     *
     * @param  string  $template
     * @param  array  $data
     * @return string
     */
    public function make($template, $data = array())
    {
        ob_start();
        $this->render($template, $data);

        return ob_get_clean();
    }

    /**
     * Render the view.
     *
     * @param  string  $template
     * @param  array  $data
     * @return void
     */
    public function render($template, $data = array())
    {
        extract($data);

        include BASE_PATH . $this->path . $template . $this->extension;
    }

    /**
     * Inject a view from within a view.
     *
     * @param  string  $template
     * @param  array  $data
     * @return void
     */
    protected function inject($template, $data = array())
    {
        $this->render($template, $data);
    }
}
