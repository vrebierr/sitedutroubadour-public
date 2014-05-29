<?php

namespace Sdt\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
         $builder
            ->add('senderEmail', 'email')
            ->add('senderName')
            ->add('subject')
            ->add('message', 'textarea')
            ->add('captcha', 'genemu_recaptcha')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sdt\CoreBundle\Entity\Contact'
        ));
    }

    public function getName()
    {
        return 'sdt_corebundle_contacttype';
    }
}
