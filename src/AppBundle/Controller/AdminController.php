<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Role;
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
    public function adminAction()
    {
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:User');

        $results = $repository->createQueryBuilder('u')
          ->getQuery()
            ->getResult();

        return $this->render('default/admin.html.twig', array(
            'headline' => 'User Admin',
            'table' => $results
        ));
    }

    /**
     * @Route("/admin/toggle/user/{id}", name="toggleUser")
     * @Security("has_role('ROLE_ADMIN')")
     * @return Response
     */
    public function toggleUserAction($id)
    {
        $this->toggle($id, 'ROLE_USER');

        return $this->redirectToRoute('admin');
    }

    /**
     * @Route("/admin/toggle/admin/{id}", name="toggleAdmin")
     * @Security("has_role('ROLE_ADMIN')")
     * @return Response
     */
    public function toggleAdminAction($id)
    {
        $this->toggle($id, 'ROLE_ADMIN');

        return $this->redirectToRoute('admin');

    }

    protected function toggle($id, $toggleRole)
    {
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:User');

        $user = $repository->find($id);

        $isAdmin = false;
        foreach ($user->getRoles() as $role) {
            if ($role->getRole() == $toggleRole) {
                $isAdmin = true;
            }
        }

        if ($isAdmin === false) {
            $repository = $this->getDoctrine()
                ->getRepository('AppBundle:Role');

            $role = $repository->findOneBy(array('role' => $toggleRole));
            $user->addRole($role);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        } else {
            $repository = $this->getDoctrine()
                ->getRepository('AppBundle:Role');

            $role = $repository->findOneBy(array('role' => $toggleRole));
            $user->removeRole($role);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        }
    }

    /**
     * @Route("/admin/info", name="admin_info")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function infoAction()
    {
        return $this->render('default/value.html.twig', array(
            'headline' => 'PHP Info',
            'content' => $this->phpinfoWithoutstyle()
        ));
    }

    protected function phpinfoWithoutstyle()
    {
        ob_start();
        phpinfo();
        $pinfo = ob_get_contents();
        ob_end_clean();
        $pinfo = preg_replace('%^.*<body>(.*)</body>.*$%ms', '$1', $pinfo);
        $pinfo = str_replace('<table>', '<table class="table table-striped table-hover table-bordered">', $pinfo);

        return $pinfo;
    }
}