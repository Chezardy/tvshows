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
    public function showsAction()
    {
        $em = $this->get('doctrine')->getManager();
        $repo = $em->getRepository('AppBundle:TVShow');

        return [
            'shows' => $repo->findAll()
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
     * @Template("AppBundle::Default/shows.html.twig")
     * @Method("GET")
     */
    public function searchShowAction(Request $request)
    {
        $em = $this->get('doctrine')->getManager();
        $repo = $em->getRepository('AppBundle:TVShow');
        /*return [
            'shows' => $repo->searchShowsLike($request->get('search'))
        ];*/
    }

    /**
     * @Route("/calendar", name="calendar")
     * @Template()
     */
    public function calendarAction()
    {
        return [];
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
