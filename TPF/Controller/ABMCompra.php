<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ABMCompra {
    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden 
     * con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Compra
     */
    private function cargarObjeto($param) {
        // ['cofecha' => $cofecha, 'usuario' => $usuario] idcompra es AUTO_INCREMENT
        $obj = null;
        if (array_key_exists('usuario', $param)) {
            $idcompra = array_key_exists('idcompra', $param) ? $param['idcompra'] : null;
            $cofecha = array_key_exists('cofecha', $param) ? $param['cofecha'] : null;
            $obj = new Compra();
            $obj->cargarDatos($idcompra, $cofecha, $param['usuario']);
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden 
     * con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Compra
     */
    private function cargarObjetoConClave($param) {
        $obj = null;
        if ($this->seteadosCamposClaves($param)) {
            $obj = new Compra();
            $obj->cargarDatos($param['idcompra']);
        }
        return $obj;
    }

    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */
    private function seteadosCamposClaves($param) {
        $resp = false;
        if (isset($param['idcompra'])) {
            $resp = true;
        }
        return $resp;
    }

    /**
     * Inserta una compra a la BD con atributos del arreglo ingresado
     * @param array $param
     * @return boolean
     */
    public function alta($param) {
        $resp = false;
        $obj = $this->cargarObjeto($param);
        if ($obj != null && $obj->insertar()) {
            $compraestadotipos = (new ABMCompraEstadoTipo())->buscar(['idcompraestadotipo'=> 1]); //Busca estadotipo
            $resp = !empty($compraestadotipos);
            if ($resp) { 
                // Compra se crea por default con compraestado en compraestadotipo == 1
                $resp = (new ABMCompraEstado())->alta(['objCompra' => $obj, 'objCompraEstadoTipo'=>$compraestadotipos[0], 'cefechaini'=> $obj->getCofecha()]);
            }
        }
        return $resp;
    }

    /**
     * Elimina una compra de la BD
     * @param array $param
     * @return boolean
     */
    public function baja($param) {
        $resp = false;
        // buscamos la compra y cargamos los datos
        if ($this->seteadosCamposClaves($param)) {
            $obj = $this->cargarObjetoConClave($param);
            if ($obj != null AND $obj->eliminar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * Modifica una compra de la BD
     * @param array $param
     * @return boolean
     */
    public function modificacion($param) {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $obj = $this->cargarObjeto($param);
            if ($obj != null && $obj->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }


    /**
     * Realiza cambio del estado de una compra y lo notifica por correo al usuario
     * @param array $param ['idcompraestado'=>$idce, 'idnuevoestadotipo'=>$idcet]
     */
    public function cambiarEstado($param) {
        $compraEstados = (new ABMCompraEstado())->buscar(['idcompraestado'=> $param['idcompraestado']]);
        $exito = !empty($compraEstados);
        if ($exito) {
            $compraEstado = $compraEstados[0];

            $exito = $compraEstado->getObjCompraEstadoTipo()->getIdcompraestadotipo() != $param['idnuevoestadotipo'];            
            if ($exito) { //Si el estado tipo es diferente

                $estadoTipos = (new ABMCompraEstadoTipo())->buscar(['idcompraestadotipo'=>$param['idnuevoestadotipo']]);
                $exito = !empty($estadoTipos);
                if ($exito) {
                    $nuevoObjEstadoTipo = $estadoTipos[0];
                    $timestampActual = (new DateTime('now', (new DateTimeZone('-03:00'))))->format('Y-m-d H:i:s');

                    // Nuevo CompraEstado para la compra, con cefechaini = cefechafin (del estado anterior)
                    $exito = (new ABMCompraEstado())->alta(['objCompra' => $compraEstado->getObjCompra(), 'objCompraEstadoTipo'=> $nuevoObjEstadoTipo, 'cefechaini'=> $timestampActual]);

                    if ($exito) { // Si pudo crear nuevo compraestado
                        $compraEstado->setCefechafin($timestampActual); // Establezco fechafin de estado actual
                        $compraEstado->modificar(); //Modifico en la bd (DEJA DE SER CARRITO)

                        $usuario = $compraEstado->getObjCompra()->getObjUsuario();
                        $compra = $compraEstado->getObjCompra();

                        // Crear una instancia de PHPMailer
                        $mailer = new PHPMailer(true);
                        try {
                            //MODIFICAR PARA TESTEOS
                            $emailOrigen = ''; // Correo Origen
                            $passOrigen = ''; // Contraseña de aplicación (Generada en Google)

                            // Configuración del servidor SMTP
                            $mailer->isSMTP();
                            $mailer->Host = 'smtp.gmail.com'; // Servidor SMTP (Gmail)
                            $mailer->SMTPAuth = true;
                            $mailer->Username = $emailOrigen; // Correo Origen
                            $mailer->Password = $passOrigen; // Contraseña
                            $mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                            $mailer->Port = 587; // Puerto SMTP (Gmail)
                            
                            // Configuración del correo
                            $mailer->setFrom($emailOrigen, 'PWDG42024'); // Remitente
                            $mailer->addAddress($usuario->getUsmail()); // Destinatario
                            $mailer->Subject = 'Cambio de estado de tu compra ID#'.$compra->getIdcompra().'.'; // Asunto

                            // Genera mensaje (y factura) que corresponda
                            switch ($nuevoObjEstadoTipo->getIdcompraestadotipo()) {
                                case 1:
                                    $mensajeCompra = '¡De alguna manera alguien convirtió tu compra de vuelta en carrito!';
                                    break;
                                case 2:
                                    $mensajeCompra = '¡Tu pago ha sido aceptado! Se te comunicara por este medio cuando se despache el pedido.';
                                    //$pdfOutput = $this->generarFacturaCompra(['compra'=> $compra, 'usuario'=> $usuario]);
                                    //$mailer->addStringAttachment($pdfOutput, 'factura.pdf');
                                    break;
                                case 3:
                                    $mensajeCompra = '¡Tu pedido ha sido despachado! Esperamos disfrutes tu compra.';
                                    break;
                                case 4:
                                    $mensajeCompra = 'Tu pedido ha sido cancelado. Si fuiste tu, posiblemente el vendedor lo canceló por falta de stock.';
                                    break;
                                default:
                                    $mensajeCompra = 'No tenemos idea como esto sucedió (Se esta cambiando tu compra a un estadotipo que no existe)';
                                    break;
                            }

                            $mailer->isHTML(true); // Habilitar formato HTML (opcional)
                            $mailer->Body = 
                                "<h1>
                                    Cambio de estado de tu compra ID#".$compra->getIdcompra().".
                                </h1>
                                <p>
                                    ".$mensajeCompra."
                                </p>";

                            // Enviar el correo
                            $mailer->send();

                            $msj = '¡Gracias por la compra! Recibiras un correo a la brevedad.';
                        } catch (Exception $e) {
                            $exito = false;
                            $msj = "Error al enviar el correo: {$mailer->ErrorInfo}";
                        }
                    } else {
                        $msj = 'Error al crear nuevo estado.';
                    }
                } else {
                    $msj = 'El nuevo estado tipo no existe.';
                }
            } else {
                $msj = 'La compra ya se encuentra en el estado especificado.';
            }
        } else {
            $msj = 'Idcompraestado no encontrado.';
        }
        return ['success'=> $exito, 'message'=> $msj];
    }

    /**
     * Metodo que realiza la compra del carrito (si compra tiene estado 1) y tiene compraItems
     */
    public function comprarCarrito($param) {
        $compraEstados = (new ABMCompraEstado())->buscar($param);
        $exito = !empty($compraEstados);
        if ($exito) {
            $compraEstado = $compraEstados[0];
            $compraItems = (new ABMCompraItem())->buscar(['compra'=> $compraEstado->getObjCompra()]);
            $exito = !empty($compraItems);
            if ($exito) {
                $rta = $this->cambiarEstado(['idcompraestado'=>$param['idcompraestado'], 'idnuevoestadotipo' => 2]); //Pasa a aceptado
                $msj = $rta['message'];
                $exito = $rta['success'];
            } else {
                $msj = "El carrito esta vacio.";
            }
        } else {
            $msj = 'No existe idcompraestado especificado.';
        }
        return ['success'=>$exito, 'message'=>$msj];
    }

    /**
     * Genera una factura de compra para una compra dada
     * @param array $param ['compra'=>$compra,'usuario'=>$usuario]
     */
    private function generarFacturaCompra($param) {
        $compra = $param['compra'];
        $usuario = $param['usuario'];
        $compraItems = (new ABMCompraItem())->buscar(['compra' => $compra]);

        $tituloPDF = "Factura_Compra_N°".$usuario->getIdusuario().$compra->getIdcompra();

        // Crear una instancia de TCPDF
        $pdf = new TCPDF();

        // Configurar el PDF
        $pdf->SetCreator('PWDG42024/TPF');
        $pdf->SetAuthor('FF-MN-JV');
        $pdf->SetTitle($tituloPDF);
        $pdf->SetSubject('Factura');

        // Configurar márgenes y página
        $pdf->SetMargins(15, 20, 15);
        $pdf->AddPage();

        // Asegurarse de que la imagen exista
        $imagePath = BASE_URL.'/View/Media/Site/logo.png';
        if (file_exists($imagePath)) {
            $pdf->Image($imagePath, 15, 10, 40, 20);
        } else {
            $pdf->Cell(0, 10, 'Logo no disponible', 0, 1, 'C');
        }

        // Estilos de fuente
        $pdf->SetFont('helvetica', '', 12);

        // **Encabezado de la factura**
        $pdf->SetFont('helvetica', 'B', 14);
        $pdf->Cell(0, 10, 'Factura', 0, 1, 'C');
        $pdf->Ln(5);

        // Información de la empresa
        $pdf->SetFont('helvetica', '', 10);
        $pdf->Cell(0, 6, 'Black Mesa', 0, 1);
        $pdf->Cell(0, 6, 'Dirección: Calle Falsa 123', 0, 1);
        $pdf->Cell(0, 6, 'Teléfono: (985) 420-6969', 0, 1);
        $pdf->Cell(0, 6, 'Email: blackmesa@mail', 0, 1);
        $pdf->Ln(10);

        // **Información del cliente**
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->Cell(0, 6, 'Información del Cliente:', 0, 1);
        $pdf->SetFont('helvetica', '', 10);
        $pdf->Cell(0, 6, 'Nombre: '.$usuario->getUsnombre(), 0, 1);
        $pdf->Cell(0, 6, 'Email: '.$usuario->getUsmail(), 0, 1);
        $pdf->Ln(10);

        // **Detalles de la factura**
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->Cell(0, 6, 'Detalles de la Factura:', 0, 1);
        $pdf->SetFont('helvetica', '', 10);
        $pdf->Cell(30, 6, 'Fecha:', 0, 0);
        $pdf->Cell(50, 6, date('Y-m-d'), 0, 1);
        $pdf->Ln(10);

        // **Tabla de productos/servicios**
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->Cell(80, 6, 'Descripción', 1, 0, 'C');
        $pdf->Cell(30, 6, 'Cantidad', 1, 0, 'C');
        $pdf->Cell(30, 6, 'Precio Unitario', 1, 0, 'C');
        $pdf->Cell(30, 6, 'Total', 1, 1, 'C');

        $pdf->SetFont('helvetica', '', 10);

        $totalGeneral = 0;
        foreach ($compraItems as $item) {
            $producto = $item->getObjProducto();
            $total = $item->getCicantidad() * $producto->getProprecio();
            $totalGeneral += $total;

            $pdf->Cell(80, 6, $producto->getPronombre(), 1);
            $pdf->Cell(30, 6, $item->getCicantidad(), 1, 0, 'C');
            $pdf->Cell(30, 6, number_format($producto->getProprecio(), 2), 1, 0, 'C');
            $pdf->Cell(30, 6, number_format($total, 2), 1, 1, 'C');
        }

        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->Cell(140, 6, 'Total General:', 1, 0, 'R');
        $pdf->Cell(30, 6, number_format($totalGeneral, 2), 1, 1, 'C');

        $pdf->Ln(10);

        // **Pie de página**
        $pdf->SetFont('helvetica', '', 10);
        $pdf->MultiCell(0, 6, "Gracias por su compra. Si tiene alguna pregunta sobre esta factura, póngase en contacto con nosotros.\n¡Que tenga un buen día!", 0, 'C');

        // Guardar el PDF en el servidor
        $pdfOutput = $pdf->Output('factura_temporal.pdf', 'S'); //El nombre no impacta ya que se usa S para almacenarlo como String
        return $pdfOutput;
    }

    /**
     * Busca compras en la BD
     * Si $param es vacío, trae todos las compras
     * @param array $param
     * @return array
     */
    public function buscar($param = null) {
        $where = " true ";
        if ($param != null) {
            if (isset($param['idcompra'])) {
                $where .= " AND idcompra = ".$param['idcompra'];
            }
            if (isset($param['cofecha'])) {
                $where .= " AND cofecha = '".$param['cofecha']."'";
            }
            if (isset($param['usuario'])) {
                $where .= " AND idusuario = ".($param['usuario'])->getIdusuario();
            }
        }
        $arreglo = (new Compra())->listar($where);
        return $arreglo;
    }
}