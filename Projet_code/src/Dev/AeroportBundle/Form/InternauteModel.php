<?php

namespace Dev\AeroportBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Dev\AeroportBundle\Entity\Internaute;


class InternauteModel extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // Ajout des champs "classiques"
        $builder->add('email', 'text', array('label' => 'Mail'));
        $builder->add('nom', 'text', array('label' => 'Nom'));
        $builder->add('prenom', 'text', array('label' => 'Prenom'));
        $builder->add('region', 'text', array('label' => 'Region'));
        $builder->add('password', 'text', array('label' => 'Pass'));
    }
    
    
    
    public function getName()
    {
        return 'InternauteModel';
    }
}

?>