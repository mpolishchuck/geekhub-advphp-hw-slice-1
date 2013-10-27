<?php

namespace PaulMaxwell\SimulatorWebApplication;

use PaulMaxwell\SimulatorWebApplication\Basis\AbstractSingleton;
use PaulMaxwell\SimulatorWebApplication\Controller\DefaultController;
use Symfony\Component\HttpFoundation\Request;
use PaulMaxwell\SimulatorWebApplication\Basis\GetterAndSetterTrait;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Class Application
 * @package PaulMaxwell\SimulatorWebApplication
 *
 * @property \Symfony\Component\HttpFoundation\Request $request
 * @property \Twig_Environment $templateEngine
 * @property \Symfony\Component\HttpFoundation\Session\Session $session
 */
class Application extends AbstractSingleton
{
    use GetterAndSetterTrait;

    private $_request = null;
    private $_templateEngine = null;
    private $_session = null;

    public function run()
    {
        $this->session->start();

        $controller = new DefaultController();
        $controller->run();
    }

    public function getRequest()
    {
        if ($this->_request === null) {
            $this->_request = Request::createFromGlobals();
        }

        return $this->_request;
    }

    public function getTemplateEngine()
    {
        if ($this->_templateEngine === null) {
            $this->_templateEngine = new \Twig_Environment(
                new \Twig_Loader_Filesystem(__DIR__ . '/resources/templates/'),
                array()
            );
        }

        return $this->_templateEngine;
    }

    public function getSession()
    {
        if ($this->_session === null) {
            $this->_session = new Session();
            $this->_session->setName('zoobox-session');
        }

        return $this->_session;
    }
}
