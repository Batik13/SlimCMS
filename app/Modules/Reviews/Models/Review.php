<?

namespace App\Modules\Reviews\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model {

  protected $table = 'reviews';

  // for created
  protected $fillable = [
    'img',
    'name',
    'post',
    'title',
    'text'
  ];

  public function getName() {
    return ['review', 'Отзывы'];
  }
}
