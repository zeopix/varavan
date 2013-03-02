<?php

namespace Role\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Role\StoreBundle\Document\Store;
use Role\AdminBundle\Form\StoreType;

/**
 * Store controller.
 *
 * @Route("/store")
 */
class StoreController extends Controller
{
    /**
     * Lists all Store entities.
     *
     * @Route("/", name="admin_store")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
         $dm = $this->get('doctrine_mongodb')->getManager();

        $entities = $dm->getRepository('RoleStoreBundle:Store')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Store entity.
     *
     * @Route("/create", name="admin_store_create")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {


        /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->container->get('fos_user.user_manager');
        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->container->get('event_dispatcher');

        $entity  = new Store();
        $user = $userManager->createUser();
        $user->setEnabled(true);
        $entity->setUser($user);

        $form = $this->createForm(new StoreType(), $entity);
        
        if ('POST' === $request->getMethod()) {
            $form->bind($request);

            if ($form->isValid()) {
                $dm = $this->get('doctrine_mongodb')->getManager();
                $entity->getUser()->addRole("ROLE_STORE");
                $entity->getUser()->addRole("ROLE_USER");
                $userManager->updateUser($entity->getUser());
                $dm->persist($entity);
                $dm->flush();

                //set flash
                $this->getRequest()->getSession()->setFlash('message','Store created correctly.');
                return $this->redirect($this->generateUrl("admin_store"));
            }
        }

        return $this->render('RoleStoreBundle:Store:new.html.twig',array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Store entity.
     *
     * @Route("/new", name="admin_store_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Store();
        $form   = $this->createForm(new StoreType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Store entity.
     *
     * @Route("/{id}", name="admin_store_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();

        $entity = $dm->getRepository('RoleStoreBundle:Store')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Store entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Store entity.
     *
     * @Route("/{id}/edit", name="admin_store_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();

        $entity = $dm->getRepository('RoleStoreBundle:Store')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Store entity.');
        }

        $editForm = $this->createForm(new StoreType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Store entity.
     *
     * @Route("/{id}", name="admin_store_update")
     * @Method("PUT")
     * @Template("RoleStoreBundle:Store:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();

        $entity = $dm->getRepository('RoleStoreBundle:Store')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Store entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new StoreType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $dm->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_store_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Store entity.
     *
     * @Route("/{id}", name="admin_store_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
        $dm = $this->get('doctrine_mongodb')->getManager();
            $entity = $dm->getRepository('RoleStoreBundle:Store')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Store entity.');
            }

            $dm->remove($entity);
            $dm->flush();
        }

        return $this->redirect($this->generateUrl('admin_store'));
    }

    /**
     * Creates a form to delete a Store entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
