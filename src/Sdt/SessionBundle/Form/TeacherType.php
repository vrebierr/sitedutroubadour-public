<?php

namespace Sdt\SessionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TeacherType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastname', 'text')
            ->add('firstname', 'text')
            ->add('address1', 'text')
            ->add('address2', 'text', array('required' => false))
            ->add('zipcode')
            ->add('city', 'text')
            ->add('advert')
            ->add('price', 'money')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sdt\SessionBundle\Entity\Teacher'
        ));
    }

    public function getName()
    {
        return 'sdt_sessionbundle_teachertype';
    }
}
