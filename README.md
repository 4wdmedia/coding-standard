# Forward Coding Standard
## Condition-Only For Loops
For loops that have only a second expression (the condition) should be converted to while loops.
  <table>
   <tr>
    <th>Valid: A for loop is used with all three expressions.</th>
    <th>Invalid: A for loop is used without a first or third expression.</th>
   </tr>
   <tr>
<td>

    for ($i = 0; $i < 10; $i++) {
        echo "{$i}\n";
    }

</td>
<td>

    for (;$test;) {
        $test = doSomething();
    }

</td>
   </tr>
  </table>
## Jumbled Incrementers
Incrementers in nested loops should use different variable names.
  <table>
   <tr>
    <th>Valid: Two different variables being used to increment.</th>
    <th>Invalid: Inner incrementer is the same variable name as the outer one.</th>
   </tr>
   <tr>
<td>

    for ($i = 0; $i < 10; $i++) {
        for ($j = 0; $j < 10; $j++) {
        }
    }

</td>
<td>

    for ($i = 0; $i < 10; $i++) {
        for ($j = 0; $j < 10; $i++) {
        }
    }

</td>
   </tr>
  </table>
## Unnecessary Final Modifiers
Methods should not be declared final inside of classes that are declared final.
  <table>
   <tr>
    <th>Valid: A method in a final class is not marked final.</th>
    <th>Invalid: A method in a final class is also marked final.</th>
   </tr>
   <tr>
<td>

    final class Foo
    {
        public function bar()
        {
        }
    }

</td>
<td>

    final class Foo
    {
        public final function bar()
        {
        }
    }

</td>
   </tr>
  </table>
## Useless Overriding Methods
Methods should not be defined that only call the parent method.
  <table>
   <tr>
    <th>Valid: A method that extends functionality on a parent method.</th>
    <th>Invalid: An overriding method that only calls the parent.</th>
   </tr>
   <tr>
<td>

    final class Foo
    {
        public function bar()
        {
            parent::bar();
            $this->doSomethingElse();
        }
    }

</td>
<td>

    final class Foo
    {
        public function bar()
        {
            parent::bar();
        }
    }

</td>
   </tr>
  </table>
## Todo Comments
FIXME Statements should be taken care of.
  <table>
   <tr>
    <th>Valid: A comment without a fixme.</th>
    <th>Invalid: A fixme comment.</th>
   </tr>
   <tr>
<td>

    // Handle strange case
    if ($test) {
        $var = 1;
    }

</td>
<td>

    // FIXME: This needs to be fixed!
    if ($test) {
        $var = 1;
    }

</td>
   </tr>
  </table>
## Todo Comments
TODO Statements should be taken care of.
  <table>
   <tr>
    <th>Valid: A comment without a todo.</th>
    <th>Invalid: A todo comment.</th>
   </tr>
   <tr>
<td>

    // Handle strange case
    if ($test) {
        $var = 1;
    }

</td>
<td>

    // TODO: This needs to be fixed!
    if ($test) {
        $var = 1;
    }

</td>
   </tr>
  </table>
## Inline Control Structures
Control Structures should use braces.
  <table>
   <tr>
    <th>Valid: Braces are used around the control structure.</th>
    <th>Invalid: No braces are used for the control structure..</th>
   </tr>
   <tr>
<td>

    if ($test) {
        $var = 1;
    }

</td>
<td>

    if ($test)
        $var = 1;

</td>
   </tr>
  </table>
## Byte Order Marks
Byte Order Marks that may corrupt your application should not be used.  These include 0xefbbbf (UTF-8), 0xfeff (UTF-16 BE) and 0xfffe (UTF-16 LE).
## Inline HTML
Files that contain php code should only have php code and should not have any &quot;inline html&quot;.
  <table>
   <tr>
    <th>Valid: A php file with only php code in it.</th>
    <th>Invalid: A php file with html in it outside of the php tags.</th>
   </tr>
   <tr>
