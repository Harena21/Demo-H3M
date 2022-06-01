<?php

namespace App\Controller;

use App\Entity\Employee;

use App\Form\EmployeeType;

use App\Repository\EmployeeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\User\UserInterface;

class EmployeeController extends AbstractController
{
   /**
     * @Route("/admin_employee", name="admin_employee")
     */
    public function index(EmployeeRepository $repo): Response
    {
        $employees = $repo->findAll();
        return $this->render('admin_employee/index.html.twig', [
            'employees' => $employees,
        ]);
    }
    // /**
    //  * @Route("/admin/edit/{id}", name="admin_employee_edit")
    //  */
    // public function edit(Article $article)
    // {
    //     $form = $this->createForm(ArticleType::class,$article);
    //     $form->handleRequest($this->request);

    //     if($form->isSubmitted() && $form->isValid()) 
    //     {
    //         $this->em->flush();
    //         return $this->redirectToRoute('admin_article');
    //     }
    //     return $this->render('admin_article/edit.html.twig',[
    //         'form' => $form->createView(),
    //     ]);
    // }

    /**
    * @Route("/admin_employee/create",name="admin_employee_create")
    * @Route("/admin_employee/edit/{id}",name="admin_employee_edit")
    * @IsGranted("ROLE_ADMIN")
    */
    public function form(?Employee $employee,Request $request,EntityManagerInterface $manager,?UserInterface $user)
    {
        if(!$employee)
        {
            $employee = new Employee();
        }
        $form = $this->createForm(EmployeeType::class,$employee);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            if(!$employee->getId())
            {
                // $employee->setCreatedAt(new \DateTime());
                $this->addFlash('success',"Employé créé avec succès");
                if($employee->getGroupes() === 'Manoeuvre')
                {
                    $employee->setSalaire(7000);
                }
                else if($employee->getGroupes() === 'Ouvrier')
                {
                    $employee->setSalaire(15000);
                }
                else if($employee->getGroupes() === 'Chef de chantier')
                {
                    $employee->setSalaire(20000);
                }
                else
                {
                    $employee->setSalaire(5000);
                }

            }
            else
            {
                $this->addFlash('success',"Employé modifié avec succès");
                if($user->getUsername() === 'Lanto')
                {
                    $status = [];
                    if($employee->getMonday()) $status[] = 2;
                    else $status[] = 0;

                    if($employee->getTuesday()) $status[] = 2;
                    else $status[] = 0;

                    if($employee->getWednesday()) $status[] = 2;
                    else $status[] = 0;

                    if($employee->getThursday()) $status[] = 2;
                    else $status[] = 0;

                    if($employee->getFriday()) $status[] = 2;
                    else $status[] = 0;

                    if($employee->getSaturday()) $status[] = 2;
                    else $status[] = 0;

                    $employee->setStatus($status);
                }
                else
                {
                    $status = [];
                    if($employee->getMonday()) $status[] = 1;
                    else $status[] = 0;

                    if($employee->getTuesday()) $status[] = 1;
                    else $status[] = 0;

                    if($employee->getWednesday()) $status[] = 1;
                    else $status[] = 0;

                    if($employee->getThursday()) $status[] = 1;
                    else $status[] = 0;

                    if($employee->getFriday()) $status[] = 1;
                    else $status[] = 0;

                    if($employee->getSaturday()) $status[] = 1;
                    else $status[] = 0;

                    $employee->setStatus($status);
                }
            }
            $manager->persist($employee);
            $manager->flush();

            return $this->redirectToRoute("admin_employee");
        }
        return $this->render('admin_employee/form.html.twig',[
            'form' => $form->createView(),
            'employee' => $employee,
            'editForm' => $employee->getId() !== null
        ]);    
    }
    /**
     * @Route("admin_employee/delete/{id}", name="admin_employee_delete",methods="DELETE")
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Employee $employee,Request $request,EntityManagerInterface $em)
    {
        if($this->isCsrfTokenValid('delete' . $employee->getId(),$request->get('_token')))
        {
            $em->remove($employee);
            $em->flush();
            $this->addFlash('success',"Employé supprimé");

            return new RedirectResponse("/admin_employee");

        }
    }
    /**
     * @Route("/admin_employee/plan", name="admin_employee_plan")
     */
    public function plan(EmployeeRepository $repo): Response
    {
        $employees = $repo->findAll();
        // dd($employees,$this->getUser());
        return $this->render('admin_employee/plan.html.twig', [
            'employees' => $employees,
        ]);
    }

    /**
     * @Route("/admin_employee/renew", name="admin_employee_renew")
     * @IsGranted("ROLE_ADMIN")
     */
    public function renew(EmployeeRepository $repo,EntityManagerInterface $em): Response
    {
        $employees = $repo->findAll();
        foreach($employees as $employee)
        {
            $employee->setMonday(0);
            $employee->setTuesday(0);
            $employee->setWednesday(0);
            $employee->setThursday(0);
            $employee->setFriday(0);
            $employee->setSaturday(0);

            $employee->setStatus([0,0,0,0,0,0]);

            $em->flush();
        }
        
        return new RedirectResponse("/admin_employee/plan");
    }
    // /**
    //  * @Route("admin/comment",name="admin_comment_show")
    //  */
    // public function showComment(CommentRepository $repo)
    // {
    //     $comments = $repo->findAll();

    //     return $this->render('admin_article/comment.html.twig',[
    //         'comments' => $comments
    //     ]);
    // }
    // /**
    //  * @Route("admin/comment/{id}",name="admin_comment_moderate")
    //  */
    // public function validComment($id,CommentRepository $repo,Request $request,EntityManagerInterface $manager)
    // {
    //     $comment = $repo->find($id);
    //     // dd($request->request->get('mode'));

    //     if($request->request->get('mode') === 'true')
    //     {
    //         $comment->setMode(true);
    //     }
    //     else
    //     {
    //         $comment->setMode(false);
    //     }
    //     $manager->persist($comment);
    //     $manager->flush();

    //      return $this->redirectToRoute('admin_comment_show');
    // }
}




    // private $em;
    // private $request;
    // public function __construct(EntityManagerInterface $em,Request $request)
    // {
    //     $this->em = $em;
    //     $this->request = $request;
    // }
    



