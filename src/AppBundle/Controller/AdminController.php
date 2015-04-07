<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class AdminController extends Controller
{
    /**
     * @Route("/admin")
     * @Security("has_role('ROLE_ADMIN')")
     * @return Response
     */
    public function index()
    {
        return $this->render('default/value.html.twig', array(
            'value' => 'Admin Page!'
        ));
    }


    /**
     * @Route("/admin/info", name="info")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function info()
    {


        phpinfo();

        return new Response(
            '<html><body></body></html>'
        );
    }
}