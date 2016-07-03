<?hh // strict

namespace FredEmmott\DefinitionFinder\Test;

use FredEmmott\DefinitionFinder\FileParser;
use FredEmmott\DefinitionFinder\ScannedClass;

class FinalTest extends \PHPUnit_Framework_TestCase {
  private ?\ConstVector<ScannedClass> $classes;

  protected function setUp(): void {
    $parser = FileParser::FromFile(
      __DIR__.'/data/finals.php'
    );
    $this->classes = $parser->getClasses();
  }

  public function testClassIsFinal(): void {
    $this->assertEquals(
      Vector { true, false },
      $this->classes?->map($x ==> $x->isFinal()),
      'isFinal',
    );
  }

  public function testMethodsAreFinal(): void {
    $class = $this->classes ? $this->classes[1] : null;
    $this->assertEquals(
      Vector { true, false },
      $class?->getMethods()?->map($x ==> $x->isFinal()),
      'isFinal',
    );
  }
}
