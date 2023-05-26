<?php
/**
 * @package   panopticon
 * @copyright Copyright (c)2023-2023 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt GNU Affero General Public License, version 3 or later
 */

namespace Akeeba\Panopticon\Library\Logger;

use Psr\Log\AbstractLogger;
use Psr\Log\LoggerInterface;

defined('AKEEBA') || die;

class ForkedLogger extends AbstractLogger implements LoggerInterface
{
	/**
	 * @var LoggerInterface[]
	 */
	private array $loggers = [];

	public function __construct($loggers = [])
	{
		foreach ($loggers as $logger)
		{
			$this->pushLogger($logger);
		}
	}

	public function pushLogger(LoggerInterface $logger)
	{
		$this->loggers[] = $logger;
	}

	public function log($level, \Stringable|string $message, array $context = []): void
	{
		foreach ($this->loggers as $logger)
		{
			$logger->log($level, $message, $context);
		}
	}
}