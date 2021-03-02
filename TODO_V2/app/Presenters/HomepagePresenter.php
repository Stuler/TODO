<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;


final class HomepagePresenter extends Nette\Application\UI\Presenter
{
    private Nette\Database\Explorer $database;

	public function __construct(Nette\Database\Explorer $database)
	{
		$this->database = $database;
	}

    public function renderDefault(): void
    {
	$this->template->items = $this->database->table('items')
		->order('created_at DESC');
    }

    protected function createComponentMyForm(): Form 
    {
        $form = new Form();
        $form->addText('task');
        $form->addSubmit('send', 'Create');
        $form->onSuccess[] = [$this, 'formSucceeded'];
        return $form;
    }

    public function formSucceeded(FORM $form): void
    {
        $values = $form->getValues();
        $this->database->query('INSERT INTO items',[ 
            'task' => $values['task'],
            'created_at' => $this->database::literal('NOW()'), 
            'due_date' => $this->database::literal('NOW()') 
        ]);
    }

//ako sa odkazat na $database?
//pridat funckionalitu na due_date, status 
//ako spravne zakomponovat dibi?
//ako presunut databazove dotazy a konstruktory do model vrstvy?
}
