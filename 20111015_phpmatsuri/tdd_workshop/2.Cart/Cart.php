<?php
class Cart {
  protected $items = array();

  /**
   * コンストラクタ
   */
  public function __construct() {
    $this->clear();
  }

  /**
   * 商品追加
   *
   * @param string $code
   * @param integer $count
   */
  public function addItem($code, $count) {
    $count = intval($count);
    if ($count <= 0) {
      return;
    }

    if (array_key_exists($code, $this->items)) {
      $this->items[$code] += $count;
    } else {
      $this->items[$code] = $count;
    }
  }

  /**
   * 商品数更新
   *
   * @param string $code
   * @param integer $count
   */
  public function updateItem($code, $count) {
    if (!array_key_exists($code, $this->items)) {
      throw new OutOfBoundsException();
    }

    $this->items[$code] += $count;

    if ($this->items[$code] <= 0) {
      unset($this->items[$code]);
    }
  }

  /**
   * 商品が存在するか
   *
   * @param string $code
   * @return boolean
   */
  public function isExist($code) {
    return array_key_exists($code, $this->items);
  }

  /**
   * 商品をクリアする
   */
  public function clear() {
    $this->items = array();
  }

  /**
   * 商品の数量を取得
   *
   * @param string $code
   * @return integer
   */
  public function getItemCount($code) {
    if (empty($this->items[$code])) {
      return null;
    }

    return $this->items[$code];
  }

  /**
   * 全ての商品コードと数量を取得
   *
   * @return array
   */
  public function getItems() {
    return $this->items;
  }

  /**
   * 商品数合計取得
   *
   * @return integer
   */
  public function getTotalCount() {
    $no = 0;

    foreach ($this->items as $v) {
      $no += $v;
    }

    return $no;
  }
}
