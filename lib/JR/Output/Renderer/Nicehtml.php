<?php


class CS_Output_Renderer_Html extends JR_Output_Renderer_Abstract
{
    protected $_eol = '<br />';
    protected $_indentString = '&nbsp;';
    protected $_successColor = 'green';
    protected $_errorColor = 'red';
    protected $_prefix = '<span>';
    protected $_suffix = '</span>';

    public function __construct()
    {
        echo <<< EOF
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
        <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script src="http://mcpants.github.io/jquery.shapeshift/core/jquery.shapeshift.min.js"></script>

    </head>
    <body>
    <style type="text/css">
        body {
            font: 14px/1.5em Monospace;
            font-family : Arial;
        }

        div.test{
            width: 650px;
            padding:10px;
            border: 1px solid #CCC;
            float: left;
            margin-right: 15px;
            margin-top: 10px;
        }

        div.test h1{
            font-size: 14px;
            width:95%;
            border-bottom: 1px solid #CCC;
        }

        span.right{
            float: right;
            margin-right: 5px;
            padding: 2px;
        }

        span.yellow{
            background-color: yellow;
        }

        span.green{
            background-color: #E5FFDC;
            border: 1px solid #D1EBC8;

        }

        span.error{
            background-color: #FFEDE5;
            border: 1px solid #FFDFDF;

        }

        div.item{
            width: 610px;
            float:left;
        }

        .wrap{
            width: 99%;
            clear: both;
            visibility: hidden !important;
        }
    </style>
    <div id="blocks">
EOF;
    }

    public function __destruct()
    {
        echo <<< EOF
    <body>

</html>
EOF;

    }

    public function bold($str)
    {
        return sprintf('<strong>%s</strong>', $str);
    }

    public function colorize($str, $color)
    {
        echo sprintf('<span class="right %s">%s</span><hr class="wrap"/>', $color, $str);
    }

    public function pad($str, $length, $type = STR_PAD_RIGHT)
    {
        $strlen = strlen($str);
        $length = max(0, $length - $strlen);

        if ($type == STR_PAD_RIGHT) {
            $str = $str . str_repeat('&nbsp;', $length);
        } else {
            $str = str_repeat('&nbsp;', $length) . $str;
        }

        return $str;
    }

    public function _startTest(){
        echo  '<div class="test">';

    }

    public function _endTest(){
        echo '</div>';

    }

    public function section($str){
        echo '<h1>'.$str.'</h1>';
    }

    public function output($str){
        if($str){
        echo '<div class="item">'.$str.'</div>';
        }
    }

    public function outputPlain($str){
        echo $str;
    }

    protected function _afterEcho()
    {
        // 1024 padding is required for Safari, while 256 padding is required
        // for Internet Explorer.
        echo str_pad('', 1024, ' ', STR_PAD_RIGHT) . "\n";
        @flush();
        @ob_flush();
    }

    public function success($str, $indent = false, $exit = false, $eol = true)
    {
        return $this->output($this->colorize($str, $this->getSuccessColor()), $indent, $exit, $eol);
    }

    public function error($str, $indent = false, $exit = false, $eol = true)
    {
        echo $this->colorize($str, 'error');
    }
}
