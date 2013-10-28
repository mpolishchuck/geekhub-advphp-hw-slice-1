<?php

namespace PaulMaxwell\SimulatorWebApplication;

use PaulMaxwell\SimulatorWebApplication\Basis\AbstractSingleton;
use PaulMaxwell\SimulatorWebApplication\Controller\DefaultController;
use Symfony\Bridge\Twig\Extension\FormExtension;
use Symfony\Bridge\Twig\Form\TwigRenderer;
use Symfony\Bridge\Twig\Form\TwigRendererEngine;
use Symfony\Component\Form\Forms;
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
 * @property \Symfony\Component\Form\FormFactory $formFactory
 */
class Application extends AbstractSingleton
{
    use GetterAndSetterTrait;

    private $_request = null;
    private $_templateEngine = null;
    private $_session = null;
    private $_formFactory = null;

    /**
     * Run the application
     */
    public function run()
    {
        $this->session->start();

        $controller = new DefaultController();
        $controller->run();
    }

    /**
     * Get HttpFoundation Request object
     * @return \Symfony\Component\HttpFoundation\Request
     */
    public function getRequest()
    {
        if ($this->_request === null) {
            $this->_request = Request::createFromGlobals();
        }

        return $this->_request;
    }

    /**
     * Get the Twig template engine
     * @return \Twig_Environment
     */
    public function getTemplateEngine()
    {
        if ($this->_templateEngine === null) {
            $this->_templateEngine = new \Twig_Environment(
                new \Twig_Loader_Filesystem(array(
                    __DIR__ . '/resources/templates/',
                )),
                array(
//                    'cache' => __DIR__ . '/runtime',
                    'debug' => true,
                )
            );

            $formRenderEngine = new TwigRendererEngine(array('form_div_layout.html.twig'));
            $formRenderEngine->setEnvironment($this->_templateEngine);

            $this->_templateEngine->addExtension(
                new FormExtension(
                    new TwigRenderer(
                        $formRenderEngine
                    )
                )
            );
        }

        return $this->_templateEngine;
    }

    /**
     * Get the HttpFoundation Session object
     * @return \Symfony\Component\HttpFoundation\Session\Session
     */
    public function getSession()
    {
        if ($this->_session === null) {
            $this->_session = new Session();
            $this->_session->setName('zoobox-session');
        }

        return $this->_session;
    }

    /**
     * Get the form factory
     * @return \Symfony\Component\Form\FormFactoryInterface
     */
    public function getFormFactory()
    {
        if ($this->_formFactory === null) {
            $this->_formFactory = Forms::createFormFactory();
        }

        return $this->_formFactory;
    }
}
