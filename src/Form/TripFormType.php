<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\Driver;
use App\Entity\Trip;
use App\Repository\CarRepository;
use App\Repository\DriverRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TripFormType extends AbstractType
{
    /**
     * @var CarRepository
     */
    private $carRepository;
    /**
     * @var DriverRepository
     */
    private $driverRepository;

    /**
     * TripFormType constructor.
     * @param CarRepository $carRepository
     * @param DriverRepository $driverRepository
     */
    public function __construct(CarRepository $carRepository, DriverRepository $driverRepository)
    {

        $this->carRepository = $carRepository;
        $this->driverRepository = $driverRepository;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('length')
            ->add('duration')
            ->add('cost')
            ->add('car', EntityType::class, array(
                'class' => Car::class,
                'choices' => $this->carRepository->findAll(),
                'choice_label' => 'model'
            ))
            ->add('driver', EntityType::class, array(
                'class' => Driver::class,
                'choices' => $this->driverRepository->findAll(),
                'choice_label' => 'name'
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Create Trip'
            ));
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Trip::class,
        ]);
    }
}
