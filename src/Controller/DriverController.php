<?php

namespace App\Controller;

use App\Entity\Driver;
use App\Form\DriverFormType;
use App\Repository\DriverRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DriverController extends Controller
{
    /**
     * @var DriverRepository
     */
    private $driverRepository;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager, DriverRepository $driverRepository)
    {

        $this->driverRepository = $driverRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/driver/", name="driver")
     */
    public function index()
    {
        $drivers = $this->driverRepository->findAll();
        return $this->render('driver/index.html.twig', [
            'drivers' => $drivers,
        ]);
    }

    /**
     * @Route("/driver/create/", name="driver.create")
     */
    public function create(Request $request)
    {
        $driver = new Driver();
        return $this->handleForm($request, $driver);
    }

    /**
     * @Route("/driver/{id}/edit/", name="driver.edit")
     */
    public function edit(Request $request, $id)
    {
        $driver = $this->driverRepository>find($id);

        if($driver === null){
            throw $this->createNotFoundException("Task #$id does not exist");
        }

        return $this->handleForm($request, $driver);
    }

    /**
     * @Route("/driver/{id}/delete/", name="driver.delete")
     */
    public function delete(Request $request, $id)
    {
        $driver = $this->driverRepository->find($id);

        if($driver === null){
            throw $this->createNotFoundException("Task #$id does not exist");
        }

        $this->entityManager->remove($driver);
        $this->entityManager->flush();
        return $this->redirect('/driver');
    }

    /**
     * @param Request $request
     * @param $driver
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function handleForm(Request $request, $driver)
    {
        $form = $this->createForm(DriverFormType::class, $driver);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $this->entityManager->persist($data);
            $this->entityManager->flush();
            return $this->redirect('/driver');
        }

        return $this->render('driver/create.html.twig', [
            'form' => $form->createView()
        ]);
        exit;
    }
}
