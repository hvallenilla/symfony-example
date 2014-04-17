<?php

namespace Acme\HelloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Acme\HelloBundle\Entity\Enquiry;
use Acme\HelloBundle\Form\EnquiryType;

class PageController extends Controller
{
    public function aboutAction()
    {
        return $this->render('AcmeHelloBundle:Page:about.html.twig');
    }

    public function contactAction()
    {
      $enquiry = new Enquiry();

      $form = $this->createForm(new EnquiryType(), $enquiry);

      $request = $this->getRequest();

      if ($request->getMethod() == 'POST') {
        $form->bindRequest($request);

        if ($form->isValid()) {
          $message = \Swift_Message::newInstance()
            ->setSubject('Contact enquiry from AcmeBlog')
            ->setFrom('robert.g.lyall@gmail.com')
            ->setTo($this->container->getParameter('acme_hello.emails.contact_email'))
            ->setBody($this->renderView('AcmeHelloBundle:Page:contactEmail.txt.twig', array('enquiry' => $enquiry)));

          $this->get('mailer')->send($message);

          $this->get('session')->setFlash('acme-blog-notice', 'Your contact enquiry was successfully sent. Thank you!');

          return $this->redirect($this->generateUrl('acme_hello_contact'));
        }
      }

      return $this->render('AcmeHelloBundle:Page:contact.html.twig', array(
        'form' => $form->createView()
      ));
    }
}
