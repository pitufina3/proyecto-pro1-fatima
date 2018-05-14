<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use App\Entity\Persona;
use App\Form\PersonaType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

	/**
     * @Route("/persona")
     */

class PersonaController extends Controller
{
    /**
     * @Route("/nuevo", name="persona_nuevo")
     */
    public function index(Request $request)
    {
    	$persona = new persona();
    	$formu = $this->createForm(PersonaType::class, $persona);
    	$formu->handleRequest($request);

    	if ($formu->isSubmitted()) {

    		$nombre = $request->request->get('nombre');
    		$edad = $request->request->get('edad');
    		$telefono = $request->request->get('telefono');

    		dump ($nombre);
    		dump ($edad);
    		dump ($telefono);
    		dump ($persona);

    		return $this->render('persona/final.html.twig', [
        	]);
    	}

        return $this->render('persona/index.html.twig', [
            'formulario' => $formu->createView(),
        ]);
    }
}
