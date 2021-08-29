<?php
/**
 * このインターフェイスは
 * デザインパターンで言う「Bridge」
 * だと思う
 * 機能面のインターフェースである。
 */
namespace Blog\Model;

interface PostRepositoryInterface
{
  /**
   * return a set of all blog posts that we can iterate over.
   * 
   * each entry should be a Post instance.
   * 
   * @return Post[]
   */
  public function findAllPosts();

  /**
   * return a sigle blog post.
   * 
   * @param int $id Indetifier of the post to return.
   * @return Post
   */
  public function findPost($id);
}

?>