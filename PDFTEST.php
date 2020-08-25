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
try {
    $facture = new \Spipu\Html2Pdf\Html2Pdf('P', 'A4', 'en',true,'utf-8');
    $facture->setDefaultFont('dejavusans');
    $facture->

    //entry DIV ADD <img width="96" height="58" src="images/rata.jpg"/>
    $HTML = '<div><p style="color: red;">Request id :' . $id . '</p>';
    $HTML = $HTML . "<p>Client Id :" . $request->getIDclient() . "</p>";
    $HTML = $HTML . "<p> בס\"ד </p><table border=\"1\" cellpadding= \"0\" align=\"center\" width=\"569\" >
                     <tr><td > ANS Handbook</td> <td rowspan=\"3\" align=\"center\">  </td> <td > ANS 4.7.004-1</td></tr>
                     <tr> <td > Revision #0 </td> <td rowspan=\"2\" width= \"200\"> טופס בקשה להתייחסות חיל אוויר לביצוע טיסה אזרחית חריגה</td></tr>
                     <tr><td > 26 FEB 2014</td></tr>
                 </table>";
    $HTML = $HTML . "<p> (סימוכין: בקשה לטיסה חריגה לפי פרק א-11 סעיף י' ולפי פרק א-17בפמ\"ת)   </p>
                 <p>שם המבקש (מפקח רת\"א)</p>
                 <p> :תאריך הגשת הבקשה" . $request->getDates() . "</p></div>";

    //details div
    $HTML = $HTML . "<div><p dir=\"RTL\" > 1. פרטי הגוף המבצע </p><p class=\"form-group\" >א. שם החברה / הטייס / אגודה מובילה :".$request->getCompanyName()."</p>
                     <p class=\"form-group\" dir=\"RTL\">ב. כלי הטיס המבצע/ים:".$request->getOperationalPilots()."</p>
                     <p class=\"form-group\">ג. אמצעי קשר קיימים בטיסה:".$request->getFlightCommunication()."</p>
                     <p class=\"form-group\">ד. ציוד הצילום (במידה ורלונטי) פירוט מלא:".$request->getPhotographyEquipement()."</p></div>";

    //Process div
    $HTML = $HTML  . "<div><br/><br/><label dir=\"RTL\"> 2. תכלית הטיסה </label>
                     <p class=\"form-group\">א. הסבר על מהות הטיסה, אזור עבודה ואופן הביצוע.:".$request->getENOTF()."</p>
                     <p class=\"form-group\">ב. טיסה מזדמנת או שוהה: ".$request->getCOSF()."</p></div>";

    //ENTOF div
    $HTML = $HTML . "<div><label dir=\"RTL\"> 3. מהות החריגה </label>
                     <p>א. פירוט מהות החריגה מהפמ\"ת או מהנחיות תעבורה אווירית.:".$request->getENOTF() ."</p></div>";

    //ROUTE WITH TABLE div
    $HTML = $HTML . "<div><label dir=\"RTL\"> 4.נתיב הטיסה  </label>
                     <p> א. כיווני טיסה :".$request->getFlightCommunication()."</p>".
                     "<p>ב. מסלול טיסה :</p><table border=\"1\"><tr><th style='width: 200px'>start</th><th style='width: 200px'>end</th><th style='width: 200px'>height</th><th style='width: 200px'>image</th></tr>";
    for ($i = 0; $i < count($request->getArrayImage()); $i++) {
        $HTML = $HTML . "<tr><td>" . $request->getArrayStartPoint()[$i] . "</td>";
        $HTML = $HTML . "<td>" . $request->getArrayEndPoint()[$i] . "</td>";
        $HTML = $HTML . "<td>" . $request->getArraytrackHeight()[$i] . "</td>";
        $HTML = $HTML . "<td><img style='height: 100px;width: 100px;' src='Upload/" . $request->getArrayImage()[$i] . "'/></td></tr>";
    }
    $HTML = $HTML . "</table></div>";

    //TIME IDV
    $HTML = $HTML . "<div><p align=\"center\" dir=\"RTL\"> * נקודות ציון ברשת WGS84 בפורמט DMS.</p>
                     <p dir= \"rtl\" > 5.זמני ביצוע</p>";
    $HTML = $HTML . "<p>  א. פירוט תאריכים ושעות. </p><p>תאריך התחלה  : ".$request->getDateStart()."</p><p> תאריך סיום :".$request->getDateEnd()."</p>";
    $HTML = $HTML . "<p>שעת התחלה : ".$request->getHourStart()."</p><p> שעת סיום :".$request->getHourEnd()."</p></div>";

    //SUP INFO div ADD <img width="96" height="58" src="images/rata.jpg"/>
    $HTML = $HTML ."<div><p> 6.   מידע מסייע נוסף  </p>";
    $HTML = $HTML ."<p>  א. באם קיים מידע מסייע להבנת מתאר הטיסה יש לפרט על כך:".$request->getENOTF()."</p>";
    $HTML = $HTML . "<table border=\"1\" cellpadding= \"0\" align=\"center\" width=\"569\" >
                        <tr><td > ANS Handbook</td> <td rowspan=\"3\" align=\"center\"> </td> <td > ANS 4.7.004-1</td></tr>
                        <tr> <td > Revision #0 </td> <td rowspan=\"2\" width= \"200\"> טופס בקשה להתייחסות חיל אוויר לביצוע טיסה אזרחית חריגה</td></tr>
                        <tr><td > 26 FEB 2014</td></tr>
                    </table></div>";

    //sign DIV
    $HTML = $HTML . "<div><p><img src=\"Signature/CAAIimages.png\"/><p>Date:".$request->getDateCAAIsign()."</p></p>";
    $HTML = $HTML . "<p><img src=\"Signature/shamgarimages.png\" /><p>Date:".$request->getDateShmsign()."</p></p></div>";

    //AirForce Div
    $HTML = $HTML . "<div><p>שם ותפקיד המתייחס:".$request->getNameAndRole()."</p>
                     <p> אנו מסתייגים מביצוע טיסה זו מהסיבות הבאות :".$request->getAirForceReason()."</p>";
    $HTML = $HTML . "<p><img src=\"Signature/AirForceimages.png\" /><p>Date:".$request->getDateAirForcesign()."</p></p></div>";
    $facture->writeHTML(strval($HTML));
    $facture->output($_SERVER['DOCUMENT_ROOT'] . 'pdf/output' . $id . '.pdf');
}catch (\Exception $e)
{
    echo 'test';
    echo $e->getMessage();
    echo $facture->clean();
}
?>