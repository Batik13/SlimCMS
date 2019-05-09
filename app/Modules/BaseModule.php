<?

namespace App\Modules;

class BaseModule {
  protected $errorMessage = 'Option not found!';
  protected $container;
  protected $quantity;

  public function __construct( $container, $quantity ) {
    $this->container = $container;
    $this->quantity = $quantity;
  }
}