<td>

    <?php
    $foo = 'bar';
    echo $foo . 'baz';

</td>
<td>

    some string here
    <?php
    $foo = 'bar';
    echo $foo . 'baz';

</td>
   </tr>
  </table>
## Line Endings
Unix-style line endings are preferred (&quot;\n&quot; instead of &quot;\r\n&quot;).
## One Class Per File
There should only be one class defined in a file.
  <table>
   <tr>
    <th>Valid: Only one class in the file.</th>
    <th>Invalid: Multiple classes defined in one file.</th>
   </tr>
   <tr>
<td>

    <?php
    class Foo
    {
    }

</td>
<td>

    <?php
    class Foo
    {
    }
    
    class Bar
    {
    }

</td>
   </tr>
  </table>
## One Interface Per File
There should only be one interface defined in a file.
  <table>
   <tr>
    <th>Valid: Only one interface in the file.</th>
    <th>Invalid: Multiple interfaces defined in one file.</th>
   </tr>
   <tr>
<td>

    <?php
    interface Foo
    {
    }

</td>
<td>

    <?php
    interface Foo
    {
    }
    
    interface Bar
    {
    }

</td>
   </tr>
  </table>
## Multiple Statements On a Single Line
Multiple statements are not allowed on a single line.
  <table>
   <tr>
    <th>Valid: Two statements are spread out on two separate lines.</th>
    <th>Invalid: Two statements are combined onto one line.</th>
   </tr>
   <tr>
<td>

    $foo = 1;
    $bar = 2;

</td>
<td>

    $foo = 1; $bar = 2;

</td>
   </tr>
  </table>
## Space After Casts
Spaces are not allowed after casting operators.
  <table>
   <tr>
    <th>Valid: A cast operator is immediately before its value.</th>
    <th>Invalid: A cast operator is followed by whitespace.</th>
   </tr>
   <tr>
<td>

    $foo = (string)1;

</td>
<td>

    $foo = (string) 1;

</td>
   </tr>
  </table>
## Call-Time Pass-By-Reference
Call-time pass-by-reference is not allowed. It should be declared in the function definition.
  <table>
   <tr>
    <th>Valid: Pass-by-reference is specified in the function definition.</th>
    <th>Invalid: Pass-by-reference is done in the call to a function.</th>
   </tr>
   <tr>
<td>

    function foo(&$bar)
    {
        $bar++;
    }
    
    $baz = 1;
    foo($baz);

</td>
<td>

    function foo($bar)
    {
        $bar++;
    }
    
    $baz = 1;
    foo(&$baz);

</td>
   </tr>
  </table>
## Function Argument Spacing
Function arguments should have one space after a comma, and single spaces surrounding the equals sign for default values.
  <table>
   <tr>
    <th>Valid: Single spaces after a comma.</th>
    <th>Invalid: No spaces after a comma.</th>
   </tr>
   <tr>
<td>

    function foo($bar, $baz)
    {
    }

</td>
<td>

    function foo($bar,$baz)
    {
    }

</td>
   </tr>
  </table>
  <table>
   <tr>
    <th>Valid: Single spaces around an equals sign in function declaration.</th>
    <th>Invalid: No spaces around an equals sign in function declaration.</th>
   </tr>
   <tr>
<td>

    function foo($bar, $baz = true)
    {
    }

</td>
<td>

    function foo($bar, $baz=true)
    {
    }

</td>
   </tr>
  </table>
## Opening Brace in Function Declarations
Function declarations follow the &quot;Kernighan/Ritchie style&quot;. The function brace is on the same line as the function declaration. One space is required between the closing parenthesis and the brace.
  <table>
   <tr>
    <th>Valid: brace on same line</th>
    <th>Invalid: brace on next line</th>
   </tr>
   <tr>
<td>

    function fooFunction($arg1, $arg2 = '') {
        ...
    }

</td>
<td>

    function fooFunction($arg1, $arg2 = '')
    {
        ...
    }

</td>
   </tr>
  </table>
