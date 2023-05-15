<?php
// Clase PasajeroEstandar hija de Pasajero
class PasajeroEstandar extends Pasajero
{

    // Métodos

    /**
     * Recibe los valores iniciales para los atributos
     * @param string $nombre, $apellido
     * @param int $dni, $telefono, $numeroAsiento, $numeroTicket
     */
    public function __construct ($nombre, $apellido, $dni, $telefono, $numeroAsiento, $numeroTicket)
    {
        parent::__construct ($nombre, $apellido, $dni, $telefono, $numeroAsiento, $numeroTicket);
    }

    /**
     * Para los pasajeros comunes el porcentaje de incremento es del 10 %.
     * @return float
     */
    public function darPorcIncremento ()
    {
        // Variables Internas
        // float $porcIncremento
        $porcIncremento = parent::darPorcIncremento();
        return $porcIncremento;
    }

    // __toString

    /**
     * Retorna la información de los atributos de las clases en forma de string
     * @return string
     */
    public function __toString()
    {
        // Variables Internas
        // string $frase
        $frase = parent::__toString();
        return $frase;
    }
}