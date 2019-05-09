<?

namespace App\Modules\News\ModelFilterBuilder;

use App\Modules\_Source\ModelFilterBuilder\AFilter;

class PagesFilter extends AFilter{

  public function __construct($content, $short, $container) {
    parent::__construct($content, $short, $container);
  }

  public function __toString() {
    return $this->content;
  }

}