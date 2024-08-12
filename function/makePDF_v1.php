<?php

function makePDF($antrag_page1, $antrag_page2, $antrag_page3, $antrag_page4, $antrag_page5, $antrag_page6) {
     $kontoDetail = "";
     $gewerbeErMaklerDatei = $gewerbeErVerwalterDatei = "Nein";
     $taetigkeit= "";
     $fachkunde = getFachkunde($antrag_page1['fachkunde']);     
     $taetigkeit = getTatigkeit($antrag_page2);
     $gewerbeErMakler = $antrag_page2['gewerbeerlaubnisMakler'] == "1" ? 'Ja' : 'Nein';
     $gewerbeErVerwalter = $antrag_page2['gewerbeerlaubnisVerwalter'] == "1" ? 'Ja' : 'Nein';
     $handelsregister = $antrag_page2['handelsregister'] == "1" ? 'Ja' : 'Nein';
     $immoWirtschaftlich = $antrag_page2['immobilienwirtschaftlich'] == "1" ? 'Ja' : 'Nein';
     if($gewerbeErMakler == 'Ja') $gewerbeErMaklerDatei = 'Ja<br>';
     if($gewerbeErVerwalter == 'Ja') $gewerbeErVerwalterDatei = 'Ja<br>';
     $bundesland = getCityName($antrag_page1['bundesland']);
     $mitgliedschaft_typ = getMitgliedschaftType($antrag_page3['mitgliedschaft-typ']);
     $mitgliedschaft_art = getMitgliedschaftArt($antrag_page3['mitgliedschaft-art']);
     $betriebshaft = $antrag_page5['betriebshaft'] == '1' ? 'Ja' : 'Nein';
     $kontoDetail = ($antrag_page6['zahlunsart'] == 'sepa') ? 
                         '<tr>
                              <td>Kontoinhaber</td>
                              <td>'.$antrag_page6['kontoinhaber'].'</td>                    
                         </tr>
                         <tr>
                              <td>Kreditinstitut</td>
                              <td>'.$antrag_page6['kreditinstitut'].'</td>                    
                         </tr>
                         <tr>
                              <td>Kreditinstitut</td>
                              <td>'.$antrag_page6['iban'].'</td>                    
                         </tr>' : "";                        


     $html =   "<span style='font-size:18px;'><b>Übersicht</b></span><br>
                <table style='border:1px solid;'>
                    <tr>
                         <td>Vorname: </td>
                         <td>" . $antrag_page1['p-firstname'] . "</td>
                    </tr>
                    <tr>
                         <td>Nachname</td>
                         <td>" . $antrag_page1['p-lastname'] . "</td>
                    </tr>
                    <tr>
                         <td>Geburtsdatum</td>
                         <td>" . $antrag_page1['p-birthdate'] . "</td>
                    </tr>
                    <tr>
                         <td>E-Mail</td>
                         <td>" . $antrag_page1['p-email'] . "</td>
                    </tr>
                    <tr>
                         <td>Telefon</td>
                         <td>" . $antrag_page1['p-telefon'] . "</td>
                    </tr>
                    <tr>
                         <td>Fachkunde</td>
                         <td>" . $fachkunde . "</td>
                    </tr>
                    <tr>
                         <td>Fachkunde Datei</td>
                         <td>Ja</td>
                    </tr>
                    <tr>
                         <td>Firmenname</td>
                         <td>" . $antrag_page1['firmaname'] . "</td>
                    </tr>
                    <tr>
                         <td>Straße & Haus-Nr.</td>
                         <td>" . $antrag_page1['f-strasse'] . "</td>
                    </tr>
                    <tr>
                         <td>PLZ</td>
                         <td>" . $antrag_page1['f-plz'] . "</td>
                    </tr>
                    <tr>
                         <td>Ort</td>
                         <td>" . $antrag_page1['f-ort'] . "</td>
                    </tr>
                    <tr>
                         <td>E-Mail: </td>
                         <td>" . $antrag_page1['f-email'] . "</td>
                    </tr>
                    <tr>
                         <td>Telefon</td>
                         <td>" . $antrag_page1['f-telefon'] . "</td>
                    </tr>
                    <tr>
                         <td>Website</td>
                         <td>" . $antrag_page1['f-website'] . "</td>
                    </tr>
                    <tr>
                         <td>Jahr der Gründung</td>
                         <td>" . $antrag_page2['gruendung-jahr'] . "</td>
                    </tr>
                    <tr>
                         <td>Anzahl der Mitarbeiter:</td>
                         <td>" . $antrag_page2['mitarbeiter-anzahl'] . "</td>
                    </tr>
                    <tr>
                         <td>Anzahl weiterer Filialen:</td>
                         <td>" . $antrag_page2['filiale-anzahl'] . "</td>
                    </tr>
                    <tr>
                         <td>Gewerbeanmeldung:</td>
                         <td>" . $antrag_page2['gewerbeanmeldung-datum'] . "</td>
                    </tr>
                    <tr>
                         <td>Gewerbeanmeldung Datei:</td>
                         <td>Ja</td>
                    </tr>
                    <tr>
                         <td>Gewerbeerlaubnis nach §34 c Makler:</td>
                         <td>" . $gewerbeErMakler . "</td>
                    </tr>
                    <tr>
                         <td>Gewerbeerlaubnis nach §34 c Makler Datei</td>
                         <td>" . $gewerbeErMaklerDatei . "</td>
                    </tr>
                    <tr>
                         <td>Gewerbeerlaubnis nach §34 c Verwalter:</td>
                         <td>" . $gewerbeErVerwalter . "</td>
                    </tr>
                    <tr>
                         <td>Gewerbeerlaubnis nach §34 c Verwalter Datei</td>
                         <td>" . $gewerbeErVerwalterDatei . "</td>
                    </tr>
                    <tr>
                         <td>Eintrag ins Handelsregister:</td>
                         <td>" . $handelsregister . "</td>
                    </tr>
                    <tr>
                         <td>Bilden Sie immobilienwirtschaftlich aus?</td>
                         <td>" . $immoWirtschaftlich . "</td>
                    </tr>
                    
                    <tr>
                         <td><h4>Angaben der Schwerpunkte des Unternehmens</h4></td>
                    </tr>
                    <tr>
                         <td>Ausgeübte Tätigkeitsfelder:</td>
                         <td>" . $taetigkeit . "</td>
                    </tr>
                    <tr>
                         <td>Bundesland:</td>
                         <td>" . $bundesland . "</td>
                    </tr>
                    <tr>
                         <td>Typ der Mitgliedschaft:</td>
                         <td>" . $mitgliedschaft_typ . "</td>
                    </tr>
                    <tr>
                         <td>Art der Mitgliedschaft:</td>
                         <td>" . $mitgliedschaft_art . "</td>
                    </tr>
                    <tr>
                         <td>Beginn der Mitgliedschaft:</td>
                         <td>" . $antrag_page3['mitgliedschaft-beginn'] . "</td>
                    </tr>
                    <tr>
                         <td>Erklärung:</td>
                         <td>Ja</td>
                    </tr>
                    <tr>
                         <td><h4>Regularien, Datenschutz, Versicherungen</h4></td>
                    </tr>
                    <tr>
                         <td>Kenntnissnahme Dokumente:</td>
                         <td>Ja</td>
                    </tr>
                    <tr>
                         <td>Betriebshaftpflicht:</td>
                         <td>". $betriebshaft . "</td>
                    </tr>
                    <tr>
                         <td>Betriebshaftpflicht Datei:</td>
                         <td>". $betriebshaft . "</td>
                    </tr>
                    <tr>
                         <td>Vermögensschadenhaftpflicht:</td>
                         <td>Ja</td>
                    </tr>
                    <tr>
                         <td>Vermögensschadenhaftpflicht Datei:</td>
                         <td>Ja</td>
                    </tr>
                    <tr>
                         <td><h4>Zahlung Angabe</h4></td>
                    </tr>
                    <tr>
                         <td>Zahlungsart:</td>
                         <td>" . ucfirst($antrag_page6['zahlunsart']) . "</td>
                    </tr>" . $kontoDetail . "
                </table>"            
                ;

     //echo $html;
     return $html;
}
 
