<?php
//include "../../function/function.php";
//Ajax File Upload

// Function for upload File

        $docName = $_POST['fileTyp'];
        $extension_typ = $_POST['extensionTyp'];
        try{
            if($_FILES['file']['tmp_name'] != "") {
                $errorMessage = $erfolgMessage = "";
                $fileSize = $_FILES['file']['size'];
                $fileTemp = $_FILES['file']['tmp_name'];
                $fileType = $_FILES['file']['type'];
                $fileName = $_FILES['file']['name'];
                $fileError = $_FILES['file']['error'];

                $fileName = mb_strtolower(str_replace(" ", "_", $fileName));
                $fileName = str_replace( array("ä","ö","ü","ß"), array("ae","oe","ue","ss"), $fileName );
                $startPosFileExt = strrpos($fileName, ".");
                $fileExt = substr($fileName, $startPosFileExt);
                $fileNamePrefix = str_replace($fileExt, "", $fileName);
                $fileNamePrefix = preg_replace('/[^a-z0-9_-]/', "", $fileNamePrefix);
                $fileName = $fileNamePrefix . $fileExt;
                $randomPrefix = $docName . '_' . round(microtime(true)) .  '_';
                //$fileTarget = "c:/_PRIYA/ivdreg/upload/" . $randomPrefix . $fileName;
                $fileTarget = "/var/www/html/ivdreg/upload/" . $randomPrefix . $fileName;
                $fileNameWithPrefix = $randomPrefix . $fileName;
                if($extension_typ == 1) {
                    $extensions= array("image/jpeg","image/jpg","image/png");
                }else {
                    $extensions= array("application/pdf","image/jpeg","image/jpg","image/png");
                }
                
                if(in_array($fileType, $extensions)=== false){
                    $errorMessage ="Dies ist kein erlaubter Filetyp!, Bitte wählen Sie ein PDF oder JPEG oder JPG oder PNG file.";
                    $chkUploadOk = 0;
                }
                elseif($fileSize > 5242880) {
                    $errorMessage ='Die Datei ist größe darf maximal 5 kB betragen!';
                    $chkUploadOk = 0;
                }
                else {
                    $errorsMessage = NULL;
                }

                #********** FINAL File VALIDATION **********#
                if( $errorMessage ) {
                    $fileTarget = NULL;
                } 
                else {
                    if( !@move_uploaded_file($fileTemp, $fileTarget) ) {
                        // Fehlerfall
                        $errorMessage = "Beim Speichern des Bildes auf den Server ist ein Fehler aufgetreten! Bitte versuchen Sie es später noch einmal.";
                        $chkUploadOk = 0;
                        $fileTarget = NULL;
                        
                    } else {
                        // Erfolgsfall
                        $erfolgMessage = "Datei hat erfolgreich geladen..";
                        $chkUploadOk = 1;
                    } 

                }
                $fileObj[] = array(
                    'fileError'            => $fileError,
                    'fileName'             => $fileName,
                    'fileSize'             => $fileSize,
                    'fileTemp'             => $fileTemp,
                    'filePath'             => $fileTarget,
                    'chkUploadOk'          => $chkUploadOk,
                    'successImageUpload'   => $erfolgMessage,
                    'errorImageUpload'     => $errorMessage
                );
                echo json_encode($fileObj);
                die;
            }
        } catch(Exception $e) {
            $errorObj[] = array(
                'type' => $_FILES['file']['type'],
                'error' =>  'Error: ' . $e->getMessage()
            );
            //echo 'Error: ' . $e->getMessage();
            echo json_encode($errorObj);
            die;
        }
?>