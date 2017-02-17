<?php
namespace bicycle\dispatcher;

interface IDispatcher
{
  function dispatch( $key, $object);
  function subscribe( $key, $handler);
  function unsubscribe( $key, $handler);
}