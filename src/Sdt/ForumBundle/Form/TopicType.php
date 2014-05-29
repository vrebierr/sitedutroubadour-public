<?php

namespace Sdt\ForumBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TopicType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('subject')
            ->add('description')
            ->add('message', 'textarea')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sdt\ForumBundle\Entity\Topic'
        ));
    }

    public function getName()
    {
        return 'sdt_forumbundle_topictype';
    }
}
