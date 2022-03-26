<?php

// https://mlocati.github.io/php-cs-fixer-configurator
// https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/v3.0.0/UPGRADE-v3.md

declare(strict_types=1);

$excludes = [
    'coverage',
    'docs',
    'vendor',
];

$finder = PhpCsFixer\Finder::create()
    ->exclude($excludes)
    ->in(__DIR__.'/config')
    ->in(__DIR__.'/database')
    ->in(__DIR__.'/src')
    ->in(__DIR__.'/tests')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

$rules = [
    '@PSR2' => true,
    'array_syntax' => ['syntax' => 'short'],
    'no_trailing_comma_in_singleline_array' => true,
    'multiline_whitespace_before_semicolons' => [
        'strategy' => 'no_multi_line',
    ],
    'no_singleline_whitespace_before_semicolons' => true,
    'single_blank_line_before_namespace' => true,
    'blank_line_before_statement' => [
        'statements' => ['return']
    ],
    'concat_space' => [
        'spacing' => 'none',
    ],
    'echo_tag_syntax' => true,
    'no_unused_imports' => true,
    'not_operator_with_successor_space' => true,
    'no_useless_else' => true,
    'ordered_imports' => [
        'sort_algorithm' => 'alpha',
    ],
    'phpdoc_add_missing_param_annotation' => true,
    'phpdoc_indent' => true,
    'phpdoc_no_package' => true,
    'phpdoc_order' => true,
    'phpdoc_separation' => true,
    'phpdoc_single_line_var_spacing' => true,
    'phpdoc_trim' => true,
    'phpdoc_var_without_name' => true,
    'phpdoc_to_comment' => true,
    'phpdoc_summary' => true,
    'single_quote' => true,
    'single_line_comment_style' => true,
    'ternary_operator_spaces' => true,
    'trailing_comma_in_multiline' => true,
    'trim_array_spaces' => true,
];

$config = new PhpCsFixer\Config();
$config
    ->setRiskyAllowed(true)
    ->setRules($rules)
    ->setFinder($finder);

return $config;
