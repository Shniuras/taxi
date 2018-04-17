<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarFormType;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CarController extends Controller
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var CarRepository
     */
    private $carRepository;

    public function __construct(CarRepository $carRepository, EntityManagerInterface $entityManager)
    {

        $this->entityManager = $entityManager;
        $this->carRepository = $carRepository;
    }

    /**
     * @Route("/car/", name="car")
     */
    public function index()
    {
        $cars = $this->carRepository->findAll();
        return $this->render('car/index.html.twig', [
            'cars' => $cars,
        ]);
    }

    /**
     * @Route("/car/create/", name="car.create")
     */
    public function create(Request $request)
    {
        $car = new Car();
        return $this->handleForm($request, $car);
    }

    /**
     * @Route("/car/{id}/edit/", name="car.edit")
     */
    public function edit(Request $request, $id)
    {
        $car = $this->carRepository>find($id);

        if($car === null){
            throw $this->createNotFoundException("Task #$id does not exist");
        }

        return $this->handleForm($request, $car);
    }

    /**
     * @Route("/car/{id}/delete/", name="car.delete")
     */
    public function delete(Request $request, $id)
    {
        $car = $this->carRepository->find($id);

        if($car === null){
            throw $this->createNotFoundException("Task #$id does not exist");
        }

        $this->entityManager->remove($car);
        $this->entityManager->flush();
        return $this->redirect('/car');
    }

    /**
     * @param Request $request
     * @param $car
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function handleForm(Request $request, $car)
    {
        $form = $this->createForm(CarFormType::class, $car);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $this->entityManager->persist($data);
            $this->entityManager->flush();
            return $this->redirect('/car');
        }

        return $this->render('car/create.html.twig', [
            'form' => $form->createView()
        ]);
        exit;
    }
}
