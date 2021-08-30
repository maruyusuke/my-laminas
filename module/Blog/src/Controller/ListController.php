<?php

namespace Blog\Controller;

use Blog\Model\PostRepositoryInterface;
use Laminas\Mvc\Controller\AbstractActionController;
use InvalidArgumentException;

//add this
use Laminas\View\Model\ViewModel;

class ListController extends AbstractActionController
{
  /**
   * @var PostRepositoryInterface
   * DI (コンストラクタインジェクション)
   * PostRepositoryをListControllerのコンストラクタに注入
   * 
   * なぜ注入するか、それはこのコントローラーを使ってPostRepositoryクラスを動かすから
   */

  private $postrepository;

  public function __construct(PostRepositoryInterface $postrepository)
  {
    $this->postRepository = $postrepository;
  }

  //add this
  public function indexAction()
  {
    return new ViewModel([
      'posts' => $this->postRepository->findAllPosts(),
    ]);
  }

  public function detailAction()
  {
    $id = $this->params()->fromRoute('id');

    try{
      $post = $this->postRepository->findPost($id);
    }catch(\InvalidArgumentException $ex){
      return $this->redirect()->toRoute('blog');
    }

    return new ViewModel([
      'post' => $post,
    ]);
    
  }
}

?>