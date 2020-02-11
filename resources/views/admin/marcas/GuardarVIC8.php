<?php
//include"../appconexion.php";

require '../../phpmailer/class.phpmailer.php';
require '../../phpmailer/class.smtp.php';
$host = '162.241.143.167';
$username = 'wwappb_vic';
$password = 'supervic365';
$db = 'wwappb_appmobile';


$conn = new mysqli($host, $username, $password, $db);
 if ($conn->connect_errno) {
    echo "Falló la conexión a MySQL";
}else{ }

$datace    = json_decode($_POST['arrayce']);
$data      = json_decode($_POST['array']);
$data1     = json_decode($_POST['array1']);
$dataen    = json_decode($_POST['arrayen']);
$dataal    = json_decode($_POST['arrayal']);
$datape    = json_decode($_POST['arraype']);
$datapn    = json_decode($_POST['arraypn']);
$dataci    = json_decode($_POST['arrayci']);
$dataop    = json_decode($_POST['arrayop']);
$dataAct   = json_decode($_POST['arrayAct']);
$dataCues  = json_decode($_POST['arrayCues']);

$Equi=0;
$FechaRegistro = date('Y-m-d H:i:s');
//cedula
foreach($datace as $objce){
    $IdUsuario    = $objce->IdUsuario;
    $FechaCaptura = $objce->FechaCaptura;
    $explo_F      = explode("-", $FechaCaptura);
    $mesC         = $explo_F[1];
    $anioC        = $explo_F[0];
    $Imagen       = $objce->Imagen;
    $geolocation  = $objce->geolocation;

    $IdCte        = $objce->IdCte;
    $Cliente      = $objce->Cliente;
    $NomComercial = $objce->NomComercial;
    $NomContacto  = $objce->NomContacto;
    $Telefono     = $objce->Telefono;
    $Email        = $objce->Email;

    $Tipo         = $objce ->TipoT;

    $ConCedulaE   = "SELECT IdCedula FROM cedulas WHERE IdCte = '$IdCte' AND FechaCaptura = '$FechaCaptura'  AND IdUsuario = $IdUsuario";
    $result       = mysqli_query($conn, $ConCedulaE);
    $fila1        = mysqli_fetch_assoc($result);

    if($fila1['IdCedula'] > 0 ){
        $IdCedula   =  $fila1['IdCedula'];
        echo "CEDULA._.". $IdCedula;
    } else {
    	$ssql = "INSERT INTO cedulas(IdUsuario,IdCte, FechaCaptura,Imagen,geolocation, TipoCed, Mes, Anio,FechaRegistro )
    			VALUES ($IdUsuario,'$IdCte','$FechaCaptura', '$Imagen', '$geolocation', '1','$mesC', '$anioC', '$FechaRegistro')";
    	//lo inserto en la base de datos
    	if (mysqli_query($conn, $ssql)){
    	//recibo el último id
        	$IdCedula = mysqli_insert_id($conn);
        	echo "CEDULA._.". $IdCedula;
        	$exis       = 1;
    	}else{
        	echo "La inserción no se realizó".mysqli_error($link);
    	}
	    $ConUCorreo1    = "SELECT Correo, Nombre, Apellidos, Division FROM usuarios WHERE IdUsuario = $IdUsuario";
	    $resul_UCorreo1 = mysqli_query($conn,$ConUCorreo1);
	    $res_UCorreo1   = mysqli_fetch_assoc($resul_UCorreo1);
	    $NombreC1       = $res_UCorreo1['Nombre']." ".$res_UCorreo1['Apellidos'];
	    $DivisionV1     = $res_UCorreo1['Division'];
	    //Fin de Consultar la division del Usuario para saber en que tablas de clientes se deben modificar
	    if($DivisionV1 == 3){
	       $InsertCliente = "UPDATE ClienteCDC SET NomComercial = '$NomComercial', Contacto = '$NomContacto', Telefono = '$Telefono',Correo = '$Email' WHERE IdCte = '$IdCte'";
	    } else {
	       $InsertCliente = "UPDATE Clientes SET NomComercial = '$NomComercial', Contacto = '$NomContacto', Telefono = '$Telefono',Correo = '$Email' WHERE IdCte = '$IdCte'";
	    }
        mysqli_query($conn, $InsertCliente);
    }
}

