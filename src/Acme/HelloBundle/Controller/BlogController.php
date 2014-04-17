<?php

namespace Acme\HelloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlogController extends Controller
{
  public function showAction($id)
  {
    $em = $this->getDoctrine()->getEntityManager();

    $blog = $em->getRepository('AcmeHelloBundle:Blog')->find($id);

    if (!$blog) {
      throw $this->createNotFoundException('Unable to find Blog post.');
    }

    return $this->render('AcmeHelloBundle:Blog:show.html.twig', array(
      'blog' => $blog,
    ));
  }
}
