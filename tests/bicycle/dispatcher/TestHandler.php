<?php
namespace bicycle\dispatcher;

class TestHandler
{
  private $m_key;
  private $m_object;

  public function __construct()
  {
    $this->m_key = null;
    $this->m_object = null;
  }
  public function getKey()
  {
    return $this->m_key;
  }
  public function getObject()
  {
    return $this->m_object;
  }
  public function handler( $key, $object)
  {
    $this->m_key = $key;
    $this->m_object = $object;
  }
}