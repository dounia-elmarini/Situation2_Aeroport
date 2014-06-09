<?php

namespace Dev\AeroportBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Dev\AeroportBundle\Entity\Vol;


class VolModel extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        
        // Ajout des champs "classiques"
        $builder->add('volNom', 'text', array('label' => 'Nom'));
        
        $builder->add('volDateDep', 'datetime', array('label' => 'Heure depart'));
        $builder->add('volDateArriv', 'datetime', array('label' => 'Heure arrivee'));
        
        
        
        // Ajout des champs liés à une table
        $builder->add('volComp', 'entity', array( 
               'class' => 'DevAeroportBundle:Compagnie', 
               'required' =>true, 
               'label' => "Compagnie",
               'property' => 'compagnieNom', 
            ));
        
        $builder->add('volVilleDep', 'entity', array( 
               'class' => 'DevAeroportBundle:Ville', 
               'required' =>true, 
               'label' => "Ville depart",
               'property' => 'villeNom', 
            ));
        
        $builder->add('volVilleArriv', 'entity', array( 
               'class' => 'DevAeroportBundle:Ville', 
               'required' =>true, 
               'label' => "Ville arrivee",
               'property' => 'villeNom', 
            ));
        
        $builder->add('volAvion', 'entity', array( 
               'class' => 'DevAeroportBundle:Avion', 
               'required' =>true, 
               'label' => "Avion",
               'property' => 'avionNom', 
            ));
        
        
    }
    
    
    
    public function getName()
    {
        return 'VolModel';
    }
}

?>