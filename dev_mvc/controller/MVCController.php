<?php
namespace controller;
class MVCController{
	private $model;
	private $testaction;
    private $viewmodel;
    private $view;
    private $viewOverridden = false;
    private $timesOverridden = 0;
    private static $mvcController;
    public static $viewData = [];
    function __construct(){
    	self::$mvcController = $this;
    	//prepare current view and view model
    	if(isset($_GET['p']) && $_GET['p'] != ''){
    		$this->view = ROOT_DIR."/view/webcontent/content_".$_GET['p'].".php";
    		$this->viewmodel = ROOT_DIR."/viewmodel/viewmodel_".$_GET['p'].".php";
    	}
    	else{
    		$this->view = ROOT_DIR."/view/webcontent/content_home.php";
    		$this->viewmodel = ROOT_DIR."/viewmodel/viewmodel_home.php";
    	}
    	
    	//prepare current action model
    	if(isset($_POST['action'])){
    		$this->model = ROOT_DIR."/model/actions/model_".$_POST['action'].".php";
    	}
    	else if(isset($_GET['action'])){
    		$this->model = ROOT_DIR."/model/actions/model_".$_GET['action'].".php";
    	}
    	else{
    		$this->model = ROOT_DIR."/model/actions/model_empty.php";
		}


		if(isset($_POST['testaction'])){
			$this->testaction = ROOT_DIR."/model/testactions/TA_".$_POST['testaction'].".php";
		}


    }
    static function getMVCController():MVCController
    {
    	return self::$mvcController;
    }
    function overrideView($view_target):void
    {
    	$this->view = ROOT_DIR."/view/webcontent/content_".$view_target.".php";
    	$this->viewmodel = ROOT_DIR."/viewmodel/viewmodel_".$view_target.".php";
    	$this->viewOverridden = true;
    }
    function executeAction():void
    {
    	//check if action model is valid
    	if(file_exists($this->model)){
    		//execute action model
    		include_once($this->model);
    	}
    	//model doesn't exist and will not be called
    	else{
    		//debug message
    		echo("caught call on non-existant model file.");
		}


		//TESTACTION LAYER


		//check if testaction is valid
		if(file_exists($this->testaction)){
			//execute testaction
			require_once($this->testaction);
			$testactionClassname = "TA_".$_POST['testaction'];
			$testactionInstance = new $testactionClassname();
		}
    	
    }
    function executeViewmodel():void
    {
    	if(file_exists($this->viewmodel))
    	{
    		include_once($this->viewmodel);
    	}
    }
    function executeModel():void
    {
    	$this->executeAction();
    	//check if the view was overridden by action.
    	if($this->viewOverridden){
    		//don't need to run the viewmodel twice if it was overridden by action
    		$this->viewOverridden = false;
    	}
    	//run viewmodel
    	$this->executeViewmodel();
    	//run viewmodel again if overridden by viewmodel 
    	if($this->viewOverridden)
    	{
    		$this->executeViewmodel();
    	}
    }
    function loadView(){
    	if(file_exists($this->view)){
    		include_once($this->view);
    	}
    	else{
    		include_once(ROOT_DIR."/view/webcontent/content_404.php");
    		echo("view: ".$this->view." not found.");
    	}
    }
}
?>