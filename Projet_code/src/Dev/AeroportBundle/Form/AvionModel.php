<?php

namespace Dev\AeroportBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Dev\AeroportBundle\Entity\Avion;


class AvionModel extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // Ajout des champs "classiques"
        $builder->add('avionNom', 'text', array('label' => 'Nom'));
        $builder->add('avionCapacite', 'text', array('label' => 'Capacite'));
    }
    
    
    
    public function getName()
    {
        return 'AvionModel';
    }
}

?>