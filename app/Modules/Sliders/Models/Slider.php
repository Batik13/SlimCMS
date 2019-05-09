<?

namespace App\Modules\Sliders\Models;

use Illuminate\Database\Eloquent\Model;
use App\Functions\Functions as f;

class Slider extends Model {

  protected $table = 'sliders';

  // for created
  protected $fillable = [
    'publish',
    'img',
    'name',
    'text',
    'btn',
    'href',
    'art',
  ];

  public function getImgAttribute($value) {
    return str_replace('{{root}}', f::root(), $value);
  }

  public function setImgAttribute($value) {
    $this->attributes['img'] = str_replace(f::root(), '{{root}}', $value);
  }

  public function getTextAttribute($value) {
    return str_replace('{{root}}', f::root(), $value);
  }

  public function setTextAttribute($value) {
    $this->attributes['text'] = str_replace(f::root(), '{{root}}', $value);
  }

  public function getName() {
    return ['sliders', 'Слайдер'];
  }
}
