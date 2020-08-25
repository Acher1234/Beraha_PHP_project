<?php
    session_start();
    include_once('Classes/Request.php');
    // These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    // Load Composer's autoloader
    require 'vendor/autoload.php';
    require_once __DIR__ . '/vendor/autoload.php';
    $id = $_GET["idRequest"];
    $request = Request::getRequestOnId($id);


// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    try {
        $facture = new \Spipu\Html2Pdf\Html2Pdf('P', 'A4', 'fr');
        $HTML = '<div><h1 style="color: red;">Request id =' . $id . '</h1><p>here you write what you want on the requestId </p>';
        for ($i = 0; $i < count($request->getArrayImage()); $i++)
        {
            $HTML = $HTML . "<p>";
            $HTML = $HTML . " start:" . $request->getArrayStartPoint()[$i];
            $HTML = $HTML . " end:" . $request->getArrayEndPoint()[$i];
            $HTML = $HTML . " height:" . $request->getArraytrackHeight()[$i];
            $HTML = $HTML . "<img src='Upload/" . $request->getArrayImage()[$i] . "'/>";
            $HTML = $HTML . "</p>";
        }
        $HTML = $HTML . "</div>";
        $facture->writeHTML(strval($HTML));
        $facture->output($_SERVER['DOCUMENT_ROOT'] . 'pdf/output'.$id.'.pdf','F');
    }catch (Throwable $e)
    {
        echo 'zut';
        print_r($e);
        $e->getMessage();
    }
    //Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';

    /* Username (email address). */
    $mail->Username = 'coursToRead@gmail.com';

    /* Google account password. */
    $mail->Password = 'Odaya1801';
    $mail->setFrom('coursToRead@gmail.com');
    require_once('config.php');
    $ArrayMail = ReturnAllMail($request->getIDclient());
    for($i=0;$i<count($ArrayMail);$i++)
    {
        $mail->addAddress($ArrayMail[$i]);
    }
    $mail->addReplyTo('acherklein0@gmail.com', 'Information');

    // Attachments
    $mail->addAttachment($_SERVER['DOCUMENT_ROOT'] . 'pdf/output'.$id.'.pdf');         // Add attachments

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body = 'This is the body in plain text for non-HTML mail clients';
    $mail->send();
    echo 'Message has been sent';
    header('Location:Redirection.php');
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
