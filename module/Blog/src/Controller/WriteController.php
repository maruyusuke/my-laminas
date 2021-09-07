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
    // return new ViewModel([
    //   'form' => $this->form,
    // ]);

    $request = $this->getRequest();
    $viewModel = new ViewModel(['form' => $this->form]);

    if(! $request->isPost()){
      return $viewModel;
    }

    $this->form->setData($request->getPost());

    if(! $this->form->isValid()){
      return $viewModel;
    }

    $data = $this->form->getData()['post'];
    $post = new Post($data['title'],$data['text']);

    try{
      $post = $this->command->insertPost($post);

    } catch(\Exception $ex){
      // An exception occurred; we may want to log this later and/or
        // report it to the user. For now, we'll just re-throw.
      throw $ex;
    }

    return $this->redirect()->toRoute(
      'blog/detail',
      ['id' => $post->getId()]
    );


  }
}
?>