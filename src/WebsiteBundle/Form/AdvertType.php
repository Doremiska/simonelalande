<?php

namespace WebsiteBundle\Form;

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
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use WebsiteBundle\Form\AddressType;
use WebsiteBundle\Form\ImageType;

class AdvertType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',              TextType::class)
            ->add('categories',         EntityType::class, array(
                'class' => 'WebsiteBundle:Category',
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true
            ))
            ->add('toComeUp',           CheckboxType::class, array('required' => false))
            ->add('dateStart',          DateType::class, array(
                'invalid_message' => "La date n'est pas valide."
            ))
            ->add('dateEnd',            DateType::class, array(
                'required' => false,
                'invalid_message' => "La date n'est pas valide."
            ))
            ->add('timeStart',          TimeType::class, array(
                'required' => false,
                'invalid_message' => "L'heure n'est pas valide."
            ))
            ->add('timeEnd',            TimeType::class, array(
                'required' => false,
                'invalid_message' => "L'heure n'est pas valide."
            ))
            ->add('dateComplement',     TextType::class, array('required' => false))
            ->add('content',            TextareaType::class, array('required' => false))
            ->add('isAtWork',           CheckboxType::class, array('required' => false))
            ->add('link',               UrlType::class, array('required' => false))
            ->add('tariff',             TextType::class, array('required' => false))
            ->add('tariffReservation',  TextType::class, array('required' => false))
            ->add('animatedBy',         TextType::class, array('required' => false))
            ->add('fonction',           TextType::class, array('required' => false))
            ->add('phoneNumber',        TextType::class, array('required' => false))
            ->add('image',              ImageType::class, array('required' => false))
            ->add('address',            AddressType::class, array('required' => false))
            ->add('save',               SubmitType::class)
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
