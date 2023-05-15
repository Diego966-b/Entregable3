<?php
// Esta clase PasajeroEspecial es hija de Pasajero
class PasajeroEspecial extends Pasajero
{
    
    // Atributos

    private $necesitaSillaRuedas, $necesitaAsistenciaEmbarque, $necesitaComidasEspeciales;

    // Métodos 
    
    /**
     * Recibe los valores iniciales para los atributos
     * @param string $nombre, $apellido
     * @param int $dni, $telefono, $numeroAsiento, $numeroTicket
     * @param boolean $necesitaSillaRuedas, $necesitaAsistenciaEmbarque, $necesitaComidasEspeciales
     */
    public function __construct ($nombre, $apellido, $dni, $telefono, $numeroAsiento, $numeroTicket, $necesitaSillaRuedas, $necesitaAsistenciaEmbarque, $necesitaComidasEspeciales)
    {
        parent::__construct ($nombre, $apellido, $dni, $telefono, $numeroAsiento, $numeroTicket);
        $this -> necesitaSillaRuedas = $necesitaSillaRuedas;
        $this -> necesitaAsistenciaEmbarque = $necesitaAsistenciaEmbarque;
        $this -> necesitaComidasEspeciales = $necesitaComidasEspeciales;
    }

    /**
     * Si el pasajero requiere los 3 servicios el pasaje tiene un incremento del 30%. Si requiere solo 1 del 15%.
     * Asumo que va a requerir por lo menos 1 servicio
     * @return float
     */
    public function darPorcIncremento ()
    {
        // Variables Internas
        // float $porcIncremento
        // boolean $sillaRuedas, $asistenciaEmbarque, $comidasEspeciales
        $porcIncremento = 0;
        $sillaRuedas = $this -> getNecesitaSillaRuedas();
        $asistenciaEmbarque = $this -> getNecesitaAsistenciaEmbarque();
        $comidasEspeciales = $this -> getNecesitaComidasEspeciales();
        if (($sillaRuedas) && ($asistenciaEmbarque) && ($comidasEspeciales))
        {
            $porcIncremento = 30;
        }
        elseif (($sillaRuedas) || ($asistenciaEmbarque) || ($comidasEspeciales))
        {
            $porcIncremento = 15;
        }
        return $porcIncremento;
    }

    // Métodos get

    /**
     * Get de necesitaSillaRuedas
     * @return boolean
     */
    public function getNecesitaSillaRuedas ()
    {
        return $this -> necesitaSillaRuedas;
    }

    /**
     * Get de necesitaAsistenciaEmbarque
     * @return boolean
     */
    public function getNecesitaAsistenciaEmbarque ()
    {
        return $this -> necesitaAsistenciaEmbarque;
    }

    /**
     * Get de necesitaComidasEspeciales
     * @return boolean
     */
    public function getNecesitaComidasEspeciales ()
    {
        return $this -> necesitaComidasEspeciales;
    }

    // Métodos set

    /**
     * Set de necesitaSillaRuedas
     * @param boolean $necesitaSillaRuedasNuevo
     */
    public function setNecesitaSillaRuedas ($necesitaSillaRuedasNuevo)
    {
        $this -> necesitaSillaRuedas = $necesitaSillaRuedasNuevo;
    }

    /**
     * Set de necesitaAsistenciaEmbarque
     * @param boolean $necesitaAsistenciaEmbarqueNuevo
     */
    public function setNecesitaAsistenciaEmbarque ($necesitaAsistenciaEmbarqueNuevo)
    {
        $this -> necesitaAsistenciaEmbarque = $necesitaAsistenciaEmbarqueNuevo;
    }

    /**
     * Set de necesitaComidasEspeciales 
     * @param boolean $necesitaComidasEspecialesNuevo
     */
    public function setNecesitaComidasEspeciales ($necesitaComidasEspecialesNuevo)
    {
        $this -> necesitaComidasEspeciales = $necesitaComidasEspecialesNuevo;
    }

    // Método __toString

    /**
     * Devuelve en un string los valores de los atributos
     * @return string
     */
    public function __toString ()
    {
        // Variables Internas
        // string $frase, $sillaRuedas, $asistenciaEmbarque, $comidas
        // boolean $necesitaSillaRuedas, $necesitaAsistenciaEmbarque, $necesitaComidasEspeciales
        $sillaRuedas = "no";
        $asistenciaEmbarque = "no";
        $comidas = "no";
        $necesitaSillaRuedas = $this -> getNecesitaSillaRuedas();
        if ($necesitaSillaRuedas)
        {
            $sillaRuedas = "si";
        }

        $necesitaAsistenciaEmbarque = $this -> getNecesitaAsistenciaEmbarque();
        if ($necesitaAsistenciaEmbarque)
        {
            $asistenciaEmbarque = "si";
        }

        $necesitaComidasEspeciales = $this -> getNecesitaComidasEspeciales();
        if ($necesitaComidasEspeciales)
        {
            $comidas = "si";
        }

        $frase = parent::__toString().
        ".\n- - El pasajero necesita: Silla de ruedas: ".$sillaRuedas.
        ". Asistencia embarque / desembarque: ".$asistenciaEmbarque.
        ". Comidas especiales: ".$comidas.".";
        return $frase;
    }
}