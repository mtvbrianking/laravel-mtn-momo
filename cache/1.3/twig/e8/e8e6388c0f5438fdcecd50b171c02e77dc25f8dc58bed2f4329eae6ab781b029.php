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

/* layout/layout.twig */
class __TwigTemplate_8845acc306e0da4388475e5d6544bce3affbdfc3a824f9d0ddf2a08486a6deb9 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'content' => [$this, 'block_content'],
            'below_menu' => [$this, 'block_below_menu'],
            'page_content' => [$this, 'block_page_content'],
            'menu' => [$this, 'block_menu'],
            'leftnav' => [$this, 'block_leftnav'],
            'control_panel' => [$this, 'block_control_panel'],
            'footer' => [$this, 'block_footer'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "layout/base.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("layout/base.twig", "layout/layout.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 4
        echo "    <div id=\"content\">
        <div id=\"left-column\">
            ";
        // line 6
        $this->displayBlock("control_panel", $context, $blocks);
        echo "
            ";
        // line 7
        $this->displayBlock("leftnav", $context, $blocks);
        echo "
        </div>
        <div id=\"right-column\">
            ";
        // line 10
        $this->displayBlock("menu", $context, $blocks);
        echo "
            ";
        // line 11
        $this->displayBlock('below_menu', $context, $blocks);
        // line 12
        echo "            <div id=\"page-content\">
                ";
        // line 13
        $this->displayBlock('page_content', $context, $blocks);
        // line 14
        echo "            </div>";
        // line 15
        $this->displayBlock("footer", $context, $blocks);
        // line 16
        echo "</div>
    </div>
";
    }

    // line 11
    public function block_below_menu($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "";
    }

    // line 13
    public function block_page_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "";
    }

    // line 20
    public function block_menu($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 21
        echo "    <nav id=\"site-nav\" class=\"navbar navbar-default\" role=\"navigation\">
        <div class=\"container-fluid\">
            <div class=\"navbar-header\">
                <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\"#navbar-elements\">
                    <span class=\"sr-only\">";
        // line 25
        echo \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Toggle navigation");
        echo "</span>
                    <span class=\"icon-bar\"></span>
                    <span class=\"icon-bar\"></span>
                    <span class=\"icon-bar\"></span>
                </button>
                <a class=\"navbar-brand\" href=\"";
        // line 30
        echo twig_escape_filter($this->env, $this->extensions['Doctum\Renderer\TwigExtension']->pathForStaticFile($context, "index.html"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["project"]) || array_key_exists("project", $context) ? $context["project"] : (function () { throw new RuntimeError('Variable "project" does not exist.', 30, $this->source); })()), "config", [0 => "title"], "method", false, false, false, 30), "html", null, true);
        echo "</a>
            </div>
            <div class=\"collapse navbar-collapse\" id=\"navbar-elements\">
                <ul class=\"nav navbar-nav\">
                    <li><a href=\"";
        // line 34
        echo twig_escape_filter($this->env, $this->extensions['Doctum\Renderer\TwigExtension']->pathForStaticFile($context, "classes.html"), "html", null, true);
        echo "\">";
        echo \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Classes");
        echo "</a></li>
                    ";
        // line 35
        if ((isset($context["has_namespaces"]) || array_key_exists("has_namespaces", $context) ? $context["has_namespaces"] : (function () { throw new RuntimeError('Variable "has_namespaces" does not exist.', 35, $this->source); })())) {
            // line 36
            echo "<li><a href=\"";
            echo twig_escape_filter($this->env, $this->extensions['Doctum\Renderer\TwigExtension']->pathForStaticFile($context, "namespaces.html"), "html", null, true);
            echo "\">";
            echo \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Namespaces");
            echo "</a></li>
                    ";
        }
        // line 38
        echo "<li><a href=\"";
        echo twig_escape_filter($this->env, $this->extensions['Doctum\Renderer\TwigExtension']->pathForStaticFile($context, "interfaces.html"), "html", null, true);
        echo "\">";
        echo \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Interfaces");
        echo "</a></li>
                    <li><a href=\"";
        // line 39
        echo twig_escape_filter($this->env, $this->extensions['Doctum\Renderer\TwigExtension']->pathForStaticFile($context, "traits.html"), "html", null, true);
        echo "\">";
        echo \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Traits");
        echo "</a></li>
                    <li><a href=\"";
        // line 40
        echo twig_escape_filter($this->env, $this->extensions['Doctum\Renderer\TwigExtension']->pathForStaticFile($context, "doc-index.html"), "html", null, true);
        echo "\">";
        echo \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Index");
        echo "</a></li>
                    <li><a href=\"";
        // line 41
        echo twig_escape_filter($this->env, $this->extensions['Doctum\Renderer\TwigExtension']->pathForStaticFile($context, "search.html"), "html", null, true);
        echo "\">";
        echo \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Search");
        echo "</a></li>
                </ul>
            </div>
        </div>
    </nav>
