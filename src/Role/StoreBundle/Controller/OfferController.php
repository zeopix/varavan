<?php

namespace Role\StoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Role\StoreBundle\Document\Offer;
use Role\StoreBundle\Form\OfferType;

/**
 * Offer controller.
 *
 * @Route("/ofertas")
 */
class OfferController extends AbstractController
{
    /**
     * Lists all Offer entities.
     *
     * @Route("/", name="ofertas")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $entities = $dm->createQueryBuilder('RoleStoreBundle:Offer')->field('store.$id')->equals($this->getStore()->getId())->getQuery()->execute();
        //$entities = $dm->getRepository('RoleStoreBundle:Offer')->findByStore($this->getStore()->getId());
        foreach($entities as $entity){
            die("hi");
        }
        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Offer entity.
     *
     * @Route("/", name="ofertas_create")
     * @Method("POST")
     * @Template("RoleStoreBundle:Offer:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Offer();
        $form = $this->createForm(new OfferType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $dm = $this->get('doctrine_mongodb')->getManager();
            $entity->upload();
            $entity->setStore($this->getStore());
            $dm->persist($entity);
            $dm->flush();

            return $this->redirect($this->generateUrl('ofertas_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Offer entity.
     *
     * @Route("/new", name="ofertas_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Offer();
        $form   = $this->createForm(new OfferType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Offer entity.
     *
     * @Route("/{id}", name="ofertas_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $entity = $dm->getRepository('RoleStoreBundle:Offer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Offer entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Offer entity.
     *
     * @Route("/{id}/edit", name="ofertas_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $entity = $dm->getRepository('RoleStoreBundle:Offer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Offer entity.');
        }

        $editForm = $this->createForm(new OfferType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Offer entity.
     *
     * @Route("/{id}", name="ofertas_update")
     * @Method("PUT")
     * @Template("RoleStoreBundle:Offer:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $entity = $dm->getRepository('RoleStoreBundle:Offer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Offer entity.');
        }
        $entity->upload();
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new OfferType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $dm->persist($entity);
            $dm->flush();
            return $this->redirect($this->generateUrl('ofertas_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Offer entity.
     *
     * @Route("/{id}", name="ofertas_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $dm = $this->get('doctrine_mongodb')->getManager();
            $entity = $dm->getRepository('RoleStoreBundle:Offer')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Offer entity.');
            }

            $dm->remove($entity);
            $dm->flush();
        }

        return $this->redirect($this->generateUrl('ofertas'));
    }

    /**
     * Creates a form to delete a Offer entity by id.
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
