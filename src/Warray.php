<?php

declare(strict_types=1);

namespace Girgias;

final class Warray
{
    final public static function changeKeyCase(array $input, int $case = \CASE_LOWER): array
    {
        return \array_change_key_case($input, $case);
    }

    final public static function chunk(array $input, int $size, bool $preserveKeys = false): array
    {
        return \array_chunk($input, $size, $preserveKeys);
    }

    /**
     * @param array      $input
     * @param mixed      $columnKey
     * @param null|mixed $indexKey
     *
     * @return array
     */
    final public static function column(array $input, $columnKey, $indexKey = null): array
    {
        return \array_column($input, $columnKey, $indexKey);
    }

    /**
     * @param array<mixed, array-key> $keys
     * @param array                   $values
     *
     * @return array
     */
    final public static function combine(array $keys, array $values): array
    {
        return \array_combine($keys, $values);
    }

    final public static function countValues(array $array): array
    {
        return \array_count_values($array);
    }

    final public static function difference(array $from, array $against, array ...$againstAlso): array
    {
        return \array_diff($from, $against, ...$againstAlso);
    }

    /**
     * Changed signature: Callback first.
     *
     * The callback is appended to $againstAlso to be able to
     * unpack arbitrary arguments and still have the callback
     * as the last parameter in the original function
     *
     * @param callable $valueCompareFunction
     * @param array    $from
     * @param array    $against
     * @param array    ...$againstAlso
     *
     * @return array
     */
    final public static function userDifference(
        callable $valueCompareFunction,
        array $from,
        array $against,
        array ...$againstAlso
    ): array {
        $callbackAfterAgainstAlso = self::push($againstAlso, $valueCompareFunction);

        /** @psalm-suppress MixedArgument */
        return \array_udiff($from, $against, ...$callbackAfterAgainstAlso);
    }

    final public static function differenceAssociative(array $from, array $against, array ...$againstAlso): array
    {
        return \array_diff_assoc($from, $against, ...$againstAlso);
    }

    /**
     * Changed signature: Callback first.
     *
     * The callback is appended to $againstAlso to be able to
     * unpack arbitrary arguments and still have the callback
     * as the last parameter in the original function
     *
     * @param callable $valueCompareFunction
     * @param array    $from
     * @param array    $against
     * @param array    ...$againstAlso
     *
     * @return array
     */
    final public static function userDifferenceAssociative(
        callable $valueCompareFunction,
        array $from,
        array $against,
        array ...$againstAlso
    ): array {
        $callbackAfterAgainstAlso = self::push($againstAlso, $valueCompareFunction);

        /** @psalm-suppress MixedArgument */
        return \array_udiff_assoc($from, $against, ...$callbackAfterAgainstAlso);
    }

    /**
     * Changed signature: Callback first.
     *
     * The callback is appended to $againstAlso to be able to
     * unpack arbitrary arguments and still have the callback
     * as the last parameter in the original function
     *
     * @param callable $keyCompareFunction
     * @param array    $from
     * @param array    $against
     * @param array    ...$againstAlso
     *
     * @return array
     */
    final public static function differenceUserAssociative(
        callable $keyCompareFunction,
        array $from,
        array $against,
        array ...$againstAlso
    ): array {
        $callbackAfterAgainstAlso = self::push($againstAlso, $keyCompareFunction);

        /** @psalm-suppress MixedArgument */
        return \array_diff_uassoc($from, $against, ...$callbackAfterAgainstAlso);
    }

    /**
     * Changed signature: Callbacks first.
     *
     * The callback is appended to $againstAlso to be able to
     * unpack arbitrary arguments and still have the callback
     * as the last parameter in the original function
     *
     * @param callable $valueCompareFunction
     * @param callable $keyCompareFunction
     * @param array    $from
     * @param array    $against
     * @param array    ...$againstAlso
     *
     * @return array
     */
    final public static function userDifferenceUserAssociative(
        callable $valueCompareFunction,
        callable $keyCompareFunction,
        array $from,
        array $against,
        array ...$againstAlso
    ): array {
        $callbacksAfterAgainstAlso = self::push($againstAlso, $valueCompareFunction, $keyCompareFunction);

        /** @psalm-suppress MixedArgument */
        return \array_udiff_uassoc($from, $against, ...$callbacksAfterAgainstAlso);
    }

