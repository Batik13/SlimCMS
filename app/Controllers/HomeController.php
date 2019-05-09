<?

namespace App\Controllers;

use App\Models\User;
use App\Modules\Pages\Models\Page;
use App\Modules\Options\ModelFilterBuilder\OptionFilter;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class HomeController extends Controller {

	public function index($request, $response) {   
    $data = (object) ['app' => $this, 'request' => $request, 'response' => $response];
    return $this->view->render($response, 'public/home.phtml', ['data' => $data]);
  } 



  public function page( $request, $response ) {
    $data = (object) ['app' => $this, 'request' => $request, 'response' => $response];

    $route = $request->getAttribute('route');
    $slug = $route->getArguments()['slug'];

    $model = Page::where('url', '=', $slug)->get()[0];

    if (strpos($model->art, 'about') !== false) {
		  return $this->view->render($response, 'public/about.phtml', ['data' => $data]);
    }
    else if (strpos($model->art, 'contacts') !== false) {
      $data->template = 'contacts';
      return $this->view->render($response, 'public/contacts.phtml', ['data' => $data]);
    }
    else if ($model->art === 'map' ) {
      return $this->view->render($response, 'public/map.phtml', ['data' => $data]);
    }
    else {

      // если rout есть, но в бд нет url
      if (empty($model->url)) { 
        $url_404 = $this->router->pathFor('page', ['slug' => '404']);
        return $response->withRedirect( $url_404 );
      }

      $data->model = $model;

      return $this->view->render($response, 'public/inner.phtml', ['data' => $data]);
    }
  }



  public function ajax( $request, $response ) {
    $email = OptionFilter::code('email');
    // $data = $request->getQueryParams(); // GET
    $data = $request->getParsedBody(); // POST

    $mail = new PHPMailer(true);
    try {
      $mail->setFrom($email, 'Mailer');
      $mail->addAddress($email);     // Add a recipient
      // $mail->addAddress('ellen@example.com');               // Name is optional
      // $mail->addReplyTo('info@example.com', 'Information');
      // $mail->addCC('cc@example.com');
      // $mail->addBCC('bcc@example.com');

      // Attachments
      $dataImg = substr($data['fileHidden'], strpos($data['fileHidden'], ","));
      $filename="file.png";
      $encoding = "base64";
      $type = "image/png";
      $mail->AddStringAttachment(base64_decode($dataImg), $filename, $encoding, $type);
      // $mail->addAttachment($data['fileHidden']);         // Add attachments
      // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

      $message = $this->f->fillTemplate(OptionFilter::code('email_template'), [
        'name' => $data['name'],
        'phone' => $data['phone'],
        'email' => $data['email'],
        'comment' => $data['comment'],
      ]);

      // Content
      $mail->isHTML(true);                                  // Set email format to HTML
      $mail->Subject = $data['subject'];
      $mail->Body    = $message;
      // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

      $mail->send();

      // echo 'Message has been sent';
    } catch (Exception $e) {
      // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      echo false;
    }

    echo true;
  }



  /*public function sendMailMessage( $mail, $data, $message ) {
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
  }*/

}
