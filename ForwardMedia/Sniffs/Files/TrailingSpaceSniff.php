<?php

namespace ForwardMedia\Sniffs\Files;

/**
 * Tests that the lineend if never preceeded with whitespace except for lines only containing whitespaces.
 */
class TrailingSpaceSniff implements \PHP_CodeSniffer\Sniffs\Sniff {

	public function register() {
		return array(T_OPEN_TAG);
	}

	public function process(\PHP_CodeSniffer\Files\File $phpcsFile, $stackPtr) {
		$tokens = $phpcsFile->getTokens();

		// Make sure this is the first open tag.
		$previousOpenTag = $phpcsFile->findPrevious(array(T_OPEN_TAG), ($stackPtr - 1));
		if ($previousOpenTag !== false) {
			return;
		}

		$tokenCount         = 0;
		$currentLineContent = '';
		$currentLine        = 1;

		for (; $tokenCount < $phpcsFile->numTokens; $tokenCount++) {
			if ($tokens[$tokenCount]['line'] === $currentLine) {
				$currentLineContent .= $tokens[$tokenCount]['content'];
			} else {
				$currentLineContent = trim($currentLineContent, $phpcsFile->eolChar);

				$len = strlen($currentLineContent);
				if ($len > 0) {
					if (trim($currentLineContent) === '') {
						$error = 'Line contains only whitespace';
						$phpcsFile->addError($error, ($tokenCount - 1), 'OnlyWhitespace');
					} else if (strlen(rtrim($currentLineContent)) !== $len) {
						$error = 'Line ends with a whitespace';
						$phpcsFile->addError($error, ($tokenCount - 1), 'TralingWhitespace');
					}
				}

				$currentLineContent = $tokens[$tokenCount]['content'];
				$currentLine++;
			}
		}
	}
}
