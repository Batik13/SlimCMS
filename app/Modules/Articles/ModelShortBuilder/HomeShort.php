<?

namespace App\Modules\Articles\ModelShortBuilder;

use App\Modules\BaseModule;
use App\Modules\Articles\Models\Article;
use App\Modules\Options\Models\Option;
use Sunra\PhpSimple\HtmlDomParser;

class HomeShort extends BaseModule{

  protected $namespace = 'admin.article.settings';  

  public function __construct( $container, $quantity = null ) {
    parent::__construct( $container, $quantity );
  }

  public function __toString() {

    $isPublish = Option::where('namespace', $this->namespace)->where('code', 'publish')->get()[0]->value;
    if ($isPublish) {
      return $this->frame();
    }

    return '';
  }

  function frame() {
    $format = Option::where('namespace', $this->namespace)->where('code', 'frame')->get()[0]->value;

    if ($format) {
      return sprintf($format, $this->dynamic());
    }

    return $this->errorMessage;
  }

  function dynamic() {
    $str;
    $format = Option::where('namespace', $this->namespace)->where('code', 'dynamic')->get()[0]->value;

    if ($format) {
      foreach (Article::where('publish', '1')->take($this->quantity)->orderBy('id', 'desc')->get() as $value) {
        $url = $this->container->router->pathFor('article', ['slug' => $value->url]);
        $date = implode('.', array_reverse(explode('-', explode(' ', $value->date)[0])));
        $date = ( (int) $date ) ? $date : '';
        
        $str .= sprintf($format, $url, $date, $value->name, htmlspecialchars_decode($value->min_text), $value->id);
      }

      return $str;
    }
    
    return $this->errorMessage;
  }

  public function get( $mode ) {
    $str;
    $format = Option::where('code', str_replace('.', '-', $mode))->get()[0]->value;

    if ($mode === 'thumb.horizontal' ) {
      $query = Article::take(4)->orderBy('id', 'desc')->get();
      foreach ($query as $value) {
        $str .= sprintf(
          $format,
          $value->name,
          htmlspecialchars_decode($value->min_text),
          $this->container->router->pathFor('article', ['slug' => $value->href])
        );
      }
    }

    if ($mode === 'thumb.main' ) {
      
    }

    if ($mode === 'thumb.vertical' ) {
      $formatWrap = '
        <div class="articles-vertical">
          <div class="articles-vertical__title">
            <h3 class="text text--20">Популярные статьи</h3>
          </div>
          <div class="articles-vertical__content">
            <ul class="articles-vertical__list">%1$s</ul>
          </div>
        </div>';

      $query = Article::take(5)->orderBy('id', 'desc')->get();
      foreach ($query as $value) {
        $str .= sprintf(
          $format,
          $this->container->router->pathFor('article', ['slug' => $value->href]),
          HtmlDomParser::str_get_html(htmlspecialchars_decode($value->thumb))->find('img', 0)->src,
          $value->name
        );
      }

      $str = sprintf($formatWrap, $str);
    }

    return $str;
  }

}