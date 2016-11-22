<?php
/**
 * @link http://magento.stackexchange.com/questions/143976/best-practice-for-unit-tests-in-magento-1-9
 */

// This path assumes this file is installed inside the webroot
//require __DIR__ . '/../../../../../../lib/DigitalPianism/TestFramework/Helper/Magento.php';

// This path assumes this file is stored outside the webroot and symlinked in
require __DIR__ . '/../../../../../../../www/lib/DigitalPianism/TestFramework/Helper/Magento.php';
DigitalPianism_TestFramework_Helper_Magento::bootstrap();