<?

namespace App\Filter;

use App\Source\Factory\FilterFactory;

class Filter {

  protected $content;

  public function __construct( $content ) {
    $this->content = $content;
  }

  public function __toString() {
    return (string) new FilterFactory( $this->content );
  }

}