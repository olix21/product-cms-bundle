<?php

namespace Dywee\ProductCMSBundle\Form;

use Dywee\ProductBundle\Entity\BaseProduct;
use Dywee\ProductCMSBundle\Entity\ProductElement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductElementType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('product', EntityType::class, array(
                'class'         => BaseProduct::class,
                'choice_label'  => 'name',
                'required'      => true
            ))
            ->add('displayOrder')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => ProductElement::class
        ));
    }
}
