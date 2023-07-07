<?php

namespace App\Controller;

use App\Entity\Registration;
use App\Repository\ChildRepository;
use App\Repository\MenuRepository;
use App\Repository\RegistrationRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/registration')]
class RegistrationController extends AbstractController
{
    #[Route('/', name: 'app_registration')]
    public function index(
        ChildRepository $childRepository
    ): Response {
        $child = $childRepository->findBy(['user' => $this->getUser()]);

        return $this->render('registration/index.html.twig', [
            'childs' => $child,
        ]);
    }

    #[Route('/calcul', name: 'app_registration_calcul')]
    public function calcul(
        Request $request,
        ChildRepository $childRepository,
        MenuRepository $menuRepository,
    ): Response {
        $totalCommand = 0;
        $priceMenu = $menuRepository->findOneById(1);
        $tabChild = [];

        $data = $request->request;
        foreach ($data as $key => $val) {
            $price = 0;
            $tabDay = [];

            $childId = str_replace('day_child_', '', $key);
            $child = $childRepository->findOneById($childId);

            foreach ($val as $row) {
                $price = $price + $priceMenu->getPrice();
                $tabDay[] = $row;
            }

            $tabChild[] = [
                'child' => $child,
                'price' => $price,
                'day' => $tabDay
            ];

            $totalCommand = $totalCommand + $price;
        }

        //on passe l'objet en session pour enregistrer dans l'etape suivante
        $session = $request->getSession();
        $session->set('cmd', $tabChild);

        return $this->render('registration/calcul.html.twig', [
            'tabChild' => $tabChild,
            'totalCommand' => $totalCommand
        ]);
    }

    #[Route('/save', name: 'app_registration_save')]
    public function savecmd(
        Request $request,
        ChildRepository $childRepository,
        MenuRepository $menuRepository,
        RegistrationRepository $registrationRepository
    ): Response {
        $session = $request->getSession();
        $obj = $session->get('cmd');

        foreach ($obj as $child) {

            $objChild = $child['child'];
            $objChild = $childRepository->findOneById($objChild->getId());

            foreach ($child['day'] as $day) {
                $date = explode('/', $day);
                $newDate = new DateTime($date[2].'-'.$date[1].'-'.$date[0]);

                $registration = $registrationRepository->findOneByDate($newDate);

                if(empty($registration)){
                    $registration = new Registration();
                    $registration->setDate($newDate);
                    $registrationRepository->save($registration, true);
                }

                $objChild->addRegistration($registration);
            }
            $childRepository->save($objChild, true);
        }

        return $this->render('registration/save.html.twig', []);
    }
}
