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

/* class.twig */
class __TwigTemplate_348561877da77ae399848ad79dd3099e94077687c0306f26369e0c4194263c3f extends \Twig\Template
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
            'page_content' => [$this, 'block_page_content'],
            'class_signature' => [$this, 'block_class_signature'],
            'method_signature' => [$this, 'block_method_signature'],
            'method_parameters_signature' => [$this, 'block_method_parameters_signature'],
            'parameters' => [$this, 'block_parameters'],
            'return' => [$this, 'block_return'],
            'exceptions' => [$this, 'block_exceptions'],
            'see' => [$this, 'block_see'],
            'constants' => [$this, 'block_constants'],
            'properties' => [$this, 'block_properties'],
            'methods' => [$this, 'block_methods'],
            'methods_details' => [$this, 'block_methods_details'],
            'method' => [$this, 'block_method'],
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
        $macros["__internal_4c9f72ede042d8f04814f5daf7cb7250f07b8c230424446feb264f943af4ab72"] = $this->macros["__internal_4c9f72ede042d8f04814f5daf7cb7250f07b8c230424446feb264f943af4ab72"] = $this->loadTemplate("macros.twig", "class.twig", 2)->unwrap();
        // line 1
        $this->parent = $this->loadTemplate("layout/layout.twig", "class.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 3, $this->source); })());
        echo " | ";
        $this->displayParentBlock("title", $context, $blocks);
    }

    // line 4
    public function block_body_class($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "class";
    }

    // line 5
    public function block_page_id($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo twig_escape_filter($this->env, ("class:" . twig_replace_filter(twig_get_attribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 5, $this->source); })()), "name", [], "any", false, false, false, 5), ["\\" => "_"])), "html", null, true);
    }

    // line 7
    public function block_below_menu($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 8
        echo "    ";
        if (twig_get_attribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 8, $this->source); })()), "namespace", [], "any", false, false, false, 8)) {
            // line 9
            echo "        <div class=\"namespace-breadcrumbs\">
            <ol class=\"breadcrumb\">
                <li><span class=\"label label-default\">";
            // line 11
            echo twig_call_macro($macros["__internal_4c9f72ede042d8f04814f5daf7cb7250f07b8c230424446feb264f943af4ab72"], "macro_class_category_name", [twig_get_attribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 11, $this->source); })()), "getCategoryId", [], "method", false, false, false, 11)], 11, $context, $this->getSourceContext());
            echo "</span></li>
                ";
            // line 12
            echo twig_call_macro($macros["__internal_4c9f72ede042d8f04814f5daf7cb7250f07b8c230424446feb264f943af4ab72"], "macro_breadcrumbs", [twig_get_attribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 12, $this->source); })()), "namespace", [], "any", false, false, false, 12)], 12, $context, $this->getSourceContext());
            // line 13
            echo "<li>";
            echo twig_get_attribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 13, $this->source); })()), "shortname", [], "any", false, false, false, 13);
            echo "</li>
            </ol>
        </div>
    ";
        }
    }

    // line 19
    public function block_page_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 20
        echo "
    <div class=\"page-header\">
        <h1>
            ";
        // line 23
        echo twig_last($this->env, twig_split_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 23, $this->source); })()), "name", [], "any", false, false, false, 23), "\\"));
        echo "
            ";
        // line 24
        echo twig_call_macro($macros["__internal_4c9f72ede042d8f04814f5daf7cb7250f07b8c230424446feb264f943af4ab72"], "macro_deprecated", [(isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 24, $this->source); })())], 24, $context, $this->getSourceContext());
        echo "
        </h1>
    </div>

    <p>";
        // line 28
        $this->displayBlock("class_signature", $context, $blocks);
        echo "</p>

    ";
        // line 30
        echo twig_call_macro($macros["__internal_4c9f72ede042d8f04814f5daf7cb7250f07b8c230424446feb264f943af4ab72"], "macro_deprecations", [(isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 30, $this->source); })())], 30, $context, $this->getSourceContext());
        echo "

    ";
        // line 32
        if ((twig_get_attribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 32, $this->source); })()), "shortdesc", [], "any", false, false, false, 32) || twig_get_attribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 32, $this->source); })()), "longdesc", [], "any", false, false, false, 32))) {
            // line 33
            echo "        <div class=\"description\">
            ";
            // line 34
            if (twig_get_attribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 34, $this->source); })()), "shortdesc", [], "any", false, false, false, 34)) {
                // line 35
                echo "<p>";
                echo $this->extensions['Doctum\Renderer\TwigExtension']->parseDesc($context, twig_get_attribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 35, $this->source); })()), "shortdesc", [], "any", false, false, false, 35), (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 35, $this->source); })()));
                echo "</p>";
            }
            // line 37
            echo "            ";
            if (twig_get_attribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 37, $this->source); })()), "longdesc", [], "any", false, false, false, 37)) {
                // line 38
                echo "<p>";
                echo $this->extensions['Doctum\Renderer\TwigExtension']->parseDesc($context, twig_get_attribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 38, $this->source); })()), "longdesc", [], "any", false, false, false, 38), (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 38, $this->source); })()));
                echo "</p>";
            }
            // line 40
            echo "            ";
            if ((twig_get_attribute($this->env, $this->source, (isset($context["project"]) || array_key_exists("project", $context) ? $context["project"] : (function () { throw new RuntimeError('Variable "project" does not exist.', 40, $this->source); })()), "config", [0 => "insert_todos"], "method", false, false, false, 40) == true)) {
                // line 41
                echo "                ";
                echo twig_call_macro($macros["__internal_4c9f72ede042d8f04814f5daf7cb7250f07b8c230424446feb264f943af4ab72"], "macro_todos", [(isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 41, $this->source); })())], 41, $context, $this->getSourceContext());
                echo "
            ";
            }
            // line 43
            echo "        </div>
    ";
        }
        // line 45
        echo "
    ";
        // line 46
        if ((isset($context["traits"]) || array_key_exists("traits", $context) ? $context["traits"] : (function () { throw new RuntimeError('Variable "traits" does not exist.', 46, $this->source); })())) {
            // line 47
            echo "        <h2>";
            echo \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Traits");
            echo "</h2>

        ";
            // line 49
            echo twig_call_macro($macros["__internal_4c9f72ede042d8f04814f5daf7cb7250f07b8c230424446feb264f943af4ab72"], "macro_render_classes", [(isset($context["traits"]) || array_key_exists("traits", $context) ? $context["traits"] : (function () { throw new RuntimeError('Variable "traits" does not exist.', 49, $this->source); })())], 49, $context, $this->getSourceContext());
            echo "
    ";
        }
        // line 51
        echo "
    ";
        // line 52
        if ((isset($context["constants"]) || array_key_exists("constants", $context) ? $context["constants"] : (function () { throw new RuntimeError('Variable "constants" does not exist.', 52, $this->source); })())) {
            // line 53
            echo "        <h2>";
            echo \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Constants");
            echo "</h2>

        ";
            // line 55
            $this->displayBlock("constants", $context, $blocks);
            echo "
    ";
        }
        // line 57
        echo "
    ";
        // line 58
        if ((isset($context["properties"]) || array_key_exists("properties", $context) ? $context["properties"] : (function () { throw new RuntimeError('Variable "properties" does not exist.', 58, $this->source); })())) {
            // line 59
            echo "        <h2>";
            echo \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Properties");
            echo "</h2>

        ";
            // line 61
            $this->displayBlock("properties", $context, $blocks);
            echo "
    ";
        }
        // line 63
        echo "
    ";
        // line 64
        if ((isset($context["methods"]) || array_key_exists("methods", $context) ? $context["methods"] : (function () { throw new RuntimeError('Variable "methods" does not exist.', 64, $this->source); })())) {
            // line 65
            echo "        <h2>";
            echo \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Methods");
            echo "</h2>

        ";
            // line 67
            $this->displayBlock("methods", $context, $blocks);
            echo "

        <h2>";
            // line 69
            echo \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Details");
            echo "</h2>

        ";
            // line 71
            $this->displayBlock("methods_details", $context, $blocks);
            echo "
    ";
        }
        // line 73
        echo "
