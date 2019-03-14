<?

namespace App\Source\ModelFilterBuilder;
use App\Modules\Reviews\ModelShortBuilder\HomeShort;


class ReviewFilter extends AFilter{

  public function __construct($content, $short) {
    parent::__construct($content, $short);
  }

  public function __toString() {
    $text = new HomeShort;

    if ($this->short[1] === 'inner') {
      // $text = new InnerShort;
    }

    return str_replace($this->short[2], $text, $this->content);
  }

}