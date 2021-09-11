<?php

namespace Test\Controller;

use Laminas\Mvc\Controller\AbstractActionController;

class indexController implements AbstractActionController
{
  public function indexAction()
  {
    return new ViewModel();
  }
}
