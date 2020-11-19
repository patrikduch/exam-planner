<?php

namespace App\Presenters;

use App\Components\Shared\Skeleton\Header\HeaderControl;
use App\Components\Shared\Skeleton\Header\HeaderControlFactory;
use App\Repositories\ProjectDetailRepository;
use Nette\Application\UI\Presenter;

/**
 * Class BasePresenter represents all needed operations that needs to be executed on every view.
 * @package App\Presenters
 */
abstract class BasePresenter extends Presenter
{
    /** @var ProjectDetailRepository @inject */
    public $projectDetailRepository;

    /** @var HeaderControlFactory @inject */
    public $headerControlFactory;

    /**
     * @throws \Nette\Application\AbortException
     */
    public function handleUserLogout() {
        $this->user->logout();
        $this->redirect('Homepage:');
    }

    /**
     * Renders default layout view that is shared among all views.
     */
    public function beforeRender(){
        parent::beforeRender();

        $this->template->projectDetail = $this->projectDetailRepository->getProjectName();
    }

    /**
     * Create Header component that is used as heading area for all presenter views.
     * @return HeaderControl Instance of HeaderControl component.
     */
    protected function createComponentHeaderControl(): HeaderControl
    {
        return $this->headerControlFactory->create();
    }
}