    final public static function differenceKeys(array $from, array $against, array ...$againstAlso): array
    {
        return \array_diff_key($from, $against, ...$againstAlso);
    }

    /**
     * Changed signature: Callback first.
     *
     * The callback is appended to $againstAlso to be able to
     * unpack arbitrary arguments and still have the callback
     * as the last parameter in the original function
     *
     * @param callable $keyCompareFunction
     * @param array    $from
     * @param array    $against
     * @param array    ...$againstAlso
     *
     * @return array
     */
    final public static function differenceUserKeys(
        callable $keyCompareFunction,
        array $from,
        array $against,
        array ...$againstAlso
    ): array {
        $callbackAfterAgainstAlso = self::push($againstAlso, $keyCompareFunction);

        /** @psalm-suppress MixedArgument */
        return \array_diff_ukey($from, $against, ...$callbackAfterAgainstAlso);
    }

    /**
     * @param array $keys
     * @param mixed $value
     *
     * @return array
     */
    final public static function fillKeys(array $keys, $value): array
    {
        return \array_fill_keys($keys, $value);
    }

    /**
     * @param int   $startIndex
     * @param int   $num
     * @param mixed $value
     *
     * @return array
     */
    final public static function fill(int $startIndex, int $num, $value): array
    {
        return \array_fill($startIndex, $num, $value);
    }

    /**
     * Changed signature: Callback first.
     *
     * @param callable $callback
     * @param array    $array
     * @param int      $flag
     *
     * @return array
     */
    final public static function filter(callable $callback, array $array, int $flag = 0): array
    {
        return \array_filter($array, $callback, $flag);
    }

    final public static function flip(array $array): array
    {
        return \array_flip($array);
    }

    /**
     * Alias for in_array
     * Changed signature: $strict true by default.
     *
     * @param mixed $needle
     * @param array $haystack
     * @param bool  $strict
     *
     * @return bool
     */
    final public static function has($needle, array $haystack, bool $strict = true): bool
    {
        return \in_array($needle, $haystack, $strict);
    }

    final public static function intersect(array $from, array $against, array ...$againstAlso): array
    {
        return \array_intersect($from, $against, ...$againstAlso);
    }

    /**
     * Changed signature: Callback first.
     *
     * The callback is appended to $againstAlso to be able to
     * unpack arbitrary arguments and still have the callback
     * as the last parameter in the original function
     *
     * @param callable $valueCompareFunction
     * @param array    $from
     * @param array    $against
     * @param array[]  $againstAlso
     *
     * @return array
     */
    final public static function userIntersect(
        callable $valueCompareFunction,
        array $from,
        array $against,
        array ...$againstAlso
    ): array {
        $callbackAfterAgainstAlso = self::push($againstAlso, $valueCompareFunction);

        /** @psalm-suppress MixedArgument */
        return \array_uintersect($from, $against, ...$callbackAfterAgainstAlso);
    }

    final public static function intersectAssociative(array $from, array $against, array ...$againstAlso): array
    {
        return \array_intersect_assoc($from, $against, ...$againstAlso);
    }

    /**
     * Changed signature: Callback first.
     *
     * The callback is appended to $againstAlso to be able to
     * unpack arbitrary arguments and still have the callback
     * as the last parameter in the original function
     *
     * @param callable $valueCompareFunction
     * @param array    $from
     * @param array    $against
     * @param array[]  $againstAlso
     *
     * @return array
     */
    final public static function userIntersectAssociative(
        callable $valueCompareFunction,
        array $from,
        array $against,
        array ...$againstAlso
    ): array {
        $callbackAfterAgainstAlso = self::push($againstAlso, $valueCompareFunction);

        /** @psalm-suppress MixedArgument */
        return \array_uintersect_assoc($from, $against, ...$callbackAfterAgainstAlso);
    }

