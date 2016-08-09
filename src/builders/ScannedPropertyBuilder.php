<?hh // strict

namespace FredEmmott\DefinitionFinder;

class ScannedPropertyBuilder extends ScannedSingleTypeBuilder<ScannedProperty> {
  private ?ScannedTypehint $typehint;
  private ?VisibilityToken $visibility;
  private ?StaticityToken $staticity;

  public function setVisibility(VisibilityToken $visibility): this {
    $this->visibility = $visibility;
    return $this;
  }

  public function setTypehint(?ScannedTypehint $typehint): this {
    $this->typehint = $typehint;
    return $this;
  }

  public function setStaticity(StaticityToken $staticity): this {
    $this->staticity = $staticity;
    return $this;
  }

  public function build(): ScannedProperty {
    return new ScannedProperty(
      nullthrows($this->position),
      $this->name,
      nullthrows($this->attributes),
      $this->docblock,
      $this->typehint,
      nullthrows($this->visibility),
      nullthrows($this->staticity),
    );
  }
}
