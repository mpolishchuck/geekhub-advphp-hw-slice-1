<?php

namespace PaulMaxwell\SimulatorWebApplication\Controller;

use PaulMaxwell\SimulatorWebApplication\Application;
use PaulMaxwell\SimulatorWebApplication\Basis\AbstractController;
use PaulMaxwell\SimulatorWebApplication\Model\ZooBoxItem\Cat;
use PaulMaxwell\SimulatorWebApplication\Model\ZooBoxItem\SphericalHorse;
use PaulMaxwell\SimulatorWebApplication\Model\ZooBoxModel;
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
            $this->zooBox->addItem(new SphericalHorse());
            $this->zooBox->addItem(new Cat('Fluffy'));
            $this->zooBox->addItem(new Cat('Jack'));
        }
    }

    public function saveState()
    {
        Application::getInstance()->session->set('serializedZooBox', serialize($this->zooBox));
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

        $redirect = new RedirectResponse(Application::getInstance()->request->getBaseUrl().'/');
        $redirect->send();
    }

    public function nextAction()
    {
        $this->zooBox->think();
        $this->saveState();

        $redirect = new RedirectResponse(Application::getInstance()->request->getBaseUrl().'/');
        $redirect->send();
    }

    public function newAction()
    {
        // TODO New creature add form
        $this->render('new', array());
    }
}
