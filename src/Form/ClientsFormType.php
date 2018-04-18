<?php

namespace App\Form;

use App\Entity\Clients;
use App\Entity\Trip;
use App\Repository\TripRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientsFormType extends AbstractType
{
    /**
     * @var TripRepository
     */
    private $tripRepository;

    public function __construct(TripRepository $tripRepository)
    {

        $this->tripRepository = $tripRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('gender')
            ->add('trips', EntityType::class, array(
                'class' => Trip::class,
                'choices' => $this->tripRepository->findAll(),
                'choice_label' => 'id'
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Create Client'
            ));
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Clients::class,
        ]);
    }
}
