<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Form\EquipoType;
use AppBundle\Entity\Equipo;

/**
* @Route("/gestionEquipos")
*/
class EquipoController extends Controller
{
    /**
     * @Route("/nuevoequipo/", name="nuevoEquipo")
     */
    public function nuevoEquipoAction(Request $request)
    {
        $equipo = new Equipo();
        $form = $this->createForm(EquipoType::class, $equipo);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $equipo = $form->getData();
            $equipo->setfechaCreacion(new \DateTime());
            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($equipo);
            $entityManager->flush();
    
            return $this->redirectToRoute('detalleMantenimientos', array(
                'equipo' => $equipo->getId())
            );
        }

        return $this->render('default/dashboard/gestionEquipos/nuevoEquipo.html.twig', array(
            'form' => $form->createView(),
        ));
       
    }
}