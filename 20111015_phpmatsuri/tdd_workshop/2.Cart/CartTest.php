<?php
require_once 'Cart.php';

/**
 * CartTest
 */
class CartTest extends PHPUnit_Framework_TestCase {
  protected $object = null;

  /**
   * setUp
   */
  public function setUp() {
    $this->object = new Cart();
  }

  /**
   * getTotalCount
   */
  public function test_getTotalCount_init() {
    $this->assertEquals(0, $this->object->getTotalCount());
  }

  /**
   * addItem
   */
  public function test_addItem_商品を一つ追加() {
    $this->object->addItem('code1', 1);
    $this->assertEquals(1, $this->object->getTotalCount());

    $expected = array(
      'code1' => 1,
    );
    $this->assertEquals($expected, $this->object->getItems());
  }

  public function test_addItem_同じ商品を二回追加() {
    $this->object->addItem('code1', 1);
    $this->object->addItem('code1', 1);
    $this->assertEquals(2, $this->object->getTotalCount());

    $expected = array(
      'code1' => 2,
    );
    $this->assertEquals($expected, $this->object->getItems());
  }

  public function test_addItem_違う商品を二回追加() {
    $this->object->addItem('code1', 1);
    $this->object->addItem('code2', 1);
    $this->assertEquals(2, $this->object->getTotalCount());

    $expected = array(
      'code1' => 1,
      'code2' => 1,
    );
    $this->assertEquals($expected, $this->object->getItems());
  }

  public function test_addItem_商品を一つ追加_数量がマイナスならカートに入らない() {
    $this->object->addItem('code1', -1);
    $this->assertEquals(0, $this->object->getTotalCount());

    $expected = array(
    );
    $this->assertEquals($expected, $this->object->getItems());
  }

  /**
   * updateItem
   */
  public function test_updateItem_商品数量を変更_10個加算() {
    $this->setTestItems(__METHOD__);

    $this->object->updateItem('code1', 10);
    $this->assertEquals(13, $this->object->getTotalCount());
    $expected = array(
      'code1' => 11,
      'code2' => 2,
    );
    $this->assertEquals($expected, $this->object->getItems());
  }

  public function test_updateItem_商品数量を変更_1個減算() {
    $this->setTestItems(__METHOD__);

    $this->object->updateItem('code2', -1);
    $this->assertEquals(2, $this->object->getTotalCount());
    $expected = array(
      'code1' => 1,
      'code2' => 1,
    );
    $this->assertEquals($expected, $this->object->getItems());
  }

  public function test_updateItem_商品数量を変更_1個減算して0になるのでカートから削除() {
    $this->setTestItems(__METHOD__);

    $this->object->updateItem('code1', -1);
    $this->assertEquals(2, $this->object->getTotalCount());
    $expected = array(
      'code2' => 2,
    );
    $this->assertEquals($expected, $this->object->getItems());
  }

  public function test_updateItem_商品数量を変更_存在しないコード() {
    $this->setTestItems(__METHOD__);

    try {
      $this->object->updateItem('nothing', 1);
      $this->fail();
    } catch (OutOfBoundsException $e) {
      // nop
    }
  }

  /**
   * isExist
   */
  public function test_isExist_true() {
    $this->setTestItems(__METHOD__);
    $this->assertTrue($this->object->isExist('code1'));
  }

  public function test_isExist_false() {
    $this->setTestItems(__METHOD__);
    $this->assertFalse($this->object->isExist('nothing'));
  }

  /**
   * clear
   */
  public function test_clear() {
    $this->setTestItems(__METHOD__);

    $this->object->clear();
    $this->assertEquals(0, $this->object->getTotalCount());
    $expected = array(
    );
    $this->assertEquals($expected, $this->object->getItems());
  }

  /**
   * getItemCount
   */
  public function test_getItemCount() {
    $this->setTestItems(__METHOD__);

    $this->assertEquals(1, $this->object->getItemCount('code1'));
  }

  /**
   *
   */
  protected function setTestItems($method) {
    $this->object->addItem('code1', 1);
    $this->object->addItem('code2', 2);
    $this->assertEquals(3, $this->object->getTotalCount(), $method);
    $expected = array(
      'code1' => 1,
      'code2' => 2,
    );
    $this->assertEquals($expected, $this->object->getItems(), $method);
  }
}
