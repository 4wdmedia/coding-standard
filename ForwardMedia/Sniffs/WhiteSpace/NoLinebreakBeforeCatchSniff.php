<?php

namespace ForwardMedia\Sniffs\Files;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

/**
 * Disallow linebreak before catch. Must be `}` (of try-block)
 */
class NoLinebreakBeforeCatchSniff implements Sniff {

	public function register() {
		return [
			T_CATCH,
		];

	}

	public function process(File $phpcsFile, $stackPtr) {
		$tokens = $phpcsFile->getTokens();

		$previous = $stackPtr - 1;
		if ($previous <= 0) {
			return;
		}
		if ($tokens[$previous]['code'] !== T_WHITESPACE) {
			$phpcsFile->addError('Missing whitespace before catch block', $previous, 'NoLinebreakBeforeCatch');
			return;
		}
		$previous--;
		if ($tokens[$previous]['code'] !== T_CLOSE_CURLY_BRACKET) {
			$phpcsFile->addError('} before catch block not on the same line', $previous, 'NoLinebreakBeforeCatch');
		}
	}
}
