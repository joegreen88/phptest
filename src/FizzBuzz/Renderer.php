<?php

namespace FizzBuzz;

/**
 * Class Renderer is for rendering templates.
 */
class Renderer extends \ArrayObject
{
    /**
     * Render a template by including the file inside an output buffer and then returning the buffer contents.
     *
     * @param string $template
     *
     * @return string
     *
     * @throws \Exception
     */
    public function render($template)
    {
        if (is_readable($template)) {
            $file = $template;
        } elseif (is_readable(TEMPLATE_PATH.'/'.$template)) {
            $file = TEMPLATE_PATH.'/'.$template;
        } else {
            throw new \Exception("Buzz\\Renderer cannot find template '$template'");
        }

        ob_start();
        include $file;
        return ob_get_clean();
    }
}
