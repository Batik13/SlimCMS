<?

namespace App\Modules\Shorts\Models;

use Illuminate\Database\Eloquent\Model;
use App\Functions\Functions as f;

class Short extends Model {

  protected $table = 'shorts';

  // for created
  protected $fillable = [
    'name',
    'text',
    'art',
  ];

  public function getTextAttribute($value) {
    return str_replace('{{root}}', f::root(), $value);
  }

  public function setTextAttribute($value) {
    $this->attributes['text'] = str_replace(f::root(), '{{root}}', $value);
  }

  public function getName() {
    return ['short', 'Микромодули'];
  }
}
