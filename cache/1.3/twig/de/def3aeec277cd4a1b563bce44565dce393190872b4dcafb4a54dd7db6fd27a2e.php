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

/* layout/base.twig */
class __TwigTemplate_3442ff84430da93ddda73e83c53a537362900d4aff45afaa8910ee5d6090c353 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'head' => [$this, 'block_head'],
            'html' => [$this, 'block_html'],
            'body_class' => [$this, 'block_body_class'],
            'page_id' => [$this, 'block_page_id'],
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\" />
    <meta name=\"robots\" content=\"index, follow, all\" />
    <title>";
        // line 6
        $this->displayBlock('title', $context, $blocks);
        echo "</title>

    ";
        // line 8
        $this->displayBlock('head', $context, $blocks);
        // line 22
        if (twig_get_attribute($this->env, $this->source, (isset($context["project"]) || array_key_exists("project", $context) ? $context["project"] : (function () { throw new RuntimeError('Variable "project" does not exist.', 22, $this->source); })()), "config", [0 => "favicon"], "method", false, false, false, 22)) {
            // line 23
            echo "        <link rel=\"shortcut icon\" href=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["project"]) || array_key_exists("project", $context) ? $context["project"] : (function () { throw new RuntimeError('Variable "project" does not exist.', 23, $this->source); })()), "config", [0 => "favicon"], "method", false, false, false, 23), "html", null, true);
            echo "\" />
    ";
        }
        // line 25
        echo "
    ";
        // line 26
        if (twig_get_attribute($this->env, $this->source, (isset($context["project"]) || array_key_exists("project", $context) ? $context["project"] : (function () { throw new RuntimeError('Variable "project" does not exist.', 26, $this->source); })()), "config", [0 => "base_url"], "method", false, false, false, 26)) {
            // line 27
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, (isset($context["project"]) || array_key_exists("project", $context) ? $context["project"] : (function () { throw new RuntimeError('Variable "project" does not exist.', 27, $this->source); })()), "versions", [], "any", false, false, false, 27));
            foreach ($context['_seq'] as $context["_key"] => $context["version"]) {
                // line 28
                echo "<link rel=\"search\"
                  type=\"application/opensearchdescription+xml\"
                  href=\"";
                // line 30
                echo twig_escape_filter($this->env, twig_replace_filter(twig_get_attribute($this->env, $this->source, (isset($context["project"]) || array_key_exists("project", $context) ? $context["project"] : (function () { throw new RuntimeError('Variable "project" does not exist.', 30, $this->source); })()), "config", [0 => "base_url"], "method", false, false, false, 30), ["%version%" => $context["version"]]), "html", null, true);
                echo "/opensearch.xml\"
                  title=\"";
                // line 31
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["project"]) || array_key_exists("project", $context) ? $context["project"] : (function () { throw new RuntimeError('Variable "project" does not exist.', 31, $this->source); })()), "config", [0 => "title"], "method", false, false, false, 31), "html", null, true);
                echo " (";
                echo twig_escape_filter($this->env, $context["version"], "html", null, true);
                echo ")\" />
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['version'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
        // line 34
        echo "</head>

";
        // line 36
        $this->displayBlock('html', $context, $blocks);
        // line 41
        echo "
</html>
";
    }

    // line 6
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["project"]) || array_key_exists("project", $context) ? $context["project"] : (function () { throw new RuntimeError('Variable "project" does not exist.', 6, $this->source); })()), "config", [0 => "title"], "method", false, false, false, 6), "html", null, true);
    }

    // line 8
    public function block_head($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 9
        echo "        <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        echo twig_escape_filter($this->env, $this->extensions['Doctum\Renderer\TwigExtension']->pathForStaticFile($context, "css/bootstrap.min.css"), "html", null, true);
        echo "\">
        <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->extensions['Doctum\Renderer\TwigExtension']->pathForStaticFile($context, "css/bootstrap-theme.min.css"), "html", null, true);
        echo "\">
        <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->extensions['Doctum\Renderer\TwigExtension']->pathForStaticFile($context, "css/doctum.css"), "html", null, true);
        echo "\">
        <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->extensions['Doctum\Renderer\TwigExtension']->pathForStaticFile($context, "fonts/doctum-font.css"), "html", null, true);
        echo "\">
        <script src=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->extensions['Doctum\Renderer\TwigExtension']->pathForStaticFile($context, "js/jquery-3.5.1.slim.min.js"), "html", null, true);
        echo "\"></script>
        <script async defer src=\"";
        // line 14
        echo twig_escape_filter($this->env, $this->extensions['Doctum\Renderer\TwigExtension']->pathForStaticFile($context, "js/bootstrap.min.js"), "html", null, true);
        echo "\"></script>
        <script src=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->extensions['Doctum\Renderer\TwigExtension']->pathForStaticFile($context, "js/typeahead.min.js"), "html", null, true);
        echo "\"></script>
        <script src=\"";
        // line 16
        echo twig_escape_filter($this->env, $this->extensions['Doctum\Renderer\TwigExtension']->pathForStaticFile($context, "doctum.js"), "html", null, true);
        echo "\"></script>
        <meta name=\"MobileOptimized\" content=\"width\">
        <meta name=\"HandheldFriendly\" content=\"true\">
        <meta name=\"viewport\" content=\"width=device-width,initial-scale=1,maximum-scale=1\">";
    }

    // line 36
    public function block_html($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 37
        echo "    <body id=\"";
        $this->displayBlock('body_class', $context, $blocks);
        echo "\" data-name=\"";
        $this->displayBlock('page_id', $context, $blocks);
        echo "\" data-root-path=\"";
        echo twig_escape_filter($this->env, (isset($context["root_path"]) || array_key_exists("root_path", $context) ? $context["root_path"] : (function () { throw new RuntimeError('Variable "root_path" does not exist.', 37, $this->source); })()), "html", null, true);
        echo "\">
        ";
        // line 38
        $this->displayBlock('content', $context, $blocks);
        // line 39
        echo "    </body>
";
    }

    // line 37
    public function block_body_class($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "";
    }

    public function block_page_id($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "";
    }

    // line 38
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "";
    }

    public function getTemplateName()
    {
        return "layout/base.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  186 => 38,  173 => 37,  168 => 39,  166 => 38,  157 => 37,  153 => 36,  145 => 16,  141 => 15,  137 => 14,  133 => 13,  129 => 12,  125 => 11,  121 => 10,  116 => 9,  112 => 8,  105 => 6,  99 => 41,  97 => 36,  93 => 34,  82 => 31,  78 => 30,  74 => 28,  70 => 27,  68 => 26,  65 => 25,  59 => 23,  57 => 22,  55 => 8,  50 => 6,  43 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\" />
    <meta name=\"robots\" content=\"index, follow, all\" />
    <title>{% block title project.config('title') %}</title>

    {% block head %}
        <link rel=\"stylesheet\" type=\"text/css\" href=\"{{ path('css/bootstrap.min.css') }}\">
        <link rel=\"stylesheet\" type=\"text/css\" href=\"{{ path('css/bootstrap-theme.min.css') }}\">
        <link rel=\"stylesheet\" type=\"text/css\" href=\"{{ path('css/doctum.css') }}\">
        <link rel=\"stylesheet\" type=\"text/css\" href=\"{{ path('fonts/doctum-font.css') }}\">
        <script src=\"{{ path('js/jquery-3.5.1.slim.min.js') }}\"></script>
        <script async defer src=\"{{ path('js/bootstrap.min.js') }}\"></script>
        <script src=\"{{ path('js/typeahead.min.js') }}\"></script>
        <script src=\"{{ path('doctum.js') }}\"></script>
        <meta name=\"MobileOptimized\" content=\"width\">
        <meta name=\"HandheldFriendly\" content=\"true\">
        <meta name=\"viewport\" content=\"width=device-width,initial-scale=1,maximum-scale=1\">
    {%- endblock -%}

    {% if project.config('favicon') %}
        <link rel=\"shortcut icon\" href=\"{{ project.config('favicon') }}\" />
    {% endif %}

    {% if project.config('base_url') %}
        {%- for version in project.versions -%}
            <link rel=\"search\"
                  type=\"application/opensearchdescription+xml\"
                  href=\"{{ project.config('base_url')|replace({'%version%': version}) }}/opensearch.xml\"
                  title=\"{{ project.config('title') }} ({{ version }})\" />
        {% endfor -%}
    {% endif %}
</head>

{% block html %}
    <body id=\"{% block body_class '' %}\" data-name=\"{% block page_id '' %}\" data-root-path=\"{{ root_path }}\">
        {% block content '' %}
    </body>
{% endblock %}

</html>
", "layout/base.twig", "/home/runner/work/laravel-mtn-momo/laravel-mtn-momo/vendor/code-lts/doctum/src/Resources/themes/default/layout/base.twig");
    }
}
