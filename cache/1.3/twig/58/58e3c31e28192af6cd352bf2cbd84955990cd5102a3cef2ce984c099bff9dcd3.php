<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* namespace.twig */
class __TwigTemplate_4fa6202cc5de43424d3c8b660f235fb3695d0fef44534a19a641bcbcdfce1369 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'body_class' => [$this, 'block_body_class'],
            'page_id' => [$this, 'block_page_id'],
            'below_menu' => [$this, 'block_below_menu'],
            'function_signature' => [$this, 'block_function_signature'],
            'function_parameters_signature' => [$this, 'block_function_parameters_signature'],
            'page_content' => [$this, 'block_page_content'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "layout/layout.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 2
        $macros["__internal_d0b79e8101ddc9032bddcfdfd7f3f343045f7a79f0ba005e2d31c3b30c28244d"] = $this->macros["__internal_d0b79e8101ddc9032bddcfdfd7f3f343045f7a79f0ba005e2d31c3b30c28244d"] = $this->loadTemplate("macros.twig", "namespace.twig", 2)->unwrap();
        // line 1
        $this->parent = $this->loadTemplate("layout/layout.twig", "namespace.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo (isset($context["namespace"]) || array_key_exists("namespace", $context) ? $context["namespace"] : (function () { throw new RuntimeError('Variable "namespace" does not exist.', 3, $this->source); })());
        echo " | ";
        $this->displayParentBlock("title", $context, $blocks);
    }

    // line 4
    public function block_body_class($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "namespace";
    }

    // line 5
    public function block_page_id($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo twig_escape_filter($this->env, ("namespace:" . twig_replace_filter((isset($context["namespace"]) || array_key_exists("namespace", $context) ? $context["namespace"] : (function () { throw new RuntimeError('Variable "namespace" does not exist.', 5, $this->source); })()), ["\\" => "_"])), "html", null, true);
    }

    // line 7
    public function block_below_menu($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 8
        echo "    <div class=\"namespace-breadcrumbs\">
        <ol class=\"breadcrumb\">
            <li><span class=\"label label-default\">";
        // line 10
        echo \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Namespace");
        echo "</span></li>
            ";
        // line 11
        echo twig_call_macro($macros["__internal_d0b79e8101ddc9032bddcfdfd7f3f343045f7a79f0ba005e2d31c3b30c28244d"], "macro_breadcrumbs", [(isset($context["namespace"]) || array_key_exists("namespace", $context) ? $context["namespace"] : (function () { throw new RuntimeError('Variable "namespace" does not exist.', 11, $this->source); })())], 11, $context, $this->getSourceContext());
        echo "
        </ol>
    </div>
";
    }

    // line 16
    public function block_function_signature($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 17
        if (twig_get_attribute($this->env, $this->source, (isset($context["function"]) || array_key_exists("function", $context) ? $context["function"] : (function () { throw new RuntimeError('Variable "function" does not exist.', 17, $this->source); })()), "final", [], "any", false, false, false, 17)) {
            echo "final";
        }
        // line 18
        echo "    ";
        if (twig_get_attribute($this->env, $this->source, (isset($context["function"]) || array_key_exists("function", $context) ? $context["function"] : (function () { throw new RuntimeError('Variable "function" does not exist.', 18, $this->source); })()), "abstract", [], "any", false, false, false, 18)) {
            echo "abstract";
        }
        // line 19
        echo "    ";
        if (twig_get_attribute($this->env, $this->source, (isset($context["function"]) || array_key_exists("function", $context) ? $context["function"] : (function () { throw new RuntimeError('Variable "function" does not exist.', 19, $this->source); })()), "static", [], "any", false, false, false, 19)) {
            echo "static";
        }
        // line 20
        echo "    ";
        if (twig_get_attribute($this->env, $this->source, (isset($context["function"]) || array_key_exists("function", $context) ? $context["function"] : (function () { throw new RuntimeError('Variable "function" does not exist.', 20, $this->source); })()), "protected", [], "any", false, false, false, 20)) {
            echo "protected";
        }
        // line 21
        echo "    ";
        if (twig_get_attribute($this->env, $this->source, (isset($context["function"]) || array_key_exists("function", $context) ? $context["function"] : (function () { throw new RuntimeError('Variable "function" does not exist.', 21, $this->source); })()), "private", [], "any", false, false, false, 21)) {
            echo "private";
        }
        // line 22
        echo "    ";
        echo twig_call_macro($macros["__internal_d0b79e8101ddc9032bddcfdfd7f3f343045f7a79f0ba005e2d31c3b30c28244d"], "macro_hint_link", [twig_get_attribute($this->env, $this->source, (isset($context["function"]) || array_key_exists("function", $context) ? $context["function"] : (function () { throw new RuntimeError('Variable "function" does not exist.', 22, $this->source); })()), "hint", [], "any", false, false, false, 22)], 22, $context, $this->getSourceContext());
        echo "
    <strong>";
        // line 23
        echo twig_get_attribute($this->env, $this->source, (isset($context["function"]) || array_key_exists("function", $context) ? $context["function"] : (function () { throw new RuntimeError('Variable "function" does not exist.', 23, $this->source); })()), "name", [], "any", false, false, false, 23);
        echo "</strong>";
        $this->displayBlock("function_parameters_signature", $context, $blocks);
    }

    // line 26
    public function block_function_parameters_signature($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 27
        $macros["__internal_54d463dd9b7adeb650b2f8d1f6f009f37d1edbbd38ec7fd3e3353db7559ae84b"] = $this->loadTemplate("macros.twig", "namespace.twig", 27)->unwrap();
        // line 28
        echo twig_call_macro($macros["__internal_54d463dd9b7adeb650b2f8d1f6f009f37d1edbbd38ec7fd3e3353db7559ae84b"], "macro_function_parameters_signature", [(isset($context["function"]) || array_key_exists("function", $context) ? $context["function"] : (function () { throw new RuntimeError('Variable "function" does not exist.', 28, $this->source); })())], 28, $context, $this->getSourceContext());
        echo "
    ";
        // line 29
        echo twig_call_macro($macros["__internal_d0b79e8101ddc9032bddcfdfd7f3f343045f7a79f0ba005e2d31c3b30c28244d"], "macro_deprecated", [(isset($context["function"]) || array_key_exists("function", $context) ? $context["function"] : (function () { throw new RuntimeError('Variable "function" does not exist.', 29, $this->source); })())], 29, $context, $this->getSourceContext());
    }

    // line 32
    public function block_page_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 33
        echo "
    <div class=\"page-header\">
        <h1>";
        // line 35
        echo (isset($context["namespace"]) || array_key_exists("namespace", $context) ? $context["namespace"] : (function () { throw new RuntimeError('Variable "namespace" does not exist.', 35, $this->source); })());
        echo "</h1>
    </div>

    ";
        // line 38
        if ((isset($context["subnamespaces"]) || array_key_exists("subnamespaces", $context) ? $context["subnamespaces"] : (function () { throw new RuntimeError('Variable "subnamespaces" does not exist.', 38, $this->source); })())) {
            // line 39
            echo "        <h2>";
            echo \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Namespaces");
            echo "</h2>
        <div class=\"namespace-list\">
            ";
            // line 41
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["subnamespaces"]) || array_key_exists("subnamespaces", $context) ? $context["subnamespaces"] : (function () { throw new RuntimeError('Variable "subnamespaces" does not exist.', 41, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["ns"]) {
                echo twig_call_macro($macros["__internal_d0b79e8101ddc9032bddcfdfd7f3f343045f7a79f0ba005e2d31c3b30c28244d"], "macro_namespace_link", [$context["ns"]], 41, $context, $this->getSourceContext());
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ns'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 42
            echo "        </div>
    ";
        }
        // line 44
        echo "
    ";
        // line 45
        if ((isset($context["classes"]) || array_key_exists("classes", $context) ? $context["classes"] : (function () { throw new RuntimeError('Variable "classes" does not exist.', 45, $this->source); })())) {
            // line 46
            echo "        <h2>";
            echo \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Classes");
            echo "</h2>";
            // line 47
            echo twig_call_macro($macros["__internal_d0b79e8101ddc9032bddcfdfd7f3f343045f7a79f0ba005e2d31c3b30c28244d"], "macro_render_classes", [(isset($context["classes"]) || array_key_exists("classes", $context) ? $context["classes"] : (function () { throw new RuntimeError('Variable "classes" does not exist.', 47, $this->source); })())], 47, $context, $this->getSourceContext());
        }
        // line 49
        echo "
    ";
        // line 50
        if ((isset($context["interfaces"]) || array_key_exists("interfaces", $context) ? $context["interfaces"] : (function () { throw new RuntimeError('Variable "interfaces" does not exist.', 50, $this->source); })())) {
            // line 51
            echo "        <h2>";
            echo \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Interfaces");
            echo "</h2>";
            // line 52
            echo twig_call_macro($macros["__internal_d0b79e8101ddc9032bddcfdfd7f3f343045f7a79f0ba005e2d31c3b30c28244d"], "macro_render_classes", [(isset($context["interfaces"]) || array_key_exists("interfaces", $context) ? $context["interfaces"] : (function () { throw new RuntimeError('Variable "interfaces" does not exist.', 52, $this->source); })())], 52, $context, $this->getSourceContext());
        }
        // line 54
        echo "
    ";
        // line 55
        if ((isset($context["functions"]) || array_key_exists("functions", $context) ? $context["functions"] : (function () { throw new RuntimeError('Variable "functions" does not exist.', 55, $this->source); })())) {
            // line 56
            echo "        <h2>";
            echo \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Functions");
            echo "</h2>

        <div class=\"container-fluid underlined\">
            ";
            // line 59
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["functions"]) || array_key_exists("functions", $context) ? $context["functions"] : (function () { throw new RuntimeError('Variable "functions" does not exist.', 59, $this->source); })()));
            $context['loop'] = [
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            ];
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["function"]) {
                // line 60
                echo "                <div class=\"row\" id=\"function_";
                echo twig_get_attribute($this->env, $this->source, $context["function"], "name", [], "any", false, false, false, 60);
                echo "\">
                    <div class=\"col-md-2 type\">
                        ";
                // line 62
                echo twig_call_macro($macros["__internal_d0b79e8101ddc9032bddcfdfd7f3f343045f7a79f0ba005e2d31c3b30c28244d"], "macro_hint_link", [twig_get_attribute($this->env, $this->source, $context["function"], "hint", [], "any", false, false, false, 62)], 62, $context, $this->getSourceContext());
                echo "
                    </div>
                    <div class=\"col-md-8 type\">
                        <a href=\"#function_";
                // line 65
                echo twig_get_attribute($this->env, $this->source, $context["function"], "name", [], "any", false, false, false, 65);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["function"], "name", [], "any", false, false, false, 65);
                echo "</a>";
                $this->displayBlock("function_parameters_signature", $context, $blocks);
                echo "
                        ";
                // line 66
                if ( !twig_get_attribute($this->env, $this->source, $context["function"], "shortdesc", [], "any", false, false, false, 66)) {
                    // line 67
                    echo "                            <p class=\"no-description\">";
                    echo \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("No description");
                    echo "</p>
                        ";
                } else {
                    // line 69
                    echo "                            <p>";
                    echo $this->extensions['Doctum\Renderer\TwigExtension']->parseDesc($context, twig_get_attribute($this->env, $this->source, $context["function"], "shortdesc", [], "any", false, false, false, 69), $context["function"]);
                    echo "</p>";
                }
                // line 71
                echo "                    </div>
                    <div class=\"col-md-2\">";
                // line 73
                if ( !(twig_get_attribute($this->env, $this->source, $context["function"], "namespace", [], "any", false, false, false, 73) === (isset($context["namespace"]) || array_key_exists("namespace", $context) ? $context["namespace"] : (function () { throw new RuntimeError('Variable "namespace" does not exist.', 73, $this->source); })()))) {
                    // line 74
                    echo "<em><a href=\"";
                    echo $this->extensions['Doctum\Renderer\TwigExtension']->pathForFunction($context, $context["function"]);
                    echo "\">";
                    echo $context["function"];
                    echo "</em>";
                }
                // line 76
                echo "</div>
                </div>
            ";
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['function'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 79
            echo "        </div>
    ";
        }
        // line 81
        echo "
    ";
        // line 82
        if ((isset($context["exceptions"]) || array_key_exists("exceptions", $context) ? $context["exceptions"] : (function () { throw new RuntimeError('Variable "exceptions" does not exist.', 82, $this->source); })())) {
            // line 83
            echo "        <h2>";
            echo \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Exceptions");
            echo "</h2>";
            // line 84
            echo twig_call_macro($macros["__internal_d0b79e8101ddc9032bddcfdfd7f3f343045f7a79f0ba005e2d31c3b30c28244d"], "macro_render_classes", [(isset($context["exceptions"]) || array_key_exists("exceptions", $context) ? $context["exceptions"] : (function () { throw new RuntimeError('Variable "exceptions" does not exist.', 84, $this->source); })())], 84, $context, $this->getSourceContext());
        }
        // line 86
        echo "
