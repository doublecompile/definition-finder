<?hh // strict

namespace FredEmmott\DefinitionFinder\Test;

abstract class AbstractClassWithContents {
  public function publicMethod(): void {}
  abstract protected function abstractProtectedMethod(): void;
}

class NotAbstractClass {}
