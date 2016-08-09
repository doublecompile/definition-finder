<?hh // strict

namespace FredEmmott\DefinitionFinder;

final class ScannedMethodBuilder
  extends ScannedFunctionAbstractBuilder<ScannedMethod> {

  protected ?VisibilityToken $visibility;
  private ?StaticityToken $staticity;
  private ?AbstractnessToken $abstractness;
  private ?FinalityToken $finality;

  public function build(): ScannedMethod{
    return new ScannedMethod(
      nullthrows($this->position),
      nullthrows($this->namespace).$this->name,
      nullthrows($this->attributes),
      $this->docblock,
      nullthrows($this->generics),
      $this->returnType,
      $this->buildParameters(),
      nullthrows($this->visibility),
      nullthrows($this->staticity),
      nullthrows($this->abstractness),
      nullthrows($this->finality),
    );
  }

  public function setVisibility(VisibilityToken $visibility): this {
    $this->visibility = $visibility;
    return $this;
  }

  public function setStaticity(StaticityToken $staticity): this {
    $this->staticity = $staticity;
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
}
