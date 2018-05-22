<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use App\Entity\Mascota;
use App\Form\MascotaType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

    /**
     * @Route("/mascota")
     */

class MascotaController extends Controller
{
    /**
     * @Route("/nuevo", name="mascota_nuevo")
     */
    public function index(Request $request)
    {
        $mascota = new Mascota();
        $formu = $this->createForm(MascotaType::class, $mascota);
        $formu->handleRequest($request);

        if ($formu->isSubmitted()) {

            $em = $this->getDoctrine()->getManager();

            $em->persist($mascota);

            $em->flush();

            return $this->redirectToRoute('mascota_lista');
        }

        return $this->render('mascota/nuevo.html.twig', [
            'formulario' => $formu->createView(),
        ]);
        
    }

    /**
     * @Route("/lista", name="mascota_lista")
     */
    public function listado()
    {

        //$this->cargarDatos();
        $repo = $this->getDoctrine()->
            getRepository (Mascota::class);

        $mascotas = $repo->findAll();    

     

        return $this->render('mascota/index.html.twig', [
            'mascotas' => $mascotas,
             
            
        ]);
    }
}