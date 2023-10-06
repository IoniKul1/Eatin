<?php
namespace PHPMaker2020\BACKOFFICE_CADETERIAS;

/**
 * Page class
 */
class Cadeteria_add extends Cadeteria
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{68D35137-1670-419B-B841-52FFD5E14A4B}";

	// Table name
	public $TableName = 'Cadeteria';

	// Page object name
	public $PageObjName = "Cadeteria_add";

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

		// Table object (Cadeteria)
		if (!isset($GLOBALS["Cadeteria"]) || get_class($GLOBALS["Cadeteria"]) == PROJECT_NAMESPACE . "Cadeteria") {
			$GLOBALS["Cadeteria"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["Cadeteria"];
		}

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'Cadeteria');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = $this->getConnection();

		// User table object (Cadeteria)
		$UserTable = $UserTable ?: new Cadeteria();
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
		global $Cadeteria;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($Cadeteria);
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
					if ($pageName == "Cadeteriaview.php")
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
					$this->terminate(GetUrl("Cadeterialist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
			if ($Security->isLoggedIn()) {
				$Security->UserID_Loading();
				$Security->loadUserID();
				$Security->UserID_Loaded();
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->ID->Visible = FALSE;
		$this->ID_Status->setVisibility();
		$this->Nombre->setVisibility();
		$this->Lat->setVisibility();
		$this->Lon->setVisibility();
		$this->_Email->setVisibility();
		$this->Hashpass->setVisibility();
		$this->fMult1->setVisibility();
		$this->fMult2->setVisibility();
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

		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("Cadeterialist.php");
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

		// Load form values
		if ($postBack) {
			$this->loadFormValues(); // Load form values
		}

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
					$this->terminate("Cadeterialist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "Cadeterialist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "Cadeteriaview.php")
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
		$this->ID_Status->CurrentValue = NULL;
		$this->ID_Status->OldValue = $this->ID_Status->CurrentValue;
		$this->Nombre->CurrentValue = NULL;
		$this->Nombre->OldValue = $this->Nombre->CurrentValue;
		$this->Lat->CurrentValue = NULL;
		$this->Lat->OldValue = $this->Lat->CurrentValue;
		$this->Lon->CurrentValue = NULL;
		$this->Lon->OldValue = $this->Lon->CurrentValue;
		$this->_Email->CurrentValue = NULL;
		$this->_Email->OldValue = $this->_Email->CurrentValue;
		$this->Hashpass->CurrentValue = NULL;
		$this->Hashpass->OldValue = $this->Hashpass->CurrentValue;
		$this->fMult1->CurrentValue = 1;
		$this->fMult2->CurrentValue = 1;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'ID_Status' first before field var 'x_ID_Status'
		$val = $CurrentForm->hasValue("ID_Status") ? $CurrentForm->getValue("ID_Status") : $CurrentForm->getValue("x_ID_Status");
		if (!$this->ID_Status->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ID_Status->Visible = FALSE; // Disable update for API request
			else
				$this->ID_Status->setFormValue($val);
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
				if (Config("ENCRYPTED_PASSWORD")) // Encrypted password, use raw value
					$this->Hashpass->setRawFormValue($val);
				else
					$this->Hashpass->setFormValue($val);
		}

		// Check field name 'fMult1' first before field var 'x_fMult1'
		$val = $CurrentForm->hasValue("fMult1") ? $CurrentForm->getValue("fMult1") : $CurrentForm->getValue("x_fMult1");
		if (!$this->fMult1->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->fMult1->Visible = FALSE; // Disable update for API request
			else
				$this->fMult1->setFormValue($val);
		}

		// Check field name 'fMult2' first before field var 'x_fMult2'
		$val = $CurrentForm->hasValue("fMult2") ? $CurrentForm->getValue("fMult2") : $CurrentForm->getValue("x_fMult2");
		if (!$this->fMult2->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->fMult2->Visible = FALSE; // Disable update for API request
			else
				$this->fMult2->setFormValue($val);
		}

		// Check field name 'ID' first before field var 'x_ID'
		$val = $CurrentForm->hasValue("ID") ? $CurrentForm->getValue("ID") : $CurrentForm->getValue("x_ID");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->ID_Status->CurrentValue = $this->ID_Status->FormValue;
		$this->Nombre->CurrentValue = $this->Nombre->FormValue;
		$this->Lat->CurrentValue = $this->Lat->FormValue;
		$this->Lon->CurrentValue = $this->Lon->FormValue;
		$this->_Email->CurrentValue = $this->_Email->FormValue;
		$this->Hashpass->CurrentValue = $this->Hashpass->FormValue;
		$this->fMult1->CurrentValue = $this->fMult1->FormValue;
		$this->fMult2->CurrentValue = $this->fMult2->FormValue;
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
		$this->ID_Status->setDbValue($row['ID_Status']);
		$this->Nombre->setDbValue($row['Nombre']);
		$this->Lat->setDbValue($row['Lat']);
		$this->Lon->setDbValue($row['Lon']);
		$this->_Email->setDbValue($row['Email']);
		$this->Hashpass->setDbValue($row['Hashpass']);
		$this->fMult1->setDbValue($row['fMult1']);
		$this->fMult2->setDbValue($row['fMult2']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['ID'] = $this->ID->CurrentValue;
		$row['ID_Status'] = $this->ID_Status->CurrentValue;
		$row['Nombre'] = $this->Nombre->CurrentValue;
		$row['Lat'] = $this->Lat->CurrentValue;
		$row['Lon'] = $this->Lon->CurrentValue;
		$row['Email'] = $this->_Email->CurrentValue;
		$row['Hashpass'] = $this->Hashpass->CurrentValue;
		$row['fMult1'] = $this->fMult1->CurrentValue;
		$row['fMult2'] = $this->fMult2->CurrentValue;
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

		// Convert decimal values if posted back
		if ($this->fMult1->FormValue == $this->fMult1->CurrentValue && is_numeric(ConvertToFloatString($this->fMult1->CurrentValue)))
			$this->fMult1->CurrentValue = ConvertToFloatString($this->fMult1->CurrentValue);

		// Convert decimal values if posted back
		if ($this->fMult2->FormValue == $this->fMult2->CurrentValue && is_numeric(ConvertToFloatString($this->fMult2->CurrentValue)))
			$this->fMult2->CurrentValue = ConvertToFloatString($this->fMult2->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// ID
		// ID_Status
		// Nombre
		// Lat
		// Lon
		// Email
		// Hashpass
		// fMult1
		// fMult2

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// ID
			$this->ID->ViewValue = $this->ID->CurrentValue;
			$this->ID->ViewCustomAttributes = "";

			// ID_Status
			$this->ID_Status->ViewValue = $this->ID_Status->CurrentValue;
			$this->ID_Status->ViewValue = FormatNumber($this->ID_Status->ViewValue, 0, -2, -2, -2);
			$this->ID_Status->ViewCustomAttributes = "";

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

			// Email
			$this->_Email->ViewValue = $this->_Email->CurrentValue;
			$this->_Email->ViewCustomAttributes = "";

			// Hashpass
			$this->Hashpass->ViewValue = $this->Hashpass->CurrentValue;
			$this->Hashpass->ViewCustomAttributes = "";

			// fMult1
			$this->fMult1->ViewValue = $this->fMult1->CurrentValue;
			$this->fMult1->ViewValue = FormatNumber($this->fMult1->ViewValue, 2, -2, -2, -2);
			$this->fMult1->ViewCustomAttributes = "";

			// fMult2
			$this->fMult2->ViewValue = $this->fMult2->CurrentValue;
			$this->fMult2->ViewValue = FormatNumber($this->fMult2->ViewValue, 2, -2, -2, -2);
			$this->fMult2->ViewCustomAttributes = "";

			// ID_Status
			$this->ID_Status->LinkCustomAttributes = "";
			$this->ID_Status->HrefValue = "";
			$this->ID_Status->TooltipValue = "";

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

			// Email
			$this->_Email->LinkCustomAttributes = "";
			$this->_Email->HrefValue = "";
			$this->_Email->TooltipValue = "";

			// Hashpass
			$this->Hashpass->LinkCustomAttributes = "";
			$this->Hashpass->HrefValue = "";
			$this->Hashpass->TooltipValue = "";

			// fMult1
			$this->fMult1->LinkCustomAttributes = "";
			$this->fMult1->HrefValue = "";
			$this->fMult1->TooltipValue = "";

			// fMult2
			$this->fMult2->LinkCustomAttributes = "";
			$this->fMult2->HrefValue = "";
			$this->fMult2->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// ID_Status
			$this->ID_Status->EditAttrs["class"] = "form-control";
			$this->ID_Status->EditCustomAttributes = "";
			$this->ID_Status->EditValue = HtmlEncode($this->ID_Status->CurrentValue);
			$this->ID_Status->PlaceHolder = RemoveHtml($this->ID_Status->caption());

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

			// fMult1
			$this->fMult1->EditAttrs["class"] = "form-control";
			$this->fMult1->EditCustomAttributes = "";
			$this->fMult1->EditValue = HtmlEncode($this->fMult1->CurrentValue);
			$this->fMult1->PlaceHolder = RemoveHtml($this->fMult1->caption());
			if (strval($this->fMult1->EditValue) != "" && is_numeric($this->fMult1->EditValue))
				$this->fMult1->EditValue = FormatNumber($this->fMult1->EditValue, -2, -2, -2, -2);
			

			// fMult2
			$this->fMult2->EditAttrs["class"] = "form-control";
			$this->fMult2->EditCustomAttributes = "";
			$this->fMult2->EditValue = HtmlEncode($this->fMult2->CurrentValue);
			$this->fMult2->PlaceHolder = RemoveHtml($this->fMult2->caption());
			if (strval($this->fMult2->EditValue) != "" && is_numeric($this->fMult2->EditValue))
				$this->fMult2->EditValue = FormatNumber($this->fMult2->EditValue, -2, -2, -2, -2);
			

			// Add refer script
			// ID_Status

			$this->ID_Status->LinkCustomAttributes = "";
			$this->ID_Status->HrefValue = "";

			// Nombre
			$this->Nombre->LinkCustomAttributes = "";
			$this->Nombre->HrefValue = "";

			// Lat
			$this->Lat->LinkCustomAttributes = "";
			$this->Lat->HrefValue = "";

			// Lon
			$this->Lon->LinkCustomAttributes = "";
			$this->Lon->HrefValue = "";

			// Email
			$this->_Email->LinkCustomAttributes = "";
			$this->_Email->HrefValue = "";

			// Hashpass
			$this->Hashpass->LinkCustomAttributes = "";
			$this->Hashpass->HrefValue = "";

			// fMult1
			$this->fMult1->LinkCustomAttributes = "";
			$this->fMult1->HrefValue = "";

			// fMult2
			$this->fMult2->LinkCustomAttributes = "";
			$this->fMult2->HrefValue = "";
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
		if ($this->ID_Status->Required) {
			if (!$this->ID_Status->IsDetailKey && $this->ID_Status->FormValue != NULL && $this->ID_Status->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ID_Status->caption(), $this->ID_Status->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->ID_Status->FormValue)) {
			AddMessage($FormError, $this->ID_Status->errorMessage());
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
		if ($this->fMult1->Required) {
			if (!$this->fMult1->IsDetailKey && $this->fMult1->FormValue != NULL && $this->fMult1->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->fMult1->caption(), $this->fMult1->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->fMult1->FormValue)) {
			AddMessage($FormError, $this->fMult1->errorMessage());
		}
		if ($this->fMult2->Required) {
			if (!$this->fMult2->IsDetailKey && $this->fMult2->FormValue != NULL && $this->fMult2->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->fMult2->caption(), $this->fMult2->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->fMult2->FormValue)) {
			AddMessage($FormError, $this->fMult2->errorMessage());
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
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// ID_Status
		$this->ID_Status->setDbValueDef($rsnew, $this->ID_Status->CurrentValue, 0, FALSE);

		// Nombre
		$this->Nombre->setDbValueDef($rsnew, $this->Nombre->CurrentValue, "", FALSE);

		// Lat
		$this->Lat->setDbValueDef($rsnew, $this->Lat->CurrentValue, 0, FALSE);

		// Lon
		$this->Lon->setDbValueDef($rsnew, $this->Lon->CurrentValue, 0, FALSE);

		// Email
		$this->_Email->setDbValueDef($rsnew, $this->_Email->CurrentValue, "", FALSE);

		// Hashpass
		$this->Hashpass->setDbValueDef($rsnew, $this->Hashpass->CurrentValue, "", FALSE);

		// fMult1
		$this->fMult1->setDbValueDef($rsnew, $this->fMult1->CurrentValue, 0, strval($this->fMult1->CurrentValue) == "");

		// fMult2
		$this->fMult2->setDbValueDef($rsnew, $this->fMult2->CurrentValue, 0, strval($this->fMult2->CurrentValue) == "");

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

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("Cadeterialist.php"), "", $this->TableVar, TRUE);
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