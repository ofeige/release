<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends Controller
{
    /**
     * @Route("/release", name="dashboard")
     * @Method("GET")
     * @Security("has_role('ROLE_USER')")
     * @return Response
     */
    public function indexAction()
    {
        return $this->withenvironmentAction('live');
    }

    /**
     * @Route("/release/{choosenenv}", name="dashboardenv")
     * @Method("GET")
     * @Security("has_role('ROLE_USER')")
     * @return Response
     */
    public function withenvironmentAction($choosenenv)
    {
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Releases');

        $query = $repository->createQueryBuilder('p')
            ->where('p.vertical=:vertical')
            ->setParameter('vertical', 'INTRES')
            ->groupBy('p.environment')
            ->getQuery();
        $environments = $query->getResult();

        $releases = array();
        foreach ($environments as $environment) {
            $env[] = $environment->getEnvironment();
        }

        $query = $repository->createQueryBuilder('p');
        $query
            ->where(
                $query->expr()->andX(

                    $query->expr()->eq('p.vertical', ':vertical'),
                    $query->expr()->eq('p.environment', ':environment')
                )
            )
            ->andWhere('p.createdAt = (
                    select max(r2.createdAt) from AppBundle:Releases r2
                    where
                        p.country = r2.country and
                        p.vertical = r2.vertical and
                        p.environment=r2.environment
                    )')
            ->setParameters([
                'vertical' => 'INTRES',
                'environment' => $choosenenv])
            ->orderBy('p.createdAt', 'DESC')
            ->groupBy('p.country');

        $releases[$choosenenv] = $query->getQuery()->getResult();

        return $this->render('default/dashboard.html.twig', array(
            'releases' => $releases,
            'choosen_env' => $choosenenv,
            'environments' => $env
        ));
    }

    /**
     * @Route("/release/history/{choosenenv}/{country}", name="dashboardhistory")
     * @Method("GET")
     * @Security("has_role('ROLE_USER')")
     * @return Response
     */
    public function historyAction($choosenenv, $country)
    {
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Releases');

        $query = $repository->createQueryBuilder('p')
            ->where('p.vertical=:vertical')
            ->andWhere('p.country=:country')
            ->andWhere('p.environment=:environment')
            ->setParameters([
                'vertical' => 'INTRES',
                'country' => $country,
                'environment' => $choosenenv
            ])
            ->orderBy('p.createdAt', 'DESC')
            ->getQuery();

        $releases = $query->getResult();

        return $this->render('default/dashboard_history.html.twig', array(
            'releases' => $releases,
            'environment' => $choosenenv,
            'country' => $country
        ));
    }
}
