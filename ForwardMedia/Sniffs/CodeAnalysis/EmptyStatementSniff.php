<?php

/**
 * This sniff class detects some empty statement.
 *
 * ;; is disallowed
 */

namespace ForwardMedia\Sniffs\CodeAnalysis;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Util\Tokens;

class EmptyStatementSniff implements Sniff {

	public function register() {
		return [T_SEMICOLON];
	}

	public function process(File $phpcsFile, $stackPtr) {
		$tokens = $phpcsFile->getTokens();
		$token = $tokens[$stackPtr];

		$prev = $stackPtr - 1;
		$previousToken = $tokens[$prev];
		while ($previousToken) {
			foreach (Tokens::$emptyTokens as $emptyToken) {
				if ($emptyToken === $previousToken['code']) {
					$prev--;
					$previousToken = $tokens[$prev];
					continue;
				}
			}

			break;
		}

		if ($previousToken && in_array($previousToken['code'], [T_SEMICOLON, T_OPEN_CURLY_BRACKET, T_CLOSE_CURLY_BRACKET, T_OPEN_TAG])) {
			if ($previousToken['code'] === T_CLOSE_CURLY_BRACKET) {
				if (isset($previousToken['scope_condition']) && $tokens[$previousToken['scope_condition']]['code'] === T_CLOSURE) {
					// ignore semicolon after closing bracket of closure
					return;
				}

				$openBracket = $tokens[$previousToken['bracket_opener']];
				$beforeOpening = $phpcsFile->findPrevious(Tokens::$emptyTokens, $previousToken['bracket_opener'] - 1, null, true);
				if ($beforeOpening && $tokens[$beforeOpening] && $tokens[$beforeOpening]['code'] === T_OBJECT_OPERATOR) {
					// code like $this->{$var . "string"};
					return;
				}
			}

			// Get token identifier.
			$name  = strtoupper($token['content']);
			$error = 'Useless semicolon detected';
			$phpcsFile->addError($error, $stackPtr, 'Detected'.ucfirst(strtolower($name)), [$name]);
		}
	}
}
