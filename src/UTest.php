<?php
/** in4s\UTest */

declare(strict_types=1);

namespace in4s;

/**
 * Unit testing functions and methods
 *
 * @version     v1.7.0 2020-10-22 16:45:57
 * @author      Eugeniy Makarkin
 * @package     in4s\UTest
 */
class UTest
{
    /** @var array $serverEmulation - Server emulation array */
    public $superglobalEmulations = [];
    /** @var int $totalTestsNumber - Total number of tests performed */
    public $totalTestsNumber = 0;
    /** @var int $totalNumberOfFailedTests - Total number of failed tests */
    public $totalNumberOfFailedTests = 0;
    /** @var int $unitTestsNumber - Number of tests performed in the current unit */
    public $unitTestsNumber = 0;
    /** @var int $numberOfFailedUnitTests - Number of failed tests in the current unit */
    public $numberOfFailedUnitTests = 0;
    /** @var string $functionResults - Contains html code of all test results in this context */
    protected $functionResults;
    /** @var string $methodName - Name of testing method (function) */
    protected $methodName;
    /** @var string $lastModuleName - Name of the last tested class (module) */
    protected $lastModuleName;
    /** @var string $nextHint - Hint text for the next test */
    protected $nextHint;
    /** @var string|null $triggeredErrorText - Triggered error text */
    protected $triggeredErrorText;
    /** @var Bem $Bem - Bem object */
    private $Bem;

