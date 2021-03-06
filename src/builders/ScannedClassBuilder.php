<?hh // strict

namespace FredEmmott\DefinitionFinder;

final class ScannedClassBuilder extends ScannedBaseBuilder {
  private ?ScannedScopeBuilder $scopeBuilder;
  protected \ConstVector<ScannedGeneric> $generics = Vector { };
  private \ConstVector<ScannedTypehint> $interfaces = Vector { };
  private ?ScannedTypehint $parent = null;
  private ?AbstractnessToken $abstractness;
  private ?FinalityToken $finality;

  public function setGenericTypes(
    \ConstVector<ScannedGeneric> $generics,
  ): this {
    $this->generics = $generics;
    return $this;
  }

  public function __construct(
    private ClassDefinitionType $type,
    string $name,
  ) {
    parent::__construct($name);
  }

  public function setContents(ScannedScopeBuilder $scope): this {
    invariant($this->scopeBuilder === null, 'class already has a scope');
    $this->scopeBuilder = $scope;
    return $this;
  }

  public function setParentClassInfo(ScannedTypehint $parent): this {
    $this->parent = $parent;
    return $this;
  }

  public function setInterfaces(
    \ConstVector<ScannedTypehint> $interfaces,
  ): this {
    $this->interfaces = $interfaces;
    return $this;
  }

  public function setAbstractness(AbstractnessToken $abstractness): this {
    $this->abstractness = $abstractness;
    return $this;
  }

  public function setFinality(FinalityToken $finality): this {
    $this->finality = $finality;
    return $this;
  }

  public function build<T as ScannedClass>(classname<T> $what): T {
    ClassDefinitionType::assert($what::getType());
    invariant(
      $this->type === $what::getType(),
      "Can't build a %s for a %s",
      $what,
      token_name($this->type),
    );

    $scope = nullthrows($this->scopeBuilder)
      ->setPosition(nullthrows($this->position))
      ->build();

    $methods = $scope->getMethods();
    $properties = new Vector($scope->getProperties());

    foreach ($methods as $method) {
      if ($method->getName() === '__construct') {
        foreach ($method->getParameters() as $param) {
          if ($param->__isPromoted()) {
            // Not using the builder as we should have all the data up front,
            // and I want the typechecker to notice if we're missing something
            $properties[] = new ScannedProperty(
              $param->getPosition(),
              $param->getName(),
              $param->getAttributes(),
              $param->getDocComment(),
              $param->getTypehint(),
              $param->__getVisibility(),
              StaticityToken::NOT_STATIC,
            );
          }
        }
        break;
      }
    }

    return new $what(
      nullthrows($this->position),
      $this->name,
      nullthrows($this->attributes),
      $this->docblock,
      $methods,
      $properties,
      $scope->getConstants(),
      $scope->getTypeConstants(),
      $this->generics,
      $this->parent,
      $this->interfaces,
      $scope->getUsedTraits(),
      nullthrows($this->abstractness),
      nullthrows($this->finality),
    );
  }

  public function getType(): ClassDefinitionType {
    return $this->type;
  }
}
