<?

namespace App\Modules\Sliders\ModelShortBuilder;

use App\Modules\BaseModule;
use App\Modules\Sliders\Models\Slider;
use App\Modules\Options\Models\Option;
use App\Modules\_Source\ModelFilterBuilder\AFilter;

class HomeShort extends BaseModule{

  protected $namespace = 'admin.slider.settings';  

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
      foreach (Slider::where('publish', '1')->take($this->quantity)->orderBy('id', 'asc')->get() as $value) {
        $str .= sprintf(
          $format, 
          AFilter::src(htmlspecialchars_decode($value->img)),
          htmlspecialchars_decode($value->name), 
          $this->container->router->pathFor('page', ['slug' => 'kontakty']),
          $value->btn
        );
      }

      return $str;
    }
    
    return $this->errorMessage;
  }

}