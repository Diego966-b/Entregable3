<?php
class Viaje
{   
    // Atributos
    private $codigoViaje, $destinoViaje, $cantMaxPasajeros, $arrayPasajeros, $objResponsableV, $costoPasaje, $costoViajeTotal;

    /**
     * Recibe como parametros los valores iniciales para los atributos
     * @param int $codigoViaje, $cantMaxPasajeros
     * @param string $destinoViaje
     * @param float $costoPasaje
     * @param ResponsableV $objResponsableV
     */
    public function __construct ($codigoViaje, $destinoViaje, $cantMaxPasajeros, $objResponsableV, $costoPasaje)
    {
        $this -> arrayPasajeros = array ();
        $this -> codigoViaje = $codigoViaje;
        $this -> destinoViaje = $destinoViaje;
        $this -> cantMaxPasajeros = $cantMaxPasajeros;
        $this -> objResponsableV = $objResponsableV;
        $this -> costoPasaje = $costoPasaje;
        $this -> costoViajeTotal = 0;
    }
    
    // Métodos

    /**
     * Incorpora el pasajero a la colección de pasajeros (solo si hay espacio disponible) y 
     * retorna el costo que debe abonar el pasajero.
     * Retorna 0 si no se pudo vender.
     * param Pasajero $objPasajero (puede ser PasajeroEspecial, PasajeroEstandar o PasajeroVip)
     * @return float
     */
    public function venderPasaje ($objPasajero)
    {
        // Variables Internas
        // float $costoFinal, $costoViajeTotal, $costoPasaje, $porcIncremento
        // boolean $hayPasajesDisp, $exito
        $costoFinal = 0;
        $hayPasajesDisp = $this -> hayPasajesDisponible ();
        $costoViajeTotal = $this -> getCostoViajeTotal ();
        if ($hayPasajesDisp)
        {
            $exito = $this -> agregarPasajero ($objPasajero);
            if ($exito)
            {
                $costoPasaje = $this -> getCostoPasaje ();
                $porcIncremento = $objPasajero -> darPorcIncremento ();
                $costoFinal = $costoPasaje + (($porcIncremento * $costoPasaje) / 100);
            }
        }
        $costoViajeTotal = $costoFinal + $costoViajeTotal;
        $this -> setCostoViajeTotal ($costoViajeTotal); 
        return $costoFinal;
    }
    
    /**
     * Retorna verdadero si la cantidad de pasajeros del viaje es menor a la cantidad máxima de pasajeros y falso caso contrario.
     * @return boolean
     */
    public function hayPasajesDisponible ()
    {
        // Variables Internas
        // array $arrayPasajeros
        // int $cantMaxPasajeros, $cantPasajeros
        // boolean $hayPasajesDisp
        $hayPasajesDisp = false;
        $arrayPasajeros = $this -> getArrayPasajeros ();
        $cantMaxPasajeros = $this -> getCantMaxPasajeros();
        $cantPasajeros = count ($arrayPasajeros);
        if ($cantPasajeros < $cantMaxPasajeros)
        {   
            $hayPasajesDisp = true;
        }
        return $hayPasajesDisp;
    }

    /**
     * Módulo Adicional
     * Recibe por parámetro el dni de un pasajero y retorna su índice en el array.
     * @param int $dniP
     * @return int
     */
    public function buscarIndicePasajero ($dniP) 
    {
        // Variables Internas
        // array $arrayPasajeros
        // int $cantPasajeros, $pos, $indicePasajero, $dni
        // boolean $encontrado
        // Pasajero $pasajeroActual (puede ser: PasajeroEstandar, PasajeroEspecial o PasajeroVip)
        $arrayPasajeros = $this -> getArrayPasajeros ();
        $cantPasajeros = count ($arrayPasajeros);
        $encontrado = false;
        $pos = 0;
        while ((!$encontrado) && ($pos < $cantPasajeros))
        {
            $pasajeroActual = $arrayPasajeros [$pos];
            $dni = $pasajeroActual -> getDni ();
            if ($dni == $dniP)
            {
                $indicePasajero = $pos;
                $encontrado = true;
            }
            $pos ++;   
        }
        return $indicePasajero;
    }

