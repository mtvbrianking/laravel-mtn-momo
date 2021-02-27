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

/* search.twig */
class __TwigTemplate_dd9dd07b9873fb0dbaeb41a31d6fa51a8f0b148043ad29fc570c54e32a63d384 extends \Twig\Template
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
            'page_content' => [$this, 'block_page_content'],
            'js_search' => [$this, 'block_js_search'],
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
        $macros["__internal_7b81377c5db4d1563b9001344f3fc8b529ed16361d564f9f0f6f9a76336e852e"] = $this->macros["__internal_7b81377c5db4d1563b9001344f3fc8b529ed16361d564f9f0f6f9a76336e852e"] = $this->loadTemplate("macros.twig", "search.twig", 2)->unwrap();
        // line 1
        $this->parent = $this->loadTemplate("layout/layout.twig", "search.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Search");
        echo " | ";
        $this->displayParentBlock("title", $context, $blocks);
    }

    // line 4
    public function block_body_class($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "search-page";
    }

    // line 6
    public function block_page_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 7
        echo "
    <div class=\"page-header\">
        <h1>";
        // line 9
        echo \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Search");
        echo "</h1>
    </div>

    <p>";
        // line 12
        echo \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("This page allows you to search through the API documentation for
    specific terms. Enter your search words into the box below and click
    \"submit\". The search will be performed on namespaces, classes, interfaces,
    traits, functions, and methods.");
        // line 15
        echo "</p>

    <form class=\"form-inline\" role=\"form\" action=\"";
        // line 17
        echo twig_escape_filter($this->env, $this->extensions['Doctum\Renderer\TwigExtension']->pathForStaticFile($context, "search.html"), "html", null, true);
        echo "\">
        <div class=\"form-group\">
            <label class=\"sr-only\" for=\"search\">";
        // line 19
        echo \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Search");
        echo "</label>
            <input type=\"search\" class=\"form-control\" name=\"search\" id=\"search\" placeholder=\"";
        // line 20
        echo \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Search");
        echo "\">
        </div>
        <button type=\"submit\" class=\"btn btn-default\">";
        // line 22
        echo \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("submit");
        echo "</button>
    </form>

    <h2>";
        // line 25
        echo \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Search Results");
        echo "</h2>

    <div class=\"container-fluid\">
        <ul class=\"search-results\"></ul>
    </div>

    ";
        // line 31
        $this->displayBlock("js_search", $context, $blocks);
        echo "

";
    }

    // line 35
    public function block_js_search($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 36
        echo "    <script type=\"text/javascript\">

        (function() {
            var term = Doctum.cleanSearchTerm();

            if (!term) {
                \$('h2').hide();
                return;
            }

            \$('#search').val(term);
            var container = \$('.search-results');
            var results = Doctum.search(term);
            var len = results.length;

            if (len == 0) {
                container.html('";
        // line 52
        echo \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("No results were found");
        echo "');
                return;
            }

            for (var i = 0, text_content = ''; i < len; i++) {

                var ele = results[i];
                var contents = '<li><h2 class=\"clearfix\">';
                var class_name = Doctum.getSearchClass(ele.type);
                contents += '<a href=\"' + ele.link + '\">' + ele.name + '</a>';
                contents += '<div class=\"search-type type-' + ele.type + '\"><span class=\"pull-right label ' + class_name + '\">' + ele.type + '</span></div>';
                contents += '</h2>';

                if (ele.fromName && ele.fromLink) {
                    contents += '<div class=\"search-from\">from <a href=\"' + ele.fromLink + '\">' + ele.fromName + '</a></div>';
                }

                contents += '<div class=\"search-description\">';

                // Add description, decode entities, and strip wrapping quotes
                if (ele.doc) {
                    text_content = \$('<p>').text(ele.doc).html();
                    contents += text_content;
                }

                contents += '</div></li>';
                container.append(\$(contents));
            }
        })();
    </script>
";
    }

    public function getTemplateName()
    {
        return "search.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  149 => 52,  131 => 36,  127 => 35,  120 => 31,  111 => 25,  105 => 22,  100 => 20,  96 => 19,  91 => 17,  87 => 15,  82 => 12,  76 => 9,  72 => 7,  68 => 6,  61 => 4,  52 => 3,  47 => 1,  45 => 2,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"layout/layout.twig\" %}
{% from \"macros.twig\" import class_link, namespace_link, method_link, property_link %}
{% block title %}{% trans 'Search' %} | {{ parent() }}{% endblock %}
{% block body_class 'search-page' %}

{% block page_content %}

    <div class=\"page-header\">
        <h1>{% trans 'Search' %}</h1>
    </div>

    <p>{% trans 'This page allows you to search through the API documentation for
    specific terms. Enter your search words into the box below and click
    \"submit\". The search will be performed on namespaces, classes, interfaces,
    traits, functions, and methods.' %}</p>

    <form class=\"form-inline\" role=\"form\" action=\"{{ path('search.html') }}\">
        <div class=\"form-group\">
            <label class=\"sr-only\" for=\"search\">{% trans 'Search' %}</label>
            <input type=\"search\" class=\"form-control\" name=\"search\" id=\"search\" placeholder=\"{% trans 'Search' %}\">
        </div>
        <button type=\"submit\" class=\"btn btn-default\">{% trans 'submit' %}</button>
    </form>

    <h2>{% trans 'Search Results' %}</h2>

    <div class=\"container-fluid\">
        <ul class=\"search-results\"></ul>
    </div>

    {{ block('js_search') }}

{% endblock %}

{% block js_search %}
    <script type=\"text/javascript\">

        (function() {
            var term = Doctum.cleanSearchTerm();

            if (!term) {
                \$('h2').hide();
                return;
            }

            \$('#search').val(term);
            var container = \$('.search-results');
            var results = Doctum.search(term);
            var len = results.length;

            if (len == 0) {
                container.html('{% trans 'No results were found'%}');
                return;
            }

            for (var i = 0, text_content = ''; i < len; i++) {

                var ele = results[i];
                var contents = '<li><h2 class=\"clearfix\">';
                var class_name = Doctum.getSearchClass(ele.type);
                contents += '<a href=\"' + ele.link + '\">' + ele.name + '</a>';
                contents += '<div class=\"search-type type-' + ele.type + '\"><span class=\"pull-right label ' + class_name + '\">' + ele.type + '</span></div>';
                contents += '</h2>';

                if (ele.fromName && ele.fromLink) {
                    contents += '<div class=\"search-from\">from <a href=\"' + ele.fromLink + '\">' + ele.fromName + '</a></div>';
                }

                contents += '<div class=\"search-description\">';

                // Add description, decode entities, and strip wrapping quotes
                if (ele.doc) {
                    text_content = \$('<p>').text(ele.doc).html();
                    contents += text_content;
                }

                contents += '</div></li>';
                container.append(\$(contents));
            }
        })();
    </script>
{% endblock %}
", "search.twig", "/home/runner/work/laravel-mtn-momo/laravel-mtn-momo/vendor/code-lts/doctum/src/Resources/themes/default/search.twig");
    }
}
