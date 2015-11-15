<?php

namespace App\Presenters;

use Nette;
use App\Model\MenuModel;
use Tracy\Debugger;


class HomepagePresenter extends BasePresenter
{

    /**
     * @inject
     * @var MenuModel
     */
    public $menuModel;


	public function renderDefault()
	{
		$this->template->kategories = $this->menuModel->nactiKategorie();
        $this->template->menu = $this->menuModel->nactiMenu();

        Debugger::dump($this->menuModel->nactiMenu());
	}

}
