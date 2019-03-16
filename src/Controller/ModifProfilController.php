<?php

namespace App\Controller;

use App\Form\ModifProfilType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Utilisateur;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\Request;


class ModifProfilController extends AbstractController
{
    /**
     * @Route("/modifprofil", name="modif_profil")
     */
    public function index(Request $request, UserInterface $user, UserPasswordEncoderInterface $passwordEncoder)
    {
        $currentUser= $user->getId();

        $em = $this->getDoctrine()->getManager ();
        $result = $em->getRepository ( Utilisateur::class)->findById($currentUser);

        $form = $this->createForm(ModifProfilType::class, $result[0]);
        $form->handleRequest($request);

        if ($request->getMethod() == 'POST') {

            if ($form->isValid()) {
                // perform some action, such as save the object to the database
                // encode the plain password
                if ($form->get('plainPassword')->getData() != "dummypass") {
                    $result[0]->setMdp(
                    $passwordEncoder->encodePassword(
                        $result[0],
                        $form->get('plainPassword')->getData()
                    )
                );
                }

                $prive= $form->get('prive')->getData();
                $result[0]->setPrive($prive);
                $currentDateTime = new \DateTime();
                $result[0]->setDateCreation($currentDateTime);

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($result[0]);
                $entityManager->flush();

                return $this->redirectToRoute('profil', array('id' => $currentUser));
            }
        }

        return $this->render('modif_profil/modif.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
