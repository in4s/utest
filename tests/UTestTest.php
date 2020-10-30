<?php
/** in4s\UTest */

declare(strict_types=1);

namespace in4s;

/**
 * Class UTestTest - Tests for class UTest
 *
 * @version     v2.2.0 2020-10-22 16:47:39
 * @package     in4s\UTest
 * @author      Eugeniy Makarkin
 */
class UTestTest
{
    const CLASS_FILE_NAME_WITH_PATH = __DIR__ . '/../src/UTest.php';

    /**
     * Run tests of the current class
     *
     * @return void
     */
    public static function run()
    {
        echo '<div class="utest__section">';
        echo '<h5 class="utest__module-name">UTest:</h5>';
        echo self::isEqualTest();
        echo self::theValueTest();
        echo self::setSuperglobalEmulationTest();
        echo self::unsetSuperglobalEmulationTest();
        echo self::setServerEmulationTest();
        echo self::unsetServerEmulationTest();
        // echo self::considerTestTest();
        echo self::setClassEmulationTest();
        echo self::unsetClassEmulationTest();
        echo '</div>';
    }

    /**
     * isEqual method test
     *
     * @return string - html tag with the message of the test result
     */
    public static function isEqualTest(): string
    {
        global $UTest;

        $UTest->methodName = 'isEqual';
        $UTest1 = new UTest();


        // Arrange Test
        $UTest->nextHint = 'The simplest check true == true';
        $UTest1->methodName = 'isEqual';
        $UTest1->nextHint = 'The simplest check true == true';
        $expect = '<h6 class="utest__method-name">isEqual():</h6><div class="utest__result utest__result_true" data-j4c="The simplest check true == true">true==true</div>';
        // Act
        $UTest1->isEqual('true==true', true, true);
        $act = $UTest1->functionResults;
        // Assert Test
        $UTest->isEqual("isEqual('true==true', true, true);", $expect, $act);


        // Arrange Test
        $UTest->nextHint = 'The simplest check false == false';
        $UTest1->methodName = 'isEqual';
        $UTest1->nextHint = 'The simplest check false == false';
        $expect = '<h6 class="utest__method-name">isEqual():</h6><div class="utest__result utest__result_true" data-j4c="The simplest check false == false">false==false</div>';
        // Act
        $UTest1->isEqual('false==false', false, false);
        $act = $UTest1->functionResults;
        // Assert Test
        $UTest->isEqual("isEqual('false==false', false, false);", $expect, $act);


        // Arrange Test
        $UTest->nextHint = 'With < html> tag on a popup comment';
        $UTest1->methodName = 'isEqual';
        $UTest1->nextHint = 'With < html> tag on a popup comment';
        $expect = '<h6 class="utest__method-name">isEqual():</h6><div class="utest__result utest__result_true" data-j4c="With &lt; html&gt; tag on a popup comment">false==false</div>';
        // Act
        $UTest1->isEqual('false==false', false, false);
        $act = $UTest1->functionResults;
        // Assert Test
        $UTest->isEqual("isEqual('false==false', false, false); +", $expect, $act);


        return $UTest->functionResults;
    }

    /**
     * theValue method test
     *
     * @return string - html tag with the message of the test result
     */
    public static function theValueTest(): string
    {
        global $UTest;

        $UTest->methodName = 'theValue';


        // Arrange Test
        $UTest->nextHint = 'If the value = 5';
        $expect = '<strong class="utest__value"><pre>5</pre></strong>';
        // Act
        $act = $UTest->theValue(5);
        // Assert Test
        $UTest->isEqual("theValue(5);", $expect, $act);


        // Arrange Test
        $UTest->nextHint = 'If the value = true';
        $expect = '<strong class="utest__value"><pre>true</pre></strong>';
        // Act
        $act = $UTest->theValue(true);
        // Assert Test
        $UTest->isEqual("theValue(true);", $expect, $act);


        // Arrange Test
        $UTest->nextHint = 'If the value = false';
        $expect = '<strong class="utest__value"><pre>false</pre></strong>';
        // Act
        $act = $UTest->theValue(false);
        // Assert Test
        $UTest->isEqual("theValue(false);", $expect, $act);


        return $UTest->functionResults;
    }