    /**
     * Changed signature: Callback first.
     *
     * The callback is appended to $againstAlso to be able to
     * unpack arbitrary arguments and still have the callback
     * as the last parameter in the original function
     *
     * @param callable $keyCompareFunction
     * @param array    $from
     * @param array    $against
     * @param array    ...$againstAlso
     *
     * @return array
     */
    final public static function intersectUserAssociative(
        callable $keyCompareFunction,
        array $from,
        array $against,
        array ...$againstAlso
    ): array {
        $callbackAfterAgainstAlso = self::push($againstAlso, $keyCompareFunction);

        /** @psalm-suppress MixedArgument */
        return \array_intersect_uassoc($from, $against, ...$callbackAfterAgainstAlso);
    }

    /**
     * Changed signature: Callbacks first.
     *
     * The callback is appended to $againstAlso to be able to
     * unpack arbitrary arguments and still have the callback
     * as the last parameter in the original function
     *
     * @param callable $valueCompareFunction
     * @param callable $keyCompareFunction
     * @param array    $from
     * @param array    $against
     * @param array    ...$againstAlso
     *
     * @return array
     */
    final public static function userIntersectUserAssociative(
        callable $valueCompareFunction,
        callable $keyCompareFunction,
        array $from,
        array $against,
        array ...$againstAlso
    ): array {
        $callbacksAfterAgainstAlso = self::push($againstAlso, $valueCompareFunction, $keyCompareFunction);

        /** @psalm-suppress MixedArgument */
        return \array_uintersect_uassoc($from, $against, ...$callbacksAfterAgainstAlso);
    }

    final public static function intersectKey(array $from, array $against, array ...$againstAlso): array
    {
        return \array_intersect_key($from, $against, ...$againstAlso);
    }

    /**
     * Changed signature: Callback first.
     *
     * The callback is appended to $againstAlso to be able to
     * unpack arbitrary arguments and still have the callback
     * as the last parameter in the original function
     *
     * @param callable $keyCompareFunction
     * @param array    $from
     * @param array    $against
     * @param array    ...$againstAlso
     *
     * @return array
     */
    final public static function intersectUserKeys(
        callable $keyCompareFunction,
        array $from,
        array $against,
        array ...$againstAlso
    ): array {
        $callbackAfterAgainstAlso = self::push($againstAlso, $keyCompareFunction);

        /** @psalm-suppress MixedArgument */
        return \array_intersect_ukey($from, $against, ...$callbackAfterAgainstAlso);
    }

    /**
     * Changed signature: Search array first.
     *
     * @param array      $search
     * @param int|string $key
     *
     * @return bool
     */
    final public static function keyExist(array $search, $key): bool
    {
        return \array_key_exists($key, $search);
    }

    /**
     * @param array $array
     *
     * @return null|int|string
     */
    final public static function keyFirst(array $array)
    {
        return \array_key_first($array);
    }

    /**
     * @param array $array
     *
     * @return null|int|string
     */
    final public static function keyLast(array $array)
    {
        return \array_key_last($array);
    }

    /**
     * Changed signature: $strict true by default.
     *
     * @param array      $array
     * @param null|mixed $searchValue
     * @param bool       $strict
     *
     * @return array
     */
    final public static function keys(array $array, $searchValue = null, bool $strict = true): array
    {
        if (\is_null($searchValue)) {
            return \array_keys($array);
        }

        return \array_keys($array, $searchValue, $strict);
    }

    final public static function map(callable $callback, array $array, array ...$additionalArrays): array
    {
        return \array_map($callback, $array, ...$additionalArrays);
    }

    final public static function merge(array $initialArray, array ...$arraysToMerge): array
    {
        return \array_merge($initialArray, ...$arraysToMerge);
    }

    final public static function mergeRecursive(array $initialArray, array ...$arraysToMerge): array
    {
        return \array_merge_recursive($initialArray, ...$arraysToMerge);
    }

    /**
     * @param array $input
     * @param int   $size
     * @param mixed $value
     *
     * @return array
     */
    final public static function pad(array $input, int $size, $value): array
    {
        return \array_pad($input, $size, $value);
    }

    /**
     * Changed signature: returns array instead of last element.
     *
     * @param array $input
     *
     * @return array
     */
    final public static function pop(array $input): array
    {
        \array_pop($input);

        return $input;
    }

