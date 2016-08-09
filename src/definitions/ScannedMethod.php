<?hh // strict

namespace FredEmmott\DefinitionFinder;

final class ScannedMethod
  extends ScannedFunctionAbstract
  implements HasScannedVisibility {
  public function __construct(
    SourcePosition $position,
    string $name,
    Map<string, Vector<mixed>> $attributes,
    ?string $docComment,
    \ConstVector<ScannedGeneric> $generics,
    ?ScannedTypehint $returnType,
    \ConstVector<ScannedParameter> $parameters,
    private VisibilityToken $visibility,
    private StaticityToken $staticity = StaticityToken::NOT_STATIC,
    private AbstractnessToken $abstractness = AbstractnessToken::NOT_ABSTRACT,
    private FinalityToken $finality = FinalityToken::NOT_FINAL,
  ) {
    parent::__construct(
      $position,
      $name,
      $attributes,
      $docComment,
      $generics,
      $returnType,
      $parameters,
    );
  }

  public function isPublic(): bool {
    return $this->visibility === T_PUBLIC;
  }

  public function isProtected(): bool {
    return $this->visibility === T_PROTECTED;
  }

  public function isPrivate(): bool {
    return $this->visibility === T_PRIVATE;
  }

  public function isStatic(): bool {
    return $this->staticity === StaticityToken::IS_STATIC;
  }

  public function isAbstract(): bool {
    return $this->abstractness === AbstractnessToken::IS_ABSTRACT;
  }

  public function isFinal(): bool {
    return $this->finality === FinalityToken::IS_FINAL;
  }
}