    /**
     * SetSuperglobalEmulation method test
     *
     * @return string - html tag with the message of the test result
     */
    public static function setSuperglobalEmulationTest(): string
    {
        global $UTest;

        $UTest->methodName = 'setSuperglobalEmulation';


        // Arrange Test
        $UTest->nextHint = 'Emulate HTTP_HOST to google.com';
        $expect = 'google.com';
        // Act
        $UTest->setSuperglobalEmulation('_SERVER', 'HTTP_HOST', 'google.com');
        $act = $_SERVER['HTTP_HOST'];
        $UTest->unsetSuperglobalEmulation('_SERVER', 'HTTP_HOST');
        // Assert Test
        $UTest->isEqual("setSuperglobalEmulation('_SERVER', 'HTTP_HOST', 'google.com')", $expect, $act);


        // Arrange Test
        $UTest->nextHint = 'Emulate gettest to getvalue';
        $expect = 'getvalue';
        // Act
        $UTest->setSuperglobalEmulation('_GET', 'gettest', 'getvalue');
        $act = $_GET['gettest'];
        $UTest->unsetSuperglobalEmulation('_GET', 'gettest');
        // Assert Test
        $UTest->isEqual("setSuperglobalEmulation('_GET', 'gettest', 'getvalue')", $expect, $act);


        return $UTest->functionResults;
    }

    /**
     * UnsetSuperglobalEmulation '_SERVER', method test
     *
     * @return string - html tag with the message of the test result
     */
    public static function unsetSuperglobalEmulationTest(): string
    {
        global $UTest;

        $UTest->methodName = 'unsetSuperglobalEmulation';


        // Arrange Test
        $UTest->nextHint = 'Unset emulation HTTP_HOST';
        $expect = $_SERVER['HTTP_HOST'];
        // Act
        $UTest->setSuperglobalEmulation('_SERVER', 'HTTP_HOST', 'google.com');
        $UTest->unsetSuperglobalEmulation('_SERVER', 'HTTP_HOST');
        $act = $_SERVER['HTTP_HOST'];
        // Assert Test
        $UTest->isEqual("unsetSuperglobalEmulation('_SERVER', 'HTTP_HOST')", $expect, $act);


        // Arrange Test
        $UTest->nextHint = 'Unset emulation SERVER_ADDR';
        $expect = $_GET['gettest'];
        // Act
        $UTest->setSuperglobalEmulation('_GET', 'gettest', 'getvalue');
        $UTest->unsetSuperglobalEmulation('_GET', 'gettest');
        $act = $_GET['gettest'];
        // Assert Test
        $UTest->isEqual("unsetSuperglobalEmulation('_GET', 'gettest')", $expect, $act);


        return $UTest->functionResults;
    }


    /**
     * SetServerEmulation method test
     *
     * @return string - html tag with the message of the test result
     */
    public static function setServerEmulationTest(): string
    {
        global $UTest;

        $UTest->methodName = 'setServerEmulation';


        // Arrange Test
        $UTest->nextHint = 'Emulate HTTP_HOST to google.com';
        $expect = 'google.com';
        // Act
        $UTest->setServerEmulation('HTTP_HOST', 'google.com');
        $act = $_SERVER['HTTP_HOST'];
        $UTest->unsetServerEmulation('HTTP_HOST');
        // Assert Test
        $UTest->isEqual("setServerEmulation('HTTP_HOST', 'google.com')", $expect, $act);


        // Arrange Test
        $UTest->nextHint = 'Emulate SERVER_ADDR to 1.1.1.1';
        $expect = '1.1.1.1';
        // Act
        $UTest->setServerEmulation('SERVER_ADDR', '1.1.1.1');
        $act = $_SERVER['SERVER_ADDR'];
        $UTest->unsetServerEmulation('SERVER_ADDR');
        // Assert Test
        $UTest->isEqual("setServerEmulation('SERVER_ADDR', '1.1.1.1')", $expect, $act);


        return $UTest->functionResults;
    }