    /**
     * @param array $input
     *
     * @return float|int
     */
    final public static function product(array $input)
    {
        return \array_product($input);
    }

    /**
     * Changed signature: returns modified array instead of number of elements.
     *
     * @param array $input
     * @param mixed ...$values
     *
     * @return array
     */
    final public static function push(array $input, ...$values): array
    {
        \array_push($input, ...$values);

        return $input;
    }

    /**
     * Changed signature: Always returns an array even for only one key.
     *
     * @param array $input
     * @param int   $num
     *
     * @return array<int, array-key>
     */
    final public static function rand(array $input, int $num = 1): array
    {
        $randomKeys = \array_rand($input, $num);
        if (!\is_array($randomKeys)) {
            $randomKeys = [$randomKeys];
        }

        return $randomKeys;
    }

    /**
     * Changed signature: Callback first.
     *
     * @param callable   $callback
     * @param array      $input
     * @param null|mixed $initial
     *
     * @return mixed
     */
    final public static function reduce(callable $callback, array $input, $initial = null)
    {
        return \array_reduce($input, $callback, $initial);
    }

    final public static function replace(array $arrayToReplace, array ...$arraysToExtract): array
    {
        return \array_replace($arrayToReplace, ...$arraysToExtract);
    }

    final public static function replaceRecursive(array $arrayToReplace, array ...$arraysToExtract): array
    {
        return \array_replace_recursive($arrayToReplace, ...$arraysToExtract);
    }

    final public static function reverse(array $input, bool $preserveKeys = false): array
    {
        return \array_reverse($input, $preserveKeys);
    }

    /**
     * Changed signature: $strict true by default.
     *
     * @param mixed $needle
     * @param array $haystack
     * @param bool  $strict
     *
     * @return false|int|string
     */
    final public static function search($needle, array $haystack, bool $strict = true)
    {
        return \array_search($needle, $haystack, $strict);
    }

    /**
     * Changed signature: returns array instead of first element.
     *
     * @param array $input
     *
     * @return array
     */
    final public static function shift(array $input): array
    {
        \array_shift($input);

        return $input;
    }

    /**
     * Changed signature: returns shuffled array.
     *
     * @param array $input
     *
     * @return array
     */
    final public static function shuffle(array $input): array
    {
        \shuffle($input);

        return $input;
    }

    final public static function slice(array $input, int $offset, ?int $length = null, bool $preserveKeys = false): array
    {
        return \array_slice($input, $offset, $length, $preserveKeys);
    }

    /**
     * Changed signature: returns sorted array.
     *
     * @param array $input
     * @param int   $sortFlags
     *
     * @return array
     */
    final public static function sort(array $input, int $sortFlags = \SORT_REGULAR): array
    {
        \sort($input, $sortFlags);

        return $input;
    }

    /**
     * Changed signature: returns sorted array.
     *
     * @param array $input
     * @param int   $sortFlags
     *
     * @return array
     */
    final public static function sortReverse(array $input, int $sortFlags = \SORT_REGULAR): array
    {
        \rsort($input, $sortFlags);

        return $input;
    }

    /**
     * Changed signature: Callback first
     * Changed signature: returns sorted array.
     *
     * @param callable $valueCompareFunction
     * @param array    $input
     *
     * @return array
     */
    final public static function userSort(callable $valueCompareFunction, array $input): array
    {
        \usort($input, $valueCompareFunction);

        return $input;
    }

    /**
     * Changed signature: returns sorted array.
     *
     * @param array $input
     * @param int   $sortFlags
     *
     * @return array
     */
    final public static function sortAssociative(array $input, int $sortFlags = \SORT_REGULAR): array
    {
        \asort($input, $sortFlags);

        return $input;
    }

    /**
     * Changed signature: returns sorted array.
     *
     * @param array $input
     * @param int   $sortFlags
     *
     * @return array
     */
    final public static function sortAssociativeReverse(array $input, int $sortFlags = \SORT_REGULAR): array
    {
        \arsort($input, $sortFlags);

        return $input;
    }

