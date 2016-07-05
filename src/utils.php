<?hh // strict
namespace FredEmmott\DefinitionFinder;

function nullthrows<T>(?T $v): T {
  invariant(
    $v !== null,
    'unexpected null',
  );
  return $v;
}

function normalize_xhp_class(string $in): string {
  return 'xhp_'.str_replace(':', '__', substr(strtr($in, '-', '_'), 1));
}

// Defined in runtime in global namespace, but not in HHI
// facebook/hhvm#4872
const int T_TYPELIST_LT = 398;
const int T_TYPELIST_GT = 399;
// Defined in runtime in global namespace, but not in HHI
const int T_VEC = 443;
