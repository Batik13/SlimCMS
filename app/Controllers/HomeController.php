<?

namespace App\Controllers;

use App\Models\User;
use App\Modules\Pages\Models\Page;
use App\Source\ModelFilterBuilder\OptionFilter;

class HomeController extends Controller {

	public function index($request, $response) {   
    $data = (object) ['app' => $this, 'request' => $request, 'response' => $response];
    return $this->view->render($response, 'public/home.phtml', ['data' => $data]);
  } 

  public function page( $request, $response ) {
    $data = (object) ['app' => $this, 'request' => $request, 'response' => $response];

    $route = $request->getAttribute('route');
    $slug = $route->getArguments()['slug'];

    $page = Page::where('url', '=', $slug)->get()[0];

    if ($page->art === 'category' ) {
		  return $this->view->render($response, 'public/category.phtml', ['data' => $data]);
    }
    else if ($page->art === 'contacts' ) {
      return $this->view->render($response, 'public/contacts.phtml', ['data' => $data]);
    }
    else if ($page->art === 'map' ) {
      return $this->view->render($response, 'public/map.phtml', ['data' => $data]);
    }
    else {

      // если rout есть, но в бд нет url
      if (empty($page->url)) { 
        $url_404 = $this->router->pathFor('page', ['slug' => '404']);
        return $response->withRedirect( $url_404 );
      }

      return $this->view->render($response, 'public/inner.phtml', ['data' => $data]);
    }

  }

  public function ajax( $request, $response ) {

    $email = OptionFilter::code('email');
    $data = $request->getParam('data');
    $data = json_decode($data);

    $resultSend = $this->sendMailMessage($email, $data, 'письмо');

    return $resultSend;
  }

  public function sendMailMessage( $mail, $data, $message ) {
    $domen = OptionFilter::code('domen');

    $header = "From: <robot@{$domen}>\r\n" .
              "Reply-To: <robot@{$domen}>\r\n" .
              "Content-type: text/html; charset=utf-8\r\n";

    $message = $this->f->fillTemplate(OptionFilter::code('email_template'), [
      'name' => $data->name,
      'email' => $data->email,
      'phone' => $data->phone
    ]);

    if (mail($mail, $subject, $message, $header)) {
      return true;
    }

    return false;
  }

}