";
    }

    public function getTemplateName()
    {
        return "namespace.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  316 => 86,  313 => 84,  309 => 83,  307 => 82,  304 => 81,  300 => 79,  284 => 76,  277 => 74,  275 => 73,  272 => 71,  267 => 69,  261 => 67,  259 => 66,  251 => 65,  245 => 62,  239 => 60,  222 => 59,  215 => 56,  213 => 55,  210 => 54,  207 => 52,  203 => 51,  201 => 50,  198 => 49,  195 => 47,  191 => 46,  189 => 45,  186 => 44,  182 => 42,  173 => 41,  167 => 39,  165 => 38,  159 => 35,  155 => 33,  151 => 32,  147 => 29,  143 => 28,  141 => 27,  137 => 26,  131 => 23,  126 => 22,  121 => 21,  116 => 20,  111 => 19,  106 => 18,  102 => 17,  98 => 16,  90 => 11,  86 => 10,  82 => 8,  78 => 7,  71 => 5,  64 => 4,  55 => 3,  50 => 1,  48 => 2,  41 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"layout/layout.twig\" %}
{% from \"macros.twig\" import breadcrumbs, render_classes, class_link, namespace_link, hint_link, deprecated %}
{% block title %}{{ namespace|raw }} | {{ parent() }}{% endblock %}
{% block body_class 'namespace' %}
{% block page_id 'namespace:' ~ (namespace|replace({'\\\\': '_'})) %}

{% block below_menu %}
    <div class=\"namespace-breadcrumbs\">
        <ol class=\"breadcrumb\">
            <li><span class=\"label label-default\">{% trans 'Namespace' %}</span></li>
            {{ breadcrumbs(namespace) }}
        </ol>
    </div>
{% endblock %}

{% block function_signature -%}
    {% if function.final %}final{% endif %}
    {% if function.abstract %}abstract{% endif %}
    {% if function.static %}static{% endif %}
    {% if function.protected %}protected{% endif %}
    {% if function.private %}private{% endif %}
    {{ hint_link(function.hint) }}
    <strong>{{ function.name|raw }}</strong>{{ block('function_parameters_signature') }}
{%- endblock %}

{% block function_parameters_signature -%}
    {%- from \"macros.twig\" import function_parameters_signature -%}
    {{ function_parameters_signature(function) }}
    {{ deprecated(function) }}
{%- endblock %}

{% block page_content %}

    <div class=\"page-header\">
        <h1>{{ namespace|raw }}</h1>
    </div>

    {% if subnamespaces %}
        <h2>{% trans 'Namespaces' %}</h2>
        <div class=\"namespace-list\">
            {% for ns in subnamespaces %}{{ namespace_link(ns) }}{% endfor %}
        </div>
    {% endif %}

    {% if classes %}
        <h2>{% trans 'Classes' %}</h2>
        {{- render_classes(classes) -}}
    {% endif %}

    {% if interfaces %}
        <h2>{% trans 'Interfaces' %}</h2>
        {{- render_classes(interfaces) -}}
    {% endif %}

    {% if functions %}
        <h2>{% trans 'Functions' %}</h2>

        <div class=\"container-fluid underlined\">
            {% for function in functions %}
                <div class=\"row\" id=\"function_{{ function.name|raw }}\">
                    <div class=\"col-md-2 type\">
                        {{ hint_link(function.hint) }}
                    </div>
                    <div class=\"col-md-8 type\">
                        <a href=\"#function_{{ function.name|raw }}\">{{ function.name|raw }}</a>{{ block('function_parameters_signature') }}
                        {% if not function.shortdesc %}
                            <p class=\"no-description\">{% trans 'No description' %}</p>
                        {% else %}
                            <p>{{ function.shortdesc|desc(function) }}</p>
                        {%- endif %}
                    </div>
                    <div class=\"col-md-2\">
                        {%- if function.namespace is not same as(namespace) -%}
                            <em><a href=\"{{ function_path(function) }}\">{{ function|raw }}</em>
                        {%- endif -%}
                    </div>
                </div>
            {% endfor %}
        </div>
    {% endif %}

    {% if exceptions %}
        <h2>{% trans 'Exceptions' %}</h2>
        {{- render_classes(exceptions) -}}
    {% endif %}

{% endblock %}
", "namespace.twig", "/home/runner/work/laravel-mtn-momo/laravel-mtn-momo/vendor/code-lts/doctum/src/Resources/themes/default/namespace.twig");
    }
}
