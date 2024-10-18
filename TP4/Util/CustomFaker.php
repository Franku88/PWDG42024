<?php 

use Faker\Factory;

class CustomFaker {
    protected $faker;

    public function __construct() {
        $this->faker = Factory::create(); 
    }

    // Para generar un nuevo auto debemos tener en cuenta Patente, Marca, Modelo y Dueño(DNI)

    public function vehiculo() {
        $marca = trim($this->marca());
        $modelo = trim($this->modelo());
        $patente = "";
        $duenio = ""; 
        $vehiculoFinal = ["Patente" => $patente, "Marca" => $marca, "Modelo" => $modelo, "Duenio" => $duenio]; 
    
        // Generar patente hasta encontrar una que no esté en uso
        do {
            $patente = $this->patente(); 
            $patenteEnUso = (new ABMAuto())->buscar(['Patente' => $patente]);
        } while (!empty($patenteEnUso));  
    
        $vehiculoFinal['Patente'] = $patente;
        
        // Selecciona un dueño aleatorio (objeto completo)
        $listaDuenios = (new ABMPersona())->buscar(null);
        $duenioAleatorio = $listaDuenios[array_rand($listaDuenios)];
        $vehiculoFinal['Duenio'] = $duenioAleatorio; // Asigna el objeto de dueño completo
    
        return $vehiculoFinal;        
    }
    
    public function patente() {
        $letters = $letters = strtoupper(substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 3)); // 3 letras
        $numbers = rand(100, 999); // 3 dígitos
        $patente = $letters . " " . $numbers; // Ejemplo de patente: ABC123
        return $patente;
    }
    public function marca() {
        $marcas = ['Peugeot', 'Renault', 'Fiat', 'Ford', 'Chevrolet', 'Volkswagen', 'Toyota', 'Honda', 'Nissan', 'Citroen'];        
        $marcaAleatoria = $this->faker->randomElements($marcas, $count = 1); 
        return $marcaAleatoria[0];
    }
    public function modelo() {
        $number = $this->faker->numberBetween($min = 1940, $max = 2024);
        return $number;
    }
    

}
