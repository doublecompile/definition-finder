<?hh // strict

namespace FredEmmott\DefinitionFinder\Test;
use FredEmmott\DefinitionFinder\FileParser;

class RelationshipsTest extends \PHPUnit_Framework_TestCase {
  public function testClassExtends(): void {
    $data = '<?hh class Foo extends Bar {}';
    $def = FileParser::FromData($data)->getClass('Foo');
    $this->assertSame(
      'Bar',
      $def->getParentClassName(),
    );
    $this->assertEmpty($def->getInterfaceNames());
  }

  public function testClassImplements(): void {
    $data = '<?hh class Foo implements Bar, Baz {}';
    $def = FileParser::FromData($data)->getClass('Foo');
    $this->assertEquals(
      Vector { 'Bar', 'Baz' },
      $def->getInterfaceNames(),
    );
    $this->assertNull($def->getParentClassName());
  }

  public function testInterfaceExtends(): void {
    $data = '<?hh interface Foo extends Bar, Baz {}';
    $def = FileParser::FromData($data)->getInterface('Foo');
    $this->assertEquals(
      Vector { 'Bar', 'Baz' },
      $def->getInterfaceNames(),
    );
    $this->assertNull($def->getParentClassName());
  }

  public function testClassExtendsAndImplements(): void {
    $data = '<?hh class Foo extends Bar implements Herp, Derp {}';
    $def = FileParser::FromData($data)->getClass('Foo');
    $this->assertSame('Bar', $def->getParentClassName());
    $this->assertEquals(
      Vector { 'Herp', 'Derp' },
      $def->getInterfaceNames(),
    );
  }

  public function testClassExtendsGeneric(): void {
    $data = '<?hh class Foo extends Bar<Baz> {}';
    $def = FileParser::FromData($data)->getClass('Foo');
    $this->assertSame('Bar', $def->getParentClassName());
    $this->assertSame(
      'Bar<Baz>',
      $def->getParentClassInfo()?->getTypeText(),
    );
  }

  public function testClassImplementsGenerics(): void {
    $data = '<?hh class Foo implements KeyedIterable<Tk,Tv> {}';
    $def = FileParser::FromData($data)->getClass('Foo');
    $this->assertEquals(Vector { 'KeyedIterable' }, $def->getInterfaceNames());
    $this->assertEquals(
      Vector { 'KeyedIterable<Tk,Tv>' },
      $def->getInterfaceInfo()->map($x ==> $x->getTypeText()),
    );
  }

  public function testClassImplementsNestedGenerics(): void {
    $data = '<?hh class VectorIterable<Tv> implements Iterable<Vector<Tv>> {}';
    $def = FileParser::FromData($data)->getClass('VectorIterable');
    $this->assertEquals(Vector { 'Iterable' }, $def->getInterfaceNames());
    $this->assertEquals(
      Vector { Vector { 'Vector' } },
      $def->getInterfaceInfo()->map($x ==> $x->getGenericTypes()->map($y ==> $y->getTypeName())),
    );
    $this->assertEquals(
      Vector { 'Iterable<Vector<Tv>>' },
      $def->getInterfaceInfo()->map($x ==> $x->getTypeText()),
    );
  }
}