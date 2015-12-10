<?php

/* forms/fields.html.twig */
class __TwigTemplate_a9e0e433ed7cc7fdd03ad2210e0094cb6b6b10b7e7e65f1cefd96a09ddcb35fb extends Twig_Template
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
        $context["scope"] = (isset($context["prefix"]) ? $context["prefix"] : null);
        // line 2
        echo "
";
        // line 3
        if ($this->getAttribute((isset($context["blueprints"]) ? $context["blueprints"] : null), "type", array())) {
            // line 4
            echo "    ";
            $context["field"] = (isset($context["blueprints"]) ? $context["blueprints"] : null);
            // line 5
            echo "    ";
            $context["value"] = (isset($context["data"]) ? $context["data"] : null);
            // line 6
            echo "    ";
            $context["default_value"] = (isset($context["defaults"]) ? $context["defaults"] : null);
            // line 7
            echo "
    ";
            // line 8
            $this->loadTemplate(array(0 => (("forms/fields/" . twig_replace_filter($this->getAttribute((isset($context["field"]) ? $context["field"] : null), "type", array()), ".", "/")) . ".html.twig"), 1 => "forms/fields/unknown/unknown.html.twig"), "forms/fields.html.twig", 8)->display($context);
            // line 9
            echo "
";
        } else {
            // line 11
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["blueprints"]) ? $context["blueprints"] : null), "fields", array()));
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["name"] => $context["field"]) {
                // line 12
                echo "        ";
                if ((is_string($__internal_b59d88c9d849d7badd333ec794ccce4ca8abf5225b211b8ed5d59b3b110d9b44 = $context["name"]) && is_string($__internal_73447357a71f8bdf26b45fc818f3b338eb681c7a59b5d7bd72166a96a350c151 = ".") && ('' === $__internal_73447357a71f8bdf26b45fc818f3b338eb681c7a59b5d7bd72166a96a350c151 || 0 === strpos($__internal_b59d88c9d849d7badd333ec794ccce4ca8abf5225b211b8ed5d59b3b110d9b44, $__internal_73447357a71f8bdf26b45fc818f3b338eb681c7a59b5d7bd72166a96a350c151)))) {
                    // line 13
                    echo "            ";
                    $context["name"] = twig_slice($this->env, $context["name"], 1, null);
                    // line 14
                    echo "        ";
                }
                // line 15
                echo "
        ";
                // line 16
                if (((($this->getAttribute($context["field"], "type", array()) && !twig_in_filter($context["name"], (isset($context["skip"]) ? $context["skip"] : null))) &&  !$this->getAttribute($context["field"], "skip", array())) &&  !((isset($context["ignore_not_overrideable"]) ? $context["ignore_not_overrideable"] : null) && ($this->getAttribute($context["field"], "overridable", array()) === false)))) {
                    // line 17
                    echo "            ";
                    $context["field"] = ($context["field"] + array("name" => $context["name"]));
                    // line 18
                    echo "            ";
                    $context["value"] = $this->env->getExtension('GantryTwig')->nestedFunc((isset($context["data"]) ? $context["data"] : null), ((isset($context["scope"]) ? $context["scope"] : null) . $context["name"]));
                    // line 19
                    echo "            ";
                    $context["default_value"] = $this->env->getExtension('GantryTwig')->nestedFunc((isset($context["defaults"]) ? $context["defaults"] : null), ((isset($context["scope"]) ? $context["scope"] : null) . $context["name"]));
                    // line 20
                    echo "
            ";
                    // line 21
                    $this->loadTemplate(array(0 => (("forms/fields/" . twig_replace_filter($this->getAttribute($context["field"], "type", array()), ".", "/")) . ".html.twig"), 1 => "forms/fields/unknown/unknown.html.twig"), "forms/fields.html.twig", 21)->display($context);
                    // line 22
                    echo "        ";
                }
                // line 23
                echo "    ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['name'], $context['field'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
    }

    public function getTemplateName()
    {
        return "forms/fields.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  93 => 23,  90 => 22,  88 => 21,  85 => 20,  82 => 19,  79 => 18,  76 => 17,  74 => 16,  71 => 15,  68 => 14,  65 => 13,  62 => 12,  44 => 11,  40 => 9,  38 => 8,  35 => 7,  32 => 6,  29 => 5,  26 => 4,  24 => 3,  21 => 2,  19 => 1,);
    }
}
/* {% set scope = prefix %}*/
/* */
/* {% if blueprints.type %}*/
/*     {% set field = blueprints %}*/
/*     {% set value = data %}*/
/*     {% set default_value = defaults %}*/
/* */
/*     {% include ["forms/fields/" ~ field.type|replace('.', '/') ~ ".html.twig", 'forms/fields/unknown/unknown.html.twig'] %}*/
/* */
/* {% else %}*/
/*     {% for name, field in blueprints.fields %}*/
/*         {% if name starts with '.' %}*/
/*             {% set name = name[1:] %}*/
/*         {% endif %}*/
/* */
/*         {% if field.type and name not in skip and not field.skip and not(ignore_not_overrideable and field.overridable is same as(false)) %}*/
/*             {% set field = field + {'name': name} %}*/
/*             {% set value = nested(data, scope ~ name) %}*/
/*             {% set default_value = nested(defaults, scope ~ name) %}*/
/* */
/*             {% include ["forms/fields/" ~ field.type|replace('.', '/') ~ ".html.twig", 'forms/fields/unknown/unknown.html.twig'] %}*/
/*         {% endif %}*/
/*     {% endfor %}*/
/* {% endif %}*/
/* */
