<?hh // strict

namespace FredEmmott\DefinitionFinder\Test;

final class FinalClass { }

class NotFinalClass {
  final public function finalMethod(): void {}
  public function notFinalMethod(): void {}
}
