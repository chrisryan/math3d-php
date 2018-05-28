<?php

namespace chrisryan\Math3d;

use PHPUnit\Framework\TestCase;

/**
 * Test the Vector class
 *
 * @coversDefaultClass \chrisryan\Math3d\Vector
 * @covers ::<private>
 */
final class VectorTest extends TestCase {
    /**
     * Provider for testing that functions do not accept invalid arguments.
     * Used by several tests.
     *
     * @return an array of arguments to test
     */
    public function vectorInvalidArgumentsProvider() {
        return [
            'Number' => [3.14],
            'String' => ['{1, 2, 3}'],
            'Object' => [new \stdClass()],
        ];
    }

    /**
     * @test
     * @covers ::__construct
     */
    public function constructorNoArgument() {
        $v = new Vector();

        $this->assertSame([0, 0, 0], $v->v());
    }

    /**
     * @test
     * @dataProvider constructorAcceptsArrayProvider
     * @covers ::__construct
     * @covers ::v
     */
    public function constructorAcceptsArray($param, $expected) {
        $v = new Vector($param);

        $this->assertSame($expected, $v->v());
    }

    public function constructorAcceptsArrayProvider() {
        return [
            'Empty Array' => [[], [0, 0, 0]],
            'One Element' => [[1], [1, 0, 0]],
            'Two Element' => [[1, 2], [1, 2, 0]],
            'Three Element' => [[1, 2, 3], [1, 2, 3]],
            'Four Element' => [[1, 2, 3, 4], [1, 2, 3, 4]],
        ];
    }

    /**
     * @test
     * @covers ::__construct
     * @covers ::v
     */
    public function constructorAcceptsVector() {
        $expected = [1, 2, 3];
        $v = new Vector($expected);
        $vv = new Vector($v);

        $this->assertSame($expected, $vv->v());
    }

    /**
     * @test
     * @dataProvider vectorInvalidArgumentsProvider
     * @covers ::__construct
     * @expectedException \InvalidArgumentException
     */
    public function constructorInvalidArguments($param) {
        $v = new Vector($param);
    }

    /**
     * @test
     * @dataProvider addProvider
     * @covers ::add
     */
    public function addVectors($a, $b, $expected) {
        $va = new Vector($a);
        $vb = new Vector($b);

        $this->assertSame($expected, $va->add($vb)->v());
    }

    /**
     * @test
     * @dataProvider addProvider
     * @covers ::add
     */
    public function addArrays($a, $b, $expected) {
        $va = new Vector($a);

        $this->assertSame($expected, $va->add($b)->v());
    }

    public function addProvider() {
        return [
            'X dimension' => [[1], [1], [2, 0, 0]],
            'Y dimension' => [[0, 1], [0, 1], [0, 2, 0]],
            'Z dimension' => [[0, 0, 1], [0, 0, 1], [0, 0, 2]],
            'Simple' => [[3, 1, 5], [2, 3, 6], [5, 4, 11]],
            'Decimals' => [[3.2, 1.8, 5.3], [2.3, 3.1, 6.79], [5.5, 4.9, 12.09]],
            'Simple' => [[3, -1, 5], [-2, 3, -6], [1, 2, -1]],
        ];
    }

    /**
     * @test
     * @dataProvider vectorInvalidArgumentsProvider
     * @covers ::add
     * @expectedException \InvalidArgumentException
     */
    public function addInvalidArguments($param) {
        $v = new Vector($param);
    }

    /**
     * @test
     * @dataProvider subtractProvider
     * @covers ::subtract
     */
    public function subtractVectors($a, $b, $expected) {
        $va = new Vector($a);
        $vb = new Vector($b);

        $this->assertEquals($expected, $va->subtract($vb)->v());
    }

    /**
     * @test
     * @dataProvider subtractProvider
     * @covers ::subtract
     */
    public function subtractArrays($a, $b, $expected) {
        $va = new Vector($a);

        $this->assertEquals($expected, $va->subtract($b)->v());
    }

    public function subtractProvider() {
        return [
            'X dimension' => [[3], [1], [2, 0, 0]],
            'Y dimension' => [[0, 3], [0, 1], [0, 2, 0]],
            'Z dimension' => [[0, 0, 3], [0, 0, 1], [0, 0, 2]],
            'Simple' => [[3, 1, 5], [2, 3, 6], [1, -2, -1]],
            'Decimals' => [[3.2, 1.8, 5.3], [2.3, 3.1, 6.79], [0.9, -1.3, -1.49]],
            'Simple' => [[3, -1, 5], [-2, 3, -6], [5, -4, 11]],
        ];
    }