    /**
     * Verifica si 1 pasajero es igual a otro, si no lo es, lo agrega al array de pasajeros.
     * @param Pasajero $objPasajero (podria ser: PasajeroEstandar, PasajeroVip o PasajeroEspecial)
     * @return boolean
     */
    public function agregarPasajero ($objPasajero)
    {
        // Variables Internas
        // string $exito
        // int $dni
        // boolean $duplicado
        // array $arrayPasajeros
        $exito = false;
        $dni = $objPasajero -> getDni ();
        $duplicado = $this -> verificarDuplicados ($dni);
        if (!$duplicado)
        {
            $arrayPasajeros = $this -> getArrayPasajeros ();
            array_push ($arrayPasajeros, $objPasajero);
            $this -> setArrayPasajeros ($arrayPasajeros);
            $exito = true;
        }
        return $exito;
    }

    /**
     * Módulo adicional
     * Verifica que no haya un pasajero igual a otro.
     * @param int $dniP
     * @return boolean
     */
    public function verificarDuplicados ($dniP)
    {
        // Variables Internas
        // array $arrayPasajeros
        // int $pos, $cantPasajeros
        // boolean $duplicado
        // string $dniPasajero
        // Pasajero $objPasajero (puede ser: PasajeroEstandar, PasajeroEspecial o PasajeroVip)
        $pos = 0;
        $duplicado = false;
        $arrayPasajeros = $this -> getArrayPasajeros ();
        $cantPasajeros = count ($arrayPasajeros);
        if ($cantPasajeros <> 0)
        {
            do {
                $objPasajero = $arrayPasajeros [$pos];
                $dniPasajero = $objPasajero -> getDni ();
                if ($dniPasajero == $dniP)
                {
                    $duplicado = true;
                }
                $pos ++;
            } while ((!$duplicado) && ($pos < $cantPasajeros));
        }
        return $duplicado;
    }

    /*
    /**
     * NO LO USE
     * Módulo Adicional 
     * Devuelve el obj pasajero según el dni de un pasajero. Retorna null si no lo encuentra.
     * @param int $dniP
     /
    public function buscarObjPasajero ($dniP) //  
    {
        // Variables Internas   
        // Pasajero $pasajeroBuscado (podria ser PasajeroEstandar, PasajeroVip, PasajeroEspecial)
        // array $arrayPasajeros
        // int $cantPasajeros, $pos, $dniPasajero
        // boolean $encontrado
        $pasajeroBuscado = null;
        $arrayPasajeros = $this -> getArrayPasajeros ();
        $cantPasajeros = count ($arrayPasajeros);
        $encontrado = false;
        $pos = 0;
        while ((!$encontrado) && ($pos < $cantPasajeros))
        {
            $pasajero = $arrayPasajeros [$pos];
            $dniPasajero = $pasajero -> getDni ();
            if ($dniP == $dniPasajero)
            {
                $pasajeroBuscado = $arrayPasajeros [$pos];
                $encontrado = true;
            }
            $pos ++;
        }
        return $pasajeroBuscado;
    }
*/

    // Métodos get

    /**
     * Get de codigoViaje
     * @return string
     */
    public function getCodigoViaje ()
    {
        return $this -> codigoViaje;
    }

    /**
     * get de destinoViaje
     * @return string
     */
    public function getDestinoViaje ()
    {
        return $this -> destinoViaje;
    }

    /**
     * Get de cantMaxPasajeros
     * @return int
     */
    public function getCantMaxPasajeros ()
    {
        return $this -> cantMaxPasajeros;
    }    

    /**
     * get de ArrayPasajeros
     * @return array
     */
    public function getArrayPasajeros ()
    {
        return $this -> arrayPasajeros;
    }

    /**
     * Get de $objResponsableV
     * @return ResponsableV
     */
    public function getObjResponsableV ()
    {
        return $this -> objResponsableV;
    }

