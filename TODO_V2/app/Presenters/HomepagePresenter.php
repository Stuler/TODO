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

    public function createComponentMyForm()
    {
        $form = new Form();

        $form->addText('task')
            ->setHtmlAttribute('placeholder', 'Enter task here')
            ->setRequired("Cannot enter empty task!");

        $form->addText('due_date')
            ->setHtmlAttribute('placeholder', 'Ented deadline [dd.mm.YYYY]');

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
            'due_date' => $values['due_date']
        ]);
        $this->redirect("this");
    }

    public function handleUpdate($id) {
        //$id = $this->getParameter("id");
        $this->database->query("UPDATE items SET status='1' WHERE id=?", $id);
        $this->redirect("this");
    }

    public function handleDelete($id) {
        //$id = $this->getParameter("id");
        $this->database->query("DELETE FROM items WHERE id=?", $id);
        $this->redirect("this");
    }

//ako sa odkazat na $database?
//pridat funckionalitu na due_date, status 
//ako spravne zakomponovat dibi?
//ako presunut databazove dotazy a konstruktory do model vrstvy?

}
