<?

namespace App\Modules\Reviews\ModelShortBuilder;

use App\Source\ModelFilterBuilder\ShortFilter;
use App\Modules\Reviews\Models\Review;
use App\Modules\Options\Models\Option;

class HomeShort {

  public function __toString() {

    $isPublish = Option::where('namespace', 'admin.review.settings')->where('code', 'publish')->get()[0]->value;
    if ($isPublish) {
      return $this->frame();
    }

    return '';
  }

  function frame() {
    $format = Option::find(11)->value;

    return sprintf($format, ShortFilter::get(25), $this->dynamic());
  }

  function dynamic() {
    $str;
    $format = Option::find(12)->value;
    
    foreach (Review::all() as $value) {
      $str .= sprintf($format, ShortFilter::src($value->img), $value->name, $value->post, $value->title, $value->text);
    }
    
    return $str;
  }

}