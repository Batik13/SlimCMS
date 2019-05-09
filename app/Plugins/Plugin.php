<?

namespace App\Plugins;

class Plugin {

  protected $container;

  public function __construct( $container ) {
    $this->container = $container;
  }

  public function pluginsList() {
    $pluginFolder = $this->container->path['root'] . $this->container->path['plugins'];

    return [

      // jquery
      'jquery' => [
        'css' => [],
        'js' => [ 
          $pluginFolder . '/jquery/jquery-3.3.1.min.js',
        ],
      ],

      'jquery.form' => [
        'css' => [],
        'js' => [ 
          $pluginFolder . '/jquery.form/js/jquery.form.min.js',
        ],
      ],

      // Site DataTables
      'siteDatatables' => [
        'css' => [
          $pluginFolder . 'dataTables/jquery.dataTables.min.css',
        ],
        'js' => [ 
          $pluginFolder . 'dataTables/DataTables-1.10.18/js/jquery.dataTables.min.js',
          $pluginFolder . 'dataTables/initSite.js'
        ],
      ],

      // Admin DataTables
      'adminDatatables' => [
        'css' => [
          // $pluginFolder . 'dataTables/DataTables-1.10.18/css/semantic.min.css',
          // $pluginFolder . 'dataTables/DataTables-1.10.18/css/dataTables.semanticui.min.css',
          $pluginFolder . 'dataTables/jquery.dataTables.admin.min.css',
        ],
        'js' => [ 
          $pluginFolder . 'dataTables/DataTables-1.10.18/js/jquery.dataTables.min.js',
          // $pluginFolder . 'dataTables/DataTables-1.10.18/js/dataTables.semanticui.min.js',
          // $pluginFolder . 'dataTables/DataTables-1.10.18/js/semantic.min.js',
          $pluginFolder . 'dataTables/init.js'
        ],
      ],

      // summernote
      'summernote' => [
        'css' => [
          $pluginFolder . 'summernote/summernote-lite.css',
        ],
        'js' => [ 
          $pluginFolder . 'summernote/summernote-lite.min.js',
          $pluginFolder . 'summernote/summernote-gallery-extension.js',
          $pluginFolder . 'summernote/lang/summernote-ru-RU.js',
          $pluginFolder . 'summernote/init.js'
        ],
      ],

      // jquery-ui
      'jqueryui' => [
        'css' => [
          // $pluginFolder . 'jqueryui/jquery-ui.css',
        ],
        'js' => [ 
          // 'https://code.jquery.com/jquery-1.12.4.js',
          $pluginFolder . 'jqueryui/jquery-ui.js',
          $pluginFolder . 'jqueryui/init.js'
        ],
      ],


      // scrollTop
      'scrollTop' => [
        'css' => [
          $pluginFolder . 'scrollTop/scroll.css',
        ],
        'js' => [ 
          $pluginFolder . 'scrollTop/scroll.js',
          $pluginFolder . 'scrollTop/init.js'
        ],
      ],      

      // codemirror
      'codemirror' => [
        'css' => [
          $pluginFolder . 'codemirror/codemirror.css',
          $pluginFolder . 'codemirror/monokai.css',
        ],
        'js' => [ 
          $pluginFolder . 'codemirror/codemirror.js',
          $pluginFolder . 'codemirror/xml.js',
          $pluginFolder . 'codemirror/htmlmixed.js',
        ],
      ],


    ];
  }

}