<?php

namespace Cyberhouse\NewsGallery\ViewHelpers;

/**
 * This file is part of the TYPO3 project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Lesser General Public License, either version 3
 * of the License, or (at your option) any later version.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class RenderViewHelper
 *
 * @package Cyberhouse\NewsGallery\ViewHelpers
 */
class RenderViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * @var \TYPO3\CMS\Core\Resource\FileCollectionRepository
	 */
	protected $collectionRepository = NULL;

	/**
	 * @param string $collection
	 * @param string $as
	 * @return string
	 * @throws \TYPO3\CMS\Fluid\Core\ViewHelper\Exception\InvalidVariableException
	 * @throws \TYPO3\CMS\Fluid\View\Exception
	 */
	public function render($collection, $as) {
		$fileObjects = array();

		$collectionUids = GeneralUtility::intExplode(',', $collection, TRUE);
		foreach ($collectionUids as $collectionUid) {
			try {
				$fileCollection = $this->collectionRepository->findByUid($collectionUid);
				if ($fileCollection instanceof \TYPO3\CMS\Core\Resource\Collection\AbstractFileCollection) {
					$fileCollection->loadContents();
					$this->addToArray($fileCollection->getItems(), $fileObjects);
				}
			} catch (\TYPO3\CMS\Core\Resource\Exception $e) {
				throw new \TYPO3\CMS\Fluid\View\Exception(sprintf('The collection with uid "%s" could not be found', $collectionUid));
			}
		}
		$this->templateVariableContainer->add($as, $fileObjects);
		$output = $this->renderChildren();
		$this->templateVariableContainer->remove($as);
		return $output;
	}

	/**
	 * Adds $newItems to $theArray, which is passed by reference. Array must only consist of numerical keys.
	 *
	 * @param mixed $newItems Array with new items or single object that's added.
	 * @param array $theArray The array the new items should be added to. Must only contain numeric keys (for array_merge() to add items instead of replacing).
	 */
	protected function addToArray($newItems, array &$theArray) {
		if (is_array($newItems)) {
			$theArray = array_merge($theArray, $newItems);
		} elseif (is_object($newItems)) {
			$theArray[] = $newItems;
		}
	}


	/**
	 * Sets the collection repository.
	 *
	 * @param \TYPO3\CMS\Core\Resource\FileCollectionRepository $collectionRepository
	 * @return void
	 */
	public function injectCollectionRepository(\TYPO3\CMS\Core\Resource\FileCollectionRepository $collectionRepository) {
		$this->collectionRepository = $collectionRepository;
	}

}