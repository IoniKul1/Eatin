<?php
namespace PHPMaker2020\EATIN_BO;

/**
 * Page class
 */
class Restaurant_edit extends Restaurant
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{CC19BE4C-23D6-4992-89EF-6304995797F2}";

	// Table name
	public $TableName = 'Restaurant';

	// Page object name
	public $PageObjName = "Restaurant_edit";

	// Page headings
	public $Heading = "";
	public $Subheading = "";
	public $PageHeader;
	public $PageFooter;

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken;

	// Page heading
	public function pageHeading()
	{
		global $Language;
		if ($this->Heading != "")
			return $this->Heading;
		if (method_exists($this, "tableCaption"))
			return $this->tableCaption();
		return "";
	}

	// Page subheading
	public function pageSubheading()
	{
		global $Language;
		if ($this->Subheading != "")
			return $this->Subheading;
		if ($this->TableName)
			return $Language->phrase($this->PageID);
		return "";
	}

	// Page name
	public function pageName()
	{
		return CurrentPageName();
	}

	// Page URL
	public function pageUrl()
	{
		$url = CurrentPageName() . "?";
		if ($this->UseTokenInUrl)
			$url .= "t=" . $this->TableVar . "&"; // Add page token
		return $url;
	}

	// Messages
	private $_message = "";
	private $_failureMessage = "";
	private $_successMessage = "";
	private $_warningMessage = "";

	// Get message
	public function getMessage()
	{
		return isset($_SESSION[SESSION_MESSAGE]) ? $_SESSION[SESSION_MESSAGE] : $this->_message;
	}

	// Set message
	public function setMessage($v)
	{
		AddMessage($this->_message, $v);
		$_SESSION[SESSION_MESSAGE] = $this->_message;
	}

	// Get failure message
	public function getFailureMessage()
	{
		return isset($_SESSION[SESSION_FAILURE_MESSAGE]) ? $_SESSION[SESSION_FAILURE_MESSAGE] : $this->_failureMessage;
	}

	// Set failure message
	public function setFailureMessage($v)
	{
		AddMessage($this->_failureMessage, $v);
		$_SESSION[SESSION_FAILURE_MESSAGE] = $this->_failureMessage;
	}

	// Get success message
	public function getSuccessMessage()
	{
		return isset($_SESSION[SESSION_SUCCESS_MESSAGE]) ? $_SESSION[SESSION_SUCCESS_MESSAGE] : $this->_successMessage;
	}

	// Set success message
	public function setSuccessMessage($v)
	{
		AddMessage($this->_successMessage, $v);
		$_SESSION[SESSION_SUCCESS_MESSAGE] = $this->_successMessage;
	}

	// Get warning message
	public function getWarningMessage()
	{
		return isset($_SESSION[SESSION_WARNING_MESSAGE]) ? $_SESSION[SESSION_WARNING_MESSAGE] : $this->_warningMessage;
	}

	// Set warning message
	public function setWarningMessage($v)
	{
		AddMessage($this->_warningMessage, $v);
		$_SESSION[SESSION_WARNING_MESSAGE] = $this->_warningMessage;
	}

	// Clear message
	public function clearMessage()
	{
		$this->_message = "";
		$_SESSION[SESSION_MESSAGE] = "";
	}

	// Clear failure message
	public function clearFailureMessage()
	{
		$this->_failureMessage = "";
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
	}

	// Clear success message
	public function clearSuccessMessage()
	{
		$this->_successMessage = "";
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
	}

	// Clear warning message
	public function clearWarningMessage()
	{
		$this->_warningMessage = "";
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Clear messages
	public function clearMessages()
	{
		$this->clearMessage();
		$this->clearFailureMessage();
		$this->clearSuccessMessage();
		$this->clearWarningMessage();
	}

	// Show message
	public function showMessage()
	{
		$hidden = TRUE;
		$html = "";

		// Message
		$message = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($message, "");
		if ($message != "") { // Message in Session, display
			if (!$hidden)
				$message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message;
			$html .= '<div class="alert alert-info alert-dismissible ew-info"><i class="icon fas fa-info"></i>' . $message . '</div>';
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($warningMessage, "warning");
		if ($warningMessage != "") { // Message in Session, display
			if (!$hidden)
				$warningMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $warningMessage;
			$html .= '<div class="alert alert-warning alert-dismissible ew-warning"><i class="icon fas fa-exclamation"></i>' . $warningMessage . '</div>';
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($successMessage, "success");
		if ($successMessage != "") { // Message in Session, display
			if (!$hidden)
				$successMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $successMessage;
			$html .= '<div class="alert alert-success alert-dismissible ew-success"><i class="icon fas fa-check"></i>' . $successMessage . '</div>';
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$errorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($errorMessage, "failure");
		if ($errorMessage != "") { // Message in Session, display
			if (!$hidden)
				$errorMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $errorMessage;
			$html .= '<div class="alert alert-danger alert-dismissible ew-error"><i class="icon fas fa-ban"></i>' . $errorMessage . '</div>';
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo '<div class="ew-message-dialog' . (($hidden) ? ' d-none' : "") . '">' . $html . '</div>';
	}

	// Get message as array
	public function getMessages()
	{
		$ar = [];

		// Message
		$message = $this->getMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($message, "");

		if ($message != "") { // Message in Session, display
			$ar["message"] = $message;
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($warningMessage, "warning");

		if ($warningMessage != "") { // Message in Session, display
			$ar["warningMessage"] = $warningMessage;
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($successMessage, "success");

		if ($successMessage != "") { // Message in Session, display
			$ar["successMessage"] = $successMessage;
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$failureMessage = $this->getFailureMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($failureMessage, "failure");

		if ($failureMessage != "") { // Message in Session, display
			$ar["failureMessage"] = $failureMessage;
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		return $ar;
	}

	// Show Page Header
	public function showPageHeader()
	{
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		if ($header != "") { // Header exists, display
			echo '<p id="ew-page-header">' . $header . '</p>';
		}
	}

	// Show Page Footer
	public function showPageFooter()
	{
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		if ($footer != "") { // Footer exists, display
			echo '<p id="ew-page-footer">' . $footer . '</p>';
		}
	}

	// Validate page request
	protected function isPageRequest()
	{
		global $CurrentForm;
		if ($this->UseTokenInUrl) {
			if ($CurrentForm)
				return ($this->TableVar == $CurrentForm->getValue("t"));
			if (Get("t") !== NULL)
				return ($this->TableVar == Get("t"));
		}
		return TRUE;
	}

	// Valid Post
	protected function validPost()
	{
		if (!$this->CheckToken || !IsPost() || IsApi())
			return TRUE;
		if (Post(Config("TOKEN_NAME")) === NULL)
			return FALSE;
		$fn = Config("CHECK_TOKEN_FUNC");
		if (is_callable($fn))
			return $fn(Post(Config("TOKEN_NAME")), $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	public function createToken()
	{
		global $CurrentToken;
		$fn = Config("CREATE_TOKEN_FUNC"); // Always create token, required by API file/lookup request
		if ($this->Token == "" && is_callable($fn)) // Create token
			$this->Token = $fn();
		$CurrentToken = $this->Token; // Save to global variable
	}

	// Constructor
	public function __construct()
	{
		global $Language, $DashboardReport;
		global $UserTable;

		// Check token
		$this->CheckToken = Config("CHECK_TOKEN");

		// Initialize
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (Restaurant)
		if (!isset($GLOBALS["Restaurant"]) || get_class($GLOBALS["Restaurant"]) == PROJECT_NAMESPACE . "Restaurant") {
			$GLOBALS["Restaurant"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["Restaurant"];
		}

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'Restaurant');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = $this->getConnection();

		// User table object (Restaurant)
		$UserTable = $UserTable ?: new Restaurant();
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages, $DashboardReport;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $Restaurant;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($Restaurant);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection
		CloseConnections();

		// Return for API
		if (IsApi()) {
			$res = $url === TRUE;
			if (!$res) // Show error
				WriteJson(array_merge(["success" => FALSE], $this->getMessages()));
			return;
		}

		// Go to URL if specified
		if ($url != "") {
			if (!Config("DEBUG") && ob_get_length())
				ob_end_clean();

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = ["url" => $url, "modal" => "1"];
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "Restaurantview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				WriteJson($row);
			} else {
				SaveDebugMessage();
				AddHeader("Location", $url);
			}
		}
		exit();
	}

	// Get records from recordset
	protected function getRecordsFromRecordset($rs, $current = FALSE)
	{
		$rows = [];
		if (is_object($rs)) { // Recordset
			while ($rs && !$rs->EOF) {
				$this->loadRowValues($rs); // Set up DbValue/CurrentValue
				$row = $this->getRecordFromArray($rs->fields);
				if ($current)
					return $row;
				else
					$rows[] = $row;
				$rs->moveNext();
			}
		} elseif (is_array($rs)) {
			foreach ($rs as $ar) {
				$row = $this->getRecordFromArray($ar);
				if ($current)
					return $row;
				else
					$rows[] = $row;
			}
		}
		return $rows;
	}

	// Get record from array
	protected function getRecordFromArray($ar)
	{
		$row = [];
		if (is_array($ar)) {
			foreach ($ar as $fldname => $val) {
				if (array_key_exists($fldname, $this->fields) && ($this->fields[$fldname]->Visible || $this->fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
					$fld = &$this->fields[$fldname];
					if ($fld->HtmlTag == "FILE") { // Upload field
						if (EmptyValue($val)) {
							$row[$fldname] = NULL;
						} else {
							if ($fld->DataType == DATATYPE_BLOB) {
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									Config("API_FIELD_NAME") . "=" . $fld->Param . "&" .
									Config("API_KEY_NAME") . "=" . rawurlencode($this->getRecordKeyValue($ar)))); //*** need to add this? API may not be in the same folder
								$row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
							} elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									"fn=" . Encrypt($fld->physicalUploadPath() . $val)));
								$row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
							} else { // Multiple files
								$files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
								$ar = [];
								foreach ($files as $file) {
									$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
										Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
										"fn=" . Encrypt($fld->physicalUploadPath() . $file)));
									if (!EmptyValue($file))
										$ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
								}
								$row[$fldname] = $ar;
							}
						}
					} else {
						$row[$fldname] = $val;
					}
				}
			}
		}
		return $row;
	}

	// Get record key value from array
	protected function getRecordKeyValue($ar)
	{
		$key = "";
		if (is_array($ar)) {
			$key .= @$ar['ID'];
		}
		return $key;
	}

	/**
	 * Hide fields for add/edit
	 *
	 * @return void
	 */
	protected function hideFieldsForAddEdit()
	{
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->ID->Visible = FALSE;
	}

	// Lookup data
	public function lookup()
	{
		global $Language, $Security;
		if (!isset($Language))
			$Language = new Language(Config("LANGUAGE_FOLDER"), Post("language", ""));

		// Set up API request
		if (!ValidApiRequest())
			return FALSE;
		$this->setupApiSecurity();

		// Get lookup object
		$fieldName = Post("field");
		if (!array_key_exists($fieldName, $this->fields))
			return FALSE;
		$lookupField = $this->fields[$fieldName];
		$lookup = $lookupField->Lookup;
		if ($lookup === NULL)
			return FALSE;
		$tbl = $lookup->getTable();
		if (!$Security->allowLookup(Config("PROJECT_ID") . $tbl->TableName)) // Lookup permission
			return FALSE;

		// Get lookup parameters
		$lookupType = Post("ajax", "unknown");
		$pageSize = -1;
		$offset = -1;
		$searchValue = "";
		if (SameText($lookupType, "modal")) {
			$searchValue = Post("sv", "");
			$pageSize = Post("recperpage", 10);
			$offset = Post("start", 0);
		} elseif (SameText($lookupType, "autosuggest")) {
			$searchValue = Param("q", "");
			$pageSize = Param("n", -1);
			$pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
			if ($pageSize <= 0)
				$pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
			$start = Param("start", -1);
			$start = is_numeric($start) ? (int)$start : -1;
			$page = Param("page", -1);
			$page = is_numeric($page) ? (int)$page : -1;
			$offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
		}
		$userSelect = Decrypt(Post("s", ""));
		$userFilter = Decrypt(Post("f", ""));
		$userOrderBy = Decrypt(Post("o", ""));
		$keys = Post("keys");
		$lookup->LookupType = $lookupType; // Lookup type
		if ($keys !== NULL) { // Selected records from modal
			if (is_array($keys))
				$keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
			$lookup->FilterFields = []; // Skip parent fields if any
			$lookup->FilterValues[] = $keys; // Lookup values
			$pageSize = -1; // Show all records
		} else { // Lookup values
			$lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
		}
		$cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = Post("v" . $i, "");
		$lookup->SearchValue = $searchValue;
		$lookup->PageSize = $pageSize;
		$lookup->Offset = $offset;
		if ($userSelect != "")
			$lookup->UserSelect = $userSelect;
		if ($userFilter != "")
			$lookup->UserFilter = $userFilter;
		if ($userOrderBy != "")
			$lookup->UserOrderBy = $userOrderBy;
		$lookup->toJson($this); // Use settings from current page
	}

	// Set up API security
	public function setupApiSecurity()
	{
		global $Security;

		// Setup security for API request
		if ($Security->isLoggedIn()) $Security->TablePermission_Loading();
		$Security->loadCurrentUserLevel(Config("PROJECT_ID") . $this->TableName);
		if ($Security->isLoggedIn()) $Security->TablePermission_Loaded();
		$Security->UserID_Loading();
		$Security->loadUserID();
		$Security->UserID_Loaded();
	}
	public $FormClassName = "ew-horizontal ew-form ew-edit-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter;
	public $DbDetailFilter;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$FormError, $SkipHeaderFooter;

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
			if (!$Security->canEdit()) {
				SetStatus(401); // Unauthorized
				return;
			}
		} else {
			$Security = new AdvancedSecurity();
			if (!$Security->isLoggedIn())
				$Security->autoLogin();
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loaded();
			if (!$Security->canEdit()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("Restaurantlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
			if ($Security->isLoggedIn()) {
				$Security->UserID_Loading();
				$Security->loadUserID();
				$Security->UserID_Loaded();
				if (strval($Security->currentUserID()) == "") {
					$this->setFailureMessage(DeniedMessage()); // Set no permission
					$this->terminate(GetUrl("Restaurantlist.php"));
					return;
				}
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->ID->setVisibility();
		$this->ID_State->setVisibility();
		$this->DateCreation->Visible = FALSE;
		$this->DateLastUpdate->Visible = FALSE;
		$this->Nombre->setVisibility();
		$this->Lat->setVisibility();
		$this->Lon->setVisibility();
		$this->GoogleGeocodeAddress->setVisibility();
		$this->Address->setVisibility();
		$this->Deactivated->setVisibility();
		$this->Suspended->Visible = FALSE;
		$this->ActualQRGrantCode->setVisibility();
		$this->_Email->setVisibility();
		$this->Password->setVisibility();
		$this->SplashImg->setVisibility();
		$this->LogoSize1->setVisibility();
		$this->LogoSize2->setVisibility();
		$this->AppCSS->setVisibility();
		$this->SplashVideo->setVisibility();
		$this->hideFieldsForAddEdit();

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->validPost()) {
			Write($Language->phrase("InvalidPostRequest"));
			$this->terminate();
		}

		// Create Token
		$this->createToken();

		// Set up lookup cache
		// Check permission

		if (!$Security->canEdit()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("Restaurantlist.php");
			return;
		}

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-edit-form ew-horizontal";
		$loaded = FALSE;
		$postBack = FALSE;

		// Set up current action and primary key
		if (IsApi()) {

			// Load key values
			$loaded = TRUE;
			if (Get("ID") !== NULL) {
				$this->ID->setQueryStringValue(Get("ID"));
				$this->ID->setOldValue($this->ID->QueryStringValue);
			} elseif (Key(0) !== NULL) {
				$this->ID->setQueryStringValue(Key(0));
				$this->ID->setOldValue($this->ID->QueryStringValue);
			} elseif (Post("ID") !== NULL) {
				$this->ID->setFormValue(Post("ID"));
				$this->ID->setOldValue($this->ID->FormValue);
			} elseif (Route(2) !== NULL) {
				$this->ID->setQueryStringValue(Route(2));
				$this->ID->setOldValue($this->ID->QueryStringValue);
			} else {
				$loaded = FALSE; // Unable to load key
			}

			// Load record
			if ($loaded)
				$loaded = $this->loadRow();
			if (!$loaded) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
				$this->terminate();
				return;
			}
			$this->CurrentAction = "update"; // Update record directly
			$postBack = TRUE;
		} else {
			if (Post("action") !== NULL) {
				$this->CurrentAction = Post("action"); // Get action code
				if (!$this->isShow()) // Not reload record, handle as postback
					$postBack = TRUE;

				// Load key from Form
				if ($CurrentForm->hasValue("x_ID")) {
					$this->ID->setFormValue($CurrentForm->getValue("x_ID"));
				}
			} else {
				$this->CurrentAction = "show"; // Default action is display

				// Load key from QueryString / Route
				$loadByQuery = FALSE;
				if (Get("ID") !== NULL) {
					$this->ID->setQueryStringValue(Get("ID"));
					$loadByQuery = TRUE;
				} elseif (Route(2) !== NULL) {
					$this->ID->setQueryStringValue(Route(2));
					$loadByQuery = TRUE;
				} else {
					$this->ID->CurrentValue = NULL;
				}
			}

			// Load current record
			$loaded = $this->loadRow();
		}

		// Process form if post back
		if ($postBack) {
			$this->loadFormValues(); // Get form values

			// Set up detail parameters
			$this->setupDetailParms();
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->setFailureMessage($FormError);
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues();
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = ""; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "show": // Get a record to display
				if (!$loaded) { // Load record based on key
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("Restaurantlist.php"); // No matching record, return to list
				}

				// Set up detail parameters
				$this->setupDetailParms();
				break;
			case "update": // Update
				if ($this->getCurrentDetailTable() != "") // Master/detail edit
					$returnUrl = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=" . $this->getCurrentDetailTable()); // Master/Detail view page
				else
					$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "Restaurantlist.php")
					$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->editRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
					if (IsApi()) {
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl); // Return to caller
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
					$this->terminate($returnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Restore form values if update failed

					// Set up detail parameters
					$this->setupDetailParms();
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render the record
		$this->RowType = ROWTYPE_EDIT; // Render as Edit
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
		$this->SplashImg->Upload->Index = $CurrentForm->Index;
		$this->SplashImg->Upload->uploadFile();
		$this->SplashImg->CurrentValue = $this->SplashImg->Upload->FileName;
		$this->LogoSize1->Upload->Index = $CurrentForm->Index;
		$this->LogoSize1->Upload->uploadFile();
		$this->LogoSize1->CurrentValue = $this->LogoSize1->Upload->FileName;
		$this->LogoSize2->Upload->Index = $CurrentForm->Index;
		$this->LogoSize2->Upload->uploadFile();
		$this->LogoSize2->CurrentValue = $this->LogoSize2->Upload->FileName;
		$this->AppCSS->Upload->Index = $CurrentForm->Index;
		$this->AppCSS->Upload->uploadFile();
		$this->AppCSS->CurrentValue = $this->AppCSS->Upload->FileName;
		$this->SplashVideo->Upload->Index = $CurrentForm->Index;
		$this->SplashVideo->Upload->uploadFile();
		$this->SplashVideo->CurrentValue = $this->SplashVideo->Upload->FileName;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$this->getUploadFiles(); // Get upload files

		// Check field name 'ID' first before field var 'x_ID'
		$val = $CurrentForm->hasValue("ID") ? $CurrentForm->getValue("ID") : $CurrentForm->getValue("x_ID");
		if (!$this->ID->IsDetailKey)
			$this->ID->setFormValue($val);

		// Check field name 'ID_State' first before field var 'x_ID_State'
		$val = $CurrentForm->hasValue("ID_State") ? $CurrentForm->getValue("ID_State") : $CurrentForm->getValue("x_ID_State");
		if (!$this->ID_State->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ID_State->Visible = FALSE; // Disable update for API request
			else
				$this->ID_State->setFormValue($val);
		}

		// Check field name 'Nombre' first before field var 'x_Nombre'
		$val = $CurrentForm->hasValue("Nombre") ? $CurrentForm->getValue("Nombre") : $CurrentForm->getValue("x_Nombre");
		if (!$this->Nombre->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Nombre->Visible = FALSE; // Disable update for API request
			else
				$this->Nombre->setFormValue($val);
		}

		// Check field name 'Lat' first before field var 'x_Lat'
		$val = $CurrentForm->hasValue("Lat") ? $CurrentForm->getValue("Lat") : $CurrentForm->getValue("x_Lat");
		if (!$this->Lat->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Lat->Visible = FALSE; // Disable update for API request
			else
				$this->Lat->setFormValue($val);
		}

		// Check field name 'Lon' first before field var 'x_Lon'
		$val = $CurrentForm->hasValue("Lon") ? $CurrentForm->getValue("Lon") : $CurrentForm->getValue("x_Lon");
		if (!$this->Lon->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Lon->Visible = FALSE; // Disable update for API request
			else
				$this->Lon->setFormValue($val);
		}

		// Check field name 'GoogleGeocodeAddress' first before field var 'x_GoogleGeocodeAddress'
		$val = $CurrentForm->hasValue("GoogleGeocodeAddress") ? $CurrentForm->getValue("GoogleGeocodeAddress") : $CurrentForm->getValue("x_GoogleGeocodeAddress");
		if (!$this->GoogleGeocodeAddress->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->GoogleGeocodeAddress->Visible = FALSE; // Disable update for API request
			else
				$this->GoogleGeocodeAddress->setFormValue($val);
		}

		// Check field name 'Address' first before field var 'x_Address'
		$val = $CurrentForm->hasValue("Address") ? $CurrentForm->getValue("Address") : $CurrentForm->getValue("x_Address");
		if (!$this->Address->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Address->Visible = FALSE; // Disable update for API request
			else
				$this->Address->setFormValue($val);
		}

		// Check field name 'Deactivated' first before field var 'x_Deactivated'
		$val = $CurrentForm->hasValue("Deactivated") ? $CurrentForm->getValue("Deactivated") : $CurrentForm->getValue("x_Deactivated");
		if (!$this->Deactivated->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Deactivated->Visible = FALSE; // Disable update for API request
			else
				$this->Deactivated->setFormValue($val);
		}

		// Check field name 'ActualQRGrantCode' first before field var 'x_ActualQRGrantCode'
		$val = $CurrentForm->hasValue("ActualQRGrantCode") ? $CurrentForm->getValue("ActualQRGrantCode") : $CurrentForm->getValue("x_ActualQRGrantCode");
		if (!$this->ActualQRGrantCode->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ActualQRGrantCode->Visible = FALSE; // Disable update for API request
			else
				$this->ActualQRGrantCode->setFormValue($val);
		}

		// Check field name 'Email' first before field var 'x__Email'
		$val = $CurrentForm->hasValue("Email") ? $CurrentForm->getValue("Email") : $CurrentForm->getValue("x__Email");
		if (!$this->_Email->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_Email->Visible = FALSE; // Disable update for API request
			else
				$this->_Email->setFormValue($val);
		}

		// Check field name 'Password' first before field var 'x_Password'
		$val = $CurrentForm->hasValue("Password") ? $CurrentForm->getValue("Password") : $CurrentForm->getValue("x_Password");
		if (!$this->Password->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Password->Visible = FALSE; // Disable update for API request
			else
				if (Config("ENCRYPTED_PASSWORD")) // Encrypted password, use raw value
					$this->Password->setRawFormValue($val);
				else
					$this->Password->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->ID->CurrentValue = $this->ID->FormValue;
		$this->ID_State->CurrentValue = $this->ID_State->FormValue;
		$this->Nombre->CurrentValue = $this->Nombre->FormValue;
		$this->Lat->CurrentValue = $this->Lat->FormValue;
		$this->Lon->CurrentValue = $this->Lon->FormValue;
		$this->GoogleGeocodeAddress->CurrentValue = $this->GoogleGeocodeAddress->FormValue;
		$this->Address->CurrentValue = $this->Address->FormValue;
		$this->Deactivated->CurrentValue = $this->Deactivated->FormValue;
		$this->ActualQRGrantCode->CurrentValue = $this->ActualQRGrantCode->FormValue;
		$this->_Email->CurrentValue = $this->_Email->FormValue;
		$this->Password->CurrentValue = $this->Password->FormValue;
	}

	// Load row based on key values
	public function loadRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();

		// Call Row Selecting event
		$this->Row_Selecting($filter);

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$res = FALSE;
		$rs = LoadRecordset($sql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->loadRowValues($rs); // Load row values
			$rs->close();
		}

		// Check if valid User ID
		if ($res) {
			$res = $this->showOptionLink('edit');
			if (!$res) {
				$userIdMsg = DeniedMessage();
				$this->setFailureMessage($userIdMsg);
			}
		}
		return $res;
	}

	// Load row values from recordset
	public function loadRowValues($rs = NULL)
	{
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->newRow();

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->ID->setDbValue($row['ID']);
		$this->ID_State->setDbValue($row['ID_State']);
		$this->DateCreation->setDbValue($row['DateCreation']);
		$this->DateLastUpdate->setDbValue($row['DateLastUpdate']);
		$this->Nombre->setDbValue($row['Nombre']);
		$this->Lat->setDbValue($row['Lat']);
		$this->Lon->setDbValue($row['Lon']);
		$this->GoogleGeocodeAddress->setDbValue($row['GoogleGeocodeAddress']);
		$this->Address->setDbValue($row['Address']);
		$this->Deactivated->setDbValue($row['Deactivated']);
		$this->Suspended->setDbValue($row['Suspended']);
		$this->ActualQRGrantCode->setDbValue($row['ActualQRGrantCode']);
		$this->_Email->setDbValue($row['Email']);
		$this->Password->setDbValue($row['Password']);
		$this->SplashImg->Upload->DbValue = $row['SplashImg'];
		$this->SplashImg->setDbValue($this->SplashImg->Upload->DbValue);
		$this->LogoSize1->Upload->DbValue = $row['LogoSize1'];
		$this->LogoSize1->setDbValue($this->LogoSize1->Upload->DbValue);
		$this->LogoSize2->Upload->DbValue = $row['LogoSize2'];
		$this->LogoSize2->setDbValue($this->LogoSize2->Upload->DbValue);
		$this->AppCSS->Upload->DbValue = $row['AppCSS'];
		$this->AppCSS->setDbValue($this->AppCSS->Upload->DbValue);
		$this->SplashVideo->Upload->DbValue = $row['SplashVideo'];
		$this->SplashVideo->setDbValue($this->SplashVideo->Upload->DbValue);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['ID'] = NULL;
		$row['ID_State'] = NULL;
		$row['DateCreation'] = NULL;
		$row['DateLastUpdate'] = NULL;
		$row['Nombre'] = NULL;
		$row['Lat'] = NULL;
		$row['Lon'] = NULL;
		$row['GoogleGeocodeAddress'] = NULL;
		$row['Address'] = NULL;
		$row['Deactivated'] = NULL;
		$row['Suspended'] = NULL;
		$row['ActualQRGrantCode'] = NULL;
		$row['Email'] = NULL;
		$row['Password'] = NULL;
		$row['SplashImg'] = NULL;
		$row['LogoSize1'] = NULL;
		$row['LogoSize2'] = NULL;
		$row['AppCSS'] = NULL;
		$row['SplashVideo'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("ID")) != "")
			$this->ID->OldValue = $this->getKey("ID"); // ID
		else
			$validKey = FALSE;

		// Load old record
		$this->OldRecordset = NULL;
		if ($validKey) {
			$this->CurrentFilter = $this->getRecordFilter();
			$sql = $this->getCurrentSql();
			$conn = $this->getConnection();
			$this->OldRecordset = LoadRecordset($sql, $conn);
		}
		$this->loadRowValues($this->OldRecordset); // Load row values
		return $validKey;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->Lat->FormValue == $this->Lat->CurrentValue && is_numeric(ConvertToFloatString($this->Lat->CurrentValue)))
			$this->Lat->CurrentValue = ConvertToFloatString($this->Lat->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Lon->FormValue == $this->Lon->CurrentValue && is_numeric(ConvertToFloatString($this->Lon->CurrentValue)))
			$this->Lon->CurrentValue = ConvertToFloatString($this->Lon->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// ID
		// ID_State
		// DateCreation
		// DateLastUpdate
		// Nombre
		// Lat
		// Lon
		// GoogleGeocodeAddress
		// Address
		// Deactivated
		// Suspended
		// ActualQRGrantCode
		// Email
		// Password
		// SplashImg
		// LogoSize1
		// LogoSize2
		// AppCSS
		// SplashVideo

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// ID
			$this->ID->ViewValue = $this->ID->CurrentValue;
			$this->ID->ViewCustomAttributes = "";

			// ID_State
			$this->ID_State->ViewValue = $this->ID_State->CurrentValue;
			$this->ID_State->ViewValue = FormatNumber($this->ID_State->ViewValue, 0, -2, -2, -2);
			$this->ID_State->ViewCustomAttributes = "";

			// DateCreation
			$this->DateCreation->ViewValue = $this->DateCreation->CurrentValue;
			$this->DateCreation->ViewValue = FormatDateTime($this->DateCreation->ViewValue, 0);
			$this->DateCreation->ViewCustomAttributes = "";

			// DateLastUpdate
			$this->DateLastUpdate->ViewValue = $this->DateLastUpdate->CurrentValue;
			$this->DateLastUpdate->ViewValue = FormatDateTime($this->DateLastUpdate->ViewValue, 0);
			$this->DateLastUpdate->ViewCustomAttributes = "";

			// Nombre
			$this->Nombre->ViewValue = $this->Nombre->CurrentValue;
			$this->Nombre->ViewCustomAttributes = "";

			// Lat
			$this->Lat->ViewValue = $this->Lat->CurrentValue;
			$this->Lat->ViewValue = FormatNumber($this->Lat->ViewValue, 2, -2, -2, -2);
			$this->Lat->ViewCustomAttributes = "";

			// Lon
			$this->Lon->ViewValue = $this->Lon->CurrentValue;
			$this->Lon->ViewValue = FormatNumber($this->Lon->ViewValue, 2, -2, -2, -2);
			$this->Lon->ViewCustomAttributes = "";

			// GoogleGeocodeAddress
			$this->GoogleGeocodeAddress->ViewValue = $this->GoogleGeocodeAddress->CurrentValue;
			$this->GoogleGeocodeAddress->ViewCustomAttributes = "";

			// Address
			$this->Address->ViewValue = $this->Address->CurrentValue;
			$this->Address->ViewCustomAttributes = "";

			// Deactivated
			if (strval($this->Deactivated->CurrentValue) != "") {
				$this->Deactivated->ViewValue = new OptionValues();
				$arwrk = explode(",", strval($this->Deactivated->CurrentValue));
				$cnt = count($arwrk);
				for ($ari = 0; $ari < $cnt; $ari++)
					$this->Deactivated->ViewValue->add($this->Deactivated->optionCaption(trim($arwrk[$ari])));
			} else {
				$this->Deactivated->ViewValue = NULL;
			}
			$this->Deactivated->ViewCustomAttributes = "";

			// Suspended
			if (strval($this->Suspended->CurrentValue) != "") {
				$this->Suspended->ViewValue = $this->Suspended->optionCaption($this->Suspended->CurrentValue);
			} else {
				$this->Suspended->ViewValue = NULL;
			}
			$this->Suspended->ViewCustomAttributes = "";

			// ActualQRGrantCode
			$this->ActualQRGrantCode->ViewValue = $this->ActualQRGrantCode->CurrentValue;
			$this->ActualQRGrantCode->ViewCustomAttributes = "";

			// Email
			$this->_Email->ViewValue = $this->_Email->CurrentValue;
			$this->_Email->ViewCustomAttributes = "";

			// Password
			$this->Password->ViewValue = $Language->phrase("PasswordMask");
			$this->Password->ViewCustomAttributes = "";

			// SplashImg
			if (!EmptyValue($this->SplashImg->Upload->DbValue)) {
				$this->SplashImg->ImageWidth = 0;
				$this->SplashImg->ImageHeight = 200;
				$this->SplashImg->ImageAlt = $this->SplashImg->alt();
				$this->SplashImg->ViewValue = $this->SplashImg->Upload->DbValue;
			} else {
				$this->SplashImg->ViewValue = "";
			}
			$this->SplashImg->ViewCustomAttributes = "";

			// LogoSize1
			if (!EmptyValue($this->LogoSize1->Upload->DbValue)) {
				$this->LogoSize1->ImageWidth = 0;
				$this->LogoSize1->ImageHeight = 200;
				$this->LogoSize1->ImageAlt = $this->LogoSize1->alt();
				$this->LogoSize1->ViewValue = $this->LogoSize1->Upload->DbValue;
			} else {
				$this->LogoSize1->ViewValue = "";
			}
			$this->LogoSize1->ViewCustomAttributes = "";

			// LogoSize2
			if (!EmptyValue($this->LogoSize2->Upload->DbValue)) {
				$this->LogoSize2->ImageWidth = 0;
				$this->LogoSize2->ImageHeight = 200;
				$this->LogoSize2->ImageAlt = $this->LogoSize2->alt();
				$this->LogoSize2->ViewValue = $this->LogoSize2->Upload->DbValue;
			} else {
				$this->LogoSize2->ViewValue = "";
			}
			$this->LogoSize2->ViewCustomAttributes = "";

			// AppCSS
			if (!EmptyValue($this->AppCSS->Upload->DbValue)) {
				$this->AppCSS->ViewValue = $this->AppCSS->Upload->DbValue;
			} else {
				$this->AppCSS->ViewValue = "";
			}
			$this->AppCSS->ViewCustomAttributes = "";

			// SplashVideo
			if (!EmptyValue($this->SplashVideo->Upload->DbValue)) {
				$this->SplashVideo->ViewValue = $this->SplashVideo->Upload->DbValue;
			} else {
				$this->SplashVideo->ViewValue = "";
			}
			$this->SplashVideo->ViewCustomAttributes = "";

			// ID
			$this->ID->LinkCustomAttributes = "";
			$this->ID->HrefValue = "";
			$this->ID->TooltipValue = "";

			// ID_State
			$this->ID_State->LinkCustomAttributes = "";
			$this->ID_State->HrefValue = "";
			$this->ID_State->TooltipValue = "";

			// Nombre
			$this->Nombre->LinkCustomAttributes = "";
			$this->Nombre->HrefValue = "";
			$this->Nombre->TooltipValue = "";

			// Lat
			$this->Lat->LinkCustomAttributes = "";
			$this->Lat->HrefValue = "";
			$this->Lat->TooltipValue = "";

			// Lon
			$this->Lon->LinkCustomAttributes = "";
			$this->Lon->HrefValue = "";
			$this->Lon->TooltipValue = "";

			// GoogleGeocodeAddress
			$this->GoogleGeocodeAddress->LinkCustomAttributes = "";
			$this->GoogleGeocodeAddress->HrefValue = "";
			$this->GoogleGeocodeAddress->TooltipValue = "";

			// Address
			$this->Address->LinkCustomAttributes = "";
			$this->Address->HrefValue = "";
			$this->Address->TooltipValue = "";

			// Deactivated
			$this->Deactivated->LinkCustomAttributes = "";
			$this->Deactivated->HrefValue = "";
			$this->Deactivated->TooltipValue = "";

			// ActualQRGrantCode
			$this->ActualQRGrantCode->LinkCustomAttributes = "";
			$this->ActualQRGrantCode->HrefValue = "";
			$this->ActualQRGrantCode->TooltipValue = "";

			// Email
			$this->_Email->LinkCustomAttributes = "";
			$this->_Email->HrefValue = "";
			$this->_Email->TooltipValue = "";

			// Password
			$this->Password->LinkCustomAttributes = "";
			$this->Password->HrefValue = "";
			$this->Password->TooltipValue = "";

			// SplashImg
			$this->SplashImg->LinkCustomAttributes = "";
			if (!EmptyValue($this->SplashImg->Upload->DbValue)) {
				$this->SplashImg->HrefValue = GetFileUploadUrl($this->SplashImg, $this->SplashImg->htmlDecode($this->SplashImg->Upload->DbValue)); // Add prefix/suffix
				$this->SplashImg->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport())
					$this->SplashImg->HrefValue = FullUrl($this->SplashImg->HrefValue, "href");
			} else {
				$this->SplashImg->HrefValue = "";
			}
			$this->SplashImg->ExportHrefValue = $this->SplashImg->UploadPath . $this->SplashImg->Upload->DbValue;
			$this->SplashImg->TooltipValue = "";
			if ($this->SplashImg->UseColorbox) {
				if (EmptyValue($this->SplashImg->TooltipValue))
					$this->SplashImg->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
				$this->SplashImg->LinkAttrs["data-rel"] = "Restaurant_x_SplashImg";
				$this->SplashImg->LinkAttrs->appendClass("ew-lightbox");
			}

			// LogoSize1
			$this->LogoSize1->LinkCustomAttributes = "";
			if (!EmptyValue($this->LogoSize1->Upload->DbValue)) {
				$this->LogoSize1->HrefValue = GetFileUploadUrl($this->LogoSize1, $this->LogoSize1->htmlDecode($this->LogoSize1->Upload->DbValue)); // Add prefix/suffix
				$this->LogoSize1->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport())
					$this->LogoSize1->HrefValue = FullUrl($this->LogoSize1->HrefValue, "href");
			} else {
				$this->LogoSize1->HrefValue = "";
			}
			$this->LogoSize1->ExportHrefValue = $this->LogoSize1->UploadPath . $this->LogoSize1->Upload->DbValue;
			$this->LogoSize1->TooltipValue = "";
			if ($this->LogoSize1->UseColorbox) {
				if (EmptyValue($this->LogoSize1->TooltipValue))
					$this->LogoSize1->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
				$this->LogoSize1->LinkAttrs["data-rel"] = "Restaurant_x_LogoSize1";
				$this->LogoSize1->LinkAttrs->appendClass("ew-lightbox");
			}

			// LogoSize2
			$this->LogoSize2->LinkCustomAttributes = "";
			if (!EmptyValue($this->LogoSize2->Upload->DbValue)) {
				$this->LogoSize2->HrefValue = GetFileUploadUrl($this->LogoSize2, $this->LogoSize2->htmlDecode($this->LogoSize2->Upload->DbValue)); // Add prefix/suffix
				$this->LogoSize2->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport())
					$this->LogoSize2->HrefValue = FullUrl($this->LogoSize2->HrefValue, "href");
			} else {
				$this->LogoSize2->HrefValue = "";
			}
			$this->LogoSize2->ExportHrefValue = $this->LogoSize2->UploadPath . $this->LogoSize2->Upload->DbValue;
			$this->LogoSize2->TooltipValue = "";
			if ($this->LogoSize2->UseColorbox) {
				if (EmptyValue($this->LogoSize2->TooltipValue))
					$this->LogoSize2->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
				$this->LogoSize2->LinkAttrs["data-rel"] = "Restaurant_x_LogoSize2";
				$this->LogoSize2->LinkAttrs->appendClass("ew-lightbox");
			}

			// AppCSS
			$this->AppCSS->LinkCustomAttributes = "";
			if (!EmptyValue($this->AppCSS->Upload->DbValue)) {
				$this->AppCSS->HrefValue = GetFileUploadUrl($this->AppCSS, $this->AppCSS->htmlDecode($this->AppCSS->Upload->DbValue)); // Add prefix/suffix
				$this->AppCSS->LinkAttrs["target"] = "_blank"; // Add target
				if ($this->isExport())
					$this->AppCSS->HrefValue = FullUrl($this->AppCSS->HrefValue, "href");
			} else {
				$this->AppCSS->HrefValue = "";
			}
			$this->AppCSS->ExportHrefValue = $this->AppCSS->UploadPath . $this->AppCSS->Upload->DbValue;
			$this->AppCSS->TooltipValue = "";

			// SplashVideo
			$this->SplashVideo->LinkCustomAttributes = "";
			$this->SplashVideo->HrefValue = "";
			$this->SplashVideo->ExportHrefValue = $this->SplashVideo->UploadPath . $this->SplashVideo->Upload->DbValue;
			$this->SplashVideo->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// ID
			$this->ID->EditAttrs["class"] = "form-control";
			$this->ID->EditCustomAttributes = "";
			$this->ID->EditValue = $this->ID->CurrentValue;
			$this->ID->ViewCustomAttributes = "";

			// ID_State
			$this->ID_State->EditAttrs["class"] = "form-control";
			$this->ID_State->EditCustomAttributes = "";
			$this->ID_State->EditValue = HtmlEncode($this->ID_State->CurrentValue);
			$this->ID_State->PlaceHolder = RemoveHtml($this->ID_State->caption());

			// Nombre
			$this->Nombre->EditAttrs["class"] = "form-control";
			$this->Nombre->EditCustomAttributes = "";
			if (!$this->Nombre->Raw)
				$this->Nombre->CurrentValue = HtmlDecode($this->Nombre->CurrentValue);
			$this->Nombre->EditValue = HtmlEncode($this->Nombre->CurrentValue);
			$this->Nombre->PlaceHolder = RemoveHtml($this->Nombre->caption());

			// Lat
			$this->Lat->EditAttrs["class"] = "form-control";
			$this->Lat->EditCustomAttributes = "";
			$this->Lat->EditValue = HtmlEncode($this->Lat->CurrentValue);
			$this->Lat->PlaceHolder = RemoveHtml($this->Lat->caption());
			if (strval($this->Lat->EditValue) != "" && is_numeric($this->Lat->EditValue))
				$this->Lat->EditValue = FormatNumber($this->Lat->EditValue, -2, -2, -2, -2);
			

			// Lon
			$this->Lon->EditAttrs["class"] = "form-control";
			$this->Lon->EditCustomAttributes = "";
			$this->Lon->EditValue = HtmlEncode($this->Lon->CurrentValue);
			$this->Lon->PlaceHolder = RemoveHtml($this->Lon->caption());
			if (strval($this->Lon->EditValue) != "" && is_numeric($this->Lon->EditValue))
				$this->Lon->EditValue = FormatNumber($this->Lon->EditValue, -2, -2, -2, -2);
			

			// GoogleGeocodeAddress
			$this->GoogleGeocodeAddress->EditAttrs["class"] = "form-control";
			$this->GoogleGeocodeAddress->EditCustomAttributes = "";
			if (!$this->GoogleGeocodeAddress->Raw)
				$this->GoogleGeocodeAddress->CurrentValue = HtmlDecode($this->GoogleGeocodeAddress->CurrentValue);
			$this->GoogleGeocodeAddress->EditValue = HtmlEncode($this->GoogleGeocodeAddress->CurrentValue);
			$this->GoogleGeocodeAddress->PlaceHolder = RemoveHtml($this->GoogleGeocodeAddress->caption());

			// Address
			$this->Address->EditAttrs["class"] = "form-control";
			$this->Address->EditCustomAttributes = "";
			if (!$this->Address->Raw)
				$this->Address->CurrentValue = HtmlDecode($this->Address->CurrentValue);
			$this->Address->EditValue = HtmlEncode($this->Address->CurrentValue);
			$this->Address->PlaceHolder = RemoveHtml($this->Address->caption());

			// Deactivated
			$this->Deactivated->EditAttrs["class"] = "form-control";
			$this->Deactivated->EditCustomAttributes = "";
			if (strval($this->Deactivated->CurrentValue) != "") {
				$this->Deactivated->EditValue = new OptionValues();
				$arwrk = explode(",", strval($this->Deactivated->CurrentValue));
				$cnt = count($arwrk);
				for ($ari = 0; $ari < $cnt; $ari++)
					$this->Deactivated->EditValue->add($this->Deactivated->optionCaption(trim($arwrk[$ari])));
			} else {
				$this->Deactivated->EditValue = NULL;
			}
			$this->Deactivated->ViewCustomAttributes = "";

			// ActualQRGrantCode
			$this->ActualQRGrantCode->EditAttrs["class"] = "form-control";
			$this->ActualQRGrantCode->EditCustomAttributes = "";
			if (!$this->ActualQRGrantCode->Raw)
				$this->ActualQRGrantCode->CurrentValue = HtmlDecode($this->ActualQRGrantCode->CurrentValue);
			$this->ActualQRGrantCode->EditValue = HtmlEncode($this->ActualQRGrantCode->CurrentValue);
			$this->ActualQRGrantCode->PlaceHolder = RemoveHtml($this->ActualQRGrantCode->caption());

			// Email
			$this->_Email->EditAttrs["class"] = "form-control";
			$this->_Email->EditCustomAttributes = "";
			if (!$this->_Email->Raw)
				$this->_Email->CurrentValue = HtmlDecode($this->_Email->CurrentValue);
			$this->_Email->EditValue = HtmlEncode($this->_Email->CurrentValue);
			$this->_Email->PlaceHolder = RemoveHtml($this->_Email->caption());

			// Password
			$this->Password->EditAttrs["class"] = "form-control";
			$this->Password->EditCustomAttributes = "";
			$this->Password->EditValue = HtmlEncode($this->Password->CurrentValue);
			$this->Password->PlaceHolder = RemoveHtml($this->Password->caption());

			// SplashImg
			$this->SplashImg->EditAttrs["class"] = "form-control";
			$this->SplashImg->EditCustomAttributes = "";
			if (!EmptyValue($this->SplashImg->Upload->DbValue)) {
				$this->SplashImg->ImageWidth = 0;
				$this->SplashImg->ImageHeight = 200;
				$this->SplashImg->ImageAlt = $this->SplashImg->alt();
				$this->SplashImg->EditValue = $this->SplashImg->Upload->DbValue;
			} else {
				$this->SplashImg->EditValue = "";
			}
			if (!EmptyValue($this->SplashImg->CurrentValue))
					$this->SplashImg->Upload->FileName = $this->SplashImg->CurrentValue;
			if ($this->isShow())
				RenderUploadField($this->SplashImg);

			// LogoSize1
			$this->LogoSize1->EditAttrs["class"] = "form-control";
			$this->LogoSize1->EditCustomAttributes = "";
			if (!EmptyValue($this->LogoSize1->Upload->DbValue)) {
				$this->LogoSize1->ImageWidth = 0;
				$this->LogoSize1->ImageHeight = 200;
				$this->LogoSize1->ImageAlt = $this->LogoSize1->alt();
				$this->LogoSize1->EditValue = $this->LogoSize1->Upload->DbValue;
			} else {
				$this->LogoSize1->EditValue = "";
			}
			if (!EmptyValue($this->LogoSize1->CurrentValue))
					$this->LogoSize1->Upload->FileName = $this->LogoSize1->CurrentValue;
			if ($this->isShow())
				RenderUploadField($this->LogoSize1);

			// LogoSize2
			$this->LogoSize2->EditAttrs["class"] = "form-control";
			$this->LogoSize2->EditCustomAttributes = "";
			if (!EmptyValue($this->LogoSize2->Upload->DbValue)) {
				$this->LogoSize2->ImageWidth = 0;
				$this->LogoSize2->ImageHeight = 200;
				$this->LogoSize2->ImageAlt = $this->LogoSize2->alt();
				$this->LogoSize2->EditValue = $this->LogoSize2->Upload->DbValue;
			} else {
				$this->LogoSize2->EditValue = "";
			}
			if (!EmptyValue($this->LogoSize2->CurrentValue))
					$this->LogoSize2->Upload->FileName = $this->LogoSize2->CurrentValue;
			if ($this->isShow())
				RenderUploadField($this->LogoSize2);

			// AppCSS
			$this->AppCSS->EditAttrs["class"] = "form-control";
			$this->AppCSS->EditCustomAttributes = "";
			if (!EmptyValue($this->AppCSS->Upload->DbValue)) {
				$this->AppCSS->EditValue = $this->AppCSS->Upload->DbValue;
			} else {
				$this->AppCSS->EditValue = "";
			}
			if (!EmptyValue($this->AppCSS->CurrentValue))
					$this->AppCSS->Upload->FileName = $this->AppCSS->CurrentValue;
			if ($this->isShow())
				RenderUploadField($this->AppCSS);

			// SplashVideo
			$this->SplashVideo->EditAttrs["class"] = "form-control";
			$this->SplashVideo->EditCustomAttributes = "";
			if (!EmptyValue($this->SplashVideo->Upload->DbValue)) {
				$this->SplashVideo->EditValue = $this->SplashVideo->Upload->DbValue;
			} else {
				$this->SplashVideo->EditValue = "";
			}
			if (!EmptyValue($this->SplashVideo->CurrentValue))
					$this->SplashVideo->Upload->FileName = $this->SplashVideo->CurrentValue;
			if ($this->isShow())
				RenderUploadField($this->SplashVideo);

			// Edit refer script
			// ID

			$this->ID->LinkCustomAttributes = "";
			$this->ID->HrefValue = "";

			// ID_State
			$this->ID_State->LinkCustomAttributes = "";
			$this->ID_State->HrefValue = "";

			// Nombre
			$this->Nombre->LinkCustomAttributes = "";
			$this->Nombre->HrefValue = "";

			// Lat
			$this->Lat->LinkCustomAttributes = "";
			$this->Lat->HrefValue = "";

			// Lon
			$this->Lon->LinkCustomAttributes = "";
			$this->Lon->HrefValue = "";

			// GoogleGeocodeAddress
			$this->GoogleGeocodeAddress->LinkCustomAttributes = "";
			$this->GoogleGeocodeAddress->HrefValue = "";

			// Address
			$this->Address->LinkCustomAttributes = "";
			$this->Address->HrefValue = "";

			// Deactivated
			$this->Deactivated->LinkCustomAttributes = "";
			$this->Deactivated->HrefValue = "";
			$this->Deactivated->TooltipValue = "";

			// ActualQRGrantCode
			$this->ActualQRGrantCode->LinkCustomAttributes = "";
			$this->ActualQRGrantCode->HrefValue = "";

			// Email
			$this->_Email->LinkCustomAttributes = "";
			$this->_Email->HrefValue = "";

			// Password
			$this->Password->LinkCustomAttributes = "";
			$this->Password->HrefValue = "";

			// SplashImg
			$this->SplashImg->LinkCustomAttributes = "";
			if (!EmptyValue($this->SplashImg->Upload->DbValue)) {
				$this->SplashImg->HrefValue = GetFileUploadUrl($this->SplashImg, $this->SplashImg->htmlDecode($this->SplashImg->Upload->DbValue)); // Add prefix/suffix
				$this->SplashImg->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport())
					$this->SplashImg->HrefValue = FullUrl($this->SplashImg->HrefValue, "href");
			} else {
				$this->SplashImg->HrefValue = "";
			}
			$this->SplashImg->ExportHrefValue = $this->SplashImg->UploadPath . $this->SplashImg->Upload->DbValue;

			// LogoSize1
			$this->LogoSize1->LinkCustomAttributes = "";
			if (!EmptyValue($this->LogoSize1->Upload->DbValue)) {
				$this->LogoSize1->HrefValue = GetFileUploadUrl($this->LogoSize1, $this->LogoSize1->htmlDecode($this->LogoSize1->Upload->DbValue)); // Add prefix/suffix
				$this->LogoSize1->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport())
					$this->LogoSize1->HrefValue = FullUrl($this->LogoSize1->HrefValue, "href");
			} else {
				$this->LogoSize1->HrefValue = "";
			}
			$this->LogoSize1->ExportHrefValue = $this->LogoSize1->UploadPath . $this->LogoSize1->Upload->DbValue;

			// LogoSize2
			$this->LogoSize2->LinkCustomAttributes = "";
			if (!EmptyValue($this->LogoSize2->Upload->DbValue)) {
				$this->LogoSize2->HrefValue = GetFileUploadUrl($this->LogoSize2, $this->LogoSize2->htmlDecode($this->LogoSize2->Upload->DbValue)); // Add prefix/suffix
				$this->LogoSize2->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport())
					$this->LogoSize2->HrefValue = FullUrl($this->LogoSize2->HrefValue, "href");
			} else {
				$this->LogoSize2->HrefValue = "";
			}
			$this->LogoSize2->ExportHrefValue = $this->LogoSize2->UploadPath . $this->LogoSize2->Upload->DbValue;

			// AppCSS
			$this->AppCSS->LinkCustomAttributes = "";
			if (!EmptyValue($this->AppCSS->Upload->DbValue)) {
				$this->AppCSS->HrefValue = GetFileUploadUrl($this->AppCSS, $this->AppCSS->htmlDecode($this->AppCSS->Upload->DbValue)); // Add prefix/suffix
				$this->AppCSS->LinkAttrs["target"] = "_blank"; // Add target
				if ($this->isExport())
					$this->AppCSS->HrefValue = FullUrl($this->AppCSS->HrefValue, "href");
			} else {
				$this->AppCSS->HrefValue = "";
			}
			$this->AppCSS->ExportHrefValue = $this->AppCSS->UploadPath . $this->AppCSS->Upload->DbValue;

			// SplashVideo
			$this->SplashVideo->LinkCustomAttributes = "";
			$this->SplashVideo->HrefValue = "";
			$this->SplashVideo->ExportHrefValue = $this->SplashVideo->UploadPath . $this->SplashVideo->Upload->DbValue;
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return ($FormError == "");
		if ($this->ID->Required) {
			if (!$this->ID->IsDetailKey && $this->ID->FormValue != NULL && $this->ID->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ID->caption(), $this->ID->RequiredErrorMessage));
			}
		}
		if ($this->ID_State->Required) {
			if (!$this->ID_State->IsDetailKey && $this->ID_State->FormValue != NULL && $this->ID_State->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ID_State->caption(), $this->ID_State->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->ID_State->FormValue)) {
			AddMessage($FormError, $this->ID_State->errorMessage());
		}
		if ($this->Nombre->Required) {
			if (!$this->Nombre->IsDetailKey && $this->Nombre->FormValue != NULL && $this->Nombre->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Nombre->caption(), $this->Nombre->RequiredErrorMessage));
			}
		}
		if ($this->Lat->Required) {
			if (!$this->Lat->IsDetailKey && $this->Lat->FormValue != NULL && $this->Lat->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Lat->caption(), $this->Lat->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->Lat->FormValue)) {
			AddMessage($FormError, $this->Lat->errorMessage());
		}
		if ($this->Lon->Required) {
			if (!$this->Lon->IsDetailKey && $this->Lon->FormValue != NULL && $this->Lon->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Lon->caption(), $this->Lon->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->Lon->FormValue)) {
			AddMessage($FormError, $this->Lon->errorMessage());
		}
		if ($this->GoogleGeocodeAddress->Required) {
			if (!$this->GoogleGeocodeAddress->IsDetailKey && $this->GoogleGeocodeAddress->FormValue != NULL && $this->GoogleGeocodeAddress->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->GoogleGeocodeAddress->caption(), $this->GoogleGeocodeAddress->RequiredErrorMessage));
			}
		}
		if ($this->Address->Required) {
			if (!$this->Address->IsDetailKey && $this->Address->FormValue != NULL && $this->Address->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Address->caption(), $this->Address->RequiredErrorMessage));
			}
		}
		if ($this->Deactivated->Required) {
			if ($this->Deactivated->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Deactivated->caption(), $this->Deactivated->RequiredErrorMessage));
			}
		}
		if ($this->ActualQRGrantCode->Required) {
			if (!$this->ActualQRGrantCode->IsDetailKey && $this->ActualQRGrantCode->FormValue != NULL && $this->ActualQRGrantCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ActualQRGrantCode->caption(), $this->ActualQRGrantCode->RequiredErrorMessage));
			}
		}
		if ($this->_Email->Required) {
			if (!$this->_Email->IsDetailKey && $this->_Email->FormValue != NULL && $this->_Email->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_Email->caption(), $this->_Email->RequiredErrorMessage));
			}
		}
		if ($this->Password->Required) {
			if (!$this->Password->IsDetailKey && $this->Password->FormValue != NULL && $this->Password->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Password->caption(), $this->Password->RequiredErrorMessage));
			}
		}
		if ($this->SplashImg->Required) {
			if ($this->SplashImg->Upload->FileName == "" && !$this->SplashImg->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->SplashImg->caption(), $this->SplashImg->RequiredErrorMessage));
			}
		}
		if ($this->LogoSize1->Required) {
			if ($this->LogoSize1->Upload->FileName == "" && !$this->LogoSize1->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->LogoSize1->caption(), $this->LogoSize1->RequiredErrorMessage));
			}
		}
		if ($this->LogoSize2->Required) {
			if ($this->LogoSize2->Upload->FileName == "" && !$this->LogoSize2->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->LogoSize2->caption(), $this->LogoSize2->RequiredErrorMessage));
			}
		}
		if ($this->AppCSS->Required) {
			if ($this->AppCSS->Upload->FileName == "" && !$this->AppCSS->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->AppCSS->caption(), $this->AppCSS->RequiredErrorMessage));
			}
		}
		if ($this->SplashVideo->Required) {
			if ($this->SplashVideo->Upload->FileName == "" && !$this->SplashVideo->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->SplashVideo->caption(), $this->SplashVideo->RequiredErrorMessage));
			}
		}

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("Client", $detailTblVar) && $GLOBALS["Client"]->DetailEdit) {
			if (!isset($GLOBALS["Client_grid"]))
				$GLOBALS["Client_grid"] = new Client_grid(); // Get detail page object
			$GLOBALS["Client_grid"]->validateGridForm();
		}
		if (in_array("Categorias", $detailTblVar) && $GLOBALS["Categorias"]->DetailEdit) {
			if (!isset($GLOBALS["Categorias_grid"]))
				$GLOBALS["Categorias_grid"] = new Categorias_grid(); // Get detail page object
			$GLOBALS["Categorias_grid"]->validateGridForm();
		}
		if (in_array("_Table", $detailTblVar) && $GLOBALS["_Table"]->DetailEdit) {
			if (!isset($GLOBALS["_Table_grid"]))
				$GLOBALS["_Table_grid"] = new _Table_grid(); // Get detail page object
			$GLOBALS["_Table_grid"]->validateGridForm();
		}

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError != "") {
			AddMessage($FormError, $formCustomError);
		}
		return $validateForm;
	}

	// Update record based on key values
	protected function editRow()
	{
		global $Security, $Language;
		$oldKeyFilter = $this->getRecordFilter();
		$filter = $this->applyUserIDFilters($oldKeyFilter);
		$conn = $this->getConnection();
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = "";
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
			$editRow = FALSE; // Update Failed
		} else {

			// Begin transaction
			if ($this->getCurrentDetailTable() != "")
				$conn->beginTrans();

			// Save old values
			$rsold = &$rs->fields;
			$this->loadDbValues($rsold);
			$rsnew = [];

			// ID_State
			$this->ID_State->setDbValueDef($rsnew, $this->ID_State->CurrentValue, NULL, $this->ID_State->ReadOnly);

			// Nombre
			$this->Nombre->setDbValueDef($rsnew, $this->Nombre->CurrentValue, NULL, $this->Nombre->ReadOnly);

			// Lat
			$this->Lat->setDbValueDef($rsnew, $this->Lat->CurrentValue, NULL, $this->Lat->ReadOnly);

			// Lon
			$this->Lon->setDbValueDef($rsnew, $this->Lon->CurrentValue, NULL, $this->Lon->ReadOnly);

			// GoogleGeocodeAddress
			$this->GoogleGeocodeAddress->setDbValueDef($rsnew, $this->GoogleGeocodeAddress->CurrentValue, NULL, $this->GoogleGeocodeAddress->ReadOnly);

			// Address
			$this->Address->setDbValueDef($rsnew, $this->Address->CurrentValue, NULL, $this->Address->ReadOnly);

			// ActualQRGrantCode
			$this->ActualQRGrantCode->setDbValueDef($rsnew, $this->ActualQRGrantCode->CurrentValue, NULL, $this->ActualQRGrantCode->ReadOnly);

			// Email
			$this->_Email->setDbValueDef($rsnew, $this->_Email->CurrentValue, NULL, $this->_Email->ReadOnly);

			// Password
			$this->Password->setDbValueDef($rsnew, $this->Password->CurrentValue, NULL, $this->Password->ReadOnly || Config("ENCRYPTED_PASSWORD") && $rs->fields('Password') == $this->Password->CurrentValue);

			// SplashImg
			if ($this->SplashImg->Visible && !$this->SplashImg->ReadOnly && !$this->SplashImg->Upload->KeepFile) {
				$this->SplashImg->Upload->DbValue = $rsold['SplashImg']; // Get original value
				if ($this->SplashImg->Upload->FileName == "") {
					$rsnew['SplashImg'] = NULL;
				} else {
					$rsnew['SplashImg'] = $this->SplashImg->Upload->FileName;
				}
			}

			// LogoSize1
			if ($this->LogoSize1->Visible && !$this->LogoSize1->ReadOnly && !$this->LogoSize1->Upload->KeepFile) {
				$this->LogoSize1->Upload->DbValue = $rsold['LogoSize1']; // Get original value
				if ($this->LogoSize1->Upload->FileName == "") {
					$rsnew['LogoSize1'] = NULL;
				} else {
					$rsnew['LogoSize1'] = $this->LogoSize1->Upload->FileName;
				}
			}

			// LogoSize2
			if ($this->LogoSize2->Visible && !$this->LogoSize2->ReadOnly && !$this->LogoSize2->Upload->KeepFile) {
				$this->LogoSize2->Upload->DbValue = $rsold['LogoSize2']; // Get original value
				if ($this->LogoSize2->Upload->FileName == "") {
					$rsnew['LogoSize2'] = NULL;
				} else {
					$rsnew['LogoSize2'] = $this->LogoSize2->Upload->FileName;
				}
			}

			// AppCSS
			if ($this->AppCSS->Visible && !$this->AppCSS->ReadOnly && !$this->AppCSS->Upload->KeepFile) {
				$this->AppCSS->Upload->DbValue = $rsold['AppCSS']; // Get original value
				if ($this->AppCSS->Upload->FileName == "") {
					$rsnew['AppCSS'] = NULL;
				} else {
					$rsnew['AppCSS'] = $this->AppCSS->Upload->FileName;
				}
			}

			// SplashVideo
			if ($this->SplashVideo->Visible && !$this->SplashVideo->ReadOnly && !$this->SplashVideo->Upload->KeepFile) {
				$this->SplashVideo->Upload->DbValue = $rsold['SplashVideo']; // Get original value
				if ($this->SplashVideo->Upload->FileName == "") {
					$rsnew['SplashVideo'] = NULL;
				} else {
					$rsnew['SplashVideo'] = $this->SplashVideo->Upload->FileName;
				}
			}
			if ($this->SplashImg->Visible && !$this->SplashImg->Upload->KeepFile) {
				$oldFiles = EmptyValue($this->SplashImg->Upload->DbValue) ? [] : [$this->SplashImg->htmlDecode($this->SplashImg->Upload->DbValue)];
				if (!EmptyValue($this->SplashImg->Upload->FileName)) {
					$newFiles = [$this->SplashImg->Upload->FileName];
					$NewFileCount = count($newFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						if ($newFiles[$i] != "") {
							$file = $newFiles[$i];
							$tempPath = UploadTempPath($this->SplashImg, $this->SplashImg->Upload->Index);
							if (file_exists($tempPath . $file)) {
								if (Config("DELETE_UPLOADED_FILES")) {
									$oldFileFound = FALSE;
									$oldFileCount = count($oldFiles);
									for ($j = 0; $j < $oldFileCount; $j++) {
										$oldFile = $oldFiles[$j];
										if ($oldFile == $file) { // Old file found, no need to delete anymore
											array_splice($oldFiles, $j, 1);
											$oldFileFound = TRUE;
											break;
										}
									}
									if ($oldFileFound) // No need to check if file exists further
										continue;
								}
								$file1 = UniqueFilename($this->SplashImg->physicalUploadPath(), $file); // Get new file name
								if ($file1 != $file) { // Rename temp file
									while (file_exists($tempPath . $file1) || file_exists($this->SplashImg->physicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = UniqueFilename($this->SplashImg->physicalUploadPath(), $file1, TRUE); // Use indexed name
									rename($tempPath . $file, $tempPath . $file1);
									$newFiles[$i] = $file1;
								}
							}
						}
					}
					$this->SplashImg->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
					$this->SplashImg->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
					$this->SplashImg->setDbValueDef($rsnew, $this->SplashImg->Upload->FileName, NULL, $this->SplashImg->ReadOnly);
				}
			}
			if ($this->LogoSize1->Visible && !$this->LogoSize1->Upload->KeepFile) {
				$oldFiles = EmptyValue($this->LogoSize1->Upload->DbValue) ? [] : [$this->LogoSize1->htmlDecode($this->LogoSize1->Upload->DbValue)];
				if (!EmptyValue($this->LogoSize1->Upload->FileName)) {
					$newFiles = [$this->LogoSize1->Upload->FileName];
					$NewFileCount = count($newFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						if ($newFiles[$i] != "") {
							$file = $newFiles[$i];
							$tempPath = UploadTempPath($this->LogoSize1, $this->LogoSize1->Upload->Index);
							if (file_exists($tempPath . $file)) {
								if (Config("DELETE_UPLOADED_FILES")) {
									$oldFileFound = FALSE;
									$oldFileCount = count($oldFiles);
									for ($j = 0; $j < $oldFileCount; $j++) {
										$oldFile = $oldFiles[$j];
										if ($oldFile == $file) { // Old file found, no need to delete anymore
											array_splice($oldFiles, $j, 1);
											$oldFileFound = TRUE;
											break;
										}
									}
									if ($oldFileFound) // No need to check if file exists further
										continue;
								}
								$file1 = UniqueFilename($this->LogoSize1->physicalUploadPath(), $file); // Get new file name
								if ($file1 != $file) { // Rename temp file
									while (file_exists($tempPath . $file1) || file_exists($this->LogoSize1->physicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = UniqueFilename($this->LogoSize1->physicalUploadPath(), $file1, TRUE); // Use indexed name
									rename($tempPath . $file, $tempPath . $file1);
									$newFiles[$i] = $file1;
								}
							}
						}
					}
					$this->LogoSize1->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
					$this->LogoSize1->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
					$this->LogoSize1->setDbValueDef($rsnew, $this->LogoSize1->Upload->FileName, NULL, $this->LogoSize1->ReadOnly);
				}
			}
			if ($this->LogoSize2->Visible && !$this->LogoSize2->Upload->KeepFile) {
				$oldFiles = EmptyValue($this->LogoSize2->Upload->DbValue) ? [] : [$this->LogoSize2->htmlDecode($this->LogoSize2->Upload->DbValue)];
				if (!EmptyValue($this->LogoSize2->Upload->FileName)) {
					$newFiles = [$this->LogoSize2->Upload->FileName];
					$NewFileCount = count($newFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						if ($newFiles[$i] != "") {
							$file = $newFiles[$i];
							$tempPath = UploadTempPath($this->LogoSize2, $this->LogoSize2->Upload->Index);
							if (file_exists($tempPath . $file)) {
								if (Config("DELETE_UPLOADED_FILES")) {
									$oldFileFound = FALSE;
									$oldFileCount = count($oldFiles);
									for ($j = 0; $j < $oldFileCount; $j++) {
										$oldFile = $oldFiles[$j];
										if ($oldFile == $file) { // Old file found, no need to delete anymore
											array_splice($oldFiles, $j, 1);
											$oldFileFound = TRUE;
											break;
										}
									}
									if ($oldFileFound) // No need to check if file exists further
										continue;
								}
								$file1 = UniqueFilename($this->LogoSize2->physicalUploadPath(), $file); // Get new file name
								if ($file1 != $file) { // Rename temp file
									while (file_exists($tempPath . $file1) || file_exists($this->LogoSize2->physicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = UniqueFilename($this->LogoSize2->physicalUploadPath(), $file1, TRUE); // Use indexed name
									rename($tempPath . $file, $tempPath . $file1);
									$newFiles[$i] = $file1;
								}
							}
						}
					}
					$this->LogoSize2->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
					$this->LogoSize2->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
					$this->LogoSize2->setDbValueDef($rsnew, $this->LogoSize2->Upload->FileName, NULL, $this->LogoSize2->ReadOnly);
				}
			}
			if ($this->AppCSS->Visible && !$this->AppCSS->Upload->KeepFile) {
				$oldFiles = EmptyValue($this->AppCSS->Upload->DbValue) ? [] : [$this->AppCSS->htmlDecode($this->AppCSS->Upload->DbValue)];
				if (!EmptyValue($this->AppCSS->Upload->FileName)) {
					$newFiles = [$this->AppCSS->Upload->FileName];
					$NewFileCount = count($newFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						if ($newFiles[$i] != "") {
							$file = $newFiles[$i];
							$tempPath = UploadTempPath($this->AppCSS, $this->AppCSS->Upload->Index);
							if (file_exists($tempPath . $file)) {
								if (Config("DELETE_UPLOADED_FILES")) {
									$oldFileFound = FALSE;
									$oldFileCount = count($oldFiles);
									for ($j = 0; $j < $oldFileCount; $j++) {
										$oldFile = $oldFiles[$j];
										if ($oldFile == $file) { // Old file found, no need to delete anymore
											array_splice($oldFiles, $j, 1);
											$oldFileFound = TRUE;
											break;
										}
									}
									if ($oldFileFound) // No need to check if file exists further
										continue;
								}
								$file1 = UniqueFilename($this->AppCSS->physicalUploadPath(), $file); // Get new file name
								if ($file1 != $file) { // Rename temp file
									while (file_exists($tempPath . $file1) || file_exists($this->AppCSS->physicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = UniqueFilename($this->AppCSS->physicalUploadPath(), $file1, TRUE); // Use indexed name
									rename($tempPath . $file, $tempPath . $file1);
									$newFiles[$i] = $file1;
								}
							}
						}
					}
					$this->AppCSS->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
					$this->AppCSS->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
					$this->AppCSS->setDbValueDef($rsnew, $this->AppCSS->Upload->FileName, NULL, $this->AppCSS->ReadOnly);
				}
			}
			if ($this->SplashVideo->Visible && !$this->SplashVideo->Upload->KeepFile) {
				$oldFiles = EmptyValue($this->SplashVideo->Upload->DbValue) ? [] : [$this->SplashVideo->htmlDecode($this->SplashVideo->Upload->DbValue)];
				if (!EmptyValue($this->SplashVideo->Upload->FileName)) {
					$newFiles = [$this->SplashVideo->Upload->FileName];
					$NewFileCount = count($newFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						if ($newFiles[$i] != "") {
							$file = $newFiles[$i];
							$tempPath = UploadTempPath($this->SplashVideo, $this->SplashVideo->Upload->Index);
							if (file_exists($tempPath . $file)) {
								if (Config("DELETE_UPLOADED_FILES")) {
									$oldFileFound = FALSE;
									$oldFileCount = count($oldFiles);
									for ($j = 0; $j < $oldFileCount; $j++) {
										$oldFile = $oldFiles[$j];
										if ($oldFile == $file) { // Old file found, no need to delete anymore
											array_splice($oldFiles, $j, 1);
											$oldFileFound = TRUE;
											break;
										}
									}
									if ($oldFileFound) // No need to check if file exists further
										continue;
								}
								$file1 = UniqueFilename($this->SplashVideo->physicalUploadPath(), $file); // Get new file name
								if ($file1 != $file) { // Rename temp file
									while (file_exists($tempPath . $file1) || file_exists($this->SplashVideo->physicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = UniqueFilename($this->SplashVideo->physicalUploadPath(), $file1, TRUE); // Use indexed name
									rename($tempPath . $file, $tempPath . $file1);
									$newFiles[$i] = $file1;
								}
							}
						}
					}
					$this->SplashVideo->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
					$this->SplashVideo->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
					$this->SplashVideo->setDbValueDef($rsnew, $this->SplashVideo->Upload->FileName, NULL, $this->SplashVideo->ReadOnly);
				}
			}

			// Call Row Updating event
			$updateRow = $this->Row_Updating($rsold, $rsnew);

			// Check for duplicate key when key changed
			if ($updateRow) {
				$newKeyFilter = $this->getRecordFilter($rsnew);
				if ($newKeyFilter != $oldKeyFilter) {
					$rsChk = $this->loadRs($newKeyFilter);
					if ($rsChk && !$rsChk->EOF) {
						$keyErrMsg = str_replace("%f", $newKeyFilter, $Language->phrase("DupKey"));
						$this->setFailureMessage($keyErrMsg);
						$rsChk->close();
						$updateRow = FALSE;
					}
				}
			}
			if ($updateRow) {
				$conn->raiseErrorFn = Config("ERROR_FUNC");
				if (count($rsnew) > 0)
					$editRow = $this->update($rsnew, "", $rsold);
				else
					$editRow = TRUE; // No field to update
				$conn->raiseErrorFn = "";
				if ($editRow) {
					if ($this->SplashImg->Visible && !$this->SplashImg->Upload->KeepFile) {
						$oldFiles = EmptyValue($this->SplashImg->Upload->DbValue) ? [] : [$this->SplashImg->htmlDecode($this->SplashImg->Upload->DbValue)];
						if (!EmptyValue($this->SplashImg->Upload->FileName)) {
							$newFiles = [$this->SplashImg->Upload->FileName];
							$newFiles2 = [$this->SplashImg->htmlDecode($rsnew['SplashImg'])];
							$newFileCount = count($newFiles);
							for ($i = 0; $i < $newFileCount; $i++) {
								if ($newFiles[$i] != "") {
									$file = UploadTempPath($this->SplashImg, $this->SplashImg->Upload->Index) . $newFiles[$i];
									if (file_exists($file)) {
										if (@$newFiles2[$i] != "") // Use correct file name
											$newFiles[$i] = $newFiles2[$i];
										if (!$this->SplashImg->Upload->SaveToFile($newFiles[$i], TRUE, $i)) { // Just replace
											$this->setFailureMessage($Language->phrase("UploadErrMsg7"));
											return FALSE;
										}
									}
								}
							}
						} else {
							$newFiles = [];
						}
						if (Config("DELETE_UPLOADED_FILES")) {
							foreach ($oldFiles as $oldFile) {
								if ($oldFile != "" && !in_array($oldFile, $newFiles))
									@unlink($this->SplashImg->oldPhysicalUploadPath() . $oldFile);
							}
						}
					}
					if ($this->LogoSize1->Visible && !$this->LogoSize1->Upload->KeepFile) {
						$oldFiles = EmptyValue($this->LogoSize1->Upload->DbValue) ? [] : [$this->LogoSize1->htmlDecode($this->LogoSize1->Upload->DbValue)];
						if (!EmptyValue($this->LogoSize1->Upload->FileName)) {
							$newFiles = [$this->LogoSize1->Upload->FileName];
							$newFiles2 = [$this->LogoSize1->htmlDecode($rsnew['LogoSize1'])];
							$newFileCount = count($newFiles);
							for ($i = 0; $i < $newFileCount; $i++) {
								if ($newFiles[$i] != "") {
									$file = UploadTempPath($this->LogoSize1, $this->LogoSize1->Upload->Index) . $newFiles[$i];
									if (file_exists($file)) {
										if (@$newFiles2[$i] != "") // Use correct file name
											$newFiles[$i] = $newFiles2[$i];
										if (!$this->LogoSize1->Upload->SaveToFile($newFiles[$i], TRUE, $i)) { // Just replace
											$this->setFailureMessage($Language->phrase("UploadErrMsg7"));
											return FALSE;
										}
									}
								}
							}
						} else {
							$newFiles = [];
						}
						if (Config("DELETE_UPLOADED_FILES")) {
							foreach ($oldFiles as $oldFile) {
								if ($oldFile != "" && !in_array($oldFile, $newFiles))
									@unlink($this->LogoSize1->oldPhysicalUploadPath() . $oldFile);
							}
						}
					}
					if ($this->LogoSize2->Visible && !$this->LogoSize2->Upload->KeepFile) {
						$oldFiles = EmptyValue($this->LogoSize2->Upload->DbValue) ? [] : [$this->LogoSize2->htmlDecode($this->LogoSize2->Upload->DbValue)];
						if (!EmptyValue($this->LogoSize2->Upload->FileName)) {
							$newFiles = [$this->LogoSize2->Upload->FileName];
							$newFiles2 = [$this->LogoSize2->htmlDecode($rsnew['LogoSize2'])];
							$newFileCount = count($newFiles);
							for ($i = 0; $i < $newFileCount; $i++) {
								if ($newFiles[$i] != "") {
									$file = UploadTempPath($this->LogoSize2, $this->LogoSize2->Upload->Index) . $newFiles[$i];
									if (file_exists($file)) {
										if (@$newFiles2[$i] != "") // Use correct file name
											$newFiles[$i] = $newFiles2[$i];
										if (!$this->LogoSize2->Upload->SaveToFile($newFiles[$i], TRUE, $i)) { // Just replace
											$this->setFailureMessage($Language->phrase("UploadErrMsg7"));
											return FALSE;
										}
									}
								}
							}
						} else {
							$newFiles = [];
						}
						if (Config("DELETE_UPLOADED_FILES")) {
							foreach ($oldFiles as $oldFile) {
								if ($oldFile != "" && !in_array($oldFile, $newFiles))
									@unlink($this->LogoSize2->oldPhysicalUploadPath() . $oldFile);
							}
						}
					}
					if ($this->AppCSS->Visible && !$this->AppCSS->Upload->KeepFile) {
						$oldFiles = EmptyValue($this->AppCSS->Upload->DbValue) ? [] : [$this->AppCSS->htmlDecode($this->AppCSS->Upload->DbValue)];
						if (!EmptyValue($this->AppCSS->Upload->FileName)) {
							$newFiles = [$this->AppCSS->Upload->FileName];
							$newFiles2 = [$this->AppCSS->htmlDecode($rsnew['AppCSS'])];
							$newFileCount = count($newFiles);
							for ($i = 0; $i < $newFileCount; $i++) {
								if ($newFiles[$i] != "") {
									$file = UploadTempPath($this->AppCSS, $this->AppCSS->Upload->Index) . $newFiles[$i];
									if (file_exists($file)) {
										if (@$newFiles2[$i] != "") // Use correct file name
											$newFiles[$i] = $newFiles2[$i];
										if (!$this->AppCSS->Upload->SaveToFile($newFiles[$i], TRUE, $i)) { // Just replace
											$this->setFailureMessage($Language->phrase("UploadErrMsg7"));
											return FALSE;
										}
									}
								}
							}
						} else {
							$newFiles = [];
						}
						if (Config("DELETE_UPLOADED_FILES")) {
							foreach ($oldFiles as $oldFile) {
								if ($oldFile != "" && !in_array($oldFile, $newFiles))
									@unlink($this->AppCSS->oldPhysicalUploadPath() . $oldFile);
							}
						}
					}
					if ($this->SplashVideo->Visible && !$this->SplashVideo->Upload->KeepFile) {
						$oldFiles = EmptyValue($this->SplashVideo->Upload->DbValue) ? [] : [$this->SplashVideo->htmlDecode($this->SplashVideo->Upload->DbValue)];
						if (!EmptyValue($this->SplashVideo->Upload->FileName)) {
							$newFiles = [$this->SplashVideo->Upload->FileName];
							$newFiles2 = [$this->SplashVideo->htmlDecode($rsnew['SplashVideo'])];
							$newFileCount = count($newFiles);
							for ($i = 0; $i < $newFileCount; $i++) {
								if ($newFiles[$i] != "") {
									$file = UploadTempPath($this->SplashVideo, $this->SplashVideo->Upload->Index) . $newFiles[$i];
									if (file_exists($file)) {
										if (@$newFiles2[$i] != "") // Use correct file name
											$newFiles[$i] = $newFiles2[$i];
										if (!$this->SplashVideo->Upload->SaveToFile($newFiles[$i], TRUE, $i)) { // Just replace
											$this->setFailureMessage($Language->phrase("UploadErrMsg7"));
											return FALSE;
										}
									}
								}
							}
						} else {
							$newFiles = [];
						}
						if (Config("DELETE_UPLOADED_FILES")) {
							foreach ($oldFiles as $oldFile) {
								if ($oldFile != "" && !in_array($oldFile, $newFiles))
									@unlink($this->SplashVideo->oldPhysicalUploadPath() . $oldFile);
							}
						}
					}
				}

				// Update detail records
				$detailTblVar = explode(",", $this->getCurrentDetailTable());
				if ($editRow) {
					if (in_array("Client", $detailTblVar) && $GLOBALS["Client"]->DetailEdit) {
						if (!isset($GLOBALS["Client_grid"]))
							$GLOBALS["Client_grid"] = new Client_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "Client"); // Load user level of detail table
						$editRow = $GLOBALS["Client_grid"]->gridUpdate();
						$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}
				if ($editRow) {
					if (in_array("Categorias", $detailTblVar) && $GLOBALS["Categorias"]->DetailEdit) {
						if (!isset($GLOBALS["Categorias_grid"]))
							$GLOBALS["Categorias_grid"] = new Categorias_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "Categorias"); // Load user level of detail table
						$editRow = $GLOBALS["Categorias_grid"]->gridUpdate();
						$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}
				if ($editRow) {
					if (in_array("_Table", $detailTblVar) && $GLOBALS["_Table"]->DetailEdit) {
						if (!isset($GLOBALS["_Table_grid"]))
							$GLOBALS["_Table_grid"] = new _Table_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "Table"); // Load user level of detail table
						$editRow = $GLOBALS["_Table_grid"]->gridUpdate();
						$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}

				// Commit/Rollback transaction
				if ($this->getCurrentDetailTable() != "") {
					if ($editRow) {
						$conn->commitTrans(); // Commit transaction
					} else {
						$conn->rollbackTrans(); // Rollback transaction
					}
				}
			} else {
				if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage != "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->phrase("UpdateCancelled"));
				}
				$editRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($editRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->close();

		// Clean upload path if any
		if ($editRow) {

			// SplashImg
			CleanUploadTempPath($this->SplashImg, $this->SplashImg->Upload->Index);

			// LogoSize1
			CleanUploadTempPath($this->LogoSize1, $this->LogoSize1->Upload->Index);

			// LogoSize2
			CleanUploadTempPath($this->LogoSize2, $this->LogoSize2->Upload->Index);

			// AppCSS
			CleanUploadTempPath($this->AppCSS, $this->AppCSS->Upload->Index);

			// SplashVideo
			CleanUploadTempPath($this->SplashVideo, $this->SplashVideo->Upload->Index);
		}

		// Write JSON for API request
		if (IsApi() && $editRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $editRow;
	}

	// Show link optionally based on User ID
	protected function showOptionLink($id = "")
	{
		global $Security;
		if ($Security->isLoggedIn() && !$Security->isAdmin() && !$this->userIDAllow($id))
			return $Security->isValidUserID($this->ID->CurrentValue);
		return TRUE;
	}

	// Set up detail parms based on QueryString
	protected function setupDetailParms()
	{

		// Get the keys for master table
		$detailTblVar = Get(Config("TABLE_SHOW_DETAIL"));
		if ($detailTblVar !== NULL) {
			$this->setCurrentDetailTable($detailTblVar);
		} else {
			$detailTblVar = $this->getCurrentDetailTable();
		}
		if ($detailTblVar != "") {
			$detailTblVar = explode(",", $detailTblVar);
			if (in_array("Client", $detailTblVar)) {
				if (!isset($GLOBALS["Client_grid"]))
					$GLOBALS["Client_grid"] = new Client_grid();
				if ($GLOBALS["Client_grid"]->DetailEdit) {
					$GLOBALS["Client_grid"]->CurrentMode = "edit";
					$GLOBALS["Client_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["Client_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["Client_grid"]->setStartRecordNumber(1);
					$GLOBALS["Client_grid"]->ID_Restaurant->IsDetailKey = TRUE;
					$GLOBALS["Client_grid"]->ID_Restaurant->CurrentValue = $this->ID->CurrentValue;
					$GLOBALS["Client_grid"]->ID_Restaurant->setSessionValue($GLOBALS["Client_grid"]->ID_Restaurant->CurrentValue);
				}
			}
			if (in_array("Categorias", $detailTblVar)) {
				if (!isset($GLOBALS["Categorias_grid"]))
					$GLOBALS["Categorias_grid"] = new Categorias_grid();
				if ($GLOBALS["Categorias_grid"]->DetailEdit) {
					$GLOBALS["Categorias_grid"]->CurrentMode = "edit";
					$GLOBALS["Categorias_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["Categorias_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["Categorias_grid"]->setStartRecordNumber(1);
					$GLOBALS["Categorias_grid"]->ID_Restaurant->IsDetailKey = TRUE;
					$GLOBALS["Categorias_grid"]->ID_Restaurant->CurrentValue = $this->ID->CurrentValue;
					$GLOBALS["Categorias_grid"]->ID_Restaurant->setSessionValue($GLOBALS["Categorias_grid"]->ID_Restaurant->CurrentValue);
				}
			}
			if (in_array("_Table", $detailTblVar)) {
				if (!isset($GLOBALS["_Table_grid"]))
					$GLOBALS["_Table_grid"] = new _Table_grid();
				if ($GLOBALS["_Table_grid"]->DetailEdit) {
					$GLOBALS["_Table_grid"]->CurrentMode = "edit";
					$GLOBALS["_Table_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["_Table_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["_Table_grid"]->setStartRecordNumber(1);
					$GLOBALS["_Table_grid"]->ID_Restaurant->IsDetailKey = TRUE;
					$GLOBALS["_Table_grid"]->ID_Restaurant->CurrentValue = $this->ID->CurrentValue;
					$GLOBALS["_Table_grid"]->ID_Restaurant->setSessionValue($GLOBALS["_Table_grid"]->ID_Restaurant->CurrentValue);
				}
			}
		}
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("Restaurantlist.php"), "", $this->TableVar, TRUE);
		$pageId = "edit";
		$Breadcrumb->add("edit", $pageId, $url);
	}

	// Setup lookup options
	public function setupLookupOptions($fld)
	{
		if ($fld->Lookup !== NULL && $fld->Lookup->Options === NULL) {

			// Get default connection and filter
			$conn = $this->getConnection();
			$lookupFilter = "";

			// No need to check any more
			$fld->Lookup->Options = [];

			// Set up lookup SQL and connection
			switch ($fld->FieldVar) {
				case "x_Deactivated":
					break;
				case "x_Suspended":
					break;
				default:
					$lookupFilter = "";
					break;
			}

			// Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
			$sql = $fld->Lookup->getSql(FALSE, "", $lookupFilter, $this);

			// Set up lookup cache
			if ($fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
				$totalCnt = $this->getRecordCount($sql, $conn);
				if ($totalCnt > $fld->LookupCacheCount) // Total count > cache count, do not cache
					return;
				$rs = $conn->execute($sql);
				$ar = [];
				while ($rs && !$rs->EOF) {
					$row = &$rs->fields;

					// Format the field values
					switch ($fld->FieldVar) {
					}
					$ar[strval($row[0])] = $row;
					$rs->moveNext();
				}
				if ($rs)
					$rs->close();
				$fld->Lookup->Options = $ar;
			}
		}
	}

	// Set up starting record parameters
	public function setupStartRecord()
	{
		if ($this->DisplayRecords == 0)
			return;
		if ($this->isPageRequest()) { // Validate request
			$startRec = Get(Config("TABLE_START_REC"));
			$pageNo = Get(Config("TABLE_PAGE_NO"));
			if ($pageNo !== NULL) { // Check for "pageno" parameter first
				if (is_numeric($pageNo)) {
					$this->StartRecord = ($pageNo - 1) * $this->DisplayRecords + 1;
					if ($this->StartRecord <= 0) {
						$this->StartRecord = 1;
					} elseif ($this->StartRecord >= (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1) {
						$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1;
					}
					$this->setStartRecordNumber($this->StartRecord);
				}
			} elseif ($startRec !== NULL) { // Check for "start" parameter
				$this->StartRecord = $startRec;
				$this->setStartRecordNumber($this->StartRecord);
			}
		}
		$this->StartRecord = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRecord) || $this->StartRecord == "") { // Avoid invalid start record counter
			$this->StartRecord = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRecord);
		} elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
			$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRecord);
		} elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
			$this->StartRecord = (int)(($this->StartRecord - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRecord);
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}
} // End class
?>