<?php

namespace ForwardMedia\Sniffs\Files;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use SlevomatCodingStandard\Helpers\TokenHelper;
use SlevomatCodingStandard\Helpers\UseStatement;
use SlevomatCodingStandard\Helpers\UseStatementHelper;

/**
 * Allow Semicolon on new line for chained methods
 */
class AlphabeticallySortedUsesSniff implements Sniff {

	public const CODE_INCORRECT_ORDER = 'IncorrectlyOrderedUses';

	public function register(): array {
		return [
			T_OPEN_TAG,
		];
	}

	public function process(File $phpcsFile, $openTagPointer): void {
		$useStatementGroups = $this->getUseStatementGroups($phpcsFile);
		foreach ($useStatementGroups as $useStatements) {
			$lastUse = null;
			foreach ($useStatements as $useStatement) {
				if ($lastUse === null) {
					$lastUse = $useStatement;
				} else {
					$order = $this->compareUseStatements($useStatement, $lastUse);
					if ($order < 0) {
						$fix = $phpcsFile->addError(
							sprintf('Use statements should be sorted alphabetically. The first wrong one is %s.', $useStatement->getFullyQualifiedTypeName()),
							$useStatement->getPointer(),
							self::CODE_INCORRECT_ORDER
						);
						if ($fix) {
							// $this->fixAlphabeticalOrder($phpcsFile, $useStatements);
						}

						break;
					}

					$lastUse = $useStatement;
				}
			}
		}
	}

	protected function getUseStatementGroups(File $phpcsFile): array {
		$useStatements = [];
		$tokens = $phpcsFile->getTokens();

		$namespaceAndOpenTagPointers = TokenHelper::findNextAll($phpcsFile, [T_OPEN_TAG, T_NAMESPACE], 0);
		$openTagPointer = $namespaceAndOpenTagPointers[0];

		$prevLine = -1;
		$currentGroup = -1;
		foreach ($this->getUseStatementPointers($phpcsFile, $openTagPointer) as $usePointer) {
			$useToken = $tokens[$usePointer];

			if ($prevLine + 1 !== $useToken['line']) {
				$currentGroup = $useToken['line'];
				$useStatements[$currentGroup] = [];
			}
			$prevLine = $useToken['line'];

			$nextTokenFromUsePointer = TokenHelper::findNextEffective($phpcsFile, $usePointer + 1);
			$type = UseStatement::TYPE_DEFAULT;
			if ($tokens[$nextTokenFromUsePointer]['code'] === T_STRING) {
				if ($tokens[$nextTokenFromUsePointer]['content'] === 'const') {
					$type = UseStatement::TYPE_CONSTANT;
				} elseif ($tokens[$nextTokenFromUsePointer]['content'] === 'function') {
					$type = UseStatement::TYPE_FUNCTION;
				}
			}
			$name = UseStatementHelper::getNameAsReferencedInClassFromUse($phpcsFile, $usePointer);
			$useStatement = new UseStatement(
				$name,
				UseStatementHelper::getFullyQualifiedTypeNameFromUse($phpcsFile, $usePointer),
				$usePointer,
				$type,
				UseStatementHelper::getAlias($phpcsFile, $usePointer)
			);
			$useStatements[$currentGroup][UseStatement::getUniqueId($type, $name)] = $useStatement;
		}

		return $useStatements;
	}

	protected function getUseStatementPointers(File $phpcsFile, int $openTagPointer): array {
		$tokens = $phpcsFile->getTokens();
		$pointer = $openTagPointer + 1;
		$pointers = [];
		while (true) {
			$typesToFind = array_merge([T_USE], TokenHelper::$typeKeywordTokenCodes);
			$pointer = TokenHelper::findNext($phpcsFile, $typesToFind, $pointer);
			if ($pointer === null) {
				break;
			}

			$token = $tokens[$pointer];
			if (in_array($token['code'], TokenHelper::$typeKeywordTokenCodes, true)) {
				$pointer = $token['scope_closer'] + 1;
				continue;
			}
			if (UseStatementHelper::isAnonymousFunctionUse($phpcsFile, $pointer)) {
				$pointer++;
				continue;
			}
			$pointers[] = $pointer;
			$pointer++;
		}
		return $pointers;
	}

	protected function compareUseStatements(UseStatement $a, UseStatement $b): int {
		if (!$a->hasSameType($b)) {
			$order = [
				UseStatement::TYPE_DEFAULT => 1,
				UseStatement::TYPE_FUNCTION => $this->psr12Compatible ? 2 : 3,
				UseStatement::TYPE_CONSTANT => $this->psr12Compatible ? 3 : 2,
			];

			return $order[$a->getType()] <=> $order[$b->getType()];
		}

		$aNameParts = explode(NamespaceHelper::NAMESPACE_SEPARATOR, $a->getFullyQualifiedTypeName());
		$bNameParts = explode(NamespaceHelper::NAMESPACE_SEPARATOR, $b->getFullyQualifiedTypeName());

		$minPartsCount = min(count($aNameParts), count($bNameParts));
		for ($i = 0; $i < $minPartsCount; $i++) {
			$comparison = strcasecmp($aNameParts[$i], $bNameParts[$i]);
			if ($comparison === 0) {
				continue;
			}

			return $comparison;
		}

		return count($aNameParts) <=> count($bNameParts);
	}
}