    /**
     * Changed signature: Callback first
     * Changed signature: returns sorted array.
     *
     * @param callable $valueCompareFunction
     * @param array    $input
     *
     * @return array
     */
    final public static function sortUserAssociative(callable $valueCompareFunction, array $input): array
    {
        \uasort($input, $valueCompareFunction);

        return $input;
    }

    /**
     * Changed signature: returns sorted array.
     *
     * @param array $input
     * @param int   $sortFlags
     *
     * @return array
     */
    final public static function sortKey(array $input, int $sortFlags = \SORT_REGULAR): array
    {
        \ksort($input, $sortFlags);

        return $input;
    }

    /**
     * Changed signature: returns sorted array.
     *
     * @param array $input
     * @param int   $sortFlags
     *
     * @return array
     */
    final public static function sortKeyReverse(array $input, int $sortFlags = \SORT_REGULAR): array
    {
        \krsort($input, $sortFlags);

        return $input;
    }

    /**
     * Changed signature: Callback first
     * Changed signature: returns sorted array.
     *
     * @param callable $keyCompareFunction
     * @param array    $input
     *
     * @return array
     */
    final public static function sortUserKey(callable $keyCompareFunction, array $input): array
    {
        \uksort($input, $keyCompareFunction);

        return $input;
    }

    /**
     * NOTE: This function as weird PHP signature, look into how to improve it maybe.
     *
     * @param array $input
     * @param int   $sortOrder
     * @param int   $sortFlag
     * @param array ...$additionalArrays
     *
     * @return array
     */
    final public static function sortMultiple(
        array $input,
        int $sortOrder = \SORT_ASC,
        int $sortFlag = \SORT_REGULAR,
        array ...$additionalArrays
    ): array {
        \array_multisort($input, $sortOrder, $sortFlag, ...$additionalArrays);

        return $input;
    }

    /**
     * Changed signature: returns sorted array.
     *
     * @param array $input
     *
     * @return array
     */
    final public static function sortNatural(array $input): array
    {
        \natsort($input);

        return $input;
    }

    /**
     * Changed signature: returns sorted array.
     *
     * @param array $input
     *
     * @return array
     */
    final public static function sortNaturalInsensitive(array $input): array
    {
        \natcasesort($input);

        return $input;
    }

    /**
     * Changed signature: returns spliced array instead of extracted elements.
     *
     * @param array    $input
     * @param int      $offset
     * @param null|int $length
     * @param array    $replacement
     *
     * @return array
     */
    final public static function splice(array $input, int $offset, ?int $length = null, array $replacement = []): array
    {
        if (\is_null($length)) {
            $length = \count($input);
        }
        \array_splice($input, $offset, $length, $replacement);

        return $input;
    }

    /**
     * @param array $input
     *
     * @return float|int
     */
    final public static function sum(array $input)
    {
        return \array_sum($input);
    }

    /**
     * Changed signature: default sort flag changed to SORT_REGULAR.
     *
     * @param array $input
     * @param int   $sortFlags
     *
     * @return array
     */
    final public static function unique(array $input, int $sortFlags = \SORT_REGULAR): array
    {
        return \array_unique($input, $sortFlags);
    }

    /**
     * Changed signature: returns modified array instead of number of elements.
     *
     * @param array $input
     * @param mixed ...$values
     *
     * @return array
     */
    final public static function unshift(array $input, ...$values): array
    {
        \array_unshift($input, ...$values);

        return $input;
    }

    final public static function values(array $input): array
    {
        return \array_values($input);
    }

    /**
     * Changed signature: Callback first.
     *
     * @param callable $callback
     * @param array    $input
     * @param null     $userData
     *
     * @return array
     */
    final public static function walk(callable $callback, array $input, $userData = null): array
    {
        \array_walk($input, $callback, $userData);

        return $input;
    }

    /**
     * Changed signature: Callback first.
     *
     * @param callable $callback
     * @param array    $input
     * @param null     $userData
     *
     * @return array
     */
    final public static function walkRecursive(callable $callback, array $input, $userData = null): array
    {
        \array_walk_recursive($input, $callback, $userData);

        return $input;
    }
}
