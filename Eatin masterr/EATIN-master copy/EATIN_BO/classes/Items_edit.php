<?php
namespace PHPMaker2020\EATIN_BO;

/**
 * Page class
 */
class Items_edit extends Items
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{CC19BE4C-23D6-4992-89EF-6304995797F2}";

	// Table name
	public $TableName = 'Items';

	// Page object name
	public $PageObjName = "Items_edit";

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

		// Table object (Items)
		if (!isset($GLOBALS["Items"]) || get_class($GLOBALS["Items"]) == PROJECT_NAMESPACE . "Items") {
			$GLOBALS["Items"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["Items"];
		}

		// Table object (Categorias)
		if (!isset($GLOBALS['Categorias']))
			$GLOBALS['Categorias'] = new Categorias();

		// Table object (Restaurant)
		if (!isset($GLOBALS['Restaurant']))
			$GLOBALS['Restaurant'] = new Restaurant();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'Items');

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
		global $Items;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($Items);
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
					if ($pageName == "Itemsview.php")
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
					$this->terminate(GetUrl("Itemslist.php"));
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
					$this->terminate(GetUrl("Itemslist.php"));
					return;
				}
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->ID->setVisibility();
		$this->ID_Categorias->setVisibility();
		$this->ID_Restaurant->setVisibility();
		$this->DateCreation->Visible = FALSE;
		$this->DateLastUpdate->Visible = FALSE;
		$this->Nombre->setVisibility();
		$this->Precio->setVisibility();
		$this->Active->setVisibility();
		$this->Stock->setVisibility();
		$this->Img1->setVisibility();
		$this->Img2->setVisibility();
		$this->Img3->setVisibility();
		$this->Img4->setVisibility();
		$this->Vid1->setVisibility();
		$this->Vid2->setVisibility();
		$this->Descripcion->setVisibility();
		$this->NombreEN->setVisibility();
		$this->DescripcionEN->setVisibility();
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
		$this->setupLookupOptions($this->ID_Categorias);
		$this->setupLookupOptions($this->ID_Restaurant);

		// Check permission
		if (!$Security->canEdit()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("Itemslist.php");
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

			// Set up master detail parameters
			$this->setupMasterParms();

			// Load current record
			$loaded = $this->loadRow();
		}

		// Process form if post back
		if ($postBack) {
			$this->loadFormValues(); // Get form values
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
					$this->terminate("Itemslist.php"); // No matching record, return to list
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "Itemslist.php")
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
		$this->Img1->Upload->Index = $CurrentForm->Index;
		$this->Img1->Upload->uploadFile();
		$this->Img1->CurrentValue = $this->Img1->Upload->FileName;
		$this->Img2->Upload->Index = $CurrentForm->Index;
		$this->Img2->Upload->uploadFile();
		$this->Img2->CurrentValue = $this->Img2->Upload->FileName;
		$this->Img3->Upload->Index = $CurrentForm->Index;
		$this->Img3->Upload->uploadFile();
		$this->Img3->CurrentValue = $this->Img3->Upload->FileName;
		$this->Img4->Upload->Index = $CurrentForm->Index;
		$this->Img4->Upload->uploadFile();
		$this->Img4->CurrentValue = $this->Img4->Upload->FileName;
		$this->Vid1->Upload->Index = $CurrentForm->Index;
		$this->Vid1->Upload->uploadFile();
		$this->Vid1->CurrentValue = $this->Vid1->Upload->FileName;
		$this->Vid2->Upload->Index = $CurrentForm->Index;
		$this->Vid2->Upload->uploadFile();
		$this->Vid2->CurrentValue = $this->Vid2->Upload->FileName;
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

		// Check field name 'ID_Categorias' first before field var 'x_ID_Categorias'
		$val = $CurrentForm->hasValue("ID_Categorias") ? $CurrentForm->getValue("ID_Categorias") : $CurrentForm->getValue("x_ID_Categorias");
		if (!$this->ID_Categorias->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ID_Categorias->Visible = FALSE; // Disable update for API request
			else
				$this->ID_Categorias->setFormValue($val);
		}

		// Check field name 'ID_Restaurant' first before field var 'x_ID_Restaurant'
		$val = $CurrentForm->hasValue("ID_Restaurant") ? $CurrentForm->getValue("ID_Restaurant") : $CurrentForm->getValue("x_ID_Restaurant");
		if (!$this->ID_Restaurant->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ID_Restaurant->Visible = FALSE; // Disable update for API request
			else
				$this->ID_Restaurant->setFormValue($val);
		}

		// Check field name 'Nombre' first before field var 'x_Nombre'
		$val = $CurrentForm->hasValue("Nombre") ? $CurrentForm->getValue("Nombre") : $CurrentForm->getValue("x_Nombre");
		if (!$this->Nombre->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Nombre->Visible = FALSE; // Disable update for API request
			else
				$this->Nombre->setFormValue($val);
		}

		// Check field name 'Precio' first before field var 'x_Precio'
		$val = $CurrentForm->hasValue("Precio") ? $CurrentForm->getValue("Precio") : $CurrentForm->getValue("x_Precio");
		if (!$this->Precio->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Precio->Visible = FALSE; // Disable update for API request
			else
				$this->Precio->setFormValue($val);
		}

		// Check field name 'Active' first before field var 'x_Active'
		$val = $CurrentForm->hasValue("Active") ? $CurrentForm->getValue("Active") : $CurrentForm->getValue("x_Active");
		if (!$this->Active->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Active->Visible = FALSE; // Disable update for API request
			else
				$this->Active->setFormValue($val);
		}

		// Check field name 'Stock' first before field var 'x_Stock'
		$val = $CurrentForm->hasValue("Stock") ? $CurrentForm->getValue("Stock") : $CurrentForm->getValue("x_Stock");
		if (!$this->Stock->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Stock->Visible = FALSE; // Disable update for API request
			else
				$this->Stock->setFormValue($val);
		}

		// Check field name 'Descripcion' first before field var 'x_Descripcion'
		$val = $CurrentForm->hasValue("Descripcion") ? $CurrentForm->getValue("Descripcion") : $CurrentForm->getValue("x_Descripcion");
		if (!$this->Descripcion->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Descripcion->Visible = FALSE; // Disable update for API request
			else
				$this->Descripcion->setFormValue($val);
		}

		// Check field name 'NombreEN' first before field var 'x_NombreEN'
		$val = $CurrentForm->hasValue("NombreEN") ? $CurrentForm->getValue("NombreEN") : $CurrentForm->getValue("x_NombreEN");
		if (!$this->NombreEN->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->NombreEN->Visible = FALSE; // Disable update for API request
			else
				$this->NombreEN->setFormValue($val);
		}

		// Check field name 'DescripcionEN' first before field var 'x_DescripcionEN'
		$val = $CurrentForm->hasValue("DescripcionEN") ? $CurrentForm->getValue("DescripcionEN") : $CurrentForm->getValue("x_DescripcionEN");
		if (!$this->DescripcionEN->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->DescripcionEN->Visible = FALSE; // Disable update for API request
			else
				$this->DescripcionEN->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->ID->CurrentValue = $this->ID->FormValue;
		$this->ID_Categorias->CurrentValue = $this->ID_Categorias->FormValue;
		$this->ID_Restaurant->CurrentValue = $this->ID_Restaurant->FormValue;
		$this->Nombre->CurrentValue = $this->Nombre->FormValue;
		$this->Precio->CurrentValue = $this->Precio->FormValue;
		$this->Active->CurrentValue = $this->Active->FormValue;
		$this->Stock->CurrentValue = $this->Stock->FormValue;
		$this->Descripcion->CurrentValue = $this->Descripcion->FormValue;
		$this->NombreEN->CurrentValue = $this->NombreEN->FormValue;
		$this->DescripcionEN->CurrentValue = $this->DescripcionEN->FormValue;
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
		$this->ID_Categorias->setDbValue($row['ID_Categorias']);
		$this->ID_Restaurant->setDbValue($row['ID_Restaurant']);
		$this->DateCreation->setDbValue($row['DateCreation']);
		$this->DateLastUpdate->setDbValue($row['DateLastUpdate']);
		$this->Nombre->setDbValue($row['Nombre']);
		$this->Precio->setDbValue($row['Precio']);
		$this->Active->setDbValue($row['Active']);
		$this->Stock->setDbValue($row['Stock']);
		$this->Img1->Upload->DbValue = $row['Img1'];
		$this->Img1->setDbValue($this->Img1->Upload->DbValue);
		$this->Img2->Upload->DbValue = $row['Img2'];
		$this->Img2->setDbValue($this->Img2->Upload->DbValue);
		$this->Img3->Upload->DbValue = $row['Img3'];
		$this->Img3->setDbValue($this->Img3->Upload->DbValue);
		$this->Img4->Upload->DbValue = $row['Img4'];
		$this->Img4->setDbValue($this->Img4->Upload->DbValue);
		$this->Vid1->Upload->DbValue = $row['Vid1'];
		$this->Vid1->setDbValue($this->Vid1->Upload->DbValue);
		$this->Vid2->Upload->DbValue = $row['Vid2'];
		$this->Vid2->setDbValue($this->Vid2->Upload->DbValue);
		$this->Descripcion->setDbValue($row['Descripcion']);
		$this->NombreEN->setDbValue($row['NombreEN']);
		$this->DescripcionEN->setDbValue($row['DescripcionEN']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['ID'] = NULL;
		$row['ID_Categorias'] = NULL;
		$row['ID_Restaurant'] = NULL;
		$row['DateCreation'] = NULL;
		$row['DateLastUpdate'] = NULL;
		$row['Nombre'] = NULL;
		$row['Precio'] = NULL;
		$row['Active'] = NULL;
		$row['Stock'] = NULL;
		$row['Img1'] = NULL;
		$row['Img2'] = NULL;
		$row['Img3'] = NULL;
		$row['Img4'] = NULL;
		$row['Vid1'] = NULL;
		$row['Vid2'] = NULL;
		$row['Descripcion'] = NULL;
		$row['NombreEN'] = NULL;
		$row['DescripcionEN'] = NULL;
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

		if ($this->Precio->FormValue == $this->Precio->CurrentValue && is_numeric(ConvertToFloatString($this->Precio->CurrentValue)))
			$this->Precio->CurrentValue = ConvertToFloatString($this->Precio->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// ID
		// ID_Categorias
		// ID_Restaurant
		// DateCreation
		// DateLastUpdate
		// Nombre
		// Precio
		// Active
		// Stock
		// Img1
		// Img2
		// Img3
		// Img4
		// Vid1
		// Vid2
		// Descripcion
		// NombreEN
		// DescripcionEN

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// ID
			$this->ID->ViewValue = $this->ID->CurrentValue;
			$this->ID->ViewValue = FormatNumber($this->ID->ViewValue, 0, -2, -2, -2);
			$this->ID->ViewCustomAttributes = "";

			// ID_Categorias
			$curVal = strval($this->ID_Categorias->CurrentValue);
			if ($curVal != "") {
				$this->ID_Categorias->ViewValue = $this->ID_Categorias->lookupCacheOption($curVal);
				if ($this->ID_Categorias->ViewValue === NULL) { // Lookup from database
					$filterWrk = "[ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ID_Categorias->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ID_Categorias->ViewValue = $this->ID_Categorias->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ID_Categorias->ViewValue = $this->ID_Categorias->CurrentValue;
					}
				}
			} else {
				$this->ID_Categorias->ViewValue = NULL;
			}
			$this->ID_Categorias->ViewCustomAttributes = "";

			// ID_Restaurant
			$curVal = strval($this->ID_Restaurant->CurrentValue);
			if ($curVal != "") {
				$this->ID_Restaurant->ViewValue = $this->ID_Restaurant->lookupCacheOption($curVal);
				if ($this->ID_Restaurant->ViewValue === NULL) { // Lookup from database
					$filterWrk = "[ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ID_Restaurant->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ID_Restaurant->ViewValue = $this->ID_Restaurant->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ID_Restaurant->ViewValue = $this->ID_Restaurant->CurrentValue;
					}
				}
			} else {
				$this->ID_Restaurant->ViewValue = NULL;
			}
			$this->ID_Restaurant->ViewCustomAttributes = "";

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

			// Precio
			$this->Precio->ViewValue = $this->Precio->CurrentValue;
			$this->Precio->ViewValue = FormatNumber($this->Precio->ViewValue, 2, -2, -2, -2);
			$this->Precio->ViewCustomAttributes = "";

			// Active
			if (strval($this->Active->CurrentValue) != "") {
				$this->Active->ViewValue = $this->Active->optionCaption($this->Active->CurrentValue);
			} else {
				$this->Active->ViewValue = NULL;
			}
			$this->Active->ViewCustomAttributes = "";

			// Stock
			$this->Stock->ViewValue = $this->Stock->CurrentValue;
			$this->Stock->ViewValue = FormatNumber($this->Stock->ViewValue, 0, -2, -2, -2);
			$this->Stock->ViewCustomAttributes = "";

			// Img1
			if (!EmptyValue($this->Img1->Upload->DbValue)) {
				$this->Img1->ImageWidth = 0;
				$this->Img1->ImageHeight = 60;
				$this->Img1->ImageAlt = $this->Img1->alt();
				$this->Img1->ViewValue = $this->Img1->Upload->DbValue;
			} else {
				$this->Img1->ViewValue = "";
			}
			$this->Img1->ViewCustomAttributes = "";

			// Img2
			if (!EmptyValue($this->Img2->Upload->DbValue)) {
				$this->Img2->ImageWidth = 0;
				$this->Img2->ImageHeight = 60;
				$this->Img2->ImageAlt = $this->Img2->alt();
				$this->Img2->ViewValue = $this->Img2->Upload->DbValue;
			} else {
				$this->Img2->ViewValue = "";
			}
			$this->Img2->ViewCustomAttributes = "";

			// Img3
			if (!EmptyValue($this->Img3->Upload->DbValue)) {
				$this->Img3->ImageWidth = 0;
				$this->Img3->ImageHeight = 60;
				$this->Img3->ImageAlt = $this->Img3->alt();
				$this->Img3->ViewValue = $this->Img3->Upload->DbValue;
			} else {
				$this->Img3->ViewValue = "";
			}
			$this->Img3->ViewCustomAttributes = "";

			// Img4
			if (!EmptyValue($this->Img4->Upload->DbValue)) {
				$this->Img4->ImageWidth = 0;
				$this->Img4->ImageHeight = 60;
				$this->Img4->ImageAlt = $this->Img4->alt();
				$this->Img4->ViewValue = $this->Img4->Upload->DbValue;
			} else {
				$this->Img4->ViewValue = "";
			}
			$this->Img4->ViewCustomAttributes = "";

			// Vid1
			if (!EmptyValue($this->Vid1->Upload->DbValue)) {
				$this->Vid1->ViewValue = $this->Vid1->Upload->DbValue;
			} else {
				$this->Vid1->ViewValue = "";
			}
			$this->Vid1->ViewCustomAttributes = "";

			// Vid2
			if (!EmptyValue($this->Vid2->Upload->DbValue)) {
				$this->Vid2->ViewValue = $this->Vid2->Upload->DbValue;
			} else {
				$this->Vid2->ViewValue = "";
			}
			$this->Vid2->ViewCustomAttributes = "";

			// Descripcion
			$this->Descripcion->ViewValue = $this->Descripcion->CurrentValue;
			$this->Descripcion->ViewCustomAttributes = "";

			// NombreEN
			$this->NombreEN->ViewValue = $this->NombreEN->CurrentValue;
			$this->NombreEN->ViewCustomAttributes = "";

			// DescripcionEN
			$this->DescripcionEN->ViewValue = $this->DescripcionEN->CurrentValue;
			$this->DescripcionEN->ViewCustomAttributes = "";

			// ID
			$this->ID->LinkCustomAttributes = "";
			$this->ID->HrefValue = "";
			$this->ID->TooltipValue = "";

			// ID_Categorias
			$this->ID_Categorias->LinkCustomAttributes = "";
			$this->ID_Categorias->HrefValue = "";
			$this->ID_Categorias->TooltipValue = "";

			// ID_Restaurant
			$this->ID_Restaurant->LinkCustomAttributes = "";
			$this->ID_Restaurant->HrefValue = "";
			$this->ID_Restaurant->TooltipValue = "";

			// Nombre
			$this->Nombre->LinkCustomAttributes = "";
			$this->Nombre->HrefValue = "";
			$this->Nombre->TooltipValue = "";

			// Precio
			$this->Precio->LinkCustomAttributes = "";
			$this->Precio->HrefValue = "";
			$this->Precio->TooltipValue = "";

			// Active
			$this->Active->LinkCustomAttributes = "";
			$this->Active->HrefValue = "";
			$this->Active->TooltipValue = "";

			// Stock
			$this->Stock->LinkCustomAttributes = "";
			$this->Stock->HrefValue = "";
			$this->Stock->TooltipValue = "";

			// Img1
			$this->Img1->LinkCustomAttributes = "";
			if (!EmptyValue($this->Img1->Upload->DbValue)) {
				$this->Img1->HrefValue = GetFileUploadUrl($this->Img1, $this->Img1->htmlDecode($this->Img1->Upload->DbValue)); // Add prefix/suffix
				$this->Img1->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport())
					$this->Img1->HrefValue = FullUrl($this->Img1->HrefValue, "href");
			} else {
				$this->Img1->HrefValue = "";
			}
			$this->Img1->ExportHrefValue = $this->Img1->UploadPath . $this->Img1->Upload->DbValue;
			$this->Img1->TooltipValue = "";
			if ($this->Img1->UseColorbox) {
				if (EmptyValue($this->Img1->TooltipValue))
					$this->Img1->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
				$this->Img1->LinkAttrs["data-rel"] = "Items_x_Img1";
				$this->Img1->LinkAttrs->appendClass("ew-lightbox");
			}

			// Img2
			$this->Img2->LinkCustomAttributes = "";
			if (!EmptyValue($this->Img2->Upload->DbValue)) {
				$this->Img2->HrefValue = GetFileUploadUrl($this->Img2, $this->Img2->htmlDecode($this->Img2->Upload->DbValue)); // Add prefix/suffix
				$this->Img2->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport())
					$this->Img2->HrefValue = FullUrl($this->Img2->HrefValue, "href");
			} else {
				$this->Img2->HrefValue = "";
			}
			$this->Img2->ExportHrefValue = $this->Img2->UploadPath . $this->Img2->Upload->DbValue;
			$this->Img2->TooltipValue = "";
			if ($this->Img2->UseColorbox) {
				if (EmptyValue($this->Img2->TooltipValue))
					$this->Img2->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
				$this->Img2->LinkAttrs["data-rel"] = "Items_x_Img2";
				$this->Img2->LinkAttrs->appendClass("ew-lightbox");
			}

			// Img3
			$this->Img3->LinkCustomAttributes = "";
			if (!EmptyValue($this->Img3->Upload->DbValue)) {
				$this->Img3->HrefValue = GetFileUploadUrl($this->Img3, $this->Img3->htmlDecode($this->Img3->Upload->DbValue)); // Add prefix/suffix
				$this->Img3->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport())
					$this->Img3->HrefValue = FullUrl($this->Img3->HrefValue, "href");
			} else {
				$this->Img3->HrefValue = "";
			}
			$this->Img3->ExportHrefValue = $this->Img3->UploadPath . $this->Img3->Upload->DbValue;
			$this->Img3->TooltipValue = "";
			if ($this->Img3->UseColorbox) {
				if (EmptyValue($this->Img3->TooltipValue))
					$this->Img3->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
				$this->Img3->LinkAttrs["data-rel"] = "Items_x_Img3";
				$this->Img3->LinkAttrs->appendClass("ew-lightbox");
			}

			// Img4
			$this->Img4->LinkCustomAttributes = "";
			if (!EmptyValue($this->Img4->Upload->DbValue)) {
				$this->Img4->HrefValue = GetFileUploadUrl($this->Img4, $this->Img4->htmlDecode($this->Img4->Upload->DbValue)); // Add prefix/suffix
				$this->Img4->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport())
					$this->Img4->HrefValue = FullUrl($this->Img4->HrefValue, "href");
			} else {
				$this->Img4->HrefValue = "";
			}
			$this->Img4->ExportHrefValue = $this->Img4->UploadPath . $this->Img4->Upload->DbValue;
			$this->Img4->TooltipValue = "";
			if ($this->Img4->UseColorbox) {
				if (EmptyValue($this->Img4->TooltipValue))
					$this->Img4->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
				$this->Img4->LinkAttrs["data-rel"] = "Items_x_Img4";
				$this->Img4->LinkAttrs->appendClass("ew-lightbox");
			}

			// Vid1
			$this->Vid1->LinkCustomAttributes = "";
			$this->Vid1->HrefValue = "";
			$this->Vid1->ExportHrefValue = $this->Vid1->UploadPath . $this->Vid1->Upload->DbValue;
			$this->Vid1->TooltipValue = "";

			// Vid2
			$this->Vid2->LinkCustomAttributes = "";
			$this->Vid2->HrefValue = "";
			$this->Vid2->ExportHrefValue = $this->Vid2->UploadPath . $this->Vid2->Upload->DbValue;
			$this->Vid2->TooltipValue = "";

			// Descripcion
			$this->Descripcion->LinkCustomAttributes = "";
			$this->Descripcion->HrefValue = "";
			$this->Descripcion->TooltipValue = "";

			// NombreEN
			$this->NombreEN->LinkCustomAttributes = "";
			$this->NombreEN->HrefValue = "";
			$this->NombreEN->TooltipValue = "";

			// DescripcionEN
			$this->DescripcionEN->LinkCustomAttributes = "";
			$this->DescripcionEN->HrefValue = "";
			$this->DescripcionEN->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// ID
			$this->ID->EditAttrs["class"] = "form-control";
			$this->ID->EditCustomAttributes = "";
			$this->ID->EditValue = $this->ID->CurrentValue;
			$this->ID->EditValue = FormatNumber($this->ID->EditValue, 0, -2, -2, -2);
			$this->ID->ViewCustomAttributes = "";

			// ID_Categorias
			$this->ID_Categorias->EditAttrs["class"] = "form-control";
			$this->ID_Categorias->EditCustomAttributes = "";
			if ($this->ID_Categorias->getSessionValue() != "") {
				$this->ID_Categorias->CurrentValue = $this->ID_Categorias->getSessionValue();
				$curVal = strval($this->ID_Categorias->CurrentValue);
				if ($curVal != "") {
					$this->ID_Categorias->ViewValue = $this->ID_Categorias->lookupCacheOption($curVal);
					if ($this->ID_Categorias->ViewValue === NULL) { // Lookup from database
						$filterWrk = "[ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->ID_Categorias->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->ID_Categorias->ViewValue = $this->ID_Categorias->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->ID_Categorias->ViewValue = $this->ID_Categorias->CurrentValue;
						}
					}
				} else {
					$this->ID_Categorias->ViewValue = NULL;
				}
				$this->ID_Categorias->ViewCustomAttributes = "";
			} else {
				$curVal = trim(strval($this->ID_Categorias->CurrentValue));
				if ($curVal != "")
					$this->ID_Categorias->ViewValue = $this->ID_Categorias->lookupCacheOption($curVal);
				else
					$this->ID_Categorias->ViewValue = $this->ID_Categorias->Lookup !== NULL && is_array($this->ID_Categorias->Lookup->Options) ? $curVal : NULL;
				if ($this->ID_Categorias->ViewValue !== NULL) { // Load from cache
					$this->ID_Categorias->EditValue = array_values($this->ID_Categorias->Lookup->Options);
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "[ID]" . SearchString("=", $this->ID_Categorias->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->ID_Categorias->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->ID_Categorias->EditValue = $arwrk;
				}
			}

			// ID_Restaurant
			$this->ID_Restaurant->EditAttrs["class"] = "form-control";
			$this->ID_Restaurant->EditCustomAttributes = "";
			if (!$Security->isAdmin() && $Security->isLoggedIn() && !$this->userIDAllow("edit")) { // Non system admin
				$this->ID_Restaurant->CurrentValue = CurrentUserID();
				$curVal = strval($this->ID_Restaurant->CurrentValue);
				if ($curVal != "") {
					$this->ID_Restaurant->EditValue = $this->ID_Restaurant->lookupCacheOption($curVal);
					if ($this->ID_Restaurant->EditValue === NULL) { // Lookup from database
						$filterWrk = "[ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->ID_Restaurant->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->ID_Restaurant->EditValue = $this->ID_Restaurant->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->ID_Restaurant->EditValue = $this->ID_Restaurant->CurrentValue;
						}
					}
				} else {
					$this->ID_Restaurant->EditValue = NULL;
				}
				$this->ID_Restaurant->ViewCustomAttributes = "";
			} else {
				$curVal = trim(strval($this->ID_Restaurant->CurrentValue));
				if ($curVal != "")
					$this->ID_Restaurant->ViewValue = $this->ID_Restaurant->lookupCacheOption($curVal);
				else
					$this->ID_Restaurant->ViewValue = $this->ID_Restaurant->Lookup !== NULL && is_array($this->ID_Restaurant->Lookup->Options) ? $curVal : NULL;
				if ($this->ID_Restaurant->ViewValue !== NULL) { // Load from cache
					$this->ID_Restaurant->EditValue = array_values($this->ID_Restaurant->Lookup->Options);
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "[ID]" . SearchString("=", $this->ID_Restaurant->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->ID_Restaurant->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->ID_Restaurant->EditValue = $arwrk;
				}
			}

			// Nombre
			$this->Nombre->EditAttrs["class"] = "form-control";
			$this->Nombre->EditCustomAttributes = "";
			if (!$this->Nombre->Raw)
				$this->Nombre->CurrentValue = HtmlDecode($this->Nombre->CurrentValue);
			$this->Nombre->EditValue = HtmlEncode($this->Nombre->CurrentValue);
			$this->Nombre->PlaceHolder = RemoveHtml($this->Nombre->caption());

			// Precio
			$this->Precio->EditAttrs["class"] = "form-control";
			$this->Precio->EditCustomAttributes = "";
			$this->Precio->EditValue = HtmlEncode($this->Precio->CurrentValue);
			$this->Precio->PlaceHolder = RemoveHtml($this->Precio->caption());
			if (strval($this->Precio->EditValue) != "" && is_numeric($this->Precio->EditValue))
				$this->Precio->EditValue = FormatNumber($this->Precio->EditValue, -2, -2, -2, -2);
			

			// Active
			$this->Active->EditCustomAttributes = "";
			$this->Active->EditValue = $this->Active->options(FALSE);

			// Stock
			$this->Stock->EditAttrs["class"] = "form-control";
			$this->Stock->EditCustomAttributes = "";
			$this->Stock->EditValue = HtmlEncode($this->Stock->CurrentValue);
			$this->Stock->PlaceHolder = RemoveHtml($this->Stock->caption());

			// Img1
			$this->Img1->EditAttrs["class"] = "form-control";
			$this->Img1->EditCustomAttributes = "";
			if (!EmptyValue($this->Img1->Upload->DbValue)) {
				$this->Img1->ImageWidth = 0;
				$this->Img1->ImageHeight = 60;
				$this->Img1->ImageAlt = $this->Img1->alt();
				$this->Img1->EditValue = $this->Img1->Upload->DbValue;
			} else {
				$this->Img1->EditValue = "";
			}
			if (!EmptyValue($this->Img1->CurrentValue))
					$this->Img1->Upload->FileName = $this->Img1->CurrentValue;
			if ($this->isShow())
				RenderUploadField($this->Img1);

			// Img2
			$this->Img2->EditAttrs["class"] = "form-control";
			$this->Img2->EditCustomAttributes = "";
			if (!EmptyValue($this->Img2->Upload->DbValue)) {
				$this->Img2->ImageWidth = 0;
				$this->Img2->ImageHeight = 60;
				$this->Img2->ImageAlt = $this->Img2->alt();
				$this->Img2->EditValue = $this->Img2->Upload->DbValue;
			} else {
				$this->Img2->EditValue = "";
			}
			if (!EmptyValue($this->Img2->CurrentValue))
					$this->Img2->Upload->FileName = $this->Img2->CurrentValue;
			if ($this->isShow())
				RenderUploadField($this->Img2);

			// Img3
			$this->Img3->EditAttrs["class"] = "form-control";
			$this->Img3->EditCustomAttributes = "";
			if (!EmptyValue($this->Img3->Upload->DbValue)) {
				$this->Img3->ImageWidth = 0;
				$this->Img3->ImageHeight = 60;
				$this->Img3->ImageAlt = $this->Img3->alt();
				$this->Img3->EditValue = $this->Img3->Upload->DbValue;
			} else {
				$this->Img3->EditValue = "";
			}
			if (!EmptyValue($this->Img3->CurrentValue))
					$this->Img3->Upload->FileName = $this->Img3->CurrentValue;
			if ($this->isShow())
				RenderUploadField($this->Img3);

			// Img4
			$this->Img4->EditAttrs["class"] = "form-control";
			$this->Img4->EditCustomAttributes = "";
			if (!EmptyValue($this->Img4->Upload->DbValue)) {
				$this->Img4->ImageWidth = 0;
				$this->Img4->ImageHeight = 60;
				$this->Img4->ImageAlt = $this->Img4->alt();
				$this->Img4->EditValue = $this->Img4->Upload->DbValue;
			} else {
				$this->Img4->EditValue = "";
			}
			if (!EmptyValue($this->Img4->CurrentValue))
					$this->Img4->Upload->FileName = $this->Img4->CurrentValue;
			if ($this->isShow())
				RenderUploadField($this->Img4);

			// Vid1
			$this->Vid1->EditAttrs["class"] = "form-control";
			$this->Vid1->EditCustomAttributes = "";
			if (!EmptyValue($this->Vid1->Upload->DbValue)) {
				$this->Vid1->EditValue = $this->Vid1->Upload->DbValue;
			} else {
				$this->Vid1->EditValue = "";
			}
			if (!EmptyValue($this->Vid1->CurrentValue))
					$this->Vid1->Upload->FileName = $this->Vid1->CurrentValue;
			if ($this->isShow())
				RenderUploadField($this->Vid1);

			// Vid2
			$this->Vid2->EditAttrs["class"] = "form-control";
			$this->Vid2->EditCustomAttributes = "";
			if (!EmptyValue($this->Vid2->Upload->DbValue)) {
				$this->Vid2->EditValue = $this->Vid2->Upload->DbValue;
			} else {
				$this->Vid2->EditValue = "";
			}
			if (!EmptyValue($this->Vid2->CurrentValue))
					$this->Vid2->Upload->FileName = $this->Vid2->CurrentValue;
			if ($this->isShow())
				RenderUploadField($this->Vid2);

			// Descripcion
			$this->Descripcion->EditAttrs["class"] = "form-control";
			$this->Descripcion->EditCustomAttributes = "";
			if (!$this->Descripcion->Raw)
				$this->Descripcion->CurrentValue = HtmlDecode($this->Descripcion->CurrentValue);
			$this->Descripcion->EditValue = HtmlEncode($this->Descripcion->CurrentValue);
			$this->Descripcion->PlaceHolder = RemoveHtml($this->Descripcion->caption());

			// NombreEN
			$this->NombreEN->EditAttrs["class"] = "form-control";
			$this->NombreEN->EditCustomAttributes = "";
			if (!$this->NombreEN->Raw)
				$this->NombreEN->CurrentValue = HtmlDecode($this->NombreEN->CurrentValue);
			$this->NombreEN->EditValue = HtmlEncode($this->NombreEN->CurrentValue);
			$this->NombreEN->PlaceHolder = RemoveHtml($this->NombreEN->caption());

			// DescripcionEN
			$this->DescripcionEN->EditAttrs["class"] = "form-control";
			$this->DescripcionEN->EditCustomAttributes = "";
			if (!$this->DescripcionEN->Raw)
				$this->DescripcionEN->CurrentValue = HtmlDecode($this->DescripcionEN->CurrentValue);
			$this->DescripcionEN->EditValue = HtmlEncode($this->DescripcionEN->CurrentValue);
			$this->DescripcionEN->PlaceHolder = RemoveHtml($this->DescripcionEN->caption());

			// Edit refer script
			// ID

			$this->ID->LinkCustomAttributes = "";
			$this->ID->HrefValue = "";

			// ID_Categorias
			$this->ID_Categorias->LinkCustomAttributes = "";
			$this->ID_Categorias->HrefValue = "";

			// ID_Restaurant
			$this->ID_Restaurant->LinkCustomAttributes = "";
			$this->ID_Restaurant->HrefValue = "";

			// Nombre
			$this->Nombre->LinkCustomAttributes = "";
			$this->Nombre->HrefValue = "";

			// Precio
			$this->Precio->LinkCustomAttributes = "";
			$this->Precio->HrefValue = "";

			// Active
			$this->Active->LinkCustomAttributes = "";
			$this->Active->HrefValue = "";

			// Stock
			$this->Stock->LinkCustomAttributes = "";
			$this->Stock->HrefValue = "";

			// Img1
			$this->Img1->LinkCustomAttributes = "";
			if (!EmptyValue($this->Img1->Upload->DbValue)) {
				$this->Img1->HrefValue = GetFileUploadUrl($this->Img1, $this->Img1->htmlDecode($this->Img1->Upload->DbValue)); // Add prefix/suffix
				$this->Img1->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport())
					$this->Img1->HrefValue = FullUrl($this->Img1->HrefValue, "href");
			} else {
				$this->Img1->HrefValue = "";
			}
			$this->Img1->ExportHrefValue = $this->Img1->UploadPath . $this->Img1->Upload->DbValue;

			// Img2
			$this->Img2->LinkCustomAttributes = "";
			if (!EmptyValue($this->Img2->Upload->DbValue)) {
				$this->Img2->HrefValue = GetFileUploadUrl($this->Img2, $this->Img2->htmlDecode($this->Img2->Upload->DbValue)); // Add prefix/suffix
				$this->Img2->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport())
					$this->Img2->HrefValue = FullUrl($this->Img2->HrefValue, "href");
			} else {
				$this->Img2->HrefValue = "";
			}
			$this->Img2->ExportHrefValue = $this->Img2->UploadPath . $this->Img2->Upload->DbValue;

			// Img3
			$this->Img3->LinkCustomAttributes = "";
			if (!EmptyValue($this->Img3->Upload->DbValue)) {
				$this->Img3->HrefValue = GetFileUploadUrl($this->Img3, $this->Img3->htmlDecode($this->Img3->Upload->DbValue)); // Add prefix/suffix
				$this->Img3->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport())
					$this->Img3->HrefValue = FullUrl($this->Img3->HrefValue, "href");
			} else {
				$this->Img3->HrefValue = "";
			}
			$this->Img3->ExportHrefValue = $this->Img3->UploadPath . $this->Img3->Upload->DbValue;

			// Img4
			$this->Img4->LinkCustomAttributes = "";
			if (!EmptyValue($this->Img4->Upload->DbValue)) {
				$this->Img4->HrefValue = GetFileUploadUrl($this->Img4, $this->Img4->htmlDecode($this->Img4->Upload->DbValue)); // Add prefix/suffix
				$this->Img4->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport())
					$this->Img4->HrefValue = FullUrl($this->Img4->HrefValue, "href");
			} else {
				$this->Img4->HrefValue = "";
			}
			$this->Img4->ExportHrefValue = $this->Img4->UploadPath . $this->Img4->Upload->DbValue;

			// Vid1
			$this->Vid1->LinkCustomAttributes = "";
			$this->Vid1->HrefValue = "";
			$this->Vid1->ExportHrefValue = $this->Vid1->UploadPath . $this->Vid1->Upload->DbValue;

			// Vid2
			$this->Vid2->LinkCustomAttributes = "";
			$this->Vid2->HrefValue = "";
			$this->Vid2->ExportHrefValue = $this->Vid2->UploadPath . $this->Vid2->Upload->DbValue;

			// Descripcion
			$this->Descripcion->LinkCustomAttributes = "";
			$this->Descripcion->HrefValue = "";

			// NombreEN
			$this->NombreEN->LinkCustomAttributes = "";
			$this->NombreEN->HrefValue = "";

			// DescripcionEN
			$this->DescripcionEN->LinkCustomAttributes = "";
			$this->DescripcionEN->HrefValue = "";
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
		if ($this->ID_Categorias->Required) {
			if (!$this->ID_Categorias->IsDetailKey && $this->ID_Categorias->FormValue != NULL && $this->ID_Categorias->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ID_Categorias->caption(), $this->ID_Categorias->RequiredErrorMessage));
			}
		}
		if ($this->ID_Restaurant->Required) {
			if (!$this->ID_Restaurant->IsDetailKey && $this->ID_Restaurant->FormValue != NULL && $this->ID_Restaurant->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ID_Restaurant->caption(), $this->ID_Restaurant->RequiredErrorMessage));
			}
		}
		if ($this->Nombre->Required) {
			if (!$this->Nombre->IsDetailKey && $this->Nombre->FormValue != NULL && $this->Nombre->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Nombre->caption(), $this->Nombre->RequiredErrorMessage));
			}
		}
		if ($this->Precio->Required) {
			if (!$this->Precio->IsDetailKey && $this->Precio->FormValue != NULL && $this->Precio->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Precio->caption(), $this->Precio->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->Precio->FormValue)) {
			AddMessage($FormError, $this->Precio->errorMessage());
		}
		if ($this->Active->Required) {
			if ($this->Active->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Active->caption(), $this->Active->RequiredErrorMessage));
			}
		}
		if ($this->Stock->Required) {
			if (!$this->Stock->IsDetailKey && $this->Stock->FormValue != NULL && $this->Stock->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Stock->caption(), $this->Stock->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->Stock->FormValue)) {
			AddMessage($FormError, $this->Stock->errorMessage());
		}
		if ($this->Img1->Required) {
			if ($this->Img1->Upload->FileName == "" && !$this->Img1->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->Img1->caption(), $this->Img1->RequiredErrorMessage));
			}
		}
		if ($this->Img2->Required) {
			if ($this->Img2->Upload->FileName == "" && !$this->Img2->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->Img2->caption(), $this->Img2->RequiredErrorMessage));
			}
		}
		if ($this->Img3->Required) {
			if ($this->Img3->Upload->FileName == "" && !$this->Img3->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->Img3->caption(), $this->Img3->RequiredErrorMessage));
			}
		}
		if ($this->Img4->Required) {
			if ($this->Img4->Upload->FileName == "" && !$this->Img4->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->Img4->caption(), $this->Img4->RequiredErrorMessage));
			}
		}
		if ($this->Vid1->Required) {
			if ($this->Vid1->Upload->FileName == "" && !$this->Vid1->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->Vid1->caption(), $this->Vid1->RequiredErrorMessage));
			}
		}
		if ($this->Vid2->Required) {
			if ($this->Vid2->Upload->FileName == "" && !$this->Vid2->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->Vid2->caption(), $this->Vid2->RequiredErrorMessage));
			}
		}
		if ($this->Descripcion->Required) {
			if (!$this->Descripcion->IsDetailKey && $this->Descripcion->FormValue != NULL && $this->Descripcion->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Descripcion->caption(), $this->Descripcion->RequiredErrorMessage));
			}
		}
		if ($this->NombreEN->Required) {
			if (!$this->NombreEN->IsDetailKey && $this->NombreEN->FormValue != NULL && $this->NombreEN->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->NombreEN->caption(), $this->NombreEN->RequiredErrorMessage));
			}
		}
		if ($this->DescripcionEN->Required) {
			if (!$this->DescripcionEN->IsDetailKey && $this->DescripcionEN->FormValue != NULL && $this->DescripcionEN->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DescripcionEN->caption(), $this->DescripcionEN->RequiredErrorMessage));
			}
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

			// Save old values
			$rsold = &$rs->fields;
			$this->loadDbValues($rsold);
			$rsnew = [];

			// ID_Categorias
			$this->ID_Categorias->setDbValueDef($rsnew, $this->ID_Categorias->CurrentValue, 0, $this->ID_Categorias->ReadOnly);

			// ID_Restaurant
			$this->ID_Restaurant->setDbValueDef($rsnew, $this->ID_Restaurant->CurrentValue, NULL, $this->ID_Restaurant->ReadOnly);

			// Nombre
			$this->Nombre->setDbValueDef($rsnew, $this->Nombre->CurrentValue, NULL, $this->Nombre->ReadOnly);

			// Precio
			$this->Precio->setDbValueDef($rsnew, $this->Precio->CurrentValue, NULL, $this->Precio->ReadOnly);

			// Active
			$this->Active->setDbValueDef($rsnew, $this->Active->CurrentValue, NULL, $this->Active->ReadOnly);

			// Stock
			$this->Stock->setDbValueDef($rsnew, $this->Stock->CurrentValue, NULL, $this->Stock->ReadOnly);

			// Img1
			if ($this->Img1->Visible && !$this->Img1->ReadOnly && !$this->Img1->Upload->KeepFile) {
				$this->Img1->Upload->DbValue = $rsold['Img1']; // Get original value
				if ($this->Img1->Upload->FileName == "") {
					$rsnew['Img1'] = NULL;
				} else {
					$rsnew['Img1'] = $this->Img1->Upload->FileName;
				}
			}

			// Img2
			if ($this->Img2->Visible && !$this->Img2->ReadOnly && !$this->Img2->Upload->KeepFile) {
				$this->Img2->Upload->DbValue = $rsold['Img2']; // Get original value
				if ($this->Img2->Upload->FileName == "") {
					$rsnew['Img2'] = NULL;
				} else {
					$rsnew['Img2'] = $this->Img2->Upload->FileName;
				}
			}

			// Img3
			if ($this->Img3->Visible && !$this->Img3->ReadOnly && !$this->Img3->Upload->KeepFile) {
				$this->Img3->Upload->DbValue = $rsold['Img3']; // Get original value
				if ($this->Img3->Upload->FileName == "") {
					$rsnew['Img3'] = NULL;
				} else {
					$rsnew['Img3'] = $this->Img3->Upload->FileName;
				}
			}

			// Img4
			if ($this->Img4->Visible && !$this->Img4->ReadOnly && !$this->Img4->Upload->KeepFile) {
				$this->Img4->Upload->DbValue = $rsold['Img4']; // Get original value
				if ($this->Img4->Upload->FileName == "") {
					$rsnew['Img4'] = NULL;
				} else {
					$rsnew['Img4'] = $this->Img4->Upload->FileName;
				}
			}

			// Vid1
			if ($this->Vid1->Visible && !$this->Vid1->ReadOnly && !$this->Vid1->Upload->KeepFile) {
				$this->Vid1->Upload->DbValue = $rsold['Vid1']; // Get original value
				if ($this->Vid1->Upload->FileName == "") {
					$rsnew['Vid1'] = NULL;
				} else {
					$rsnew['Vid1'] = $this->Vid1->Upload->FileName;
				}
			}

			// Vid2
			if ($this->Vid2->Visible && !$this->Vid2->ReadOnly && !$this->Vid2->Upload->KeepFile) {
				$this->Vid2->Upload->DbValue = $rsold['Vid2']; // Get original value
				if ($this->Vid2->Upload->FileName == "") {
					$rsnew['Vid2'] = NULL;
				} else {
					$rsnew['Vid2'] = $this->Vid2->Upload->FileName;
				}
			}

			// Descripcion
			$this->Descripcion->setDbValueDef($rsnew, $this->Descripcion->CurrentValue, NULL, $this->Descripcion->ReadOnly);

			// NombreEN
			$this->NombreEN->setDbValueDef($rsnew, $this->NombreEN->CurrentValue, NULL, $this->NombreEN->ReadOnly);

			// DescripcionEN
			$this->DescripcionEN->setDbValueDef($rsnew, $this->DescripcionEN->CurrentValue, NULL, $this->DescripcionEN->ReadOnly);
			if ($this->Img1->Visible && !$this->Img1->Upload->KeepFile) {
				$oldFiles = EmptyValue($this->Img1->Upload->DbValue) ? [] : [$this->Img1->htmlDecode($this->Img1->Upload->DbValue)];
				if (!EmptyValue($this->Img1->Upload->FileName)) {
					$newFiles = [$this->Img1->Upload->FileName];
					$NewFileCount = count($newFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						if ($newFiles[$i] != "") {
							$file = $newFiles[$i];
							$tempPath = UploadTempPath($this->Img1, $this->Img1->Upload->Index);
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
								$file1 = UniqueFilename($this->Img1->physicalUploadPath(), $file); // Get new file name
								if ($file1 != $file) { // Rename temp file
									while (file_exists($tempPath . $file1) || file_exists($this->Img1->physicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = UniqueFilename($this->Img1->physicalUploadPath(), $file1, TRUE); // Use indexed name
									rename($tempPath . $file, $tempPath . $file1);
									$newFiles[$i] = $file1;
								}
							}
						}
					}
					$this->Img1->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
					$this->Img1->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
					$this->Img1->setDbValueDef($rsnew, $this->Img1->Upload->FileName, NULL, $this->Img1->ReadOnly);
				}
			}
			if ($this->Img2->Visible && !$this->Img2->Upload->KeepFile) {
				$oldFiles = EmptyValue($this->Img2->Upload->DbValue) ? [] : [$this->Img2->htmlDecode($this->Img2->Upload->DbValue)];
				if (!EmptyValue($this->Img2->Upload->FileName)) {
					$newFiles = [$this->Img2->Upload->FileName];
					$NewFileCount = count($newFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						if ($newFiles[$i] != "") {
							$file = $newFiles[$i];
							$tempPath = UploadTempPath($this->Img2, $this->Img2->Upload->Index);
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
								$file1 = UniqueFilename($this->Img2->physicalUploadPath(), $file); // Get new file name
								if ($file1 != $file) { // Rename temp file
									while (file_exists($tempPath . $file1) || file_exists($this->Img2->physicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = UniqueFilename($this->Img2->physicalUploadPath(), $file1, TRUE); // Use indexed name
									rename($tempPath . $file, $tempPath . $file1);
									$newFiles[$i] = $file1;
								}
							}
						}
					}
					$this->Img2->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
					$this->Img2->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
					$this->Img2->setDbValueDef($rsnew, $this->Img2->Upload->FileName, NULL, $this->Img2->ReadOnly);
				}
			}
			if ($this->Img3->Visible && !$this->Img3->Upload->KeepFile) {
				$oldFiles = EmptyValue($this->Img3->Upload->DbValue) ? [] : [$this->Img3->htmlDecode($this->Img3->Upload->DbValue)];
				if (!EmptyValue($this->Img3->Upload->FileName)) {
					$newFiles = [$this->Img3->Upload->FileName];
					$NewFileCount = count($newFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						if ($newFiles[$i] != "") {
							$file = $newFiles[$i];
							$tempPath = UploadTempPath($this->Img3, $this->Img3->Upload->Index);
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
								$file1 = UniqueFilename($this->Img3->physicalUploadPath(), $file); // Get new file name
								if ($file1 != $file) { // Rename temp file
									while (file_exists($tempPath . $file1) || file_exists($this->Img3->physicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = UniqueFilename($this->Img3->physicalUploadPath(), $file1, TRUE); // Use indexed name
									rename($tempPath . $file, $tempPath . $file1);
									$newFiles[$i] = $file1;
								}
							}
						}
					}
					$this->Img3->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
					$this->Img3->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
					$this->Img3->setDbValueDef($rsnew, $this->Img3->Upload->FileName, NULL, $this->Img3->ReadOnly);
				}
			}
			if ($this->Img4->Visible && !$this->Img4->Upload->KeepFile) {
				$oldFiles = EmptyValue($this->Img4->Upload->DbValue) ? [] : [$this->Img4->htmlDecode($this->Img4->Upload->DbValue)];
				if (!EmptyValue($this->Img4->Upload->FileName)) {
					$newFiles = [$this->Img4->Upload->FileName];
					$NewFileCount = count($newFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						if ($newFiles[$i] != "") {
							$file = $newFiles[$i];
							$tempPath = UploadTempPath($this->Img4, $this->Img4->Upload->Index);
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
								$file1 = UniqueFilename($this->Img4->physicalUploadPath(), $file); // Get new file name
								if ($file1 != $file) { // Rename temp file
									while (file_exists($tempPath . $file1) || file_exists($this->Img4->physicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = UniqueFilename($this->Img4->physicalUploadPath(), $file1, TRUE); // Use indexed name
									rename($tempPath . $file, $tempPath . $file1);
									$newFiles[$i] = $file1;
								}
							}
						}
					}
					$this->Img4->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
					$this->Img4->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
					$this->Img4->setDbValueDef($rsnew, $this->Img4->Upload->FileName, NULL, $this->Img4->ReadOnly);
				}
			}
			if ($this->Vid1->Visible && !$this->Vid1->Upload->KeepFile) {
				$oldFiles = EmptyValue($this->Vid1->Upload->DbValue) ? [] : [$this->Vid1->htmlDecode($this->Vid1->Upload->DbValue)];
				if (!EmptyValue($this->Vid1->Upload->FileName)) {
					$newFiles = [$this->Vid1->Upload->FileName];
					$NewFileCount = count($newFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						if ($newFiles[$i] != "") {
							$file = $newFiles[$i];
							$tempPath = UploadTempPath($this->Vid1, $this->Vid1->Upload->Index);
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
								$file1 = UniqueFilename($this->Vid1->physicalUploadPath(), $file); // Get new file name
								if ($file1 != $file) { // Rename temp file
									while (file_exists($tempPath . $file1) || file_exists($this->Vid1->physicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = UniqueFilename($this->Vid1->physicalUploadPath(), $file1, TRUE); // Use indexed name
									rename($tempPath . $file, $tempPath . $file1);
									$newFiles[$i] = $file1;
								}
							}
						}
					}
					$this->Vid1->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
					$this->Vid1->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
					$this->Vid1->setDbValueDef($rsnew, $this->Vid1->Upload->FileName, NULL, $this->Vid1->ReadOnly);
				}
			}
			if ($this->Vid2->Visible && !$this->Vid2->Upload->KeepFile) {
				$oldFiles = EmptyValue($this->Vid2->Upload->DbValue) ? [] : [$this->Vid2->htmlDecode($this->Vid2->Upload->DbValue)];
				if (!EmptyValue($this->Vid2->Upload->FileName)) {
					$newFiles = [$this->Vid2->Upload->FileName];
					$NewFileCount = count($newFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						if ($newFiles[$i] != "") {
							$file = $newFiles[$i];
							$tempPath = UploadTempPath($this->Vid2, $this->Vid2->Upload->Index);
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
								$file1 = UniqueFilename($this->Vid2->physicalUploadPath(), $file); // Get new file name
								if ($file1 != $file) { // Rename temp file
									while (file_exists($tempPath . $file1) || file_exists($this->Vid2->physicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = UniqueFilename($this->Vid2->physicalUploadPath(), $file1, TRUE); // Use indexed name
									rename($tempPath . $file, $tempPath . $file1);
									$newFiles[$i] = $file1;
								}
							}
						}
					}
					$this->Vid2->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
					$this->Vid2->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
					$this->Vid2->setDbValueDef($rsnew, $this->Vid2->Upload->FileName, NULL, $this->Vid2->ReadOnly);
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
					if ($this->Img1->Visible && !$this->Img1->Upload->KeepFile) {
						$oldFiles = EmptyValue($this->Img1->Upload->DbValue) ? [] : [$this->Img1->htmlDecode($this->Img1->Upload->DbValue)];
						if (!EmptyValue($this->Img1->Upload->FileName)) {
							$newFiles = [$this->Img1->Upload->FileName];
							$newFiles2 = [$this->Img1->htmlDecode($rsnew['Img1'])];
							$newFileCount = count($newFiles);
							for ($i = 0; $i < $newFileCount; $i++) {
								if ($newFiles[$i] != "") {
									$file = UploadTempPath($this->Img1, $this->Img1->Upload->Index) . $newFiles[$i];
									if (file_exists($file)) {
										if (@$newFiles2[$i] != "") // Use correct file name
											$newFiles[$i] = $newFiles2[$i];
										if (!$this->Img1->Upload->SaveToFile($newFiles[$i], TRUE, $i)) { // Just replace
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
									@unlink($this->Img1->oldPhysicalUploadPath() . $oldFile);
							}
						}
					}
					if ($this->Img2->Visible && !$this->Img2->Upload->KeepFile) {
						$oldFiles = EmptyValue($this->Img2->Upload->DbValue) ? [] : [$this->Img2->htmlDecode($this->Img2->Upload->DbValue)];
						if (!EmptyValue($this->Img2->Upload->FileName)) {
							$newFiles = [$this->Img2->Upload->FileName];
							$newFiles2 = [$this->Img2->htmlDecode($rsnew['Img2'])];
							$newFileCount = count($newFiles);
							for ($i = 0; $i < $newFileCount; $i++) {
								if ($newFiles[$i] != "") {
									$file = UploadTempPath($this->Img2, $this->Img2->Upload->Index) . $newFiles[$i];
									if (file_exists($file)) {
										if (@$newFiles2[$i] != "") // Use correct file name
											$newFiles[$i] = $newFiles2[$i];
										if (!$this->Img2->Upload->SaveToFile($newFiles[$i], TRUE, $i)) { // Just replace
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
									@unlink($this->Img2->oldPhysicalUploadPath() . $oldFile);
							}
						}
					}
					if ($this->Img3->Visible && !$this->Img3->Upload->KeepFile) {
						$oldFiles = EmptyValue($this->Img3->Upload->DbValue) ? [] : [$this->Img3->htmlDecode($this->Img3->Upload->DbValue)];
						if (!EmptyValue($this->Img3->Upload->FileName)) {
							$newFiles = [$this->Img3->Upload->FileName];
							$newFiles2 = [$this->Img3->htmlDecode($rsnew['Img3'])];
							$newFileCount = count($newFiles);
							for ($i = 0; $i < $newFileCount; $i++) {
								if ($newFiles[$i] != "") {
									$file = UploadTempPath($this->Img3, $this->Img3->Upload->Index) . $newFiles[$i];
									if (file_exists($file)) {
										if (@$newFiles2[$i] != "") // Use correct file name
											$newFiles[$i] = $newFiles2[$i];
										if (!$this->Img3->Upload->SaveToFile($newFiles[$i], TRUE, $i)) { // Just replace
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
									@unlink($this->Img3->oldPhysicalUploadPath() . $oldFile);
							}
						}
					}
					if ($this->Img4->Visible && !$this->Img4->Upload->KeepFile) {
						$oldFiles = EmptyValue($this->Img4->Upload->DbValue) ? [] : [$this->Img4->htmlDecode($this->Img4->Upload->DbValue)];
						if (!EmptyValue($this->Img4->Upload->FileName)) {
							$newFiles = [$this->Img4->Upload->FileName];
							$newFiles2 = [$this->Img4->htmlDecode($rsnew['Img4'])];
							$newFileCount = count($newFiles);
							for ($i = 0; $i < $newFileCount; $i++) {
								if ($newFiles[$i] != "") {
									$file = UploadTempPath($this->Img4, $this->Img4->Upload->Index) . $newFiles[$i];
									if (file_exists($file)) {
										if (@$newFiles2[$i] != "") // Use correct file name
											$newFiles[$i] = $newFiles2[$i];
										if (!$this->Img4->Upload->SaveToFile($newFiles[$i], TRUE, $i)) { // Just replace
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
									@unlink($this->Img4->oldPhysicalUploadPath() . $oldFile);
							}
						}
					}
					if ($this->Vid1->Visible && !$this->Vid1->Upload->KeepFile) {
						$oldFiles = EmptyValue($this->Vid1->Upload->DbValue) ? [] : [$this->Vid1->htmlDecode($this->Vid1->Upload->DbValue)];
						if (!EmptyValue($this->Vid1->Upload->FileName)) {
							$newFiles = [$this->Vid1->Upload->FileName];
							$newFiles2 = [$this->Vid1->htmlDecode($rsnew['Vid1'])];
							$newFileCount = count($newFiles);
							for ($i = 0; $i < $newFileCount; $i++) {
								if ($newFiles[$i] != "") {
									$file = UploadTempPath($this->Vid1, $this->Vid1->Upload->Index) . $newFiles[$i];
									if (file_exists($file)) {
										if (@$newFiles2[$i] != "") // Use correct file name
											$newFiles[$i] = $newFiles2[$i];
										if (!$this->Vid1->Upload->SaveToFile($newFiles[$i], TRUE, $i)) { // Just replace
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
									@unlink($this->Vid1->oldPhysicalUploadPath() . $oldFile);
							}
						}
					}
					if ($this->Vid2->Visible && !$this->Vid2->Upload->KeepFile) {
						$oldFiles = EmptyValue($this->Vid2->Upload->DbValue) ? [] : [$this->Vid2->htmlDecode($this->Vid2->Upload->DbValue)];
						if (!EmptyValue($this->Vid2->Upload->FileName)) {
							$newFiles = [$this->Vid2->Upload->FileName];
							$newFiles2 = [$this->Vid2->htmlDecode($rsnew['Vid2'])];
							$newFileCount = count($newFiles);
							for ($i = 0; $i < $newFileCount; $i++) {
								if ($newFiles[$i] != "") {
									$file = UploadTempPath($this->Vid2, $this->Vid2->Upload->Index) . $newFiles[$i];
									if (file_exists($file)) {
										if (@$newFiles2[$i] != "") // Use correct file name
											$newFiles[$i] = $newFiles2[$i];
										if (!$this->Vid2->Upload->SaveToFile($newFiles[$i], TRUE, $i)) { // Just replace
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
									@unlink($this->Vid2->oldPhysicalUploadPath() . $oldFile);
							}
						}
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

			// Img1
			CleanUploadTempPath($this->Img1, $this->Img1->Upload->Index);

			// Img2
			CleanUploadTempPath($this->Img2, $this->Img2->Upload->Index);

			// Img3
			CleanUploadTempPath($this->Img3, $this->Img3->Upload->Index);

			// Img4
			CleanUploadTempPath($this->Img4, $this->Img4->Upload->Index);

			// Vid1
			CleanUploadTempPath($this->Vid1, $this->Vid1->Upload->Index);

			// Vid2
			CleanUploadTempPath($this->Vid2, $this->Vid2->Upload->Index);
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
			return $Security->isValidUserID($this->ID_Restaurant->CurrentValue);
		return TRUE;
	}

	// Set up master/detail based on QueryString
	protected function setupMasterParms()
	{
		$validMaster = FALSE;

		// Get the keys for master table
		if (($master = Get(Config("TABLE_SHOW_MASTER"), Get(Config("TABLE_MASTER")))) !== NULL) {
			$masterTblVar = $master;
			if ($masterTblVar == "") {
				$validMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($masterTblVar == "Categorias") {
				$validMaster = TRUE;
				if (($parm = Get("fk_ID", Get("ID_Categorias"))) !== NULL) {
					$GLOBALS["Categorias"]->ID->setQueryStringValue($parm);
					$this->ID_Categorias->setQueryStringValue($GLOBALS["Categorias"]->ID->QueryStringValue);
					$this->ID_Categorias->setSessionValue($this->ID_Categorias->QueryStringValue);
					if (!is_numeric($GLOBALS["Categorias"]->ID->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
		} elseif (($master = Post(Config("TABLE_SHOW_MASTER"), Post(Config("TABLE_MASTER")))) !== NULL) {
			$masterTblVar = $master;
			if ($masterTblVar == "") {
				$validMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($masterTblVar == "Categorias") {
				$validMaster = TRUE;
				if (($parm = Post("fk_ID", Post("ID_Categorias"))) !== NULL) {
					$GLOBALS["Categorias"]->ID->setFormValue($parm);
					$this->ID_Categorias->setFormValue($GLOBALS["Categorias"]->ID->FormValue);
					$this->ID_Categorias->setSessionValue($this->ID_Categorias->FormValue);
					if (!is_numeric($GLOBALS["Categorias"]->ID->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
		}
		if ($validMaster) {

			// Save current master table
			$this->setCurrentMasterTable($masterTblVar);
			$this->setSessionWhere($this->getDetailFilter());

			// Reset start record counter (new master key)
			if (!$this->isAddOrEdit()) {
				$this->StartRecord = 1;
				$this->setStartRecordNumber($this->StartRecord);
			}

			// Clear previous master key from Session
			if ($masterTblVar != "Categorias") {
				if ($this->ID_Categorias->CurrentValue == "")
					$this->ID_Categorias->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $this->getMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Get detail filter
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("Itemslist.php"), "", $this->TableVar, TRUE);
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
				case "x_ID_Categorias":
					break;
				case "x_ID_Restaurant":
					break;
				case "x_Active":
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
						case "x_ID_Categorias":
							break;
						case "x_ID_Restaurant":
							break;
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