    /**
     * UTest Constructor
     */
    public function __construct()
    {
        $this->Bem = new Bem();
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
        switch ($property) {
            case 'functionResults':
                throw new \Exception('UTest Exception: property not editable', 1);
                break;
            case 'methodName':
                $this->functionResults = $this->Bem->tag('h6.utest__method-name', $value . '():');
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
        $this->considerTest($result);

        if ($result) {
            $r = $this->Bem->tag(".utest__result_true[data-j4c={$this->nextHint}]", $testName);
        } else {
            $r = $this->Bem->tag(".utest__result_false[data-j4c={$this->nextHint}]", "{$testName}: false.<br>Expected (" . gettype($expectedResult) . ") &#9660;<hr>{$this->theValue($expectedResult)}<hr>{$this->theValue($functionReturn)}<hr> Returned (" . gettype($functionReturn) . ") &#9650;");
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

        return $this->Bem->tag('strong.utest__value', "<pre>" . htmlentities($value) . "</pre>");
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
        echo $this->Bem->tag('#jssendbox.utest__jssendbox');
        echo $this->Bem->tag('link[rel=stylesheet][href=https://code.jquery.com/qunit/qunit-2.5.1.css]', null) . "\n";
        echo $this->Bem->tag('#qunit') . "\n";
        echo $this->Bem->tag('#qunit-fixture') . "\n";
        echo $this->Bem->tag('script[src=https://code.jquery.com/qunit/qunit-2.5.1.js]') . "\n";
        echo $this->Bem->tag("script[src=/bemblockstests.js?{$version}]") . "\n";
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

    /**
     * Set the emulation value for the given superglobal
     * Need to roll back using unsetSuperglobalEmulation method after the test finished
     *
     * @since v1.8.0
     *
     * @param string $superglobal - The name of the superglobal array, such as "_SERVER"
     * @param string $key
     * @param string $newValue
     *
     * @return void
     */
    public function setSuperglobalEmulation(string $superglobal, string $key, string $newValue)
    {
        $this->superglobalEmulations[$superglobal][$key] = $GLOBALS[$superglobal][$key];
        $GLOBALS[$superglobal][$key] = $newValue;
    }

    /**
     * Roll back superglobals $_SERVER emulation value
     *
     * @since v1.8.0
     *
     * @param string $superglobal - The name of the superglobal array, such as "_SERVER"
     * @param string $key
     *
     * @return void
     */
    public function unsetSuperglobalEmulation(string $superglobal, string $key)
    {
        $GLOBALS[$superglobal][$key] = $this->superglobalEmulations[$superglobal][$key];
    }

    /**
     * Set superglobals $_SERVER emulation value
     * Need to roll back using unsetServerEmulation method after the test finished
     *
     * @since v1.8.0
     *
     * @param string $key
     * @param string $newValue
     *
     * @return void
     */
    public function setServerEmulation(string $key, string $newValue)
    {
        $this->setSuperglobalEmulation('_SERVER', $key, $newValue);
    }

    /**
     * Roll back superglobals $_SERVER emulation value
     *
     * @since v1.8.0
     *
     * @param string $key
     *
     * @return void
     */
    public function unsetServerEmulation(string $key)
    {
        $this->unsetSuperglobalEmulation('_SERVER', $key);
    }

    /**
     * Set class emulation by making a copy of the class file with replacements in its contents
     * UTCopy will be appended to the name of the new class at the end
     *
     * @since v1.9.0
     *
     * @param string $classFileNameWithPath
     * @param array  $replacements        - Array of replacements like [[s, r], [s, r]] or [s, r] (s - Search, r - Replace)
     * @param array  $criticalTextToAvoid - Texts, prohibitted to be inside a new file
     *
     * @return void
     */
    public function setClassEmulation(string $classFileNameWithPath, array $replacements, array $criticalTextsToAvoid = [])
    {
        if (!is_array($replacements[0])) {
            $replacements = [$replacements];
        }

        $filePathInfo = pathinfo($classFileNameWithPath);
        $newClassFileNameWithPath = "{$filePathInfo['dirname']}/{$filePathInfo['filename']}UTCopy.php";
        copy($classFileNameWithPath, $newClassFileNameWithPath);
        $_SESSION['uTestTemporaryFiles'][$newClassFileNameWithPath] = 1;

        // Add replacement: "class CLASS_NAME" to "class CLASS_NAMEUTCopy"
        $replacements[] = ["class {$filePathInfo['filename']}", "class {$filePathInfo['filename']}UTCopy"];
        $newFileContent = file_get_contents($newClassFileNameWithPath);
        foreach ($replacements as $replacement) {
            $newFileContent0 = $newFileContent;
            $newFileContent = str_replace($replacement[0], $replacement[1], $newFileContent);
            if ($newFileContent === $newFileContent0) {
                die('Error: Replacement of "' . $replacement[0] . '" failed!');
            }
        }
        file_put_contents($newClassFileNameWithPath, $newFileContent);

        foreach ($criticalTextsToAvoid as $criticalTextToAvoid) {
            if (strpos($newFileContent, $criticalTextToAvoid)) {
                die('Error: Critical text "' . $criticalTextToAvoid . '" is present!');
            }
        }
    }

    /**
     * Unset class emulation by removing emulated file
     *
     * @since v1.9.0
     *
     * @param string $classFileNameWithPath
     *
     * @return void
     */
    public function unsetClassEmulation(string $classFileNameWithPath)
    {
        $filePathInfo = pathinfo($classFileNameWithPath);
        $newClassFileNameWithPath = "{$filePathInfo['dirname']}/{$filePathInfo['filename']}UTCopy.php";
        unlink($newClassFileNameWithPath);
        unset($_SESSION['uTestTemporaryFiles'][$newClassFileNameWithPath]);
    }

    /**
     * Take into account the test result in unit and in the total number of tests
     *
     * @since v1.8.0
     *
     * @param bool $testResult - current test result
     *
     * @return void
     */
    private function considerTest(bool $testResult)
    {
        if ($this->lastModuleName !== __CLASS__) {
            $this->unitTestsNumber = 0;
            $this->numberOfFailedUnitTests = 0;
            $this->lastModuleName = __CLASS__;
        }
        if (!$testResult) {
            $this->totalNumberOfFailedTests++;
            $this->numberOfFailedUnitTests++;
        }
        $this->totalTestsNumber++;
        $this->unitTestsNumber++;
    }
}
