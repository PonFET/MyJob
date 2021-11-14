<?php
        namespace PHPMailer;

        require_once 'PHPMailer.php';
        require_once 'SMTP.php';
        require_once 'Exception.php';

        use Models\Company;
        use Models\jobOffer;
        use QR\QR_BarCode as QR;

        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;
        use PHPMailer\PHPMailer\SMTP;


    class email
    {

        public function sendExpirationOffer($email, jobOffer $jobOffer, $companyName)
        {
            

            // Instantiation and passing `true` enables exceptions
            $mail = new PHPMailer(true);
            
            try {
                //Server settings
                //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'ssl://smtp.gmail.com:465';     //borrar ssl:// y :465               // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = EMAIL;               // "youremail@gmail.com"      // SMTP username
                $mail->Password   = EMAIL_PASS;            // 'yourpassword'                   // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;    // "ssl"     // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above//25//587
            
                //Recipients
                $mail->setFrom(EMAIL, 'Admin');     // $email, 'Admin'
                $mail->addAddress($email);    // "youremail@gmail.com" // Add a recipient//usuario
            
            
                // Attachments
                //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                //$mail->addAttachment($qr->qrCode(300), 'new.jpg');    // Optional name
            
                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Postulacion finalizada';
            
                $mail->Body= "Se le comunica que esta oferta laboral ha expirado:" . $jobOffer->getOfferDescription();

                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }

        public function sendPostulationDelete($email, jobOffer $jobOffer, $companyName)
        {
            

            // Instantiation and passing `true` enables exceptions
            $mail = new PHPMailer(true);
            
            try {
                //Server settings
                //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'ssl://smtp.gmail.com:465';     //borrar ssl:// y :465               // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = EMAIL;               // "youremail@gmail.com"      // SMTP username
                $mail->Password   = EMAIL_PASS;            // 'yourpassword'                   // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;    // "ssl"     // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above//25//587
            
                //Recipients
                $mail->setFrom(EMAIL, 'Admin');     // $email, 'Admin'
                $mail->addAddress($email);    // "youremail@gmail.com" // Add a recipient//usuario
            
            
                // Attachments
                //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                //$mail->addAttachment($qr->qrCode(300), 'new.jpg');    // Optional name
            
                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Postulacion eliminada';
            
                $mail->Body= "Se le comunica que su postulacion para esta oferta laboral: '"
                                 . $jobOffer->getOfferDescription() . "' de la empresa: '" . $companyName . 
                                 "', ha sido eliminada por un Administrador de la UTN, lo invitamos a ponerse en contacto
                                  para saber los motivos o para realizar una apelacion.";

                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }

        public function sendNewCompany(Company $company)
        {
            

            // Instantiation and passing `true` enables exceptions
            $mail = new PHPMailer(true);
            
            try {
                //Server settings
                //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'ssl://smtp.gmail.com:465';     //borrar ssl:// y :465               // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = EMAIL;               // "youremail@gmail.com"      // SMTP username
                $mail->Password   = EMAIL_PASS;            // 'yourpassword'                   // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;    // "ssl"     // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above//25//587
            
                //Recipients
                $mail->setFrom(EMAIL, 'Admin');     // $email, 'Admin'
                $mail->addAddress($company->getEmail());    // "youremail@gmail.com" // Add a recipient//usuario
            
            
                // Attachments
                //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                //$mail->addAttachment($qr->qrCode(300), 'new.jpg');    // Optional name
            
                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Nueva Empresa';
            
                $mail->Body= "Se le comunica que una nueva empresa se ha creado con los siguientes datos:
                            \r Nombre: " . $company->getCompanyName() . 
                            "\r Ubicacion: " . $company->getLocation() .
                            "\r Descripcion: " . $company->getDescription() . 
                            "\r Telefono: " . $company->getPhoneNumber() . 
                            "\r CUIT: " . $company->getCuit();

                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }

        public function send($email)
        {
            

            // Instantiation and passing `true` enables exceptions
            $mail = new PHPMailer(true);
            
            try {
                //Server settings
                //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'ssl://smtp.gmail.com:465';     //borrar ssl:// y :465               // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = EMAIL;               // "youremail@gmail.com"      // SMTP username
                $mail->Password   = EMAIL_PASS;            // 'yourpassword'                   // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;    // "ssl"     // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above//25//587
            
                //Recipients
                $mail->setFrom(EMAIL, 'Admin');     // $email, 'Admin'
                $mail->addAddress($email);    // "youremail@gmail.com" // Add a recipient//usuario
            
            
                // Attachments
                //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                //$mail->addAttachment($qr->qrCode(300), 'new.jpg');    // Optional name
            
                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Nueva Empresa';
            
                $mail->Body= "Se le comunica que una nueva empresa se ha creado";

                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }


?>
