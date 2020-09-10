<?php
/** in4s\UTest */

declare(strict_types=1);

namespace in4s;

/**
 * Unit testing functions and methods
 *
 * @version     v1.5.1 2020-09-10 11:47:31
 * @author      Eugeniy Makarkin
 * @package     in4s\UTest
 */
class UTest
{
    /** @var string $functionResults - Contains html code of all test results in this context */
    protected $functionResults;
    /** @var string $methodName - Name of testing method (function) */
    protected $methodName;
    /** @var string $nextHint - Hint text for the next test */
    protected $nextHint;
    /** @var string|null $triggeredErrorText - Triggered error text */
    protected $triggeredErrorText;

    /**
     * UTest Constructor
     */
    public function __construct()
    {
        $this->functionResults = '';
    }

    /**
     * Magical method __get.
     * Get value of the object property if the property exists
     *
     * @param string $property - Property name
     *
     * @return mixed
     */
    public function __get(string $property)
    {
        switch ($property) {
            case 'functionResults':
                return $this->functionResults;
                break;
            case 'methodName':
                return $this->methodName;
                break;
            case 'nextHint':
                return $this->nextHint;
                break;
            case 'triggeredErrorText':
                return $this->triggeredErrorText;
                break;
            default:
                throw new \Exception('UTest Exception: Unknown property', 1);
        }
    }

    /**
     * Magical method __set.
     * Set the value to the property
     *
     * @param string $property - Property Name
     * @param string $value    - New value
     *
     * @return void
     */
    public function __set(string $property, $value)
    {
        global $Bem;
        switch ($property) {
            case 'functionResults':
                throw new \Exception('UTest Exception: property not editable', 1);
                break;
            case 'methodName':
                $this->functionResults = $Bem->tag('h6', $value . '():');
                $this->methodName = $value;
                break;
            case 'nextHint':
                $this->nextHint = htmlentities($value);
                break;
            case 'triggeredErrorText':
                $this->triggeredErrorText = $value;
                break;
            default:
                throw new \Exception('UTest Exception: unknown property', 1);
        }
    }

    /**
     * Check if the result is strict equal to the expected
     *
     * @param string $testName       - Test name
     * @param mixed  $expectedResult - Expected result
     * @param mixed  $functionReturn - Returned result
     *
     * @return bool - Test result
     */
    public function isEqual(string $testName, $expectedResult, $functionReturn): bool
    {
        global $Bem;

        // Replace the substitution
        if (is_string($expectedResult)) {
            // TODO: Add test for this check
            $testName = preg_replace("/\?e/", $expectedResult, $testName);
        }
        if (is_string($functionReturn)) {
            // TODO: Add test for this check
            $testName = preg_replace("/\?r/", $functionReturn, $testName);
        }
        // TODO: Add test for this check
        $testName = preg_replace("/\?m/", $this->methodName, $testName);


        $result = $functionReturn === $expectedResult;

        if ($result) {
            $r = $Bem->tag(".utest__result_true[data-j4c={$this->nextHint}]", $testName);
        } else {
            $r = $Bem->tag(".utest__result_false[data-j4c={$this->nextHint}]", "{$testName}: false. Expected (" . gettype($expectedResult) . ")<br>{$this->theValue($expectedResult)}<br> Function returned (" . gettype($functionReturn) . ")<br>{$this->theValue($functionReturn)}") . "<hr>";
        }

        $this->functionResults .= $r;

        $this->nextHint = '';

        return $result;
    }

    /**
     * Return the single value
     *
     * @param mixed $value - The value
     *
     * @return string - html tag with the given value
     */
    public function theValue($value): string
    {
        global $Bem;
        if ($value === false) {
            $value = 'false';
        }
        if ($value === true) {
            $value = 'true';
        }
        if (is_null($value)) {
            $value = 'null';
        }
        if (is_array($value) || is_object($value)) {
            ob_start();
            print_r($value);
            $value = ob_get_contents();
            ob_end_clean();
        }

        // Converting type to string
        $value = '' . $value;

        return '-!' . $Bem->tag('strong.utest__value', "<pre>" . htmlentities($value) . "</pre>") . '!-';
    }

    /**
     * Render the JavaScript testing interface
     *
     * @param string $version - File version (for caching)
     *
     * @return void
     */
    public function jsTests(string $version)
    {
        global $Bem;
        echo $Bem->tag('#jssendbox.utest__jssendbox');
        echo $Bem->tag('link[rel=stylesheet][href=https://code.jquery.com/qunit/qunit-2.5.1.css]', null) . "\n";
        echo $Bem->tag('#qunit') . "\n";
        echo $Bem->tag('#qunit-fixture') . "\n";
        echo $Bem->tag('script[src=https://code.jquery.com/qunit/qunit-2.5.1.js]') . "\n";
        echo $Bem->tag("script[src=/bemblockstests.js?{$version}]") . "\n";
    }

    /**
     * Render css styles and js scripts needed for UTest
     *
     * @since v1.7.0
     * @return void
     */
    public function renderStylesAndScripts()
    {
        $this->renderStyles();
        $this->renderScripts();
    }

    /**
     * Render css styles needed for a good UTest appearance
     *
     * @since v1.7.0
     * @return void
     */
    public function renderStyles()
    {
        include 'styles.php';
    }

    /**
     * Render js scripts needed for UTest actions
     *
     * @since v1.7.0
     * @return void
     */
    public function renderScripts()
    {
        include 'scripts.php';
    }
}