if($exis == 1){
     //CIerre
    foreach($dataci as $objci){

        $eval            = $objci->eval;
        $cfirma          = $objci->cfirma;
        $geolocalizacion = $objci->geolocalizacion;
        $Solestado       = $objci->Solestado;
        $coment          = $objci->coment;
        $fcierre         = $objci->fcierre;
        $envio           = $objci->envio;
        $FechaCierre     = $objci->FechaCierre;
        $NombreFirma     = $objci->NombreFirma;
        $NombreCuenta    = $objci->NombreCuenta;
        $CorreoCuenta    = $objci->CorreoCuenta;



        if($Solestado == 'si'){
            $valor = 1;
        }else{
            $valor = 2;
        }
       $InserCi = "INSERT INTO cierre(IdCedula, eval, cfirma, comentarios, geolocalizacion, fcierre, FechaCierre,NombreFirma,NombreCuenta,CorreoCuenta, Solestado)
        VALUES ($IdCedula, $eval, '$cfirma', '$coment','$geolocalizacion', '$fcierre', '$FechaCierre','$NombreFirma','$NombreCuenta','$CorreoCuenta', '$valor')";
        mysqli_query($conn,$InserCi);
    }
    //FIN DE CIERRE

    //Equipo
    foreach($data as $obj){
        $IdPrd         = $obj ->IdPrd;
        $Cantidad      = $obj ->Cantidad;
        $Ubicacion     = $obj ->Ubicacion;
        $ImgPrd        = $obj ->ImgPrd;
        $Comentario    = $obj ->Comentario;
        $Tickets       = $obj ->Tickets;
        $FechaRegistro = $obj ->FechaRegistro;
        $checkBox      = $obj ->checkBox;
        $tipo          = $obj ->TipoT;

        $InsertEqui    = "INSERT INTO ced_productos (IdCedula, IdPrd, Cantidad, Ubicacion,ImgPrd,checkBox,Comentario,Tickets, FechaRegistro)
                        VALUES ($IdCedula,$IdPrd,'$Cantidad','$Ubicacion','$ImgPrd','$checkBox','$Comentario',$Tickets,'$FechaRegistro')";
        mysqli_query($conn,$InsertEqui);
        if($checkBox == 'Equipo en mal estado'){
         $Equi=1;
        }

    }
    //FIN DE EQUIPOS
        //Imagen
    foreach($data1 as $obj1){
        $IdTipoImagen = $obj1->IdTipoImagen;
        $Cantidad     = $obj1->Cantidad;
        $Ubicacion    = $obj1->Ubicacion;
        $Comentario   = $obj1->Comentario;
        $FotoImagen   = $obj1->FotoImagen;
        $checkBox     = $obj1->checkBox;
        $Tipo         = $obj1->TipoT;

        $InsertImagen = "INSERT INTO Imagenes (IdTipoImagen, Cantidad, Ubicacion, Comentario, FotoImagen, IdCedula, checkBox)
                            VALUES($IdTipoImagen,'$Cantidad','$Ubicacion','$Comentario','$FotoImagen',$IdCedula,'$checkBox')";
        mysqli_query($conn,$InsertImagen);
    }

    //FIN DE IMAGEN

    //entrenamiento
    //fin entrenamiento

    //almacen
    foreach($dataal as $objal){
        $ImgAlmacen     = $objal->ImgAlmacen;
        $Observaciones  = $objal->Observaciones;
        $Tipo           = $objal->TipoT;

        $insertAlmacen  = "INSERT INTO tomaInventario(IdCedula, ImgAlmacen,Observaciones)
                            VALUES ($IdCedula, '$ImgAlmacen', '$Observaciones')";
        mysqli_query($conn,$insertAlmacen);
    }
    //fin almacen

     //pedido
    foreach($datape as $objpe){
        $IdCte         = $objpe->IdCte;
        $IdPrd         = $objpe->IdPrd;
        $Descripcion   = $objpe->Descripcion;
        $Inventario    = $objpe->Inventario;
        if($Inventario    == ''){ $Inventario1    = '0';} else { $Inventario1    = $Inventario; }
        $CanSolicitada    = $objpe->CanSolicitada;
        if($CanSolicitada == ''){ $CanSolicitada1 = '0';} else { $CanSolicitada1 = $CanSolicitada; }
        $Identificador    = $objpe->Identificador;
        if($Identificador = ''){$Identificador    = 0;  } else { $Identificador  = 1; }
        $Comentario       = $objpe->Comentario;
        if($Comentario    == ''){ $Comentario1    = '0';} else { $Comentario1    = $Comentario; }
        $Tipo             = $objpe->TipoT;

        $insertPedido     = "INSERT INTO tomaInventarioPrd (IdCedula, IdPrd, Inventario, CanSolicitada, FechaCaptura, IdCte,Comentario, Identificador)
                    VALUES ( '$IdCedula', '$IdPrd', '$Inventario1', '$CanSolicitada1', '$FechaCaptura', '$IdCte','$Comentario1', '$Identificador')";
        mysqli_query($conn,$insertPedido);
        $ConPed=1;
    }

      //productos nuevos
    foreach($datapn as $objpn){
        $IdPrd       = $objpn->IdPrd;
        $Uso         = $objpn->Uso;
        $Descripcion = $objpn->Descripcion;
        $Alta        = $objpn->Alta;
        $Media       = $objpn->Media;
        $Baja        = $objpn->Baja;
        $UsoDirecto  = $objpn->UsoDirecto;
        $Tipo        = $objpn->TipoT;

        $insertPN    = "INSERT INTO ced_prodnvos (IdCedula, IdPrd, Uso)
                            VALUES($IdCedula, $IdPrd, '$Uso')";
        mysqli_query($conn,$insertPN);
    }

    foreach($dataop as $objop){
        $Observaciones = $objop->Observaciones;
        $InserOp       = "INSERT INTO ObservacionesPedido(IdCedula, Observaciones)
                            VALUES ('$IdCedula', '$Observaciones')";
        mysqli_query($conn,$InserOp);
    }

    //entrenamiento
    foreach($dataen as $objen){
        $PersonaCapacitada   = $objen->PersonaCapacitada;
        $TemaCapacitacion    = $objen->TemaCapacitacion;
        $Comentario          = $objen->Comentario;
        $ImagenFirma         = $objen->ImagenFirma;
        $Puesto              = $objen->Puesto;
        $Tipo                = $objen->TipoT;

        $InsertEntrenamineto = "INSERT INTO Entrenamientos
      (IdCedula,PersonaCapacitada,Puesto,TemaCapacitacion,Comentario,ImagenFirma)
                            VALUES('$IdCedula','$PersonaCapacitada','$Puesto','$TemaCapacitacion','$Comentario','$ImagenFirma')";
        mysqli_query($conn,$InsertEntrenamineto);
    }

    //Actualizacio
    foreach ($dataAct as $objAct) {
        $FechaAct =  $objAct->Fecha;
        $RFCa =  $objAct->RFC;
        $InsertAct ="INSERT INTO Actualizaciones (IdUsuario,FechaActualizacion, RFC) VALUES($IdUsuario,'$FechaAct', $RFCa)";
        mysqli_query($conn,$InsertAct);
    }


    //Cuestionario
    foreach ($dataCues as $objCues) {
        $IdCte          = $objCues->IdCte;
        $IdCuestionario = $objCues->IdCuestionario;
        $IdPregunta     = $objCues->IdPregunta;
        $Checkbox       = $objCues->Checkbox;
        $Recomendacion  = $objCues->Texto;
        $NivelRiesgo    = $objCues->NivelRiesgo;
        $Division       = $objCues->Division;
        $Evidencia      = $objCues->Evidencia;

        if($Checkbox == "true"){
            $CB = 1;
        }else{
            $CB = 0;
        }
        $sucursal = "SELECT * FROM sucursals WHERE IdCte = $IdCte";
        $resSu    = mysqli_query($conn,$sucursal);
        $row      = mysqli_fetch_assoc($resSu);
        $IdCTe    = $row['id'];
        if($IdCTe > 0){

            $InsertCues ="INSERT INTO questionnaires (sucursal_id,IdCuestionario,IdPregunta,Value,Recomendacion,Riesgo,created_at,IdCedula,Division,Evidencia)
                                VALUES($IdCTe,$IdCuestionario,$IdPregunta,$CB,'$Recomendacion','$NivelRiesgo','$FechaRegistro','$IdCedula',$Division,'$Evidencia')";
            mysqli_query($conn,$InsertCues);

             $InsertCues2 = "INSERT INTO questionaries (sucursal_id,Value,comments,riesgo,created_at)
                                VALUES($IdCTe,$CB,'$Recomendacion','$NivelRiesgo','$FechaRegistro')";
            mysqli_query($conn,$InsertCues2);
            $InsertPorce = "SELECT
                            sucursal_id,
                            COUNT(riesgo) AS riesgot,
                            riesgo,
                        IF(riesgo = 'C', (COUNT(riesgo) * 100 / 15), (COUNT(riesgo) * 100 / 3)) as promedio,
                            s.marca_id

                        FROM
                            questionnaires q
                        INNER JOIN sucursals s ON s.id = q.sucursal_id
                        WHERE
                            s.marca_id = 1
                        AND `Value` = 1
                        GROUP BY
                            sucursal_id,
                            riesgo"


        }else{

        }

    }

     //Inicio resumen

$ConCedulasT = "SELECT COUNT(DISTINCT FechaCaptura, IdCte) as total FROM cedulas WHERE Mes = $mesC AND Anio = $anioC
 AND IdUsuario=$IdUsuario AND IdCte=$IdCte";
$ResultCedulasT = mysqli_query($conn,$ConCedulasT);
$filaCedulasT= mysqli_fetch_array($ResultCedulasT);
$NoVisitasRealizadas = $filaCedulasT['total'];
if ($NoVisitasRealizadas > 0) {
    $RevisarResumen = "SELECT IdResumen
    FROM ResumenVisitas
    WHERE IdUsuario = $IdUsuario AND c.Anio = $anioC AND c.Mes = $mesC AND c.IdCte = '$IdCte'";
    $ResultadoResumen = mysqli_query($conn,$RevisarResumen);
     $filaResumen= mysqli_fetch_array($ResultadoResumen);
    if(mysqli_num_rows($ResultadoResumen) > 0){
        $IdResumen = $filaResumen['IdResumen'];

        $updateRes = "UPDATE ResumenVisitas SET VisitasRealizadas = $NoVisitasRealizadas WHERE IdResumen = $IdResumen";
        mysqli_query($conn,$updateRes);
    }else{

        $ConVProgramadas = "SELECT v.NoVisitasProgramadas FROM ValoresExcel  as v
        INNER JOIN usuarios as u
        ON u.NombreExcel = v.Responsable AND u.IdUsuario = $IdUsuario
        WHERE v.NumeroCliente = '$IdCte' AND v.Mes = $mesC AND Anio = $anioC";

        $ResultVProgramadas = mysqli_query($conn,$ConVProgramadas);
        $filaVProgramadas= mysqli_fetch_array($ResultVProgramadas);
        if($filaVProgramadas['NoVisitasProgramadas'] == ''){
            $NoVisitasProgramadas = 0;
        }else {
            $NoVisitasProgramadas = $filaVProgramadas['NoVisitasProgramadas'];
        }
    $insertRes = "INSERT INTO ResumenVisitas (IdUsuario,IdCte,Cliente,VisitasProgramadas,VisitasRealizadas,Mes,Anio)
        VALUES($IdUsuario,'$IdCte','$Cliente',$NoVisitasProgramadas,$NoVisitasRealizadas,$mesC,$anioC)";
    mysqli_query($conn,$insertRes);
    }

}

 //FIN de Resumen

 //Consultar la division del Usuario para saber en que tablas de clientes se deben modificar
    $ConUCorreo    = "SELECT Correo, Nombre, Apellidos, Division FROM usuarios WHERE IdUsuario = $IdUsuario";
    $resul_UCorreo = mysqli_query($conn,$ConUCorreo);
    $res_UCorreo   = mysqli_fetch_assoc($resul_UCorreo);
    $NombreC       = $res_UCorreo['Nombre']." ".$res_UCorreo['Apellidos'];
    $DivisionV     = $res_UCorreo['Division'];

    if($DivisionV == 1 ||$DivisionV == 2){
        $tipoDivision = " Soluciones";
    }else{
        $tipoDivision = " CDC";
    }

    $IdCed =$IdCedula;
    $usuario = $fila['IdUsuario'];
    $email   = $fila['Correo'];




    //--------------------------------ENVIO DE CORREO GENERAL
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "tls";
    $mail->CharSet = "Content-Type: text/html; charset=utf-8";
    $mail->Host = "smtp.gmail.com"; //servidor smtp
    $mail->Port = 587; //puerto smtp de gmail
    $mail->Username = 'notificaciones.vic@bennetts.com.mx';
    $mail->Password = 'g^}LT3_XOZw^';
    $mail->FromName = 'VIC' .$tipoDivision. ': ' . $Cliente;
    $mail->From = 'notificaciones.vic@bennetts.com.mx';
    $mail->AddAddress('daniel.velasco@bennetts.com.mx', 'Gerardo Velasco');
    $mail->AddAddress('rosario.sanjuan@bennetts.com.mx', 'Rosario San Juan');
    if($fila['Correo'] =! ''){
        //$mail->AddAddress($Email,  $Cliente);
    }
    $mail->AddAddress('daniel.morales@bennetts.com.mx', 'Daniel morales');

    /*$mail->AddAddress($res_UCorreo['Correo'], $NombreC);
    if($DivisionV == 1){ //HI
        $mail->AddAddress('isaac.briseno@bennetts.com.mx', 'Isacc Briseño');
        $mail->AddAddress('raul.casimiro@bennetts.com.mx', 'Raul Casimiro');
    }
    if($DivisionV == 2){ //LP
        $mail->AddAddress('david.sanchez@bennetts.com.mx', 'David Sanchez');
        $mail->AddAddress('jluis.arredondo@bennetts.com.mx', 'Jose Luis Arredondo');
        $mail->AddAddress('ventas@bennetts.com.mx', 'Margarita Medrano');
    }
    if($DivisionV == 3){

        $mail->AddAddress('laura.solano@bennetts.com.mx','Laura Solano');
        //if($IdUsuario == 44 OR $IdUsuario == 42 OR $IdUsuario == 43 OR $IdUsuario == 51 OR $IdUsuario = 39){
            $mail->AddAddress('fernando.solorzano@bennetts.com.mx','Fernando Solorzano');
        //} else {
            $mail->AddAddress('abraham.cordova@bennetts.com.mx','Abraham Cordova');
        //}

    }*/
    $mail->Subject = "VIC:    ".$Cliente;
    $mail->AltBody = "VIC:    ".$Cliente;
    $msg = "<table align='center' width='100%'>";
    $msg.= "<tr><td><img src='http://www.grupobennetts.com.mx/VIC/imagenes/logoKeyCorreo.png' align='left'></td>
       <td><img src='http://www.grupobennetts.com.mx/VIC/imagenes/logoBennettsCorreo.png' align='right'></td>
    </tr></table>";
    $msg.= "<table align='center' border='1' width='100%'>";
    $msg.= "<tr><td bgcolor='#3590FA' colspan='2' align='center'><span style='color:#FFF; font-weight:bold; font-size:22px;'>Visita de impacto al cliente</td></tr>";
    $msg.= "<tr><td bgcolor='#3590FA' colspan='2' align='center'><span style='color:#FFF; font-weight:bold; font-size:22px;'>".$IdCte." - ".$Cliente."</td></tr>";
    $msg.="<tr>
            <th bgcolor='#3590FA' align='center'><span style='color:#FFF; font-weight:bold; font-size:14px;'>Nombre comercial:</span></th>
            <td align='center'>".$NomComercial."</td>
          </tr>
          <tr>
            <th bgcolor='#3590FA' align='center'><span style='color:#FFF; font-weight:bold; font-size:14px;'>Contacto:</span></th>
            <td align='center'>".$NomContacto."</td>
          </tr>
          <tr>
            <th bgcolor='#3590FA' align='center'><span style='color:#FFF; font-weight:bold; font-size:14px;'>Tel&#233;fono:</span></th>
            <td align='center'>".$Telefono."</td>
          </tr>
          <tr>
            <th bgcolor='#3590FA' align='center'><span style='color:#FFF; font-weight:bold; font-size:14px;'>Email:</span></th>
            <td align='center'>".$Email."</td>
          </tr>
          <tr>
            <th bgcolor='#3590FA' align='center'><span style='color:#FFF; font-weight:bold; font-size:14px;'>Localizaci&#243;n:</span></th>
            <td align='center'><a href='https://www.google.com.mx/maps?q=".$geolocation."'>Ver mapa</a></td>
          </tr>
          <tr>
            <th bgcolor='#3590FA' align='center'><span style='color:#FFF; font-weight:bold; font-size:14px;'>Usuario:</span></th>
            <td align = 'center'><strong>".$NombreC."</strong></td>
          </tr>
          <tr>
            <th bgcolor='#3590FA' align='center'><span style='color:#FFF; font-weight:bold; font-size:14px;'>Fecha y hora de visita:</span></th>
            <td align='center'><strong>".$FechaCaptura."</strong></td>
          </tr>
          <tr>
            <th bgcolor='#3590FA' align='center'><span style='color:#FFF; font-weight:bold; font-size:14px;'>Fecha de cierre:</span></th>
            <td align='center'><strong>".$FechaCierre."</strong></td>
          </tr>";
          $msg.= "</table><br>";
          $msg.= "<center><a href='http://appbennetts.com/VIC/ProcesosVIC8/ReportePDFCorreo.php?IdCedula=".$IdCedula."&Division=".$DivisionV."'><span style='font-size:18;'>Ver detalle de la visita </span></a></center><br>";
          $msg.= "<center><span style='font-size:14; color:red;'></span></center><br><br>";
          $msg.= "<hr>";
          $msg.= "<font color='#a1a1a1'>NOTA IMPORTANTE: Este correo se genera automaticamente. Por favor no respondas o reenvies correos a esta cuenta de e-mail.";
          $msg.= "<br>Muchas Gracias!<br></font>";
          $msg.= "<hr>";
    $mail->MsgHTML($msg);
    $mail->CharSet = 'UTF-8';
    $mail->send();


//============================================================================================================

//CALIFICACION

     if($eval== 4 || $eval == 5){
        if($eval == 4){ $ValEs = 'Cliente  Satisfecho'; $starsCali = "<img src='http://www.grupobennetts.com.mx/VIC/imagenes/estrella_azul.png'><img src='http://www.grupobennetts.com.mx/VIC/imagenes/estrella_azul.png'><img src='http://www.grupobennetts.com.mx/VIC/imagenes/estrella_azul.png'><img src='http://www.grupobennetts.com.mx/VIC/imagenes/estrella_azul.png'><img src='http://www.grupobennetts.com.mx/VIC/imagenes/estrella_blanca.png'>"; }
        if($eval == 5){ $ValEs = 'Cliente  Muy satisfecho'; $starsCali = "<img src='http://www.grupobennetts.com.mx/VIC/imagenes/estrella_azul.png'><img src='http://www.grupobennetts.com.mx/VIC/imagenes/estrella_azul.png'><img src='http://www.grupobennetts.com.mx/VIC/imagenes/estrella_azul.png'><img src='http://www.grupobennetts.com.mx/VIC/imagenes/estrella_azul.png'><img src='http://www.grupobennetts.com.mx/VIC/imagenes/estrella_azul.png'>";}

        $mailCalifBuena = new PHPMailer();
        $mailCalifBuena->IsSMTP();
        $mailCalifBuena->SMTPAuth = true;
        $mailCalifBuena->SMTPSecure = "tls";
        $mailCalifBuena->CharSet = "Content-Type: text/html; charset=utf-8";
        $mailCalifBuena->Host = "smtp.gmail.com"; //servidor smtp
        $mailCalifBuena->Port = 587; //puerto smtp de gmail
        $mailCalifBuena->Username = 'notificaciones.vic@bennetts.com.mx';
        $mailCalifBuena->Password = 'g^}LT3_XOZw^';
        $mailCalifBuena->FromName = 'Evaluacion VIC'.$tipoDivision.': '.$ValEs;
        $mailCalifBuena->From ='notificaciones.vic@bennetts.com.mx';

        $mailCalifBuena->AddAddress('daniel.velasco@bennetts.com.mx', 'Gerardo Velasco');
        $mailCalifBuena->AddAddress('rosario.sanjuan@bennetts.com.mx', 'Rosario San Juan');
        $mailCalifBuena->AddAddress('daniel.morales@bennetts.com.mx', 'Daniel morales');

        $mailCalifBuena->Subject = "Evaluacion VIC: ".$ValEs;
        $mailCalifBuena->AltBody = "Evaluacion VIC: ".$ValEs;

                $msgCalifBuena= "<table align='center' width='100%'>";
                $msgCalifBuena.= "<tr><td><img src='http://www.grupobennetts.com.mx/VIC/imagenes/logoKeyCorreo.png' align='left'></td>
                         <td><img src='http://www.grupobennetts.com.mx/VIC/imagenes/logoBennettsCorreo.png' align='right'></td>
                        </tr>";
                $msgCalifBuena.="<tr><td bgcolor='#3590FA' colspan='2' align='center'><span style='color:#FFF; font-weight:bold; font-size:22px;'>CALIFICACION</td></tr>";
                $msgCalifBuena.=" <tr>
                                        <th bgcolor='#3590FA' align='center'><span style='color:#FFF; font-weight:bold; font-size:14px;'>Calificaci&#243;n</span></th>
                                        <th bgcolor='#3590FA' align='center'><span style='color:#FFF; font-weight:bold; font-size:14px;'>Comentarios</span></th>
                                      </tr>
                                      <tr>
                                        <th>".$starsCali."</th>
                                        <th><span style='font-weight:bold; font-size:14px;'>".$ValEs."</span></th>
                                      </tr>
                                  </table><br><br><br><br>";

                $msgCalifBuena.= "<table align='center' border='1' width='100%'>";
                $msgCalifBuena.= "<tr><td bgcolor='#3590FA' colspan='2' align='center'><span style='color:#FFF; font-weight:bold; font-size:22px;'>Visita de impacto al cliente</td></tr>";
                $msgCalifBuena.= "<tr><td bgcolor='#3590FA' colspan='2' align='center'><span style='color:#FFF; font-weight:bold; font-size:22px;'>".$IdCte." - ".$Cliente."</td></tr>";

                $msgCalifBuena.="
                        <tr>
                          <th bgcolor='#3590FA' align='center'><span style='color:#FFF; font-weight:bold; font-size:14px;'>Nombre comercial:</span></th>
                          <td align='center'>".$NomComercial."</td>
                        </tr>
                        <tr>
                          <th bgcolor='#3590FA' align='center'><span style='color:#FFF; font-weight:bold; font-size:14px;'>Contacto:</span></th>
                          <td align='center'>".$NomContacto."</td>
                        </tr>
                        <tr>
                          <th bgcolor='#3590FA' align='center'><span style='color:#FFF; font-weight:bold; font-size:14px;'>Tel&#233;fono:</span></th>
                          <td align='center'>".$Telefono."</td>
                        </tr>
                        <tr>
                          <th bgcolor='#3590FA' align='center'><span style='color:#FFF; font-weight:bold; font-size:14px;'>Email:</span></th>
                          <td align='center'>".$Email."</td>
                        </tr>
                        <tr>
                          <th bgcolor='#3590FA' align='center'><span style='color:#FFF; font-weight:bold; font-size:14px;'>Localizaci&#243;n:</span></th>
                          <td align='center'><a href='https://www.google.com.mx/maps?q=".$geolocation."'>Ver mapa</a></td>
                        </tr>
                        <tr>
                        <th bgcolor='#3590FA' align='center'><span style='color:#FFF; font-weight:bold; font-size:14px;'>Usuario:</span></th>
                            <td align='center'>".$NombreC."</td>

                        </tr>
                        <th bgcolor='#3590FA' align='center'><span style='color:#FFF; font-weight:bold; font-size:14px;'>Fecha y hora de visita:</span></th>
                            <td align='center'>".$FechaCaptura."</td>

                        </tr>
                        <tr>
                            <th bgcolor='#3590FA' align='center'><span style='color:#FFF; font-weight:bold; font-size:14px;'>Fecha de cierre:</span></th>
                            <td align='center'>".$FechaCierre."</td>
                          </tr>

                      </table></br></br>";

                $msgCalifBuena.= "<hr>";
                $msgCalifBuena.= "<font color='#a1a1a1'>NOTA IMPORTANTE: Este correo se genera automaticamente. Por favor no respondas o reenvies correos a esta cuenta de e-mail.";
                $msgCalifBuena.= "<br>Muchas Gracias!<br></font>";
                 $msgCalifBuena.= "<hr>";
        $mailCalifBuena->CharSet = 'UTF-8';
        $mailCalifBuena->MsgHTML($msgCalifBuena);
        $mailCalifBuena->send();
    }

    //---------------------------CORREO CON EVALUACION MALA
    if($eval== 1 || $eval == 2 || $eval == 3){
        if($eval == 1){ $ValEs = 'Cliente  Molesto'; $starsCali = "<img src='http://www.grupobennetts.com.mx/VIC/imagenes/estrella_azul.png'><img src='http://www.grupobennetts.com.mx/VIC/imagenes/estrella_blanca.png'><img src='http://www.grupobennetts.com.mx/VIC/imagenes/estrella_blanca.png'><img src='http://www.grupobennetts.com.mx/VIC/imagenes/estrella_blanca.png'><img src='http://www.grupobennetts.com.mx/VIC/imagenes/estrella_blanca.png'>";}
        if($eval == 2){ $ValEs = 'Cliente  Insatisfecho'; $starsCali = "<img src='http://www.grupobennetts.com.mx/VIC/imagenes/estrella_azul.png'><img src='http://www.grupobennetts.com.mx/VIC/imagenes/estrella_azul.png'><img src='http://www.grupobennetts.com.mx/VIC/imagenes/estrella_blanca.png'><img src='http://www.grupobennetts.com.mx/VIC/imagenes/estrella_blanca.png'><img src='http://www.grupobennetts.com.mx/VIC/imagenes/estrella_blanca.png'>"; }
        if($eval == 3){ $ValEs = 'Cliente  Indiferente'; $starsCali = "<img src='http://www.grupobennetts.com.mx/VIC/imagenes/estrella_azul.png'><img src='http://www.grupobennetts.com.mx/VIC/imagenes/estrella_azul.png'><img src='http://www.grupobennetts.com.mx/VIC/imagenes/estrella_azul.png'><img src='http://www.grupobennetts.com.mx/VIC/imagenes/estrella_blanca.png'><img src='http://www.grupobennetts.com.mx/VIC/imagenes/estrella_blanca.png'>";}
        $mailCalifMala = new PHPMailer();
        $mailCalifMala->IsSMTP();
        $mailCalifMala->SMTPAuth = true;
        $mailCalifMala->SMTPSecure = "tls";
        $mailCalifMala->CharSet = "Content-Type: text/html; charset=utf-8";
        $mailCalifMala->Host = "smtp.gmail.com"; //servidor smtp
        $mailCalifMala->Port = 587; //puerto smtp de gmail
        $mailCalifMala->Username = 'notificaciones.vic@bennetts.com.mx';
        $mailCalifMala->Password = 'g^}LT3_XOZw^';
        $mailCalifMala->FromName = 'Evaluacion del Cliente'.$tipoDivision.': '.$ValEs."  ".$Cliente;
        $mailCalifMala->From ='notificaciones.vic@bennetts.com.mx';

        //DEPENDIENDO USUARIO
        /*$mail->AddAddress($res_UCorreo['Correo'], $NombreC);
        $mailCalifMala->AddAddress('luis@bennetts.com.mx', 'Luis Bennetts');
        $mailCalifMala->AddAddress('carbennetts@bennetts.com.mx', 'Carlos Bennetts');
          //LP
        if($DivisionV == 2){ //LP
            $mailCalifMala->AddAddress('jluis.arredondo@bennetts.com.mx', 'Jose Luis Arredondo');
            $mailCalifMala->AddAddress('david.sanchez@bennetts.com.mx', 'David Sanchez');
            $mailCalifMala->AddAddress('ventas@bennetts.com.mx', 'Margarita Medrano');
        }
          //HI
        if($DivisionV == 1){ //hi
            $mailCalifMala->AddAddress('elias.chacon@bennetts.com.mx', 'Elias Chacon');
            $mailCalifMala->AddAddress('raul.casimiro@bennetts.com.mx', 'Raul Casimiro');
            $mailCalifMala->AddAddress('isaac.briseno@bennetts.com.mx', 'Isaac Briseño');
        }
        //TODOS
        if($DivisionV == 3){
            $mailCalifMala->AddAddress('abraham.cordova@bennetts.com.mx', 'Abraham Cordova');
            if($IdUsuario == 44 OR $IdUsuario == 42 OR $IdUsuario == 43 OR $IdUsuario == 51 OR $IdUsuario = 39){
                $mail->AddAddress('fernando.solorzano@bennetts.com.mx','Fernando Solorzano');
            }
            $mailCalifMala->AddAddress('laura.solano@bennetts.com.mx','Laura Solano');
            $mailCalifMala->AddAddress('daniel.fabian@bennetts.com.mx','Daniel Fabian');
            $mailCalifMala->AddAddress('milton.gonzalez@bennetts.com.mx','Milton Gonzalez');
            $mailCalifMala->AddAddress('logisticacdc@bennetts.com.mx','Alejandro Uribe');
            $mailCalifMala->AddAddress('analista.procesos1@bennetts.com.mx','Irene Campos');
            $mailCalifMala->AddAddress('analista.indicadores@bennetts.com.mx','David Peralta');
        }
        $mailCalifMala->AddAddress('monitoreocorporativo@bennetts.com.mx', 'Monitoreo');
        $mailCalifMala->AddAddress('daniel.fabian@bennetts.com.mx', 'Daniel Fabian');*/
        //Programadores
        $mailCalifMala->AddAddress('daniel.velasco@bennetts.com.mx', 'Gerardo Velasco');
        $mailCalifMala->AddAddress('rosario.sanjuan@bennetts.com.mx', 'Rosario San Juan');
        //$mailCalifMala->AddAddress('daniel.morales@bennetts.com.mx', 'Daniel morales');
        $mailCalifMala->Subject = "Evaluacion del Cliente: ".$ValEs."  ".$IdCte."  ".$Cliente;
        $mailCalifMala->AltBody = "Evaluacion del Cliente: ".$ValEs."  ".$IdCte."  ".$Cliente;

        $msgCalifMala= "<table align='center' width='100%'>";
        $msgCalifMala.= "<tr><td><img src='http://www.grupobennetts.com.mx/VIC/imagenes/logoKeyCorreo.png' align='left'></td>
                 <td><img src='http://www.grupobennetts.com.mx/VIC/imagenes/logoBennettsCorreo.png' align='right'></td>
                </tr>";
        $msgCalifMala.="<tr><td bgcolor='#ff0000' colspan='2' align='center'><span style='color:#FFF; font-weight:bold; font-size:22px;'>CALIFICACION</td></tr>";
        $msgCalifMala.=" <tr>
                                <th bgcolor='#3590FA' align='center'><span style='color:#FFF; font-weight:bold; font-size:14px;'>Calificaci&#243;n</span></th>
                                <th bgcolor='#3590FA' align='center'><span style='color:#FFF; font-weight:bold; font-size:14px;'>Comentarios</span></th>
                              </tr>
                              <tr>
                                <th>".$starsCali."</th>
                                <th><span style='font-weight:bold; font-size:14px;'>".$coment."</span></th>
                              </tr>
                          </table><br><br><br><br>";

        $msgCalifMala.= "<table align='center' border='1' width='100%'>";
        $msgCalifMala.= "<tr><td bgcolor='#3590FA' colspan='2' align='center'><span style='color:#FFF; font-weight:bold; font-size:22px;'>Visita de impacto al cliente</td></tr>";
        $msgCalifMala.= "<tr><td bgcolor='#3590FA' colspan='2' align='center'><span style='color:#FFF; font-weight:bold; font-size:22px;'>".$IdCte." - ".$Cliente."</td></tr>";

        $msgCalifMala.="
                <tr>
                  <th bgcolor='#3590FA' align='center'><span style='color:#FFF; font-weight:bold; font-size:14px;'>Nombre comercial:</span></th>
                  <td align='center'>".$NomComercial."</td>
                </tr>
                <tr>
                  <th bgcolor='#3590FA' align='center'><span style='color:#FFF; font-weight:bold; font-size:14px;'>Contacto:</span></th>
                  <td align='center'>".$NomContacto."</td>
                </tr>
                <tr>
                  <th bgcolor='#3590FA' align='center'><span style='color:#FFF; font-weight:bold; font-size:14px;'>Tel&#233;fono:</span></th>
                  <td align='center'>".$Telefono."</td>
                </tr>
                <tr>
                  <th bgcolor='#3590FA' align='center'><span style='color:#FFF; font-weight:bold; font-size:14px;'>Email:</span></th>
                  <td align='center'>".$Email."</td>
                </tr>
                <tr>
                  <th bgcolor='#3590FA' align='center'><span style='color:#FFF; font-weight:bold; font-size:14px;'>Estatus:</span></th>
                  <td align='center'>".$stat."</td>
                </tr>
                <tr>
                  <th bgcolor='#3590FA' align='center'><span style='color:#FFF; font-weight:bold; font-size:14px;'>Localizaci&#243;n:</span></th>
                  <td align='center'><a href='https://www.google.com.mx/maps?q=".$geolocation."'>Ver mapa</a></td>
                </tr>
                <tr>
                    <th bgcolor='#3590FA' align='center'><span style='color:#FFF; font-weight:bold; font-size:14px;'>Usuario:</span></th>
                    <td align='center'>".$NombreC."</td>
                  </tr>
                  <tr>
                    <th bgcolor='#3590FA' align='center'><span style='color:#FFF; font-weight:bold; font-size:14px;'>Fecha y hora de cierre:</span></th>
                    <td align='center'>".$FechaCaptura."</td>
                  </tr>
                <tr>
                    <th bgcolor='#3590FA' align='center'><span style='color:#FFF; font-weight:bold; font-size:14px;'>Fecha de cierre:</span></th>
                    <td align='center'>".$FechaCierre."</td>
                  </tr>
              </table></br></br>";
        $msgCalifMala.= "<hr>";
        $msgCalifMala.= "<font color='#a1a1a1'>NOTA IMPORTANTE: Este correo se genera automaticamente. Por favor no respondas o reenvies correos a esta cuenta de e-mail.";
        $msgCalifMala.= "<br>Muchas Gracias!<br></font>";
        $msgCalifMala.= "<hr>";
        $mailCalifMala->CharSet = 'UTF-8';
        $mailCalifMala->MsgHTML($msgCalifMala);
        $mailCalifMala->send();
    }


    //EQUIPOS
    if($Equi>=1){

            $mailEquipo = new PHPMailer();
            $mailEquipo->IsSMTP();
            $mailEquipo->SMTPAuth = true;
            $mailEquipo->SMTPSecure = "tls";
            $mailEquipo->CharSet = "Content-Type: text/html; charset=utf-8";
            $mailEquipo->Host = "smtp.gmail.com";
            $mailEquipo->Port = 587;
            $mailEquipo->Username = 'notificaciones.vic@bennetts.com.mx';
            $mailEquipo->Password = 'g^}LT3_XOZw^';
            $mailEquipo->FromName = 'Equipos del cliente'.$tipoDivision.': '.$Cliente;
            $mailEquipo->From ='notificaciones.vic@bennetts.com.mx';
            /*if($DivisionV == 3){
                //ver a quien se le va  a enviar este correo
            } else {
                $mailEquipo->AddAddress('asistente.servtec@bennetts.com.mx ','Asistente de Servicio Tecnico');
                $mailEquipo->AddAddress('servicio.tecnico@bennetts.com.mx ','Jefe de Servicio Tecnico');
                $mailEquipo->AddAddress('asistente.servcte@bennetts.com.mx ','Servicio al Cliente');
            }*/
            //Programadores
            //$mailEquipo->AddAddress($res_UCorreo['Correo'], $NombreC);
            $mailEquipo->AddAddress('daniel.velasco@bennetts.com.mx', 'Gerardo Velasco');
            $mailEquipo->AddAddress('rosario.sanjuan@bennetts.com.mx', 'Rosario San Juan');
            $mailEquipo->AddAddress('daniel.morales@bennetts.com.mx', 'Daniel morales');
            $mailEquipo->Subject = "Equipos del cliente: ".$IdCte."  ".$Cliente;
            $mailEquipo->AltBody = "Equipos del cliente: ".$IdCte."  ".$Cliente;
            $msgEquipo = "<table align='center' width='100%'>";
            $msgEquipo.= "<tr>
                            <td><img src='http://www.grupobennetts.com.mx/VIC/imagenes/logoKeyCorreo.png' align='left'>
                            </td>
                            <td><img src='http://www.grupobennetts.com.mx/VIC/imagenes/logoBennettsCorreo.png' align='right'>
                            </td>
                        </tr></table>";
            $msgEquipo.= "<table align='center' border='1' width='100%'>";
            $msgEquipo.= "<tr>
                            <td bgcolor='#3590FA' colspan='6' align='center'><span style='color:#FFF; font-weight:bold; font-size:22px;'>EQUIPOS</span>
                            </td>
                        </tr>";
            $msgEquipo.= "<tr>
                            <td bgcolor='#3590FA' colspan='6' align='center'><span style='color:#FFF; font-weight:bold; font-size:22px;'>".$IdCte." - ".$Cliente."</span>
                            </td>
                        </tr>
                        <tr>
                            <th align='center'><span style='font-weight:bold; font-size:16px;'>C&oacute;digo</span></th>
                            <th align='center'><span style='font-weight:bold; font-size:16px;'>Descripci&oacute;n</span></th>
                            <th align='center'><span style='font-weight:bold; font-size:16px;'>Cantidad</span></th>
                            <th align='center'><span style='font-weight:bold; font-size:16px;'>Ubicación</span></th>
                            <th align='center'><span style='font-weight:bold; font-size:16px;'>Motivo</span></th>
                            <th align='center'><span style='font-weight:bold; font-size:16px;'>Comentario</span></th>
                        </tr>";


         //   do {
        foreach($data as $obj){
            $IdPrd         = $obj ->IdPrd;
            $Cantidad      = $obj ->Cantidad;
            $Ubicacion     = $obj ->Ubicacion;
            $ImgPrd        = $obj ->ImgPrd;
            $Comentario    = $obj ->Comentario;
            $Tickets       = $obj ->Tickets;
            $FechaRegistro = $obj ->FechaRegistro;
            $checkBox      = $obj ->checkBox;
            $tipo          = $obj ->TipoT;
            if($checkBox == "Equipo en mal estado"){
              if($Tickets ==  1){
                  $NT = "Daño del equipo por uso normal";
              }
              if($Tickets ==  2){
                  $NT = "Equipo dañado por descuido";
              }
              if($Tickets ==  3){
                  $NT = "Mantenimiento correctivo";
              }



            if($DivisionV == 3){
                $ConDDivi = "SELECT Descripcion FROM Productos WHERE IdPrd = $IdPrd";
                $resultDDivi = mysqli_query($conn,$ConDDivi);
                $resDDivi = mysqli_fetch_array($resultDDivi);
                $Descripcion = $resDDivi['Descripcion'];
            }else{
                $ConDDivi = "SELECT Descripcion FROM ProductosCDC WHERE IdPrd = $IdPrd";
                $resultDDivi = mysqli_query($conn,$ConDDivi);
                $resDDivi = mysqli_fetch_array($resultDDivi);
                $Descripcion = $resDDivi['Descripcion'];
            }
                $msgEquipo.= "
                      <tr>
                        <td align='center'><span style='font-size:14px;'>".$IdPrd."</span></td>
                        <td align='center'><span style='font-size:14px;'>".$Descripcion."</span></td>
                        <td align='center'><span style='font-size:14px;'>".$Cantidad."</span></td>
                        <td align='center'><span style='font-size:14px;'>".$Ubicacion."</span></td>
                        <td align='center'><span style='font-size:14px;'>".$NT."</span></td>
                        <td align='center'><span style='font-size:14px;'>".$Comentario."</span></td>
                      </tr>";

            }//Mal estado
        }//foreach

          //  } while ($resEquipo = mysql_fetch_array($resultsoloequipo));
                $msgEquipo.="</table><br><br>";

                $msgEquipo.= "<hr>";
                $msgEquipo.= "<font color='#a1a1a1'>NOTA IMPORTANTE: Este correo se genera automaticamente. Por favor no respondas o reenvies correos a esta cuenta de e-mail.";
                $msgEquipo.= "<br>Muchas Gracias!<br></font>";
                $msgEquipo.= "<hr>";
            $mailEquipo->CharSet = 'UTF-8';
            $mailEquipo->MsgHTML($msgEquipo);
            $mailEquipo->send();
    }

    //PEDIDO
    if($ConPed >=1){
        $mailPedido = new PHPMailer();
        $mailPedido->IsSMTP();
        $mailPedido->SMTPAuth = true;
        $mailPedido->SMTPSecure = "tls";
        $mailPedido->CharSet = "Content-Type: text/html; charset=utf-8";
        $mailPedido->Host = "smtp.gmail.com";
        $mailPedido->Port = 587;
        $mailPedido->Username = 'notificaciones.vic@bennetts.com.mx';
        $mailPedido->Password = 'g^}LT3_XOZw^';
        $mailPedido->FromName = 'Pedido del cliente'.$tipoDivision.': '.$Cliente;
        $mailPedido->From ='notificaciones.vic@bennetts.com.mx';
        /*if($DivisionV == 3){
           $mailPedido->AddAddress('serviciokeycentro@bennetts.com.mx','Brayan  Ruiz');
        } else {


            $mailPedido->AddAddress('facturacion@bennetts.com.mx ','Ejecutivo de cuenta 1');
            $mailPedido->AddAddress('pedidos@bennetts.com.mx ','Asistente de cuenta 1');

            $mailPedido->AddAddress('renata.perez@bennetts.com.mx ','Asistente de cuenta 2');
            $mailPedido->AddAddress('rosal.barrios@bennetts.com.mx','Ejecutivo de cuenta 2');

            $mailPedido->AddAddress('viridiana.fernandez@bennetts.com.mx ','Ejecutivo de cuenta 3');
            $mailPedido->AddAddress('leticia.miguel@bennetts.com.mx ','Asistente de cuenta 3');
        }*/
        //Programadores
        //$mailPedido->AddAddress($res_UCorreo['Correo'], $NombreC);
        $mailPedido->AddAddress('daniel.velasco@bennetts.com.mx', 'Gerardo Velasco');
        $mailPedido->AddAddress('rosario.sanjuan@bennetts.com.mx', 'Rosario San Juan');
        $mailPedido->AddAddress('daniel.morales@bennetts.com.mx', 'Daniel morales');
        $mailPedido->Subject = "Pedido del cliente: ".$IdCte."  ".$Cliente;
        $mailPedido->AltBody = "Pedido del cliente: ".$IdCte."  ".$Cliente;
        $msgPedido = "<table align='center' width='100%'>";
        $msgPedido.= "<tr>
                        <td><img src='http://www.grupobennetts.com.mx/VIC/imagenes/logoKeyCorreo.png' align='left'>
                        </td>
                        <td><img src='http://www.grupobennetts.com.mx/VIC/imagenes/logoBennettsCorreo.png' align='right'>
                        </td>
                    </tr></table>";
        $msgPedido.= "<table align='center' border='1' width='100%'>";
        $msgPedido.= "<tr>
                        <td bgcolor='#3590FA' colspan='6' align='center'><span style='color:#FFF; font-weight:bold; font-size:22px;'>PEDIDOS</span>
                        </td>
                    </tr>";
        $msgPedido.= "<tr>
                        <td bgcolor='#3590FA' colspan='6' align='center'><span style='color:#FFF; font-weight:bold; font-size:22px;'>".$IdCte." - ".$Cliente."</span>
                        </td>
                    </tr>
                    <tr>
                        <th align='center'><span style='font-weight:bold; font-size:16px;'>C&oacute;digo</span></th>
                        <th align='center'><span style='font-weight:bold; font-size:16px;'>Descripci&oacute;n</span></th>
                        <th align='center'><span style='font-weight:bold; font-size:16px;'>Inventario al dia del cliente</span></th>
                        <th align='center'><span style='font-weight:bold; font-size:16px;'>Cantidad para pedido</span></th>
                    </tr>";
        //do {
        foreach($datape as $objpe){
            $IdCte         = $objpe->IdCte;
            $IdPrd         = $objpe->IdPrd;
            $Descripcion   = $objpe->Descripcion;
            $Inventario    = $objpe->Inventario;
            if($Inventario    == ''){ $Inventario1    = '0';} else { $Inventario1    = $Inventario; }
            $CanSolicitada    = $objpe->CanSolicitada;
            if($CanSolicitada == ''){ $CanSolicitada1 = '0';} else { $CanSolicitada1 = $CanSolicitada; }
            $Identificador    = $objpe->Identificador;
            if($Identificador = ''){$Identificador    = 0;  } else { $Identificador  = 1; }
            $Comentario       = $objpe->Comentario;
            if($Comentario    == ''){ $Comentario1    = '0';} else { $Comentario1    = $Comentario; }
            $Tipo             = $objpe->TipoT;

          $msgPedido.= "<tr>
                        <td align='center'><span style='font-size:14px;'>".$IdPrd."</span></td>
                        <td align='center'><span style='font-size:14px;'>".$Descripcion."</span></td>
                        <td align='center'><span style='font-size:14px;'>".$Inventario1."</span></td>
                        <td align='center'><span style='font-size:14px;'>".$CanSolicitada1."</span></td>
                      </tr>";
      //  } while ($resPedido = mysql_fetch_array($resultsoloPedido));
        }
        $msgPedido.="</table><br><br>";

        $msgPedido.= "<hr>";
        $msgPedido.= "<font color='#a1a1a1'>NOTA IMPORTANTE: Este correo se genera automaticamente. Por favor no respondas o reenvies correos a esta cuenta de e-mail.";
        $msgPedido.= "<br>Muchas Gracias!<br></font>";
        $msgPedido.= "<hr>";
        $mailPedido->MsgHTML($msgPedido);
        $mailPedido->send();
 } //pedido consulta
//============================================================================================================
//==========================================================================================================
     if($valor ==  1){
       /* $estado = "SELECT NombreCuenta, CorreoCuenta FROM cierre WHERE IdCedula = '$IdCed'";
        $resul_estado = mysql_query($estado);
        $estNC = mysql_fetch_array($resul_estado);*/
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->CharSet = "Content-Type: text/html; charset=utf-8";
        $mail->Host = "smtp.gmail.com"; //servidor smtp
        $mail->Port = 587; //puerto smtp de gmail
        $mail->Username = 'notificaciones.vic@bennetts.com.mx';
        $mail->Password = 'g^}LT3_XOZw^';
        $mail->FromName = 'Solicitud de estado de cuenta'. $tipoDivision;
        $mail->From = 'notificaciones.vic@bennetts.com.mx';
        //Analistas de Cobranza
        /*if($DivisionV == 3){
            $mail->AddAddress('cobranzakeynorte@bennetts.com.mx', 'Erika Garcia');
            $mail->AddAddress('cobranzakeycentro@bennetts.com.mx', 'Jaqueline Meyer');
            $mail->AddAddress('analistacdc02@bennetts.com.mx', 'Julio Pastor');
        } else {
            $mail->AddAddress('analista2@bennetts.com.mx', 'Diana Santos');
            $mail->AddAddress('analista1@bennetts.com.mx', 'Marco Ortiz');
            $mail->AddAddress('asist3.teso@bennetts.com.mx', 'Fabiola Romero');
        }

*/        //Programadores
        $mail->AddAddress('daniel.velasco@bennetts.com.mx', 'Gerardo Velasco');
        $mail->AddAddress('rosario.sanjuan@bennetts.com.mx', 'Rosario San Juan');
        $mail->AddAddress('daniel.morales@bennetts.com.mx', 'Daniel morales');

        $mail->Subject = "Solicitud: Envio de Estado de Cuenta: ".$Cliente;
        $mail->AltBody = "Solicitud: Envio de Estado de Cuenta: ".$Cliente;
        $msg = "<table align='center' width='100%'>";
        $msg.= "<tr>
                        <td><img src='http://www.grupobennetts.com.mx/VIC/imagenes/logoKeyCorreo.png' align='left'>
                        </td>
                        <td><img src='http://www.grupobennetts.com.mx/VIC/imagenes/logoBennettsCorreo.png' align='right'>
                        </td>
                    </tr></table>";
        $msg.= "<table align='center' border='1' width='100%'>";
        $msg.= "<tr>
                        <td bgcolor='#3590FA' colspan='6' align='center'><span style='color:#FFF; font-weight:bold; font-size:22px;'>Solicitud: Envio de estado de cuenta</span>
                        </td>
                    </tr>";
        $msg.= "<tr>
                        <td bgcolor='#3590FA' colspan='6' align='center'><span style='color:#FFF; font-weight:bold; font-size:22px;'>".$IdCte." - ".$Cliente."</span>
                        </td>
                    </tr>
                    <tr>
                        <th align='center' colspan='2'><span style='font-weight:bold; font-size:16px;'>Datos del solicitante: </span></th>
                     </tr>
                    ";
        $msg .="    <tr>
                        <td align='center'><span style='font-weight:bold; font-size:16px;'>Nombre: </span>".$NombreCuenta."</td>
                        <td align='center'><span style='font-weight:bold; font-size:16px;'>Correo: </span>".$CorreoCuenta."</td>
                    </tr>";
        $msg.= "</table><br><br>";
        $msg.= "<hr>";
        $msg.= "<font color='#a1a1a1'>NOTA IMPORTANTE: Este correo se genera automaticamente. Por favor no respondas o reenvies correos a esta cuenta de e-mail.";
        $msg.= "<br>Muchas Gracias!<br></font>";
        $msg.= "<hr>";
        $mail->MsgHTML($msg);//cuerpo con html
        if($mail->Send()){
        }else{
           // echo $mail->ErrorInfo;
        }
    }

}

?>
