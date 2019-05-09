<?

namespace App\Modules\Sliders\Controllers\Site;

use App\Modules\Sliders\Models\Slider;
use App\Modules\Options\Models\Option;
use Illuminate\Database\QueryException;
use App\Controllers\Controller;

class SiteSlidersController extends Controller {

  public function __construct( $container ) {
    parent::__construct( $container );
  }

  public function inner( $request, $response ) {
    return true;    
  }

}