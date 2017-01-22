<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template()
     */
    public function indexAction()
    {
        return [];
    }

    /**
     * @Route("/shows", name="shows")
     * @Template()
     * @Method({"GET"})
     */
    public function showsAction(Request $request)
    {
        $em = $this->get('doctrine')->getManager();
        $repo = $em->getRepository('AppBundle:TVShow');

        $paginator  = $this->get('knp_paginator');
        $showsQueryBuilder =$repo->findAllAsQueryBuilder();

        $pageOfShows = $paginator->paginate(
            $showsQueryBuilder,
            $request->query->getInt('page', 1),
            6
        );

        return [
            'shows' => $pageOfShows,
        ];
    }

    /**
     * @Route("/show/{id}", name="show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->get('doctrine')->getManager();
        $repo = $em->getRepository('AppBundle:TVShow');

        return [
            'show' => $repo->find($id)
        ];        
    }

    /**
     * @Route("/search", name="search")
     * @Template()
     * @Method("GET")
     */
    public function showsSearchAction(Request $request)
    {
        $em = $this->get('doctrine')->getManager();
        $repo = $em->getRepository('AppBundle:TVShow');
        $paginator  = $this->get('knp_paginator');
        $showsQueryBuilder = $repo->listAsQueryBuilderWhereNameIsLike($request->get('search'));

        $pageOfShows = $paginator->paginate(
            $showsQueryBuilder,
            $request->query->getInt('page', 1),
            6
        );

        return [
            'shows' => $pageOfShows,
        ];
    }

    /**
     * @Route("/calendar", name="calendar")
     * @Template()
     */
    public function calendarAction()
    {
        $em = $this->get('doctrine')->getManager();
        $repo = $em->getRepository('AppBundle:Episode');
        // dump($repo->nextDiffusions());
        return [
            'episodes' => $repo->nextDiffusions()
        ];
    }

    /**
     * @Route("/login", name="login")
     * @Template()
     */
    public function loginAction()
    {
        return [];
    }
}
