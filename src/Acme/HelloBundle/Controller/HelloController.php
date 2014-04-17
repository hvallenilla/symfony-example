<?php

namespace Acme\HelloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Acme\HelloBundle\Entity\Blog;

class HelloController extends Controller
{
  public function indexAction()
  {
    $em = $this->getDoctrine()
               ->getEntityManager();

    $blogs = $em->createQueryBuilder()
                ->select('b')
                ->from('AcmeHelloBundle:Blog', 'b')
                ->addOrderBy('b.created', 'DESC')
                ->getQuery()
                ->getResult();

    return $this->render('AcmeHelloBundle:Default:index.html.twig', array(
      'blogs' => $blogs
    ));
  }
}
