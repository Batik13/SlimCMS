<?

namespace App\Controllers\Auth;

use App\Models\User;
use App\Controllers\Controller;
use Respect\Validation\Validator as v;


class AuthController extends Controller {

  public function getSignOut($request, $response) {
    $this->auth->logout();

    return $response->withRedirect($this->router->pathFor('home'));
  }

  public function getSignIn( $request, $response ) {
    $data = (object) ['app' => $this, 'request' => $request, 'response' => $response];
    return $this->view->render($response, 'auth/signin.phtml', ['data' => $data]);
  }

  public function postSignIn( $request, $response ) {
    $auth = $this->auth->attempt(
      $request->getParam('email'),
      $request->getParam('password')
    );

    if (!$auth) {
      $this->flash->addMessage('error', 'Не удалось войти в систему с этими данными.');
      return $response->withRedirect($this->router->pathFor('auth.signin'));
    }

    return $response->withRedirect($this->router->pathFor('admin.home'));
  }

  public function getSignUp( $request, $response ) {
    $data = (object) ['app' => $this, 'request' => $request, 'response' => $response];
    return $this->view->render($response, 'auth/signup.phtml', ['data' => $data]);
  }

  public function postSignUp( $request, $response ) {

    $validation = $this->validator->validate( $request, [
      'name' => v::noWhitespace()->notEmpty()->alpha(),
      'email' => v::noWhitespace()->notEmpty(),
      'password' => v::noWhitespace()->notEmpty(),
    ]);

    if ($validation->failed()) {
      return $response->withRedirect($this->router->pathFor('auth.signup'));
    }

    $user = User::create([
      'name' => $request->getParam('name'),
      'email' => $request->getParam('email'),
      'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT),
    ]);

    $this->flash->addMessage('info', 'Вы были зарегистрированы!');

    $this->auth->attempt($user->email, $request->getParam('password'));

    return $response->withRedirect($this->router->pathFor('home'));
  }
}