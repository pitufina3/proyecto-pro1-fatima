<?php
namespace App\Controller;
use App\Entity\Mascota;
use App\Form\MascotaType;
use App\Repository\MascotaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/mascota")
 */
class MascotaController extends Controller
{
    /**
     * @Route("/", name="mascota_index", methods="GET")
     */
    public function index(MascotaRepository $mascotaRepository): Response
    {
        return $this->render('mascota/index.html.twig', ['mascotas' => $mascotaRepository->findAll()]);
    }
    /**
     * @Route("/new", name="mascota_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $mascotum = new Mascota();
        $form = $this->createForm(MascotaType::class, $mascotum);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($mascotum);
            $em->flush();
            return $this->redirectToRoute('mascota_index');
        }
        return $this->render('mascota/new.html.twig', [
            'mascotum' => $mascotum,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{id}", name="mascota_show", methods="GET")
     */
    public function show(Mascota $mascotum): Response
    {
        return $this->render('mascota/show.html.twig', ['mascotum' => $mascotum]);
    }
}