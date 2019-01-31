<?php

declare(strict_types=1);

namespace Girgias\Tests;

use Girgias\Warray;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class WarrayTest extends TestCase
{
    private const ARRAY_UPPER_CASE_KEYS = ['KEY' => 5, 'ANOTHER_KEY' => 25, 'WOW' => 50];
    private const ARRAY_LOWER_CASE_KEYS = ['key' => 5, 'another_key' => 25, 'wow' => 50];
    private const SIMPLE_ARRAY = ['a', 'b', 'c', 'd', 'e'];

    public function testChangeKeyCase(): void
    {
        static::assertSame(
            \array_change_key_case(self::ARRAY_UPPER_CASE_KEYS),
            Warray::changeKeyCase(self::ARRAY_UPPER_CASE_KEYS)
        );
        static::assertSame(
            \array_change_key_case(self::ARRAY_LOWER_CASE_KEYS, \CASE_UPPER),
            Warray::changeKeyCase(self::ARRAY_LOWER_CASE_KEYS, \CASE_UPPER)
        );
    }

    public function testChunk(): void
    {
        static::assertSame(
            \array_chunk(self::SIMPLE_ARRAY, 2),
            Warray::chunk(self::SIMPLE_ARRAY, 2)
        );

        static::assertSame(
            \array_chunk(self::SIMPLE_ARRAY, 2, true),
            Warray::chunk(self::SIMPLE_ARRAY, 2, true)
        );
    }

    public function testColumn(): void
    {
        $records = [
            [
                'id' => 2135,
                'first_name' => 'John',
                'last_name' => 'Doe',
            ],
            [
                'id' => 3245,
                'first_name' => 'Sally',
                'last_name' => 'Smith',
            ],
            [
                'id' => 5342,
                'first_name' => 'Jane',
                'last_name' => 'Jones',
            ],
            [
                'id' => 5623,
                'first_name' => 'Peter',
                'last_name' => 'Doe',
            ],
        ];

        static::assertSame(
            \array_column($records, 'first_name'),
            Warray::column($records, 'first_name')
        );

        static::assertSame(
            \array_column($records, 'last_name', 'id'),
            Warray::column($records, 'last_name', 'id')
        );
    }

    public function testCombine(): void
    {
        $keys = ['green', 'red', 'yellow'];
        $values = ['avocado', 'apple', 'banana'];

        static::assertSame(
            \array_combine($keys, $values),
            Warray::combine($keys, $values)
        );
    }

    public function testCountValues(): void
    {
        $array = [1, 'hello', 1, 'world', 'hello'];
        static::assertSame(\array_count_values($array), Warray::countValues($array));
    }

    public function testDifference(): void
    {
        $a1 = ['A' => 'red', 'b' => 'green', 'C' => 'blue', 'D' => 'yellow'];
        $a2 = ['e' => 'red', 'f' => 'BLACK', 'g' => 'purple'];
        $a3 = ['a' => 'RED', 'b' => 'black', 'h' => 'YELLOW'];

        static::assertSame(
            \array_diff($a1, $a2),
            Warray::difference($a1, $a2)
        );
        static::assertSame(
            \array_diff($a1, $a2, $a3),
            Warray::difference($a1, $a2, $a3)
        );
    }

    public function testUserDifference(): void
    {
        $callback = static function ($a, $b) {
            if (\strtolower($a) === \strtolower($b)) {
                return true;
            }

            return false;
        };

        $a1 = ['A' => 'red', 'b' => 'green', 'C' => 'blue', 'D' => 'yellow'];
        $a2 = ['e' => 'red', 'f' => 'BLACK', 'g' => 'purple'];
        $a3 = ['a' => 'RED', 'b' => 'black', 'h' => 'YELLOW'];

        static::assertSame(
            \array_udiff($a1, $a2, $callback),
            Warray::userDifference($callback, $a1, $a2)
        );
        static::assertSame(
            \array_udiff($a1, $a2, $a3, $callback),
            Warray::userDifference($callback, $a1, $a2, $a3)
        );
    }

    public function testDifferenceAssociative(): void
    {
        $a1 = ['a' => 'red', 'b' => 'green', 'c' => 'blue', 'd' => 'yellow'];
        $a2 = ['a' => 'red', 'f' => 'green', 'g' => 'blue'];
        $a3 = ['h' => 'red', 'b' => 'green', 'g' => 'blue'];

        static::assertSame(\array_diff_assoc($a1, $a2), Warray::differenceAssociative($a1, $a2));
        static::assertSame(\array_diff_assoc($a1, $a2, $a3), Warray::differenceAssociative($a1, $a2, $a3));
    }

    public function testDifferenceUserAssociative(): void
    {
        $callback = static function ($a, $b) {
            if (\strtolower($a) === \strtolower($b)) {
                return true;
            }

            return false;
        };

        $a1 = ['A' => 'red', 'b' => 'green', 'C' => 'blue', 'D' => 'yellow'];
        $a2 = ['a' => 'red', 'f' => 'green', 'g' => 'blue'];
        $a3 = ['h' => 'red', 'B' => 'green', 'G' => 'blue'];

        static::assertSame(
            \array_diff_uassoc($a1, $a2, $callback),
            Warray::differenceUserAssociative($callback, $a1, $a2)
        );
        static::assertSame(
            \array_diff_uassoc($a1, $a2, $a3, $callback),
            Warray::differenceUserAssociative($callback, $a1, $a2, $a3)
        );
    }

    public function testUserDifferenceAssociative(): void
    {
        $callback = static function ($a, $b) {
            if (\strtolower($a) === \strtolower($b)) {
                return true;
            }

            return false;
        };

        $a1 = ['a' => 'red', 'b' => 'green', 'c' => 'blue', 'd' => 'yellow'];
        $a2 = ['a' => 'RED', 'f' => 'GREEN', 'g' => 'blue'];
        $a3 = ['h' => 'red', 'b' => 'green', 'g' => 'blue'];

        static::assertSame(
            \array_udiff_assoc($a1, $a2, $callback),
            Warray::userDifferenceAssociative($callback, $a1, $a2)
        );
        static::assertSame(
            \array_udiff_assoc($a1, $a2, $a3, $callback),
            Warray::userDifferenceAssociative($callback, $a1, $a2, $a3)
        );
    }

    public function testUserDifferenceUserAssociative(): void
    {
        $callback = static function ($a, $b) {
            if (\strtolower($a) === \strtolower($b)) {
                return true;
            }

            return false;
        };

        $a1 = ['A' => 'red', 'b' => 'green', 'C' => 'blue', 'D' => 'yellow'];
        $a2 = ['a' => 'RED', 'f' => 'GREEN', 'g' => 'blue'];
        $a3 = ['h' => 'red', 'B' => 'green', 'G' => 'blue'];

        static::assertSame(
            \array_udiff_uassoc($a1, $a2, $callback, $callback),
            Warray::userDifferenceUserAssociative($callback, $callback, $a1, $a2)
        );
        static::assertSame(
            \array_udiff_uassoc($a1, $a2, $a3, $callback, $callback),
            Warray::userDifferenceUserAssociative($callback, $callback, $a1, $a2, $a3)
        );
    }

    public function testDifferenceKeys(): void
    {
        $a1 = ['a' => 'red', 'b' => 'green', 'c' => 'blue'];
        $a2 = ['c' => 'yellow', 'd' => 'black', 'e' => 'brown'];
        $a3 = ['f' => 'green', 'c' => 'purple', 'g' => 'red'];

        static::assertSame(
            \array_diff_key($a1, $a2),
            Warray::differenceKeys($a1, $a2)
        );
        static::assertSame(
            \array_diff_key($a1, $a2, $a3),
            Warray::differenceKeys($a1, $a2, $a3)
        );
    }

    public function testDifferenceUserKey(): void
    {
        $callback = static function ($a, $b) {
            if (\strtolower($a) === \strtolower($b)) {
                return true;
            }

            return false;
        };

        $a1 = ['a' => 'red', 'b' => 'green', 'C' => 'blue'];
        $a2 = ['c' => 'yellow', 'd' => 'black', 'e' => 'brown'];
        $a3 = ['f' => 'green', 'c' => 'purple', 'g' => 'red'];

        static::assertSame(
            \array_diff_ukey($a1, $a2, $callback),
            Warray::differenceUserKeys($callback, $a1, $a2)
        );
        static::assertSame(
            \array_diff_ukey($a1, $a2, $a3, $callback),
            Warray::differenceUserKeys($callback, $a1, $a2, $a3)
        );
    }

    public function testFill(): void
    {
        static::assertSame(
            \array_fill(5, 6, 'banana'),
            Warray::fill(5, 6, 'banana')
        );

        static::assertSame(
            \array_fill(-2, 4, 'pear'),
            Warray::fill(-2, 4, 'pear')
        );
    }

    public function testFillKeys(): void
    {
        $keys = ['foo', 5, 10, 'bar'];
        static::assertSame(
            \array_fill_keys($keys, 'banana'),
            Warray::fillKeys($keys, 'banana')
        );
    }

    public function testFilter(): void
    {
        $odd = static function ($var): bool {
            return (bool) ($var & 1);
        };
        $even = static function ($var): bool {
            return !($var & 1);
        };

        $useKeyCallback = static function ($k) {
            return 'b' === $k;
        };
        $useBothCallback = static function ($v, $k) {
            return 'b' === $k || 4 === $v;
        };

        $input = ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5];
        $inputWithoutKeys = [6, 7, 8, 9, 10, 11, 12];

        static::assertSame(
            \array_filter($input, $odd),
            Warray::filter($odd, $input)
        );

        static::assertSame(
            \array_filter($inputWithoutKeys, $even),
            Warray::filter($even, $inputWithoutKeys)
        );

        static::assertSame(
            \array_filter($input, $useKeyCallback, \ARRAY_FILTER_USE_KEY),
            Warray::filter($useKeyCallback, $input, \ARRAY_FILTER_USE_KEY)
        );

        static::assertSame(
            \array_filter($input, $useBothCallback, \ARRAY_FILTER_USE_BOTH),
            Warray::filter($useBothCallback, $input, \ARRAY_FILTER_USE_BOTH)
        );
    }

    public function testFlip(): void
    {
        $a = ['oranges', 'apples', 'pears'];
        $collision = ['a' => 1, 'b' => 1, 'c' => 2];
        static::assertSame(
            \array_flip($a),
            Warray::flip($a)
        );

        static::assertSame(\array_flip($collision), Warray::flip($collision));
    }

    public function testHas(): void
    {
        $haystack = ['Cleveland', 23, '1.10', 12.4, 1.13];
        static::assertTrue(Warray::has('Cleveland', $haystack));
        static::assertTrue(Warray::has(23, $haystack));
        static::assertTrue(Warray::has(12.4, $haystack));
        static::assertTrue(Warray::has('1.10', $haystack));

        static::assertFalse(Warray::has(23.0, $haystack));
        static::assertFalse(Warray::has(12, $haystack));
        static::assertFalse(Warray::has('12.4', $haystack));
        static::assertFalse(Warray::has(['1.10'], $haystack));
    }

    public function testIntersect(): void
    {
        $a1 = ['A' => 'red', 'b' => 'green', 'C' => 'blue', 'D' => 'yellow'];
        $a2 = ['e' => 'red', 'f' => 'BLACK', 'g' => 'purple'];
        $a3 = ['a' => 'RED', 'b' => 'black', 'h' => 'YELLOW'];

        static::assertSame(\array_intersect($a1, $a2), Warray::intersect($a1, $a2));
        static::assertSame(\array_intersect($a1, $a2, $a3), Warray::intersect($a1, $a2, $a3));
    }

    public function testUserIntersect(): void
    {
        $callback = static function ($a, $b) {
            if (\strtolower($a) === \strtolower($b)) {
                return true;
            }

            return false;
        };

        $a1 = ['A' => 'red', 'b' => 'green', 'C' => 'blue', 'D' => 'yellow'];
        $a2 = ['e' => 'red', 'f' => 'BLACK', 'g' => 'purple'];
        $a3 = ['a' => 'RED', 'b' => 'black', 'h' => 'YELLOW'];

        static::assertSame(
            \array_uintersect($a1, $a2, $callback),
            Warray::userIntersect($callback, $a1, $a2)
        );
        static::assertSame(
            \array_uintersect($a1, $a2, $a3, $callback),
            Warray::userIntersect($callback, $a1, $a2, $a3)
        );
    }

    public function testIntersectAssociative(): void
    {
        $a1 = ['a' => 'red', 'b' => 'green', 'C' => 'blue', 'D' => 'yellow'];
        $a2 = ['a' => 'red', 'B' => 'green', 'g' => 'blue'];
        $a3 = ['a' => 'red', 'b' => 'green', 'G' => 'blue'];

        static::assertSame(
            \array_intersect_assoc($a1, $a2),
            Warray::intersectAssociative($a1, $a2)
        );
        static::assertSame(
            \array_intersect_assoc($a1, $a2, $a3, ),
            Warray::intersectAssociative($a1, $a2, $a3)
        );
    }

    public function testIntersectUserAssociative(): void
    {
        $callback = static function ($a, $b) {
            if (\strtolower($a) === \strtolower($b)) {
                return true;
            }

            return false;
        };

        $a1 = ['A' => 'red', 'b' => 'green', 'C' => 'blue', 'D' => 'yellow'];
        $a2 = ['a' => 'red', 'B' => 'green', 'g' => 'blue'];
        $a3 = ['a' => 'red', 'b' => 'green', 'G' => 'blue'];

        static::assertSame(
            \array_intersect_uassoc($a1, $a2, $callback),
            Warray::intersectUserAssociative($callback, $a1, $a2)
        );
        static::assertSame(
            \array_intersect_uassoc($a1, $a2, $a3, $callback),
            Warray::intersectUserAssociative($callback, $a1, $a2, $a3)
        );
    }

    public function testUserIntersectAssociative(): void
    {
        $callback = static function ($a, $b) {
            if (\strtolower($a) === \strtolower($b)) {
                return true;
            }

            return false;
        };

        $a1 = ['a' => 'red', 'b' => 'green', 'c' => 'blue', 'd' => 'yellow'];
        $a2 = ['a' => 'RED', 'f' => 'GREEN', 'g' => 'blue'];
        $a3 = ['h' => 'red', 'b' => 'green', 'g' => 'blue'];

        static::assertSame(
            \array_uintersect_assoc($a1, $a2, $callback),
            Warray::userIntersectAssociative($callback, $a1, $a2)
        );
        static::assertSame(
            \array_uintersect_assoc($a1, $a2, $a3, $callback),
            Warray::userIntersectAssociative($callback, $a1, $a2, $a3)
        );
    }

    public function testUserIntersectUserAssociative(): void
    {
        $callback = static function ($a, $b) {
            if (\strtolower($a) === \strtolower($b)) {
                return true;
            }

            return false;
        };

        $a1 = ['A' => 'red', 'b' => 'green', 'C' => 'blue', 'D' => 'yellow'];
        $a2 = ['a' => 'RED', 'f' => 'GREEN', 'g' => 'blue'];
        $a3 = ['h' => 'red', 'B' => 'green', 'G' => 'blue'];

        static::assertSame(
            \array_uintersect_uassoc($a1, $a2, $callback, $callback),
            Warray::userIntersectUserAssociative($callback, $callback, $a1, $a2)
        );
        static::assertSame(
            \array_uintersect_uassoc($a1, $a2, $a3, $callback, $callback),
            Warray::userIntersectUserAssociative($callback, $callback, $a1, $a2, $a3)
        );
    }

    public function testIntersectKey(): void
    {
        $a1 = ['a' => 'red', 'b' => 'green', 'c' => 'blue'];
        $a2 = ['c' => 'yellow', 'd' => 'black', 'e' => 'brown'];
        $a3 = ['f' => 'green', 'c' => 'purple', 'g' => 'red'];

        static::assertSame(
            \array_intersect_key($a1, $a2),
            Warray::intersectKey($a1, $a2)
        );
        static::assertSame(
            \array_intersect_key($a1, $a2, $a3),
            Warray::intersectKey($a1, $a2, $a3)
        );
    }

    public function testIntersectUserKey(): void
    {
        $callback = static function ($a, $b) {
            if (\strtolower($a) === \strtolower($b)) {
                return true;
            }

            return false;
        };

        $a1 = ['a' => 'red', 'b' => 'green', 'C' => 'blue'];
        $a2 = ['c' => 'yellow', 'd' => 'black', 'e' => 'brown'];
        $a3 = ['f' => 'green', 'c' => 'purple', 'g' => 'red'];

        static::assertSame(
            \array_intersect_ukey($a1, $a2, $callback),
            Warray::intersectUserKeys($callback, $a1, $a2)
        );
        static::assertSame(
            \array_intersect_ukey($a1, $a2, $a3, $callback),
            Warray::intersectUserKeys($callback, $a1, $a2, $a3)
        );
    }

    public function testKeyExist(): void
    {
        $searchArray = ['first' => null, 'second' => 4];
        static::assertTrue(Warray::keyExist($searchArray, 'second'));
        static::assertTrue(Warray::keyExist($searchArray, 'first'));
    }

    public function testKeyFirst(): void
    {
        static::assertSame('a', Warray::keyFirst(['a' => 1, 'b' => 2, 'c' => 3]));
        static::assertNull(Warray::keyFirst([]));
    }

    public function testKeyLast(): void
    {
        static::assertSame('c', Warray::keyLast(['a' => 1, 'b' => 2, 'c' => 3]));
        static::assertNull(Warray::keyLast([]));
    }

    public function testKeys(): void
    {
        $a = [0 => 100, 'color' => 'red'];
        $b = ['blue', 'red', 'green', 'blue', 'blue'];
        static::assertSame(\array_keys($a), Warray::keys($a));
        static::assertSame(\array_keys($b, 'blue', true), Warray::keys($b, 'blue'));
    }

    public function testMap(): void
    {
        $input = [1, 2, 3, 4, 5];
        $square = static function ($v) {
            return $v ** 2;
        };
        static::assertSame(\array_map($square, $input), Warray::map($square, $input));

        $callback = static function ($k, $v) {
            return $k.'*2 = '.$v ** 2;
        };

        static::assertSame(\array_map($callback, $input, $input), Warray::map($callback, $input, $input));
    }

    public function testMerge(): void
    {
        $base = ['citrus' => ['orange'], 'berries' => ['blackberry', 'raspberry'], 'others' => 'banana'];
        $merge = ['citrus' => 'pineapple', 'berries' => ['blueberry'], 'others' => ['litchis]']];
        $merge2 = ['citrus' => ['pineapple'], 'berries' => ['blueberry'], 'others' => 'litchis'];

        static::assertSame(
            \array_merge($base, $merge),
            Warray::merge($base, $merge)
        );

        static::assertSame(
            \array_merge($base, $merge, $merge2),
            Warray::merge($base, $merge, $merge2)
        );
    }

    public function testMergeRecursive(): void
    {
        $base = ['citrus' => ['orange'], 'berries' => ['blackberry', 'raspberry'], 'others' => 'banana'];
        $merge = ['citrus' => 'pineapple', 'berries' => ['blueberry'], 'others' => ['litchis]']];
        $merge2 = ['citrus' => ['pineapple'], 'berries' => ['blueberry'], 'others' => 'litchis'];

        static::assertSame(
            \array_merge_recursive($base, $merge),
            Warray::mergeRecursive($base, $merge)
        );

        static::assertSame(
            \array_merge_recursive($base, $merge, $merge2),
            Warray::mergeRecursive($base, $merge, $merge2)
        );
    }

    public function testPad(): void
    {
        $input = [12, 10, 9];
        static::assertSame(\array_pad($input, 5, 0), Warray::pad($input, 5, 0));
        static::assertSame(\array_pad($input, -7, -1), Warray::pad($input, -7, -1));
        static::assertSame(\array_pad($input, 2, 'noop'), Warray::pad($input, 2, 'noop'));
    }

    public function testPop(): void
    {
        $byRef = $input = ['orange', 'banana', 'apple', 'raspberry'];
        \array_pop($byRef);
        static::assertSame($byRef, Warray::pop($input));
    }

    public function testProduct(): void
    {
        $array = [2, 4, 6, 8];
        static::assertSame(\array_product($array), Warray::product($array));
        static::assertSame(\array_product([]), Warray::product([]));
    }

    public function testPush(): void
    {
        $byRef = $input = ['a' => 4, 'b' => 2, 'c' => 8, 'f' => 6, 'd' => 5];
        \array_push($byRef);
        static::assertSame($byRef, Warray::push($input));

        $byRef = $input = ['a' => 4, 'b' => 2, 'c' => 8, 'f' => 6, 'd' => 5];
        \array_push($byRef, 'hey', 'good day', 'oh');
        static::assertSame($byRef, Warray::push($input, 'hey', 'good day', 'oh'));
    }

    public function testRand(): void
    {
        static::markTestSkipped();
    }

    public function testReduce(): void
    {
        $callback = static function ($carry, $item) {
            return $carry * $item * 2;
        };

        $input = [1, 2, 3, 4, 5];

        static::assertSame(\array_reduce($input, $callback), Warray::reduce($callback, $input));
    }

    public function testReplace(): void
    {
        $base = ['citrus' => ['orange'], 'berries' => ['blackberry', 'raspberry'], 'others' => 'banana'];
        $replacements = ['citrus' => 'pineapple', 'berries' => ['blueberry'], 'others' => ['litchis]']];
        $replacements2 = ['citrus' => ['pineapple'], 'berries' => ['blueberry'], 'others' => 'litchis'];

        static::assertSame(
            \array_replace($base, $replacements),
            Warray::replace($base, $replacements)
        );

        static::assertSame(
            \array_replace($base, $replacements, $replacements2),
            Warray::replace($base, $replacements, $replacements2)
        );
    }

    public function testReplaceRecursive(): void
    {
        $base = ['citrus' => ['orange'], 'berries' => ['blackberry', 'raspberry'], 'others' => 'banana'];
        $replacements = ['citrus' => 'pineapple', 'berries' => ['blueberry'], 'others' => ['litchis]']];
        $replacements2 = ['citrus' => ['pineapple'], 'berries' => ['blueberry'], 'others' => 'litchis'];

        static::assertSame(
            \array_replace_recursive($base, $replacements),
            Warray::replaceRecursive($base, $replacements)
        );

        static::assertSame(
            \array_replace_recursive($base, $replacements, $replacements2),
            Warray::replaceRecursive($base, $replacements, $replacements2)
        );
    }

    public function testReverse(): void
    {
        $input = ['php', 4.0, ['green', 'red']];
        static::assertSame(\array_reverse($input), Warray::reverse($input));
        static::assertSame(\array_reverse($input, true), Warray::reverse($input, true));
    }

    public function testSearch(): void
    {
        $haystack = [0 => 'blue', 1 => 'red', 2 => 'green', 3 => 'red'];

        static::assertSame(\array_search('green', $haystack, true), Warray::search('green', $haystack));
        static::assertSame(\array_search('red', $haystack, true), Warray::search('red', $haystack));

        $arrayWithFives = ['a' => '5', 'b' => 5, 'c' => '5'];
        static::assertSame(\array_search(5, $arrayWithFives, true), Warray::search(5, $arrayWithFives));
    }

    public function testShift(): void
    {
        $byRef = $input = ['orange', 'banana', 'apple', 'raspberry'];
        \array_shift($byRef);
        static::assertSame($byRef, Warray::shift($input));
    }

    public function testShuffle(): void
    {
        $numbers = \range(1, 20);

        static::assertNotSame($numbers, Warray::shuffle($numbers));
    }

    public function testSlice(): void
    {
        $inputStringAssoc = ['a' => 'red', 'b' => 'green', 'c' => 'blue', 'd' => 'yellow', 'e' => 'brown'];
        $inputIntAssoc = ['0' => 'red', '1' => 'green', '2' => 'blue', '3' => 'yellow', '4' => 'brown'];

        static::assertSame(
            \array_slice($inputStringAssoc, 2),
            Warray::slice($inputStringAssoc, 2)
        );
        static::assertSame(
            \array_slice($inputStringAssoc, 2, 1),
            Warray::slice($inputStringAssoc, 2, 1)
        );
        static::assertSame(
            \array_slice($inputStringAssoc, -2),
            Warray::slice($inputStringAssoc, -2)
        );

        static::assertSame(
            \array_slice($inputStringAssoc, -2, 1),
            Warray::slice($inputStringAssoc, -2, 1)
        );
        static::assertSame(
            \array_slice($inputStringAssoc, 2, 1, true),
            Warray::slice($inputStringAssoc, 2, 1, true)
        );
        static::assertSame(
            \array_slice($inputIntAssoc, 2),
            Warray::slice($inputIntAssoc, 2)
        );
        static::assertSame(
            \array_slice($inputIntAssoc, 2, 1),
            Warray::slice($inputIntAssoc, 2, 1)
        );
        static::assertSame(
            \array_slice($inputIntAssoc, -2),
            Warray::slice($inputIntAssoc, -2)
        );
        static::assertSame(
            \array_slice($inputIntAssoc, -2, 1),
            Warray::slice($inputIntAssoc, -2, 1)
        );
        static::assertSame(
            \array_slice($inputIntAssoc, 2, 1, true),
            Warray::slice($inputIntAssoc, 2, 1, true)
        );
    }

    public function testSort(): void
    {
        $byRef = $input = [4, 6, 2, 22, 11];
        \sort($byRef);
        static::assertSame($byRef, Warray::sort($input));
    }

    public function testSortReverse(): void
    {
        $byRef = $input = [4, 6, 2, 22, 11];
        \rsort($byRef);
        static::assertSame($byRef, Warray::sortReverse($input));
    }

    public function testUserSort(): void
    {
        $callback = static function ($a, $b) {
            $a = $a % 13;
            $b = $b % 13;

            return $a <=> $b;
        };

        $byRef = $input = [4, 6, 2, 22, 11];
        \usort($byRef, $callback);
        static::assertSame($byRef, Warray::userSort($callback, $input));
    }

    public function testSortAssociative(): void
    {
        $byRef = $input = ['Peter' => '35', 'Ben' => '37', 'Joe' => '43'];
        \asort($byRef);
        static::assertSame($byRef, Warray::sortAssociative($input));
    }

    public function testSortAssociativeReverse(): void
    {
        $byRef = $input = ['Peter' => '35', 'Ben' => '37', 'Joe' => '43'];
        \arsort($byRef);
        static::assertSame($byRef, Warray::sortAssociativeReverse($input));
    }

    public function testSortUserAssociative(): void
    {
        $callback = static function ($a, $b) {
            return $a <=> $b;
        };

        $byRef = $input = ['a' => 4, 'b' => 2, 'c' => 8, 'f' => 6, 'd' => 5];
        \uasort($byRef, $callback);
        static::assertSame($byRef, Warray::sortUserAssociative($callback, $input));
    }

    public function testSortKey(): void
    {
        $byRef = $input = ['Peter' => '35', 'Ben' => '37', 'Joe' => '43'];
        \ksort($byRef);
        static::assertSame($byRef, Warray::sortKey($input));
    }

    public function testSortKeyReverse(): void
    {
        $byRef = $input = ['Peter' => '35', 'Ben' => '37', 'Joe' => '43'];
        \krsort($byRef);
        static::assertSame($byRef, Warray::sortKeyReverse($input));
    }

    public function testSortUserKey(): void
    {
        $callback = static function ($a, $b) {
            return $a <=> $b;
        };

        $byRef = $input = ['a' => 4, 'b' => 2, 'c' => 8, 'f' => 6, 'd' => 5];
        \uksort($byRef, $callback);
        static::assertSame($byRef, Warray::sortUserKey($callback, $input));
    }

    public function testSortMultiple(): void
    {
        static::markTestSkipped();
    }

    public function testSortNatural(): void
    {
        $byRef = $input = ['img12.png', 'img10.png', 'img2.png', 'img1.png'];
        \natsort($byRef);
        static::assertSame($byRef, Warray::sortNatural($input));
    }

    public function testSortNaturalInsensitive(): void
    {
        $byRef = $input = ['img12.png', 'img10.png', 'img2.png', 'img1.png'];
        \natcasesort($byRef);
        static::assertSame($byRef, Warray::sortNaturalInsensitive($input));
    }

    public function testSplice(): void
    {
        $byRef = $input = ['a' => 'red', 'b' => 'green', 'c' => 'blue', 'd' => 'yellow', 'e' => 'brown'];

        \array_splice($byRef, 2);
        static::assertSame(
            $byRef,
            Warray::splice($input, 2)
        );

        $byRef = $input = ['a' => 'red', 'b' => 'green', 'c' => 'blue', 'd' => 'yellow', 'e' => 'brown'];

        \array_splice($byRef, 1, -1);
        static::assertSame(
            $byRef,
            Warray::splice($input, 1, -1)
        );

        $byRef = $input = ['a' => 'red', 'b' => 'green', 'c' => 'blue', 'd' => 'yellow', 'e' => 'brown'];

        \array_splice($byRef, 1, \count($input), ['orange']);
        static::assertSame(
            $byRef,
            Warray::splice($input, 1, \count($input), ['orange'])
        );
        static::assertSame(
            $byRef,
            Warray::splice($input, 1, null, ['orange'])
        );

        $byRef = $input = ['a' => 'red', 'b' => 'green', 'c' => 'blue', 'd' => 'yellow', 'e' => 'brown'];

        \array_splice($byRef, -1, 1, ['black', 'maroon']);
        static::assertSame(
            $byRef,
            Warray::splice($input, -1, 1, ['black', 'maroon'])
        );

        $byRef = $input = ['a' => 'red', 'b' => 'green', 'c' => 'blue', 'd' => 'yellow', 'e' => 'brown'];

        \array_splice($byRef, 3, 0, ['purple']);
        static::assertSame(
            $byRef,
            Warray::splice($input, 3, 0, ['purple'])
        );

        $byRef = $input = ['a' => 'red', 'b' => 'green', 'c' => 'blue', 'd' => 'yellow', 'e' => 'brown'];

        \array_splice($byRef, 1, -1, ['a' => 'purple', 'b' => 'orange']);
        static::assertSame(
            $byRef,
            Warray::splice($input, 1, -1, ['a' => 'purple', 'b' => 'orange'])
        );
    }

    public function testSum(): void
    {
        $array = [2, 4, 6, 8];
        static::assertSame(\array_sum($array), Warray::sum($array));
        static::assertSame(\array_sum([]), Warray::sum([]));
    }

    public function testUnique(): void
    {
        $input = ['a' => 'green', 'red', 'b' => 'green', 'blue', 'red'];
        static::assertSame(\array_unique($input), Warray::unique($input));

        $input = [4, '4', '3', 4, 3, '3'];
        static::assertSame(\array_unique($input, \SORT_REGULAR), Warray::unique($input));

        $input = [4, '4', '3', 4, 3, '3'];
        static::assertSame(\array_unique($input), Warray::unique($input, \SORT_STRING));
    }

    public function testUnshift(): void
    {
        $byRef = $input = ['a' => 4, 'b' => 2, 'c' => 8, 'f' => 6, 'd' => 5];
        \array_unshift($byRef);
        static::assertSame($byRef, Warray::unshift($input));

        $byRef = $input = ['a' => 4, 'b' => 2, 'c' => 8, 'f' => 6, 'd' => 5];
        \array_unshift($byRef, 'hey', 'good day', 'oh');
        static::assertSame($byRef, Warray::unshift($input, 'hey', 'good day', 'oh'));
    }

    public function testValues(): void
    {
        $input = ['Name' => 'Peter', 'Age' => '41', 'Country' => 'USA'];
        static::assertSame(\array_values($input), Warray::values($input));
    }

    public function testWalk(): void
    {
        static::markTestSkipped();
    }

    public function testWalkRecursive(): void
    {
        static::markTestSkipped();
    }
}
