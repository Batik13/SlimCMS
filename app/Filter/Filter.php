<?

namespace App\Filter;

use App\Modules\_Source\Factory\FilterFactory;

class Filter {

  protected $container;
  protected $content;

  public function __construct( $content, $container ) {
    $this->content = $content;
    $this->container = $container;
  }

  public function __toString() {
    return (string) new FilterFactory( $this->content, $this->container );
  } 

}