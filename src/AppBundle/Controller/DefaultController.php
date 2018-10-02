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
     * @Route("/mantenimientos/detalle/{equipo}", name="detalleMantenimientos")
     */
    public function editEquipoAction($equipo=null) {
        if($equipo != null){
            $repositoryEquipos = $this->getDoctrine()->getRepository(Equipo::class);
            $equipo = $repositoryEquipos->find($equipo); //Find devuelve un solo item no array

            return $this->render('default/dashboard/detalleMantenimiento.html.twig', array(
                'equipo' => $equipo));
        }else {
            return $this->redirectToRoute('inicio');
        }
        
    }


     /**
     * @Route("/mantenimientos/{equipo}", name="mantenimientos")
     */
    public function mantenimientosAction($equipo='todos')
    {
        $repositoryEquipos = $this->getDoctrine()->getRepository(Equipo::class);

        if($equipo=='todos'){
            
            $equipos = $repositoryEquipos->findBy(
                array('isActivo' => 1),
                array('precio' => 'ASC') //2do array es para ordenamiento
                
            );
           
            return $this->render('default/dashboard/mantenimientos.html.twig', array(
                'parametro' => $equipo,
                'equipos' => $equipos));
        }else{
            $equipos = $repositoryEquipos->findByCodProducto($equipo);

            return $this->render('default/dashboard/mantenimientos.html.twig', array(
                'parametro' => $equipo,
                'equipos' => $equipos));
        }
       
    }

    

}
