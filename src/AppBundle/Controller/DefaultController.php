<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\Type\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="welcome")
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/random/{limit}", name="random")
     */
    public function randomAction($limit)
    {
        return $this->render('default/value.html.twig', array(
            'value' => rand(1, $limit)
        ));
    }

    /**
     * @Route("/signup")
     */
    public function signup(Request $request)
    {
        $user = new User();
        $user->setEmail('please enter your email');
        $user->setUsername('please enter your username');

        $form = $this->createForm(new UserType(), $user);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('success');
        }

        return $this->render('default/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/signup/success", name="success")
     */
    public function success()
    {
        return $this->render('default/value.html.twig', array(
            'value' => 'successfull registered'
        ));
    }
}
