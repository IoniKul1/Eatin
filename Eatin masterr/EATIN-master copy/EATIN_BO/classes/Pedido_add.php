<?php
namespace PHPMaker2020\EATIN_BO;

/**
 * Page class
 */
class Pedido_add extends Pedido
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{CC19BE4C-23D6-4992-89EF-6304995797F2}";

	// Table name
	public $TableName = 'Pedido';

	// Page object name
	public $PageObjName = "Pedido_add";

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

		// Table object (Pedido)
		if (!isset($GLOBALS["Pedido"]) || get_class($GLOBALS["Pedido"]) == PROJECT_NAMESPACE . "Pedido") {
			$GLOBALS["Pedido"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["Pedido"];
		}

		// Table object (Client)
		if (!isset($GLOBALS['Client']))
			$GLOBALS['Client'] = new Client();

		// Table object (Restaurant)
		if (!isset($GLOBALS['Restaurant']))
			$GLOBALS['Restaurant'] = new Restaurant();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'Pedido');

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
		global $Pedido;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($Pedido);
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
					if ($pageName == "Pedidoview.php")
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
					$this->terminate(GetUrl("Pedidolist.php"));
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
					$this->terminate(GetUrl("Pedidolist.php"));
					return;
				}
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->ID->Visible = FALSE;
		$this->ID_Client->setVisibility();
		$this->ID_Status->setVisibility();
		$this->ID_Restaurant->setVisibility();
		$this->DateCreation->setVisibility();
		$this->DateLastUpdate->setVisibility();
		$this->ID_Table->setVisibility();
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
			$this->terminate("Pedidolist.php");
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
					$this->terminate("Pedidolist.php"); // No matching record, return to list
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
					if (GetPageName($returnUrl) == "Pedidolist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "Pedidoview.php")
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
		$this->ID_Client->CurrentValue = NULL;
		$this->ID_Client->OldValue = $this->ID_Client->CurrentValue;
		$this->ID_Status->CurrentValue = NULL;
		$this->ID_Status->OldValue = $this->ID_Status->CurrentValue;
		$this->ID_Restaurant->CurrentValue = CurrentUserID();
		$this->DateCreation->CurrentValue = NULL;
		$this->DateCreation->OldValue = $this->DateCreation->CurrentValue;
		$this->DateLastUpdate->CurrentValue = NULL;
		$this->DateLastUpdate->OldValue = $this->DateLastUpdate->CurrentValue;
		$this->ID_Table->CurrentValue = NULL;
		$this->ID_Table->OldValue = $this->ID_Table->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'ID_Client' first before field var 'x_ID_Client'
		$val = $CurrentForm->hasValue("ID_Client") ? $CurrentForm->getValue("ID_Client") : $CurrentForm->getValue("x_ID_Client");
		if (!$this->ID_Client->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ID_Client->Visible = FALSE; // Disable update for API request
			else
				$this->ID_Client->setFormValue($val);
		}

		// Check field name 'ID_Status' first before field var 'x_ID_Status'
		$val = $CurrentForm->hasValue("ID_Status") ? $CurrentForm->getValue("ID_Status") : $CurrentForm->getValue("x_ID_Status");
		if (!$this->ID_Status->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ID_Status->Visible = FALSE; // Disable update for API request
			else
				$this->ID_Status->setFormValue($val);
		}

		// Check field name 'ID_Restaurant' first before field var 'x_ID_Restaurant'
		$val = $CurrentForm->hasValue("ID_Restaurant") ? $CurrentForm->getValue("ID_Restaurant") : $CurrentForm->getValue("x_ID_Restaurant");
		if (!$this->ID_Restaurant->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ID_Restaurant->Visible = FALSE; // Disable update for API request
			else
				$this->ID_Restaurant->setFormValue($val);
		}

		// Check field name 'DateCreation' first before field var 'x_DateCreation'
		$val = $CurrentForm->hasValue("DateCreation") ? $CurrentForm->getValue("DateCreation") : $CurrentForm->getValue("x_DateCreation");
		if (!$this->DateCreation->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->DateCreation->Visible = FALSE; // Disable update for API request
			else
				$this->DateCreation->setFormValue($val);
			$this->DateCreation->CurrentValue = UnFormatDateTime($this->DateCreation->CurrentValue, 0);
		}

		// Check field name 'DateLastUpdate' first before field var 'x_DateLastUpdate'
		$val = $CurrentForm->hasValue("DateLastUpdate") ? $CurrentForm->getValue("DateLastUpdate") : $CurrentForm->getValue("x_DateLastUpdate");
		if (!$this->DateLastUpdate->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->DateLastUpdate->Visible = FALSE; // Disable update for API request
			else
				$this->DateLastUpdate->setFormValue($val);
			$this->DateLastUpdate->CurrentValue = UnFormatDateTime($this->DateLastUpdate->CurrentValue, 0);
		}

		// Check field name 'ID_Table' first before field var 'x_ID_Table'
		$val = $CurrentForm->hasValue("ID_Table") ? $CurrentForm->getValue("ID_Table") : $CurrentForm->getValue("x_ID_Table");
		if (!$this->ID_Table->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ID_Table->Visible = FALSE; // Disable update for API request
			else
				$this->ID_Table->setFormValue($val);
		}

		// Check field name 'ID' first before field var 'x_ID'
		$val = $CurrentForm->hasValue("ID") ? $CurrentForm->getValue("ID") : $CurrentForm->getValue("x_ID");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->ID_Client->CurrentValue = $this->ID_Client->FormValue;
		$this->ID_Status->CurrentValue = $this->ID_Status->FormValue;
		$this->ID_Restaurant->CurrentValue = $this->ID_Restaurant->FormValue;
		$this->DateCreation->CurrentValue = $this->DateCreation->FormValue;
		$this->DateCreation->CurrentValue = UnFormatDateTime($this->DateCreation->CurrentValue, 0);
		$this->DateLastUpdate->CurrentValue = $this->DateLastUpdate->FormValue;
		$this->DateLastUpdate->CurrentValue = UnFormatDateTime($this->DateLastUpdate->CurrentValue, 0);
		$this->ID_Table->CurrentValue = $this->ID_Table->FormValue;
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
		$this->ID_Client->setDbValue($row['ID_Client']);
		$this->ID_Status->setDbValue($row['ID_Status']);
		$this->ID_Restaurant->setDbValue($row['ID_Restaurant']);
		$this->DateCreation->setDbValue($row['DateCreation']);
		$this->DateLastUpdate->setDbValue($row['DateLastUpdate']);
		$this->ID_Table->setDbValue($row['ID_Table']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['ID'] = $this->ID->CurrentValue;
		$row['ID_Client'] = $this->ID_Client->CurrentValue;
		$row['ID_Status'] = $this->ID_Status->CurrentValue;
		$row['ID_Restaurant'] = $this->ID_Restaurant->CurrentValue;
		$row['DateCreation'] = $this->DateCreation->CurrentValue;
		$row['DateLastUpdate'] = $this->DateLastUpdate->CurrentValue;
		$row['ID_Table'] = $this->ID_Table->CurrentValue;
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
		// ID_Client
		// ID_Status
		// ID_Restaurant
		// DateCreation
		// DateLastUpdate
		// ID_Table

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// ID
			$this->ID->ViewValue = $this->ID->CurrentValue;
			$this->ID->ViewCustomAttributes = "";

			// ID_Client
			$this->ID_Client->ViewValue = $this->ID_Client->CurrentValue;
			$this->ID_Client->ViewValue = FormatNumber($this->ID_Client->ViewValue, 0, -2, -2, -2);
			$this->ID_Client->ViewCustomAttributes = "";

			// ID_Status
			$this->ID_Status->ViewValue = $this->ID_Status->CurrentValue;
			$this->ID_Status->ViewValue = FormatNumber($this->ID_Status->ViewValue, 0, -2, -2, -2);
			$this->ID_Status->ViewCustomAttributes = "";

			// ID_Restaurant
			$this->ID_Restaurant->ViewValue = $this->ID_Restaurant->CurrentValue;
			$this->ID_Restaurant->ViewValue = FormatNumber($this->ID_Restaurant->ViewValue, 0, -2, -2, -2);
			$this->ID_Restaurant->ViewCustomAttributes = "";

			// DateCreation
			$this->DateCreation->ViewValue = $this->DateCreation->CurrentValue;
			$this->DateCreation->ViewValue = FormatDateTime($this->DateCreation->ViewValue, 0);
			$this->DateCreation->ViewCustomAttributes = "";

			// DateLastUpdate
			$this->DateLastUpdate->ViewValue = $this->DateLastUpdate->CurrentValue;
			$this->DateLastUpdate->ViewValue = FormatDateTime($this->DateLastUpdate->ViewValue, 0);
			$this->DateLastUpdate->ViewCustomAttributes = "";

			// ID_Table
			$this->ID_Table->ViewValue = $this->ID_Table->CurrentValue;
			$this->ID_Table->ViewValue = FormatNumber($this->ID_Table->ViewValue, 0, -2, -2, -2);
			$this->ID_Table->ViewCustomAttributes = "";

			// ID_Client
			$this->ID_Client->LinkCustomAttributes = "";
			$this->ID_Client->HrefValue = "";
			$this->ID_Client->TooltipValue = "";

			// ID_Status
			$this->ID_Status->LinkCustomAttributes = "";
			$this->ID_Status->HrefValue = "";
			$this->ID_Status->TooltipValue = "";

			// ID_Restaurant
			$this->ID_Restaurant->LinkCustomAttributes = "";
			$this->ID_Restaurant->HrefValue = "";
			$this->ID_Restaurant->TooltipValue = "";

			// DateCreation
			$this->DateCreation->LinkCustomAttributes = "";
			$this->DateCreation->HrefValue = "";
			$this->DateCreation->TooltipValue = "";

			// DateLastUpdate
			$this->DateLastUpdate->LinkCustomAttributes = "";
			$this->DateLastUpdate->HrefValue = "";
			$this->DateLastUpdate->TooltipValue = "";

			// ID_Table
			$this->ID_Table->LinkCustomAttributes = "";
			$this->ID_Table->HrefValue = "";
			$this->ID_Table->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// ID_Client
			$this->ID_Client->EditAttrs["class"] = "form-control";
			$this->ID_Client->EditCustomAttributes = "";
			if ($this->ID_Client->getSessionValue() != "") {
				$this->ID_Client->CurrentValue = $this->ID_Client->getSessionValue();
				$this->ID_Client->ViewValue = $this->ID_Client->CurrentValue;
				$this->ID_Client->ViewValue = FormatNumber($this->ID_Client->ViewValue, 0, -2, -2, -2);
				$this->ID_Client->ViewCustomAttributes = "";
			} else {
				$this->ID_Client->EditValue = HtmlEncode($this->ID_Client->CurrentValue);
				$this->ID_Client->PlaceHolder = RemoveHtml($this->ID_Client->caption());
			}

			// ID_Status
			$this->ID_Status->EditAttrs["class"] = "form-control";
			$this->ID_Status->EditCustomAttributes = "";
			$this->ID_Status->EditValue = HtmlEncode($this->ID_Status->CurrentValue);
			$this->ID_Status->PlaceHolder = RemoveHtml($this->ID_Status->caption());

			// ID_Restaurant
			$this->ID_Restaurant->EditAttrs["class"] = "form-control";
			$this->ID_Restaurant->EditCustomAttributes = "";
			if (!$Security->isAdmin() && $Security->isLoggedIn() && !$this->userIDAllow("add")) { // Non system admin
				$this->ID_Restaurant->CurrentValue = CurrentUserID();
				$this->ID_Restaurant->EditValue = $this->ID_Restaurant->CurrentValue;
				$this->ID_Restaurant->EditValue = FormatNumber($this->ID_Restaurant->EditValue, 0, -2, -2, -2);
				$this->ID_Restaurant->ViewCustomAttributes = "";
			} else {
				$this->ID_Restaurant->EditValue = HtmlEncode($this->ID_Restaurant->CurrentValue);
				$this->ID_Restaurant->PlaceHolder = RemoveHtml($this->ID_Restaurant->caption());
			}

			// DateCreation
			$this->DateCreation->EditAttrs["class"] = "form-control";
			$this->DateCreation->EditCustomAttributes = "";
			$this->DateCreation->EditValue = HtmlEncode(FormatDateTime($this->DateCreation->CurrentValue, 8));
			$this->DateCreation->PlaceHolder = RemoveHtml($this->DateCreation->caption());

			// DateLastUpdate
			$this->DateLastUpdate->EditAttrs["class"] = "form-control";
			$this->DateLastUpdate->EditCustomAttributes = "";
			$this->DateLastUpdate->EditValue = HtmlEncode(FormatDateTime($this->DateLastUpdate->CurrentValue, 8));
			$this->DateLastUpdate->PlaceHolder = RemoveHtml($this->DateLastUpdate->caption());

			// ID_Table
			$this->ID_Table->EditAttrs["class"] = "form-control";
			$this->ID_Table->EditCustomAttributes = "";
			$this->ID_Table->EditValue = HtmlEncode($this->ID_Table->CurrentValue);
			$this->ID_Table->PlaceHolder = RemoveHtml($this->ID_Table->caption());

			// Add refer script
			// ID_Client

			$this->ID_Client->LinkCustomAttributes = "";
			$this->ID_Client->HrefValue = "";

			// ID_Status
			$this->ID_Status->LinkCustomAttributes = "";
			$this->ID_Status->HrefValue = "";

			// ID_Restaurant
			$this->ID_Restaurant->LinkCustomAttributes = "";
			$this->ID_Restaurant->HrefValue = "";

			// DateCreation
			$this->DateCreation->LinkCustomAttributes = "";
			$this->DateCreation->HrefValue = "";

			// DateLastUpdate
			$this->DateLastUpdate->LinkCustomAttributes = "";
			$this->DateLastUpdate->HrefValue = "";

			// ID_Table
			$this->ID_Table->LinkCustomAttributes = "";
			$this->ID_Table->HrefValue = "";
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
		if ($this->ID_Client->Required) {
			if (!$this->ID_Client->IsDetailKey && $this->ID_Client->FormValue != NULL && $this->ID_Client->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ID_Client->caption(), $this->ID_Client->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->ID_Client->FormValue)) {
			AddMessage($FormError, $this->ID_Client->errorMessage());
		}
		if ($this->ID_Status->Required) {
			if (!$this->ID_Status->IsDetailKey && $this->ID_Status->FormValue != NULL && $this->ID_Status->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ID_Status->caption(), $this->ID_Status->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->ID_Status->FormValue)) {
			AddMessage($FormError, $this->ID_Status->errorMessage());
		}
		if ($this->ID_Restaurant->Required) {
			if (!$this->ID_Restaurant->IsDetailKey && $this->ID_Restaurant->FormValue != NULL && $this->ID_Restaurant->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ID_Restaurant->caption(), $this->ID_Restaurant->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->ID_Restaurant->FormValue)) {
			AddMessage($FormError, $this->ID_Restaurant->errorMessage());
		}
		if ($this->DateCreation->Required) {
			if (!$this->DateCreation->IsDetailKey && $this->DateCreation->FormValue != NULL && $this->DateCreation->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DateCreation->caption(), $this->DateCreation->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->DateCreation->FormValue)) {
			AddMessage($FormError, $this->DateCreation->errorMessage());
		}
		if ($this->DateLastUpdate->Required) {
			if (!$this->DateLastUpdate->IsDetailKey && $this->DateLastUpdate->FormValue != NULL && $this->DateLastUpdate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DateLastUpdate->caption(), $this->DateLastUpdate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->DateLastUpdate->FormValue)) {
			AddMessage($FormError, $this->DateLastUpdate->errorMessage());
		}
		if ($this->ID_Table->Required) {
			if (!$this->ID_Table->IsDetailKey && $this->ID_Table->FormValue != NULL && $this->ID_Table->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ID_Table->caption(), $this->ID_Table->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->ID_Table->FormValue)) {
			AddMessage($FormError, $this->ID_Table->errorMessage());
		}

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("ItemxPedido", $detailTblVar) && $GLOBALS["ItemxPedido"]->DetailAdd) {
			if (!isset($GLOBALS["ItemxPedido_grid"]))
				$GLOBALS["ItemxPedido_grid"] = new ItemxPedido_grid(); // Get detail page object
			$GLOBALS["ItemxPedido_grid"]->validateGridForm();
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

		// ID_Client
		$this->ID_Client->setDbValueDef($rsnew, $this->ID_Client->CurrentValue, 0, FALSE);

		// ID_Status
		$this->ID_Status->setDbValueDef($rsnew, $this->ID_Status->CurrentValue, 0, FALSE);

		// ID_Restaurant
		$this->ID_Restaurant->setDbValueDef($rsnew, $this->ID_Restaurant->CurrentValue, 0, FALSE);

		// DateCreation
		$this->DateCreation->setDbValueDef($rsnew, UnFormatDateTime($this->DateCreation->CurrentValue, 0), NULL, strval($this->DateCreation->CurrentValue) == "");

		// DateLastUpdate
		$this->DateLastUpdate->setDbValueDef($rsnew, UnFormatDateTime($this->DateLastUpdate->CurrentValue, 0), NULL, strval($this->DateLastUpdate->CurrentValue) == "");

		// ID_Table
		$this->ID_Table->setDbValueDef($rsnew, $this->ID_Table->CurrentValue, 0, FALSE);

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
			if (in_array("ItemxPedido", $detailTblVar) && $GLOBALS["ItemxPedido"]->DetailAdd) {
				$GLOBALS["ItemxPedido"]->ID_Item->setSessionValue($this->ID->CurrentValue); // Set master key
				if (!isset($GLOBALS["ItemxPedido_grid"]))
					$GLOBALS["ItemxPedido_grid"] = new ItemxPedido_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "ItemxPedido"); // Load user level of detail table
				$addRow = $GLOBALS["ItemxPedido_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow) {
					$GLOBALS["ItemxPedido"]->ID_Item->setSessionValue(""); // Clear master key if insert failed
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
			if ($masterTblVar == "Client") {
				$validMaster = TRUE;
				if (($parm = Get("fk_ID", Get("ID_Client"))) !== NULL) {
					$GLOBALS["Client"]->ID->setQueryStringValue($parm);
					$this->ID_Client->setQueryStringValue($GLOBALS["Client"]->ID->QueryStringValue);
					$this->ID_Client->setSessionValue($this->ID_Client->QueryStringValue);
					if (!is_numeric($GLOBALS["Client"]->ID->QueryStringValue))
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
			if ($masterTblVar == "Client") {
				$validMaster = TRUE;
				if (($parm = Post("fk_ID", Post("ID_Client"))) !== NULL) {
					$GLOBALS["Client"]->ID->setFormValue($parm);
					$this->ID_Client->setFormValue($GLOBALS["Client"]->ID->FormValue);
					$this->ID_Client->setSessionValue($this->ID_Client->FormValue);
					if (!is_numeric($GLOBALS["Client"]->ID->FormValue))
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
			if ($masterTblVar != "Client") {
				if ($this->ID_Client->CurrentValue == "")
					$this->ID_Client->setSessionValue("");
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
			if (in_array("ItemxPedido", $detailTblVar)) {
				if (!isset($GLOBALS["ItemxPedido_grid"]))
					$GLOBALS["ItemxPedido_grid"] = new ItemxPedido_grid();
				if ($GLOBALS["ItemxPedido_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["ItemxPedido_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["ItemxPedido_grid"]->CurrentMode = "add";
					$GLOBALS["ItemxPedido_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["ItemxPedido_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["ItemxPedido_grid"]->setStartRecordNumber(1);
					$GLOBALS["ItemxPedido_grid"]->ID_Item->IsDetailKey = TRUE;
					$GLOBALS["ItemxPedido_grid"]->ID_Item->CurrentValue = $this->ID->CurrentValue;
					$GLOBALS["ItemxPedido_grid"]->ID_Item->setSessionValue($GLOBALS["ItemxPedido_grid"]->ID_Item->CurrentValue);
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("Pedidolist.php"), "", $this->TableVar, TRUE);
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