";
    }

    // line 76
    public function block_class_signature($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 77
        if (twig_get_attribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 77, $this->source); })()), "final", [], "any", false, false, false, 77)) {
            echo "final ";
        }
        // line 78
        echo "    ";
        if (( !twig_get_attribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 78, $this->source); })()), "interface", [], "any", false, false, false, 78) && twig_get_attribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 78, $this->source); })()), "abstract", [], "any", false, false, false, 78))) {
            echo "abstract ";
        }
        // line 79
        echo "    ";
        echo twig_call_macro($macros["__internal_4c9f72ede042d8f04814f5daf7cb7250f07b8c230424446feb264f943af4ab72"], "macro_class_category_name", [twig_get_attribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 79, $this->source); })()), "getCategoryId", [], "method", false, false, false, 79)], 79, $context, $this->getSourceContext());
        echo "
    <strong>";
        // line 80
        echo twig_get_attribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 80, $this->source); })()), "shortname", [], "any", false, false, false, 80);
        echo "</strong>";
        // line 81
        if (twig_get_attribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 81, $this->source); })()), "parent", [], "any", false, false, false, 81)) {
            // line 82
            echo "        extends ";
            echo twig_call_macro($macros["__internal_4c9f72ede042d8f04814f5daf7cb7250f07b8c230424446feb264f943af4ab72"], "macro_class_link", [twig_get_attribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 82, $this->source); })()), "parent", [], "any", false, false, false, 82)], 82, $context, $this->getSourceContext());
        }
        // line 84
        if ((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 84, $this->source); })()), "interfaces", [], "any", false, false, false, 84)) > 0)) {
            // line 85
            echo "        implements
        ";
            // line 86
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 86, $this->source); })()), "interfaces", [], "any", false, false, false, 86));
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
            foreach ($context['_seq'] as $context["_key"] => $context["interface"]) {
                // line 87
                echo twig_call_macro($macros["__internal_4c9f72ede042d8f04814f5daf7cb7250f07b8c230424446feb264f943af4ab72"], "macro_class_link", [$context["interface"]], 87, $context, $this->getSourceContext());
                // line 88
                if ( !twig_get_attribute($this->env, $this->source, $context["loop"], "last", [], "any", false, false, false, 88)) {
                    echo ", ";
                }
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['interface'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
        // line 91
        echo twig_call_macro($macros["__internal_4c9f72ede042d8f04814f5daf7cb7250f07b8c230424446feb264f943af4ab72"], "macro_source_link", [(isset($context["project"]) || array_key_exists("project", $context) ? $context["project"] : (function () { throw new RuntimeError('Variable "project" does not exist.', 91, $this->source); })()), (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 91, $this->source); })())], 91, $context, $this->getSourceContext());
        echo "
