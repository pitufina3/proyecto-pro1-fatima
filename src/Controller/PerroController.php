<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Perro;
use App\Form\PerroType;

/**
     * @Route("/perro")
     */


class PerroController extends Controller
{

	private $vectorperros = array();

	private function cargardatos (){
		$this->vectorperros[] = (new Perro())->setNombre("Lassie")->setRaza("Labrador")->setEdad("2");
		$this->vectorperros[] = (new Perro())->setNombre("Curro")->setRaza("Collie")->setEdad("4");
		$this->vectorperros[] = (new Perro())->setNombre("Cobbie")->setRaza("Chiguagua")->setEdad("8");


		$p1 = new Perro();
		$p1->setNombre ("Trumpy");
		$p1->setRaza("AlaskaMalamute");
		$p1->setEdad("2");
		$this->vectorperros[] = $p1;
	}

    /**
     * @Route("/lista", name="perro")
     */
    public function listado()
    {

    	$this->cargarDatos();
    	dump ($this->vectorperros);

        return $this->render('perro/index.html.twig', [
            'vectorperros' => $this->vectorperros,
        ]);
    }

/**
     * @Route("/nuevo", name="perro_nuevo")
     */

    public function nuevo(Request $request)
    {
    	$perro = new Perro();
    	$formu = $this->createForm(PerroType::class, $perro);
    	$formu->handleRequest($request);

    	if ($formu->isSubmitted()) {

    	

    		dump ($perro);
    

    	return $this->render('perro/final.html.twig', [
        	]);
    	}


        return $this->render('perro/nuevo.html.twig', [
            'formulario' => $formu->createView()
        ]);
    }

}
