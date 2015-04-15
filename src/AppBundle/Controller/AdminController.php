<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin")
     * @Security("has_role('ROLE_ADMIN')")
     * @return Response
     */
    public function index()
    {
        return $this->render('default/index.html.twig');
    }


    /**
     * @Route("/admin/info", name="admin_info")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function info()
    {
        return $this->render('default/index.html.twig');

    }
}