";
    }

    // line 94
    public function block_method_signature($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 95
        if (twig_get_attribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 95, $this->source); })()), "final", [], "any", false, false, false, 95)) {
            echo "final";
        }
        // line 96
        echo "    ";
        if (twig_get_attribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 96, $this->source); })()), "abstract", [], "any", false, false, false, 96)) {
            echo "abstract";
        }
        // line 97
        echo "    ";
        if (twig_get_attribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 97, $this->source); })()), "static", [], "any", false, false, false, 97)) {
            echo "static";
        }
        // line 98
        echo "    ";
        if (twig_get_attribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 98, $this->source); })()), "protected", [], "any", false, false, false, 98)) {
            echo "protected";
        }
        // line 99
        echo "    ";
        if (twig_get_attribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 99, $this->source); })()), "private", [], "any", false, false, false, 99)) {
            echo "private";
        }
        // line 100
        echo "    ";
        echo twig_call_macro($macros["__internal_4c9f72ede042d8f04814f5daf7cb7250f07b8c230424446feb264f943af4ab72"], "macro_hint_link", [twig_get_attribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 100, $this->source); })()), "hint", [], "any", false, false, false, 100)], 100, $context, $this->getSourceContext());
        echo "
    <strong>";
        // line 101
        echo twig_get_attribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 101, $this->source); })()), "name", [], "any", false, false, false, 101);
        echo "</strong>";
        $this->displayBlock("method_parameters_signature", $context, $blocks);
    }

    // line 104
    public function block_method_parameters_signature($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 105
        $macros["__internal_16767139f8562fb74e1db6e521b453d7567b8906eee93fab41e1b1e423df66e9"] = $this->loadTemplate("macros.twig", "class.twig", 105)->unwrap();
        // line 106
        echo twig_call_macro($macros["__internal_16767139f8562fb74e1db6e521b453d7567b8906eee93fab41e1b1e423df66e9"], "macro_method_parameters_signature", [(isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 106, $this->source); })())], 106, $context, $this->getSourceContext());
        echo "
    ";
        // line 107
        echo twig_call_macro($macros["__internal_4c9f72ede042d8f04814f5daf7cb7250f07b8c230424446feb264f943af4ab72"], "macro_deprecated", [(isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 107, $this->source); })())], 107, $context, $this->getSourceContext());
    }

    // line 110
    public function block_parameters($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 111
        echo "    <table class=\"table table-condensed\">
        ";
        // line 112
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 112, $this->source); })()), "parameters", [], "any", false, false, false, 112));
        foreach ($context['_seq'] as $context["_key"] => $context["parameter"]) {
            // line 113
            echo "            <tr>
                <td>";
            // line 114
            if (twig_get_attribute($this->env, $this->source, $context["parameter"], "hint", [], "any", false, false, false, 114)) {
                echo twig_call_macro($macros["__internal_4c9f72ede042d8f04814f5daf7cb7250f07b8c230424446feb264f943af4ab72"], "macro_hint_link", [twig_get_attribute($this->env, $this->source, $context["parameter"], "hint", [], "any", false, false, false, 114)], 114, $context, $this->getSourceContext());
            }
            echo "</td>
                <td>";
            // line 115
            if (twig_get_attribute($this->env, $this->source, $context["parameter"], "variadic", [], "any", false, false, false, 115)) {
                echo "...";
            }
            echo "\$";
            echo twig_get_attribute($this->env, $this->source, $context["parameter"], "name", [], "any", false, false, false, 115);
            echo "</td>
                <td>";
            // line 116
            echo $this->extensions['Doctum\Renderer\TwigExtension']->parseDesc($context, twig_get_attribute($this->env, $this->source, $context["parameter"], "shortdesc", [], "any", false, false, false, 116), (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 116, $this->source); })()));
            echo "</td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['parameter'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 119
        echo "    </table>
";
    }

    // line 122
    public function block_return($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 123
        echo "    <table class=\"table table-condensed\">
        <tr>
            <td>";
        // line 125
        echo twig_call_macro($macros["__internal_4c9f72ede042d8f04814f5daf7cb7250f07b8c230424446feb264f943af4ab72"], "macro_hint_link", [twig_get_attribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 125, $this->source); })()), "hint", [], "any", false, false, false, 125)], 125, $context, $this->getSourceContext());
        echo "</td>
            <td>";
        // line 126
        echo $this->extensions['Doctum\Renderer\TwigExtension']->parseDesc($context, twig_get_attribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 126, $this->source); })()), "hintDesc", [], "any", false, false, false, 126), (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 126, $this->source); })()));
        echo "</td>
        </tr>
    </table>
";
    }

    // line 131
    public function block_exceptions($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 132
        echo "    <table class=\"table table-condensed\">
        ";
        // line 133
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 133, $this->source); })()), "exceptions", [], "any", false, false, false, 133));
        foreach ($context['_seq'] as $context["_key"] => $context["exception"]) {
            // line 134
            echo "            <tr>
                <td>";
            // line 135
            echo twig_call_macro($macros["__internal_4c9f72ede042d8f04814f5daf7cb7250f07b8c230424446feb264f943af4ab72"], "macro_class_link", [twig_get_attribute($this->env, $this->source, $context["exception"], 0, [], "array", false, false, false, 135)], 135, $context, $this->getSourceContext());
            echo "</td>
                <td>";
            // line 136
            echo $this->extensions['Doctum\Renderer\TwigExtension']->parseDesc($context, twig_get_attribute($this->env, $this->source, $context["exception"], 1, [], "array", false, false, false, 136), (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 136, $this->source); })()));
            echo "</td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['exception'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 139
        echo "    </table>
