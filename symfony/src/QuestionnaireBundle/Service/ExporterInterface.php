<?php
/**
 * Created by PhpStorm.
 * User: bosske1
 * Date: 7/19/15
 * Time: 11:54 PM
 */

namespace QuestionnaireBundle\Service;


interface ExporterInterface
{
	/**
	 * @param mixed $itemToExport
	 * @return array
	 */
	public function exportData($itemToExport);
}