<?php

class Foo {
  function defaultVisibility() {}
  private function privateVisibility() {}
  function alsoDefaultVisibility() {}

  /** FooDoc */
  const FOO = 'bar';
  /** BarDoc */
  const BAR = 60 * 60 * 24;

  private $untypedProperty;
}