";
    }

    // line 142
    public function block_see($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 143
        echo "    <table class=\"table table-condensed\">
        ";
        // line 144
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 144, $this->source); })()), "see", [], "any", false, false, false, 144));
        foreach ($context['_seq'] as $context["_key"] => $context["see"]) {
            // line 145
            echo "            <tr>
                <td>
                    ";
            // line 147
            if (twig_get_attribute($this->env, $this->source, $context["see"], 4, [], "array", false, false, false, 147)) {
                // line 148
                echo "                        <a href=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["see"], 4, [], "array", false, false, false, 148), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["see"], 4, [], "array", false, false, false, 148), "html", null, true);
                echo "</a>
                    ";
            } elseif (twig_get_attribute($this->env, $this->source,             // line 149
$context["see"], 3, [], "array", false, false, false, 149)) {
                // line 150
                echo "                        ";
                echo twig_call_macro($macros["__internal_4c9f72ede042d8f04814f5daf7cb7250f07b8c230424446feb264f943af4ab72"], "macro_method_link", [twig_get_attribute($this->env, $this->source, $context["see"], 3, [], "array", false, false, false, 150), false, false], 150, $context, $this->getSourceContext());
                echo "
                    ";
            } elseif (twig_get_attribute($this->env, $this->source,             // line 151
$context["see"], 2, [], "array", false, false, false, 151)) {
                // line 152
                echo "                        ";
                echo twig_call_macro($macros["__internal_4c9f72ede042d8f04814f5daf7cb7250f07b8c230424446feb264f943af4ab72"], "macro_class_link", [twig_get_attribute($this->env, $this->source, $context["see"], 2, [], "array", false, false, false, 152)], 152, $context, $this->getSourceContext());
                echo "
                    ";
            } else {
                // line 154
                echo "                        ";
                echo twig_get_attribute($this->env, $this->source, $context["see"], 0, [], "array", false, false, false, 154);
                echo "
                    ";
            }
            // line 156
            echo "                </td>
                <td>";
            // line 157
            echo twig_get_attribute($this->env, $this->source, $context["see"], 1, [], "array", false, false, false, 157);
            echo "</td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['see'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 160
        echo "    </table>
";
    }

    // line 163
    public function block_constants($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 164
        echo "    <table class=\"table table-condensed\">
        ";
        // line 165
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["constants"]) || array_key_exists("constants", $context) ? $context["constants"] : (function () { throw new RuntimeError('Variable "constants" does not exist.', 165, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["constant"]) {
            // line 166
            echo "            <tr>
                <td>";
            // line 167
            echo twig_get_attribute($this->env, $this->source, $context["constant"], "name", [], "any", false, false, false, 167);
            echo "</td>
                <td class=\"last\">
                    <p><em>";
            // line 169
            echo $this->extensions['Doctum\Renderer\TwigExtension']->parseDesc($context, twig_get_attribute($this->env, $this->source, $context["constant"], "shortdesc", [], "any", false, false, false, 169), (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 169, $this->source); })()));
            echo "</em></p>
                    <p>";
            // line 170
            echo $this->extensions['Doctum\Renderer\TwigExtension']->parseDesc($context, twig_get_attribute($this->env, $this->source, $context["constant"], "longdesc", [], "any", false, false, false, 170), (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 170, $this->source); })()));
            echo "</p>
                </td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['constant'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 174
        echo "    </table>
";
    }

    // line 177
    public function block_properties($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 178
        echo "    <table class=\"table table-condensed\">
        ";
        // line 179
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["properties"]) || array_key_exists("properties", $context) ? $context["properties"] : (function () { throw new RuntimeError('Variable "properties" does not exist.', 179, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["property"]) {
            // line 180
            echo "            <tr>
                <td class=\"type\" id=\"property_";
            // line 181
            echo twig_get_attribute($this->env, $this->source, $context["property"], "name", [], "any", false, false, false, 181);
            echo "\">
                    ";
            // line 182
            if (twig_get_attribute($this->env, $this->source, $context["property"], "static", [], "any", false, false, false, 182)) {
                echo "static";
            }
            // line 183
            echo "                    ";
            if (twig_get_attribute($this->env, $this->source, $context["property"], "protected", [], "any", false, false, false, 183)) {
                echo "protected";
            }
            // line 184
            echo "                    ";
            if (twig_get_attribute($this->env, $this->source, $context["property"], "private", [], "any", false, false, false, 184)) {
                echo "private";
            }
            // line 185
            echo "                    ";
            echo twig_call_macro($macros["__internal_4c9f72ede042d8f04814f5daf7cb7250f07b8c230424446feb264f943af4ab72"], "macro_hint_link", [twig_get_attribute($this->env, $this->source, $context["property"], "hint", [], "any", false, false, false, 185)], 185, $context, $this->getSourceContext());
            echo "
                </td>
                <td>\$";
            // line 187
            echo twig_get_attribute($this->env, $this->source, $context["property"], "name", [], "any", false, false, false, 187);
            echo "</td>
                <td class=\"last\">";
            // line 188
            echo $this->extensions['Doctum\Renderer\TwigExtension']->parseDesc($context, twig_get_attribute($this->env, $this->source, $context["property"], "shortdesc", [], "any", false, false, false, 188), (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 188, $this->source); })()));
            echo "</td>
                <td>";
            // line 190
            if ( !(twig_get_attribute($this->env, $this->source, $context["property"], "class", [], "any", false, false, false, 190) === (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 190, $this->source); })()))) {
                // line 191
                echo "<small>";
                echo sprintf(\Wdes\phpI18nL10n\Launcher::gettext("from&nbsp;%s"), twig_call_macro($macros["__internal_4c9f72ede042d8f04814f5daf7cb7250f07b8c230424446feb264f943af4ab72"], "macro_property_link", [$context["property"], false, true], 191, $context, $this->getSourceContext()));
                echo "</small>";
            }
            // line 193
            echo "</td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['property'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 196
        echo "    </table>
