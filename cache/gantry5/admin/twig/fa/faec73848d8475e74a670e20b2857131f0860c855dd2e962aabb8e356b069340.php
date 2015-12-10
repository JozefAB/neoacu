<?php

/* forms/fields/separator/note.html.twig */
class __TwigTemplate_4e3a9c092283523ce4be8d7a95286d60e83c66f021f4a036ae2c0579846fca9d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'field' => array($this, 'block_field'),
        );
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return $this->loadTemplate((("forms/" . ((array_key_exists("layout", $context)) ? (_twig_default_filter((isset($context["layout"]) ? $context["layout"] : null), "field")) : ("field"))) . ".html.twig"), "forms/fields/separator/note.html.twig", 1);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_field($context, array $blocks = array())
    {
        // line 4
        echo "    <div class=\"";
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "class", array()), "alert alert-warning")) : ("alert alert-warning")));
        echo "\">";
        echo $this->env->getExtension('GantryTwig')->transFilter($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "content", array()));
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "forms/fields/separator/note.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  30 => 4,  27 => 3,  18 => 1,);
    }
}
/* {% extends 'forms/' ~ layout|default('field') ~ '.html.twig' %}*/
/* */
/* {% block field %}*/
/*     <div class="{{ field.class|default("alert alert-warning")|e }}">{{ field.content|trans|raw }}</div>*/
/* {% endblock %}*/
/* */
