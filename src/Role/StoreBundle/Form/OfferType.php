<?php

namespace Role\StoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OfferType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('pricing')
            ->add('stockLimit')
            ->add('timeLimit')
            ->add('path')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Role\StoreBundle\Entity\Offer'
        ));
    }

    public function getName()
    {
        return 'role_storebundle_offertype';
    }
}
