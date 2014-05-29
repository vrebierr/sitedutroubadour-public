<?php

namespace Sdt\TutorialBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TutorialType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('media', 'sonata_media_type', array('provider' => 'sonata.media.provider.image', 'context'  => 'default', 'required' => false))
            ->add('content')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sdt\TutorialBundle\Entity\Tutorial'
        ));
    }

    public function getName()
    {
        return 'sdt_tutorialbundle_tutorialtype';
    }
}
