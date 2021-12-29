<?php
/**
 * @package WordPress
 * @subpackage apiolotto
 * @since apiolotto 1.0
 */

/**
 * If you are installing Timber as a Composer dependency in your theme, you'll need this block
 * to load your dependencies and initialize Timber. If you are using Timber via the WordPress.org
 * plug-in, you can safely delete this block.
 */
$composer_autoload = dirname(__DIR__) . '/vendor/autoload.php';
if (file_exists($composer_autoload)) {
  require_once $composer_autoload;
  $timber = new Timber\Timber();
}

/**
 * This ensures that Timber is loaded and available as a PHP class.
 * If not, it gives an error message to help direct developers on where to activate
 */
if (!class_exists('Timber')) {
  add_action('admin_notices', function () {
    echo '<div class="error"><p>Timber not activated.</p></div>';
  });

  return;
}

/**
 * Sets the directories (inside your theme) to find .twig files
 */
Timber::$dirname = ['views'];

/**
 * By default, Timber does NOT autoescape values. Want to enable Twig's autoescape?
 * No prob! Just set this value to true
 */
Timber::$autoescape = false;

/**
 * We're going to configure our theme inside of a subclass of Timber\Site
 * You can move this to its own file and include here via php's include("MySite.php")
 */
class apiolottoSite extends Timber\Site
{
  /**
   * @var Enqueue
   */
  protected $wpackInstance;

  /** Add timber support. */
  public function __construct()
  {
    add_action('after_setup_theme', [$this, 'theme_supports']);
    add_action('after_setup_theme', [$this, 'load_text_domain']);
    add_filter('timber/context', [$this, 'add_to_context']);
    add_filter('timber/twig', [$this, 'add_to_twig']);
    add_action('init', [$this, 'register_post_types']);
    add_action('init', [$this, 'register_taxonomies']);
    add_action('wp_enqueue_scripts', [$this, 'enqueue_wpack_scripts']);

    $this->wpackInstance = new WPackio\Enqueue('apiolotto', '../dist', '1.0', 'theme', false);

    parent::__construct();
  }
  /** This is where you can register custom post types. */
  public function register_post_types()
  {
  }
  /** This is where you can register custom taxonomies. */
  public function register_taxonomies()
  {
  }

  /** This is where you add some context
   *
   * @param string $context context['this'] Being the Twig's {{ this }}.
   */
  public function add_to_context($context)
  {
    $context['menu'] = Timber::get_menu(17);
    $context['site'] = $this;
    if (function_exists('get_fields')) {
      $context['options'] = get_fields('options');
    }

    return $context;
  }

  public function theme_supports()
  {
    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support('title-tag');

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support('html5', ['comment-form', 'comment-list', 'gallery', 'caption']);

    /*
     * Enable support for Post Formats.
     *
     * See: https://codex.wordpress.org/Post_Formats
     */
    add_theme_support('post-formats', ['aside', 'image', 'video', 'quote', 'link', 'gallery', 'audio']);

    add_theme_support('menus');
    add_theme_support( 'woocommerce' );
  }

  /** This is where you can add your own functions to twig.
   *
   * @param string $twig get extension.
   */
  public function add_to_twig($twig)
  {
    return $twig;
  }

  /**
   * Load the theme text domain.
   */
  public function load_text_domain()
  {
    load_theme_textdomain('apiolotto');
  }

  /**
   * Load wpack.io scripts.
   */
  public function enqueue_wpack_scripts()
  {
    wp_dequeue_style('wp-block-library');
    wp_enqueue_style('apiolotto-style', get_stylesheet_uri());
    $assets = $this->wpackInstance->enqueue('app', 'main', [
      'js_dep' => ['jquery'],
    ]);
    $entry_point = array_pop($assets['js']);
    wp_localize_script($entry_point['handle'], 'context', [
      'themeLink' => get_stylesheet_directory_uri(),
      'ajaxNonce' => wp_create_nonce('ajax-nonce'),
    ]);
  }
}

new apiolottoSite();


if (function_exists('acf_add_options_page')) {
  acf_add_options_page();
}  



//Remove Gutenberg Block Library CSS from loading on the frontend
function smartwp_remove_wp_block_library_css(){
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wc-block-style' ); // Remove WooCommerce block CSS
    //if ( !is_admin() ) wp_deregister_script('jquery');
} 
add_action( 'wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100 );


