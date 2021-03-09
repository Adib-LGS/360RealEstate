<?php
namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class PropertyController extends AbstractController
{
    /**
     * @var PropertyRepository;
     */
    private $propertyRepository;

    public function __construct(PropertyRepository $propertyRepository) {
        $this->propertyRepository = $propertyRepository;
        
    }

    /**
     * @Route("/biens", name="property.index")
     * @return Response
     */
    public function index(PropertyRepository $propertyRepository): Response
    {
        /**dump($property);
        $this->om->flush();**/
        return $this->render('property/index.html.twig', [
            'current_menu' => 'properties' 
        ]);
    }   

    /**
     * @Route("/biens/{slug}-{id}", name="property.show", requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     */
    public function show ($slug, $id): Response
    {
        $property = $this->propertyRepository->find($id);
        
        return $this->render('property/show.html.twig', [
            'property' => $property,
            'current_menu' => 'properties',
        ]);
    }
}
