<?hh // strict

namespace FredEmmott\DefinitionFinder;

class ScannedProperty
  extends ScannedBase
  implements HasScannedVisibility {
  public function __construct(
    SourcePosition $position,
    string $name,
    Map<string, Vector<mixed>> $attributes,
    ?string $docComment,
    private ?ScannedTypehint $typehint,
    private VisibilityToken $visibility,
    private StaticityToken $staticity = StaticityToken::NOT_STATIC,
  ) {
    parent::__construct(
      $position,
      $name,
      $attributes,
      $docComment,
    );
  }

  public static function getType(): ?DefinitionType {
    return null;
  }

  public function getTypehint(): ?ScannedTypehint {
    return $this->typehint;
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
}
