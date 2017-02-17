<?php
namespace bicycle\dispatcher;

class DispatcherTest
extends \bicycle\TestCase
{
  public function test_dispatch_empty()
  {
    $dispatcher = $this->createDispatcher();
    $dispatcher->dispatch( 'test', '11111111');
    $this->assertTrue( true);
  }
  public function test_dispatch()
  {
    $dispatcher = $this->createDispatcher();
    $handlerA1 = new TestHandler();
    $handlerA2 = new TestHandler();
    $handlerB1 = new TestHandler();
    $dispatcher->subscribe( 'test', array( $handlerA1, 'handler'))
              ->subscribe( 'test', array( $handlerA2, 'handler'))
              ->subscribe( 'not-test', array( $handlerB1, 'handler'))
              ;
    $dispatcher->dispatch( 'test', '11111111');
    $this->assertEquals( 'test'
                        , $handlerA1->getKey()
                        );
    $this->assertEquals( '11111111'
                        , $handlerA1->getObject()
                        );
    $this->assertEquals( 'test'
                        , $handlerA2->getKey()
                        );
    $this->assertEquals( '11111111'
                        , $handlerA2->getObject()
                        );
    $this->assertNull( $handlerB1->getKey());
    $this->assertNull( $handlerB1->getObject());
  }
  public function test_unsubscribe()
  {
    $dispatcher = $this->createDispatcher();
    $handlerA1 = new TestHandler();
    $dispatcher->subscribe( 'test', array( $handlerA1, 'handler'))
              ->unsubscribe( 'test', array( $handlerA1, 'handler'))
              ;
    $dispatcher->dispatch( 'test', '11111111');
    $this->assertNull( $handlerA1->getKey());
    $this->assertNull( $handlerA1->getObject());
  }
  public function test_unsubscribe_key_difference()
  {
    $dispatcher = $this->createDispatcher();
    $handlerA1 = new TestHandler();
    $dispatcher->subscribe( 'A', array( $handlerA1, 'handler'))
              ->subscribe( 'B', array( $handlerA1, 'handler'))
              ->unsubscribe( 'A', array( $handlerA1, 'handler'))
              ;
    $dispatcher->dispatch( 'A', '11111111');
    $this->assertNull( $handlerA1->getKey());
    $this->assertNull( $handlerA1->getObject());
    $dispatcher->dispatch( 'B', '11111111');
    $this->assertEquals( 'B'
                        , $handlerA1->getKey()
                        );
    $this->assertEquals( '11111111'
                        , $handlerA1->getObject()
                        );
  }
  private function createDispatcher()
  {
    return new Dispatcher();
  }
}