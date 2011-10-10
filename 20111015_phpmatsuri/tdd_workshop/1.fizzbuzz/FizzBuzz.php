<?php
class FizzBuzz {
  /**
   * FizzBuzz文字表現を作成
   *
   * @param integer $no
   * @return string
   */
  public static function makeFizzBuzz($no) {
    $no = intval($no);

    if ($no % 3 === 0 && $no % 5 === 0) {
      return 'FizzBuzz';
    } else if ($no % 3 === 0) {
      return 'Fizz';
    } else if ($no % 5 === 0) {
      return 'Buzz';
    }

    return strval($no);
  }
}
