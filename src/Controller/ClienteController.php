<?php
namespace App\Controller;
use App\Entity\Cliente;
use App\Form\ClienteType;
use App\Repository\ClienteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
 

/**
 * @Route("/cliente")
 */
class ClienteController extends Controller
{
    /**
     * @Route("/", name="cliente_index", methods="GET")
     */
    public function index(ClienteRepository $clienteRepository): Response
    {
        return $this->render('cliente/index.html.twig', ['clientes' => $clienteRepository->findAll()]);
    }
    /**
     * @Route("/new", name="cliente_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $cliente = new Cliente();
        $form = $this->createForm(ClienteType::class, $cliente);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cliente);
            $em->flush();
            return $this->redirectToRoute('cliente_index');
        }
        return $this->render('cliente/new.html.twig', [
            'cliente' => $cliente,
            'form' => $form->createView(),
        ]);
    }




    /**
     * @Route("/jsonlist", name="cliente_jsonlist")
     */
    public function jsonClientes()
    {

        $encoder = new JsonEncoder();
        $normalizer = new ObjectNormalizer();

        $normalizer->setCircularReferenceHandler(
            function ($object) {
                return $object->getId();
            }
        );

        $serializer = new Serializer(array($normalizer), array($encoder));

        $repo = $this->getDoctrine()->getRepository(Cliente::class);
        $clientes = $repo->findAll();
        $jsonClientes = $serializer->serialize($clientes, 'json');        

        $respuesta = new Response($jsonClientes);
        
        return $respuesta;
    }

    
    /**
     * @Route("/{id}", name="cliente_show", methods="GET")
     */
    public function show(Cliente $cliente): Response
    {
        return $this->render('cliente/show.html.twig', ['cliente' => $cliente]);
    }




}