    /**
     * UnsetServerEmulation method test
     *
     * @return string - html tag with the message of the test result
     */
    public static function unsetServerEmulationTest(): string
    {
        global $UTest;

        $UTest->methodName = 'unsetServerEmulation';


        // Arrange Test
        $UTest->nextHint = 'Unset emulation HTTP_HOST';
        $expect = $_SERVER['HTTP_HOST'];
        // Act
        $UTest->setServerEmulation('HTTP_HOST', 'google.com');
        $UTest->unsetServerEmulation('HTTP_HOST');
        $act = $_SERVER['HTTP_HOST'];
        // Assert Test
        $UTest->isEqual("unsetServerEmulation('HTTP_HOST')", $expect, $act);


        // Arrange Test
        $UTest->nextHint = 'Unset emulation SERVER_ADDR';
        $expect = $_SERVER['SERVER_ADDR'];
        // Act
        $UTest->setServerEmulation('SERVER_ADDR', '1.1.1.1');
        $UTest->unsetServerEmulation('SERVER_ADDR');
        $act = $_SERVER['SERVER_ADDR'];
        // Assert Test
        $UTest->isEqual("unsetServerEmulation('SERVER_ADDR')", $expect, $act);


        return $UTest->functionResults;
    }

    /**
     * SetClassEmulation method test
     *
     * @return string - html tag with the message of the test result
     */
    public static function setClassEmulationTest(): string
    {
        global $UTest;

        $UTest->methodName = 'setClassEmulation';
        $methodToReport = 'setClassEmulation(UTEST, [[search, replace], [search, replace]])';

        // Act
        $UTest->setClassEmulation(
            self::CLASS_FILE_NAME_WITH_PATH,
            [
                ['$GLOBALS[', '$globalsTest['],
            ]
        );

        // Assert Tests
        // TODO: Check that the new file is not yet exist
        $UTest->nextHint = 'The file UTestUTCopy.php is created';
        $newFileNameWithPath = __DIR__ . '/../src/UTestUTCopy.php';
        $fileIsCreated = file_exists($newFileNameWithPath);
        $UTest->isEqual("{$methodToReport} - Step 1 - file copy is created", true, $fileIsCreated);

        // Test: the file does not contain "class UTest\n{" 
        $UTest->nextHint = 'The class copy does not contain old class name';
        $newFileContent = file_get_contents($newFileNameWithPath);
        $act = strpos($newFileContent, "class UTest\n{");
        $UTest->isEqual("{$methodToReport} - Step 2 - no replaced text", false, $act);

        // Test: the file contains "class UTestUTCopy\n{"
        $UTest->nextHint = 'The class copy contains new class name';
        $act = strpos($newFileContent, "class UTestUTCopy\n{") !== false;
        $UTest->isEqual("{$methodToReport} - Step 3 - contains new class name", true, $act);

        // Test: the file does not contain "$GLOBALS["
        $UTest->nextHint = 'The class copy file does not contain old text';
        $act = strpos($newFileContent, "\$GLOBALS[");
        $UTest->isEqual("{$methodToReport} - Step 4 - no replaced text", false, $act);

        // Test: the file contains "$globalsTest["
        $UTest->nextHint = 'The class copy file contains new text';
        $act = strpos($newFileContent, "\$globalsTest[") !== false;
        $UTest->isEqual("{$methodToReport} - Step 5 - contains new text", true, $act);

        // Session uTestTemporaryFiles is set
        $UTest->nextHint = 'Session uTestTemporaryFiles is set';
        $act = isset($_SESSION['uTestTemporaryFiles'][$newFileNameWithPath]);
        $UTest->isEqual("{$methodToReport} - Step 6 - session is set", true, $act);

        // Unset method testing environment
        $UTest->unsetClassEmulation(self::CLASS_FILE_NAME_WITH_PATH);


        $methodToReport = 'setClassEmulation(UTEST, [search, replace])';
        // Act
        $UTest->setClassEmulation(self::CLASS_FILE_NAME_WITH_PATH, ['$GLOBALS[', '$globalsTest[']);

        // Assert Tests
        // TODO: Check that the new file is not yet exist
        $UTest->nextHint = 'The file UTestUTCopy.php is created';
        $newFileNameWithPath = __DIR__ . '/../src/UTestUTCopy.php';
        $fileIsCreated = file_exists($newFileNameWithPath);
        $UTest->isEqual("{$methodToReport} - Step 1 - file copy is created", true, $fileIsCreated);

        // Test: the file does not contain "class UTest\n{"
        $UTest->nextHint = 'The class copy does not contain old class name';
        $newFileContent = file_get_contents($newFileNameWithPath);
        $act = strpos($newFileContent, "class UTest\n{");
        $UTest->isEqual("{$methodToReport} - Step 2 - no replaced text", false, $act);

        // Test: the file contains "class UTestUTCopy\n{"
        $UTest->nextHint = 'The class copy contains new class name';
        $act = strpos($newFileContent, "class UTestUTCopy\n{") !== false;
        $UTest->isEqual("{$methodToReport} - Step 3 - contains new class name", true, $act);

        // Test: the file does not contain "$GLOBALS["
        $UTest->nextHint = 'The class copy file does not contain old text';
        $act = strpos($newFileContent, "\$GLOBALS[");
        $UTest->isEqual("{$methodToReport} - Step 4 - no replaced text", false, $act);

        // Test: the file contains "$globalsTest["
        $UTest->nextHint = 'The class copy file contains new text';
        $act = strpos($newFileContent, "\$globalsTest[") !== false;
        $UTest->isEqual("{$methodToReport} - Step 5 - contains new text", true, $act);

        // Session uTestTemporaryFiles is set
        $UTest->nextHint = 'Session uTestTemporaryFiles is set';
        $act = isset($_SESSION['uTestTemporaryFiles'][$newFileNameWithPath]);
        $UTest->isEqual("{$methodToReport} - Step 6 - session is set", true, $act);


        return $UTest->functionResults;
    }