";
    }

    // line 48
    public function block_leftnav($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 49
        echo "    <div id=\"api-tree\"></div>
";
    }

    // line 52
    public function block_control_panel($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 53
        echo "    <div id=\"control-panel\">
        ";
        // line 54
        if ((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["project"]) || array_key_exists("project", $context) ? $context["project"] : (function () { throw new RuntimeError('Variable "project" does not exist.', 54, $this->source); })()), "versions", [], "any", false, false, false, 54)) > 1)) {
            // line 55
            echo "            <form action=\"#\">
                <select  class=\"form-control\" id=\"version-switcher\" name=\"version\">
                    ";
            // line 57
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, (isset($context["project"]) || array_key_exists("project", $context) ? $context["project"] : (function () { throw new RuntimeError('Variable "project" does not exist.', 57, $this->source); })()), "versions", [], "any", false, false, false, 57));
            foreach ($context['_seq'] as $context["_key"] => $context["version"]) {
                // line 58
                echo "                        <option value=\"";
                echo twig_escape_filter($this->env, $this->extensions['Doctum\Renderer\TwigExtension']->pathForStaticFile($context, (("../" . $context["version"]) . "/index.html")), "html", null, true);
                echo "\" data-version=\"";
                echo twig_escape_filter($this->env, $context["version"], "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["version"], "longname", [], "any", false, false, false, 58), "html", null, true);
                echo "</option>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['version'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 60
            echo "                </select>
            </form>
        ";
        }
        // line 63
        echo "        <form id=\"search-form\" action=\"";
        echo twig_escape_filter($this->env, $this->extensions['Doctum\Renderer\TwigExtension']->pathForStaticFile($context, "search.html"), "html", null, true);
        echo "\">
            <span class=\"icon icon-search\"></span>
            <input name=\"search\"
                   class=\"typeahead form-control\"
                   type=\"search\"
                   placeholder=\"";
        // line 68
        echo \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Search");
        echo "\">
        </form>
    </div>
";
    }

    // line 73
    public function block_footer($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 74
        echo "<div id=\"footer\">
        ";
        // line 75
        echo sprintf(\Wdes\phpI18nL10n\Launcher::gettext("Generated by %sDoctum, a API Documentation generator and fork of Sami%s."), "<a href=\"https://github.com/code-lts/doctum\">", "</a>");
        // line 78
        if (twig_get_attribute($this->env, $this->source, (isset($context["project"]) || array_key_exists("project", $context) ? $context["project"] : (function () { throw new RuntimeError('Variable "project" does not exist.', 78, $this->source); })()), "hasFooterLink", [], "method", false, false, false, 78)) {
            // line 79
            $context["link"] = twig_get_attribute($this->env, $this->source, (isset($context["project"]) || array_key_exists("project", $context) ? $context["project"] : (function () { throw new RuntimeError('Variable "project" does not exist.', 79, $this->source); })()), "getFooterLink", [], "method", false, false, false, 79);
            // line 80
            echo "            <br/>";
            // line 81
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["link"]) || array_key_exists("link", $context) ? $context["link"] : (function () { throw new RuntimeError('Variable "link" does not exist.', 81, $this->source); })()), "before_text", [], "any", false, false, false, 81), "html", null, true);
            // line 82
            if ( !twig_test_empty(twig_get_attribute($this->env, $this->source, (isset($context["link"]) || array_key_exists("link", $context) ? $context["link"] : (function () { throw new RuntimeError('Variable "link" does not exist.', 82, $this->source); })()), "href", [], "any", false, false, false, 82))) {
                // line 83
                echo " ";
                echo "<a href=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["link"]) || array_key_exists("link", $context) ? $context["link"] : (function () { throw new RuntimeError('Variable "link" does not exist.', 83, $this->source); })()), "href", [], "any", false, false, false, 83), "html", null, true);
                echo "\" rel=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["link"]) || array_key_exists("link", $context) ? $context["link"] : (function () { throw new RuntimeError('Variable "link" does not exist.', 83, $this->source); })()), "rel", [], "any", false, false, false, 83), "html", null, true);
                echo "\" target=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["link"]) || array_key_exists("link", $context) ? $context["link"] : (function () { throw new RuntimeError('Variable "link" does not exist.', 83, $this->source); })()), "target", [], "any", false, false, false, 83), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["link"]) || array_key_exists("link", $context) ? $context["link"] : (function () { throw new RuntimeError('Variable "link" does not exist.', 83, $this->source); })()), "link_text", [], "any", false, false, false, 83), "html", null, true);
                echo "</a>";
                echo " ";
            }
            // line 85
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["link"]) || array_key_exists("link", $context) ? $context["link"] : (function () { throw new RuntimeError('Variable "link" does not exist.', 85, $this->source); })()), "after_text", [], "any", false, false, false, 85), "html", null, true);
        }
        // line 87
        echo "</div>";
    }

    public function getTemplateName()
    {
        return "layout/layout.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  275 => 87,  272 => 85,  259 => 83,  257 => 82,  255 => 81,  253 => 80,  251 => 79,  249 => 78,  247 => 75,  244 => 74,  240 => 73,  232 => 68,  223 => 63,  218 => 60,  205 => 58,  201 => 57,  197 => 55,  195 => 54,  192 => 53,  188 => 52,  183 => 49,  179 => 48,  167 => 41,  161 => 40,  155 => 39,  148 => 38,  140 => 36,  138 => 35,  132 => 34,  123 => 30,  115 => 25,  109 => 21,  105 => 20,  98 => 13,  91 => 11,  85 => 16,  83 => 15,  81 => 14,  79 => 13,  76 => 12,  74 => 11,  70 => 10,  64 => 7,  60 => 6,  56 => 4,  52 => 3,  41 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"layout/base.twig\" %}

{% block content %}
    <div id=\"content\">
        <div id=\"left-column\">
            {{ block('control_panel') }}
            {{ block('leftnav') }}
        </div>
        <div id=\"right-column\">
            {{ block('menu') }}
            {% block below_menu '' %}
            <div id=\"page-content\">
                {% block page_content '' %}
            </div>
            {{- block('footer') -}}
        </div>
    </div>
{% endblock %}

{% block menu %}
    <nav id=\"site-nav\" class=\"navbar navbar-default\" role=\"navigation\">
        <div class=\"container-fluid\">
            <div class=\"navbar-header\">
                <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\"#navbar-elements\">
                    <span class=\"sr-only\">{% trans 'Toggle navigation' %}</span>
                    <span class=\"icon-bar\"></span>
                    <span class=\"icon-bar\"></span>
                    <span class=\"icon-bar\"></span>
                </button>
                <a class=\"navbar-brand\" href=\"{{ path('index.html') }}\">{{ project.config('title') }}</a>
            </div>
            <div class=\"collapse navbar-collapse\" id=\"navbar-elements\">
                <ul class=\"nav navbar-nav\">
                    <li><a href=\"{{ path('classes.html') }}\">{% trans 'Classes' %}</a></li>
                    {% if has_namespaces -%}
                    {#  #}<li><a href=\"{{ path('namespaces.html') }}\">{% trans 'Namespaces' %}</a></li>
                    {% endif -%}
                    <li><a href=\"{{ path('interfaces.html') }}\">{% trans 'Interfaces' %}</a></li>
                    <li><a href=\"{{ path('traits.html') }}\">{% trans 'Traits' %}</a></li>
                    <li><a href=\"{{ path('doc-index.html') }}\">{% trans 'Index' %}</a></li>
                    <li><a href=\"{{ path('search.html') }}\">{% trans 'Search' %}</a></li>
                </ul>
            </div>
        </div>
    </nav>
{% endblock %}

{% block leftnav %}
    <div id=\"api-tree\"></div>
{% endblock %}

{% block control_panel %}
    <div id=\"control-panel\">
        {% if project.versions|length > 1 %}
            <form action=\"#\">
                <select  class=\"form-control\" id=\"version-switcher\" name=\"version\">
                    {% for version in project.versions %}
                        <option value=\"{{ path('../' ~ version ~ '/index.html') }}\" data-version=\"{{ version }}\">{{ version.longname }}</option>
                    {% endfor %}
                </select>
            </form>
        {% endif %}
        <form id=\"search-form\" action=\"{{ path('search.html') }}\">
            <span class=\"icon icon-search\"></span>
            <input name=\"search\"
                   class=\"typeahead form-control\"
                   type=\"search\"
                   placeholder=\"{% trans 'Search' %}\">
        </form>
    </div>
{% endblock %}

{%- block footer -%}
    <div id=\"footer\">
        {{ 'Generated by %sDoctum, a API Documentation generator and fork of Sami%s.'|trans|format(
            '<a href=\"https://github.com/code-lts/doctum\">', '</a>'
        )|raw }}
        {%- if project.hasFooterLink() -%}
            {% set link = project.getFooterLink() %}
            <br/>
            {{- link.before_text }}
            {%- if link.href is not empty -%}
                {{ \" \" }}<a href=\"{{ link.href }}\" rel=\"{{ link.rel }}\" target=\"{{ link.target }}\">{{ link.link_text }}</a>{{ \" \" }}
            {%- endif -%}
            {{ link.after_text -}}
        {%- endif -%}
    </div>
{%- endblock -%}
", "layout/layout.twig", "/home/runner/work/laravel-mtn-momo/laravel-mtn-momo/vendor/code-lts/doctum/src/Resources/themes/default/layout/layout.twig");
    }
}
