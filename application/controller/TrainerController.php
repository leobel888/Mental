<?php

/**
 * This controller shows an area that's only visible for logged in users (because of Auth::checkAuthentication(); in line 16)
 */
class TrainerController extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct()
    {
        parent::__construct();

        // this entire controller should only be visible/usable by logged in users, so we put authentication-check here
        Auth::checkAuthentication();
    }

    /**
     * This method controls what happens when you move to /trainer/index in your app.
     */
    public function index()
    {
        $this->View->render('trainer/index');
    }
	
	 /**
     * This method controls what happens when you move to /trainer/getpractic in your app.
     */
    public function getpractic()
    {
		$this->View->renderWithoutHeaderAndFooter('trainer/getpractic');
    }
	
	/**
     * This method controls what happens when you move to /trainer/substat in your app.
     */
    public function substat()
    {
		$this->View->renderWithoutHeaderAndFooter('trainer/substat');
    }
}
