<?php
namespace bicycle\dispatcher;

use bicycle\delegate\Delegate;

class Dispatcher
implements IDispatcher
{
  private $m_hashInterest;

  public function __construct()
  {
    $this->m_hashInterest = array();
  }

  public function dispatch( $key, $object)
  {
    if ( isset( $this->m_hashInterest[ $key]))
    {
      $this->m_hashInterest[ $key]( $key, $object);
    }
    return $this;
  }
  public function subscribe( $key, $handler)
  {
    if ( isset( $this->m_hashInterest[ $key]))
    {
      $delegate = $this->m_hashInterest[ $key];
    }
    else
    {
      $delegate = new Delegate();
      $this->m_hashInterest[ $key] = $delegate;
    }
    $delegate->add( $handler);
    return $this;
  }
  public function unsubscribe( $key, $handler)
  {
    if ( isset( $this->m_hashInterest[ $key]))
    {
      $delegate = $this->m_hashInterest[ $key];
      $delegate->remove( $handler);
    }
    return $this;
  }
}