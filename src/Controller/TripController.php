<?php

namespace App\Controller;

use App\Entity\Trip;
use App\Form\TripFormType;
use App\Repository\TripRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TripController extends Controller
{
    /**
     * @var TripRepository
     */
    private $tripRepository;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(TripRepository $tripRepository, EntityManagerInterface $entityManager)
    {
        $this->tripRepository = $tripRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/trip/", name="trip")
     */
    public function index()
    {
        $trips = $this->tripRepository->findAll();
        return $this->render('trip/index.html.twig', [
            'trips' => $trips,
        ]);
    }

    /**
     * @Route("/trip/create/", name="trip.create")
     */
    public function create(Request $request)
    {
        $trips = new Trip();
        return $this->handleForm($request, $trips);
    }

    /**
     * @Route("/trip/{id}/edit/", name="trip.edit")
     */
    public function edit(Request $request, $id)
    {
        $trips = $this->tripRepository>find($id);

        if($trips === null){
            throw $this->createNotFoundException("Task #$id does not exist");
        }

        return $this->handleForm($request, $trips);
    }

    /**
     * @Route("/trip/{id}/delete/", name="trip.delete")
     */
    public function delete(Request $request, $id)
    {
        $trips = $this->tripRepository->find($id);

        if($trips === null){
            throw $this->createNotFoundException("Task #$id does not exist");
        }

        $this->entityManager->remove($trips);
        $this->entityManager->flush();
        return $this->redirect('/trip');
    }

    /**
     * @param Request $request
     * @param $trips
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function handleForm(Request $request, $trips)
    {
        $form = $this->createForm(TripFormType::class, $trips);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $this->entityManager->persist($data);
            $this->entityManager->flush();
            return $this->redirect('/trip');
        }

        return $this->render('trip/create.html.twig', [
            'form' => $form->createView()
        ]);
        exit;
    }
}
