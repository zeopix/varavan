<?php

namespace Role\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as RegistrationType;
class StoreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('publicName')
            ->add('legalName')
            ->add('slugName')
            ->add('user', new RegistrationType('Core\UserBundle\Entity\User'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Role\StoreBundle\Entity\Store'
        ));
    }

    public function getName()
    {
        return 'role_storebundle_storetype';
    }
}
