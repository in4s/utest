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
}
