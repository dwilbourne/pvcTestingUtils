<?php
/**
 * @package: pvc
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 * @version: 1.0
 */

namespace pvc\testingutils\testingTraits;

use RangeException;

/**
 * Trait RandomStringGeneratorTrait
 */
trait RandomStringGeneratorTrait
{

    protected string $keySpace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    public function getKeyspace() : string
    {
        return $this->keySpace;
    }

    public function setKeyspace(string $ks) : void
    {
        $this->keySpace = $ks;
    }

    /**
     * Generate a random string
     *
     * @param int $length      How many characters do we want?
     * @return string
     */

    public function randomString(int $length = 64): string
    {
        if ($length < 1) {
            throw new RangeException("random_str error: Length must be a positive integer");
        }
        $pieces = [];
        $max = mb_strlen($this->getKeyspace(), '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $pieces []= $this->keySpace[random_int(0, $max)];
        }
        return implode('', $pieces);
    }
}
