<?php

use ShipMonk\ComposerDependencyAnalyser\Config\Configuration;
use ShipMonk\ComposerDependencyAnalyser\Config\ErrorType;

return (new Configuration())
    ->ignoreErrorsOnPackage('psr/http-client-implementation', [ErrorType::UNUSED_DEPENDENCY])
    ->ignoreErrorsOnPackage('psr/http-factory-implementation', [ErrorType::UNUSED_DEPENDENCY])
;
