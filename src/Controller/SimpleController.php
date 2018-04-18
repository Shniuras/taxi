<?php

namespace App\Controller;

use App\Entity\FileStorage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SimpleController extends Controller
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {

        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/file/")
     */
    public function attachment(Request $request)
    {
        $fileAttached = new FileStorage();
        $form = $this->createFormBuilder($fileAttached)
            ->add('file', FileType::class)
            ->add('submit', SubmitType::class)
            ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            /** @var FileStorage $data */
            $data = $form->getData();
            /** @var \Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $data->getFile();
            $filename = md5(uniqid()) . '.' . $file->guessClientExtension();
            $file->move(
                $this->getParameter('file_folder'),
                $filename
            );

            $data->setFile($filename);

            $this->entityManager->persist($data);
            $this->entityManager->flush();
        }
        return $this->render('file/index.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/simple", name="simple")
     */
    public function index()
    {
        return $this->render('simple/index.html.twig');
    }
}
