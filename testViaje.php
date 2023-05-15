<?php
// PROGRAMA PRINCIPAL

// Declaración de variables

// boolean $esValidoElDni, $esDuplicado, $necesitaSillaRuedas, $necesitaComidasEspeciales, $necesitaAsistenciaEmbarque
// array $arrayPasajeros
// string $destinoViaje, $nombrePasajero, $apellidoPasajero, $listaPasajeros, $nombreResponsableV, $apellidoResponsableV, 
// $sillaRuedas, $comidasEspeciales, $asistenciaEmbarque, $tipoPasajero
// float $totalAPagar, $costoPasaje, $cantMillas

// int $opcion, $codViaje, $maxPasajerosViaje , $documentoPasajero, $pasajerosCargados, $pasajerosACargar, $telefonoPasajero,
// $nroEmpleadoResponsableV, $nroLicenciaResponsableV, $j, $opcionSubmenu, $nuevaCantMaxPasajeros, $cantPasajeros
// $dniIngresado, $indicePasajero, $nroLicenciaResponsableVNuevo, $nroEmpleadoResponsableVNuevo, $numeroTicket, 
// $numeroAsiento, $numeroViajero

// Pasajero $pasajero (Puede ser: PasajeroEstandar, PasajeroVip o PasajeroEspecial)
// ResponsableV $objPersonaResponsable 
// PasajeroEstandar $pasajeroEstandar
// PasajeroVip $pasajeroVip
// PasajeroEspecial $pasajeroEspecial

include_once ("Viaje.php");
include_once ("ResponsableV.php");
include_once ("Pasajero.php");
include_once ("PasajeroEstandar.php");
include_once ("PasajeroEspecial.php");
include_once ("PasajeroVip.php");

// Inicializacion de variables 

$pasajerosACargar = 0; 
$pasajerosCargados = 0;

