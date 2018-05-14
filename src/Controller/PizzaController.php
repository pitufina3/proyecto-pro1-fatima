<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

    /**
     * @Route("/pizza")
     */
class PizzaController extends Controller
{
    /**
     * @Route("", name="pizza")
     */
    
    public function index()
    {
    	$vector = array("Margarita", "Carbonara", "Hawaiana");
        return $this->render('pizza/index.html.twig', [
            'controller_name' => 'PizzaController',
            'minombre'=>'Fatima',
            'pizzas' => $vector
        ]);
    }



    /**
     * @Route("/nuevo" , name="pizza_nuevo")
     */
    public function nuevaPizza()
    {
    	
        return $this->render('pizza/nuevo.html.twig', [
            
        ]);
    }

    /**
     * @Route("/editar" , name="pizza_editar")
     */
    public function editarPizza()

    {
        
    	$vectorlocalidades	= array ("Alburquerque", "La Roca de la Sierra", "Villar del Rey");
        return $this->render('pizza/editar.html.twig', 
                [
                    'localidades' => $vectorlocalidades

                    ]
            );
    }


    /**
     * @Route("/mostrar",  name="pizza_mostrar")
     */
    public function mostrarPizza()

    {

        return $this->render('pizza/mostrar.html.twig');
    }





     /**
     * @Route("/calcular/{precio}",  name="pizza_calcular", requirements={"precio"="\d+"})
     */
    public function calcularPizza($precio)
    {
    	$final = $precio * 1.21;
        return $this->render('pizza/nombre.html.twig', [
            'preciofinal' => $final
        ]);
    }
}
