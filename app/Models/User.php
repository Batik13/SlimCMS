<?

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model {
	protected $table = 'users';

	// for created
	protected $fillable = [
		'email',
		'name',
		'password'
	];

  public function getName() {
    return ['user', 'Пользователи'];
  }
}
