<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\Driver;
use App\Repository\DriverRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarFormType extends AbstractType
{
    /**
     * @var DriverRepository
     */
    private $driverRepository;

    public function __construct(DriverRepository $driverRepository)
    {

        $this->driverRepository = $driverRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('make')
            ->add('model')
            ->add('type')
            ->add('drivers', EntityType::class, array(
                'multiple' => true,
                'class' => Driver::class,
                'choices' => $this->driverRepository->findAll(),
                'choice_label' => 'name'
                ))
            ->add('save', SubmitType::class, array(
                'label' => 'Create Car'
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}
