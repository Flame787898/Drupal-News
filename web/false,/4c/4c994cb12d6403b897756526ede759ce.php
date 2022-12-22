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

/* themes/custom/flame/templates/layout/page.html.twig */
class __TwigTemplate_f0c5ff48fd6bcbb0845f2cc12966fb0c extends \Twig\Template
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
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 48
        echo "<div class=\"layout-container\">

  <header class=\"header\">
    <div class=\"header__top-bar\">
      <div class=\"header__wrap-content\">
        ";
        // line 53
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "top_bar", [], "any", false, false, true, 53), 53, $this->source), "html", null, true);
        echo "
      </div>
    </div>
    <div class=\"header__content\">
      <div class=\"header__content-left\">
        ";
        // line 58
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "header_left", [], "any", false, false, true, 58), 58, $this->source), "html", null, true);
        echo "
      </div>
      <div class=\"header__content-center\">
        ";
        // line 61
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "header_brand", [], "any", false, false, true, 61), 61, $this->source), "html", null, true);
        echo "
      </div>
      <div class=\"header__content-right\">
        ";
        // line 64
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "header_right", [], "any", false, false, true, 64), 64, $this->source), "html", null, true);
        echo "
          <div class=\"bg-mobile-search\"></div>
          <i class=\"fa-solid fa-xmark\" id=\"close-search\"></i>
          <i class=\"fa-sharp fa-solid fa-magnifying-glass\" id=\"search-bar\"></i>
          <i class=\"fa-sharp fa-solid fa-bars\" id=\"mobile-menu\"></i>
      </div>
    </div>
    <nav class=\"navigation\">
      ";
        // line 72
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "primary_menu", [], "any", false, false, true, 72), 72, $this->source), "html", null, true);
        echo "
      <div class=\"bg-mobile-menu\"></div>
      <div class=\"mobile-navigation\">
        <i class=\"fa-solid fa-xmark\" id=\"close-menu\"></i>
        ";
        // line 76
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "primary_menu", [], "any", false, false, true, 76), 76, $this->source), "html", null, true);
        echo "
      </div>
    </nav>
  </header>
  <main role=\"main\">
    ";
        // line 81
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "home_main_news", [], "any", false, false, true, 81)) {
            // line 82
            echo "     <section class=\"main\">

       <div class=\"main__news-one\">
         ";
            // line 85
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "home_main_news", [], "any", false, false, true, 85), 85, $this->source), "html", null, true);
            echo "
       </div>

       ";
            // line 88
            if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "related_news", [], "any", false, false, true, 88)) {
                // line 89
                echo "       <div class=\"main__news-list\">
         ";
                // line 90
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "related_news", [], "any", false, false, true, 90), 90, $this->source), "html", null, true);
                echo "
       </div>
       ";
            }
            // line 93
            echo "
       ";
            // line 94
            if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_main_home", [], "any", false, false, true, 94)) {
                // line 95
                echo "         <aside class=\"main__sidebar-home\">
           ";
                // line 96
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_main_home", [], "any", false, false, true, 96), 96, $this->source), "html", null, true);
                echo "
         </aside>
       ";
            }
            // line 99
            echo "
     </section>
    ";
        }
        // line 102
        echo "
    ";
        // line 103
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "info_block_home", [], "any", false, false, true, 103)) {
            // line 104
            echo "      <section class=\"info\">
        ";
            // line 105
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "info_block_home", [], "any", false, false, true, 105), 105, $this->source), "html", null, true);
            echo "
      </section>
    ";
        }
        // line 108
        echo "
    ";
        // line 109
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "list_news_first", [], "any", false, false, true, 109)) {
            // line 110
            echo "    <section class=\"news\">

      ";
            // line 112
            if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "left_sidebar_home_first", [], "any", false, false, true, 112)) {
                // line 113
                echo "        <aside class=\"news__left-sidebar\">
          ";
                // line 114
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "left_sidebar_home_first", [], "any", false, false, true, 114), 114, $this->source), "html", null, true);
                echo "
        </aside>
      ";
            }
            // line 117
            echo "
        <div class=\"news__list\">
          ";
            // line 119
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "list_news_first", [], "any", false, false, true, 119), 119, $this->source), "html", null, true);
            echo "
        </div>

      ";
            // line 122
            if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "right_sidebar_home_first", [], "any", false, false, true, 122)) {
                // line 123
                echo "        <aside class=\"news__right-sidebar\">
          ";
                // line 124
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "right_sidebar_home_first", [], "any", false, false, true, 124), 124, $this->source), "html", null, true);
                echo "
        </aside>
      ";
            }
            // line 127
            echo "
    </section>
    ";
        }
        // line 130
        echo "
    ";
        // line 131
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "must_read_home", [], "any", false, false, true, 131)) {
            // line 132
            echo "    <section class=\"must-read\">
      ";
            // line 133
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "must_read_home", [], "any", false, false, true, 133), 133, $this->source), "html", null, true);
            echo "
    </section>
    ";
        }
        // line 136
        echo "
    ";
        // line 137
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "banner", [], "any", false, false, true, 137)) {
            // line 138
            echo "      <section class=\"banner\">
        ";
            // line 139
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "banner", [], "any", false, false, true, 139), 139, $this->source), "html", null, true);
            echo "
      </section>
    ";
        }
        // line 142
        echo "
    ";
        // line 143
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "list_news_second", [], "any", false, false, true, 143)) {
            // line 144
            echo "    <section class=\"news\">
      ";
            // line 145
            if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "left_sidebar_home_second", [], "any", false, false, true, 145)) {
                // line 146
                echo "        <aside class=\"news__left-sidebar\">
          ";
                // line 147
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "left_sidebar_home_second", [], "any", false, false, true, 147), 147, $this->source), "html", null, true);
                echo "
        </aside>
      ";
            }
            // line 150
            echo "
      <div class=\"news__list\">
        ";
            // line 152
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "list_news_second", [], "any", false, false, true, 152), 152, $this->source), "html", null, true);
            echo "
      </div>

      ";
            // line 155
            if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "right_sidebar_home_second", [], "any", false, false, true, 155)) {
                // line 156
                echo "        <aside class=\"news__right-sidebar\">
          ";
                // line 157
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "right_sidebar_home_second", [], "any", false, false, true, 157), 157, $this->source), "html", null, true);
                echo "
        </aside>
      ";
            }
            // line 160
            echo "
    </section>
    ";
        }
        // line 163
        echo "    <section class=\"main-content\">
      ";
        // line 164
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "content", [], "any", false, false, true, 164), 164, $this->source), "html", null, true);
        echo "
    </section>
  </main>

    <footer role=\"contentinfo\">
      <div class=\"wrap-content\">
        <div class=\"col\">";
        // line 170
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_sidebar_first", [], "any", false, false, true, 170), 170, $this->source), "html", null, true);
        echo "</div>
        <div class=\"col\">";
        // line 171
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_sidebar_second", [], "any", false, false, true, 171), 171, $this->source), "html", null, true);
        echo "</div>
        <div class=\"col\">";
        // line 172
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_sidebar_third", [], "any", false, false, true, 172), 172, $this->source), "html", null, true);
        echo "</div>
        <div class=\"col\">";
        // line 173
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer_sidebar_four", [], "any", false, false, true, 173), 173, $this->source), "html", null, true);
        echo "</div>
      </div>
    </footer>

