<?php
namespace App\Controller;
use App\Entity\Consulta;
use App\Form\ConsultaType;
use App\Repository\ConsultaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/consulta")
 */
class ConsultaController extends Controller
{
    /**
     * @Route("/", name="consulta_index", methods="GET")
     */
    public function index(ConsultaRepository $consultaRepository): Response
    {
        return $this->render('consulta/index.html.twig', ['consultas' => $consultaRepository->findAll()]);
    }
    /**
     * @Route("/new", name="consulta_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $consultum = new Consulta();
        $form = $this->createForm(ConsultaType::class, $consultum);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($consultum);
            $em->flush();
            return $this->redirectToRoute('consulta_index');
        }
        return $this->render('consulta/new.html.twig', [
            'consultum' => $consultum,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{id}", name="consulta_show", methods="GET")
     */
    public function show(Consulta $consultum): Response
    {
        return $this->render('consulta/show.html.twig', ['consultum' => $consultum]);
    }
    /**
     * @Route("/{id}/edit", name="consulta_edit", methods="GET|POST")
     */
    public function edit(Request $request, Consulta $consultum): Response
    {
        $form = $this->createForm(ConsultaType::class, $consultum);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('consulta_edit', ['id' => $consultum->getId()]);
        }
        return $this->render('consulta/edit.html.twig', [
            'consultum' => $consultum,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{id}", name="consulta_delete", methods="DELETE")
     */
    public function delete(Request $request, Consulta $consultum): Response
    {
        if ($this->isCsrfTokenValid('delete'.$consultum->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($consultum);
            $em->flush();
        }
        return $this->redirectToRoute('consulta_index');
    }
}