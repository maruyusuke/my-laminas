<?php

namespace Blog\Model;

use InvalidArgumentException;
use RuntimeException;

use Laminas\Hydrator\HydratorInterface;
// use Laminas\Hydrator\ReflectionHydrator;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Adapter\Driver\ResultInterface;
use Laminas\Db\ResultSet\HydratingResultSet;
use Laminas\Db\Sql\Sql;


class LaminasDbSqlRepository implements PostRepositoryInterface
{
  /**
   * @var ラミナスのAdapterInterfaceを使う
   * 
   */
  private $db;

  /**
   * @var HydratorInterface
   */
  private $hydrator;

  /**
   * @var Post
   */
  private $postPrototype;


  public function __construct(
    AdapterInterface $db,
    HydratorInterface $hydrator,
    Post $postPrototype
  ){
        $this->db = $db;
        $this->hydrator = $hydrator;
        $this->postPrototype = $postPrototype;
  }
  /**
   * 繰り返してselectで全てのblog postをセットします
   * 
   * {@inheritDoc}
   */
  public function findAllPosts()
  {
    $sql    = new Sql($this->db);
    $select = $sql->select('posts');
    $stmt   = $sql->prepareStatementForSqlObject($select);
    $result = $stmt->execute();

    if (! $result instanceof ResultInterface ||! $result->isQueryResult()) {
      return [];
    }

    $resultSet = new HydratingResultSet($this->hydrator, $this->postPrototype);
    $resultSet->initialize($result);
    return $resultSet;
    

  }

  /**
   * {@inheritDoc}
   * @throws InvalidArgumentException
   * @throws RuntimeException
   */
  public function findPost($id)
  {
    $sql       = new Sql($this->db);
    $select    = $sql->select('posts');
    $select->where(['id = ?' => $id]);

    $statement = $sql->prepareStatementForSqlObject($select);
    $result    = $statement->execute();

    if (! $result instanceof ResultInterface || ! $result->isQueryResult()) {
      throw new RuntimeException(sprintf(
        'ID： "%S" のブログ内容の取得に失敗しました。不明なデータベースエラーです。',
        $id
      ));

    }

    $resultSet = new HydratingResultSet($this->hydrator, $this->postPrototype);
    $resultSet->initialize($result);
    $post = $resultSet->current();

    if(! $post){
      throw new InvalidArgumentException(sprintf(
        'ID : "%s" のブログが見つかりません。',
        $id
      ));
    }
    return $post;
  }
  

}


?>