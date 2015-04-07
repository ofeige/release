<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Releases;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class ApiController extends Controller
{
    /**
     * @Route("/api")
     */
    public function indexAction()
    {
        $request = Request::createFromGlobals();

        $release = new Releases();
        $release->setVertical($request->request->get('vertical'));
        $release->setEnvironment($request->request->get('environment'));
        $release->setUser($request->request->get('user'));
        $release->setUrl($request->request->get('url'));
        $release->setCountry($request->request->get('country'));
        $release->setBranch($request->request->get('branch'));
        $release->setRevision($request->request->get('revision'));
        $release->setCluster($request->request->get('cluster'));

        $em = $this->getDoctrine()->getManager();
        $em->persist($release);
        $em->flush();

        return new Response('OK');
    }
}
