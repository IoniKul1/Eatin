<?php
namespace PHPMaker2020\EATIN_BO;

/**
 * Page class
 */
class Client_add extends Client
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{CC19BE4C-23D6-4992-89EF-6304995797F2}";

	// Table name
	public $TableName = 'Client';

	// Page object name
	public $PageObjName = "Client_add";

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

		// Table object (Client)
		if (!isset($GLOBALS["Client"]) || get_class($GLOBALS["Client"]) == PROJECT_NAMESPACE . "Client") {
			$GLOBALS["Client"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["Client"];
		}

		// Table object (Restaurant)
		if (!isset($GLOBALS['Restaurant']))
			$GLOBALS['Restaurant'] = new Restaurant();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'Client');

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
		global $Client;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($Client);
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
					if ($pageName == "Clientview.php")
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
	public $FormClassName = "ew-horizontal ew-form ew-add-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter = "";
	public $DbDetailFilter = "";
	public $StartRecord;
	public $Priv = 0;
	public $OldRecordset;
	public $CopyRecord;

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
			if (!$Security->canAdd()) {
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
			if (!$Security->canAdd()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("Clientlist.php"));
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
					$this->terminate(GetUrl("Clientlist.php"));
					return;
				}
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->ID->Visible = FALSE;
		$this->ID_Restaurant->setVisibility();
		$this->DateCreation->Visible = FALSE;
		$this->DateLastUpdate->Visible = FALSE;
		$this->Hash->Visible = FALSE;
		$this->FirstName->setVisibility();
		$this->LastName->setVisibility();
		$this->_Email->setVisibility();
		$this->Hashpass->setVisibility();
		$this->Phone->setVisibility();
		$this->Banned->setVisibility();
		$this->Comments->setVisibility();
		$this->ClientToken->setVisibility();
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
		$this->setupLookupOptions($this->ID_Restaurant);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("Clientlist.php");
			return;
		}

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-add-form ew-horizontal";
		$postBack = FALSE;

		// Set up current action
		if (IsApi()) {
			$this->CurrentAction = "insert"; // Add record directly
			$postBack = TRUE;
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action"); // Get form action
			$postBack = TRUE;
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (Get("ID") !== NULL) {
				$this->ID->setQueryStringValue(Get("ID"));
				$this->setKey("ID", $this->ID->CurrentValue); // Set up key
			} else {
				$this->setKey("ID", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "copy"; // Copy record
			} else {
				$this->CurrentAction = "show"; // Display blank record
			}
		}

		// Load old record / default values
		$loaded = $this->loadOldRecord();

		// Set up master/detail parameters
		// NOTE: must be after loadOldRecord to prevent master key values overwritten

		$this->setupMasterParms();

		// Load form values
		if ($postBack) {
			$this->loadFormValues(); // Load form values
		}

		// Set up detail parameters
		$this->setupDetailParms();

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues(); // Restore form values
				$this->setFailureMessage($FormError);
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = "show"; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "copy": // Copy an existing record
				if (!$loaded) { // Record not loaded
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("Clientlist.php"); // No matching record, return to list
				}

				// Set up detail parameters
				$this->setupDetailParms();
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					if ($this->getCurrentDetailTable() != "") // Master/detail add
						$returnUrl = $this->getDetailUrl();
					else
						$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "Clientlist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "Clientview.php")
						$returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
					if (IsApi()) { // Return to caller
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl);
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Add failed, restore form values

					// Set up detail parameters
					$this->setupDetailParms();
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render row based on row type
		$this->RowType = ROWTYPE_ADD; // Render add type

		// Render row
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->ID->CurrentValue = NULL;
		$this->ID->OldValue = $this->ID->CurrentValue;
		$this->ID_Restaurant->CurrentValue = CurrentUserID();
		$this->DateCreation->CurrentValue = NULL;
		$this->DateCreation->OldValue = $this->DateCreation->CurrentValue;
		$this->DateLastUpdate->CurrentValue = NULL;
		$this->DateLastUpdate->OldValue = $this->DateLastUpdate->CurrentValue;
		$this->Hash->CurrentValue = NULL;
		$this->Hash->OldValue = $this->Hash->CurrentValue;
		$this->FirstName->CurrentValue = NULL;
		$this->FirstName->OldValue = $this->FirstName->CurrentValue;
		$this->LastName->CurrentValue = NULL;
		$this->LastName->OldValue = $this->LastName->CurrentValue;
		$this->_Email->CurrentValue = NULL;
		$this->_Email->OldValue = $this->_Email->CurrentValue;
		$this->Hashpass->CurrentValue = NULL;
		$this->Hashpass->OldValue = $this->Hashpass->CurrentValue;
		$this->Phone->CurrentValue = NULL;
		$this->Phone->OldValue = $this->Phone->CurrentValue;
		$this->Banned->CurrentValue = NULL;
		$this->Banned->OldValue = $this->Banned->CurrentValue;
		$this->Comments->CurrentValue = NULL;
		$this->Comments->OldValue = $this->Comments->CurrentValue;
		$this->ClientToken->CurrentValue = NULL;
		$this->ClientToken->OldValue = $this->ClientToken->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'ID_Restaurant' first before field var 'x_ID_Restaurant'
		$val = $CurrentForm->hasValue("ID_Restaurant") ? $CurrentForm->getValue("ID_Restaurant") : $CurrentForm->getValue("x_ID_Restaurant");
		if (!$this->ID_Restaurant->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ID_Restaurant->Visible = FALSE; // Disable update for API request
			else
				$this->ID_Restaurant->setFormValue($val);
		}

		// Check field name 'FirstName' first before field var 'x_FirstName'
		$val = $CurrentForm->hasValue("FirstName") ? $CurrentForm->getValue("FirstName") : $CurrentForm->getValue("x_FirstName");
		if (!$this->FirstName->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->FirstName->Visible = FALSE; // Disable update for API request
			else
				$this->FirstName->setFormValue($val);
		}

		// Check field name 'LastName' first before field var 'x_LastName'
		$val = $CurrentForm->hasValue("LastName") ? $CurrentForm->getValue("LastName") : $CurrentForm->getValue("x_LastName");
		if (!$this->LastName->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->LastName->Visible = FALSE; // Disable update for API request
			else
				$this->LastName->setFormValue($val);
		}

		// Check field name 'Email' first before field var 'x__Email'
		$val = $CurrentForm->hasValue("Email") ? $CurrentForm->getValue("Email") : $CurrentForm->getValue("x__Email");
		if (!$this->_Email->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_Email->Visible = FALSE; // Disable update for API request
			else
				$this->_Email->setFormValue($val);
		}

		// Check field name 'Hashpass' first before field var 'x_Hashpass'
		$val = $CurrentForm->hasValue("Hashpass") ? $CurrentForm->getValue("Hashpass") : $CurrentForm->getValue("x_Hashpass");
		if (!$this->Hashpass->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Hashpass->Visible = FALSE; // Disable update for API request
			else
				$this->Hashpass->setFormValue($val);
		}

		// Check field name 'Phone' first before field var 'x_Phone'
		$val = $CurrentForm->hasValue("Phone") ? $CurrentForm->getValue("Phone") : $CurrentForm->getValue("x_Phone");
		if (!$this->Phone->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Phone->Visible = FALSE; // Disable update for API request
			else
				$this->Phone->setFormValue($val);
		}

		// Check field name 'Banned' first before field var 'x_Banned'
		$val = $CurrentForm->hasValue("Banned") ? $CurrentForm->getValue("Banned") : $CurrentForm->getValue("x_Banned");
		if (!$this->Banned->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Banned->Visible = FALSE; // Disable update for API request
			else
				$this->Banned->setFormValue($val);
		}

		// Check field name 'Comments' first before field var 'x_Comments'
		$val = $CurrentForm->hasValue("Comments") ? $CurrentForm->getValue("Comments") : $CurrentForm->getValue("x_Comments");
		if (!$this->Comments->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Comments->Visible = FALSE; // Disable update for API request
			else
				$this->Comments->setFormValue($val);
		}

		// Check field name 'ClientToken' first before field var 'x_ClientToken'
		$val = $CurrentForm->hasValue("ClientToken") ? $CurrentForm->getValue("ClientToken") : $CurrentForm->getValue("x_ClientToken");
		if (!$this->ClientToken->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ClientToken->Visible = FALSE; // Disable update for API request
			else
				$this->ClientToken->setFormValue($val);
		}

		// Check field name 'ID' first before field var 'x_ID'
		$val = $CurrentForm->hasValue("ID") ? $CurrentForm->getValue("ID") : $CurrentForm->getValue("x_ID");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->ID_Restaurant->CurrentValue = $this->ID_Restaurant->FormValue;
		$this->FirstName->CurrentValue = $this->FirstName->FormValue;
		$this->LastName->CurrentValue = $this->LastName->FormValue;
		$this->_Email->CurrentValue = $this->_Email->FormValue;
		$this->Hashpass->CurrentValue = $this->Hashpass->FormValue;
		$this->Phone->CurrentValue = $this->Phone->FormValue;
		$this->Banned->CurrentValue = $this->Banned->FormValue;
		$this->Comments->CurrentValue = $this->Comments->FormValue;
		$this->ClientToken->CurrentValue = $this->ClientToken->FormValue;
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
			$res = $this->showOptionLink('add');
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
		$this->ID_Restaurant->setDbValue($row['ID_Restaurant']);
		$this->DateCreation->setDbValue($row['DateCreation']);
		$this->DateLastUpdate->setDbValue($row['DateLastUpdate']);
		$this->Hash->setDbValue($row['Hash']);
		$this->FirstName->setDbValue($row['FirstName']);
		$this->LastName->setDbValue($row['LastName']);
		$this->_Email->setDbValue($row['Email']);
		$this->Hashpass->setDbValue($row['Hashpass']);
		$this->Phone->setDbValue($row['Phone']);
		$this->Banned->setDbValue($row['Banned']);
		$this->Comments->setDbValue($row['Comments']);
		$this->ClientToken->setDbValue($row['ClientToken']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['ID'] = $this->ID->CurrentValue;
		$row['ID_Restaurant'] = $this->ID_Restaurant->CurrentValue;
		$row['DateCreation'] = $this->DateCreation->CurrentValue;
		$row['DateLastUpdate'] = $this->DateLastUpdate->CurrentValue;
		$row['Hash'] = $this->Hash->CurrentValue;
		$row['FirstName'] = $this->FirstName->CurrentValue;
		$row['LastName'] = $this->LastName->CurrentValue;
		$row['Email'] = $this->_Email->CurrentValue;
		$row['Hashpass'] = $this->Hashpass->CurrentValue;
		$row['Phone'] = $this->Phone->CurrentValue;
		$row['Banned'] = $this->Banned->CurrentValue;
		$row['Comments'] = $this->Comments->CurrentValue;
		$row['ClientToken'] = $this->ClientToken->CurrentValue;
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
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// ID
		// ID_Restaurant
		// DateCreation
		// DateLastUpdate
		// Hash
		// FirstName
		// LastName
		// Email
		// Hashpass
		// Phone
		// Banned
		// Comments
		// ClientToken

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// ID
			$this->ID->ViewValue = $this->ID->CurrentValue;
			$this->ID->ViewValue = FormatNumber($this->ID->ViewValue, 0, -2, -2, -2);
			$this->ID->ViewCustomAttributes = "";

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

			// FirstName
			$this->FirstName->ViewValue = $this->FirstName->CurrentValue;
			$this->FirstName->ViewCustomAttributes = "";

			// LastName
			$this->LastName->ViewValue = $this->LastName->CurrentValue;
			$this->LastName->ViewCustomAttributes = "";

			// Email
			$this->_Email->ViewValue = $this->_Email->CurrentValue;
			$this->_Email->ViewCustomAttributes = "";

			// Hashpass
			$this->Hashpass->ViewValue = $this->Hashpass->CurrentValue;
			$this->Hashpass->ViewCustomAttributes = "";

			// Phone
			$this->Phone->ViewValue = $this->Phone->CurrentValue;
			$this->Phone->ViewCustomAttributes = "";

			// Banned
			if (strval($this->Banned->CurrentValue) != "") {
				$this->Banned->ViewValue = $this->Banned->optionCaption($this->Banned->CurrentValue);
			} else {
				$this->Banned->ViewValue = NULL;
			}
			$this->Banned->ViewCustomAttributes = "";

			// Comments
			$this->Comments->ViewValue = $this->Comments->CurrentValue;
			$this->Comments->ViewCustomAttributes = "";

			// ClientToken
			$this->ClientToken->ViewValue = $this->ClientToken->CurrentValue;
			$this->ClientToken->ViewCustomAttributes = "";

			// ID_Restaurant
			$this->ID_Restaurant->LinkCustomAttributes = "";
			$this->ID_Restaurant->HrefValue = "";
			$this->ID_Restaurant->TooltipValue = "";

			// FirstName
			$this->FirstName->LinkCustomAttributes = "";
			$this->FirstName->HrefValue = "";
			$this->FirstName->TooltipValue = "";

			// LastName
			$this->LastName->LinkCustomAttributes = "";
			$this->LastName->HrefValue = "";
			$this->LastName->TooltipValue = "";

			// Email
			$this->_Email->LinkCustomAttributes = "";
			$this->_Email->HrefValue = "";
			$this->_Email->TooltipValue = "";

			// Hashpass
			$this->Hashpass->LinkCustomAttributes = "";
			$this->Hashpass->HrefValue = "";
			$this->Hashpass->TooltipValue = "";

			// Phone
			$this->Phone->LinkCustomAttributes = "";
			$this->Phone->HrefValue = "";
			$this->Phone->TooltipValue = "";

			// Banned
			$this->Banned->LinkCustomAttributes = "";
			$this->Banned->HrefValue = "";
			$this->Banned->TooltipValue = "";

			// Comments
			$this->Comments->LinkCustomAttributes = "";
			$this->Comments->HrefValue = "";
			$this->Comments->TooltipValue = "";

			// ClientToken
			$this->ClientToken->LinkCustomAttributes = "";
			$this->ClientToken->HrefValue = "";
			$this->ClientToken->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// ID_Restaurant
			$this->ID_Restaurant->EditAttrs["class"] = "form-control";
			$this->ID_Restaurant->EditCustomAttributes = "";
			if ($this->ID_Restaurant->getSessionValue() != "") {
				$this->ID_Restaurant->CurrentValue = $this->ID_Restaurant->getSessionValue();
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
			} elseif (!$Security->isAdmin() && $Security->isLoggedIn() && !$this->userIDAllow("add")) { // Non system admin
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

			// FirstName
			$this->FirstName->EditAttrs["class"] = "form-control";
			$this->FirstName->EditCustomAttributes = "";
			if (!$this->FirstName->Raw)
				$this->FirstName->CurrentValue = HtmlDecode($this->FirstName->CurrentValue);
			$this->FirstName->EditValue = HtmlEncode($this->FirstName->CurrentValue);
			$this->FirstName->PlaceHolder = RemoveHtml($this->FirstName->caption());

			// LastName
			$this->LastName->EditAttrs["class"] = "form-control";
			$this->LastName->EditCustomAttributes = "";
			if (!$this->LastName->Raw)
				$this->LastName->CurrentValue = HtmlDecode($this->LastName->CurrentValue);
			$this->LastName->EditValue = HtmlEncode($this->LastName->CurrentValue);
			$this->LastName->PlaceHolder = RemoveHtml($this->LastName->caption());

			// Email
			$this->_Email->EditAttrs["class"] = "form-control";
			$this->_Email->EditCustomAttributes = "";
			if (!$this->_Email->Raw)
				$this->_Email->CurrentValue = HtmlDecode($this->_Email->CurrentValue);
			$this->_Email->EditValue = HtmlEncode($this->_Email->CurrentValue);
			$this->_Email->PlaceHolder = RemoveHtml($this->_Email->caption());

			// Hashpass
			$this->Hashpass->EditAttrs["class"] = "form-control";
			$this->Hashpass->EditCustomAttributes = "";
			if (!$this->Hashpass->Raw)
				$this->Hashpass->CurrentValue = HtmlDecode($this->Hashpass->CurrentValue);
			$this->Hashpass->EditValue = HtmlEncode($this->Hashpass->CurrentValue);
			$this->Hashpass->PlaceHolder = RemoveHtml($this->Hashpass->caption());

			// Phone
			$this->Phone->EditAttrs["class"] = "form-control";
			$this->Phone->EditCustomAttributes = "";
			if (!$this->Phone->Raw)
				$this->Phone->CurrentValue = HtmlDecode($this->Phone->CurrentValue);
			$this->Phone->EditValue = HtmlEncode($this->Phone->CurrentValue);
			$this->Phone->PlaceHolder = RemoveHtml($this->Phone->caption());

			// Banned
			$this->Banned->EditCustomAttributes = "";
			$this->Banned->EditValue = $this->Banned->options(FALSE);

			// Comments
			$this->Comments->EditAttrs["class"] = "form-control";
			$this->Comments->EditCustomAttributes = "";
			$this->Comments->EditValue = HtmlEncode($this->Comments->CurrentValue);
			$this->Comments->PlaceHolder = RemoveHtml($this->Comments->caption());

			// ClientToken
			$this->ClientToken->EditAttrs["class"] = "form-control";
			$this->ClientToken->EditCustomAttributes = "";
			if (!$this->ClientToken->Raw)
				$this->ClientToken->CurrentValue = HtmlDecode($this->ClientToken->CurrentValue);
			$this->ClientToken->EditValue = HtmlEncode($this->ClientToken->CurrentValue);
			$this->ClientToken->PlaceHolder = RemoveHtml($this->ClientToken->caption());

			// Add refer script
			// ID_Restaurant

			$this->ID_Restaurant->LinkCustomAttributes = "";
			$this->ID_Restaurant->HrefValue = "";

			// FirstName
			$this->FirstName->LinkCustomAttributes = "";
			$this->FirstName->HrefValue = "";

			// LastName
			$this->LastName->LinkCustomAttributes = "";
			$this->LastName->HrefValue = "";

			// Email
			$this->_Email->LinkCustomAttributes = "";
			$this->_Email->HrefValue = "";

			// Hashpass
			$this->Hashpass->LinkCustomAttributes = "";
			$this->Hashpass->HrefValue = "";

			// Phone
			$this->Phone->LinkCustomAttributes = "";
			$this->Phone->HrefValue = "";

			// Banned
			$this->Banned->LinkCustomAttributes = "";
			$this->Banned->HrefValue = "";

			// Comments
			$this->Comments->LinkCustomAttributes = "";
			$this->Comments->HrefValue = "";

			// ClientToken
			$this->ClientToken->LinkCustomAttributes = "";
			$this->ClientToken->HrefValue = "";
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
		if ($this->ID_Restaurant->Required) {
			if (!$this->ID_Restaurant->IsDetailKey && $this->ID_Restaurant->FormValue != NULL && $this->ID_Restaurant->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ID_Restaurant->caption(), $this->ID_Restaurant->RequiredErrorMessage));
			}
		}
		if ($this->FirstName->Required) {
			if (!$this->FirstName->IsDetailKey && $this->FirstName->FormValue != NULL && $this->FirstName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->FirstName->caption(), $this->FirstName->RequiredErrorMessage));
			}
		}
		if ($this->LastName->Required) {
			if (!$this->LastName->IsDetailKey && $this->LastName->FormValue != NULL && $this->LastName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LastName->caption(), $this->LastName->RequiredErrorMessage));
			}
		}
		if ($this->_Email->Required) {
			if (!$this->_Email->IsDetailKey && $this->_Email->FormValue != NULL && $this->_Email->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_Email->caption(), $this->_Email->RequiredErrorMessage));
			}
		}
		if ($this->Hashpass->Required) {
			if (!$this->Hashpass->IsDetailKey && $this->Hashpass->FormValue != NULL && $this->Hashpass->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Hashpass->caption(), $this->Hashpass->RequiredErrorMessage));
			}
		}
		if ($this->Phone->Required) {
			if (!$this->Phone->IsDetailKey && $this->Phone->FormValue != NULL && $this->Phone->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Phone->caption(), $this->Phone->RequiredErrorMessage));
			}
		}
		if ($this->Banned->Required) {
			if ($this->Banned->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Banned->caption(), $this->Banned->RequiredErrorMessage));
			}
		}
		if ($this->Comments->Required) {
			if (!$this->Comments->IsDetailKey && $this->Comments->FormValue != NULL && $this->Comments->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Comments->caption(), $this->Comments->RequiredErrorMessage));
			}
		}
		if ($this->ClientToken->Required) {
			if (!$this->ClientToken->IsDetailKey && $this->ClientToken->FormValue != NULL && $this->ClientToken->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ClientToken->caption(), $this->ClientToken->RequiredErrorMessage));
			}
		}

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("Pedido", $detailTblVar) && $GLOBALS["Pedido"]->DetailAdd) {
			if (!isset($GLOBALS["Pedido_grid"]))
				$GLOBALS["Pedido_grid"] = new Pedido_grid(); // Get detail page object
			$GLOBALS["Pedido_grid"]->validateGridForm();
		}
		if (in_array("Checkin", $detailTblVar) && $GLOBALS["Checkin"]->DetailAdd) {
			if (!isset($GLOBALS["Checkin_grid"]))
				$GLOBALS["Checkin_grid"] = new Checkin_grid(); // Get detail page object
			$GLOBALS["Checkin_grid"]->validateGridForm();
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

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;

		// Check if valid User ID
		$validUser = FALSE;
		if ($Security->currentUserID() != "" && !EmptyValue($this->ID_Restaurant->CurrentValue) && !$Security->isAdmin()) { // Non system admin
			$validUser = $Security->isValidUserID($this->ID_Restaurant->CurrentValue);
			if (!$validUser) {
				$userIdMsg = str_replace("%c", CurrentUserID(), $Language->phrase("UnAuthorizedUserID"));
				$userIdMsg = str_replace("%u", $this->ID_Restaurant->CurrentValue, $userIdMsg);
				$this->setFailureMessage($userIdMsg);
				return FALSE;
			}
		}
		$conn = $this->getConnection();

		// Begin transaction
		if ($this->getCurrentDetailTable() != "")
			$conn->beginTrans();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// ID_Restaurant
		$this->ID_Restaurant->setDbValueDef($rsnew, $this->ID_Restaurant->CurrentValue, NULL, FALSE);

		// FirstName
		$this->FirstName->setDbValueDef($rsnew, $this->FirstName->CurrentValue, NULL, FALSE);

		// LastName
		$this->LastName->setDbValueDef($rsnew, $this->LastName->CurrentValue, NULL, FALSE);

		// Email
		$this->_Email->setDbValueDef($rsnew, $this->_Email->CurrentValue, NULL, FALSE);

		// Hashpass
		$this->Hashpass->setDbValueDef($rsnew, $this->Hashpass->CurrentValue, NULL, FALSE);

		// Phone
		$this->Phone->setDbValueDef($rsnew, $this->Phone->CurrentValue, NULL, FALSE);

		// Banned
		$this->Banned->setDbValueDef($rsnew, $this->Banned->CurrentValue, NULL, FALSE);

		// Comments
		$this->Comments->setDbValueDef($rsnew, $this->Comments->CurrentValue, NULL, FALSE);

		// ClientToken
		$this->ClientToken->setDbValueDef($rsnew, $this->ClientToken->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);
		if ($insertRow) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			$addRow = $this->insert($rsnew);
			$conn->raiseErrorFn = "";
			if ($addRow) {
			}
		} else {
			if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage != "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("InsertCancelled"));
			}
			$addRow = FALSE;
		}

		// Add detail records
		if ($addRow) {
			$detailTblVar = explode(",", $this->getCurrentDetailTable());
			if (in_array("Pedido", $detailTblVar) && $GLOBALS["Pedido"]->DetailAdd) {
				$GLOBALS["Pedido"]->ID_Client->setSessionValue($this->ID->CurrentValue); // Set master key
				if (!isset($GLOBALS["Pedido_grid"]))
					$GLOBALS["Pedido_grid"] = new Pedido_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "Pedido"); // Load user level of detail table
				$addRow = $GLOBALS["Pedido_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow) {
					$GLOBALS["Pedido"]->ID_Client->setSessionValue(""); // Clear master key if insert failed
				}
			}
			if (in_array("Checkin", $detailTblVar) && $GLOBALS["Checkin"]->DetailAdd) {
				$GLOBALS["Checkin"]->ID_Client->setSessionValue($this->ID->CurrentValue); // Set master key
				if (!isset($GLOBALS["Checkin_grid"]))
					$GLOBALS["Checkin_grid"] = new Checkin_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "Checkin"); // Load user level of detail table
				$addRow = $GLOBALS["Checkin_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow) {
					$GLOBALS["Checkin"]->ID_Client->setSessionValue(""); // Clear master key if insert failed
				}
			}
		}

		// Commit/Rollback transaction
		if ($this->getCurrentDetailTable() != "") {
			if ($addRow) {
				$conn->commitTrans(); // Commit transaction
			} else {
				$conn->rollbackTrans(); // Rollback transaction
			}
		}
		if ($addRow) {

			// Call Row Inserted event
			$rs = ($rsold) ? $rsold->fields : NULL;
			$this->Row_Inserted($rs, $rsnew);
		}

		// Clean upload path if any
		if ($addRow) {
		}

		// Write JSON for API request
		if (IsApi() && $addRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $addRow;
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
			if ($masterTblVar == "Restaurant") {
				$validMaster = TRUE;
				if (($parm = Get("fk_ID", Get("ID_Restaurant"))) !== NULL) {
					$GLOBALS["Restaurant"]->ID->setQueryStringValue($parm);
					$this->ID_Restaurant->setQueryStringValue($GLOBALS["Restaurant"]->ID->QueryStringValue);
					$this->ID_Restaurant->setSessionValue($this->ID_Restaurant->QueryStringValue);
					if (!is_numeric($GLOBALS["Restaurant"]->ID->QueryStringValue))
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
			if ($masterTblVar == "Restaurant") {
				$validMaster = TRUE;
				if (($parm = Post("fk_ID", Post("ID_Restaurant"))) !== NULL) {
					$GLOBALS["Restaurant"]->ID->setFormValue($parm);
					$this->ID_Restaurant->setFormValue($GLOBALS["Restaurant"]->ID->FormValue);
					$this->ID_Restaurant->setSessionValue($this->ID_Restaurant->FormValue);
					if (!is_numeric($GLOBALS["Restaurant"]->ID->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
		}
		if ($validMaster) {

			// Save current master table
			$this->setCurrentMasterTable($masterTblVar);

			// Reset start record counter (new master key)
			if (!$this->isAddOrEdit()) {
				$this->StartRecord = 1;
				$this->setStartRecordNumber($this->StartRecord);
			}

			// Clear previous master key from Session
			if ($masterTblVar != "Restaurant") {
				if ($this->ID_Restaurant->CurrentValue == "")
					$this->ID_Restaurant->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $this->getMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Get detail filter
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
			if (in_array("Pedido", $detailTblVar)) {
				if (!isset($GLOBALS["Pedido_grid"]))
					$GLOBALS["Pedido_grid"] = new Pedido_grid();
				if ($GLOBALS["Pedido_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["Pedido_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["Pedido_grid"]->CurrentMode = "add";
					$GLOBALS["Pedido_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["Pedido_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["Pedido_grid"]->setStartRecordNumber(1);
					$GLOBALS["Pedido_grid"]->ID_Client->IsDetailKey = TRUE;
					$GLOBALS["Pedido_grid"]->ID_Client->CurrentValue = $this->ID->CurrentValue;
					$GLOBALS["Pedido_grid"]->ID_Client->setSessionValue($GLOBALS["Pedido_grid"]->ID_Client->CurrentValue);
				}
			}
			if (in_array("Checkin", $detailTblVar)) {
				if (!isset($GLOBALS["Checkin_grid"]))
					$GLOBALS["Checkin_grid"] = new Checkin_grid();
				if ($GLOBALS["Checkin_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["Checkin_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["Checkin_grid"]->CurrentMode = "add";
					$GLOBALS["Checkin_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["Checkin_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["Checkin_grid"]->setStartRecordNumber(1);
					$GLOBALS["Checkin_grid"]->ID_Client->IsDetailKey = TRUE;
					$GLOBALS["Checkin_grid"]->ID_Client->CurrentValue = $this->ID->CurrentValue;
					$GLOBALS["Checkin_grid"]->ID_Client->setSessionValue($GLOBALS["Checkin_grid"]->ID_Client->CurrentValue);
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("Clientlist.php"), "", $this->TableVar, TRUE);
		$pageId = ($this->isCopy()) ? "Copy" : "Add";
		$Breadcrumb->add("add", $pageId, $url);
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
				case "x_ID_Restaurant":
					break;
				case "x_Banned":
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