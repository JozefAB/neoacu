<?php

/* @nucleus/page_head.html.twig */
class __TwigTemplate_1cc7d7526c2f865a725b596b7d02c04a9b59104d2a1e1cd6b15e78759a7f9c86 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'head_stylesheets' => array($this, 'block_head_stylesheets'),
            'head_platform' => array($this, 'block_head_platform'),
            'head_overrides' => array($this, 'block_head_overrides'),
            'head_meta' => array($this, 'block_head_meta'),
            'head_title' => array($this, 'block_head_title'),
            'head_application' => array($this, 'block_head_application'),
            'head_ie_stylesheets' => array($this, 'block_head_ie_stylesheets'),
            'head' => array($this, 'block_head'),
            'head_custom' => array($this, 'block_head_custom'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $assetFunction = $this->env->getFunction('parse_assets')->getCallable();
        $assetVariables = array("priority" => 10);
        if ($assetVariables && !is_array($assetVariables)) {
            throw new UnexpectedValueException('{% scripts with x %}: x is not an array');
        }
        $location = "head";
        if ($location && !is_string($location)) {
            throw new UnexpectedValueException('{% scripts in x %}: x is not a string');
        }
        $priority = isset($assetVariables['priority']) ? $assetVariables['priority'] : 0;
        ob_start();
        // line 2
        echo "    ";
        $this->displayBlock('head_stylesheets', $context, $blocks);
        // line 13
        $this->displayBlock('head_platform', $context, $blocks);
        // line 14
        echo "
    ";
        // line 15
        $this->displayBlock('head_overrides', $context, $blocks);
        // line 22
        echo "<script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->urlFunc("gantry-assets://js/jquery.fullPage.min.js"), "html", null, true);
        echo "\"></script>
";
        $content = ob_get_clean();
        echo $assetFunction($content, $location, $priority);
        // line 25
        if ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "config", array()), "page", array()), "head", array()), "atoms", array())) {
            // line 26
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "config", array()), "page", array()), "head", array()), "atoms", array()));
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
            foreach ($context['_seq'] as $context["_key"] => $context["atom"]) {
                // line 27
                echo "        ";
                $this->loadTemplate((("@particles/" . $this->getAttribute($context["atom"], "type", array())) . ".html.twig"), "@nucleus/page_head.html.twig", 27)->display(array_merge($context, array("particle" => $this->getAttribute($context["atom"], "attributes", array()))));
                // line 28
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['atom'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
        // line 30
        echo "
";
        // line 31
        $this->loadTemplate("@particles/assets.html.twig", "@nucleus/page_head.html.twig", 31)->display(array_merge($context, array("particle" => twig_array_merge($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "config", array()), "page", array()), "assets", array()), array("enabled" => 1)))));
        // line 32
        echo "