## Constructor name
Constructors should be named __construct, not after the class.
  <table>
   <tr>
    <th>Valid: The constructor is named __construct.</th>
    <th>Invalid: The old style class name constructor is used.</th>
   </tr>
   <tr>
<td>

    class Foo
    {
        function __construct()
        {
        }
    }

</td>
<td>

    class Foo
    {
        function Foo()
        {
        }
    }

</td>
   </tr>
  </table>
## Constant Names
Constants should always be all-uppercase, with underscores to separate words.
  <table>
   <tr>
    <th>Valid: all uppercase</th>
    <th>Invalid: mixed case</th>
   </tr>
   <tr>
<td>

    define('FOO_CONSTANT', 'foo');
    
    class FooClass
    {
        const FOO_CONSTANT = 'foo';
    }

</td>
<td>

    define('Foo_Constant', 'foo');
    
    class FooClass
    {
        const foo_constant = 'foo';
    }

</td>
   </tr>
  </table>
## Opening Tag at Start of File
The opening php tag should be the first item in the file.
  <table>
   <tr>
    <th>Valid: A file starting with an opening php tag.</th>
    <th>Invalid: A file with content before the opening php tag.</th>
   </tr>
   <tr>
<td>

    <?php
    echo 'Foo';

</td>
<td>

    Beginning content
    <?php
    echo 'Foo';

</td>
   </tr>
  </table>
## Deprecated Functions
Deprecated functions should not be used.
  <table>
   <tr>
    <th>Valid: A non-deprecated function is used.</th>
    <th>Invalid: A deprecated function is used.</th>
   </tr>
   <tr>
<td>

    $foo = explode('a', $bar);

</td>
<td>

    $foo = split('a', $bar);

</td>
   </tr>
  </table>
## PHP Code Tags
Always use &lt;?php ?&gt; to delimit PHP code, not the &lt;? ?&gt; shorthand. This is the most portable way to include PHP code on differing operating systems and setups.
## Forbidden Functions
The forbidden functions sizeof() and delete() should not be used.
  <table>
   <tr>
    <th>Valid: count() is used in place of sizeof().</th>
    <th>Invalid: sizeof() is used.</th>
   </tr>
   <tr>
<td>

    $foo = count($bar);

</td>
<td>

    $foo = sizeof($bar);

</td>
   </tr>
  </table>
## Lowercase Keywords
All PHP keywords should be lowercase.
  <table>
   <tr>
    <th>Valid: Lowercase array keyword used.</th>
    <th>Invalid: Non-lowercase array keyword used.</th>
   </tr>
   <tr>
<td>

    $foo = array();

</td>
<td>

    $foo = Array();

</td>
   </tr>
  </table>
## No Space Indentation
Tabs should be used for indentation instead of spaces.
## Control Structure Signatures
Control structures should use one space around the parentheses in conditions.  The opening brace should be preceded by one space and should be at the end of the line.
  <table>
   <tr>
    <th>Valid: Correct spacing around the condition.</th>
    <th>Invalid: Incorrect spacing around the condition.</th>
   </tr>
   <tr>
<td>

    if ($foo) {
    }

</td>
<td>

    if($foo){
    }

</td>
   </tr>
  </table>
  <table>
   <tr>
    <th>Valid: Correct placement of the opening brace.</th>
    <th>Invalid: Incorrect placement of the opening brace on a new line.</th>
   </tr>
   <tr>
<td>

    if ($foo) {
    }

</td>
<td>

    if ($foo)
    {
    }

</td>
   </tr>
  </table>
## Default Values in Function Declarations
Arguments with default values go at the end of the argument list.
  <table>
   <tr>
    <th>Valid: argument with default value at end of declaration</th>
    <th>Invalid: argument with default value at start of declaration</th>
   </tr>
   <tr>
<td>

    function connect($dsn, $persistent = false)
    {
        ...
    }

</td>
<td>

    function connect($persistent = false, $dsn)
    {
        ...
    }

</td>
   </tr>
  </table>
