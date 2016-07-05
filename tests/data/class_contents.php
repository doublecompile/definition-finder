<?hh // strict

namespace FredEmmott\DefinitionFinder\Test;

class ClassWithContents {
  private bool $foo = true;
  public string $herp = 'derp';

  /** FooDoc */
  const string FOO = 'bar';
  /** BarDoc */
  const int BAR = 60 * 60 * 24;

  public function publicMethod(): void {}
  protected function protectedMethod(): void {}
  private function privateMethod(): void {}

  public static function PublicStaticMethod(): void {}
}
