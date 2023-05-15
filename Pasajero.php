<?php
class Pasajero 
{
    // Atributos

    private $nombre, $apellido, $dni, $telefono, $numeroAsiento, $numeroTicket;

    // Métodos

    /**
     * Recibe los valores iniciales para los atributos
     * @param string $nombre, $apellido
     * @param int $dni, $telefono, $numeroAsiento, $numeroTicket
     */
    public function __construct ($nombre, $apellido, $dni, $telefono, $numeroAsiento, $numeroTicket)
    {
        $this -> nombre = $nombre;
        $this -> apellido = $apellido;
        $this -> dni = $dni;
        $this -> telefono = $telefono;
        $this -> numeroAsiento = $numeroAsiento;
        $this -> numeroTicket = $numeroTicket;
    }

    /**
     * Para los pasajeros comunes el porcentaje de incremento es del 10 %.
     * @return float
     */
    public function darPorcIncremento ()
    {
        // Variables Internas
        // float $porcIncremento
        $porcIncremento = 10;
        return $porcIncremento;
    }
    
    // Métodos get

    /**
     * Get de nombre
     * @return string
     */
    public function getNombre ()
    {
        return $this -> nombre;
    }

    /**
     * Get de apellido
     * @return string
     */
    public function getApellido ()
    {
        return $this -> apellido;
    }

    /**
     * Get de dni
     * @return int
     */
    public function getDni ()
    {
        return $this -> dni;
    }

    /**
     * Get de telefono
     * @return int
     */
    public function getTelefono ()
    {
        return $this -> telefono;
    }

    /**
     * Get de numeroAsiento
     * @return int
     */
    public function getNumeroAsiento ()
    {
        return $this -> numeroAsiento;
    }

    /**
     * Get de numeroTicket
     * @return int
     */
    public function getNumeroTicket ()
    {
        return $this -> numeroTicket;
    }

    // Métodos set

    /**
     * Set de nombre
     * @param string $nombreNuevo
     */
    public function setNombre ($nombreNuevo)
    {
        $this -> nombre = $nombreNuevo;
    }

    /**
     * Set de apellido
     * @param string $apellidoNuevo
     */
    public function setApellido ($apellidoNuevo)
    {
        $this -> apellido = $apellidoNuevo;
    }

    /**
     * Set de dni
     * @param int $dniNuevo
     */
    public function setDni ($dniNuevo)
    {
        $this -> dni = $dniNuevo;
    }

    /**
     * Set de telefono
     * @param int $telefonoNuevo
     */
    public function setTelefono ($telefonoNuevo)
    {
        $this -> telefono = $telefonoNuevo;
    }

    /**
     * Set de numeroAsiento
     * @param int $numeroAsientoNuevo
     */
    public function setNumeroAsiento ($numeroAsientoNuevo)
    {
        $this -> numeroAsiento = $numeroAsientoNuevo;
    }

    /**
     * Set de numeroTicket
     * @param int $numeroTicketNuevo
     */
    public function setNumeroTicket ($numeroTicketNuevo)
    {
        $this -> numeroTicket = $numeroTicketNuevo;
    }

    // Método __toString

    /**
     * Retorna la información de los atributos de las clases en forma de string
     * @return string
     */
    public function __toString ()
    {
        $frase = 
        "Nombre: ".$this -> getNombre ().
        ". Apellido: ".$this ->  getApellido ().
        ". DNI: ".$this ->  getDni ().
        ". Teléfono: ".$this ->  getTelefono ().
        ". Número de asiento: ".$this -> getNumeroAsiento().
        ". Número de ticket: ".$this -> getNumeroTicket();
        return $frase;
    }
}