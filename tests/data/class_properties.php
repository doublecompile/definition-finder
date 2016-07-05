<?hh // strict

namespace FredEmmott\DefinitionFinder\Test;

class ClassWithProperties {
  private bool $foo = true;
  protected int $bar = 123;
  public string $herp = 'derp';

  public function varsArentProps(): void {
    $local = 'test';
  }
}

namespace FredEmmott\DefinitionFinder\Test2 {
  class ClassWithProperties {
    public bool $foobar = false;
    public function varsStillArentProps(): void {
      $local = true;
    }
  }
}
