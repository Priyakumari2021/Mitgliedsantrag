<?php

require_once __DIR__ . '../vendor/autoload.php';
//include "function/makePDF.php";
use Dompdf\Dompdf;
use Dompdf\Options;

$dompdf = new Dompdf();

//$info = testPdf();
$html = "<h1>Übersicht von Julia</h1>
     <table style='border-style:solid;margin-left:auto;margin-right:auto;'>
          <tr>
               <td>Vorname: </td>
               <td>p-firstname</td>
          </tr>
          <tr>
               <td>Nachname</td>
               <td>p-lastname</td>
          </tr>
          <tr>
               <td>Geburtsdatum</td>
               <td>p-birthdate']</td>
          </tr>
          <tr>
               <td>E-Mail</td>
               <td>p-email</td>
          </tr>
          <tr>
               <td>Telefon</td>
               <td>p-telefon</td>
          </tr>
          <tr>
               <td>Fachkunde</td>
               <td>fachkunde</td>
          </tr>
          <tr>
               <td>Fachkunde Datei</td>
               <td>Ja</td>
          </tr>
          <tr>
               <td>Firmenname</td>
               <td>firmaname</td>
          </tr>
          <tr>
               <td>Straße & Haus-Nr.</td>
               <td>f-strasse</td>
          </tr>
          <tr>
               <td>PLZ</td>
               <td>f-plz</td>
          </tr>
          <tr>
               <td>Ort</td>
               <td>f-ort</td>
          </tr>
          <tr>
               <td>E-Mail: </td>
               <td>f-email</td>
          </tr>
          <tr>
               <td>Telefon</td>
               <td>f-telefon</td>
          </tr>
          <tr>
               <td>Website</td>
               <td>f-website</td>
          </tr>
          <tr>
               <td>Jahr der Gründung</td>
               <td>gruendung-jahr</td>
          </tr>
          <tr>
               <td>Anzahl der Mitarbeiter:</td>
               <td>mitarbeiter-anzahl</td>
          </tr>
          <tr>
               <td>Anzahl weiterer Filialen:</td>
               <td>filiale-anzahl</td>
          </tr>
          <tr>
               <td>Gewerbeanmeldung:</td>
               <td>gewerbeanmeldung-datum</td>
          </tr>
          <tr>
               <td>Gewerbeanmeldung Datei:</td>
               <td>Ja</td>
          </tr>
          <tr>
               <td>Gewerbeerlaubnis nach §34 c Makler:</td>
               <td>gewerbeErMakler</td>
          </tr>
          <tr>
               <td>Gewerbeerlaubnis nach §34 c Makler Datei</td>
               <td>gewerbeErMaklerDatei</td>
          </tr>
          <tr>
               <td>Gewerbeerlaubnis nach §34 c Verwalter:</td>
               <td>gewerbeErVerwalter</td>
          </tr>
          <tr>
               <td>Gewerbeerlaubnis nach §34 c Verwalter Datei</td>
               <td>gewerbeErVerwalterDatei</td>
          </tr>
          <tr>
               <td>Eintrag ins Handelsregister:</td>
               <td>handelsregister</td>
          </tr>
          <tr>
               <td>Bilden Sie immobilienwirtschaftlich aus?</td>
               <td>immoWirtschaftlich</td>
          </tr>
          <tr>
               <td>Gewerbeerlaubnis nach §34 c Verwalter:</td>
               <td>gewerbeErVerwalter</td>
          </tr>
     </table>";
$options = new Options;
$options->setChroot(__DIR__);

$dompdf = new Dompdf($options);

$dompdf->setPaper("A4", "portrait");

$html1= file_get_contents("template.php");

$dompdf->loadHtml($html1);
//$dompdf->loadHtmlFile("template.html");

$dompdf->render();
$dompdf->stream("invoice.pdf", ["Attachment" => 0]);
$output = $dompdf->output();
file_put_contents(__DIR__ . '/upload/PDF/file.pdf', $output);

?>