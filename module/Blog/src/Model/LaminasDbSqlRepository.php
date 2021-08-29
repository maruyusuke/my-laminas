<?php

namespace Blog\Model;

use InvaildArgumentException;
use RuntimeException;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Sql\Sql;
use Laminas\Db\Adapter\Driver\ResultInterface;
use Laminas\Db\ResultSet\ResultSet;


class LaminasDbSqlRepository implements PostRepositoryInterface
{
  /**
   * @var ラミナスのAdapterInterfaceを使う
   * 
   */
  private $db;

  public function __construct(AdapterInterface $db)
  {
    $this->db = $db;
  }
  /**
   * {@inheritDoc}
   */
  public function findAllPosts()
  {
    $sql    = new Sql($this->db);
    $select = $sql->select('posts');
    $stmt   = $sql->prepareStatementForSqlObject($select);
    $result = $stmt->execute();

    if ($result instanceof ResultInterface && $result->isQueryResult()) {
      $resultSet = new ResultSet();
      $resultSet->initialize($result);
      var_export($resultSet);
      die();
    }

    die('no data');
   
    //return $result;
    

  }

  /**
   * {@inheritDoc}
   * @throws InvaildArgumentException
   * @throws RuntimeException
   */
  public function findPost($id)
  {

  }


}


?>