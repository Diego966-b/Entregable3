<?php
// Esta clase PasajeroVip es hija de Pasajero
class PasajeroVip extends Pasajero
{
    
    // Atributos

    private $numeroViajero, $cantMillas;

    // Métodos 
    
    /**
     * Recibe los valores iniciales para los atributos
     * @param string $nombre, $apellido
     * @param int $dni, $telefono, $numeroAsiento, $numeroTicket, $numeroViajero
     * @param float $cantMillas
     */
    public function __construct ($nombre, $apellido, $dni, $telefono, $numeroAsiento, $numeroTicket, $numeroViajero, $cantMillas)
    {
        parent::__construct ($nombre, $apellido, $dni, $telefono, $numeroAsiento, $numeroTicket);
        $this -> numeroViajero = $numeroViajero;
        $this -> cantMillas = $cantMillas;
    }

    /**
     * Para un pasajero VIP se incrementa el importe un 35% y si la cantidad de millas acumuladas supera a las 300 millas se realiza un incremento del 30%. 
     * @return float
     */
    public function darPorcIncremento ()
    {
        // Variables Internas
        // float $cantMillas, $porcIncremento
        $cantMillas = $this -> getCantMillas ();
        $porcIncremento = 35;
        if ($cantMillas > 300)
        {
            $porcIncremento = 30; 
        }
        return $porcIncremento;
    }

    // Métodos get

    /**
     * Get de numeroViajero
     * @return int 
     */
    public function getNumeroViajero ()
    {
        return $this -> numeroViajero;
    }

    /**
     * Get de cantMillas
     * @return float
     */
    public function getCantMillas ()
    {
        return $this -> cantMillas;
    }

    // Métodos set

    /**
     * Set de numeroViajero
     * @param int $numeroViajeroNuevo
     */
    public function setNumeroViajero ($numeroViajeroNuevo)
    {
        $this -> numeroViajero = $numeroViajeroNuevo;
    }

    /**
     * Set de cantMillas
     * @param int $cantMillasNuevo
     */
    public function setCantMillas ($cantMillasNuevo)
    {
        $this -> cantMillas = $cantMillasNuevo;
    }

    // Método __toString

    /**
     * Devuelve en un string los valores de los atributos
     * @return string
     */
    public function __toString ()
    {
        // Variables Internas
        // string $frase
        $frase = parent::__toString().". Número de viajero: ".$this -> getNumeroViajero().". Cantidad de millas: ".$this -> getCantMillas();
        return $frase;
    }
}