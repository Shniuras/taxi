<?php

namespace App\Controller;

use App\Entity\Clients;
use App\Form\ClientsFormType;
use App\Repository\ClientsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ClientController extends Controller
{
    /**
     * @var ClientsRepository
     */
    private $clientsRepository;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(ClientsRepository $clientsRepository, EntityManagerInterface $entityManager)
    {
        $this->clientsRepository = $clientsRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/client/", name="client")
     */
    public function index()
    {
        $clients = $this->clientsRepository->findAll();
        return $this->render('client/index.html.twig', [
            'clients' => $clients,
        ]);
    }


    /**
     * @Route("/client/create/", name="client.create")
     */
    public function create(Request $request)
    {
        $clients = new Clients();
        return $this->handleForm($request, $clients);
    }

    /**
     * @Route("/client/{id}/edit/", name="client.edit")
     */
    public function edit(Request $request, $id)
    {
        $clients = $this->clientsRepository>find($id);

        if($clients === null){
            throw $this->createNotFoundException("Task #$id does not exist");
        }

        return $this->handleForm($request, $clients);
    }

    /**
     * @Route("/client/{id}/delete/", name="client.delete")
     */
    public function delete(Request $request, $id)
    {
        $clients = $this->clientsRepository->find($id);

        if($clients === null){
            throw $this->createNotFoundException("Task #$id does not exist");
        }

        $this->entityManager->remove($clients);
        $this->entityManager->flush();
        return $this->redirect('/client');
    }

    /**
     * @param Request $request
     * @param $clients
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function handleForm(Request $request, $clients)
    {
        $form = $this->createForm(ClientsFormType::class, $clients);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $this->entityManager->persist($data);
            $this->entityManager->flush();
            return $this->redirect('/client');
        }

        return $this->render('client/create.html.twig', [
            'form' => $form->createView()
        ]);
        exit;
    }
}
