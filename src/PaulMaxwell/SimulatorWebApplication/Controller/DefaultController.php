<?php

namespace PaulMaxwell\SimulatorWebApplication\Controller;

use PaulMaxwell\SimulatorWebApplication\Application;
use PaulMaxwell\SimulatorWebApplication\Basis\AbstractController;
use PaulMaxwell\SimulatorWebApplication\Form\NewCreatureFormType;
use PaulMaxwell\SimulatorWebApplication\Model\ZooBoxItem\Cat;
use PaulMaxwell\SimulatorWebApplication\Model\ZooBoxItem\SphericalHorse;
use PaulMaxwell\SimulatorWebApplication\Model\ZooBoxModel;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\RedirectResponse;

class DefaultController extends AbstractController
{
    /**
     * @var ZooBoxModel
     */
    protected $zooBox = null;

    public function __construct()
    {
        $session = Application::getInstance()->session;
        if ($session->has('serializedZooBox')) {
            $this->zooBox = unserialize($session->get('serializedZooBox'));
        } else {
            $this->zooBox = new ZooBoxModel();
        }
    }

    protected function saveState()
    {
        Application::getInstance()->session->set('serializedZooBox', serialize($this->zooBox));
    }

    protected function redirectToMain()
    {
        $redirect = new RedirectResponse(Application::getInstance()->request->getBaseUrl() . '/');
        $redirect->send();
    }

    public function defaultAction()
    {
        $this->saveState();
        $this->render('index', array(
            'zoobox' => $this->zooBox->getItems(),
        ));
    }

    public function resetAction()
    {
        $session = Application::getInstance()->session;
        if ($session->has('serializedZooBox')) {
            $session->remove('serializedZooBox');
        }

        $this->redirectToMain();
    }

    public function nextAction()
    {
        $this->zooBox->think();
        $this->saveState();

        $this->redirectToMain();
    }

    public function newCreatureAction()
    {
        $form = $this->createFormBuilder(new NewCreatureFormType())
            ->getForm();

        $request = Application::getInstance()->request;

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            if ($data['class'] == 'SphericalHorse') {
                $this->zooBox->addItem(new SphericalHorse());
                $this->saveState();

                $this->redirectToMain();

                return;
            } else {
                if (strlen($data['name']) <= 0) {
                    $form->addError(new FormError('Name of creature must be filled'));
                } else {
                    $className = '\\PaulMaxwell\\SimulatorWebApplication\\Model\\ZooBoxItem\\'.$data['class'];
                    $this->zooBox->addItem(new $className($data['name']));
                    $this->saveState();

                    $this->redirectToMain();

                    return;
                }
            }
        }

        $this->render('new', array(
            'form' => $form->createView(),
        ));
    }
}
