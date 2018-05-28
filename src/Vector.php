<?php

namespace chrisryan\Math3d;

final class Vector {
    private $_v = null;

    public function __construct($v = []) {
        $this->assertValid($v);

        if (is_object($v)) {
            $v = $v->v();
        }

        $this->_v = array_replace([0, 0, 0], $v);
    }

    /**
     * @return array the array data for this Vector
     */
    public function v() {
        return $this->_v;
    }

    public function add($v) {
        $this->assertValid($v);

        if (is_object($v)) {
            $v = $v->v();
        }

        $r = [];

        $n = max(count($this->_v), count($v));
        for ($i = 0; $i < $n; $i++) {
            $a = 0;
            if (isset($this->_v[$i])) {
                $a = $this->_v[$i];
            }

            $b = 0;
            if (isset($v[$i])) {
                $b = $v[$i];
            }

            $r[$i] = $a + $b;
        }

        return new Vector($r);
    }

    public function multiply($v) {
        $this->assertValid($v);

        if (is_object($v)) {
            $v = $v->v();
        }

        $r = [];
        $n = max(count($this->_v), count($v));
        for ($i = 0; $i < $n; $i++) {
            $a = 0;
            if (isset($this->_v[$i])) {
                $a = $this->_v[$i];
            }

            $b = 0;
            if (isset($v[$i])) {
                $b = $v[$i];
            }

            $r[$i] = $a * $b;
        }

        return new Vector($r);
    }

    /**
     * scales all elements of the vector by the value passed in.
     *
     * @throws \InvalidArgumentException
     * @return \chrisryan\Math3d\Vector the new modified vector.
     */
    public function scale($s) {
        if (!is_numeric($s)) {
            throw new \InvalidArgumentException();
        }

        return $this->multiply(array_fill(0, count($this->_v), $s));
    }

    public function subtract($v) {
        $this->assertValid($v);

        if (is_array($v)) {
            $v = new Vector($v);
        }

        return $this->add($v->scale(-1));
    }

    public function magnitude() {
        $sqTotal = 0;
        foreach ($this->_v as $u) {
            $sqTotal += pow($u, 2);
        }

        return sqrt($sqTotal);
    }

    public function dot($v) {
        $this->assertValid($v);

        if (is_object($v)) {
            $v = $v->v();
        }

        $r = 0;

        $n = min(count($this->_v), count($v));
        for ($i = 0; $i < $n; $i++) {
            $a = 0;
            if (isset($this->_v[$i])) {
                $a = $this->_v[$i];
            }

            $b = 0;
            if (isset($v[$i])) {
                $b = $v[$i];
            }

            $r += $a * $b;
        }

        return $r;
    }

    /**
     * Helper method for verifying input is either a valid array or the expected object.
     *
     * @throws \InvalidArgumentException
     */
    private function assertValid($v) {
        if (!is_array($v) && !is_a($v, '\chrisryan\Math3d\Vector')) {
            throw new \InvalidArgumentException();
        }
    }
}
