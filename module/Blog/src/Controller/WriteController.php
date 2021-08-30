<?php

namespace Blog\Controller;

use Blog\Form\PostForm;
use Blog\Model\Post;
use Blog\Model\PostCommandInterface;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class WriteController extends AbstractActionController
{
  /**
   * @var PostCommandInterface
   */
  private $command;

  /**
   * @var PostForm
   */
  private $form;

  public function __construct(PostCommandInterface $command, PostForm $form)
  {
    $this->command = $command;
    $this->form = $form;
  }

  public function addAction()
  {
    return new ViewModel([
      'form' => $this->form,
    ]);
  }
}
?>