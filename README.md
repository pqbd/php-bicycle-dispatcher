#Dispatcher
the component for [alternative manifest](https://github.com/pqbd/php-bicycle "bicycle")

Dispatcher is common method to dispatch context by key.

## Code sample
```php
$handlerA1 = new TestHandler();
$dispatcher->subscribe( 'A', array( $handlerA1, 'handler'))
          ->subscribe( 'B', array( $handlerA1, 'handler'))
          ->unsubscribe( 'A', array( $handlerA1, 'handler'))
          ;
$dispatcher->dispatch( 'A', '11111111');
```