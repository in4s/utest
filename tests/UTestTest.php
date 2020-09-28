<?php
/** in4s\UTest */

declare(strict_types=1);

namespace in4s;

/**
 * Class UTestTest - Tests for class UTest
 *
 * @version     v2.0.1 2020-09-10 11:57:43
 * @package     in4s\UTest
 * @author      Eugeniy Makarkin
 */
class UTestTest
{

    /**
     * Run tests of the current class
     *
     * @return void
     */
    public static function run()
    {
        echo '<div class="utest__section">';
        echo '<h5>UTest:</h5>';
        echo self::isEqualTest();
        echo self::theValueTest();
        echo self::setServerEmulationTest();
        echo self::unsetServerEmulationTest();
        // echo self::considerTestTest();
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
        $expect = '<h6>isEqual():</h6><div class="utest__result utest__result_true" data-j4c="The simplest check true == true">true==true</div>';
        // Act
        $UTest1->isEqual('true==true', true, true);
        $act = $UTest1->functionResults;
        // Assert Test
        $UTest->isEqual("isEqual('true==true', true, true);", $expect, $act);


        // Arrange Test
        $UTest->nextHint = 'The simplest check false == false';
        $UTest1->methodName = 'isEqual';
        $UTest1->nextHint = 'The simplest check false == false';
        $expect = '<h6>isEqual():</h6><div class="utest__result utest__result_true" data-j4c="The simplest check false == false">false==false</div>';
        // Act
        $UTest1->isEqual('false==false', false, false);
        $act = $UTest1->functionResults;
        // Assert Test
        $UTest->isEqual("isEqual('false==false', false, false);", $expect, $act);


        // Arrange Test
        $UTest->nextHint = 'With < html> tag on a popup comment';
        $UTest1->methodName = 'isEqual';
        $UTest1->nextHint = 'With < html> tag on a popup comment';
        $expect = '<h6>isEqual():</h6><div class="utest__result utest__result_true" data-j4c="With &lt; html&gt; tag on a popup comment">false==false</div>';
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
        $expect = '-!<strong class="utest__value"><pre>5</pre></strong>!-';
        // Act
        $act = $UTest->theValue(5);
        // Assert Test
        $UTest->isEqual("theValue(5);", $expect, $act);


        // Arrange Test
        $UTest->nextHint = 'If the value = true';
        $expect = '-!<strong class="utest__value"><pre>true</pre></strong>!-';
        // Act
        $act = $UTest->theValue(true);
        // Assert Test
        $UTest->isEqual("theValue(true);", $expect, $act);


        // Arrange Test
        $UTest->nextHint = 'If the value = false';
        $expect = '-!<strong class="utest__value"><pre>false</pre></strong>!-';
        // Act
        $act = $UTest->theValue(false);
        // Assert Test
        $UTest->isEqual("theValue(false);", $expect, $act);


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
