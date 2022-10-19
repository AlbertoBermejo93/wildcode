<?php

namespace App\Controller;

use App\Entity\Equipage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class EquipageController extends AbstractController
{
    
    private $registryManager;

    public function __construct(ManagerRegistry $registryManager, )
    {
        $this->registryManager = $registryManager;
    }

    #[Route('/equipage/ajax', name: 'ajax_equipage')]
    public function addMember()
    {
     
        if(isset($_POST['nom'])){

            $nomMember = $_POST['nom'];
            $entityManager = $this->registryManager->getManager();

            $equipage = new Equipage();
            $equipage->setNom($nomMember);

            $entityManager->persist($equipage);
            $entityManager->flush();
        }
       
       $json = json_encode(array('data' => 'OK'), JSON_UNESCAPED_UNICODE);
        return new JsonResponse($json);
    }

    #[Route('/equipage/list', name: 'list_equipage')]
    public function listEquipage(): Response
    {
        $repository = $this->registryManager->getManager()->getRepository(Equipage::class);

        $equipages = $repository->findBy(array(), array('id' => 'DESC'));

        return $this->render('equipage/index.html.twig', [
            'controller_name' => 'EquipageController',
            'equipages'=> $equipages,
        ]);
    }

    
}
