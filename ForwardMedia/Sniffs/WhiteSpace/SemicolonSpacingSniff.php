<?php

namespace ForwardMedia\Sniffs\WhiteSpace;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\WhiteSpace\SemicolonSpacingSniff as ParentSniff;
use PHP_CodeSniffer\Util\Tokens;

/**
 * Allow Semicolon on new line for chained methods
 */
class SemicolonSpacingSniff extends ParentSniff {

	public function process(File $phpcsFile, $stackPtr) {
		$tokens = $phpcsFile->getTokens();

		$prevType = $tokens[$stackPtr - 1]['code'];
		if (isset(Tokens::$emptyTokens[$prevType]) === false) {
			return;
		}

		$previous = $stackPtr - 1;
		while ($previous > 0 && $tokens[$previous]['code'] === T_WHITESPACE) {
			$previous--;
		}
		if ($previous && $tokens[$previous]['line'] !== $tokens[$stackPtr]['line']) {
			// semicolon is alone on the line
			return;
		}

		return parent::process($phpcsFile, $stackPtr);
	}

}
