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

/* macros.twig */
class __TwigTemplate_1d4718250b7042b370c43d60f08a6ca63c8ae6f698efc43225af7856a93cab43 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "
";
        // line 7
        echo "
";
        // line 11
        echo "
";
        // line 21
        echo "
";
        // line 27
        echo "
";
        // line 33
        echo "
";
        // line 49
        echo "
";
        // line 55
        echo "
";
        // line 69
        echo "
";
        // line 81
        echo "
";
        // line 93
        echo "
";
        // line 115
        echo "
";
        // line 127
        echo "
";
        // line 131
        echo "
";
        // line 147
        echo "
";
        // line 151
        echo "
";
    }

    // line 2
    public function macro_class_category_name($__categoryId__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "categoryId" => $__categoryId__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start();
        try {
            // line 3
            if (((isset($context["categoryId"]) || array_key_exists("categoryId", $context) ? $context["categoryId"] : (function () { throw new RuntimeError('Variable "categoryId" does not exist.', 3, $this->source); })()) == 1)) {
                echo \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("class");
            }
            // line 4
            if (((isset($context["categoryId"]) || array_key_exists("categoryId", $context) ? $context["categoryId"] : (function () { throw new RuntimeError('Variable "categoryId" does not exist.', 4, $this->source); })()) == 2)) {
                echo \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("interface");
            }
            // line 5
            if (((isset($context["categoryId"]) || array_key_exists("categoryId", $context) ? $context["categoryId"] : (function () { throw new RuntimeError('Variable "categoryId" does not exist.', 5, $this->source); })()) == 3)) {
                echo \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("trait");
            }

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 8
    public function macro_namespace_link($__namespace__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "namespace" => $__namespace__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start();
        try {
            // line 9
            echo "<a href=\"";
            echo $this->extensions['Doctum\Renderer\TwigExtension']->pathForNamespace($context, (isset($context["namespace"]) || array_key_exists("namespace", $context) ? $context["namespace"] : (function () { throw new RuntimeError('Variable "namespace" does not exist.', 9, $this->source); })()));
            echo "\">";
            echo (isset($context["namespace"]) || array_key_exists("namespace", $context) ? $context["namespace"] : (function () { throw new RuntimeError('Variable "namespace" does not exist.', 9, $this->source); })());
            echo "</a>";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 12
    public function macro_class_link($__class__ = null, $__absolute__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "class" => $__class__,
            "absolute" => $__absolute__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start();
        try {
            // line 13
            if (twig_get_attribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 13, $this->source); })()), "isProjectClass", [], "method", false, false, false, 13)) {
                // line 14
                echo "<a href=\"";
                echo $this->extensions['Doctum\Renderer\TwigExtension']->pathForClass($context, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 14, $this->source); })()));
                echo "\">";
            } elseif (twig_get_attribute($this->env, $this->source,             // line 15
(isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 15, $this->source); })()), "isPhpClass", [], "method", false, false, false, 15)) {
                // line 16
                echo "<a target=\"_blank\" rel=\"noopener\" href=\"https://www.php.net/";
                echo (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 16, $this->source); })());
                echo "\">";
            }
            // line 18
            echo call_user_func_array($this->env->getFunction('abbr_class')->getCallable(), [(isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 18, $this->source); })()), ((array_key_exists("absolute", $context)) ? (_twig_default_filter((isset($context["absolute"]) || array_key_exists("absolute", $context) ? $context["absolute"] : (function () { throw new RuntimeError('Variable "absolute" does not exist.', 18, $this->source); })()), false)) : (false))]);
            // line 19
            if ((twig_get_attribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 19, $this->source); })()), "isProjectClass", [], "method", false, false, false, 19) || twig_get_attribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 19, $this->source); })()), "isPhpClass", [], "method", false, false, false, 19))) {
                echo "</a>";
            }

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 22
    public function macro_method_link($__method__ = null, $__absolute__ = null, $__classonly__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "method" => $__method__,
            "absolute" => $__absolute__,
            "classonly" => $__classonly__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start();
        try {
            // line 23
            echo "<a href=\"";
            echo $this->extensions['Doctum\Renderer\TwigExtension']->pathForMethod($context, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 23, $this->source); })()));
            echo "\">
