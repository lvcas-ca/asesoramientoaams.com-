<?php
    /* 
    function send_whatsapp($message){
        //$phone="+5491134212930";  // Enter your phone number here
        //$apikey="794762";       // Enter your personal apikey received in step 3 above

       $phone="+5491124635748";   //Enter your phone number here
       $apikey="141361";          //Enter your personal apikey received in step 3 above

        $url='https://api.callmebot.com/whatsapp.php?source=php&phone='.$phone.'&text='.urlencode($message).'&apikey='.$apikey;

        if($ch = curl_init($url))
        {
            curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
            $html = curl_exec($ch);
            $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            // echo "Output:".$html;  // you can print the output for troubleshooting
            curl_close($ch);
            return (int) $status;
        }
        else
        {
            return false;
        }
    }
    */
    
    require_once '../vendor/autoload.php';
    require_once 'correo.php';
  

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;


    $nombre = $_POST["nombre"]??'';
    $email = $_POST["email"]??'';
    $telefono = $_POST["telefono"]??'';
    $asunto = $_POST["asunto"]??'';
    $mensaje = $_POST["mensaje"]??'';
    
    /*
    $nuevoContactoTxt = "NUEVO CONTACTO MEDIPRIVA:";
    $nombreTexto = "Nombre:";
    $mailTexto = "Email: ";
    $telefonoTexto = "Telefono:";
    $dniTexto = "Dni: ";
    $mensajeTexto = "Mensaje:";
    */
 
 
    $respuesta = [];
    $bandera = true;

    //Expresiones regulares
    //$soloNumeros = "/[0-9]/";

    if($nombre == ""){
        $respuesta += ['nombre' => 'Ingrese su nombre'];
        $bandera= false;
    }

    if($email == ''){
        $respuesta += ['email' => 'Ingrese mail']; 
        $bandera= false;
    }

    if($telefono == '' ){
        $respuesta += ['telefono' => 'Ingrese telefono'];
        $bandera= false;
    }

	if($asunto == ''){
        $respuesta += ['asunto' => 'Ingrese asunto'];
        $bandera= false;
    }


    if($bandera){

		$mail = new PHPMailer(true);
		try {
            //$mail->SMTPDebug = 1;     
           
			$mail->isSMTP();                                            // Set mailer to use SMTP
			$mail->Host       = 'mail.asesoramientoaams.com';  // Specify main and backup SMTP servers
			$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
			$mail->Username   = '_mainaccount@asesoramientoaams.com';                     // SMTP username
			$mail->Password   = '7iwH8B@0d)1QpW';                               // SMTP password
			$mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted
			$mail->Port       = 465;
            // TCP port to connect to
            //Recipients
            //$mail->setFrom('asesorprepagassalud@gmail.com', 'Medipriva - Contacto');
            //$mail->addAddress('asesorprepagassalud@gmail.com', 'Maxi');
            //$mail->addCC('stormbringer.lu@gmail.com');
    
            $mail->setFrom('mail.asesoramientoaams.com', 'Asesoramiento - Contacto');
            $mail->addAddress('stormbringer.lu@gmail.com', 'Alphcode');
            $mail->addCC('lucas_.caceres@hotmail.com.ar');
			// Content
			$mail->Subject = 'Nuevo contacto';
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Body    = correo($nombre,$email,$telefono,$asunto,$mensaje);
			$mail->CharSet = 'UTF-8';
			$mail->send();
			$respuesta = ['respuesta' => true];

		} catch (Exception $e) {
			$respuesta = ['respuesta' => false];
		}

        /*
         
         send_whatsapp( $nuevoContactoTxt .'\n' .$nombreTexto .$nombre .'\n'
        .$mailTexto .$email .'\n'
        .$telefonoTexto .$telefono .'\n'
        .$dniTexto .$dni .'\n'
        .$mensajeTexto .$mensaje);
        
        */
       




    }


    echo json_encode($respuesta);