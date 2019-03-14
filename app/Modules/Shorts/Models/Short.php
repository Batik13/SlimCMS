<?

namespace App\Modules\Shorts\Models;

use Illuminate\Database\Eloquent\Model;

class Short extends Model {

  protected $table = 'shorts';

  // for created
  protected $fillable = [
    'name',
    'text',
    'art',
  ];

  public function getName() {
    return ['short', 'Микромодули'];
  }
}