";
            // line 24
            echo call_user_func_array($this->env->getFunction('abbr_class')->getCallable(), [twig_get_attribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 24, $this->source); })()), "class", [], "any", false, false, false, 24)]);
            if ( !((array_key_exists("classonly", $context)) ? (_twig_default_filter((isset($context["classonly"]) || array_key_exists("classonly", $context) ? $context["classonly"] : (function () { throw new RuntimeError('Variable "classonly" does not exist.', 24, $this->source); })()), false)) : (false))) {
                echo "::";
                echo twig_get_attribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 24, $this->source); })()), "name", [], "any", false, false, false, 24);
            }
            // line 25
            echo "</a>";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 28
    public function macro_property_link($__property__ = null, $__absolute__ = null, $__classonly__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "property" => $__property__,
            "absolute" => $__absolute__,
            "classonly" => $__classonly__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start();
        try {
            // line 29
            echo "<a href=\"";
            echo $this->extensions['Doctum\Renderer\TwigExtension']->pathForProperty($context, (isset($context["property"]) || array_key_exists("property", $context) ? $context["property"] : (function () { throw new RuntimeError('Variable "property" does not exist.', 29, $this->source); })()));
            echo "\">
";
            // line 30
            echo call_user_func_array($this->env->getFunction('abbr_class')->getCallable(), [twig_get_attribute($this->env, $this->source, (isset($context["property"]) || array_key_exists("property", $context) ? $context["property"] : (function () { throw new RuntimeError('Variable "property" does not exist.', 30, $this->source); })()), "class", [], "any", false, false, false, 30)]);
            if ( !((array_key_exists("classonly", $context)) ? (_twig_default_filter((isset($context["classonly"]) || array_key_exists("classonly", $context) ? $context["classonly"] : (function () { throw new RuntimeError('Variable "classonly" does not exist.', 30, $this->source); })()), false)) : (false))) {
                echo "#";
                echo twig_get_attribute($this->env, $this->source, (isset($context["property"]) || array_key_exists("property", $context) ? $context["property"] : (function () { throw new RuntimeError('Variable "property" does not exist.', 30, $this->source); })()), "name", [], "any", false, false, false, 30);
            }
            // line 31
            echo "</a>";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 34
    public function macro_hint_link($__hints__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "hints" => $__hints__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start();
        try {
            // line 35
            $macros["__internal_4ea54eb56cb9eff9eb5ce36fd8234784b2f7918476d7f828722542c4ce234e79"] = $this;
            // line 37
            if ((isset($context["hints"]) || array_key_exists("hints", $context) ? $context["hints"] : (function () { throw new RuntimeError('Variable "hints" does not exist.', 37, $this->source); })())) {
                // line 38
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["hints"]) || array_key_exists("hints", $context) ? $context["hints"] : (function () { throw new RuntimeError('Variable "hints" does not exist.', 38, $this->source); })()));
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
                foreach ($context['_seq'] as $context["_key"] => $context["hint"]) {
                    // line 39
                    if (twig_get_attribute($this->env, $this->source, $context["hint"], "class", [], "any", false, false, false, 39)) {
                        // line 40
                        echo twig_call_macro($macros["__internal_4ea54eb56cb9eff9eb5ce36fd8234784b2f7918476d7f828722542c4ce234e79"], "macro_class_link", [twig_get_attribute($this->env, $this->source, $context["hint"], "name", [], "any", false, false, false, 40)], 40, $context, $this->getSourceContext());
                    } elseif (twig_get_attribute($this->env, $this->source,                     // line 41
$context["hint"], "name", [], "any", false, false, false, 41)) {
                        // line 42
                        echo call_user_func_array($this->env->getFunction('abbr_class')->getCallable(), [twig_get_attribute($this->env, $this->source, $context["hint"], "name", [], "any", false, false, false, 42)]);
                    }
                    // line 44
                    if (twig_get_attribute($this->env, $this->source, $context["hint"], "array", [], "any", false, false, false, 44)) {
                        echo "[]";
                    }
                    // line 45
                    if ( !twig_get_attribute($this->env, $this->source, $context["loop"], "last", [], "any", false, false, false, 45)) {
                        echo "|";
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
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['hint'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
            }

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 50
    public function macro_source_link($__project__ = null, $__class__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "project" => $__project__,
            "class" => $__class__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start();
        try {
            // line 51
            if (twig_get_attribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 51, $this->source); })()), "sourcepath", [], "any", false, false, false, 51)) {
                // line 52
                echo "        (<a href=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 52, $this->source); })()), "sourcepath", [], "any", false, false, false, 52), "html", null, true);
                echo "\">";
                echo \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("View source");
                echo "</a>)";
            }

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 56
    public function macro_method_source_link($__method__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "method" => $__method__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start();
        try {
            // line 57
            if (twig_get_attribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 57, $this->source); })()), "sourcepath", [], "any", false, false, false, 57)) {
                // line 59
                echo "<a href=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 59, $this->source); })()), "sourcepath", [], "any", false, false, false, 59), "html", null, true);
                echo "\">";
                echo sprintf(\Wdes\phpI18nL10n\Launcher::gettext("at line %s"), twig_get_attribute($this->env, $this->source,                 // line 60
(isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 60, $this->source); })()), "line", [], "any", false, false, false, 60));
                // line 61
                echo "</a>";
            } else {
                // line 64
                echo sprintf(\Wdes\phpI18nL10n\Launcher::gettext("at line %s"), twig_get_attribute($this->env, $this->source,                 // line 65
(isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 65, $this->source); })()), "line", [], "any", false, false, false, 65));
            }

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 70
    public function macro_method_parameters_signature($__method__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "method" => $__method__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start();
        try {
            // line 71
            $macros["__internal_5e95a2993cdcd16be53549f961d53b56de475984946cb04ba5d54a9d28e1b01d"] = $this->loadTemplate("macros.twig", "macros.twig", 71)->unwrap();
            // line 72
            echo "(";
            // line 73
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 73, $this->source); })()), "parameters", [], "any", false, false, false, 73));
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
            foreach ($context['_seq'] as $context["_key"] => $context["parameter"]) {
                // line 74
                if (twig_get_attribute($this->env, $this->source, $context["parameter"], "hashint", [], "any", false, false, false, 74)) {
                    echo twig_call_macro($macros["__internal_5e95a2993cdcd16be53549f961d53b56de475984946cb04ba5d54a9d28e1b01d"], "macro_hint_link", [twig_get_attribute($this->env, $this->source, $context["parameter"], "hint", [], "any", false, false, false, 74)], 74, $context, $this->getSourceContext());
                    echo " ";
                }
                // line 75
                if (twig_get_attribute($this->env, $this->source, $context["parameter"], "variadic", [], "any", false, false, false, 75)) {
                    echo "...";
                }
                echo "\$";
                echo twig_get_attribute($this->env, $this->source, $context["parameter"], "name", [], "any", false, false, false, 75);
                // line 76
                if ( !(null === twig_get_attribute($this->env, $this->source, $context["parameter"], "default", [], "any", false, false, false, 76))) {
                    echo " = ";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["parameter"], "default", [], "any", false, false, false, 76), "html", null, true);
                }
                // line 77
                if ( !twig_get_attribute($this->env, $this->source, $context["loop"], "last", [], "any", false, false, false, 77)) {
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['parameter'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 79
            echo ")";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 82
    public function macro_function_parameters_signature($__method__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "method" => $__method__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start();
        try {
            // line 83
            $macros["__internal_94cd96d52b48bea40272b9e2262323c567bd8dec08e76b9494bc8c6362aca2e6"] = $this->loadTemplate("macros.twig", "macros.twig", 83)->unwrap();
            // line 84
            echo "(";
            // line 85
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, (isset($context["method"]) || array_key_exists("method", $context) ? $context["method"] : (function () { throw new RuntimeError('Variable "method" does not exist.', 85, $this->source); })()), "parameters", [], "any", false, false, false, 85));
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
            foreach ($context['_seq'] as $context["_key"] => $context["parameter"]) {
                // line 86
                if (twig_get_attribute($this->env, $this->source, $context["parameter"], "hashint", [], "any", false, false, false, 86)) {
                    echo twig_call_macro($macros["__internal_94cd96d52b48bea40272b9e2262323c567bd8dec08e76b9494bc8c6362aca2e6"], "macro_hint_link", [twig_get_attribute($this->env, $this->source, $context["parameter"], "hint", [], "any", false, false, false, 86)], 86, $context, $this->getSourceContext());
                    echo " ";
                }
                // line 87
                if (twig_get_attribute($this->env, $this->source, $context["parameter"], "variadic", [], "any", false, false, false, 87)) {
                    echo "...";
                }
                echo "\$";
                echo twig_get_attribute($this->env, $this->source, $context["parameter"], "name", [], "any", false, false, false, 87);
                // line 88
                if ( !(null === twig_get_attribute($this->env, $this->source, $context["parameter"], "default", [], "any", false, false, false, 88))) {
                    echo " = ";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["parameter"], "default", [], "any", false, false, false, 88), "html", null, true);
                }
                // line 89
                if ( !twig_get_attribute($this->env, $this->source, $context["loop"], "last", [], "any", false, false, false, 89)) {
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['parameter'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 91
            echo ")";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 94
    public function macro_render_classes($__classes__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "classes" => $__classes__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start();
        try {
            // line 95
            $macros["__internal_cdeefc5443cbf424379f79e55ea0176a26ea724dd8338770bf3df7c63532107e"] = $this;
            // line 96
            echo "
    <div class=\"container-fluid underlined\">
        ";
            // line 98
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["classes"]) || array_key_exists("classes", $context) ? $context["classes"] : (function () { throw new RuntimeError('Variable "classes" does not exist.', 98, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["class"]) {
                // line 99
                echo "            <div class=\"row\">
                <div class=\"col-md-6\">
                    ";
                // line 101
                if (twig_get_attribute($this->env, $this->source, $context["class"], "isInterface", [], "any", false, false, false, 101)) {
                    // line 102
                    echo "                        <em>";
                    echo twig_call_macro($macros["__internal_cdeefc5443cbf424379f79e55ea0176a26ea724dd8338770bf3df7c63532107e"], "macro_class_link", [$context["class"], true], 102, $context, $this->getSourceContext());
                    echo "</em>
                    ";
                } else {
                    // line 104
                    echo twig_call_macro($macros["__internal_cdeefc5443cbf424379f79e55ea0176a26ea724dd8338770bf3df7c63532107e"], "macro_class_link", [$context["class"], true], 104, $context, $this->getSourceContext());
                }
                // line 106
                echo twig_call_macro($macros["__internal_cdeefc5443cbf424379f79e55ea0176a26ea724dd8338770bf3df7c63532107e"], "macro_deprecated", [$context["class"]], 106, $context, $this->getSourceContext());
                // line 107
                echo "</div>
                <div class=\"col-md-6\">";
                // line 109
                echo $this->extensions['Doctum\Renderer\TwigExtension']->parseDesc($context, twig_get_attribute($this->env, $this->source, $context["class"], "shortdesc", [], "any", false, false, false, 109), $context["class"]);
                // line 110
                echo "</div>
            </div>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['class'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 113
            echo "    </div>";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 116
    public function macro_breadcrumbs($__namespace__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "namespace" => $__namespace__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start();
        try {
            // line 117
            echo "    ";
            $context["current_ns"] = "";
            // line 118
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_split_filter($this->env, (isset($context["namespace"]) || array_key_exists("namespace", $context) ? $context["namespace"] : (function () { throw new RuntimeError('Variable "namespace" does not exist.', 118, $this->source); })()), "\\"));
            foreach ($context['_seq'] as $context["_key"] => $context["ns"]) {
                // line 119
                if ((isset($context["current_ns"]) || array_key_exists("current_ns", $context) ? $context["current_ns"] : (function () { throw new RuntimeError('Variable "current_ns" does not exist.', 119, $this->source); })())) {
                    // line 120
                    $context["current_ns"] = (((isset($context["current_ns"]) || array_key_exists("current_ns", $context) ? $context["current_ns"] : (function () { throw new RuntimeError('Variable "current_ns" does not exist.', 120, $this->source); })()) . "\\") . $context["ns"]);
                } else {
                    // line 122
                    $context["current_ns"] = $context["ns"];
                }
                // line 124
                echo "<li><a href=\"";
                echo $this->extensions['Doctum\Renderer\TwigExtension']->pathForNamespace($context, (isset($context["current_ns"]) || array_key_exists("current_ns", $context) ? $context["current_ns"] : (function () { throw new RuntimeError('Variable "current_ns" does not exist.', 124, $this->source); })()));
                echo "\">";
                echo $context["ns"];
                echo "</a></li><li class=\"backslash\">\\</li>";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ns'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 128
    public function macro_deprecated($__reflection__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "reflection" => $__reflection__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start();
        try {
            // line 129
            echo "    ";
            if (twig_get_attribute($this->env, $this->source, (isset($context["reflection"]) || array_key_exists("reflection", $context) ? $context["reflection"] : (function () { throw new RuntimeError('Variable "reflection" does not exist.', 129, $this->source); })()), "deprecated", [], "any", false, false, false, 129)) {
                echo "<small><sup><span class=\"label label-danger\">";
                echo \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("deprecated");
                echo "</span></sup></small>";
            }

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 132
    public function macro_deprecations($__reflection__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "reflection" => $__reflection__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start();
        try {
            // line 133
            echo "    ";
            $macros["__internal_f20f9ae69f8963e5bccdad44586312b4c6e76fec5dc484abc3c461ba94347a4d"] = $this;
            // line 134
            echo "
    ";
            // line 135
            if (twig_get_attribute($this->env, $this->source, (isset($context["reflection"]) || array_key_exists("reflection", $context) ? $context["reflection"] : (function () { throw new RuntimeError('Variable "reflection" does not exist.', 135, $this->source); })()), "deprecated", [], "any", false, false, false, 135)) {
                // line 136
                echo "        <p>
            ";
                // line 137
                echo twig_call_macro($macros["__internal_f20f9ae69f8963e5bccdad44586312b4c6e76fec5dc484abc3c461ba94347a4d"], "macro_deprecated", [(isset($context["reflection"]) || array_key_exists("reflection", $context) ? $context["reflection"] : (function () { throw new RuntimeError('Variable "reflection" does not exist.', 137, $this->source); })())], 137, $context, $this->getSourceContext());
                echo "
            ";
                // line 138
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, (isset($context["reflection"]) || array_key_exists("reflection", $context) ? $context["reflection"] : (function () { throw new RuntimeError('Variable "reflection" does not exist.', 138, $this->source); })()), "deprecated", [], "any", false, false, false, 138));
                foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                    // line 139
                    echo "                <tr>
                    <td>";
                    // line 140
                    echo twig_get_attribute($this->env, $this->source, $context["tag"], 0, [], "array", false, false, false, 140);
                    echo "</td>
                    <td>";
                    // line 141
                    echo twig_join_filter(twig_slice($this->env, $context["tag"], 1, null), " ");
                    echo "</td>
                </tr>
            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 144
                echo "        </p>
    ";
            }

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 148
    public function macro_todo($__reflection__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "reflection" => $__reflection__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start();
        try {
            // line 149
            echo "        ";
            if (twig_get_attribute($this->env, $this->source, (isset($context["reflection"]) || array_key_exists("reflection", $context) ? $context["reflection"] : (function () { throw new RuntimeError('Variable "reflection" does not exist.', 149, $this->source); })()), "todo", [], "any", false, false, false, 149)) {
                echo "<small><sup><span class=\"label label-info\">";
                echo \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("todo");
                echo "</span></sup></small>";
            }

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 152
    public function macro_todos($__reflection__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "reflection" => $__reflection__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start();
        try {
            // line 153
            echo "        ";
            $macros["__internal_6f6e6a088843cd57c5641e88bba1c1ef6328977d4025cfd855e95a746246a0ab"] = $this;
            // line 154
            echo "
        ";
            // line 155
            if (twig_get_attribute($this->env, $this->source, (isset($context["reflection"]) || array_key_exists("reflection", $context) ? $context["reflection"] : (function () { throw new RuntimeError('Variable "reflection" does not exist.', 155, $this->source); })()), "todo", [], "any", false, false, false, 155)) {
                // line 156
                echo "            <p>
                ";
                // line 157
                echo twig_call_macro($macros["__internal_6f6e6a088843cd57c5641e88bba1c1ef6328977d4025cfd855e95a746246a0ab"], "macro_todo", [(isset($context["reflection"]) || array_key_exists("reflection", $context) ? $context["reflection"] : (function () { throw new RuntimeError('Variable "reflection" does not exist.', 157, $this->source); })())], 157, $context, $this->getSourceContext());
                echo "
                ";
                // line 158
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, (isset($context["reflection"]) || array_key_exists("reflection", $context) ? $context["reflection"] : (function () { throw new RuntimeError('Variable "reflection" does not exist.', 158, $this->source); })()), "todo", [], "any", false, false, false, 158));
                foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                    // line 159
                    echo "                    <tr>
                        <td>";
                    // line 160
                    echo twig_get_attribute($this->env, $this->source, $context["tag"], 0, [], "array", false, false, false, 160);
                    echo "</td>
                        <td>";
                    // line 161
                    echo twig_join_filter(twig_slice($this->env, $context["tag"], 1, null), " ");
                    echo "</td>
                        </tr>
                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 164
                echo "            </p>
        ";
            }

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    public function getTemplateName()
    {
        return "macros.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  810 => 164,  801 => 161,  797 => 160,  794 => 159,  790 => 158,  786 => 157,  783 => 156,  781 => 155,  778 => 154,  775 => 153,  762 => 152,  748 => 149,  735 => 148,  724 => 144,  715 => 141,  711 => 140,  708 => 139,  704 => 138,  700 => 137,  697 => 136,  695 => 135,  692 => 134,  689 => 133,  676 => 132,  662 => 129,  649 => 128,  632 => 124,  629 => 122,  626 => 120,  624 => 119,  619 => 118,  616 => 117,  603 => 116,  594 => 113,  586 => 110,  584 => 109,  581 => 107,  579 => 106,  576 => 104,  570 => 102,  568 => 101,  564 => 99,  560 => 98,  556 => 96,  554 => 95,  541 => 94,  532 => 91,  516 => 89,  511 => 88,  505 => 87,  500 => 86,  483 => 85,  481 => 84,  479 => 83,  466 => 82,  457 => 79,  441 => 77,  436 => 76,  430 => 75,  425 => 74,  408 => 73,  406 => 72,  404 => 71,  391 => 70,  381 => 65,  380 => 64,  377 => 61,  375 => 60,  371 => 59,  369 => 57,  356 => 56,  342 => 52,  340 => 51,  326 => 50,  302 => 45,  298 => 44,  295 => 42,  293 => 41,  291 => 40,  289 => 39,  272 => 38,  270 => 37,  268 => 35,  255 => 34,  246 => 31,  240 => 30,  235 => 29,  220 => 28,  211 => 25,  205 => 24,  200 => 23,  185 => 22,  174 => 19,  172 => 18,  167 => 16,  165 => 15,  161 => 14,  159 => 13,  145 => 12,  132 => 9,  119 => 8,  108 => 5,  104 => 4,  100 => 3,  87 => 2,  82 => 151,  79 => 147,  76 => 131,  73 => 127,  70 => 115,  67 => 93,  64 => 81,  61 => 69,  58 => 55,  55 => 49,  52 => 33,  49 => 27,  46 => 21,  43 => 11,  40 => 7,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("
{% macro class_category_name(categoryId) -%}
{% if categoryId == 1 %}{% trans 'class' %}{% endif %}
{% if categoryId == 2 %}{% trans 'interface' %}{% endif %}
{% if categoryId == 3 %}{% trans 'trait' %}{% endif %}
{%- endmacro %}

{% macro namespace_link(namespace) -%}
    <a href=\"{{ namespace_path(namespace) }}\">{{ namespace|raw }}</a>
{%- endmacro %}

{% macro class_link(class, absolute) -%}
    {%- if class.isProjectClass() -%}
        <a href=\"{{ class_path(class) }}\">
    {%- elseif class.isPhpClass() -%}
        <a target=\"_blank\" rel=\"noopener\" href=\"https://www.php.net/{{ class|raw }}\">
    {%- endif %}
    {{- abbr_class(class, absolute|default(false)) }}
    {%- if class.isProjectClass() or class.isPhpClass() %}</a>{% endif %}
{%- endmacro %}

{% macro method_link(method, absolute, classonly) -%}
{#  #}<a href=\"{{ method_path(method) }}\">
{#    #}{{- abbr_class(method.class) }}{% if not classonly|default(false) %}::{{ method.name|raw }}{% endif -%}
{#  #}</a>
{%- endmacro %}

{% macro property_link(property, absolute, classonly) -%}
{#  #}<a href=\"{{ property_path(property) }}\">
{#    #}{{- abbr_class(property.class) }}{% if not classonly|default(false) %}#{{ property.name|raw }}{% endif -%}
{#  #}</a>
{%- endmacro %}

{% macro hint_link(hints) -%}
    {%- from _self import class_link %}

    {%- if hints %}
        {%- for hint in hints %}
            {%- if hint.class %}
                {{- class_link(hint.name) }}
            {%- elseif hint.name %}
                {{- abbr_class(hint.name) }}
            {%- endif %}
            {%- if hint.array %}[]{% endif %}
            {%- if not loop.last %}|{% endif %}
        {%- endfor %}
    {%- endif %}
{%- endmacro %}

{% macro source_link(project, class) -%}
    {% if class.sourcepath %}
        (<a href=\"{{ class.sourcepath }}\">{% trans 'View source'%}</a>)
    {%- endif %}
{%- endmacro %}

{% macro method_source_link(method) -%}
    {% if method.sourcepath %}
        {#- l10n: Method at line %s -#}
        <a href=\"{{ method.sourcepath }}\">{{'at line %s'|trans|format(
            method.line
        )|raw }}</a>
    {%- else %}
        {#- l10n: Method at line %s -#}
        {{- 'at line %s'|trans|format(
            method.line
        )|raw -}}
    {%- endif %}
{%- endmacro %}

{% macro method_parameters_signature(method) -%}
    {%- from \"macros.twig\" import hint_link -%}
    (
        {%- for parameter in method.parameters %}
            {%- if parameter.hashint %}{{ hint_link(parameter.hint) }} {% endif -%}
            {%- if parameter.variadic %}...{% endif %}\${{ parameter.name|raw }}
            {%- if parameter.default is not null %} = {{ parameter.default }}{% endif %}
            {%- if not loop.last %}, {% endif %}
        {%- endfor -%}
    )
{%- endmacro %}

{% macro function_parameters_signature(method) -%}
    {%- from \"macros.twig\" import hint_link -%}
    (
        {%- for parameter in method.parameters %}
            {%- if parameter.hashint %}{{ hint_link(parameter.hint) }} {% endif -%}
            {%- if parameter.variadic %}...{% endif %}\${{ parameter.name|raw }}
            {%- if parameter.default is not null %} = {{ parameter.default }}{% endif %}
            {%- if not loop.last %}, {% endif %}
        {%- endfor -%}
    )
{%- endmacro %}

{% macro render_classes(classes) -%}
    {% from _self import class_link, deprecated %}

    <div class=\"container-fluid underlined\">
        {% for class in classes %}
            <div class=\"row\">
                <div class=\"col-md-6\">
                    {% if class.isInterface %}
                        <em>{{- class_link(class, true) -}}</em>
                    {% else %}
                        {{- class_link(class, true) -}}
                    {% endif %}
                    {{- deprecated(class) -}}
                </div>
                <div class=\"col-md-6\">
                    {{- class.shortdesc|desc(class) -}}
                </div>
            </div>
        {% endfor %}
    </div>
{%- endmacro %}

{% macro breadcrumbs(namespace) %}
    {% set current_ns = '' %}
    {% for ns in namespace|split('\\\\') %}
        {%- if current_ns -%}
            {% set current_ns = current_ns ~ '\\\\' ~ ns %}
        {%- else -%}
            {% set current_ns = ns %}
        {%- endif -%}
        <li><a href=\"{{ namespace_path(current_ns) }}\">{{ ns|raw }}</a></li><li class=\"backslash\">\\</li>
    {%- endfor %}
{% endmacro %}

{% macro deprecated(reflection) %}
    {% if reflection.deprecated %}<small><sup><span class=\"label label-danger\">{% trans 'deprecated' %}</span></sup></small>{% endif %}
{% endmacro %}

{% macro deprecations(reflection) %}
    {% from _self import deprecated %}

    {% if reflection.deprecated %}
        <p>
            {{ deprecated(reflection )}}
            {% for tag in reflection.deprecated %}
                <tr>
                    <td>{{ tag[0]|raw }}</td>
                    <td>{{ tag[1:]|join(' ')|raw }}</td>
                </tr>
            {% endfor %}
        </p>
    {% endif %}
{% endmacro %}

{% macro todo(reflection) %}
        {% if reflection.todo %}<small><sup><span class=\"label label-info\">{% trans 'todo' %}</span></sup></small>{% endif %}
{% endmacro %}

{% macro todos(reflection) %}
        {% from _self import todo %}

        {% if reflection.todo %}
            <p>
                {{ todo(reflection )}}
                {% for tag in reflection.todo %}
                    <tr>
                        <td>{{ tag[0]|raw }}</td>
                        <td>{{ tag[1:]|join(' ')|raw }}</td>
                        </tr>
                {% endfor %}
            </p>
        {% endif %}
{% endmacro %}
", "macros.twig", "/home/runner/work/laravel-mtn-momo/laravel-mtn-momo/vendor/code-lts/doctum/src/Resources/themes/default/macros.twig");
    }
}