    /**
     * @test
     * @dataProvider vectorInvalidArgumentsProvider
     * @covers ::subtract
     * @expectedException \InvalidArgumentException
     */
    public function subtractInvalidArguments($param) {
        $v = new Vector($param);
    }

    /**
     * @test
     * @dataProvider multiplyProvider
     * @covers ::multiply
     */
    public function multiplyVectors($a, $b, $expected) {
        $va = new Vector($a);
        $vb = new Vector($b);

        $this->assertEquals($expected, $va->multiply($vb)->v());
    }

    /**
     * @test
     * @dataProvider multiplyProvider
     * @covers ::multiply
     */
    public function multiplyArrays($a, $b, $expected) {
        $va = new Vector($a);

        $this->assertEquals($expected, $va->multiply($b)->v());
    }

    public function multiplyProvider() {
        return [
            'X dimension' => [[1], [1], [1, 0, 0]],
            'Y dimension' => [[0, 1], [0, 1], [0, 1, 0]],
            'Z dimension' => [[0, 0, 1], [0, 0, 1], [0, 0, 1]],
            'Simple' => [[3, 1, 5], [2, 3, 6], [6, 3, 30]],
            'Decimals' => [[3.2, 1.8, 5.3], [2.3, 3.1, 6.79], [7.36, 5.58, 35.987]],
            'Simple' => [[3, -1, 5], [-2, 3, -6], [-6, -3, -30]],
        ];
    }

    /**
     * @test
     * @dataProvider vectorInvalidArgumentsProvider
     * @covers ::multiply
     * @expectedException \InvalidArgumentException
     */
    public function multiplyInvalidArguments($param) {
        $v = new Vector();
        $v->multiply($param);
    }

    /**
     * @test
     * @dataProvider scaleProvider
     * @covers ::scale
     */
    public function scale($values, $factor, $expected) {
        $v = new Vector($values);
        $this->assertEquals($expected, $v->scale($factor)->v());
    }

    public function scaleProvider() {
        return [
            'Positive Whole' => [[3, 2, 4], 2, [6, 4, 8]],
            'Negative Whole' => [[3, 2, 4], -2, [-6, -4, -8]],
            'Postive Fractional' => [[3, 2, 4], 0.2, [0.6, 0.4, 0.8]],
            'Negative Fractional' => [[3, 2, 4], -0.2, [-0.6, -0.4, -0.8]],
            'Identity' => [[3, 2, 4], 1, [3, 2, 4]],
            'Zero' => [[3, 2, 4], 0, [0, 0, 0]],
            'Numeric String' => [[3, 2, 4], '2', [6, 4, 8]],
        ];
    }

    /**
     * @test
     * @dataProvider scaleInvalidArgumentsProvider
     * @covers ::scale
     * @expectedException \InvalidArgumentException
     */
    public function scaleInvalidArguments($param) {
        $v = new Vector();
        $v->scale($param);
    }

    public function scaleInvalidArgumentsProvider() {
        return [
            ['string'],
            [[]],
            [new \stdClass()],
            [new Vector([2, 4, 5])],
        ];
    }

    /**
     * @test
     * @dataProvider magnitudeProvider
     * @covers ::magnitude
     */
    public function magnitude($values, $expected) {
        $v = new Vector($values);
        $this->assertEquals($expected, $v->magnitude(), '', 0.000001);
    }

    public function magnitudeProvider() {
        return [
            'One Dimension' => [[0, 2, 0], 2.0],
            'Two Dimensions' => [[4, 3, 0], 5.0],
            'Three Dimensions' => [[1, 2, 2], 3.0],
            'Floats' => [[1.3, 2.2, 4.8], 5.437830449],
            'Zero' => [[0, 0, 0], 0.0],
        ];
    }

    /**
     * @test
     * @dataProvider dotProvider
     * @covers ::dot
     */
    public function dot($valuesA, $valuesB, $expected) {
        $vA = new Vector($valuesA);
        $vB = new Vector($valuesB);
        $this->assertEquals($expected, $vA->dot($vB), '', 0.000001);
    }

    public function dotProvider() {
        return [
            [[1, 2, 3], [4, -5, 6], 12],
            [[-4, -9, 0], [-1, 2, 0], -14],
            [[6, -1, 3], [4, 18, -2], 0],
        ];
    }
}
