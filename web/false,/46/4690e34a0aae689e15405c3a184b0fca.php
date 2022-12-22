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

/* themes/custom/flame/templates/block/block--stayconnected.html.twig */
class __TwigTemplate_a91e04080cddcb8d3fb2e11bd345953a extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 28
        echo "<div class=\"stay-block\" ";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["attributes"] ?? null), 28, $this->source), "html", null, true);
        echo ">
  ";
        // line 29
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_prefix"] ?? null), 29, $this->source), "html", null, true);
        echo "
  ";
        // line 30
        if (($context["label"] ?? null)) {
            // line 31
            echo "    <h2";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_attributes"] ?? null), 31, $this->source), "html", null, true);
            echo "> ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["label"] ?? null), 31, $this->source), "html", null, true);
            echo "</h2>
  ";
        }
        // line 33
        echo "  ";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_suffix"] ?? null), 33, $this->source), "html", null, true);
        echo "
  ";
        // line 34
        $this->displayBlock('content', $context, $blocks);
        // line 58
        echo "</div>
";
    }

    // line 34
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 35
        echo "   ";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["content"] ?? null), 35, $this->source), "html", null, true);
        echo "
    <div class=\"wrap-row\">
      <div class=\"block\">
        <a class=\"block__link\" href=\"https://fontawesome.com/\"></a>
        <i class=\"fa-brands fa-twitter\"></i>
        <span class=\"block__count\">16,985</span>
        <span class=\"block__text\">Fans</span>
      </div>
      <div class=\"block\">
        <a class=\"block__link\" href=\"https://fontawesome.com/\"></a>
        <i class=\"fa-brands fa-facebook-f\"></i>
        <span class=\"block__count\">2,458</span>
        <span class=\"block__text\">Followers</span>
      </div>
      <div class=\"block\">
        <a class=\"block__link\" href=\"https://fontawesome.com/\"></a>
        <i class=\"fa-brands fa-youtube\"></i>
        <span class=\"block__count\">61,453</span>
        <span class=\"block__text\">Subscribers</span>
      </div>
    </div>

  ";
    }

    public function getTemplateName()
    {
        return "themes/custom/flame/templates/block/block--stayconnected.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  75 => 35,  71 => 34,  66 => 58,  64 => 34,  59 => 33,  51 => 31,  49 => 30,  45 => 29,  40 => 28,);
    }

    public function getSourceContext()
    {
        return new Source("{#
/**
 * @file
 * Theme override to display a block.
 *
 * Available variables:
 * - plugin_id: The ID of the block implementation.
 * - label: The configured label of the block if visible.
 * - configuration: A list of the block's configuration values.
 *   - label: The configured label for the block.
 *   - label_display: The display settings for the label.
 *   - provider: The module or other provider that provided this block plugin.
 *   - Block plugin specific settings will also be stored here.
 * - content: The content of this block.
 * - attributes: array of HTML attributes populated by modules, intended to
 *   be added to the main container tag of this template.
 *   - id: A valid HTML ID and guaranteed unique.
 * - title_attributes: Same as attributes, except applied to the main title
 *   tag that appears in the template.
 * - title_prefix: Additional output populated by modules, intended to be
 *   displayed in front of the main title tag that appears in the template.
 * - title_suffix: Additional output populated by modules, intended to be
 *   displayed after the main title tag that appears in the template.
 *
 * @see template_preprocess_block()
 */
#}
<div class=\"stay-block\" {{ attributes }}>
  {{ title_prefix }}
  {% if label %}
    <h2{{ title_attributes }}> {{ label }}</h2>
  {% endif %}
  {{ title_suffix }}
  {% block content %}
   {{ content }}
    <div class=\"wrap-row\">
      <div class=\"block\">
        <a class=\"block__link\" href=\"https://fontawesome.com/\"></a>
        <i class=\"fa-brands fa-twitter\"></i>
        <span class=\"block__count\">16,985</span>
        <span class=\"block__text\">Fans</span>
      </div>
      <div class=\"block\">
        <a class=\"block__link\" href=\"https://fontawesome.com/\"></a>
        <i class=\"fa-brands fa-facebook-f\"></i>
        <span class=\"block__count\">2,458</span>
        <span class=\"block__text\">Followers</span>
      </div>
      <div class=\"block\">
        <a class=\"block__link\" href=\"https://fontawesome.com/\"></a>
        <i class=\"fa-brands fa-youtube\"></i>
        <span class=\"block__count\">61,453</span>
        <span class=\"block__text\">Subscribers</span>
      </div>
    </div>

  {% endblock %}
</div>
", "themes/custom/flame/templates/block/block--stayconnected.html.twig", "/var/www/html/web/themes/custom/flame/templates/block/block--stayconnected.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 30, "block" => 34);
        static $filters = array("escape" => 28);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['if', 'block'],
                ['escape'],
                []
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
