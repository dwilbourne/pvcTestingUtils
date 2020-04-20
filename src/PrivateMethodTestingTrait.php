<?php
/**
 * @package: pvc
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 * @version: 1.0
 */

namespace pvc\testingTraits;


use ReflectionClass;

/**
 * Trait PrivateMethodTestingTrait
 *
 * Theory says that you don't need to or shouldn't directly test private methods: that you should test
 * the results of those methods having run.  But in practice, this may be helpful....
 *
 */
trait PrivateMethodTestingTrait {

    public function invokeMethod(&$object, string $methodName, array $parameters = []) {
        $reflection = new ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);
        return $method->invokeArgs($object, $parameters);
    }
}