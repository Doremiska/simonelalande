<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AdminBundle\Form\AddressType;
use AdminBundle\Form\ImageType;

class AdvertType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',          TextType::class)
            ->add('dateStart',      DateType::class)
            ->add('dateEnd',        DateType::class, array('required' => false))
            ->add('timeStart',      TimeType::class, array('required' => false))
            ->add('timeEnd',        TimeType::class, array('required' => false))
            ->add('dateComplement', TextType::class, array('required' => false))
            ->add('content',        TextareaType::class, array('required' => false))
            ->add('isAtWork',       CheckboxType::class, array('required' => false))
            ->add('link',           UrlType::class, array('required' => false))
            ->add('phoneNumber',    TextType::class, array('required' => false))
            ->add('tariff',         IntegerType::class, array('required' => false))
            ->add('image',          ImageType::class, array('required' => false))
            ->add('address',        AddressType::class, array('required' => false))
            ->add('save',           SubmitType::class)
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'WebsiteBundle\Entity\Advert'
        ));
    }
}
