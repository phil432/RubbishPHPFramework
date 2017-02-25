<?php

/* TestTemplate.html */
class __TwigTemplate_b42c78d89a4c71c0f29bb709d34680943b97221c244def0ff55026e154494532 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<html>
<head>
</head>
<body>
    <h1>This is a template</h1>
    <p>";
        // line 6
        echo twig_escape_filter($this->env, (isset($context["content"]) ? $context["content"] : null), "html", null, true);
        echo "</p>
</body>
</html>
";
    }

    public function getTemplateName()
    {
        return "TestTemplate.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  26 => 6,  19 => 1,);
    }
}
/* <html>*/
/* <head>*/
/* </head>*/
/* <body>*/
/*     <h1>This is a template</h1>*/
/*     <p>{{ content }}</p>*/
/* </body>*/
/* </html>*/
/* */