    /**
     * UnsetClassEmulation method test
     *
     * @return string - html tag with the message of the test result
     */
    public static function unsetClassEmulationTest(): string
    {
        global $UTest;

        $UTest->methodName = 'unsetClassEmulation';

        // Pre-checks
        $UTest->nextHint = 'Does UTestUTCopy.php file exist';
        $newFileNameWithPath = __DIR__ . '/../src/UTestUTCopy.php';
        $fileIsExist = file_exists($newFileNameWithPath);
        $UTest->isEqual("unsetClassEmulation(UTEST) - Step 1 - file is exist", true, $fileIsExist);

        // Session uTestTemporaryFiles is set
        $UTest->nextHint = 'Session uTestTemporaryFiles is set';
        $act = isset($_SESSION['uTestTemporaryFiles'][$newFileNameWithPath]);
        $UTest->isEqual("unsetClassEmulation(UTEST) - Step 2 - session is set", true, $act);

        // Act
        $UTest->unsetClassEmulation(self::CLASS_FILE_NAME_WITH_PATH);

        $UTest->nextHint = 'Does UTestUTCopy.php file not exist';
        $newFileNameWithPath = __DIR__ . '/../src/UTestUTCopy.php';
        $fileIsExist = file_exists($newFileNameWithPath);
        $UTest->isEqual("unsetClassEmulation(UTEST) - Step 3 - file does not exist", false, $fileIsExist);

        // Session uTestTemporaryFiles is set
        $UTest->nextHint = 'Session uTestTemporaryFiles is not set';
        $act = isset($_SESSION['uTestTemporaryFiles'][$newFileNameWithPath]);
        $UTest->isEqual("unsetClassEmulation(UTEST) - Step 4 - session is not set", false, $act);


        return $UTest->functionResults;
    }