do {
    echo "\n --- Menú --- \n";
    echo "<1> Ingresar informacion acerca del viaje y crear el responsable del viaje \n";
    echo "<2> Ingresar los pasajeros \n";
    echo "<3> Modificar datos del viaje \n";
    echo "<4> Modificar datos de un pasajero \n";
    echo "<5> Modificar datos del responsable del viaje \n";
    echo "<6> Ver informacion del viaje, los pasajeros y la persona responsable \n"; 
    echo "<7> Salir \n"; 
    echo "<-> Ingrese opcion: ";
    $opcion = trim(fgets(STDIN));
    switch ($opcion)
    {
        case 1:
            echo "- - - - Datos del viaje - - - - \n";
            echo "Ingrese el destino del viaje: ";
            $destinoViaje = trim(fgets(STDIN));
            echo "Ingrese el código del viaje: ";
            $codViaje = trim(fgets(STDIN));
            echo "Ingrese la cantidad de pasajeros maxima: ";
            $maxPasajerosViaje = trim(fgets(STDIN)); 
            echo "Ingrese el costo del pasaje del viaje: ";
            $costoPasaje = trim(fgets(STDIN));
            echo "- - - - Datos del responsable del viaje - - - - \n";
            echo "Ingrese el nombre del responsable del viaje: "; 
            $nombreResponsableV = trim(fgets(STDIN));
            echo "Ingrese el apellido del responsable del viaje: ";
            $apellidoResponsableV = trim(fgets(STDIN));
            echo "Ingrese el número de empleado del responsable del viaje: ";
            $nroEmpleadoResponsableV = trim(fgets(STDIN));
            echo "Ingrese el número de licencia del responsable del viaje: ";
            $nroLicenciaResponsableV = trim(fgets(STDIN)); 
            $objPersonaResponsable = new ResponsableV ($nroEmpleadoResponsableV, $nroLicenciaResponsableV, $nombreResponsableV, $apellidoResponsableV);
            $viaje = new Viaje ($codViaje, $destinoViaje, $maxPasajerosViaje, $objPersonaResponsable, $costoPasaje);
            echo "- - - - Viaje y responsable del viaje creado - - - - \n";
        break;
        case 2:
            // Uso getCantPasajeros para que luego de cambiar la cantidad máxima de pasajeros se puedan agregar los que faltan
            echo "- - - - Ingresar pasajeros - - - - \n";
            $maxPasajerosViaje = $viaje -> getCantMaxPasajeros ();
            if ($maxPasajerosViaje == $pasajerosCargados)
            {
                echo "Ya se alcanzó la capacidad máxima de este viaje. \n";
            }
            else
            {
                $asientosDisponibles = ($maxPasajerosViaje - $pasajerosCargados); 
                echo "Ingrese la cantidad de pasajeros que desea cargar: ";
                $pasajerosACargar = trim(fgets(STDIN)); 
                if ($pasajerosACargar > $maxPasajerosViaje)
                {
                    echo "Error, no se puede cargar más pasajeros que la cantidad máxima de pasajeros del viaje. \n"; 
                }
                elseif ($pasajerosACargar > $asientosDisponibles)
                {
                    echo "Error, no se puede cargar más pasajeros que los asientos disponibles. \n";
                }
                elseif ($asientosDisponibles >= $pasajerosACargar) 
                {
                    echo "Ingrese ".$pasajerosACargar." pasajeros: \n"; 
                    for ($j = 1; $j <= $pasajerosACargar; $j++)
                    {
                        echo "- - - - Pasajero N° ".($pasajerosCargados+1)." - - - -\n\n";
                        echo "Tipos de pasajero \n";
                        echo "<1> Pasajero estandar \n";
                        echo "<2> Pasajero VIP \n";
                        echo "<3> Pasajero especial \n";
                        echo "<-> Elija el tipo de pasajero: ";
                        $opcionSubmenu = trim(fgets(STDIN));
                        // Datos comúnes de los 3 tipos de pasajeros 
                        echo "Ingrese el nombre del pasajero: ";
                        $nombrePasajero = trim(fgets(STDIN));
                        echo "Ingese el apellido del pasajero: ";
                        $apellidoPasajero = trim(fgets(STDIN));
                        echo "Ingrese el DNI del pasajero: ";
                        $documentoPasajero = trim(fgets(STDIN));
                        echo "Ingrese el teléfono del pasajero: ";
                        $telefonoPasajero = trim(fgets(STDIN)); 
                        echo "Ingrese el número de ticket del pasajero: ";
                        $numeroTicket = trim(fgets(STDIN));
                        echo "Ingrese el número de asiento del pasajero: ";
                        $numeroAsiento = trim(fgets(STDIN));
                        switch ($opcionSubmenu)
                        {
                            case 1: 
                                // Pasajero estandar
                                $pasajeroEstandar = new PasajeroEstandar ($nombrePasajero, $apellidoPasajero, $documentoPasajero, $telefonoPasajero, 
                                $numeroTicket, $numeroAsiento);
                                // Agrego el pasajero a la colección 
                                $totalAPagar = $viaje -> venderPasaje ($pasajeroEstandar); 
                            break;
                            case 2:
                                // Pasajero VIP
                                echo "Ingrese el número de viajero recurrente: ";
                                $numeroViajero = trim(fgets(STDIN));
                                $pasajeroVip = new PasajeroVip ($nombrePasajero, $apellidoPasajero, $documentoPasajero, $telefonoPasajero, 
                                $numeroTicket, $numeroAsiento, $numeroViajero, 0);
                                // Agrego el pasajero a la colección 
                                $totalAPagar = $viaje -> venderPasaje ($pasajeroVip); 
                            break;
                            case 3:
                                // Pasajero especial
                                $necesitaSillaRuedas = false;
                                $necesitaComidasEspeciales = false;
                                $necesitaAsistenciaEmbarque = false;
                                echo "Necesita silla de ruedas (s/n): ";
                                $sillaRuedas = trim(fgets(STDIN));
                                if ($sillaRuedas == "s")
                                {
                                    $necesitaSillaRuedas = true;
                                }
                                echo "Necesita comidas especiales (s/n): ";
                                $comidasEspeciales = trim(fgets(STDIN));
                                if ($comidasEspeciales == "s")
                                {
                                    $necesitaComidasEspeciales = true;
                                }
                                echo "Necesita asistencia al embarcar o desembarcar (s/n): ";
                                $asistenciaEmbarque = trim(fgets(STDIN));
                                if ($asistenciaEmbarque == "s")
                                {
                                    $necesitaAsistenciaEmbarque = true;
                                }
                                $pasajeroEspecial = new PasajeroEspecial ($nombrePasajero, $apellidoPasajero, $documentoPasajero, $telefonoPasajero, 
                                $numeroTicket, $numeroAsiento,$necesitaSillaRuedas, $necesitaComidasEspeciales, $necesitaAsistenciaEmbarque);
                                // Agrego el pasajero a la colección 
                                $totalAPagar = $viaje -> venderPasaje ($pasajeroEspecial); 
                            break;
                        }
                        if ($totalAPagar == 0)
                        {
                            echo "Ingrese de nuevo el pasajero, pasajero duplicado \n";
                            $j --;
                            $pasajerosCargados --;
                        }
                        else
                        {
                            echo "\nEl pasajero N° ".($pasajerosCargados+1)." debe abonar: $ ".$totalAPagar." \n\n";
                        }
                        $pasajerosCargados ++;
                    }
                    echo "- - - - Se han cargado ".$pasajerosACargar." pasajeros - - - -\n"; 
                }
            }
        break;
        case 3:
            do {
                echo "\n------ Modificar datos del viaje ------\n";
                echo "  <1> Cambiar el destino \n";
                echo "  <2> Cambiar el código del viaje \n";
                echo "  <3> Cambiar la cantidad máxima de pasajeros \n";
                echo "  <4> Cambiar el costo del pasaje \n";
                echo "  <5> Cambiar todo \n";
                echo "  <6> Salir del submenu \n"; 
                echo "  <-> Ingrese opcion: ";
                $opcionSubmenu = trim(fgets(STDIN));
                $arrayPasajeros = $viaje -> getArrayPasajeros();
                switch ($opcionSubmenu)
                {
                    case 1:
                        echo "  Ingrese el nuevo destino: ";
                        $destinoViaje = trim(fgets(STDIN));
                        $viaje -> setDestinoViaje ($destinoViaje);
                        echo "- - - Destino del viaje cambiado - - -\n";
                    break;
                    case 2:
                        echo "  Ingrese el nuevo código del viaje: ";
                        $codigoViaje = trim(fgets(STDIN));
                        $viaje -> setCodigoViaje ($codigoViaje);
                        echo "- - - Código del viaje cambiado - - -\n";
                    break;
                    case 3:
                        echo "  Ingrese la nueva cantidad máxima de pasajeros: ";
                        $nuevaCantMaxPasajeros = trim(fgets(STDIN));
                        $cantPasajeros = count($arrayPasajeros);
                        if ($nuevaCantMaxPasajeros <= $cantPasajeros)
                        {
                            echo "- - - Error, ya hay ".$cantPasajeros." pasajeros cargados no es posible cambiar el numero máximo de pasajeros a uno menor o uno igual de los ya cargados - - -\n";
                        }
                        else
                        {
                            $viaje -> setCantMaxPasajeros ($nuevaCantMaxPasajeros);
                            echo "- - - Cantidad máxima de pasajeros cambiada - - -\n";
                        }
                    break;
                    case 4:
                        echo "  Ingrese el nuevo costo del pasaje: ";
                        $costoPasaje = trim(fgets(STDIN));
                        $viaje -> setCostoPasaje ($costoPasaje);
                        echo "- - - Costo del pasaje cambiado - - - \n";
                    break;
                    case 5:
                        echo "  Ingrese la nueva cantidad máxima de pasajeros: ";
                        $nuevaCantMaxPasajeros = trim(fgets(STDIN));
                        $cantPasajeros = count($arrayPasajeros);
                        if ($nuevaCantMaxPasajeros <= $cantPasajeros)
                        {
                            echo "- - - Error, ya hay ".$cantPasajeros." pasajeros cargados no es posible cambiar el numero máximo de pasajeros a uno menor o uno igual de los ya cargados - - -\n";
                        }
                        else
                        {
                            echo "  Ingrese el nuevo destino: ";
                            $destinoViaje = trim(fgets(STDIN));
                            echo "  Ingrese el nuevo código del viaje: ";
                            $codigoViaje = trim(fgets(STDIN));
                            echo "  Ingrese el nuevo costo del pasaje: ";
                            $costoPasaje = trim(fgets(STDIN));
                            $viaje -> setCantMaxPasajeros ($nuevaCantMaxPasajeros);
                            $viaje -> setCostoPasaje ($costoPasaje);
                            $viaje -> setDestinoViaje ($destinoViaje);
                            $viaje -> setCodigoViaje ($codigoViaje);
                            echo "- - - Cantidad máxima de pasajeros, destino, costo del pasaje y código del viaje cambiados - - -\n";
                        }
                    break;
                }
            } while ($opcionSubmenu <> 6);
        break;
        case 4:
            echo "- - - - Lista de pasajeros - - - -\n";
            $listaPasajeros = $viaje -> mostrarPasajeros ();
            echo $listaPasajeros."\n";
            echo "Ingrese el DNI del pasajero que desea cambiar: ";
            $dniIngresado = trim(fgets(STDIN));
            $esValidoElDni = $viaje -> verificarDuplicados ($dniIngresado);
            if ($esValidoElDni)
            {
                $arrayPasajeros = $viaje -> getArrayPasajeros ();
                $indicePasajero = $viaje -> buscarIndicePasajero ($dniIngresado);
                $pasajero = $arrayPasajeros [$indicePasajero];
                $tipoPasajero = get_class ($pasajero);
                do {
                    echo "\n------ Modificar datos de un pasajero ------\n";
                    echo "  <1> Cambiar el nombre \n";
                    echo "  <2> Cambiar el apellido \n";
                    echo "  <3> Cambiar el DNI \n";
                    echo "  <4> Cambiar el teléfono \n";
                    echo "  <5> Cambiar el número de ticket \n";
                    echo "  <6> Cambiar el número de asiento \n";
                    echo "  <7> Cambiar datos especificos del tipo de pasajero \n";
                    echo "  <8> Cambiar todo \n";
                    echo "  <9> Salir del submenu  \n";
                    echo "  <-> Ingrese opcion: ";
                    $opcionSubmenu = trim(fgets(STDIN));
                    switch ($opcionSubmenu)
                    {
                        case 1:
                            // Cambiar el nombre 
                            echo "  Escriba el nuevo nombre del pasajero: ";
                            $nombrePasajero = trim(fgets(STDIN));
                            $pasajero -> setNombre ($nombrePasajero);
                            echo "- - - - Nombre cambiado - - - -\n";
                        break;
                        case 2: 
                            // Cambiar el apellido
                            echo "  Escriba el nuevo apellido del pasajero: ";
                            $apellidoPasajero = trim(fgets(STDIN));
                            $pasajero -> setApellido ($apellidoPasajero);
                            echo "- - - - Apellido cambiado - - - -\n";
                        break;
                        case 3:
                            // Cambiar el dni
                            echo "  Escriba el nuevo DNI del pasajero: ";
                            $documentoPasajero = trim(fgets(STDIN));
                            $esDuplicado = $viaje -> verificarDuplicados ($documentoPasajero);
                            if (!$esDuplicado)
                            {
                                $pasajero -> setDni ($documentoPasajero);
                                echo "- - - - DNI cambiado - - - -\n";
                            }
                            else
                            {
                                echo "- - - - Ese DNI ya esta cargado, ingrese otro - - - - \n";
                            }
                        break;
                        case 4:
                            // Cambiar el teléfono
                            echo "  Ingrese el nuevo teléfono del pasajero: ";
                            $telefonoPasajero = trim(fgets(STDIN));
                            $pasajero -> setTelefono ($telefonoPasajero);
                            echo "- - - - Teléfono cambiado - - - -\n";
                        break;
                        case 5:
                            // Cambiar el número de ticket
                            echo "  Ingrese el nuevo número de ticket del pasajero: ";
                            $numeroTicket = trim(fgets(STDIN));
                            $pasajero -> setNumeroTicket ($numeroTicket);
                            echo "- - - - Número de ticket cambiado - - - -\n";
                        break;
                        case 6:
                            // Cambiar el número de asiento
                            echo "  Ingrese el nuevo número de asiento del pasajero: ";
                            $numeroAsiento = trim(fgets(STDIN));
                            $pasajero -> setNumeroAsiento ($numeroAsiento);
                            echo "- - - - Número de asiento cambiado - - - -\n";
                        break;
                        case 7:
                            // Cambiar datos especificos del tipo de pasajero
                            if ($tipoPasajero == "PasajeroEstandar")
                            {
                                echo "- - - - No hay datos especificos para el pasajero estandar - - - -\n";
                            }
                            elseif ($tipoPasajero == "PasajeroVip")
                            {
                                do {
                                    echo "\n------ Modificar datos especificos de un pasajero vip ------\n";
                                    echo "  <1> Cambiar el número de viajero recurrente \n";
                                    echo "  <2> Cambiar la cantidad de millas \n";
                                    echo "  <3> Cambiar todo \n";
                                    echo "  <4> Salir del submenu  \n";
                                    echo "  <-> Ingrese opcion: ";
                                    $opcionSubmenu = trim(fgets(STDIN));
                                    switch ($opcionSubmenu)
                                    {
                                        case 1:
                                            // Cambiar número de viajero recurrente
                                            echo "  Escriba el número de viajero recurrente nuevo: ";
                                            $numeroViajero = trim(fgets(STDIN));
                                            $pasajero -> setNumeroViajero ($numeroViajero);
                                            echo "- - - - Numero de viajero recurrente cambiado - - - -\n";
                                        break;
                                        case 2:
                                            // Cambiar cantidad de millas 
                                            echo "  Escriba la cantidad de millas nueva: ";
                                            $cantMillas = trim(fgets(STDIN));
                                            $pasajero -> setCantMillas ($numeroViajero);
                                            echo "- - - - Cantidad de millas cambiada - - - -\n";
                                        break;  
                                        case 3:
                                            // Cambiar todo
                                            // Número de viajero recurrente
                                            echo "  Escriba el número de viajero recurrente nuevo: ";
                                            $numeroViajero = trim(fgets(STDIN));
                                            $pasajero -> setNumeroViajero ($numeroViajero);
                                            // Cantidad de millas 
                                            echo "  Escriba la cantidad de millas nueva: ";
                                            $cantMillas = trim(fgets(STDIN));
                                            $pasajero -> setCantMillas ($cantMillas);
                                            echo "- - - - Cantidad de millas y número de viajero recurrente cambiados - - - -\n";
                                        break;
                                    }
                                } while ($opcionSubmenu <> 4);
                            }
                            elseif ($tipoPasajero == "PasajeroEspecial")
                            {
                                do {
                                    echo "\n------ Modificar datos especificos de un pasajero especial ------\n";
                                    echo "  <1> Cambiar si el pasajero necesita silla de ruedas \n"; 
                                    echo "  <2> Cambiar si el pasajero necesita Asistencia para el embarque o desembarque \n";
                                    echo "  <3> Cambiar si el pasajero necesita comidas especiales\n";
                                    echo "  <4> Cambiar todo \n";
                                    echo "  <5> Salir del submenu \n";
                                    echo "  <-> Ingrese opcion: ";
                                    $opcionSubmenu = trim(fgets(STDIN));
                                    switch ($opcionSubmenu)
                                    {
                                        case 1:
                                            // Cambiar si el pasajero necesita silla de ruedas
                                            echo "  Necesita silla de ruedas (s/n): ";
                                            $sillaRuedas = trim(fgets(STDIN));
                                            $necesitaSillaRuedas = false;
                                            if ($sillaRuedas == "s")
                                            {
                                                $necesitaSillaRuedas = true;
                                            }
                                            $pasajero -> setNecesitaSillaRuedas ($necesitaSillaRuedas);
                                            echo "- - - - Preferencia de silla de ruedas cambiada - - - -\n";
                                        break;
                                        case 2:
                                            // Cambiar si el pasajero necesita Asistencia para el embarque o desembarqu
                                            echo "  Necesita comidas especiales (s/n): ";
                                            $comidasEspeciales = trim(fgets(STDIN));
                                            $necesitaComidasEspeciales = false;
                                            if ($comidasEspeciales == "s")
                                            {
                                                $necesitaComidasEspeciales = true;
                                            }
                                            $pasajero -> setNecesitaComidasEspeciales ($necesitaComidasEspeciales);
                                            echo "- - - - Preferencia de comidas especiales cambiada - - - -\n";
                                        break;  
                                        case 3:
                                            // Cambiar si el pasajero necesita comidas especiales
                                            echo "  Necesita asistencia al embarcar o desembarcar (s/n): ";
                                            $asistenciaEmbarque = trim(fgets(STDIN));
                                            $necesitaAsistenciaEmbarque = false;
                                            if ($asistenciaEmbarque == "s")
                                            {
                                                $necesitaAsistenciaEmbarque = true;
                                            }
                                            $pasajero -> setNecesitaAsistenciaEmbarque ($necesitaAsistenciaEmbarque);
                                            echo "- - - - Preferencia acerca de asistencia de embarque / desembarque cambiada - - - -\n";
                                        break;
                                        case 4:
                                            // Cambiar todo
                                            // Cambiar si el pasajero necesita silla de ruedas
                                            echo "      Necesita silla de ruedas (s/n): ";
                                            $sillaRuedas = trim(fgets(STDIN));
                                            $necesitaSillaRuedas = false;
                                            if ($sillaRuedas == "s")
                                            {
                                                $necesitaSillaRuedas = true;
                                            }
                                            $pasajero -> setNecesitaSillaRuedas ($necesitaSillaRuedas);
                                            // Cambiar si el pasajero necesita Asistencia para el embarque o desembarqu
                                            echo "      Necesita comidas especiales (s/n): ";
                                            $comidasEspeciales = trim(fgets(STDIN));
                                            $necesitaComidasEspeciales = false;
                                            if ($comidasEspeciales == "s")
                                            {
                                                $necesitaComidasEspeciales = true;
                                            }
                                            $pasajero -> setNecesitaComidasEspeciales ($necesitaComidasEspeciales);
                                            // Cambiar si el pasajero necesita comidas especiales
                                            echo "      Necesita asistencia al embarcar o desembarcar (s/n): ";
                                            $asistenciaEmbarque = trim(fgets(STDIN));
                                            $necesitaAsistenciaEmbarque = false;
                                            if ($asistenciaEmbarque == "s")
                                            {
                                                $necesitaAsistenciaEmbarque = true;
                                            }
                                            $pasajero -> setNecesitaAsistenciaEmbarque ($necesitaAsistenciaEmbarque);
                                            echo "- - - - Preferencia acerca de comidas, silla de ruedas y asistencia de embarque / desembarque cambiadas - - - -\n";
                                        break;
                                    }
                                } while ($opcionSubmenu <> 5);
                            }
                        break;
                        case 8:
                            // Cambiar todo
                            echo "  Escriba el nuevo DNI del pasajero: ";
                            $documentoPasajero = trim(fgets(STDIN));
                            $esDuplicado = $viaje -> verificarDuplicados ($documentoPasajero);
                            if (!$esDuplicado)
                            {
                                $pasajero -> setDni ($documentoPasajero);
                                echo "  Escriba el nuevo nombre del pasajero: ";
                                $nombrePasajero = trim(fgets(STDIN));
                                echo "  Escriba el nuevo apellido del pasajero: ";
                                $apellidoPasajero = trim(fgets(STDIN));
                                echo "  Ingrese el nuevo teléfono del pasajero: ";
                                $telefonoPasajero = trim(fgets(STDIN));
                                echo "  Ingrese el nuevo número de ticket del pasajero: ";
                                $numeroTicket = trim(fgets(STDIN));
                                echo "  Ingrese el nuevo número de asiento del pasajero: ";
                                $numeroAsiento = trim(fgets(STDIN));
                                $pasajero -> setNombre ($nombrePasajero);
                                $pasajero -> setApellido ($apellidoPasajero);
                                $pasajero -> setDni ($documentoPasajero);
                                $pasajero -> setTelefono ($telefonoPasajero);
                                $pasajero -> setNumeroTicket ($numeroTicket);
                                $pasajero -> setNumeroAsiento ($numeroAsiento);
                                echo "- - - - Nombre, apellido, dni, teléfono, número de ticket y número de asiento cambiados - - - -\n\n";
                            }
                            else
                            {
                                echo "- - - - Ese DNI ya esta cargado, ingrese otro - - - -\n\n";
                            }
                        break;
                    }
                } while ($opcionSubmenu <> 9);
                $arrayPasajeros [$indicePasajero] = $pasajero;
                $viaje -> setArrayPasajeros ($arrayPasajeros);
            }
            else
            {
                echo "- - - - El DNI no corresponde a ningun pasajero - - - -\n";      
            }
        break;
        case 5:
            do {
                echo "\n------ Modificar datos de una persona responsable ------\n";
                echo "  <1> Cambiar el nombre de la persona responsable \n"; 
                echo "  <2> Cambiar el apellido de la persona responsable \n";
                echo "  <3> Cambiar el número de licencia de la persona responsable \n";
                echo "  <4> Cambiar el número de empleado de la persona responsable \n";
                echo "  <5> Cambiar todo \n";
                echo "  <6> Salir del submenu \n";
                echo "  <-> Ingrese opcion: ";
                $opcionSubmenu = trim(fgets(STDIN));
                $objPersonaResponsable = $viaje -> getObjResponsableV();
                $nroEmpleadoResponsableV = $objPersonaResponsable -> getNroEmpleado();
                switch ($opcionSubmenu) 
                {
                    case 1:
                        // Cambiar nombre
                        echo "  Ingrese el nuevo nombre del responsable: ";
                        $nombreResponsableV = trim(fgets(STDIN)); 
                        $objPersonaResponsable -> setNombre ($nombreResponsableV);
                        echo "- - - - Nombre de persona responsable cambiado - - - -\n";
                    break;
                    case 2:
                        // Cambiar apellido
                        echo "  Ingrese el nuevo apellido del responsable: ";
                        $apellidoResponsableV = trim(fgets(STDIN));
                        $objPersonaResponsable -> setApellido ($apellidoResponsableV);
                        echo "- - - - Apellido de persona responsable cambiado - - - -\n";
                    break;
                    case 3:
                        // Cambiar número de licencia
                        echo "  Ingrese el nuevo número de licencia del responsable: ";
                        $nroLicenciaResponsableVNuevo = trim(fgets(STDIN));
                        $objPersonaResponsable -> setNroLicencia ($nroLicenciaResponsableVNuevo);
                        echo "- - - - Número de licencia de persona responsable cambiado - - - -\n";
                    break;
                    case 4:
                        // Cambiar número de empleado
                        echo "  Ingrese el nuevo número de empleado del nuevo responsable: ";
                        $nroEmpleadoResponsableVNuevo = trim(fgets(STDIN));
                        if ($nroEmpleadoResponsableV == $nroEmpleadoResponsableVNuevo)
                        {
                            echo "- - - - Error, ya esta cargada esa persona responsable - - - -\n";
                        }
                        else
                        {
                            $objPersonaResponsable -> setNroEmpleado ($nroEmpleadoResponsableVNuevo);
                            echo "- - - - Número de empleado de persona responsable cambiado - - - -\n";
                        }
                    break;
                    case 5:
                        // Cambiar todo
                        // Cambiar número de empleado
                        echo "  Ingrese el nuevo número de empleado del nuevo responsable: ";
                        $nroEmpleadoResponsableVNuevo = trim(fgets(STDIN));
                        if ($nroEmpleadoResponsableV == $nroEmpleadoResponsableVNuevo)
                        {
                            echo "- - - - Error, ya esta cargada esa persona responsable - - - -\n";
                        }
                        else
                        {
                            // Cambiar nombre
                            echo "  Ingrese el nuevo nombre del responsable: ";
                            $nombreResponsableV = trim(fgets(STDIN)); 
                            // Cambiar apellido
                            echo "  Ingrese el nuevo apellido del responsable: ";
                            $apellidoResponsableV = trim(fgets(STDIN));
                            // Cambiar número de licencia
                            echo "  Ingrese el nuevo número de licencia del responsable: ";
                            $nroLicenciaResponsableVNuevo = trim(fgets(STDIN));
                            // Sets
                            $objPersonaResponsable -> setNroEmpleado ($nroEmpleadoResponsableVNuevo);
                            $objPersonaResponsable -> setNombre ($nombreResponsableV);
                            $objPersonaResponsable -> setApellido ($apellidoResponsableV);
                            $objPersonaResponsable -> setNroLicencia ($nroLicenciaResponsableVNuevo);
                            echo "- - - - Número de empleado, de licencia, nombre y apellido de persona responsable cambiados - - - -\n";
                        }
                    break;
                }
        } while ($opcionSubmenu <> 6);
        break;
        case 6:
            echo "\n- - - - Información del viaje - - - -\n\n";
            echo $viaje."\n";
        break;
    }
} while ($opcion <> 7);