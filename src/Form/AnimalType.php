<?php

namespace App\Form;

use App\Entity\Animal;
use App\Entity\AnimalKinds;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnimalType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('kindName', ChoiceType::class, [
        'label' => 'Тип животного',
        'label_attr' => [
          'class' => 'control-label'
        ],
        'attr' => [
          'class' => 'form-control form-control-sm custom-select'
        ],
        'required' => true,
        'choices' => [
          'Кошки'     => AnimalKinds::CATS,
          'Собаки'    => AnimalKinds::DOGS,
          'Черепахи'  => AnimalKinds::TURTLES
        ]
      ])
      ->add('sobriquet', TextType::class, [
        'label' => 'Кличка',
        'label_attr' => [
          'class' => 'control-label'
        ],
        'required' => true,
        'attr' => [
          'class' => 'form-control form-control-sm',
          'placeholder' => 'Укажите кличку'
        ]
      ])
      ->add('dateOfPlacement', DateType::class, [
        'label' => 'Дата размещения',
        'label_attr' => [
          'class' => 'control-label'
        ],
        'required' => true,
        'widget' => 'single_text',
        'attr' => [
          'class' => 'form-control form-control-sm',
          'data-toggle' => 'datepicker',
          'placeholder' => 'Укажите дату размещения'
        ]
      ])
    ;

    $builder
      ->add('submit', SubmitType::class, [
        'label' => 'Сохранить',
        'attr' => [
          'class' => 'btn btn-sm btn-primary mx-auto',
          'style' => 'display: block;'
        ]
      ])
    ;
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
      'data_class' => Animal::class,
    ]);
  }
}
