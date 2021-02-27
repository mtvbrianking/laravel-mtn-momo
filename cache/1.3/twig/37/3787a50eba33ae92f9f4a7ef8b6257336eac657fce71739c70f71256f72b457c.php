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

/* classes.twig */
class __TwigTemplate_141e665de268903a5fe4f2f0b8d2849a17b820f548d15b5d41a60beca1579068 extends \Twig\Template
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
        $macros["__internal_58147d9cdcd296bf4eada57d4b375286e93f4e42b07fb0ce1ff6e124e23b0028"] = $this->macros["__internal_58147d9cdcd296bf4eada57d4b375286e93f4e42b07fb0ce1ff6e124e23b0028"] = $this->loadTemplate("macros.twig", "classes.twig", 2)->unwrap();
        // line 1
        $this->parent = $this->loadTemplate("layout/layout.twig", "classes.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("All Classes");
        echo " | ";
        $this->displayParentBlock("title", $context, $blocks);
    }

    // line 4
    public function block_body_class($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "classes";
    }

    // line 6
    public function block_page_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 7
        echo "    <div class=\"page-header\">
        <h1>";
        // line 8
        echo \Wdes\phpI18nL10n\Launcher::getPlugin()->gettext("Classes");
        echo "</h1>
    </div>

    ";
        // line 11
        echo twig_call_macro($macros["__internal_58147d9cdcd296bf4eada57d4b375286e93f4e42b07fb0ce1ff6e124e23b0028"], "macro_render_classes", [(isset($context["classes"]) || array_key_exists("classes", $context) ? $context["classes"] : (function () { throw new RuntimeError('Variable "classes" does not exist.', 11, $this->source); })())], 11, $context, $this->getSourceContext());
        echo "
";
    }

    public function getTemplateName()
    {
        return "classes.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  80 => 11,  74 => 8,  71 => 7,  67 => 6,  60 => 4,  51 => 3,  46 => 1,  44 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"layout/layout.twig\" %}
{% from \"macros.twig\" import render_classes %}
{% block title %}{% trans 'All Classes' %} | {{ parent() }}{% endblock %}
{% block body_class 'classes' %}

{% block page_content %}
    <div class=\"page-header\">
        <h1>{% trans 'Classes' %}</h1>
    </div>

    {{ render_classes(classes) }}
{% endblock %}
", "classes.twig", "/home/runner/work/laravel-mtn-momo/laravel-mtn-momo/vendor/code-lts/doctum/src/Resources/themes/default/classes.twig");
    }
}