</div>
";
    }

    public function getTemplateName()
    {
        return "themes/custom/flame/templates/layout/page.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  292 => 173,  288 => 172,  284 => 171,  280 => 170,  271 => 164,  268 => 163,  263 => 160,  257 => 157,  254 => 156,  252 => 155,  246 => 152,  242 => 150,  236 => 147,  233 => 146,  231 => 145,  228 => 144,  226 => 143,  223 => 142,  217 => 139,  214 => 138,  212 => 137,  209 => 136,  203 => 133,  200 => 132,  198 => 131,  195 => 130,  190 => 127,  184 => 124,  181 => 123,  179 => 122,  173 => 119,  169 => 117,  163 => 114,  160 => 113,  158 => 112,  154 => 110,  152 => 109,  149 => 108,  143 => 105,  140 => 104,  138 => 103,  135 => 102,  130 => 99,  124 => 96,  121 => 95,  119 => 94,  116 => 93,  110 => 90,  107 => 89,  105 => 88,  99 => 85,  94 => 82,  92 => 81,  84 => 76,  77 => 72,  66 => 64,  60 => 61,  54 => 58,  46 => 53,  39 => 48,);
    }

    public function getSourceContext()
    {
        return new Source("{#
/**
 * @file
 * Default theme implementation to display a single page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.html.twig template in this directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - base_path: The base URL path of the Drupal installation. Will usually be
 *   \"/\" unless you have installed Drupal in a sub-directory.
 * - is_front: A flag indicating if the current page is the front page.
 * - logged_in: A flag indicating if the user is registered and signed in.
 * - is_admin: A flag indicating if the user has permission to access
 *   administration pages.
 *
 * Site identity:
 * - front_page: The URL of the front page. Use this instead of base_path when
 *   linking to the front page. This includes the language domain or prefix.
 *
 * Page content (in order of occurrence in the default page.html.twig):
 * - messages: Status and error messages. Should be displayed prominently.
 * - node: Fully loaded node, if there is an automatically-loaded node
 *   associated with the page and the node ID is the second argument in the
 *   page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - page.header: Items for the header region.
 * - page.primary_menu: Items for the primary menu region.
 * - page.secondary_menu: Items for the secondary menu region.
 * - page.highlighted: Items for the highlighted content region.
 * - page.help: Dynamic help text, mostly for admin pages.
 * - page.content: The main content of the current page.
 * - page.sidebar_first: Items for the first sidebar.
 * - page.sidebar_second: Items for the second sidebar.
 * - page.footer: Items for the footer region.
 * - page.breadcrumb: Items for the breadcrumb region.
 *
 * @see template_preprocess_page()
 * @see html.html.twig
 *
 * @ingroup themeable
 */
#}
<div class=\"layout-container\">

  <header class=\"header\">
    <div class=\"header__top-bar\">
      <div class=\"header__wrap-content\">
        {{page.top_bar}}
      </div>
    </div>
    <div class=\"header__content\">
      <div class=\"header__content-left\">
        {{ page.header_left }}
      </div>
      <div class=\"header__content-center\">
        {{ page.header_brand }}
      </div>
      <div class=\"header__content-right\">
        {{ page.header_right }}
          <div class=\"bg-mobile-search\"></div>
          <i class=\"fa-solid fa-xmark\" id=\"close-search\"></i>
          <i class=\"fa-sharp fa-solid fa-magnifying-glass\" id=\"search-bar\"></i>
          <i class=\"fa-sharp fa-solid fa-bars\" id=\"mobile-menu\"></i>
      </div>
    </div>
    <nav class=\"navigation\">
      {{ page.primary_menu }}
      <div class=\"bg-mobile-menu\"></div>
      <div class=\"mobile-navigation\">
        <i class=\"fa-solid fa-xmark\" id=\"close-menu\"></i>
        {{ page.primary_menu }}
      </div>
    </nav>
  </header>
  <main role=\"main\">
    {% if page.home_main_news %}
     <section class=\"main\">

       <div class=\"main__news-one\">
         {{ page.home_main_news }}
       </div>

       {% if  page.related_news  %}
       <div class=\"main__news-list\">
         {{ page.related_news }}
       </div>
       {% endif %}

       {% if  page.sidebar_main_home   %}
         <aside class=\"main__sidebar-home\">
           {{ page.sidebar_main_home }}
         </aside>
       {% endif %}

     </section>
    {% endif %}

    {% if page.info_block_home %}
      <section class=\"info\">
        {{ page.info_block_home }}
      </section>
    {% endif %}

    {% if page.list_news_first  %}
    <section class=\"news\">

      {% if page.left_sidebar_home_first %}
        <aside class=\"news__left-sidebar\">
          {{ page.left_sidebar_home_first }}
        </aside>
      {% endif %}

        <div class=\"news__list\">
          {{ page.list_news_first }}
        </div>

      {% if page.right_sidebar_home_first %}
        <aside class=\"news__right-sidebar\">
          {{ page.right_sidebar_home_first }}
        </aside>
      {% endif %}

    </section>
    {% endif %}

    {% if page.must_read_home %}
    <section class=\"must-read\">
      {{ page.must_read_home }}
    </section>
    {% endif %}

    {% if page.banner %}
      <section class=\"banner\">
        {{ page.banner }}
      </section>
    {% endif %}

    {% if page.list_news_second %}
    <section class=\"news\">
      {% if page.left_sidebar_home_second %}
        <aside class=\"news__left-sidebar\">
          {{ page.left_sidebar_home_second }}
        </aside>
      {% endif %}

      <div class=\"news__list\">
        {{ page.list_news_second }}
      </div>

      {% if page.right_sidebar_home_second %}
        <aside class=\"news__right-sidebar\">
          {{ page.right_sidebar_home_second }}
        </aside>
      {% endif %}

    </section>
    {% endif %}
    <section class=\"main-content\">
      {{ page.content }}
    </section>
  </main>

    <footer role=\"contentinfo\">
      <div class=\"wrap-content\">
        <div class=\"col\">{{page.footer_sidebar_first}}</div>
        <div class=\"col\">{{page.footer_sidebar_second}}</div>
        <div class=\"col\">{{page.footer_sidebar_third}}</div>
        <div class=\"col\">{{page.footer_sidebar_four}}</div>
      </div>
    </footer>

</div>
", "themes/custom/flame/templates/layout/page.html.twig", "/var/www/html/web/themes/custom/flame/templates/layout/page.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 81);
        static $filters = array("escape" => 53);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['if'],
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
