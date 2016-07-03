<?hh // strict

namespace FredEmmott\DefinitionFinder\Test;

use FredEmmott\DefinitionFinder\FileParser;
use FredEmmott\DefinitionFinder\ScannedClass;

class AbstractClassContentsTest extends \PHPUnit_Framework_TestCase {
  private ?ScannedClass $class;
  private ?\ConstVector<ScannedClass> $classes;

  protected function setUp(): void {
    $parser = FileParser::FromFile(
      __DIR__.'/data/abstract_class_contents.php'
    );
    $this->classes = $parser->getClasses();
  }

  public function testClassIsAbstract(): void {
    $this->assertEquals(
      Vector { true, false },
      $this->classes?->map($x ==> $x->isAbstract()),
      'isAbstract',
    );
  }

  public function testMethodsAreAbstract(): void {
    $class = $this->classes ? $this->classes[0] : null;
    $this->assertSame(
      'FredEmmott\\DefinitionFinder\\Test\\AbstractClassWithContents',
      $class?->getName(),
    );
    $this->assertEquals(
      Vector { false, true },
      $class?->getMethods()?->map($x ==> $x->isAbstract()),
      'isAbstract',
    );
  }
}
