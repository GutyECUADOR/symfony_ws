<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Equipo;   

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

/**
* @Route("/gestionEquipos")
*/
class EquipoController extends Controller
{
    /**
     * @Route("/nuevoequipo/", name="nuevoEquipo")
     */
    public function nuevoEquipoAction()
    {
        $equipo = new Equipo();
        $formBuilder = $this->createFormBuilder($equipo);
        $formBuilder->add('codProducto', TextType::class);
        $formBuilder->add('nombre', TextType::class);
        $formBuilder->add('precio', MoneyType::class);
        $formBuilder->add('descripcion', TextareaType::class);
        $formBuilder->add('fechaCreacion', DateType::class);
        $formBuilder->add('isActivo', ChoiceType::class, array(
            'choices'  => array(
                'Si' => true,
                'No' => false,
            ),
            'label' => 'Activo'
        ));

        $form = $formBuilder->getForm();
        
        return $this->render('default/dashboard/gestionEquipos/nuevoEquipo.html.twig', array(
            'form' => $form->createView(),
        ));
       
    }
}