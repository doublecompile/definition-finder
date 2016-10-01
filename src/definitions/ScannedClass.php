<?hh // strict

namespace FredEmmott\DefinitionFinder;

<<__ConsistentConstruct>>
abstract class ScannedClass
  extends ScannedBase
  implements HasScannedGenerics {

  public function __construct(
    SourcePosition $position,
    string $name,
    Map<string, Vector<mixed>> $attributes,
    ?string $docblock,
    private \ConstVector<ScannedMethod> $methods,
    private \ConstVector<ScannedProperty> $properties,
    private \ConstVector<ScannedConstant> $constants,
    private \ConstVector<ScannedTypeConstant> $typeConstants,
    private \ConstVector<ScannedGeneric> $generics,
    private ?ScannedTypehint $parent,
    private \ConstVector<ScannedTypehint> $interfaces,
    private \ConstVector<ScannedTypehint> $traits,
    private AbstractnessToken $abstractness = AbstractnessToken::NOT_ABSTRACT,
    private FinalityToken $finality = FinalityToken::NOT_FINAL,
  ) {
    parent::__construct($position, $name, $attributes, $docblock);
  }

  public function isInterface(): bool {
    return static::getType() === DefinitionType::INTERFACE_DEF;
  }

  public function isTrait(): bool {
    return static::getType() === DefinitionType::TRAIT_DEF;
  }

  public function getMethods(): \ConstVector<ScannedMethod> {
    return $this->methods;
  }

  public function getProperties(): \ConstVector<ScannedProperty> {
    return $this->properties;
  }

  public function getConstants(): \ConstVector<ScannedConstant> {
    return $this->constants;
  }

  public function getTypeConstants(): \ConstVector<ScannedTypeConstant> {
    return $this->typeConstants;
  }

  public function getGenericTypes(): \ConstVector<ScannedGeneric> {
    return $this->generics;
  }

  public function getInterfaceNames(): \ConstVector<string> {
    return $this->interfaces->map($x ==> $x->getTypeName());
  }

  public function getTraitNames(): \ConstVector<string> {
    return $this->traits->map($x ==> $x->getTypeName());
  }

  public function getParentClassName(): ?string {
    return $this->parent?->getTypeName();
  }

  public function getParentClassInfo(): ?ScannedTypehint {
    return $this->parent;
  }

  public function getInterfaceInfo(): \ConstVector<ScannedTypehint> {
    return $this->interfaces;
  }

  public function getTraitInfo(): \ConstVector<ScannedTypehint> {
    return $this->traits;
  }

  public function isAbstract(): bool {
    return $this->abstractness === AbstractnessToken::IS_ABSTRACT;
  }

  public function isFinal(): bool {
    return $this->finality === FinalityToken::IS_FINAL;
  }
}
