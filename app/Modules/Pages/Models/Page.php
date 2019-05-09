<?

namespace App\Modules\Pages\Models;

use Illuminate\Database\Eloquent\Model;
use App\Functions\Functions as f;

class Page extends Model {
  protected $table = 'pages';

  // for created
  protected $fillable = [
    'publish',
    'name',
    'sort',
    'url',
    'art',
    'text',
    'title',
    'description',
    'keywords',
    'min_text',
    'seo_title',
    'seo_text',
  ];

  public function getTextAttribute($value) {
    return str_replace('{{root}}', f::root(), $value);
  }

  public function setTextAttribute($value) {
    $this->attributes['text'] = str_replace(f::root(), '{{root}}', $value);
  }

  public function getMinTextAttribute($value) {
    return str_replace('{{root}}', f::root(), $value);
  }

  public function setMinTextAttribute($value) {
    $this->attributes['min_text'] = str_replace(f::root(), '{{root}}', $value);
  }

  public function getName() {
    return ['page', 'Страницы'];
  }
}
