<?php

namespace Dev\AeroportBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Dev\AeroportBundle\Entity\Compagnie;


class CompagnieModel extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // Ajout des champs "classiques"
        $builder->add('compagnieNom', 'text', array('label' => 'Nom'));
    }
    
    
    
    public function getName()
    {
        return 'CompagnieModel';
    }
}

?>