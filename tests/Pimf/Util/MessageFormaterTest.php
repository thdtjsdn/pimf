<?php
class MessageFormaterTest extends PHPUnit_Framework_TestCase
{
  protected $expectedMsg = 'Hello Ben my name is Matt! I am 21, how old are you? I like food!';

  public function testCreatingANewInstance()
  {
    new Pimf_Util_Message('Some message here');
  }

  public function testCreatingANewInstanceWithBindingParamsToTheMessage()
  {
    $message = new Pimf_Util_Message(
      'Hello %your_name my name is %my_name! '
        .'I am %my_age, how old are you? I like %object!',
      array(
        'your_name' => 'Ben',
        'my_name' => 'Matt',
        'my_age' => '21',
        'object' => 'food'
      )
    );

    $this->assertEquals($this->expectedMsg, (string) $message);
  }

  public function testCreatingANewInstanceAnAdditionalBindingParamsToTheMessage()
  {
    $message = new Pimf_Util_Message(
      'Hello %your_name my name is %my_name! '
        .'I am %my_age, how old are you? I like %object!'
    );

    $message->bind('your_name', 'Ben')
            ->bind('my_name', 'Matt')
            ->bind('my_age', '21')
            ->bind('object', 'food');

    $this->assertEquals($this->expectedMsg, (string) $message);
  }

  public function testSettingAndUsingNewPrefixDelimitter()
  {
    $message = new Pimf_Util_Message(
      'Hello :your_name my name is :my_name! '
        .'I am :my_age, how old are you? I like :object!'
    );

    $message->setDelimiter(':')
              ->bind('your_name', 'Ben')
              ->bind('my_name', 'Matt')
              ->bind('my_age', '21')
              ->bind('object', 'food');

    $this->assertEquals($this->expectedMsg, (string) $message);
  }

  public function testSettingAndUsingNewWrongPrefixDelimitter()
  {
    $messagethatCanNotBeFormatet =
      'Hello :your_name my name is :my_name! '
      .'I am :my_age, how old are you? I like :object!';

    $message = new Pimf_Util_Message($messagethatCanNotBeFormatet);

    $message->bind('your_name', 'Ben')
      ->bind('my_name', 'Matt')
      ->bind('my_age', '21')
      ->bind('object', 'food');

    $this->assertEquals($messagethatCanNotBeFormatet, (string) $message);
  }
}
