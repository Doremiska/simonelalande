<?php

namespace WebsiteBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

class ContactType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('objet',   TextType::class, array(
                'constraints' => array(
                    new NotBlank(array('message' => 'Vous devez remplir ce champ.')),
                    new Length(array('max' => 255, 'maxMessage' => 'Ce champ ne peut pas excéder {{ limit }} caractères.'))
                )
            ))
            ->add('contenu', TextareaType::class, array(
                'constraints' => array(
                    new NotBlank(array('message' => 'Vous devez remplir ce champ.')),
                    new Length(array('min' => 10, 'minMessage' => 'Votre message est trop court.'))
                )
            ))
            ->add('email',   EmailType::class, array(
                'constraints' => array(
                    new NotBlank(array('message' => 'Vous devez remplir ce champ.')),
                    new Email(array('message' => 'Veuillez rentrer un email valide.'))
                )
            ))
            ->add('nom',     TextType::class, array(
                'constraints' => array(
                    new NotBlank(array('message' => 'Vous devez remplir ce champ.')),
                    new Length(array('max' => 255, 'maxMessage' => 'Ce champ ne peut pas excéder {{ limit }} caractères.'))
                )
            ))
            ->add('prenom',  TextType::class, array(
                'constraints' => array(
                    new NotBlank(array('message' => 'Vous devez remplir ce champ.')),
                    new Length(array('max' => 255, 'maxMessage' => 'Ce champ ne peut pas excéder {{ limit }} caractères.'))
                )
            ))
            ->add('envoyer', SubmitType::class)
        ;
    }
}
