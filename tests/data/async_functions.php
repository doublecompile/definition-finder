<?hh // strict

namespace FredEmmott\DefinitionFinder\Test;

class ClassWithAsyncFunction {
  public async function asyncMethod(): Awaitable<void> {}
  public function notAsyncMethod(): void {}
}

async function asyncFunction(): Awaitable<void> {}

function notAsyncFunction(): void {}