";
    }

    // line 199
    public function block_methods($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 200
        echo "    <div class=\"container-fluid underlined\">
        ";
        // line 201
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["methods"]) || array_key_exists("methods", $context) ? $context["methods"] : (function () { throw new RuntimeError('Variable "methods" does not exist.', 201, $this->source); })()));
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
        foreach ($context['_seq'] as $context["_key"] => $context["method"]) {
            // line 202
            echo "            <div class=\"row\">
                <div class=\"col-md-2 type\">
                    ";
            // line 204
            if (twig_get_attribute($this->env, $this->source, $context["method"], "static", [], "any", false, false, false, 204)) {
                echo "static&nbsp;";
            }
            echo twig_call_macro($macros["__internal_4c9f72ede042d8f04814f5daf7cb7250f07b8c230424446feb264f943af4ab72"], "macro_hint_link", [twig_get_attribute($this->env, $this->source, $context["method"], "hint", [], "any", false, false, false, 204)], 204, $context, $this->getSourceContext());
            echo "
                </div>
                <div class=\"col-md-8 type\">
                    <a href=\"#method_";
            // line 207
            echo twig_get_attribute($this->env, $this->source, $context["method"], "name", [], "any", false, false, false, 207);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["method"], "name", [], "any", false, false, false, 207);
            echo "</a>";
            $this->displayBlock("method_parameters_signature", $context, $blocks);
            echo "
                    ";
            // line 208
            if ( !twig_get_attribute($this->env, $this->source, $context["method"], "shortdesc", [], "any", false, false, false, 208)) {
                // line 209
                echo "                        <p class=\"no-description\">";
                echo \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("No description");
                echo "</p>
                    ";
            } else {
                // line 211
                echo "                        <p>";
                echo $this->extensions['Doctum\Renderer\TwigExtension']->parseDesc($context, twig_get_attribute($this->env, $this->source, $context["method"], "shortdesc", [], "any", false, false, false, 211), (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 211, $this->source); })()));
                echo "</p>";
            }
            // line 213
            echo "                </div>
                <div class=\"col-md-2\">";
            // line 215
            if ( !(twig_get_attribute($this->env, $this->source, $context["method"], "class", [], "any", false, false, false, 215) === (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 215, $this->source); })()))) {
                // line 216
                echo "<small>";
                echo sprintf(\Wdes\phpI18nL10n\Launcher::gettext("from&nbsp;%s"), twig_call_macro($macros["__internal_4c9f72ede042d8f04814f5daf7cb7250f07b8c230424446feb264f943af4ab72"], "macro_method_link", [$context["method"], false, true], 216, $context, $this->getSourceContext()));
                echo "</small>";
            }
            // line 218
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['method'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 221
        echo "    </div>
";
    }

    // line 224
    public function block_methods_details($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 225
        echo "    <div id=\"method-details\">
        ";
        // line 226
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["methods"]) || array_key_exists("methods", $context) ? $context["methods"] : (function () { throw new RuntimeError('Variable "methods" does not exist.', 226, $this->source); })()));
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
        foreach ($context['_seq'] as $context["_key"] => $context["method"]) {
            // line 227
            echo "            <div class=\"method-item\">
                ";
            // line 228
            $this->displayBlock("method", $context, $blocks);
            echo "
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['method'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 231
        echo "    </div>
";
    }

    // line 234
    public function block_method($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 235
        echo "    <h3 id=\"method_";
        echo twig_get_attribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 235, $this->source); })()), "name", [], "any", false, false, false, 235);
        echo "\">
        <div class=\"location\">";
        // line 236
        if ( !(twig_get_attribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 236, $this->source); })()), "class", [], "any", false, false, false, 236) === (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 236, $this->source); })()))) {
            echo sprintf(\Wdes\phpI18nL10n\Launcher::gettext("in %s"), twig_call_macro($macros["__internal_4c9f72ede042d8f04814f5daf7cb7250f07b8c230424446feb264f943af4ab72"], "macro_method_link", [(isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 236, $this->source); })()), false, true], 236, $context, $this->getSourceContext()));
            echo " ";
        }
        echo twig_call_macro($macros["__internal_4c9f72ede042d8f04814f5daf7cb7250f07b8c230424446feb264f943af4ab72"], "macro_method_source_link", [(isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 236, $this->source); })())], 236, $context, $this->getSourceContext());
        echo "</div>
        <code>";
        // line 237
        $this->displayBlock("method_signature", $context, $blocks);
        echo "</code>
    </h3>
    <div class=\"details\">
        ";
        // line 240
        echo twig_call_macro($macros["__internal_4c9f72ede042d8f04814f5daf7cb7250f07b8c230424446feb264f943af4ab72"], "macro_deprecations", [(isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 240, $this->source); })())], 240, $context, $this->getSourceContext());
        echo "

        ";
        // line 242
        if ((twig_get_attribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 242, $this->source); })()), "shortdesc", [], "any", false, false, false, 242) || twig_get_attribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 242, $this->source); })()), "longdesc", [], "any", false, false, false, 242))) {
            // line 243
            echo "            <div class=\"method-description\">
                ";
            // line 244
            if (( !twig_get_attribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 244, $this->source); })()), "shortdesc", [], "any", false, false, false, 244) &&  !twig_get_attribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 244, $this->source); })()), "longdesc", [], "any", false, false, false, 244))) {
                // line 245
                echo "                    <p class=\"no-description\">";
                echo \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("No description");
                echo "</p>
                ";
            } else {
                // line 247
                echo "                    ";
                if (twig_get_attribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 247, $this->source); })()), "shortdesc", [], "any", false, false, false, 247)) {
                    // line 248
                    echo "<p>";
                    echo $this->extensions['Doctum\Renderer\TwigExtension']->parseDesc($context, twig_get_attribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 248, $this->source); })()), "shortdesc", [], "any", false, false, false, 248), (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 248, $this->source); })()));
                    echo "</p>";
                }
                // line 250
                echo "                    ";
                if (twig_get_attribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 250, $this->source); })()), "longdesc", [], "any", false, false, false, 250)) {
                    // line 251
                    echo "<p>";
                    echo $this->extensions['Doctum\Renderer\TwigExtension']->parseDesc($context, twig_get_attribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 251, $this->source); })()), "longdesc", [], "any", false, false, false, 251), (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 251, $this->source); })()));
                    echo "</p>";
                }
            }
            // line 254
            echo "                ";
            if ((twig_get_attribute($this->env, $this->source, (isset($context["project"]) || array_key_exists("project", $context) ? $context["project"] : (function () { throw new RuntimeError('Variable "project" does not exist.', 254, $this->source); })()), "config", [0 => "insert_todos"], "method", false, false, false, 254) == true)) {
                // line 255
                echo "                    ";
                echo twig_call_macro($macros["__internal_4c9f72ede042d8f04814f5daf7cb7250f07b8c230424446feb264f943af4ab72"], "macro_todos", [(isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 255, $this->source); })())], 255, $context, $this->getSourceContext());
                echo "
                ";
            }
            // line 257
            echo "            </div>
        ";
        }
        // line 259
        echo "        <div class=\"tags\">
            ";
        // line 260
        if (twig_get_attribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 260, $this->source); })()), "parameters", [], "any", false, false, false, 260)) {
            // line 261
            echo "                <h4>";
            echo \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Parameters");
            echo "</h4>

                ";
            // line 263
            $this->displayBlock("parameters", $context, $blocks);
            echo "
            ";
        }
        // line 265
        echo "
            ";
        // line 266
        if ((twig_get_attribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 266, $this->source); })()), "hintDesc", [], "any", false, false, false, 266) || twig_get_attribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 266, $this->source); })()), "hint", [], "any", false, false, false, 266))) {
            // line 267
            echo "                <h4>";
            echo \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Return Value");
            echo "</h4>

                ";
            // line 269
            $this->displayBlock("return", $context, $blocks);
            echo "
            ";
        }
        // line 271
        echo "
            ";
        // line 272
        if (twig_get_attribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 272, $this->source); })()), "exceptions", [], "any", false, false, false, 272)) {
            // line 273
            echo "                <h4>";
            echo \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Exceptions");
            echo "</h4>

                ";
            // line 275
            $this->displayBlock("exceptions", $context, $blocks);
            echo "
            ";
        }
        // line 277
        echo "
            ";
        // line 278
        if (twig_get_attribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 278, $this->source); })()), "tags", [0 => "see"], "method", false, false, false, 278)) {
            // line 279
            echo "                <h4>";
            echo \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("See also");
            echo "</h4>

                ";
            // line 281
            $this->displayBlock("see", $context, $blocks);
            echo "
            ";
        }
        // line 283
        echo "        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "class.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  917 => 283,  912 => 281,  906 => 279,  904 => 278,  901 => 277,  896 => 275,  890 => 273,  888 => 272,  885 => 271,  880 => 269,  874 => 267,  872 => 266,  869 => 265,  864 => 263,  858 => 261,  856 => 260,  853 => 259,  849 => 257,  843 => 255,  840 => 254,  834 => 251,  831 => 250,  826 => 248,  823 => 247,  817 => 245,  815 => 244,  812 => 243,  810 => 242,  805 => 240,  799 => 237,  791 => 236,  786 => 235,  782 => 234,  777 => 231,  760 => 228,  757 => 227,  740 => 226,  737 => 225,  733 => 224,  728 => 221,  712 => 218,  707 => 216,  705 => 215,  702 => 213,  697 => 211,  691 => 209,  689 => 208,  681 => 207,  672 => 204,  668 => 202,  651 => 201,  648 => 200,  644 => 199,  639 => 196,  631 => 193,  626 => 191,  624 => 190,  620 => 188,  616 => 187,  610 => 185,  605 => 184,  600 => 183,  596 => 182,  592 => 181,  589 => 180,  585 => 179,  582 => 178,  578 => 177,  573 => 174,  563 => 170,  559 => 169,  554 => 167,  551 => 166,  547 => 165,  544 => 164,  540 => 163,  535 => 160,  526 => 157,  523 => 156,  517 => 154,  511 => 152,  509 => 151,  504 => 150,  502 => 149,  495 => 148,  493 => 147,  489 => 145,  485 => 144,  482 => 143,  478 => 142,  473 => 139,  464 => 136,  460 => 135,  457 => 134,  453 => 133,  450 => 132,  446 => 131,  438 => 126,  434 => 125,  430 => 123,  426 => 122,  421 => 119,  412 => 116,  404 => 115,  398 => 114,  395 => 113,  391 => 112,  388 => 111,  384 => 110,  380 => 107,  376 => 106,  374 => 105,  370 => 104,  364 => 101,  359 => 100,  354 => 99,  349 => 98,  344 => 97,  339 => 96,  335 => 95,  331 => 94,  325 => 91,  308 => 88,  306 => 87,  289 => 86,  286 => 85,  284 => 84,  280 => 82,  278 => 81,  275 => 80,  270 => 79,  265 => 78,  261 => 77,  257 => 76,  252 => 73,  247 => 71,  242 => 69,  237 => 67,  231 => 65,  229 => 64,  226 => 63,  221 => 61,  215 => 59,  213 => 58,  210 => 57,  205 => 55,  199 => 53,  197 => 52,  194 => 51,  189 => 49,  183 => 47,  181 => 46,  178 => 45,  174 => 43,  168 => 41,  165 => 40,  160 => 38,  157 => 37,  152 => 35,  150 => 34,  147 => 33,  145 => 32,  140 => 30,  135 => 28,  128 => 24,  124 => 23,  119 => 20,  115 => 19,  105 => 13,  103 => 12,  99 => 11,  95 => 9,  92 => 8,  88 => 7,  81 => 5,  74 => 4,  65 => 3,  60 => 1,  58 => 2,  51 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"layout/layout.twig\" %}
{% from \"macros.twig\" import render_classes, breadcrumbs, namespace_link, class_link, property_link, method_link, hint_link, source_link, method_source_link, deprecated, deprecations, todo, todos, class_category_name %}
{% block title %}{{ class|raw }} | {{ parent() }}{% endblock %}
{% block body_class 'class' %}
{% block page_id 'class:' ~ (class.name|replace({'\\\\': '_'})) %}

{% block below_menu %}
    {% if class.namespace %}
        <div class=\"namespace-breadcrumbs\">
            <ol class=\"breadcrumb\">
                <li><span class=\"label label-default\">{{ class_category_name(class.getCategoryId()) }}</span></li>
                {{ breadcrumbs(class.namespace) -}}
                <li>{{ class.shortname|raw }}</li>
            </ol>
        </div>
    {% endif %}
{% endblock %}

{% block page_content %}

    <div class=\"page-header\">
        <h1>
            {{ class.name|split('\\\\')|last|raw }}
            {{ deprecated(class) }}
        </h1>
    </div>

    <p>{{ block('class_signature') }}</p>

    {{ deprecations(class) }}

    {% if class.shortdesc or class.longdesc %}
        <div class=\"description\">
            {% if class.shortdesc -%}
                <p>{{ class.shortdesc|desc(class) }}</p>
            {%- endif %}
            {% if class.longdesc -%}
                <p>{{ class.longdesc|desc(class) }}</p>
            {%- endif %}
            {% if project.config('insert_todos') == true %}
                {{ todos(class) }}
            {% endif %}
        </div>
    {% endif %}

    {% if traits %}
        <h2>{% trans 'Traits' %}</h2>

        {{ render_classes(traits) }}
    {% endif %}

    {% if constants %}
        <h2>{% trans 'Constants' %}</h2>

        {{ block('constants') }}
    {% endif %}

    {% if properties %}
        <h2>{% trans 'Properties' %}</h2>

        {{ block('properties') }}
    {% endif %}

    {% if methods %}
        <h2>{% trans 'Methods' %}</h2>

        {{ block('methods') }}

        <h2>{% trans 'Details' %}</h2>

        {{ block('methods_details') }}
    {% endif %}

{% endblock %}

{% block class_signature -%}
    {% if class.final %}final {% endif %}
    {% if not class.interface and class.abstract %}abstract {% endif %}
    {{ class_category_name(class.getCategoryId()) }}
    <strong>{{ class.shortname|raw }}</strong>
    {%- if class.parent %}
        extends {{ class_link(class.parent) }}
    {%- endif %}
    {%- if class.interfaces|length > 0 %}
        implements
        {% for interface in class.interfaces %}
            {{- class_link(interface) }}
            {%- if not loop.last %}, {% endif %}
        {%- endfor %}
    {%- endif %}
    {{- source_link(project, class) }}
{% endblock %}

{% block method_signature -%}
    {% if method.final %}final{% endif %}
    {% if method.abstract %}abstract{% endif %}
    {% if method.static %}static{% endif %}
    {% if method.protected %}protected{% endif %}
    {% if method.private %}private{% endif %}
    {{ hint_link(method.hint) }}
    <strong>{{ method.name|raw }}</strong>{{ block('method_parameters_signature') }}
{%- endblock %}

{% block method_parameters_signature -%}
    {%- from \"macros.twig\" import method_parameters_signature -%}
    {{ method_parameters_signature(method) }}
    {{ deprecated(method) }}
{%- endblock %}

{% block parameters %}
    <table class=\"table table-condensed\">
        {% for parameter in method.parameters %}
            <tr>
                <td>{% if parameter.hint %}{{ hint_link(parameter.hint) }}{% endif %}</td>
                <td>{%- if parameter.variadic %}...{% endif %}\${{ parameter.name|raw }}</td>
                <td>{{ parameter.shortdesc|desc(class) }}</td>
            </tr>
        {% endfor %}
    </table>
{% endblock %}

{% block return %}
    <table class=\"table table-condensed\">
        <tr>
            <td>{{ hint_link(method.hint) }}</td>
            <td>{{ method.hintDesc|desc(class) }}</td>
        </tr>
    </table>
{% endblock %}

{% block exceptions %}
    <table class=\"table table-condensed\">
        {% for exception in method.exceptions %}
            <tr>
                <td>{{ class_link(exception[0]) }}</td>
                <td>{{ exception[1]|desc(class) }}</td>
            </tr>
        {% endfor %}
    </table>
{% endblock %}

{% block see %}
    <table class=\"table table-condensed\">
        {% for see in method.see %}
            <tr>
                <td>
                    {% if see[4] %}
                        <a href=\"{{see[4]}}\">{{see[4]}}</a>
                    {% elseif see[3] %}
                        {{ method_link(see[3], false, false) }}
                    {% elseif see[2] %}
                        {{ class_link(see[2]) }}
                    {% else %}
                        {{ see[0]|raw }}
                    {% endif %}
                </td>
                <td>{{ see[1]|raw }}</td>
            </tr>
        {% endfor %}
    </table>
{% endblock %}

{% block constants %}
    <table class=\"table table-condensed\">
        {% for constant in constants %}
            <tr>
                <td>{{ constant.name|raw }}</td>
                <td class=\"last\">
                    <p><em>{{ constant.shortdesc|desc(class) }}</em></p>
                    <p>{{ constant.longdesc|desc(class) }}</p>
                </td>
            </tr>
        {% endfor %}
    </table>
{% endblock %}

{% block properties %}
    <table class=\"table table-condensed\">
        {% for property in properties %}
            <tr>
                <td class=\"type\" id=\"property_{{ property.name|raw }}\">
                    {% if property.static %}static{% endif %}
                    {% if property.protected %}protected{% endif %}
                    {% if property.private %}private{% endif %}
                    {{ hint_link(property.hint) }}
                </td>
                <td>\${{ property.name|raw }}</td>
                <td class=\"last\">{{ property.shortdesc|desc(class) }}</td>
                <td>
                    {%- if property.class is not same as(class) -%}
                        <small>{{ 'from&nbsp;%s'|trans|format(property_link(property, false, true))|raw }}</small>
                    {%- endif -%}
                </td>
            </tr>
        {% endfor %}
    </table>
{% endblock %}

{% block methods %}
    <div class=\"container-fluid underlined\">
        {% for method in methods %}
            <div class=\"row\">
                <div class=\"col-md-2 type\">
                    {% if method.static %}static&nbsp;{% endif %}{{ hint_link(method.hint) }}
                </div>
                <div class=\"col-md-8 type\">
                    <a href=\"#method_{{ method.name|raw }}\">{{ method.name|raw }}</a>{{ block('method_parameters_signature') }}
                    {% if not method.shortdesc %}
                        <p class=\"no-description\">{% trans 'No description' %}</p>
                    {% else %}
                        <p>{{ method.shortdesc|desc(class) }}</p>
                    {%- endif %}
                </div>
                <div class=\"col-md-2\">
                    {%- if method.class is not same as(class) -%}
                        <small>{{ 'from&nbsp;%s'|trans|format(method_link(method, false, true))|raw }}</small>
                    {%- endif -%}
                </div>
            </div>
        {% endfor %}
    </div>
{% endblock %}

{% block methods_details %}
    <div id=\"method-details\">
        {% for method in methods %}
            <div class=\"method-item\">
                {{ block('method') }}
            </div>
        {% endfor %}
    </div>
{% endblock %}

{% block method %}
    <h3 id=\"method_{{ method.name|raw }}\">
        <div class=\"location\">{% if method.class is not same as(class) %}{{ 'in %s'|trans|format(method_link(method, false, true))|raw }} {% endif %}{{ method_source_link(method) }}</div>
        <code>{{ block('method_signature') }}</code>
    </h3>
    <div class=\"details\">
        {{ deprecations(method) }}

        {% if method.shortdesc or method.longdesc %}
            <div class=\"method-description\">
                {% if not method.shortdesc and not method.longdesc %}
                    <p class=\"no-description\">{% trans 'No description' %}</p>
                {% else %}
                    {% if method.shortdesc -%}
                    <p>{{ method.shortdesc|desc(class) }}</p>
                    {%- endif %}
                    {% if method.longdesc -%}
                    <p>{{ method.longdesc|desc(class) }}</p>
                    {%- endif %}
                {%- endif %}
                {% if project.config('insert_todos') == true %}
                    {{ todos(method) }}
                {% endif %}
            </div>
        {% endif %}
        <div class=\"tags\">
            {% if method.parameters %}
                <h4>{% trans 'Parameters' %}</h4>

                {{ block('parameters') }}
            {% endif %}

            {% if method.hintDesc or method.hint %}
                <h4>{% trans 'Return Value' %}</h4>

                {{ block('return') }}
            {% endif %}

            {% if method.exceptions %}
                <h4>{% trans 'Exceptions' %}</h4>

                {{ block('exceptions') }}
            {% endif %}

            {% if method.tags('see') %}
                <h4>{% trans 'See also' %}</h4>

                {{ block('see') }}
            {% endif %}
        </div>
    </div>
{% endblock %}
", "class.twig", "/home/runner/work/laravel-mtn-momo/laravel-mtn-momo/vendor/code-lts/doctum/src/Resources/themes/default/class.twig");
    }
}