    /**
     * ConsiderTest method test
     *
     * @return string - html tag with the message of the test result
     */
    public static function considerTestTest(): string
    {
        global $UTest;

        $UTest->methodName = 'considerTest';


        // Arrange Test
        $UTest->nextHint = 'True for the same module';
        $expect = '1111';
        $totalNumberOfFailedTests = $UTest->totalNumberOfFailedTests;
        $numberOfFailedUnitTests = $UTest->numberOfFailedUnitTests;
        $totalTestsNumber = $UTest->totalTestsNumber;
        $unitTestsNumber = $UTest->unitTestsNumber;
        // Act
        $UTest->considerTest(true);
        $t1 = $totalNumberOfFailedTests === $UTest->totalNumberOfFailedTests;
        $t2 = $numberOfFailedUnitTests === $UTest->numberOfFailedUnitTests;
        $t3 = $totalTestsNumber === $UTest->totalTestsNumber - 1;
        $t4 = $unitTestsNumber === $UTest->unitTestsNumber - 1;
        $act = $t1 . $t2 . $t3 . $t4;
        // Assert Test
        $UTest->isEqual("considerTest(true)", $expect, $act);


        // Arrange Test
        $UTest->nextHint = 'False for the same module';
        $expect = '1111';
        $totalNumberOfFailedTests = $UTest->totalNumberOfFailedTests;
        $numberOfFailedUnitTests = $UTest->numberOfFailedUnitTests;
        $totalTestsNumber = $UTest->totalTestsNumber;
        $unitTestsNumber = $UTest->unitTestsNumber;
        // Act
        $UTest->considerTest(false);
        $t1 = $totalNumberOfFailedTests === $UTest->totalNumberOfFailedTests - 1 ? 1 : 0;
        $t2 = $numberOfFailedUnitTests === $UTest->numberOfFailedUnitTests - 1 ? 1 : 0;
        $t3 = $totalTestsNumber === $UTest->totalTestsNumber - 1 ? 1 : 0;
        $t4 = $unitTestsNumber === $UTest->unitTestsNumber - 1 ? 1 : 0;
        $act = $t1 . $t2 . $t3 . $t4;
        // Assert Test
        $UTest->isEqual("considerTest(false)", $expect, $act);


        // Arrange Test
        $UTest->nextHint = 'False for the new module';
        $expect = '1111';
        $totalNumberOfFailedTests = $UTest->totalNumberOfFailedTests;
        $numberOfFailedUnitTests = $UTest->numberOfFailedUnitTests;
        $totalTestsNumber = $UTest->totalTestsNumber;
        $unitTestsNumber = $UTest->unitTestsNumber;
        // Act
        $UTest->lastModuleName = 'Lorem';
        $UTest->considerTest(false);
        $t1 = $totalNumberOfFailedTests === $UTest->totalNumberOfFailedTests - 1 ? 1 : 0;
        $t2 = $UTest->numberOfFailedUnitTests === 1 ? 1 : 0;
        $t3 = $totalTestsNumber === $UTest->totalTestsNumber - 1 ? 1 : 0;
        $t4 = $UTest->unitTestsNumber === 1 ? 1 : 0;
        $act = $t1 . $t2 . $t3 . $t4;
        $UTest->lastModuleName = 'in4s\UTest';
        // Assert Test
        $UTest->isEqual("considerTest(false)", $expect, $act);


        return $UTest->functionResults;
    }
}
