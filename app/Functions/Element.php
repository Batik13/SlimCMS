<?

namespace App\Functions;

use stdClass;

class Element extends stdClass{

  public function __call( $key, $params ) {
    if (!isset($this->{$key})) {
      throw new Exception("Call to undefined method " . get_class($this) . "::" . $key . "()");
    }

    $subject = $this->{$key};
    call_user_func_array($subject, $params);
  }

}