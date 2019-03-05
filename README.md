# Forward Coding Standard

## Valid example

```php
<?php

namespace Vierwd;

use Namespace\ClassName;

class Bar {

	public function helloWorld($param1, $param2 = '', $param3 = null) {
		for ($i = 0; $i < 10; $i++) {
			echo 'Iteration ' . $i . "\n";
		}

		if (1 < 10) {
			echo 'If-clause';
		} else if ($param1) {
			echo 'Else-clause';
		}
	}
}

```

## Invalid example

```php
<? // Invalid: Short PHP-Open-Tag used

// Invalid: No Namespace

// Invalid: Use with leading Slash
use \Namespace\ClassName;

// Invalid: keywords need to be lowercase
Class Bar
{ // Invalid: Bracket not on same line as class/if/for/foreach/while

	// Invalid: Incorrect naming of function
	// Invalid: Uppercase NULL
	function HelloWorld($param1, $param2 = '', $param3 = NULL)
	{
		for ($i=0; $i < 10; $i++) {
			// Invalid: Double semicolon
			echo 'Iteration ' . $i . "\n";;
		}

		if (1 < 10) {
			// Invalid: Double-Quotes when not needed
			echo "If-clause";
		} elseif ($param1) {
			// Invalid: elseif instead of else if
			echo 'Else-clause';
			// Invalid: Indenting using spaces
        }
 		// Invalid: Indenting mixed with spaces and tab
	}
}

// Invalid: Two classes in a single file
class Baz {
}

// Invalid: Closing PHP Tag at end of file
// Invalid: No trailing space at end of file
?>```