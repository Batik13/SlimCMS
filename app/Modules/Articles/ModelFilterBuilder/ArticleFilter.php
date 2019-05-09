<?

namespace App\Modules\Articles\ModelFilterBuilder;

use App\Modules\_Source\ModelFilterBuilder\AFilter;
use App\Modules\Articles\ModelShortBuilder\HomeShort;
use App\Modules\Articles\Models\Article;
use App\Modules\Pages\Models\Page;
use App\Functions\Functions as f;


class ArticleFilter extends AFilter{

  public function __construct($content, $short, $container) {
    parent::__construct($content, $short, $container);
  }

  public function __toString() {
    
    if ($this->short[1] === 'home') {
      $text = new HomeShort( $this->container );
      $this->content = str_replace($this->shortcode, $text, $this->content);
    }

    if ($this->short[1] === 'thumb.horizontal') {
      $text = (new HomeShort( $this->container ))->get($this->short[1]);
      $this->content = str_replace($this->shortcode, $text, $this->content);
    }

    if ($this->short[1] === 'thumb.main') {
      
    }

    if ($this->short[1] === 'thumb.vertical') {
      $text = (new HomeShort( $this->container ))->get($this->short[1]);
      $this->content = str_replace($this->shortcode, $text, $this->content);
    }

    if (is_numeric($this->short[1])) {
      $text = htmlspecialchars_decode(Article::find($this->short[1])->text);
      $this->content = str_replace($this->shortcode, $text, $this->content);
    }

    return $this->content;
  }

}