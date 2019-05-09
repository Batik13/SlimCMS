<?

namespace App\Modules\Sliders\ModelFilterBuilder;

use App\Modules\_Source\ModelFilterBuilder\AFilter;
use App\Modules\Sliders\ModelShortBuilder\HomeShort;
use App\Modules\Sliders\Models\Slider;
use App\Modules\Pages\Models\Page;
use App\Functions\Functions as f;


class SliderFilter extends AFilter{

  public function __construct($content, $short, $container) {
    parent::__construct($content, $short, $container);
  }

  public function __toString() {
    
    if ($this->short[1] === 'home') {
      $text = new HomeShort( $this->container );
      $this->content = str_replace($this->shortcode, $text, $this->content);
    }

    return $this->content;
  }

}