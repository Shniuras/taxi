<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\Driver;
use App\Repository\CarRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DriverFormType extends AbstractType
{
    /**
     * @var CarRepository
     */
    private $carRepository;

    public function __construct(CarRepository $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('license')
            ->add('age')
            ->add('cars', EntityType::class, array(
                    'by_reference' => false,
                    'multiple' => true,
                    'class' => Car::class,
                    'choices' => $this->carRepository->findAll(),
                    'choice_label' => 'model'
                ))
            ->add('save', SubmitType::class, array(
                'label' => 'Create Driver'
                ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Driver::class,
        ]);
    }
}
