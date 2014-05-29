<?php

namespace Sdt\ScoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class ScoreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('artist')
            ->add('song')
            ->add('category', 'entity', array('class' => 'Sdt\ScoreBundle\Entity\ScoreCategory'))
            ->add('media', 'sonata_media_type', array('provider' => 'sonata.media.provider.file', 'context'  => 'default', 'required' => true))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sdt\ScoreBundle\Entity\Score'
        ));
    }

    public function getName()
    {
        return 'sdt_scorebundle_scoretype';
    }
}
