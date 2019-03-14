<?

namespace App\Modules\Pages\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model {
  protected $table = 'pages';

  // for created
  protected $fillable = [
    'name',
    'url',
    'art',
    'text',
    'title',
    'description',
    'keywords',
  ];

  public function getName() {
    return ['page', 'Страницы'];
  }
}