<head>
    ";
        // line 34
        $this->displayBlock('head_meta', $context, $blocks);
        // line 55
        $this->displayBlock('head_title', $context, $blocks);
        // line 59
        echo "
    ";
        // line 60
        $this->displayBlock('head_application', $context, $blocks);
        // line 64
        echo "
    ";
        // line 65
        $this->displayBlock('head_ie_stylesheets', $context, $blocks);
        // line 73
        $this->displayBlock('head', $context, $blocks);
        // line 74
        echo "    ";
        $this->displayBlock('head_custom', $context, $blocks);
        // line 79
        echo "</head>";
    }

    // line 2
    public function block_head_stylesheets($context, array $blocks = array())
    {
        // line 3
        echo "<link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->urlFunc("gantry-assets://css/font-awesome.min.css"), "html", null, true);
        echo "\" type=\"text/css\"/>
        <link rel=\"stylesheet\" href=\"";
        // line 4
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->urlFunc("gantry-engine://css-compiled/nucleus.css"), "html", null, true);
        echo "\" type=\"text/css\"/>
        <link rel=\"stylesheet\" href=\"";
        // line 5
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->urlFunc("gantry-assets://css/jquery.fullPage.css"), "html", null, true);
        echo "\" type=\"text/css\"/>
        ";
        // line 6
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "theme", array(), "any", false, true), "configuration", array(), "any", false, true), "css", array(), "any", false, true), "persistent", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "theme", array(), "any", false, true), "configuration", array(), "any", false, true), "css", array(), "any", false, true), "persistent", array()), $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "theme", array()), "configuration", array()), "css", array()), "files", array()))) : ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "theme", array()), "configuration", array()), "css", array()), "files", array()))));
        foreach ($context['_seq'] as $context["_key"] => $context["css"]) {
            // line 7
            $context["url"] = $this->env->getExtension('GantryTwig')->urlFunc($this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "theme", array()), "css", array(0 => $context["css"]), "method"));
            if ((isset($context["url"]) ? $context["url"] : null)) {
                // line 8
                echo "            <link rel=\"stylesheet\" href=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->urlFunc($this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "theme", array()), "css", array(0 => $context["css"]), "method")), "html", null, true);
                echo "\" type=\"text/css\"/>
        ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['css'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 11
        echo "    ";
    }

    // line 13
    public function block_head_platform($context, array $blocks = array())
    {
    }

    // line 15
    public function block_head_overrides($context, array $blocks = array())
    {
        // line 16
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "theme", array()), "configuration", array()), "css", array()), "overrides", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["css"]) {
            // line 17
            $context["url"] = $this->env->getExtension('GantryTwig')->urlFunc($this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "theme", array()), "css", array(0 => $context["css"]), "method"));
            if ((isset($context["url"]) ? $context["url"] : null)) {
                // line 18
                echo "            <link rel=\"stylesheet\" href=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->urlFunc($this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "theme", array()), "css", array(0 => $context["css"]), "method")), "html", null, true);
                echo "\" type=\"text/css\"/>
        ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['css'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 21
        echo "    ";
    }

    // line 34
    public function block_head_meta($context, array $blocks = array())
    {
        // line 35
        echo "        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\" />
        ";
        // line 37
        if ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "config", array()), "page", array()), "head", array()), "meta", array())) {
            // line 38
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "config", array()), "page", array()), "head", array()), "meta", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["attributes"]) {
                // line 39
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($context["attributes"]);
                foreach ($context['_seq'] as $context["key"] => $context["value"]) {
                    // line 40
                    echo "                    <meta name=\"";
                    echo twig_escape_filter($this->env, $context["key"]);
                    echo "\" property=\"";
                    echo twig_escape_filter($this->env, $context["key"]);
                    echo "\" content=\"";
                    echo twig_escape_filter($this->env, $context["value"]);
                    echo "\" />
                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['key'], $context['value'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['attributes'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
        // line 45
        if ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "config", array()), "page", array()), "assets", array()), "favicon", array())) {
            // line 46
            echo "        <link rel=\"icon\" type=\"image/x-icon\" href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->urlFunc($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "config", array()), "page", array()), "assets", array()), "favicon", array())), "html", null, true);
            echo "\" />
        ";
        }
        // line 48
        echo "
        ";
        // line 49
        if ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "config", array()), "page", array()), "assets", array()), "touchicon", array())) {
            // line 50
            echo "        <link rel=\"apple-touch-icon\" sizes=\"180x180\" href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->urlFunc($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "config", array()), "page", array()), "assets", array()), "touchicon", array())), "html", null, true);
            echo "\">
        <link rel=\"icon\" sizes=\"192x192\" href=\"";
            // line 51
            echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->urlFunc($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "config", array()), "page", array()), "assets", array()), "touchicon", array())), "html", null, true);
            echo "\">
        ";
        }
        // line 53
        echo "    ";
    }

    // line 55
    public function block_head_title($context, array $blocks = array())
    {
        // line 56
        echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
        <title>Title</title>";
    }

    // line 60
    public function block_head_application($context, array $blocks = array())
    {
        // line 61
        echo twig_join_filter($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "styles", array(0 => "head"), "method"), "
");
        echo "
        ";
        // line 62
        echo twig_join_filter($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "scripts", array(0 => "head"), "method"), "
");
    }

    // line 65
    public function block_head_ie_stylesheets($context, array $blocks = array())
    {
        // line 66
        echo "<!--[if (gte IE 8)&(lte IE 9)]>
        <script type=\"text/javascript\" src=\"";
        // line 67
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->urlFunc("gantry-assets://js/html5shiv-printshiv.min.js"), "html", null, true);
        echo "\"></script>
        <link rel=\"stylesheet\" href=\"";
        // line 68
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->urlFunc("gantry-engine://css/nucleus-ie9.css"), "html", null, true);
        echo "\" type=\"text/css\"/>
        <script type=\"text/javascript\" src=\"";
        // line 69
        echo twig_escape_filter($this->env, $this->env->getExtension('GantryTwig')->urlFunc("gantry-assets://js/matchmedia.polyfill.js"), "html", null, true);
        echo "\"></script>
        <![endif]-->
    ";
    }

    // line 73
    public function block_head($context, array $blocks = array())
    {
    }

    // line 74
    public function block_head_custom($context, array $blocks = array())
    {
        // line 75
        echo "        ";
        if ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "config", array()), "page", array()), "head", array()), "head_bottom", array())) {
            // line 76
            echo "        ";
            echo $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["gantry"]) ? $context["gantry"] : null), "config", array()), "page", array()), "head", array()), "head_bottom", array());
            echo "
        ";
        }
        // line 78
        echo "    ";
    }

    public function getTemplateName()
    {
        return "@nucleus/page_head.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  314 => 78,  308 => 76,  305 => 75,  302 => 74,  297 => 73,  290 => 69,  286 => 68,  282 => 67,  279 => 66,  276 => 65,  271 => 62,  266 => 61,  263 => 60,  258 => 56,  255 => 55,  251 => 53,  246 => 51,  241 => 50,  239 => 49,  236 => 48,  230 => 46,  228 => 45,  210 => 40,  206 => 39,  202 => 38,  200 => 37,  196 => 35,  193 => 34,  189 => 21,  179 => 18,  176 => 17,  172 => 16,  169 => 15,  164 => 13,  160 => 11,  150 => 8,  147 => 7,  143 => 6,  139 => 5,  135 => 4,  130 => 3,  127 => 2,  123 => 79,  120 => 74,  118 => 73,  116 => 65,  113 => 64,  111 => 60,  108 => 59,  106 => 55,  104 => 34,  100 => 32,  98 => 31,  95 => 30,  80 => 28,  77 => 27,  59 => 26,  57 => 25,  50 => 22,  48 => 15,  45 => 14,  43 => 13,  40 => 2,  28 => 1,);
    }
}
/* {% assets with { priority: 10 } %}*/
/*     {% block head_stylesheets -%}*/
/*         <link rel="stylesheet" href="{{ url('gantry-assets://css/font-awesome.min.css') }}" type="text/css"/>*/
/*         <link rel="stylesheet" href="{{ url('gantry-engine://css-compiled/nucleus.css') }}" type="text/css"/>*/
/*         <link rel="stylesheet" href="{{ url('gantry-assets://css/jquery.fullPage.css') }}" type="text/css"/>*/
/*         {% for css in gantry.theme.configuration.css.persistent|default(gantry.theme.configuration.css.files) %}*/
/*             {%- set url = url(gantry.theme.css(css)) %}{% if url %}*/
/*             <link rel="stylesheet" href="{{ url(gantry.theme.css(css)) }}" type="text/css"/>*/
/*         {% endif %}*/
/*         {%- endfor %}*/
/*     {% endblock -%}*/
/* */
/*     {% block head_platform %}{% endblock %}*/
/* */
/*     {% block head_overrides -%}*/
/*         {% for css in gantry.theme.configuration.css.overrides %}*/
/*             {%- set url = url(gantry.theme.css(css)) %}{% if url %}*/
/*             <link rel="stylesheet" href="{{ url(gantry.theme.css(css)) }}" type="text/css"/>*/
/*         {% endif %}*/
/*         {%- endfor %}*/
/*     {% endblock -%}*/
/*     <script type="text/javascript" src="{{ url('gantry-assets://js/jquery.fullPage.min.js') }}"></script>*/
/* {% endassets -%}*/
/* */
/* {% if gantry.config.page.head.atoms %}*/
/*     {% for atom in gantry.config.page.head.atoms %}*/
/*         {% include '@particles/' ~ atom.type ~ '.html.twig' with { particle: atom.attributes } %}*/
/*     {% endfor %}*/
/* {% endif %}*/
/* */
/* {% include '@particles/assets.html.twig' with { particle: gantry.config.page.assets|merge({'enabled': 1 }) } %}*/
/* */
/* <head>*/
/*     {% block head_meta %}*/
/*         <meta name="viewport" content="width=device-width, initial-scale=1.0">*/
/*         <meta http-equiv="X-UA-Compatible" content="IE=edge" />*/
/*         {% if gantry.config.page.head.meta -%}*/
/*             {% for attributes in gantry.config.page.head.meta -%}*/
/*                 {%- for key, value in attributes %}*/
/*                     <meta name="{{ key|e }}" property="{{ key|e }}" content="{{ value|e }}" />*/
/*                 {% endfor -%}*/
/*             {%- endfor -%}*/
/*         {%- endif -%}*/
/* */
/*         {% if gantry.config.page.assets.favicon %}*/
/*         <link rel="icon" type="image/x-icon" href="{{ url(gantry.config.page.assets.favicon) }}" />*/
/*         {% endif %}*/
/* */
/*         {% if gantry.config.page.assets.touchicon %}*/
/*         <link rel="apple-touch-icon" sizes="180x180" href="{{ url(gantry.config.page.assets.touchicon) }}">*/
/*         <link rel="icon" sizes="192x192" href="{{ url(gantry.config.page.assets.touchicon) }}">*/
/*         {% endif %}*/
/*     {% endblock %}*/
/* */
/*     {%- block head_title -%}*/
/*         <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />*/
/*         <title>Title</title>*/
/*     {%- endblock %}*/
/* */
/*     {% block head_application -%}*/
/*         {{ gantry.styles('head')|join("\n")|raw }}*/
/*         {{ gantry.scripts('head')|join("\n")|raw }}*/
/*     {%- endblock %}*/
/* */
/*     {% block head_ie_stylesheets -%}*/
/*         <!--[if (gte IE 8)&(lte IE 9)]>*/
/*         <script type="text/javascript" src="{{ url('gantry-assets://js/html5shiv-printshiv.min.js') }}"></script>*/
/*         <link rel="stylesheet" href="{{ url('gantry-engine://css/nucleus-ie9.css') }}" type="text/css"/>*/
/*         <script type="text/javascript" src="{{ url('gantry-assets://js/matchmedia.polyfill.js') }}"></script>*/
/*         <![endif]-->*/
/*     {% endblock -%}*/
/* */
/*     {% block head %}{% endblock %}*/
/*     {% block head_custom %}*/
/*         {% if gantry.config.page.head.head_bottom %}*/
/*         {{ gantry.config.page.head.head_bottom|raw }}*/
/*         {% endif %}*/
/*     {% endblock %}*/
/* </head>*/
