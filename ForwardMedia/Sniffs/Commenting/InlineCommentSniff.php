<?php

namespace ForwardMedia\Sniffs\Commenting;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class InlineCommentSniff implements Sniff {

	const EXTENSION_BUILDER_SPLIT_TOKEN = '## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder';

	/**
	 * Returns an array of tokens this test wants to listen for.
	 *
	 * @return array
	 */
	public function register() {
		return [T_COMMENT];

	}


	/**
	 * Processes this test, when one of its tokens is encountered.
	 *
	 * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
	 * @param int                         $stackPtr  The position of the current token
	 *                                               in the stack passed in $tokens.
	 *
	 * @return void
	 */
	public function process(File $phpcsFile, $stackPtr) {
		$tokens = $phpcsFile->getTokens();

		if ($tokens[$stackPtr]['content'][0] === '#' && trim($tokens[$stackPtr]['content']) !== self::EXTENSION_BUILDER_SPLIT_TOKEN) {
			$error  = 'Perl-style comments are not allowed. Use "// Comment."';
			$error .= ' or "/* comment */" instead.';
			$fix    = $phpcsFile->addFixableError($error, $stackPtr, 'WrongStyle');
			if ($fix === true) {
				$newComment = ltrim($tokens[$stackPtr]['content'], '# ');
				$newComment = '// ' . $newComment;
				$phpcsFile->fixer->replaceToken($stackPtr, $newComment);
			}
		} else if ($tokens[$stackPtr]['content'][0] === '/' && $tokens[$stackPtr]['content'][1] === '/') {
			$comment = substr($tokens[$stackPtr]['content'], 2);
			if ($comment[0] !== ' ') {
				$error = 'Expected 1 space before comment text. use block comment if you need indentation';
				$fix = $phpcsFile->addFixableError($error, $stackPtr, 'SpacingBefore');
				if ($fix) {
					$newComment = '// ' . trim($comment, "/\t ");
					$phpcsFile->fixer->replaceToken($stackPtr, $newComment);
				}
			}
		}
	}
}
