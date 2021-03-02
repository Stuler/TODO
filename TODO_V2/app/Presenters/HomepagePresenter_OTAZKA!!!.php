

declare(strict_types=1);

namespace App\Presenters;

use Nette;
use Dibi;


final class HomepagePresenter extends Nette\Application\UI\Presenter
{
    //private Nette\Database\Explorer $database;
	
	/** @var Dibi\Connection @inject */
		public $db;	

	public function __construct(\Dibi\Connection $database)
	{
		$this->database = $database;
		$this->database = \dibi::query(
			"CREATE TABLE  IF NOT EXISTS `items` (
				`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`task` varchar(255) NOT NULL,
				`status` tinyint(1) NOT NULL,
				`created_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
				`due_date` datetime NOT NULL
				) ENGINE='InnoDB' COLLATE 'utf8_general_ci';"
		);
		
		database:
			debugger: true;
			explain: true;

		
	}
	
    public function renderDefault(): void
{
	$this->template->items = $this->database->table('items')
		->order('created_at DESC')
		->limit(5);
}
}
