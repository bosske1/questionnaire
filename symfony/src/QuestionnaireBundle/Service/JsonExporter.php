<?php
/**
 * Created by PhpStorm.
 * User: bosske1
 * Date: 7/19/15
 * Time: 11:53 PM
 */

namespace QuestionnaireBundle\Service;
use Doctrine\ORM\EntityManager;

/**
 * Class JsonExporter
 * @package QuestionnaireBundle\Service
 */
class JsonExporter implements ExporterInterface
{
	/**
	 * @var \Doctrine\ORM\EntityManager
	 */
	protected $entityManager;

	public function __construct(EntityManager $entityManager)
	{
		$this->entityManager = $entityManager;
	}

	/**
	 * @param mixed $itemToExport
	 */
	public function exportData($itemToExport)
	{
		$exportedData = array();
		$fieldNames = $this->entityManager->getClassMetadata(get_class($itemToExport))->getFieldNames();

		foreach ($fieldNames as $fieldName) {
			$methodName = 'get' . ucfirst ($fieldName);
			if (method_exists($itemToExport, $methodName)){
				$exportedData[$fieldName] = $itemToExport->{$methodName}();
			}
		}

		return $exportedData;
	}
}