    /**
     * Get de costoPasaje
     * @return float
     */
    public function getCostoPasaje ()
    {
        return $this -> costoPasaje;
    }

    /**
     * Get de costoViajeTotal
     * @return float
     */
    public function getCostoViajeTotal ()
    {
        return $this -> costoViajeTotal;
    }

    // Métodos set 

    /**
     * Set de codigoViaje 
     * @param int $codigoViajeNuevo
     */
    public function setCodigoViaje ($codigoViajeNuevo)
    {
        $this -> codigoViaje = $codigoViajeNuevo;
    }
    
    /**
     * Set de destinoViaje 
     * @param string $destinoViajeNuevo
     */
    public function setDestinoViaje ($destinoViajeNuevo)
    {
        $this -> destinoViaje = $destinoViajeNuevo;
    }

    /**
     * Set de cantMaxPasajeros 
     * @param int $cantMaxPasajerosNuevo
     */
    public function setCantMaxPasajeros ($cantMaxPasajerosNuevo)
    {
        $this -> cantMaxPasajeros = $cantMaxPasajerosNuevo;
    }

    /**
     * Set de arrayPasajeros
     * @param array $arrayPasajerosNuevo
     */
    public function setArrayPasajeros ($arrayPasajerosNuevo)
    {
        $this -> arrayPasajeros = $arrayPasajerosNuevo;
    }
    
    /**
     * Set de objResponsableV
     * @param ResponsableV $ObjResponsableVNuevo
     */
    public function setObjResponsableV ($ObjResponsableVNuevo)
    {
        $this -> objResponsableV = $ObjResponsableVNuevo;
    }

    /**
     * Set de costoPasaje
     * @param float $costoPasajeNuevo
     */
    public function setCostoPasaje ($costoPasajeNuevo)
    {
        $this -> costoPasaje = $costoPasajeNuevo;
    }

    /**
     * Set de costoViajeTotal
     * @param float $costoViajeTotalNuevo
     */
    public function setCostoViajeTotal ($costoViajeTotalNuevo)
    {
        $this -> costoViajeTotal = $costoViajeTotalNuevo;
    }

    // Métodos __toString y mostrarPasajeros

    /**
     * Retorna la información de los atributos de las clases en forma de string
     * @return string
     */
    public function __toString ()
    {
        // Variables Internas
        // string $frase
        $frase = 
        "- - El destino es: ".$this -> getDestinoViaje().
        ".\n- - Codigo del viaje: ".$this -> getCodigoViaje().
        ".\n- - Cantidad maxima de pasajeros: ".$this -> getCantMaxPasajeros().
        ".\n- - Cantidad de pasajeros cargados: ".count ($this -> getArrayPasajeros()).
        ".\n- - Costo del pasaje: $ ".$this -> getCostoPasaje().
        ".\n- - Cantidad recaudada de todos los pasajes: $ ".$this -> getCostoViajeTotal ().
        ".\n\n- - - - Datos de los pasajeros - - - -\n".$this -> mostrarPasajeros ().
        "\n\n- - - - Informacion del responsable del viaje - - - -\n\n".$this -> getObjResponsableV ();
        return ($frase);
    }

    /**
     * Recorre el array de pasajeros exhaustivamente y guarda en un string cada una de sus datos para luego retornarlo
     * @return string
     */
    public function mostrarPasajeros () 
    {
        // Variables Internas
        // string $frase
        // array $arrayPasajeros
        // int $pos, $cantPasajeros
        // Pasajero $pasajero (puede ser: PasajeroEstandar, PasajeroEspecial o PasajeroVip)
        $frase = "";
        $arrayPasajeros = $this -> getArrayPasajeros ();
        $cantPasajeros = count ($arrayPasajeros);
        for ($pos = 0; $pos < $cantPasajeros; $pos ++)
        {
            $pasajero = $arrayPasajeros [$pos];
            $frase = $frase. "\n- - Pasajero N°".($pos+1).": ".$pasajero;
        }
        return ($frase);
    }
}