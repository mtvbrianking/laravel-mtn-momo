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

/* doctum.js.twig */
class __TwigTemplate_7c12350f6da8aaa71538d19eadcea56200d561af0eb352a332d4aeb9b67138d2 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'search_index_extra' => [$this, 'block_search_index_extra'],
            'treejs' => [$this, 'block_treejs'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        $macros["__internal_4cffd99356caefb057e2ad57eb631f8b39ae003640e375e0a1db0e034aa65b52"] = $this->macros["__internal_4cffd99356caefb057e2ad57eb631f8b39ae003640e375e0a1db0e034aa65b52"] = $this;
        // line 2
        echo "
";
        // line 20
        echo "
(function(root) {

    var bhIndex = null;
    var rootPath = '';
    var treeHtml = '";
        // line 25
        echo twig_spaceless(twig_replace_filter(twig_call_macro($macros["__internal_4cffd99356caefb057e2ad57eb631f8b39ae003640e375e0a1db0e034aa65b52"], "macro_element", [(isset($context["tree"]) || array_key_exists("tree", $context) ? $context["tree"] : (function () { throw new RuntimeError('Variable "tree" does not exist.', 25, $this->source); })()), twig_get_attribute($this->env, $this->source, (isset($context["project"]) || array_key_exists("project", $context) ? $context["project"] : (function () { throw new RuntimeError('Variable "project" does not exist.', 25, $this->source); })()), "config", [0 => "default_opened_level"], "method", false, false, false, 25), 0], 25, $context, $this->getSourceContext()), ["'" => "\\'", "
" => ""]));
        echo "';

    var searchTypeClasses = {
        '";
        // line 28
        echo twig_escape_filter($this->env, twig_escape_filter($this->env, \Wdes\phpI18nL10n\Launcher::gettext("Namespace"), "js"), "html", null, true);
        echo "': 'label-default',
        '";
        // line 29
        echo twig_escape_filter($this->env, twig_escape_filter($this->env, \Wdes\phpI18nL10n\Launcher::gettext("Class"), "js"), "html", null, true);
        echo "': 'label-info',
        '";
        // line 30
        echo twig_escape_filter($this->env, twig_escape_filter($this->env, \Wdes\phpI18nL10n\Launcher::gettext("Interface"), "js"), "html", null, true);
        echo "': 'label-primary',
        '";
        // line 31
        echo twig_escape_filter($this->env, twig_escape_filter($this->env, \Wdes\phpI18nL10n\Launcher::gettext("Trait"), "js"), "html", null, true);
        echo "': 'label-success',
        '";
        // line 32
        echo twig_escape_filter($this->env, twig_escape_filter($this->env, \Wdes\phpI18nL10n\Launcher::gettext("Method"), "js"), "html", null, true);
        echo "': 'label-danger',
        '_': 'label-warning'
    };

    var searchIndex = [
        ";
        // line 37
        $macros["__internal_538203aeac433d254be1e648e46743eb4fa69618101123a77547b8876ffe1708"] = $this->macros["__internal_538203aeac433d254be1e648e46743eb4fa69618101123a77547b8876ffe1708"] = $this;
        // line 38
        echo "        ";
        $context["prettyJsonOptions"] = (twig_constant("JSON_UNESCAPED_SLASHES") | twig_constant("JSON_UNESCAPED_UNICODE"));
        // line 39
        echo "        ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["namespaces"]) || array_key_exists("namespaces", $context) ? $context["namespaces"] : (function () { throw new RuntimeError('Variable "namespaces" does not exist.', 39, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["ns"]) {
            // line 40
            echo json_encode(["type" => \Wdes\phpI18nL10n\Launcher::gettext("Namespace"), "link" => $this->extensions['Doctum\Renderer\TwigExtension']->pathForNamespace($context,             // line 43
$context["ns"]), "name" =>             // line 44
$context["ns"], "doc" => sprintf("Namespace %s",             // line 45
$context["ns"])],             // line 46
(isset($context["prettyJsonOptions"]) || array_key_exists("prettyJsonOptions", $context) ? $context["prettyJsonOptions"] : (function () { throw new RuntimeError('Variable "prettyJsonOptions" does not exist.', 46, $this->source); })()));
            // line 47
            echo ",";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ns'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 49
        echo "        ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["interfaces"]) || array_key_exists("interfaces", $context) ? $context["interfaces"] : (function () { throw new RuntimeError('Variable "interfaces" does not exist.', 49, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["class"]) {
            // line 50
            $context["interface"] = ["type" => \Wdes\phpI18nL10n\Launcher::gettext("Interface"), "link" => $this->extensions['Doctum\Renderer\TwigExtension']->pathForClass($context,             // line 52
$context["class"]), "name" => twig_get_attribute($this->env, $this->source,             // line 53
$context["class"], "name", [], "any", false, false, false, 53), "doc" => $this->extensions['Doctum\Renderer\TwigExtension']->parseDesc($context, twig_get_attribute($this->env, $this->source,             // line 54
$context["class"], "shortdesc", [], "any", false, false, false, 54), $context["class"])];
            // line 56
            echo "            ";
            if (twig_get_attribute($this->env, $this->source, $context["class"], "namespace", [], "any", false, false, false, 56)) {
                // line 57
                echo "                ";
                $context["interface"] = ["type" => twig_get_attribute($this->env, $this->source,                 // line 58
(isset($context["interface"]) || array_key_exists("interface", $context) ? $context["interface"] : (function () { throw new RuntimeError('Variable "interface" does not exist.', 58, $this->source); })()), "type", [], "any", false, false, false, 58), "fromName" => twig_get_attribute($this->env, $this->source,                 // line 59
$context["class"], "namespace", [], "any", false, false, false, 59), "fromLink" => $this->extensions['Doctum\Renderer\TwigExtension']->pathForNamespace($context, twig_get_attribute($this->env, $this->source,                 // line 60
$context["class"], "namespace", [], "any", false, false, false, 60)), "link" => twig_get_attribute($this->env, $this->source,                 // line 61
(isset($context["interface"]) || array_key_exists("interface", $context) ? $context["interface"] : (function () { throw new RuntimeError('Variable "interface" does not exist.', 61, $this->source); })()), "link", [], "any", false, false, false, 61), "name" => twig_get_attribute($this->env, $this->source,                 // line 62
(isset($context["interface"]) || array_key_exists("interface", $context) ? $context["interface"] : (function () { throw new RuntimeError('Variable "interface" does not exist.', 62, $this->source); })()), "name", [], "any", false, false, false, 62), "doc" => twig_get_attribute($this->env, $this->source,                 // line 63
(isset($context["interface"]) || array_key_exists("interface", $context) ? $context["interface"] : (function () { throw new RuntimeError('Variable "interface" does not exist.', 63, $this->source); })()), "doc", [], "any", false, false, false, 63)];
                // line 65
                echo "             ";
            }
            // line 66
            echo json_encode(            // line 67
(isset($context["interface"]) || array_key_exists("interface", $context) ? $context["interface"] : (function () { throw new RuntimeError('Variable "interface" does not exist.', 67, $this->source); })()), (isset($context["prettyJsonOptions"]) || array_key_exists("prettyJsonOptions", $context) ? $context["prettyJsonOptions"] : (function () { throw new RuntimeError('Variable "prettyJsonOptions" does not exist.', 67, $this->source); })()));
            // line 68
            echo ",
            ";
            // line 69
            echo twig_call_macro($macros["__internal_538203aeac433d254be1e648e46743eb4fa69618101123a77547b8876ffe1708"], "macro_add_class_methods_index", [$context["class"], (isset($context["prettyJsonOptions"]) || array_key_exists("prettyJsonOptions", $context) ? $context["prettyJsonOptions"] : (function () { throw new RuntimeError('Variable "prettyJsonOptions" does not exist.', 69, $this->source); })())], 69, $context, $this->getSourceContext());
            echo "
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['class'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 71
        echo "        ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["classes"]) || array_key_exists("classes", $context) ? $context["classes"] : (function () { throw new RuntimeError('Variable "classes" does not exist.', 71, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["class"]) {
            // line 72
            $context["classOrTrait"] = ["type" => ((twig_get_attribute($this->env, $this->source,             // line 73
$context["class"], "isTrait", [], "any", false, false, false, 73)) ? (\Wdes\phpI18nL10n\Launcher::gettext("Trait")) : (\Wdes\phpI18nL10n\Launcher::gettext("Class"))), "link" => $this->extensions['Doctum\Renderer\TwigExtension']->pathForClass($context,             // line 74
$context["class"]), "name" => twig_get_attribute($this->env, $this->source,             // line 75
$context["class"], "name", [], "any", false, false, false, 75), "doc" => $this->extensions['Doctum\Renderer\TwigExtension']->parseDesc($context, twig_get_attribute($this->env, $this->source,             // line 76
$context["class"], "shortdesc", [], "any", false, false, false, 76), $context["class"])];
            // line 78
            echo "            ";
            if (twig_get_attribute($this->env, $this->source, $context["class"], "namespace", [], "any", false, false, false, 78)) {
                // line 79
                echo "                ";
                $context["classOrTrait"] = ["type" => twig_get_attribute($this->env, $this->source,                 // line 80
(isset($context["classOrTrait"]) || array_key_exists("classOrTrait", $context) ? $context["classOrTrait"] : (function () { throw new RuntimeError('Variable "classOrTrait" does not exist.', 80, $this->source); })()), "type", [], "any", false, false, false, 80), "fromName" => twig_get_attribute($this->env, $this->source,                 // line 81
$context["class"], "namespace", [], "any", false, false, false, 81), "fromLink" => $this->extensions['Doctum\Renderer\TwigExtension']->pathForNamespace($context, twig_get_attribute($this->env, $this->source,                 // line 82
$context["class"], "namespace", [], "any", false, false, false, 82)), "link" => twig_get_attribute($this->env, $this->source,                 // line 83
(isset($context["classOrTrait"]) || array_key_exists("classOrTrait", $context) ? $context["classOrTrait"] : (function () { throw new RuntimeError('Variable "classOrTrait" does not exist.', 83, $this->source); })()), "link", [], "any", false, false, false, 83), "name" => twig_get_attribute($this->env, $this->source,                 // line 84
(isset($context["classOrTrait"]) || array_key_exists("classOrTrait", $context) ? $context["classOrTrait"] : (function () { throw new RuntimeError('Variable "classOrTrait" does not exist.', 84, $this->source); })()), "name", [], "any", false, false, false, 84), "doc" => twig_get_attribute($this->env, $this->source,                 // line 85
(isset($context["classOrTrait"]) || array_key_exists("classOrTrait", $context) ? $context["classOrTrait"] : (function () { throw new RuntimeError('Variable "classOrTrait" does not exist.', 85, $this->source); })()), "doc", [], "any", false, false, false, 85)];
                // line 87
                echo "            ";
            }
            // line 88
            echo json_encode(            // line 89
(isset($context["classOrTrait"]) || array_key_exists("classOrTrait", $context) ? $context["classOrTrait"] : (function () { throw new RuntimeError('Variable "classOrTrait" does not exist.', 89, $this->source); })()), (isset($context["prettyJsonOptions"]) || array_key_exists("prettyJsonOptions", $context) ? $context["prettyJsonOptions"] : (function () { throw new RuntimeError('Variable "prettyJsonOptions" does not exist.', 89, $this->source); })()));
            // line 90
            echo ",
            ";
            // line 91
            echo twig_call_macro($macros["__internal_538203aeac433d254be1e648e46743eb4fa69618101123a77547b8876ffe1708"], "macro_add_class_methods_index", [$context["class"], (isset($context["prettyJsonOptions"]) || array_key_exists("prettyJsonOptions", $context) ? $context["prettyJsonOptions"] : (function () { throw new RuntimeError('Variable "prettyJsonOptions" does not exist.', 91, $this->source); })())], 91, $context, $this->getSourceContext());
            echo "
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['class'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 93
        echo "        ";
        // line 94
        echo "        ";
        $this->displayBlock('search_index_extra', $context, $blocks);
        // line 95
        echo "        // Fix trailing commas in the index
        {}
    ];

    /** Tokenizes strings by namespaces and functions */
    function tokenizer(term) {
        if (!term) {
            return [];
        }

        var tokens = [term];
        var meth = term.indexOf('::');

        // Split tokens into methods if \"::\" is found.
        if (meth > -1) {
            tokens.push(term.substr(meth + 2));
            term = term.substr(0, meth - 2);
        }

        // Split by namespace or fake namespace.
        if (term.indexOf('\\\\') > -1) {
            tokens = tokens.concat(term.split('\\\\'));
        } else if (term.indexOf('_') > 0) {
            tokens = tokens.concat(term.split('_'));
        }

        // Merge in splitting the string by case and return
        tokens = tokens.concat(term.match(/(([A-Z]?[^A-Z]*)|([a-z]?[^a-z]*))/g).slice(0,-1));

        return tokens;
    };

    root.Doctum = {
        /**
         * Cleans the provided term. If no term is provided, then one is
         * grabbed from the query string \"search\" parameter.
         */
        cleanSearchTerm: function(term) {
            // Grab from the query string
            if (typeof term === 'undefined') {
                var name = 'search';
                var regex = new RegExp(\"[\\\\?&]\" + name + \"=([^&#]*)\");
                var results = regex.exec(location.search);
                if (results === null) {
                    return null;
                }
                term = decodeURIComponent(results[1].replace(/\\+/g, \" \"));
            }

            return term.replace(/<(?:.|\\n)*?>/gm, '');
        },

        /** Searches through the index for a given term */
        search: function(term) {
            // Create a new search index if needed
            if (!bhIndex) {
                bhIndex = new Bloodhound({
                    limit: 500,
                    local: searchIndex,
                    datumTokenizer: function (d) {
                        return tokenizer(d.name);
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace
                });
                bhIndex.initialize();
            }

            results = [];
            bhIndex.get(term, function(matches) {
                results = matches;
            });

            if (!rootPath) {
                return results;
            }

            // Fix the element links based on the current page depth.
            return \$.map(results, function(ele) {
                if (ele.link.indexOf('..') > -1) {
                    return ele;
                }
                ele.link = rootPath + ele.link;
                if (ele.fromLink) {
                    ele.fromLink = rootPath + ele.fromLink;
                }
                return ele;
            });
        },

        /** Get a search class for a specific type */
        getSearchClass: function(type) {
            return searchTypeClasses[type] || searchTypeClasses['_'];
        },

        /** Add the left-nav tree to the site */
        injectApiTree: function(ele) {
            ele.html(treeHtml);
        }
    };

    \$(function() {
        // Modify the HTML to work correctly based on the current depth
        rootPath = \$('body').attr('data-root-path');
        treeHtml = treeHtml.replace(/href=\"/g, 'href=\"' + rootPath);
        Doctum.injectApiTree(\$('#api-tree'));
    });

    return root.Doctum;
})(window);

\$(function() {

    ";
        // line 207
        if ((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["project"]) || array_key_exists("project", $context) ? $context["project"] : (function () { throw new RuntimeError('Variable "project" does not exist.', 207, $this->source); })()), "versions", [], "any", false, false, false, 207)) > 1)) {
            // line 208
            echo "    // Enable the version switcher
    \$('#version-switcher').on('change', function() {
        window.location = \$(this).val()
    });
    var versionSwitcher = document.getElementById('version-switcher');
    if (versionSwitcher) {
        var versionToSelect = document.evaluate(
            '//option[@data-version=\"";
            // line 215
            echo twig_escape_filter($this->env, twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["project"]) || array_key_exists("project", $context) ? $context["project"] : (function () { throw new RuntimeError('Variable "project" does not exist.', 215, $this->source); })()), "version", [], "any", false, false, false, 215), "js"), "html", null, true);
            echo "\"]',
            versionSwitcher,
            null,
            XPathResult.FIRST_ORDERED_NODE_TYPE,
            null
        ).singleNodeValue;

        if (versionToSelect && typeof versionToSelect.selected === 'boolean') {
            versionToSelect.selected = true;
        }
    }
    ";
        }
        // line 227
        echo "
    ";
        // line 228
        $this->displayBlock('treejs', $context, $blocks);
        // line 254
        echo "
    ";
        // line 282
        echo "
        var form = \$('#search-form .typeahead');
        form.typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'search',
            displayKey: 'name',
            source: function (q, cb) {
                cb(Doctum.search(q));
            }
        });

        // The selection is direct-linked when the user selects a suggestion.
        form.on('typeahead:selected', function(e, suggestion) {
            window.location = suggestion.link;
        });

        // The form is submitted when the user hits enter.
        form.keypress(function (e) {
            if (e.which == 13) {
                \$('#search-form').submit();
                return true;
            }
        });

    ";
        echo "
});


";
    }

    // line 94
    public function block_search_index_extra($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "";
    }

    // line 228
    public function block_treejs($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 229
        echo "
        // Toggle left-nav divs on click
        \$('#api-tree .hd span').on('click', function() {
            \$(this).parent().parent().toggleClass('opened');
        });

        // Expand the parent namespaces of the current page.
        var expected = \$('body').attr('data-name');

        if (expected) {
            // Open the currently selected node and its parents.
            var container = \$('#api-tree');
            var node = \$('#api-tree li[data-name=\"' + expected + '\"]');
            // Node might not be found when simulating namespaces
            if (node.length > 0) {
                node.addClass('active').addClass('opened');
                node.parents('li').addClass('opened');
                var scrollPos = node.offset().top - container.offset().top + container.scrollTop();
                // Position the item nearer to the top of the screen.
                scrollPos -= 200;
                container.scrollTop(scrollPos);
            }
        }

    ";
    }

    // line 3
    public function macro_add_class_methods_index($__class__ = null, $__prettyJsonOptions__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "class" => $__class__,
            "prettyJsonOptions" => $__prettyJsonOptions__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start();
        try {
            // line 4
            echo "    ";
            if (twig_get_attribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 4, $this->source); })()), "methods", [], "any", false, false, false, 4)) {
                // line 5
                echo "        ";
                $context["from_link"] = $this->extensions['Doctum\Renderer\TwigExtension']->pathForClass($context, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 5, $this->source); })()));
                // line 6
                echo "        ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 6, $this->source); })()), "methods", [], "any", false, false, false, 6));
                foreach ($context['_seq'] as $context["_key"] => $context["meth"]) {
                    // line 7
                    echo json_encode(["type" => \Wdes\phpI18nL10n\Launcher::gettext("Method"), "fromName" => twig_get_attribute($this->env, $this->source,                     // line 10
(isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 10, $this->source); })()), "name", [], "any", false, false, false, 10), "fromLink" =>                     // line 11
(isset($context["from_link"]) || array_key_exists("from_link", $context) ? $context["from_link"] : (function () { throw new RuntimeError('Variable "from_link" does not exist.', 11, $this->source); })()), "link" => $this->extensions['Doctum\Renderer\TwigExtension']->pathForMethod($context,                     // line 12
$context["meth"]), "name" => twig_get_attribute($this->env, $this->source,                     // line 13
$context["meth"], "__toString", [], "method", false, false, false, 13), "doc" => $this->extensions['Doctum\Renderer\TwigExtension']->parseDesc($context, twig_get_attribute($this->env, $this->source,                     // line 14
$context["meth"], "shortdesc", [], "any", false, false, false, 14), (isset($context["class"]) || array_key_exists("class", $context) ? $context["class"] : (function () { throw new RuntimeError('Variable "class" does not exist.', 14, $this->source); })()))],                     // line 15
(isset($context["prettyJsonOptions"]) || array_key_exists("prettyJsonOptions", $context) ? $context["prettyJsonOptions"] : (function () { throw new RuntimeError('Variable "prettyJsonOptions" does not exist.', 15, $this->source); })()));
                    // line 16
                    echo ",
        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['meth'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 18
                echo "    ";
            }

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 286
    public function macro_element($__tree__ = null, $__opened__ = null, $__depth__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "tree" => $__tree__,
            "opened" => $__opened__,
            "depth" => $__depth__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start();
        try {
            // line 287
            echo "    ";
            $macros["__internal_cbe64619a2f13e5e0632488198c07a87f08fa0d5dca27ae15a22e12eae1ce247"] = $this;
            // line 288
            echo "
    <ul>";
            // line 290
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["tree"]) || array_key_exists("tree", $context) ? $context["tree"] : (function () { throw new RuntimeError('Variable "tree" does not exist.', 290, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["element"]) {
                // line 291
                if (twig_get_attribute($this->env, $this->source, $context["element"], 2, [], "array", false, false, false, 291)) {
                    // line 292
                    echo "<li data-name=\"namespace:";
                    echo twig_replace_filter(twig_get_attribute($this->env, $this->source, $context["element"], 1, [], "array", false, false, false, 292), ["\\" => "_"]);
                    echo "\" ";
                    if (((isset($context["depth"]) || array_key_exists("depth", $context) ? $context["depth"] : (function () { throw new RuntimeError('Variable "depth" does not exist.', 292, $this->source); })()) < (isset($context["opened"]) || array_key_exists("opened", $context) ? $context["opened"] : (function () { throw new RuntimeError('Variable "opened" does not exist.', 292, $this->source); })()))) {
                        echo "class=\"opened\"";
                    }
                    echo ">
                    <div style=\"padding-left:";
                    // line 293
                    echo ((isset($context["depth"]) || array_key_exists("depth", $context) ? $context["depth"] : (function () { throw new RuntimeError('Variable "depth" does not exist.', 293, $this->source); })()) * 18);
                    echo "px\" class=\"hd\">
                        <span class=\"icon icon-play\"></span>
                        <a href=\"";
                    // line 295
                    echo $this->extensions['Doctum\Renderer\TwigExtension']->pathForNamespace($context, twig_get_attribute($this->env, $this->source, $context["element"], 1, [], "array", false, false, false, 295));
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["element"], 0, [], "array", false, false, false, 295);
                    echo "</a>
                    </div>
                    <div class=\"bd\">
                        ";
                    // line 298
                    echo twig_call_macro($macros["__internal_cbe64619a2f13e5e0632488198c07a87f08fa0d5dca27ae15a22e12eae1ce247"], "macro_element", [twig_get_attribute($this->env, $this->source, $context["element"], 2, [], "array", false, false, false, 298), (isset($context["opened"]) || array_key_exists("opened", $context) ? $context["opened"] : (function () { throw new RuntimeError('Variable "opened" does not exist.', 298, $this->source); })()), ((isset($context["depth"]) || array_key_exists("depth", $context) ? $context["depth"] : (function () { throw new RuntimeError('Variable "depth" does not exist.', 298, $this->source); })()) + 1)], 298, $context, $this->getSourceContext());
                    // line 299
                    echo "</div>
                </li>";
                } else {
                    // line 302
                    echo "<li data-name=\"class:";
                    echo twig_escape_filter($this->env, twig_replace_filter(twig_get_attribute($this->env, $this->source, $context["element"], 1, [], "array", false, false, false, 302), ["\\" => "_"]), "html", null, true);
                    echo "\" ";
                    if (((isset($context["depth"]) || array_key_exists("depth", $context) ? $context["depth"] : (function () { throw new RuntimeError('Variable "depth" does not exist.', 302, $this->source); })()) < (isset($context["opened"]) || array_key_exists("opened", $context) ? $context["opened"] : (function () { throw new RuntimeError('Variable "opened" does not exist.', 302, $this->source); })()))) {
                        echo "class=\"opened\"";
                    }
                    echo ">
                    <div style=\"padding-left:";
                    // line 303
                    echo twig_escape_filter($this->env, (8 + ((isset($context["depth"]) || array_key_exists("depth", $context) ? $context["depth"] : (function () { throw new RuntimeError('Variable "depth" does not exist.', 303, $this->source); })()) * 18)), "html", null, true);
                    echo "px\" class=\"hd leaf\">
                        <a href=\"";
                    // line 304
                    echo $this->extensions['Doctum\Renderer\TwigExtension']->pathForClass($context, twig_get_attribute($this->env, $this->source, $context["element"], 1, [], "array", false, false, false, 304));
                    echo "\">";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["element"], 0, [], "array", false, false, false, 304), "html", null, true);
                    echo "</a>
                    </div>
                </li>";
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['element'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 309
            echo "    </ul>
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    public function getTemplateName()
    {
        return "doctum.js.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  541 => 309,  529 => 304,  525 => 303,  516 => 302,  512 => 299,  510 => 298,  502 => 295,  497 => 293,  488 => 292,  486 => 291,  482 => 290,  479 => 288,  476 => 287,  461 => 286,  451 => 18,  444 => 16,  442 => 15,  441 => 14,  440 => 13,  439 => 12,  438 => 11,  437 => 10,  436 => 7,  431 => 6,  428 => 5,  425 => 4,  411 => 3,  383 => 229,  379 => 228,  372 => 94,  336 => 282,  333 => 254,  331 => 228,  328 => 227,  313 => 215,  304 => 208,  302 => 207,  188 => 95,  185 => 94,  183 => 93,  175 => 91,  172 => 90,  170 => 89,  169 => 88,  166 => 87,  164 => 85,  163 => 84,  162 => 83,  161 => 82,  160 => 81,  159 => 80,  157 => 79,  154 => 78,  152 => 76,  151 => 75,  150 => 74,  149 => 73,  148 => 72,  143 => 71,  135 => 69,  132 => 68,  130 => 67,  129 => 66,  126 => 65,  124 => 63,  123 => 62,  122 => 61,  121 => 60,  120 => 59,  119 => 58,  117 => 57,  114 => 56,  112 => 54,  111 => 53,  110 => 52,  109 => 50,  104 => 49,  98 => 47,  96 => 46,  95 => 45,  94 => 44,  93 => 43,  92 => 40,  87 => 39,  84 => 38,  82 => 37,  74 => 32,  70 => 31,  66 => 30,  62 => 29,  58 => 28,  51 => 25,  44 => 20,  41 => 2,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% from _self import element %}

{% macro add_class_methods_index(class, prettyJsonOptions) %}
    {% if class.methods %}
        {% set from_link = class_path(class) %}
        {% for meth in class.methods %}
            {{-
                {
                    type: 'Method'|trans,
                    fromName: class.name,
                    fromLink: from_link,
                    link: method_path(meth),
                    name: meth.__toString(),
                    doc: meth.shortdesc|desc(class),
                }|json_encode(prettyJsonOptions)|raw
            -}},
        {% endfor %}
    {% endif %}
{% endmacro %}

(function(root) {

    var bhIndex = null;
    var rootPath = '';
    var treeHtml = '{{ element(tree, project.config('default_opened_level'), 0)|replace({\"'\": \"\\\\'\", \"\\n\": ''})|spaceless|raw }}';

    var searchTypeClasses = {
        '{{ 'Namespace'|trans|escape('js') }}': 'label-default',
        '{{ 'Class'|trans|escape('js') }}': 'label-info',
        '{{ 'Interface'|trans|escape('js') }}': 'label-primary',
        '{{ 'Trait'|trans|escape('js') }}': 'label-success',
        '{{ 'Method'|trans|escape('js') }}': 'label-danger',
        '_': 'label-warning'
    };

    var searchIndex = [
        {% from _self import add_class_methods_index %}
        {% set prettyJsonOptions = constant('JSON_UNESCAPED_SLASHES') b-or constant('JSON_UNESCAPED_UNICODE') %}
        {% for ns in namespaces -%}
            {{-
                {
                    type: 'Namespace'|trans,
                    link: namespace_path(ns),
                    name: ns,
                    doc: 'Namespace %s'|format(ns),
                }|json_encode(prettyJsonOptions)|raw
            -}},
        {%- endfor %}
        {% for class in interfaces -%}
            {% set interface = {
                        type: 'Interface'|trans,
                        link: class_path(class),
                        name: class.name,
                        doc: class.shortdesc|desc(class),
            } %}
            {% if class.namespace %}
                {% set interface = {
                        type: interface.type,
                        fromName: class.namespace,
                        fromLink: namespace_path(class.namespace),
                        link: interface.link,
                        name: interface.name,
                        doc: interface.doc,
                } %}
             {% endif %}
            {{-
                interface|json_encode(prettyJsonOptions)|raw
            -}},
            {{ add_class_methods_index(class, prettyJsonOptions) }}
        {% endfor %}
        {% for class in classes -%}
            {% set classOrTrait = {
                        type: class.isTrait ? 'Trait'|trans : 'Class'|trans,
                        link: class_path(class),
                        name: class.name,
                        doc: class.shortdesc|desc(class),
            } %}
            {% if class.namespace %}
                {% set classOrTrait = {
                        type: classOrTrait.type,
                        fromName: class.namespace,
                        fromLink: namespace_path(class.namespace),
                        link: classOrTrait.link,
                        name: classOrTrait.name,
                        doc: classOrTrait.doc,
                } %}
            {% endif %}
            {{-
                classOrTrait|json_encode(prettyJsonOptions)|raw
            -}},
            {{ add_class_methods_index(class, prettyJsonOptions) }}
        {% endfor %}
        {# Override this block, search_index_extra, to add custom search entries! #}
        {% block search_index_extra '' %}
        // Fix trailing commas in the index
        {}
    ];

    /** Tokenizes strings by namespaces and functions */
    function tokenizer(term) {
        if (!term) {
            return [];
        }

        var tokens = [term];
        var meth = term.indexOf('::');

        // Split tokens into methods if \"::\" is found.
        if (meth > -1) {
            tokens.push(term.substr(meth + 2));
            term = term.substr(0, meth - 2);
        }

        // Split by namespace or fake namespace.
        if (term.indexOf('\\\\') > -1) {
            tokens = tokens.concat(term.split('\\\\'));
        } else if (term.indexOf('_') > 0) {
            tokens = tokens.concat(term.split('_'));
        }

        // Merge in splitting the string by case and return
        tokens = tokens.concat(term.match(/(([A-Z]?[^A-Z]*)|([a-z]?[^a-z]*))/g).slice(0,-1));

        return tokens;
    };

    root.Doctum = {
        /**
         * Cleans the provided term. If no term is provided, then one is
         * grabbed from the query string \"search\" parameter.
         */
        cleanSearchTerm: function(term) {
            // Grab from the query string
            if (typeof term === 'undefined') {
                var name = 'search';
                var regex = new RegExp(\"[\\\\?&]\" + name + \"=([^&#]*)\");
                var results = regex.exec(location.search);
                if (results === null) {
                    return null;
                }
                term = decodeURIComponent(results[1].replace(/\\+/g, \" \"));
            }

            return term.replace(/<(?:.|\\n)*?>/gm, '');
        },

        /** Searches through the index for a given term */
        search: function(term) {
            // Create a new search index if needed
            if (!bhIndex) {
                bhIndex = new Bloodhound({
                    limit: 500,
                    local: searchIndex,
                    datumTokenizer: function (d) {
                        return tokenizer(d.name);
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace
                });
                bhIndex.initialize();
            }

            results = [];
            bhIndex.get(term, function(matches) {
                results = matches;
            });

            if (!rootPath) {
                return results;
            }

            // Fix the element links based on the current page depth.
            return \$.map(results, function(ele) {
                if (ele.link.indexOf('..') > -1) {
                    return ele;
                }
                ele.link = rootPath + ele.link;
                if (ele.fromLink) {
                    ele.fromLink = rootPath + ele.fromLink;
                }
                return ele;
            });
        },

        /** Get a search class for a specific type */
        getSearchClass: function(type) {
            return searchTypeClasses[type] || searchTypeClasses['_'];
        },

        /** Add the left-nav tree to the site */
        injectApiTree: function(ele) {
            ele.html(treeHtml);
        }
    };

    \$(function() {
        // Modify the HTML to work correctly based on the current depth
        rootPath = \$('body').attr('data-root-path');
        treeHtml = treeHtml.replace(/href=\"/g, 'href=\"' + rootPath);
        Doctum.injectApiTree(\$('#api-tree'));
    });

    return root.Doctum;
})(window);

\$(function() {

    {% if project.versions|length > 1 %}
    // Enable the version switcher
    \$('#version-switcher').on('change', function() {
        window.location = \$(this).val()
    });
    var versionSwitcher = document.getElementById('version-switcher');
    if (versionSwitcher) {
        var versionToSelect = document.evaluate(
            '//option[@data-version=\"{{ project.version|escape('js') }}\"]',
            versionSwitcher,
            null,
            XPathResult.FIRST_ORDERED_NODE_TYPE,
            null
        ).singleNodeValue;

        if (versionToSelect && typeof versionToSelect.selected === 'boolean') {
            versionToSelect.selected = true;
        }
    }
    {% endif %}

    {% block treejs %}

        // Toggle left-nav divs on click
        \$('#api-tree .hd span').on('click', function() {
            \$(this).parent().parent().toggleClass('opened');
        });

        // Expand the parent namespaces of the current page.
        var expected = \$('body').attr('data-name');

        if (expected) {
            // Open the currently selected node and its parents.
            var container = \$('#api-tree');
            var node = \$('#api-tree li[data-name=\"' + expected + '\"]');
            // Node might not be found when simulating namespaces
            if (node.length > 0) {
                node.addClass('active').addClass('opened');
                node.parents('li').addClass('opened');
                var scrollPos = node.offset().top - container.offset().top + container.scrollTop();
                // Position the item nearer to the top of the screen.
                scrollPos -= 200;
                container.scrollTop(scrollPos);
            }
        }

    {% endblock %}

    {% verbatim %}
        var form = \$('#search-form .typeahead');
        form.typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'search',
            displayKey: 'name',
            source: function (q, cb) {
                cb(Doctum.search(q));
            }
        });

        // The selection is direct-linked when the user selects a suggestion.
        form.on('typeahead:selected', function(e, suggestion) {
            window.location = suggestion.link;
        });

        // The form is submitted when the user hits enter.
        form.keypress(function (e) {
            if (e.which == 13) {
                \$('#search-form').submit();
                return true;
            }
        });

    {% endverbatim %}
});


{% macro element(tree, opened, depth) %}
    {% from _self import element %}

    <ul>
        {%- for element in tree -%}
            {%- if element[2] -%}
                <li data-name=\"namespace:{{ element[1]|replace({'\\\\': '_'})|raw }}\" {% if depth < opened %}class=\"opened\"{% endif %}>
                    <div style=\"padding-left:{{ (depth * 18)|raw }}px\" class=\"hd\">
                        <span class=\"icon icon-play\"></span>
                        <a href=\"{{ namespace_path(element[1]) }}\">{{ element[0]|raw }}</a>
                    </div>
                    <div class=\"bd\">
                        {{ element(element[2], opened, depth + 1) -}}
                    </div>
                </li>
            {%- else -%}
                <li data-name=\"class:{{ element[1]|replace({'\\\\': '_'}) }}\" {% if depth < opened %}class=\"opened\"{% endif %}>
                    <div style=\"padding-left:{{ 8 + (depth * 18) }}px\" class=\"hd leaf\">
                        <a href=\"{{ class_path(element[1]) }}\">{{ element[0] }}</a>
                    </div>
                </li>
            {%- endif -%}
        {%- endfor %}
    </ul>
{% endmacro %}
", "doctum.js.twig", "/home/runner/work/laravel-mtn-momo/laravel-mtn-momo/vendor/code-lts/doctum/src/Resources/themes/default/doctum.js.twig");
    }
}
