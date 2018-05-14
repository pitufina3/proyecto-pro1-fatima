<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Persona;
use App\Form\PersonaType;

/**
     * @Route("/persona")
     */


class PersonaController extends Controller
{

    /**
     * @Route("/lista", name="persona_lista")
     */
    public function listado()
    {
        $repo = $this->getDoctrine()->getRepository(Persona::class);

        $vectorpersona = $repo->findAll();



        dump ($vectorpersona);

        return $this->render('persona/index.html.twig', [
            'vectorpersona' => $vectorpersona,
        ]);
    }

/**
     * @Route("/nuevo", name="persona_nuevo")
     */

    public function nuevo(Request $request)
    {
        $persona = new Persona();
        $formu = $this->createForm(PersonaType::class, $persona);
        $formu->handleRequest($request);

        if ($formu->isSubmitted()) {

        

            dump ($persona);
    

        return $this->render('persona/final.html.twig', [
            ]);
        }


        return $this->render('persona/nuevo.html.twig', [
            'formulario' => $formu->createView()
        ]);
    }

}