## Class Declaration
Each class must be in a file by itself and must be under a namespace (a top-level vendor name).
  <table>
   <tr>
    <th>Valid: One class in a file.</th>
    <th>Invalid: Multiple classes in a single file.</th>
   </tr>
   <tr>
<td>

    <?php
    namespace Foo;
    
    class Bar {
    }

</td>
<td>

    <?php
    namespace Foo;
    
    class Bar {
    }
    
    class Baz {
    }

</td>
   </tr>
  </table>
  <table>
   <tr>
    <th>Valid: A vendor-level namespace is used.</th>
    <th>Invalid: No namespace used in file.</th>
   </tr>
   <tr>
<td>

    <?php
    namespace Foo;
    
    class Bar {
    }

</td>
<td>

    <?php
    class Bar {
    }

</td>
   </tr>
  </table>
## Namespace Declarations
There must be one blank line after the namespace declaration.
  <table>
   <tr>
    <th>Valid: One blank line after the namespace declaration.</th>
    <th>Invalid: No blank line after the namespace declaration.</th>
   </tr>
   <tr>
<td>

    namespace \Foo\Bar;
    
    use \Baz;

</td>
<td>

    namespace \Foo\Bar;
    use \Baz;

</td>
   </tr>
  </table>
## Namespace Declarations
Each use declaration must contain only one namespace and must come after the first namespace declaration.  There should be one blank line after the final use statement.
  <table>
   <tr>
    <th>Valid: One use declaration per namespace.</th>
    <th>Invalid: Multiple namespaces in a use declaration.</th>
   </tr>
   <tr>
<td>

    use \Foo;
    use \Bar;

</td>
<td>

    use \Foo, \Bar;

</td>
   </tr>
  </table>
  <table>
   <tr>
    <th>Valid: Use statements come after first namespace.</th>
    <th>Invalid: Namespace declared after use.</th>
   </tr>
   <tr>
<td>

    namespace \Foo;
    
    use \Bar;

</td>
<td>

    use \Bar;
    
    namespace \Foo;

</td>
   </tr>
  </table>
  <table>
   <tr>
    <th>Valid: A single blank line after the final use statement.</th>
    <th>Invalid: No blank line after the final use statement.</th>
   </tr>
   <tr>
<td>

    use \Foo;
    use \Bar;
    
    class Baz
    {
    }

</td>
<td>

    use \Foo;
    use \Bar;
    class Baz
    {
    }

</td>
   </tr>
  </table>
## Closing PHP Tags
Files should not have closing php tags.
  <table>
   <tr>
    <th>Valid: No closing tag at the end of the file.</th>
    <th>Invalid: A closing php tag is included at the end of the file.</th>
   </tr>
   <tr>
<td>

    <?php
    $var = 1;

</td>
<td>

    <?php
    $var = 1;
    ?>

</td>
   </tr>
  </table>
## Array Bracket Spacing
When referencing arrays you should not put whitespace around the opening bracket or before the closing bracket.
  <table>
   <tr>
    <th>Valid: No spaces around the brackets.</th>
    <th>Invalid: Spaces around the brackets.</th>
   </tr>
   <tr>
<td>

    $foo['bar'];

</td>
<td>

    $foo [ 'bar' ];

</td>
   </tr>
  </table>
## Lowercase Class Keywords
The php keywords class, interface, trait, extends, implements, abstract, final, var, and const should be lowercase.
  <table>
   <tr>
    <th>Valid: Lowercase class keywords.</th>
    <th>Invalid: Initial capitalization of class keywords.</th>
   </tr>
   <tr>
<td>

    final class Foo extends Bar
    {
    }

</td>
<td>

    Final Class Foo Extends Bar
    {
    }

</td>
   </tr>
  </table>
## Self Member Reference
The self keyword should be used instead of the current class name, should be lowercase, and should not have spaces before or after it.
  <table>
   <tr>
    <th>Valid: Lowercase self used.</th>
    <th>Invalid: Uppercase self used.</th>
   </tr>
   <tr>
