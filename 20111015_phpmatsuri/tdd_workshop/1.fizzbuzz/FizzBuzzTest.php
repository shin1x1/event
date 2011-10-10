<?php
require_once 'FizzBuzz.php';

/**
 * FizzBuzzTest
 */
class FizzBuzzTest extends PHPUnit_Framework_TestCase {
  /**
   * makeFizzBuzz
   */
  public function testMakeFizzBuzz_1の時は1() {
    $this->assertEquals('1', FizzBuzz::makeFizzBuzz(1));
  }

  public function testMakeFizzBuzz_3の時はFizz() {
    $this->assertEquals('Fizz', FizzBuzz::makeFizzBuzz(3));
  }

  public function testMakeFizzBuzz_5の時はBuzz() {
    $this->assertEquals('Buzz', FizzBuzz::makeFizzBuzz(5));
  }

  public function testMakeFizzBuzz_15の時はFizzBuzz() {
    $this->assertEquals('FizzBuzz', FizzBuzz::makeFizzBuzz(15));
  }
}
