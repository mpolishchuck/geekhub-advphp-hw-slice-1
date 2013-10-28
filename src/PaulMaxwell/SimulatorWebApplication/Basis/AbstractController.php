<?php

namespace PaulMaxwell\SimulatorWebApplication\Basis;

use PaulMaxwell\SimulatorWebApplication\Application;
use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationRequestHandler;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractController
{
    public function run()
    {
        $do = Application::getInstance()->request->get('do', 'default');
        $methodName = $do.'Action';
        if (!method_exists($this, $methodName)) {
            $methodName = 'defaultAction';
        }
        $this->$methodName();
    }

    public function render($templateName, $templateParameters = array(), $returnOutput = false)
    {
        $templateName .= '.html.twig';
        if ($returnOutput) {
            return Application::getInstance()->getTemplateEngine()->render($templateName, $templateParameters);
        }

        $response = new Response();
        $response->setContent(
            Application::getInstance()->getTemplateEngine()->render($templateName, $templateParameters)
        );
        $response->send();

        return true;
    }

    /**
     * @param  string|\Symfony\Component\Form\Extension\Core\Type\FormType $type
     * @param  array                                                       $data
     * @return \Symfony\Component\Form\FormBuilderInterface
     */
    public function createFormBuilder($type = 'form', $data = array())
    {
        $formBuilder = Application::getInstance()->getFormFactory()->createBuilder($type, $data);
        $formBuilder->setRequestHandler(new HttpFoundationRequestHandler());

        return $formBuilder;
    }
}