<td>

    self::foo();

</td>
<td>

    SELF::foo();

</td>
   </tr>
  </table>
  <table>
   <tr>
    <th>Valid: Correct spacing used.</th>
    <th>Invalid: Incorrect spacing used.</th>
   </tr>
   <tr>
<td>

    self::foo();

</td>
<td>

    self :: foo();

</td>
   </tr>
  </table>
  <table>
   <tr>
    <th>Valid: Self used as reference.</th>
    <th>Invalid: Local class name used as reference.</th>
   </tr>
   <tr>
<td>

    class Foo
    {
        public static function bar()
        {
        }
    
        public static function baz()
        {
            self::bar();
        }
    }

</td>
<td>

    class Foo
    {
        public static function bar()
        {
        }
    
        public static function baz()
        {
            Foo::bar();
        }
    }

</td>
   </tr>
  </table>
## Doc Comment Alignment
The asterisks in a doc comment should align, and there should be one space between the asterisk and tags.
  <table>
   <tr>
    <th>Valid: Asterisks are aligned.</th>
    <th>Invalid: Asterisks are not aligned.</th>
   </tr>
   <tr>
<td>

    /**
     * @see foo()
     */

</td>
<td>

    /**
      * @see foo()
    */

</td>
   </tr>
  </table>
  <table>
   <tr>
    <th>Valid: One space between asterisk and tag.</th>
    <th>Invalid: Incorrect spacing used.</th>
   </tr>
   <tr>
<td>

    /**
     * @see foo()
     */

</td>
<td>

    /**
     *  @see foo()
     */

</td>
   </tr>
  </table>
## Doc Comment Throws Tag
If a function throws any exceptions, they should be documented in a @throws tag.
  <table>
   <tr>
    <th>Valid: @throws tag used.</th>
    <th>Invalid: No @throws tag used for throwing function.</th>
   </tr>
   <tr>
<td>

    /**
     * @throws Exception all the time
     * @return void
     */
    function foo()
    {
        throw new Exception('Danger!');
    }

</td>
<td>

    /**
     * @return void
     */
    function foo()
    {
        throw new Exception('Danger!');
    }

</td>
   </tr>
  </table>
## Static This Usage
Static methods should not use $this.
  <table>
   <tr>
    <th>Valid: Using self:: to access static variables.</th>
    <th>Invalid: Using $this-> to access static variables.</th>
   </tr>
   <tr>
<td>

    class Foo
    {
        static function bar()
        {
            return self::$staticMember;
        }
    }

</td>
<td>

    class Foo
    {
        static function bar()
        {
        return $this->$staticMember;
        }
    }

</td>
   </tr>
  </table>
## Echoed Strings
Simple strings should not be enclosed in parentheses when being echoed.
  <table>
   <tr>
    <th>Valid: Using echo without parentheses.</th>
    <th>Invalid: Using echo with parentheses.</th>
   </tr>
   <tr>
<td>

    echo "Hello";

</td>
<td>

    echo("Hello");

</td>
   </tr>
  </table>
## Language Construct Whitespace
The php constructs echo, print, return, include, include_once, require, require_once, and new should have one space after them.
  <table>
   <tr>
    <th>Valid: echo statement with a single space after it.</th>
    <th>Invalid: echo statement with no space after it.</th>
   </tr>
   <tr>
<td>

    echo "hi";

</td>
<td>

    echo"hi";

</td>
   </tr>
  </table>
## Semicolon Spacing
Semicolons should not have spaces before them.
  <table>
   <tr>
    <th>Valid: No space before the semicolon.</th>
    <th>Invalid: Space before the semicolon.</th>
   </tr>
   <tr>
<td>

    echo "hi";

</td>
<td>

    echo "hi" ;

</td>
   </tr>
  </table>
Documentation generated on Mon, 26 Mar 2018 11:19:51 +0200 by [PHP_CodeSniffer 3.2.3](https://github.com/squizlabs/PHP_CodeSniffer)
