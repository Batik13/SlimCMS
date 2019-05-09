<?

namespace App\Modules\Articles\Models;

use Illuminate\Database\Eloquent\Model;
use App\Functions\Functions as f;

class Article extends Model {

  protected $table = 'articles';

  // for created
  protected $fillable = [
    'publish',
    'name',
    'href',
    'date',
    'text',
    'min_text',
    'art',
    'art_href',
    'img',
    'thumb',
    'label',
    'title',
    'description',
    'keywords'
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

  public function getImgAttribute($value) {
    return str_replace('{{root}}', f::root(), $value);
  }

  public function setImgAttribute($value) {
    $this->attributes['img'] = str_replace(f::root(), '{{root}}', $value);
  }

  public function getThumbAttribute($value) {
    return str_replace('{{root}}', f::root(), $value);
  }

  public function setThumbAttribute($value) {
    $this->attributes['thumb'] = str_replace(f::root(), '{{root}}', $value);
  }

  public function getArtHrefAttribute($value) {
    return $value;
  }

  public function setArtHrefAttribute($value) {
    $this->attributes['art_href'] = trim(strtolower(f::convert($this->attributes['art'], 'ru_en')));
  }

  public function getName() {
    return ['articles', 'Статьи'];
  }
}
