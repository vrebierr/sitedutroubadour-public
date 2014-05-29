<?php

namespace Sdt\ScoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class ScoreSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('artist', 'text', array('required' => false))
            ->add('song', 'text', array('required' => false))
            ->add('category', 'entity', array('class' => 'Sdt\ScoreBundle\Entity\ScoreCategory', 'required' => false))
        ;
    }

    public function getName()
    {
        return 'sdt_scorebundle_scoretype';
    }
}
