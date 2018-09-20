<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Equipo;    

class DefaultController extends Controller
{
    /**
     * @Route("/", name="inicio")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/dashboard/home.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

     /**
     * @Route("/mantenimientos/{equipo}", name="mantenimientos")
     */
    public function mantenimientosAction($equipo='todos')
    {
        $repositoryEquipos = $this->getDoctrine()->getRepository(Equipo::class);
        $equipos = $repositoryEquipos->findAll();
       
        return $this->render('default/dashboard/mantenimientos.html.twig', array(
            'equipos' => $equipos));
    }

    public function createEquipo(){
        
    }

}
