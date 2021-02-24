<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Todo;
use App\Form\TodoType;
use Symfony\Component\HttpFoundation\Request;

class CompteController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @IsGranted("ROLE_USER")
    */

    /**
     * @Route("/compte", name="compte")
     * @IsGranted("ROLE_USER")
     */
    public function index(Request $request): Response
    {
        $todos = $this->getDoctrine()->getRepository(Todo::class)->findBy([], ['id' => 'ASC']);
        return $this->render('compte/index.html.twig', ['todos'=>$todos]);
    }

    /**
     * 
     * @Route("/create", name="create_task", methods={"POST"})
     * 
    */

    public function create(Request $request)
    {
        $name = trim($request -> request -> get('title'));

        if(empty($name))
        return $this->redirectToRoute('home');
        

        $em = $this->getDoctrine()->getManager();

        $todo = new Todo;
        $todo->setName($name);

        $em->persist($todo);
        $em->flush();

        return $this->redirectToRoute('compte');
    }

    /**
     * 
     * @Route("/switch-status/{id}", name="switch_status")
     * 
    */

    public function switchStatus($id)
    {
        $em = $this->getDoctrine()->getManager();
        $todo = $em->getRepository(Todo::class)->find($id);

        $todo->setStatus(! $todo-> getStatus());
        $em->flush();
        return $this->redirectToRoute('compte');
    }

    /**
     * 
     * @Route("/delete-todo/{id}", name="todo_delete")
     * 
    */

    public function deleteTodo(Todo $id)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($id);
        $em->flush();
        return $this->redirectToRoute('compte');
    }
}
