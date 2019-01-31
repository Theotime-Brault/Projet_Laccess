<?php

namespace Lacces\LaccesBundle\Controller;


use Lacces\LaccesBundle\Entity\wordFr;
use Lacces\LaccesBundle\Entity\wordEn;
use Lacces\LaccesBundle\Repository\wordFrRepository;
use Lacces\LaccesBundle\Repository\wordEnRepository;
use Lacces\LaccesBundle\Entity\Form;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\Constraints\Email;


class DefaultController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('@Lacces/Default/index.html.twig', [
          'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @param $word
     * @param $langue
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function wordAction($word, $langue)
    {
        $em = $this->getDoctrine()->getManager();

        if($langue == "fr"){
          $objWord = $em->getRepository('LaccesBundle:wordFr')->findByWord($word);
        }else if($langue == "en"){
          $objWord = $em->getRepository('LaccesBundle:wordEn')->findByWord($word);
        }else{
          $this->redirectToRoute('');
        }

        if(!$objWord){
          throw $this->createNotFoundException('Cette page n éxiste pas');
        }

        return $this->render('@Lacces/Words/word.html.twig', array(
            'word' => $objWord,
            'langue' => $langue,
          ));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function searchBarreAction()
    {
        return $this->render('@Lacces/SearchBarre/searchBarre.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function signaireFrAction()
    {
        $em = $this->getDoctrine()->getManager();
        $wordsFrObj = $em->getRepository('LaccesBundle:wordFr')->findAll();

        return $this->render('@Lacces/Signaires/signaireFr.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'wordFr' => $wordsFrObj,
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function signaireEnAction()
    {
        $em = $this->getDoctrine()->getManager();
        $wordsEnObj = $em->getRepository('LaccesBundle:wordEn')->findAll();

        return $this->render('@Lacces/Signaires/signaireEn.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'wordEn' => $wordsEnObj,
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function mentionsAction()
    {
        return $this->render('@Lacces/Mentions_legales/mentions.html.twig');
    }

    public function faqAction()
    {
        return $this->render('@Lacces/FAQ/faq.html.twig');
    }

    /**
     * @return JsonResponse
     */
    public function autoCompleteAction(Request $request){

        $em = $this->getDoctrine()->getManager();
        $l = $request->request->get('l');
        $word = $request->request->get('word');
        if($l == "fr"){
            $words = $em->getRepository('LaccesBundle:wordFr')->findByPopularity($word."%");
        }elseif($l == "en"){
            $words = $em->getRepository('LaccesBundle:wordEn')->findByPopularity($word."%");
        }else{
            $words = null;
        }

/*
        if($word && $l == "fr"){
            $wordsFr = $em->getRepository('LaccesBundle:wordFr')->findByPopularity($word."%");
            dump($wordsFr);
            for ($i=0; $i<sizeof($wordsFr); $i++){
                $wordsEn[$i] = $wordsFr[$i]->getWordEns();
            }
        }else if($word && $l == "en"){
            $wordsEn = $em->getRepository('LaccesBundle:wordEn')->findByPopularity($word."%");
            for ($i=0; $i<sizeof($wordsEn); $i++){
                $wordsFr[$i] = $wordsEn[$i]->getWordFrs();
            }
        }else{
            $wordsFr = null;
            $wordsEn = null;
        }
*/
        return new JsonResponse(array('words'=>$words));
        //return new JsonResponse(array('wordsFr'=>$wordsFr, 'wordsEn'=>$wordsEn));
    }

    public function exercicesAction()
    {
        return $this->render('@Lacces/Exercices/exercices.html.twig');
    }
}
