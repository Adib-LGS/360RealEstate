<?php
namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class PropertyController extends AbstractController
{
    /**
     * @var PropertyRepository;
     */
    private $propertyRepository;

    public function __construct(PropertyRepository $propertyRepository, ObjectManager $om) {
        $this->propertyRepository = $propertyRepository;
        $this->om = $om;
    }

    /**
     * @Route("/biens", name="property.index")
     * @return Response
     */
    public function index(PropertyRepository $propertyRepository): Response
    {

        $property = $this->propertyRepository->findAllUnsoldedHome();
        dump($property);
        $this->om->flush();
        return $this->render('property/index.html.twig', [
            'current_menu' => 'properties' 
        ]);
    }   
}
