<?php

abstract class JR_Output_Renderer
{
    static public function factory($name)
    {
        switch ($name) {
            case 'nicehtml':
                include(getcwd().'/../lib/JR/Output/Renderer/Nicehtml.php');
                $renderer = new CS_Output_Renderer_Html();
            break;
            case 'html':
            case 'apache':
            case 'apache2handler':
                $renderer = new JR_Output_Renderer_Html();
                break;
            case 'shell':
            case 'cli':
            default:
                $renderer = new JR_Output_Renderer_Cli();
        }

        return $renderer;
    }
}