/* function testPdf() {
     $testInfo =  "<div style='font-size:28px;text-align:center;'><span><b>Übersicht</b></span></div><br>
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
                    </table>
                    <br>
                    <table style='border-style:solid;margin-left:auto;margin-right:auto;'>
                         <th>Angaben der Schwerpunkte des Unternehmens</th>
                         <tr>
                              <td>Ausgeübte Tätigkeitsfelder:</td>
                              <td>taetigkeit</td>
                         </tr>
                         <tr>
                              <td>Bundesland:</td>
                              <td>bundesland</td>
                         </tr>
                         <tr>
                              <td>Typ der Mitgliedschaft:</td>
                              <td>mitgliedschaft_typ</td>
                         </tr>
                         <tr>
                              <td>Art der Mitgliedschaft:</td>
                              <td>mitgliedschaft_art</td>
                         </tr>
                         <tr>
                              <td>Beginn der Mitgliedschaft:</td>
                              <td>antrag_page3['mitgliedschaft-beginn</td>
                         </tr>
                         <tr>
                              <td>Erklärung:</td>
                              <td>Ja</td>
                         </tr>
                              <th>Regularien, Datenschutz, Versicherungen</th>
                         
                         <tr>
                              <td>Kenntnissnahme Dokumente:</td>
                              <td>Ja</td>
                         </tr>
                         <tr>
                              <td>Betriebshaftpflicht:</td>
                              <td>betriebshaft</td>
                         </tr>
                         <tr>
                              <td>Betriebshaftpflicht Datei:</td>
                              <td>betriebshaft</td>
                         </tr>
                         <tr>
                              <td>Vermögensschadenhaftpflicht:</td>
                              <td>Ja</td>
                         </tr>
                         <tr>
                              <td>Vermögensschadenhaftpflicht Datei:</td>
                              <td>Ja</td>
                         </tr>

                         <tr>
                         </tr>

                         <tr>
                              <td>Zahlungsart:</td>
                              <td>zahlunsart</td>
                         </tr>
                    </table>";
                    echo $testInfo;
}
testPdf(); */
     





?>

<style>
     table {
          font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
          font-weight: 600;
     }
     th, tr, td{
          padding: 5px 20px;
         /* padding-top: 5px;
         padding-bottom: 5px; */
         font-size:1.5rem; 
     }
</style>