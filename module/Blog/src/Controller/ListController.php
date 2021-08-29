<?php

namespace Blog\Controller;

use Blog\Model\PostRepositoryInterface;
use Laminas\Mvc\Controller\AbstractActionController;
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
}

?>