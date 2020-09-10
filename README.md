# UTest
PHP Unit Testing Class

v1.7.0-beta.2

Using this class you can render unit test results directly on a web page.

## Getting started

1. Install this library using composer.

2. Make your own tests files, by example taken from tests/UTestTest.php

3. Use this code to run tests and display results on page.

```php
$UTest = new \in4s\UTest();

// You can
$UTest->renderStylesAndScripts();
// or use yours styles and scripts, just grab originals from src/styles.php and src/scripts.php

// Render test results of a particular class, just replace in4s\UTestTest to your test class name
in4s\UTestTest::run();
```
!!! Important note: You need JQuery attached to the webpage to use this version of the class.

The class code is documented by DocBlocks, so you can use it as documentation.

___
#### Complies with standards:

- RSR v0.16.0 (https://github.com/in4s/NewRepo/)
- Semantic Versioning 2.0.0 (https://semver.org/)
