<?php

namespace Blog\Model;

interface PostCommandInterface
{
  /**
   * システムの中でコマンド（insert, update, delete）の元となるインターフェース
   * 
   * @param Post $post insertするためのポスト
   * @return Post 識別子がついたポスト
   * 
   */
  public function insertPost(Post $post);
  

  /**
   * update用のポスト
   * 
   * @param Post $post 
   * @return Post アップデートされたポスト
   */
  public function updatePost(Post $post);

  /**
   * ポストの削除
   * 
   * @param Post $post 
   * @return bool
   */
  public function deletePost(Post $post);


}

?>