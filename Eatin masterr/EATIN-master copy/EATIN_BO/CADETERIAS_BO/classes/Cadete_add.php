<?php
namespace PHPMaker2020\BACKOFFICE_CADETERIAS;

/**
 * Page class
 */
class Cadete_add extends Cadete
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{68D35137-1670-419B-B841-52FFD5E14A4B}";

	// Table name
	public $TableName = 'Cadete';

	// Page object name
	public $PageObjName = "Cadete_add";

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

		// Table object (Cadete)
		if (!isset($GLOBALS["Cadete"]) || get_class($GLOBALS["Cadete"]) == PROJECT_NAMESPACE . "Cadete") {
			$GLOBALS["Cadete"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["Cadete"];
		}

		// Table object (Cadeteria)
		if (!isset($GLOBALS['Cadeteria']))
			$GLOBALS['Cadeteria'] = new Cadeteria();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'Cadete');

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
		global $Cadete;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($Cadete);
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
					if ($pageName == "Cadeteview.php")
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
					$this->terminate(GetUrl("Cadetelist.php"));
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
					$this->terminate(GetUrl("Cadetelist.php"));
					return;
				}
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->ID->Visible = FALSE;
		$this->FechaCreacion->setVisibility();
		$this->ID_Cadeteria->setVisibility();
		$this->ID_Status->setVisibility();
		$this->ID_CurrentStatus->setVisibility();
		$this->Nombre->setVisibility();
		$this->Apellido->setVisibility();
		$this->DNI->setVisibility();
		$this->Celular->setVisibility();
		$this->Domicilio->setVisibility();
		$this->RealLat->setVisibility();
		$this->RealLon->setVisibility();
		$this->EstimatedLat->setVisibility();
		$this->EstimatedLon->setVisibility();
		$this->LUDesde->setVisibility();
		$this->LUHasta->setVisibility();
		$this->MADesde->setVisibility();
		$this->MAHasta->setVisibility();
		$this->MIEDesde->setVisibility();
		$this->MIEHasta->setVisibility();
		$this->JUEDesde->setVisibility();
		$this->JUEHasta->setVisibility();
		$this->VIEDesde->setVisibility();
		$this->VIEHasta->setVisibility();
		$this->SABDesde->setVisibility();
		$this->SABHasta->setVisibility();
		$this->DOMDesde->setVisibility();
		$this->DOMHasta->setVisibility();
		$this->Foto->setVisibility();
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
			$this->terminate("Cadetelist.php");
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
					$this->terminate("Cadetelist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "Cadetelist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "Cadeteview.php")
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
		$this->FechaCreacion->CurrentValue = "getdate()";
		$this->ID_Cadeteria->CurrentValue = CurrentUserID();
		$this->ID_Status->CurrentValue = NULL;
		$this->ID_Status->OldValue = $this->ID_Status->CurrentValue;
		$this->ID_CurrentStatus->CurrentValue = NULL;
		$this->ID_CurrentStatus->OldValue = $this->ID_CurrentStatus->CurrentValue;
		$this->Nombre->CurrentValue = NULL;
		$this->Nombre->OldValue = $this->Nombre->CurrentValue;
		$this->Apellido->CurrentValue = NULL;
		$this->Apellido->OldValue = $this->Apellido->CurrentValue;
		$this->DNI->CurrentValue = NULL;
		$this->DNI->OldValue = $this->DNI->CurrentValue;
		$this->Celular->CurrentValue = NULL;
		$this->Celular->OldValue = $this->Celular->CurrentValue;
		$this->Domicilio->CurrentValue = NULL;
		$this->Domicilio->OldValue = $this->Domicilio->CurrentValue;
		$this->RealLat->CurrentValue = NULL;
		$this->RealLat->OldValue = $this->RealLat->CurrentValue;
		$this->RealLon->CurrentValue = NULL;
		$this->RealLon->OldValue = $this->RealLon->CurrentValue;
		$this->EstimatedLat->CurrentValue = NULL;
		$this->EstimatedLat->OldValue = $this->EstimatedLat->CurrentValue;
		$this->EstimatedLon->CurrentValue = NULL;
		$this->EstimatedLon->OldValue = $this->EstimatedLon->CurrentValue;
		$this->LUDesde->CurrentValue = NULL;
		$this->LUDesde->OldValue = $this->LUDesde->CurrentValue;
		$this->LUHasta->CurrentValue = NULL;
		$this->LUHasta->OldValue = $this->LUHasta->CurrentValue;
		$this->MADesde->CurrentValue = NULL;
		$this->MADesde->OldValue = $this->MADesde->CurrentValue;
		$this->MAHasta->CurrentValue = NULL;
		$this->MAHasta->OldValue = $this->MAHasta->CurrentValue;
		$this->MIEDesde->CurrentValue = NULL;
		$this->MIEDesde->OldValue = $this->MIEDesde->CurrentValue;
		$this->MIEHasta->CurrentValue = NULL;
		$this->MIEHasta->OldValue = $this->MIEHasta->CurrentValue;
		$this->JUEDesde->CurrentValue = NULL;
		$this->JUEDesde->OldValue = $this->JUEDesde->CurrentValue;
		$this->JUEHasta->CurrentValue = NULL;
		$this->JUEHasta->OldValue = $this->JUEHasta->CurrentValue;
		$this->VIEDesde->CurrentValue = NULL;
		$this->VIEDesde->OldValue = $this->VIEDesde->CurrentValue;
		$this->VIEHasta->CurrentValue = NULL;
		$this->VIEHasta->OldValue = $this->VIEHasta->CurrentValue;
		$this->SABDesde->CurrentValue = NULL;
		$this->SABDesde->OldValue = $this->SABDesde->CurrentValue;
		$this->SABHasta->CurrentValue = NULL;
		$this->SABHasta->OldValue = $this->SABHasta->CurrentValue;
		$this->DOMDesde->CurrentValue = NULL;
		$this->DOMDesde->OldValue = $this->DOMDesde->CurrentValue;
		$this->DOMHasta->CurrentValue = NULL;
		$this->DOMHasta->OldValue = $this->DOMHasta->CurrentValue;
		$this->Foto->CurrentValue = NULL;
		$this->Foto->OldValue = $this->Foto->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'FechaCreacion' first before field var 'x_FechaCreacion'
		$val = $CurrentForm->hasValue("FechaCreacion") ? $CurrentForm->getValue("FechaCreacion") : $CurrentForm->getValue("x_FechaCreacion");
		if (!$this->FechaCreacion->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->FechaCreacion->Visible = FALSE; // Disable update for API request
			else
				$this->FechaCreacion->setFormValue($val);
			$this->FechaCreacion->CurrentValue = UnFormatDateTime($this->FechaCreacion->CurrentValue, 0);
		}

		// Check field name 'ID_Cadeteria' first before field var 'x_ID_Cadeteria'
		$val = $CurrentForm->hasValue("ID_Cadeteria") ? $CurrentForm->getValue("ID_Cadeteria") : $CurrentForm->getValue("x_ID_Cadeteria");
		if (!$this->ID_Cadeteria->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ID_Cadeteria->Visible = FALSE; // Disable update for API request
			else
				$this->ID_Cadeteria->setFormValue($val);
		}

		// Check field name 'ID_Status' first before field var 'x_ID_Status'
		$val = $CurrentForm->hasValue("ID_Status") ? $CurrentForm->getValue("ID_Status") : $CurrentForm->getValue("x_ID_Status");
		if (!$this->ID_Status->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ID_Status->Visible = FALSE; // Disable update for API request
			else
				$this->ID_Status->setFormValue($val);
		}

		// Check field name 'ID_CurrentStatus' first before field var 'x_ID_CurrentStatus'
		$val = $CurrentForm->hasValue("ID_CurrentStatus") ? $CurrentForm->getValue("ID_CurrentStatus") : $CurrentForm->getValue("x_ID_CurrentStatus");
		if (!$this->ID_CurrentStatus->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ID_CurrentStatus->Visible = FALSE; // Disable update for API request
			else
				$this->ID_CurrentStatus->setFormValue($val);
		}

		// Check field name 'Nombre' first before field var 'x_Nombre'
		$val = $CurrentForm->hasValue("Nombre") ? $CurrentForm->getValue("Nombre") : $CurrentForm->getValue("x_Nombre");
		if (!$this->Nombre->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Nombre->Visible = FALSE; // Disable update for API request
			else
				$this->Nombre->setFormValue($val);
		}

		// Check field name 'Apellido' first before field var 'x_Apellido'
		$val = $CurrentForm->hasValue("Apellido") ? $CurrentForm->getValue("Apellido") : $CurrentForm->getValue("x_Apellido");
		if (!$this->Apellido->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Apellido->Visible = FALSE; // Disable update for API request
			else
				$this->Apellido->setFormValue($val);
		}

		// Check field name 'DNI' first before field var 'x_DNI'
		$val = $CurrentForm->hasValue("DNI") ? $CurrentForm->getValue("DNI") : $CurrentForm->getValue("x_DNI");
		if (!$this->DNI->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->DNI->Visible = FALSE; // Disable update for API request
			else
				$this->DNI->setFormValue($val);
		}

		// Check field name 'Celular' first before field var 'x_Celular'
		$val = $CurrentForm->hasValue("Celular") ? $CurrentForm->getValue("Celular") : $CurrentForm->getValue("x_Celular");
		if (!$this->Celular->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Celular->Visible = FALSE; // Disable update for API request
			else
				$this->Celular->setFormValue($val);
		}

		// Check field name 'Domicilio' first before field var 'x_Domicilio'
		$val = $CurrentForm->hasValue("Domicilio") ? $CurrentForm->getValue("Domicilio") : $CurrentForm->getValue("x_Domicilio");
		if (!$this->Domicilio->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Domicilio->Visible = FALSE; // Disable update for API request
			else
				$this->Domicilio->setFormValue($val);
		}

		// Check field name 'RealLat' first before field var 'x_RealLat'
		$val = $CurrentForm->hasValue("RealLat") ? $CurrentForm->getValue("RealLat") : $CurrentForm->getValue("x_RealLat");
		if (!$this->RealLat->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->RealLat->Visible = FALSE; // Disable update for API request
			else
				$this->RealLat->setFormValue($val);
		}

		// Check field name 'RealLon' first before field var 'x_RealLon'
		$val = $CurrentForm->hasValue("RealLon") ? $CurrentForm->getValue("RealLon") : $CurrentForm->getValue("x_RealLon");
		if (!$this->RealLon->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->RealLon->Visible = FALSE; // Disable update for API request
			else
				$this->RealLon->setFormValue($val);
		}

		// Check field name 'EstimatedLat' first before field var 'x_EstimatedLat'
		$val = $CurrentForm->hasValue("EstimatedLat") ? $CurrentForm->getValue("EstimatedLat") : $CurrentForm->getValue("x_EstimatedLat");
		if (!$this->EstimatedLat->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->EstimatedLat->Visible = FALSE; // Disable update for API request
			else
				$this->EstimatedLat->setFormValue($val);
		}

		// Check field name 'EstimatedLon' first before field var 'x_EstimatedLon'
		$val = $CurrentForm->hasValue("EstimatedLon") ? $CurrentForm->getValue("EstimatedLon") : $CurrentForm->getValue("x_EstimatedLon");
		if (!$this->EstimatedLon->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->EstimatedLon->Visible = FALSE; // Disable update for API request
			else
				$this->EstimatedLon->setFormValue($val);
		}

		// Check field name 'LUDesde' first before field var 'x_LUDesde'
		$val = $CurrentForm->hasValue("LUDesde") ? $CurrentForm->getValue("LUDesde") : $CurrentForm->getValue("x_LUDesde");
		if (!$this->LUDesde->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->LUDesde->Visible = FALSE; // Disable update for API request
			else
				$this->LUDesde->setFormValue($val);
			$this->LUDesde->CurrentValue = UnFormatDateTime($this->LUDesde->CurrentValue, 4);
		}

		// Check field name 'LUHasta' first before field var 'x_LUHasta'
		$val = $CurrentForm->hasValue("LUHasta") ? $CurrentForm->getValue("LUHasta") : $CurrentForm->getValue("x_LUHasta");
		if (!$this->LUHasta->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->LUHasta->Visible = FALSE; // Disable update for API request
			else
				$this->LUHasta->setFormValue($val);
			$this->LUHasta->CurrentValue = UnFormatDateTime($this->LUHasta->CurrentValue, 4);
		}

		// Check field name 'MADesde' first before field var 'x_MADesde'
		$val = $CurrentForm->hasValue("MADesde") ? $CurrentForm->getValue("MADesde") : $CurrentForm->getValue("x_MADesde");
		if (!$this->MADesde->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->MADesde->Visible = FALSE; // Disable update for API request
			else
				$this->MADesde->setFormValue($val);
			$this->MADesde->CurrentValue = UnFormatDateTime($this->MADesde->CurrentValue, 4);
		}

		// Check field name 'MAHasta' first before field var 'x_MAHasta'
		$val = $CurrentForm->hasValue("MAHasta") ? $CurrentForm->getValue("MAHasta") : $CurrentForm->getValue("x_MAHasta");
		if (!$this->MAHasta->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->MAHasta->Visible = FALSE; // Disable update for API request
			else
				$this->MAHasta->setFormValue($val);
			$this->MAHasta->CurrentValue = UnFormatDateTime($this->MAHasta->CurrentValue, 4);
		}

		// Check field name 'MIEDesde' first before field var 'x_MIEDesde'
		$val = $CurrentForm->hasValue("MIEDesde") ? $CurrentForm->getValue("MIEDesde") : $CurrentForm->getValue("x_MIEDesde");
		if (!$this->MIEDesde->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->MIEDesde->Visible = FALSE; // Disable update for API request
			else
				$this->MIEDesde->setFormValue($val);
			$this->MIEDesde->CurrentValue = UnFormatDateTime($this->MIEDesde->CurrentValue, 4);
		}

		// Check field name 'MIEHasta' first before field var 'x_MIEHasta'
		$val = $CurrentForm->hasValue("MIEHasta") ? $CurrentForm->getValue("MIEHasta") : $CurrentForm->getValue("x_MIEHasta");
		if (!$this->MIEHasta->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->MIEHasta->Visible = FALSE; // Disable update for API request
			else
				$this->MIEHasta->setFormValue($val);
			$this->MIEHasta->CurrentValue = UnFormatDateTime($this->MIEHasta->CurrentValue, 4);
		}

		// Check field name 'JUEDesde' first before field var 'x_JUEDesde'
		$val = $CurrentForm->hasValue("JUEDesde") ? $CurrentForm->getValue("JUEDesde") : $CurrentForm->getValue("x_JUEDesde");
		if (!$this->JUEDesde->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->JUEDesde->Visible = FALSE; // Disable update for API request
			else
				$this->JUEDesde->setFormValue($val);
			$this->JUEDesde->CurrentValue = UnFormatDateTime($this->JUEDesde->CurrentValue, 4);
		}

		// Check field name 'JUEHasta' first before field var 'x_JUEHasta'
		$val = $CurrentForm->hasValue("JUEHasta") ? $CurrentForm->getValue("JUEHasta") : $CurrentForm->getValue("x_JUEHasta");
		if (!$this->JUEHasta->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->JUEHasta->Visible = FALSE; // Disable update for API request
			else
				$this->JUEHasta->setFormValue($val);
			$this->JUEHasta->CurrentValue = UnFormatDateTime($this->JUEHasta->CurrentValue, 4);
		}

		// Check field name 'VIEDesde' first before field var 'x_VIEDesde'
		$val = $CurrentForm->hasValue("VIEDesde") ? $CurrentForm->getValue("VIEDesde") : $CurrentForm->getValue("x_VIEDesde");
		if (!$this->VIEDesde->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->VIEDesde->Visible = FALSE; // Disable update for API request
			else
				$this->VIEDesde->setFormValue($val);
			$this->VIEDesde->CurrentValue = UnFormatDateTime($this->VIEDesde->CurrentValue, 4);
		}

		// Check field name 'VIEHasta' first before field var 'x_VIEHasta'
		$val = $CurrentForm->hasValue("VIEHasta") ? $CurrentForm->getValue("VIEHasta") : $CurrentForm->getValue("x_VIEHasta");
		if (!$this->VIEHasta->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->VIEHasta->Visible = FALSE; // Disable update for API request
			else
				$this->VIEHasta->setFormValue($val);
			$this->VIEHasta->CurrentValue = UnFormatDateTime($this->VIEHasta->CurrentValue, 4);
		}

		// Check field name 'SABDesde' first before field var 'x_SABDesde'
		$val = $CurrentForm->hasValue("SABDesde") ? $CurrentForm->getValue("SABDesde") : $CurrentForm->getValue("x_SABDesde");
		if (!$this->SABDesde->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->SABDesde->Visible = FALSE; // Disable update for API request
			else
				$this->SABDesde->setFormValue($val);
			$this->SABDesde->CurrentValue = UnFormatDateTime($this->SABDesde->CurrentValue, 4);
		}

		// Check field name 'SABHasta' first before field var 'x_SABHasta'
		$val = $CurrentForm->hasValue("SABHasta") ? $CurrentForm->getValue("SABHasta") : $CurrentForm->getValue("x_SABHasta");
		if (!$this->SABHasta->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->SABHasta->Visible = FALSE; // Disable update for API request
			else
				$this->SABHasta->setFormValue($val);
			$this->SABHasta->CurrentValue = UnFormatDateTime($this->SABHasta->CurrentValue, 4);
		}

		// Check field name 'DOMDesde' first before field var 'x_DOMDesde'
		$val = $CurrentForm->hasValue("DOMDesde") ? $CurrentForm->getValue("DOMDesde") : $CurrentForm->getValue("x_DOMDesde");
		if (!$this->DOMDesde->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->DOMDesde->Visible = FALSE; // Disable update for API request
			else
				$this->DOMDesde->setFormValue($val);
			$this->DOMDesde->CurrentValue = UnFormatDateTime($this->DOMDesde->CurrentValue, 4);
		}

		// Check field name 'DOMHasta' first before field var 'x_DOMHasta'
		$val = $CurrentForm->hasValue("DOMHasta") ? $CurrentForm->getValue("DOMHasta") : $CurrentForm->getValue("x_DOMHasta");
		if (!$this->DOMHasta->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->DOMHasta->Visible = FALSE; // Disable update for API request
			else
				$this->DOMHasta->setFormValue($val);
			$this->DOMHasta->CurrentValue = UnFormatDateTime($this->DOMHasta->CurrentValue, 4);
		}

		// Check field name 'Foto' first before field var 'x_Foto'
		$val = $CurrentForm->hasValue("Foto") ? $CurrentForm->getValue("Foto") : $CurrentForm->getValue("x_Foto");
		if (!$this->Foto->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Foto->Visible = FALSE; // Disable update for API request
			else
				$this->Foto->setFormValue($val);
		}

		// Check field name 'ID' first before field var 'x_ID'
		$val = $CurrentForm->hasValue("ID") ? $CurrentForm->getValue("ID") : $CurrentForm->getValue("x_ID");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->FechaCreacion->CurrentValue = $this->FechaCreacion->FormValue;
		$this->FechaCreacion->CurrentValue = UnFormatDateTime($this->FechaCreacion->CurrentValue, 0);
		$this->ID_Cadeteria->CurrentValue = $this->ID_Cadeteria->FormValue;
		$this->ID_Status->CurrentValue = $this->ID_Status->FormValue;
		$this->ID_CurrentStatus->CurrentValue = $this->ID_CurrentStatus->FormValue;
		$this->Nombre->CurrentValue = $this->Nombre->FormValue;
		$this->Apellido->CurrentValue = $this->Apellido->FormValue;
		$this->DNI->CurrentValue = $this->DNI->FormValue;
		$this->Celular->CurrentValue = $this->Celular->FormValue;
		$this->Domicilio->CurrentValue = $this->Domicilio->FormValue;
		$this->RealLat->CurrentValue = $this->RealLat->FormValue;
		$this->RealLon->CurrentValue = $this->RealLon->FormValue;
		$this->EstimatedLat->CurrentValue = $this->EstimatedLat->FormValue;
		$this->EstimatedLon->CurrentValue = $this->EstimatedLon->FormValue;
		$this->LUDesde->CurrentValue = $this->LUDesde->FormValue;
		$this->LUDesde->CurrentValue = UnFormatDateTime($this->LUDesde->CurrentValue, 4);
		$this->LUHasta->CurrentValue = $this->LUHasta->FormValue;
		$this->LUHasta->CurrentValue = UnFormatDateTime($this->LUHasta->CurrentValue, 4);
		$this->MADesde->CurrentValue = $this->MADesde->FormValue;
		$this->MADesde->CurrentValue = UnFormatDateTime($this->MADesde->CurrentValue, 4);
		$this->MAHasta->CurrentValue = $this->MAHasta->FormValue;
		$this->MAHasta->CurrentValue = UnFormatDateTime($this->MAHasta->CurrentValue, 4);
		$this->MIEDesde->CurrentValue = $this->MIEDesde->FormValue;
		$this->MIEDesde->CurrentValue = UnFormatDateTime($this->MIEDesde->CurrentValue, 4);
		$this->MIEHasta->CurrentValue = $this->MIEHasta->FormValue;
		$this->MIEHasta->CurrentValue = UnFormatDateTime($this->MIEHasta->CurrentValue, 4);
		$this->JUEDesde->CurrentValue = $this->JUEDesde->FormValue;
		$this->JUEDesde->CurrentValue = UnFormatDateTime($this->JUEDesde->CurrentValue, 4);
		$this->JUEHasta->CurrentValue = $this->JUEHasta->FormValue;
		$this->JUEHasta->CurrentValue = UnFormatDateTime($this->JUEHasta->CurrentValue, 4);
		$this->VIEDesde->CurrentValue = $this->VIEDesde->FormValue;
		$this->VIEDesde->CurrentValue = UnFormatDateTime($this->VIEDesde->CurrentValue, 4);
		$this->VIEHasta->CurrentValue = $this->VIEHasta->FormValue;
		$this->VIEHasta->CurrentValue = UnFormatDateTime($this->VIEHasta->CurrentValue, 4);
		$this->SABDesde->CurrentValue = $this->SABDesde->FormValue;
		$this->SABDesde->CurrentValue = UnFormatDateTime($this->SABDesde->CurrentValue, 4);
		$this->SABHasta->CurrentValue = $this->SABHasta->FormValue;
		$this->SABHasta->CurrentValue = UnFormatDateTime($this->SABHasta->CurrentValue, 4);
		$this->DOMDesde->CurrentValue = $this->DOMDesde->FormValue;
		$this->DOMDesde->CurrentValue = UnFormatDateTime($this->DOMDesde->CurrentValue, 4);
		$this->DOMHasta->CurrentValue = $this->DOMHasta->FormValue;
		$this->DOMHasta->CurrentValue = UnFormatDateTime($this->DOMHasta->CurrentValue, 4);
		$this->Foto->CurrentValue = $this->Foto->FormValue;
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
		$this->FechaCreacion->setDbValue($row['FechaCreacion']);
		$this->ID_Cadeteria->setDbValue($row['ID_Cadeteria']);
		$this->ID_Status->setDbValue($row['ID_Status']);
		$this->ID_CurrentStatus->setDbValue($row['ID_CurrentStatus']);
		$this->Nombre->setDbValue($row['Nombre']);
		$this->Apellido->setDbValue($row['Apellido']);
		$this->DNI->setDbValue($row['DNI']);
		$this->Celular->setDbValue($row['Celular']);
		$this->Domicilio->setDbValue($row['Domicilio']);
		$this->RealLat->setDbValue($row['RealLat']);
		$this->RealLon->setDbValue($row['RealLon']);
		$this->EstimatedLat->setDbValue($row['EstimatedLat']);
		$this->EstimatedLon->setDbValue($row['EstimatedLon']);
		$this->LUDesde->setDbValue($row['LUDesde']);
		$this->LUHasta->setDbValue($row['LUHasta']);
		$this->MADesde->setDbValue($row['MADesde']);
		$this->MAHasta->setDbValue($row['MAHasta']);
		$this->MIEDesde->setDbValue($row['MIEDesde']);
		$this->MIEHasta->setDbValue($row['MIEHasta']);
		$this->JUEDesde->setDbValue($row['JUEDesde']);
		$this->JUEHasta->setDbValue($row['JUEHasta']);
		$this->VIEDesde->setDbValue($row['VIEDesde']);
		$this->VIEHasta->setDbValue($row['VIEHasta']);
		$this->SABDesde->setDbValue($row['SABDesde']);
		$this->SABHasta->setDbValue($row['SABHasta']);
		$this->DOMDesde->setDbValue($row['DOMDesde']);
		$this->DOMHasta->setDbValue($row['DOMHasta']);
		$this->Foto->setDbValue($row['Foto']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['ID'] = $this->ID->CurrentValue;
		$row['FechaCreacion'] = $this->FechaCreacion->CurrentValue;
		$row['ID_Cadeteria'] = $this->ID_Cadeteria->CurrentValue;
		$row['ID_Status'] = $this->ID_Status->CurrentValue;
		$row['ID_CurrentStatus'] = $this->ID_CurrentStatus->CurrentValue;
		$row['Nombre'] = $this->Nombre->CurrentValue;
		$row['Apellido'] = $this->Apellido->CurrentValue;
		$row['DNI'] = $this->DNI->CurrentValue;
		$row['Celular'] = $this->Celular->CurrentValue;
		$row['Domicilio'] = $this->Domicilio->CurrentValue;
		$row['RealLat'] = $this->RealLat->CurrentValue;
		$row['RealLon'] = $this->RealLon->CurrentValue;
		$row['EstimatedLat'] = $this->EstimatedLat->CurrentValue;
		$row['EstimatedLon'] = $this->EstimatedLon->CurrentValue;
		$row['LUDesde'] = $this->LUDesde->CurrentValue;
		$row['LUHasta'] = $this->LUHasta->CurrentValue;
		$row['MADesde'] = $this->MADesde->CurrentValue;
		$row['MAHasta'] = $this->MAHasta->CurrentValue;
		$row['MIEDesde'] = $this->MIEDesde->CurrentValue;
		$row['MIEHasta'] = $this->MIEHasta->CurrentValue;
		$row['JUEDesde'] = $this->JUEDesde->CurrentValue;
		$row['JUEHasta'] = $this->JUEHasta->CurrentValue;
		$row['VIEDesde'] = $this->VIEDesde->CurrentValue;
		$row['VIEHasta'] = $this->VIEHasta->CurrentValue;
		$row['SABDesde'] = $this->SABDesde->CurrentValue;
		$row['SABHasta'] = $this->SABHasta->CurrentValue;
		$row['DOMDesde'] = $this->DOMDesde->CurrentValue;
		$row['DOMHasta'] = $this->DOMHasta->CurrentValue;
		$row['Foto'] = $this->Foto->CurrentValue;
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

		if ($this->RealLat->FormValue == $this->RealLat->CurrentValue && is_numeric(ConvertToFloatString($this->RealLat->CurrentValue)))
			$this->RealLat->CurrentValue = ConvertToFloatString($this->RealLat->CurrentValue);

		// Convert decimal values if posted back
		if ($this->RealLon->FormValue == $this->RealLon->CurrentValue && is_numeric(ConvertToFloatString($this->RealLon->CurrentValue)))
			$this->RealLon->CurrentValue = ConvertToFloatString($this->RealLon->CurrentValue);

		// Convert decimal values if posted back
		if ($this->EstimatedLat->FormValue == $this->EstimatedLat->CurrentValue && is_numeric(ConvertToFloatString($this->EstimatedLat->CurrentValue)))
			$this->EstimatedLat->CurrentValue = ConvertToFloatString($this->EstimatedLat->CurrentValue);

		// Convert decimal values if posted back
		if ($this->EstimatedLon->FormValue == $this->EstimatedLon->CurrentValue && is_numeric(ConvertToFloatString($this->EstimatedLon->CurrentValue)))
			$this->EstimatedLon->CurrentValue = ConvertToFloatString($this->EstimatedLon->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// ID
		// FechaCreacion
		// ID_Cadeteria
		// ID_Status
		// ID_CurrentStatus
		// Nombre
		// Apellido
		// DNI
		// Celular
		// Domicilio
		// RealLat
		// RealLon
		// EstimatedLat
		// EstimatedLon
		// LUDesde
		// LUHasta
		// MADesde
		// MAHasta
		// MIEDesde
		// MIEHasta
		// JUEDesde
		// JUEHasta
		// VIEDesde
		// VIEHasta
		// SABDesde
		// SABHasta
		// DOMDesde
		// DOMHasta
		// Foto

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// ID
			$this->ID->ViewValue = $this->ID->CurrentValue;
			$this->ID->ViewCustomAttributes = "";

			// FechaCreacion
			$this->FechaCreacion->ViewValue = $this->FechaCreacion->CurrentValue;
			$this->FechaCreacion->ViewValue = FormatDateTime($this->FechaCreacion->ViewValue, 0);
			$this->FechaCreacion->ViewCustomAttributes = "";

			// ID_Cadeteria
			$this->ID_Cadeteria->ViewValue = $this->ID_Cadeteria->CurrentValue;
			$this->ID_Cadeteria->ViewValue = FormatNumber($this->ID_Cadeteria->ViewValue, 0, -2, -2, -2);
			$this->ID_Cadeteria->ViewCustomAttributes = "";

			// ID_Status
			$this->ID_Status->ViewValue = $this->ID_Status->CurrentValue;
			$this->ID_Status->ViewValue = FormatNumber($this->ID_Status->ViewValue, 0, -2, -2, -2);
			$this->ID_Status->ViewCustomAttributes = "";

			// ID_CurrentStatus
			$this->ID_CurrentStatus->ViewValue = $this->ID_CurrentStatus->CurrentValue;
			$this->ID_CurrentStatus->ViewValue = FormatNumber($this->ID_CurrentStatus->ViewValue, 0, -2, -2, -2);
			$this->ID_CurrentStatus->ViewCustomAttributes = "";

			// Nombre
			$this->Nombre->ViewValue = $this->Nombre->CurrentValue;
			$this->Nombre->ViewCustomAttributes = "";

			// Apellido
			$this->Apellido->ViewValue = $this->Apellido->CurrentValue;
			$this->Apellido->ViewCustomAttributes = "";

			// DNI
			$this->DNI->ViewValue = $this->DNI->CurrentValue;
			$this->DNI->ViewCustomAttributes = "";

			// Celular
			$this->Celular->ViewValue = $this->Celular->CurrentValue;
			$this->Celular->ViewCustomAttributes = "";

			// Domicilio
			$this->Domicilio->ViewValue = $this->Domicilio->CurrentValue;
			$this->Domicilio->ViewCustomAttributes = "";

			// RealLat
			$this->RealLat->ViewValue = $this->RealLat->CurrentValue;
			$this->RealLat->ViewValue = FormatNumber($this->RealLat->ViewValue, 2, -2, -2, -2);
			$this->RealLat->ViewCustomAttributes = "";

			// RealLon
			$this->RealLon->ViewValue = $this->RealLon->CurrentValue;
			$this->RealLon->ViewValue = FormatNumber($this->RealLon->ViewValue, 2, -2, -2, -2);
			$this->RealLon->ViewCustomAttributes = "";

			// EstimatedLat
			$this->EstimatedLat->ViewValue = $this->EstimatedLat->CurrentValue;
			$this->EstimatedLat->ViewValue = FormatNumber($this->EstimatedLat->ViewValue, 2, -2, -2, -2);
			$this->EstimatedLat->ViewCustomAttributes = "";

			// EstimatedLon
			$this->EstimatedLon->ViewValue = $this->EstimatedLon->CurrentValue;
			$this->EstimatedLon->ViewValue = FormatNumber($this->EstimatedLon->ViewValue, 2, -2, -2, -2);
			$this->EstimatedLon->ViewCustomAttributes = "";

			// LUDesde
			$this->LUDesde->ViewValue = $this->LUDesde->CurrentValue;
			$this->LUDesde->ViewValue = FormatDateTime($this->LUDesde->ViewValue, 4);
			$this->LUDesde->ViewCustomAttributes = "";

			// LUHasta
			$this->LUHasta->ViewValue = $this->LUHasta->CurrentValue;
			$this->LUHasta->ViewValue = FormatDateTime($this->LUHasta->ViewValue, 4);
			$this->LUHasta->ViewCustomAttributes = "";

			// MADesde
			$this->MADesde->ViewValue = $this->MADesde->CurrentValue;
			$this->MADesde->ViewValue = FormatDateTime($this->MADesde->ViewValue, 4);
			$this->MADesde->ViewCustomAttributes = "";

			// MAHasta
			$this->MAHasta->ViewValue = $this->MAHasta->CurrentValue;
			$this->MAHasta->ViewValue = FormatDateTime($this->MAHasta->ViewValue, 4);
			$this->MAHasta->ViewCustomAttributes = "";

			// MIEDesde
			$this->MIEDesde->ViewValue = $this->MIEDesde->CurrentValue;
			$this->MIEDesde->ViewValue = FormatDateTime($this->MIEDesde->ViewValue, 4);
			$this->MIEDesde->ViewCustomAttributes = "";

			// MIEHasta
			$this->MIEHasta->ViewValue = $this->MIEHasta->CurrentValue;
			$this->MIEHasta->ViewValue = FormatDateTime($this->MIEHasta->ViewValue, 4);
			$this->MIEHasta->ViewCustomAttributes = "";

			// JUEDesde
			$this->JUEDesde->ViewValue = $this->JUEDesde->CurrentValue;
			$this->JUEDesde->ViewValue = FormatDateTime($this->JUEDesde->ViewValue, 4);
			$this->JUEDesde->ViewCustomAttributes = "";

			// JUEHasta
			$this->JUEHasta->ViewValue = $this->JUEHasta->CurrentValue;
			$this->JUEHasta->ViewValue = FormatDateTime($this->JUEHasta->ViewValue, 4);
			$this->JUEHasta->ViewCustomAttributes = "";

			// VIEDesde
			$this->VIEDesde->ViewValue = $this->VIEDesde->CurrentValue;
			$this->VIEDesde->ViewValue = FormatDateTime($this->VIEDesde->ViewValue, 4);
			$this->VIEDesde->ViewCustomAttributes = "";

			// VIEHasta
			$this->VIEHasta->ViewValue = $this->VIEHasta->CurrentValue;
			$this->VIEHasta->ViewValue = FormatDateTime($this->VIEHasta->ViewValue, 4);
			$this->VIEHasta->ViewCustomAttributes = "";

			// SABDesde
			$this->SABDesde->ViewValue = $this->SABDesde->CurrentValue;
			$this->SABDesde->ViewValue = FormatDateTime($this->SABDesde->ViewValue, 4);
			$this->SABDesde->ViewCustomAttributes = "";

			// SABHasta
			$this->SABHasta->ViewValue = $this->SABHasta->CurrentValue;
			$this->SABHasta->ViewValue = FormatDateTime($this->SABHasta->ViewValue, 4);
			$this->SABHasta->ViewCustomAttributes = "";

			// DOMDesde
			$this->DOMDesde->ViewValue = $this->DOMDesde->CurrentValue;
			$this->DOMDesde->ViewValue = FormatDateTime($this->DOMDesde->ViewValue, 4);
			$this->DOMDesde->ViewCustomAttributes = "";

			// DOMHasta
			$this->DOMHasta->ViewValue = $this->DOMHasta->CurrentValue;
			$this->DOMHasta->ViewValue = FormatDateTime($this->DOMHasta->ViewValue, 4);
			$this->DOMHasta->ViewCustomAttributes = "";

			// Foto
			$this->Foto->ViewValue = $this->Foto->CurrentValue;
			$this->Foto->ViewCustomAttributes = "";

			// FechaCreacion
			$this->FechaCreacion->LinkCustomAttributes = "";
			$this->FechaCreacion->HrefValue = "";
			$this->FechaCreacion->TooltipValue = "";

			// ID_Cadeteria
			$this->ID_Cadeteria->LinkCustomAttributes = "";
			$this->ID_Cadeteria->HrefValue = "";
			$this->ID_Cadeteria->TooltipValue = "";

			// ID_Status
			$this->ID_Status->LinkCustomAttributes = "";
			$this->ID_Status->HrefValue = "";
			$this->ID_Status->TooltipValue = "";

			// ID_CurrentStatus
			$this->ID_CurrentStatus->LinkCustomAttributes = "";
			$this->ID_CurrentStatus->HrefValue = "";
			$this->ID_CurrentStatus->TooltipValue = "";

			// Nombre
			$this->Nombre->LinkCustomAttributes = "";
			$this->Nombre->HrefValue = "";
			$this->Nombre->TooltipValue = "";

			// Apellido
			$this->Apellido->LinkCustomAttributes = "";
			$this->Apellido->HrefValue = "";
			$this->Apellido->TooltipValue = "";

			// DNI
			$this->DNI->LinkCustomAttributes = "";
			$this->DNI->HrefValue = "";
			$this->DNI->TooltipValue = "";

			// Celular
			$this->Celular->LinkCustomAttributes = "";
			$this->Celular->HrefValue = "";
			$this->Celular->TooltipValue = "";

			// Domicilio
			$this->Domicilio->LinkCustomAttributes = "";
			$this->Domicilio->HrefValue = "";
			$this->Domicilio->TooltipValue = "";

			// RealLat
			$this->RealLat->LinkCustomAttributes = "";
			$this->RealLat->HrefValue = "";
			$this->RealLat->TooltipValue = "";

			// RealLon
			$this->RealLon->LinkCustomAttributes = "";
			$this->RealLon->HrefValue = "";
			$this->RealLon->TooltipValue = "";

			// EstimatedLat
			$this->EstimatedLat->LinkCustomAttributes = "";
			$this->EstimatedLat->HrefValue = "";
			$this->EstimatedLat->TooltipValue = "";

			// EstimatedLon
			$this->EstimatedLon->LinkCustomAttributes = "";
			$this->EstimatedLon->HrefValue = "";
			$this->EstimatedLon->TooltipValue = "";

			// LUDesde
			$this->LUDesde->LinkCustomAttributes = "";
			$this->LUDesde->HrefValue = "";
			$this->LUDesde->TooltipValue = "";

			// LUHasta
			$this->LUHasta->LinkCustomAttributes = "";
			$this->LUHasta->HrefValue = "";
			$this->LUHasta->TooltipValue = "";

			// MADesde
			$this->MADesde->LinkCustomAttributes = "";
			$this->MADesde->HrefValue = "";
			$this->MADesde->TooltipValue = "";

			// MAHasta
			$this->MAHasta->LinkCustomAttributes = "";
			$this->MAHasta->HrefValue = "";
			$this->MAHasta->TooltipValue = "";

			// MIEDesde
			$this->MIEDesde->LinkCustomAttributes = "";
			$this->MIEDesde->HrefValue = "";
			$this->MIEDesde->TooltipValue = "";

			// MIEHasta
			$this->MIEHasta->LinkCustomAttributes = "";
			$this->MIEHasta->HrefValue = "";
			$this->MIEHasta->TooltipValue = "";

			// JUEDesde
			$this->JUEDesde->LinkCustomAttributes = "";
			$this->JUEDesde->HrefValue = "";
			$this->JUEDesde->TooltipValue = "";

			// JUEHasta
			$this->JUEHasta->LinkCustomAttributes = "";
			$this->JUEHasta->HrefValue = "";
			$this->JUEHasta->TooltipValue = "";

			// VIEDesde
			$this->VIEDesde->LinkCustomAttributes = "";
			$this->VIEDesde->HrefValue = "";
			$this->VIEDesde->TooltipValue = "";

			// VIEHasta
			$this->VIEHasta->LinkCustomAttributes = "";
			$this->VIEHasta->HrefValue = "";
			$this->VIEHasta->TooltipValue = "";

			// SABDesde
			$this->SABDesde->LinkCustomAttributes = "";
			$this->SABDesde->HrefValue = "";
			$this->SABDesde->TooltipValue = "";

			// SABHasta
			$this->SABHasta->LinkCustomAttributes = "";
			$this->SABHasta->HrefValue = "";
			$this->SABHasta->TooltipValue = "";

			// DOMDesde
			$this->DOMDesde->LinkCustomAttributes = "";
			$this->DOMDesde->HrefValue = "";
			$this->DOMDesde->TooltipValue = "";

			// DOMHasta
			$this->DOMHasta->LinkCustomAttributes = "";
			$this->DOMHasta->HrefValue = "";
			$this->DOMHasta->TooltipValue = "";

			// Foto
			$this->Foto->LinkCustomAttributes = "";
			$this->Foto->HrefValue = "";
			$this->Foto->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// FechaCreacion
			$this->FechaCreacion->EditAttrs["class"] = "form-control";
			$this->FechaCreacion->EditCustomAttributes = "";
			$this->FechaCreacion->EditValue = HtmlEncode(FormatDateTime($this->FechaCreacion->CurrentValue, 8));
			$this->FechaCreacion->PlaceHolder = RemoveHtml($this->FechaCreacion->caption());

			// ID_Cadeteria
			$this->ID_Cadeteria->EditAttrs["class"] = "form-control";
			$this->ID_Cadeteria->EditCustomAttributes = "";
			if (!$Security->isAdmin() && $Security->isLoggedIn() && !$this->userIDAllow("add")) { // Non system admin
				$this->ID_Cadeteria->CurrentValue = CurrentUserID();
				$this->ID_Cadeteria->EditValue = $this->ID_Cadeteria->CurrentValue;
				$this->ID_Cadeteria->EditValue = FormatNumber($this->ID_Cadeteria->EditValue, 0, -2, -2, -2);
				$this->ID_Cadeteria->ViewCustomAttributes = "";
			} else {
				$this->ID_Cadeteria->EditValue = HtmlEncode($this->ID_Cadeteria->CurrentValue);
				$this->ID_Cadeteria->PlaceHolder = RemoveHtml($this->ID_Cadeteria->caption());
			}

			// ID_Status
			$this->ID_Status->EditAttrs["class"] = "form-control";
			$this->ID_Status->EditCustomAttributes = "";
			$this->ID_Status->EditValue = HtmlEncode($this->ID_Status->CurrentValue);
			$this->ID_Status->PlaceHolder = RemoveHtml($this->ID_Status->caption());

			// ID_CurrentStatus
			$this->ID_CurrentStatus->EditAttrs["class"] = "form-control";
			$this->ID_CurrentStatus->EditCustomAttributes = "";
			$this->ID_CurrentStatus->EditValue = HtmlEncode($this->ID_CurrentStatus->CurrentValue);
			$this->ID_CurrentStatus->PlaceHolder = RemoveHtml($this->ID_CurrentStatus->caption());

			// Nombre
			$this->Nombre->EditAttrs["class"] = "form-control";
			$this->Nombre->EditCustomAttributes = "";
			if (!$this->Nombre->Raw)
				$this->Nombre->CurrentValue = HtmlDecode($this->Nombre->CurrentValue);
			$this->Nombre->EditValue = HtmlEncode($this->Nombre->CurrentValue);
			$this->Nombre->PlaceHolder = RemoveHtml($this->Nombre->caption());

			// Apellido
			$this->Apellido->EditAttrs["class"] = "form-control";
			$this->Apellido->EditCustomAttributes = "";
			if (!$this->Apellido->Raw)
				$this->Apellido->CurrentValue = HtmlDecode($this->Apellido->CurrentValue);
			$this->Apellido->EditValue = HtmlEncode($this->Apellido->CurrentValue);
			$this->Apellido->PlaceHolder = RemoveHtml($this->Apellido->caption());

			// DNI
			$this->DNI->EditAttrs["class"] = "form-control";
			$this->DNI->EditCustomAttributes = "";
			if (!$this->DNI->Raw)
				$this->DNI->CurrentValue = HtmlDecode($this->DNI->CurrentValue);
			$this->DNI->EditValue = HtmlEncode($this->DNI->CurrentValue);
			$this->DNI->PlaceHolder = RemoveHtml($this->DNI->caption());

			// Celular
			$this->Celular->EditAttrs["class"] = "form-control";
			$this->Celular->EditCustomAttributes = "";
			if (!$this->Celular->Raw)
				$this->Celular->CurrentValue = HtmlDecode($this->Celular->CurrentValue);
			$this->Celular->EditValue = HtmlEncode($this->Celular->CurrentValue);
			$this->Celular->PlaceHolder = RemoveHtml($this->Celular->caption());

			// Domicilio
			$this->Domicilio->EditAttrs["class"] = "form-control";
			$this->Domicilio->EditCustomAttributes = "";
			if (!$this->Domicilio->Raw)
				$this->Domicilio->CurrentValue = HtmlDecode($this->Domicilio->CurrentValue);
			$this->Domicilio->EditValue = HtmlEncode($this->Domicilio->CurrentValue);
			$this->Domicilio->PlaceHolder = RemoveHtml($this->Domicilio->caption());

			// RealLat
			$this->RealLat->EditAttrs["class"] = "form-control";
			$this->RealLat->EditCustomAttributes = "";
			$this->RealLat->EditValue = HtmlEncode($this->RealLat->CurrentValue);
			$this->RealLat->PlaceHolder = RemoveHtml($this->RealLat->caption());
			if (strval($this->RealLat->EditValue) != "" && is_numeric($this->RealLat->EditValue))
				$this->RealLat->EditValue = FormatNumber($this->RealLat->EditValue, -2, -2, -2, -2);
			

			// RealLon
			$this->RealLon->EditAttrs["class"] = "form-control";
			$this->RealLon->EditCustomAttributes = "";
			$this->RealLon->EditValue = HtmlEncode($this->RealLon->CurrentValue);
			$this->RealLon->PlaceHolder = RemoveHtml($this->RealLon->caption());
			if (strval($this->RealLon->EditValue) != "" && is_numeric($this->RealLon->EditValue))
				$this->RealLon->EditValue = FormatNumber($this->RealLon->EditValue, -2, -2, -2, -2);
			

			// EstimatedLat
			$this->EstimatedLat->EditAttrs["class"] = "form-control";
			$this->EstimatedLat->EditCustomAttributes = "";
			$this->EstimatedLat->EditValue = HtmlEncode($this->EstimatedLat->CurrentValue);
			$this->EstimatedLat->PlaceHolder = RemoveHtml($this->EstimatedLat->caption());
			if (strval($this->EstimatedLat->EditValue) != "" && is_numeric($this->EstimatedLat->EditValue))
				$this->EstimatedLat->EditValue = FormatNumber($this->EstimatedLat->EditValue, -2, -2, -2, -2);
			

			// EstimatedLon
			$this->EstimatedLon->EditAttrs["class"] = "form-control";
			$this->EstimatedLon->EditCustomAttributes = "";
			$this->EstimatedLon->EditValue = HtmlEncode($this->EstimatedLon->CurrentValue);
			$this->EstimatedLon->PlaceHolder = RemoveHtml($this->EstimatedLon->caption());
			if (strval($this->EstimatedLon->EditValue) != "" && is_numeric($this->EstimatedLon->EditValue))
				$this->EstimatedLon->EditValue = FormatNumber($this->EstimatedLon->EditValue, -2, -2, -2, -2);
			

			// LUDesde
			$this->LUDesde->EditAttrs["class"] = "form-control";
			$this->LUDesde->EditCustomAttributes = "";
			$this->LUDesde->EditValue = HtmlEncode($this->LUDesde->CurrentValue);
			$this->LUDesde->PlaceHolder = RemoveHtml($this->LUDesde->caption());

			// LUHasta
			$this->LUHasta->EditAttrs["class"] = "form-control";
			$this->LUHasta->EditCustomAttributes = "";
			$this->LUHasta->EditValue = HtmlEncode($this->LUHasta->CurrentValue);
			$this->LUHasta->PlaceHolder = RemoveHtml($this->LUHasta->caption());

			// MADesde
			$this->MADesde->EditAttrs["class"] = "form-control";
			$this->MADesde->EditCustomAttributes = "";
			$this->MADesde->EditValue = HtmlEncode($this->MADesde->CurrentValue);
			$this->MADesde->PlaceHolder = RemoveHtml($this->MADesde->caption());

			// MAHasta
			$this->MAHasta->EditAttrs["class"] = "form-control";
			$this->MAHasta->EditCustomAttributes = "";
			$this->MAHasta->EditValue = HtmlEncode($this->MAHasta->CurrentValue);
			$this->MAHasta->PlaceHolder = RemoveHtml($this->MAHasta->caption());

			// MIEDesde
			$this->MIEDesde->EditAttrs["class"] = "form-control";
			$this->MIEDesde->EditCustomAttributes = "";
			$this->MIEDesde->EditValue = HtmlEncode($this->MIEDesde->CurrentValue);
			$this->MIEDesde->PlaceHolder = RemoveHtml($this->MIEDesde->caption());

			// MIEHasta
			$this->MIEHasta->EditAttrs["class"] = "form-control";
			$this->MIEHasta->EditCustomAttributes = "";
			$this->MIEHasta->EditValue = HtmlEncode($this->MIEHasta->CurrentValue);
			$this->MIEHasta->PlaceHolder = RemoveHtml($this->MIEHasta->caption());

			// JUEDesde
			$this->JUEDesde->EditAttrs["class"] = "form-control";
			$this->JUEDesde->EditCustomAttributes = "";
			$this->JUEDesde->EditValue = HtmlEncode($this->JUEDesde->CurrentValue);
			$this->JUEDesde->PlaceHolder = RemoveHtml($this->JUEDesde->caption());

			// JUEHasta
			$this->JUEHasta->EditAttrs["class"] = "form-control";
			$this->JUEHasta->EditCustomAttributes = "";
			$this->JUEHasta->EditValue = HtmlEncode($this->JUEHasta->CurrentValue);
			$this->JUEHasta->PlaceHolder = RemoveHtml($this->JUEHasta->caption());

			// VIEDesde
			$this->VIEDesde->EditAttrs["class"] = "form-control";
			$this->VIEDesde->EditCustomAttributes = "";
			$this->VIEDesde->EditValue = HtmlEncode($this->VIEDesde->CurrentValue);
			$this->VIEDesde->PlaceHolder = RemoveHtml($this->VIEDesde->caption());

			// VIEHasta
			$this->VIEHasta->EditAttrs["class"] = "form-control";
			$this->VIEHasta->EditCustomAttributes = "";
			$this->VIEHasta->EditValue = HtmlEncode($this->VIEHasta->CurrentValue);
			$this->VIEHasta->PlaceHolder = RemoveHtml($this->VIEHasta->caption());

			// SABDesde
			$this->SABDesde->EditAttrs["class"] = "form-control";
			$this->SABDesde->EditCustomAttributes = "";
			$this->SABDesde->EditValue = HtmlEncode($this->SABDesde->CurrentValue);
			$this->SABDesde->PlaceHolder = RemoveHtml($this->SABDesde->caption());

			// SABHasta
			$this->SABHasta->EditAttrs["class"] = "form-control";
			$this->SABHasta->EditCustomAttributes = "";
			$this->SABHasta->EditValue = HtmlEncode($this->SABHasta->CurrentValue);
			$this->SABHasta->PlaceHolder = RemoveHtml($this->SABHasta->caption());

			// DOMDesde
			$this->DOMDesde->EditAttrs["class"] = "form-control";
			$this->DOMDesde->EditCustomAttributes = "";
			$this->DOMDesde->EditValue = HtmlEncode($this->DOMDesde->CurrentValue);
			$this->DOMDesde->PlaceHolder = RemoveHtml($this->DOMDesde->caption());

			// DOMHasta
			$this->DOMHasta->EditAttrs["class"] = "form-control";
			$this->DOMHasta->EditCustomAttributes = "";
			$this->DOMHasta->EditValue = HtmlEncode($this->DOMHasta->CurrentValue);
			$this->DOMHasta->PlaceHolder = RemoveHtml($this->DOMHasta->caption());

			// Foto
			$this->Foto->EditAttrs["class"] = "form-control";
			$this->Foto->EditCustomAttributes = "";
			if (!$this->Foto->Raw)
				$this->Foto->CurrentValue = HtmlDecode($this->Foto->CurrentValue);
			$this->Foto->EditValue = HtmlEncode($this->Foto->CurrentValue);
			$this->Foto->PlaceHolder = RemoveHtml($this->Foto->caption());

			// Add refer script
			// FechaCreacion

			$this->FechaCreacion->LinkCustomAttributes = "";
			$this->FechaCreacion->HrefValue = "";

			// ID_Cadeteria
			$this->ID_Cadeteria->LinkCustomAttributes = "";
			$this->ID_Cadeteria->HrefValue = "";

			// ID_Status
			$this->ID_Status->LinkCustomAttributes = "";
			$this->ID_Status->HrefValue = "";

			// ID_CurrentStatus
			$this->ID_CurrentStatus->LinkCustomAttributes = "";
			$this->ID_CurrentStatus->HrefValue = "";

			// Nombre
			$this->Nombre->LinkCustomAttributes = "";
			$this->Nombre->HrefValue = "";

			// Apellido
			$this->Apellido->LinkCustomAttributes = "";
			$this->Apellido->HrefValue = "";

			// DNI
			$this->DNI->LinkCustomAttributes = "";
			$this->DNI->HrefValue = "";

			// Celular
			$this->Celular->LinkCustomAttributes = "";
			$this->Celular->HrefValue = "";

			// Domicilio
			$this->Domicilio->LinkCustomAttributes = "";
			$this->Domicilio->HrefValue = "";

			// RealLat
			$this->RealLat->LinkCustomAttributes = "";
			$this->RealLat->HrefValue = "";

			// RealLon
			$this->RealLon->LinkCustomAttributes = "";
			$this->RealLon->HrefValue = "";

			// EstimatedLat
			$this->EstimatedLat->LinkCustomAttributes = "";
			$this->EstimatedLat->HrefValue = "";

			// EstimatedLon
			$this->EstimatedLon->LinkCustomAttributes = "";
			$this->EstimatedLon->HrefValue = "";

			// LUDesde
			$this->LUDesde->LinkCustomAttributes = "";
			$this->LUDesde->HrefValue = "";

			// LUHasta
			$this->LUHasta->LinkCustomAttributes = "";
			$this->LUHasta->HrefValue = "";

			// MADesde
			$this->MADesde->LinkCustomAttributes = "";
			$this->MADesde->HrefValue = "";

			// MAHasta
			$this->MAHasta->LinkCustomAttributes = "";
			$this->MAHasta->HrefValue = "";

			// MIEDesde
			$this->MIEDesde->LinkCustomAttributes = "";
			$this->MIEDesde->HrefValue = "";

			// MIEHasta
			$this->MIEHasta->LinkCustomAttributes = "";
			$this->MIEHasta->HrefValue = "";

			// JUEDesde
			$this->JUEDesde->LinkCustomAttributes = "";
			$this->JUEDesde->HrefValue = "";

			// JUEHasta
			$this->JUEHasta->LinkCustomAttributes = "";
			$this->JUEHasta->HrefValue = "";

			// VIEDesde
			$this->VIEDesde->LinkCustomAttributes = "";
			$this->VIEDesde->HrefValue = "";

			// VIEHasta
			$this->VIEHasta->LinkCustomAttributes = "";
			$this->VIEHasta->HrefValue = "";

			// SABDesde
			$this->SABDesde->LinkCustomAttributes = "";
			$this->SABDesde->HrefValue = "";

			// SABHasta
			$this->SABHasta->LinkCustomAttributes = "";
			$this->SABHasta->HrefValue = "";

			// DOMDesde
			$this->DOMDesde->LinkCustomAttributes = "";
			$this->DOMDesde->HrefValue = "";

			// DOMHasta
			$this->DOMHasta->LinkCustomAttributes = "";
			$this->DOMHasta->HrefValue = "";

			// Foto
			$this->Foto->LinkCustomAttributes = "";
			$this->Foto->HrefValue = "";
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
		if ($this->FechaCreacion->Required) {
			if (!$this->FechaCreacion->IsDetailKey && $this->FechaCreacion->FormValue != NULL && $this->FechaCreacion->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->FechaCreacion->caption(), $this->FechaCreacion->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->FechaCreacion->FormValue)) {
			AddMessage($FormError, $this->FechaCreacion->errorMessage());
		}
		if ($this->ID_Cadeteria->Required) {
			if (!$this->ID_Cadeteria->IsDetailKey && $this->ID_Cadeteria->FormValue != NULL && $this->ID_Cadeteria->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ID_Cadeteria->caption(), $this->ID_Cadeteria->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->ID_Cadeteria->FormValue)) {
			AddMessage($FormError, $this->ID_Cadeteria->errorMessage());
		}
		if ($this->ID_Status->Required) {
			if (!$this->ID_Status->IsDetailKey && $this->ID_Status->FormValue != NULL && $this->ID_Status->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ID_Status->caption(), $this->ID_Status->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->ID_Status->FormValue)) {
			AddMessage($FormError, $this->ID_Status->errorMessage());
		}
		if ($this->ID_CurrentStatus->Required) {
			if (!$this->ID_CurrentStatus->IsDetailKey && $this->ID_CurrentStatus->FormValue != NULL && $this->ID_CurrentStatus->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ID_CurrentStatus->caption(), $this->ID_CurrentStatus->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->ID_CurrentStatus->FormValue)) {
			AddMessage($FormError, $this->ID_CurrentStatus->errorMessage());
		}
		if ($this->Nombre->Required) {
			if (!$this->Nombre->IsDetailKey && $this->Nombre->FormValue != NULL && $this->Nombre->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Nombre->caption(), $this->Nombre->RequiredErrorMessage));
			}
		}
		if ($this->Apellido->Required) {
			if (!$this->Apellido->IsDetailKey && $this->Apellido->FormValue != NULL && $this->Apellido->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Apellido->caption(), $this->Apellido->RequiredErrorMessage));
			}
		}
		if ($this->DNI->Required) {
			if (!$this->DNI->IsDetailKey && $this->DNI->FormValue != NULL && $this->DNI->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DNI->caption(), $this->DNI->RequiredErrorMessage));
			}
		}
		if ($this->Celular->Required) {
			if (!$this->Celular->IsDetailKey && $this->Celular->FormValue != NULL && $this->Celular->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Celular->caption(), $this->Celular->RequiredErrorMessage));
			}
		}
		if ($this->Domicilio->Required) {
			if (!$this->Domicilio->IsDetailKey && $this->Domicilio->FormValue != NULL && $this->Domicilio->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Domicilio->caption(), $this->Domicilio->RequiredErrorMessage));
			}
		}
		if ($this->RealLat->Required) {
			if (!$this->RealLat->IsDetailKey && $this->RealLat->FormValue != NULL && $this->RealLat->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->RealLat->caption(), $this->RealLat->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->RealLat->FormValue)) {
			AddMessage($FormError, $this->RealLat->errorMessage());
		}
		if ($this->RealLon->Required) {
			if (!$this->RealLon->IsDetailKey && $this->RealLon->FormValue != NULL && $this->RealLon->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->RealLon->caption(), $this->RealLon->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->RealLon->FormValue)) {
			AddMessage($FormError, $this->RealLon->errorMessage());
		}
		if ($this->EstimatedLat->Required) {
			if (!$this->EstimatedLat->IsDetailKey && $this->EstimatedLat->FormValue != NULL && $this->EstimatedLat->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->EstimatedLat->caption(), $this->EstimatedLat->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->EstimatedLat->FormValue)) {
			AddMessage($FormError, $this->EstimatedLat->errorMessage());
		}
		if ($this->EstimatedLon->Required) {
			if (!$this->EstimatedLon->IsDetailKey && $this->EstimatedLon->FormValue != NULL && $this->EstimatedLon->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->EstimatedLon->caption(), $this->EstimatedLon->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->EstimatedLon->FormValue)) {
			AddMessage($FormError, $this->EstimatedLon->errorMessage());
		}
		if ($this->LUDesde->Required) {
			if (!$this->LUDesde->IsDetailKey && $this->LUDesde->FormValue != NULL && $this->LUDesde->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LUDesde->caption(), $this->LUDesde->RequiredErrorMessage));
			}
		}
		if (!CheckTime($this->LUDesde->FormValue)) {
			AddMessage($FormError, $this->LUDesde->errorMessage());
		}
		if ($this->LUHasta->Required) {
			if (!$this->LUHasta->IsDetailKey && $this->LUHasta->FormValue != NULL && $this->LUHasta->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LUHasta->caption(), $this->LUHasta->RequiredErrorMessage));
			}
		}
		if (!CheckTime($this->LUHasta->FormValue)) {
			AddMessage($FormError, $this->LUHasta->errorMessage());
		}
		if ($this->MADesde->Required) {
			if (!$this->MADesde->IsDetailKey && $this->MADesde->FormValue != NULL && $this->MADesde->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->MADesde->caption(), $this->MADesde->RequiredErrorMessage));
			}
		}
		if (!CheckTime($this->MADesde->FormValue)) {
			AddMessage($FormError, $this->MADesde->errorMessage());
		}
		if ($this->MAHasta->Required) {
			if (!$this->MAHasta->IsDetailKey && $this->MAHasta->FormValue != NULL && $this->MAHasta->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->MAHasta->caption(), $this->MAHasta->RequiredErrorMessage));
			}
		}
		if (!CheckTime($this->MAHasta->FormValue)) {
			AddMessage($FormError, $this->MAHasta->errorMessage());
		}
		if ($this->MIEDesde->Required) {
			if (!$this->MIEDesde->IsDetailKey && $this->MIEDesde->FormValue != NULL && $this->MIEDesde->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->MIEDesde->caption(), $this->MIEDesde->RequiredErrorMessage));
			}
		}
		if (!CheckTime($this->MIEDesde->FormValue)) {
			AddMessage($FormError, $this->MIEDesde->errorMessage());
		}
		if ($this->MIEHasta->Required) {
			if (!$this->MIEHasta->IsDetailKey && $this->MIEHasta->FormValue != NULL && $this->MIEHasta->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->MIEHasta->caption(), $this->MIEHasta->RequiredErrorMessage));
			}
		}
		if (!CheckTime($this->MIEHasta->FormValue)) {
			AddMessage($FormError, $this->MIEHasta->errorMessage());
		}
		if ($this->JUEDesde->Required) {
			if (!$this->JUEDesde->IsDetailKey && $this->JUEDesde->FormValue != NULL && $this->JUEDesde->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->JUEDesde->caption(), $this->JUEDesde->RequiredErrorMessage));
			}
		}
		if (!CheckTime($this->JUEDesde->FormValue)) {
			AddMessage($FormError, $this->JUEDesde->errorMessage());
		}
		if ($this->JUEHasta->Required) {
			if (!$this->JUEHasta->IsDetailKey && $this->JUEHasta->FormValue != NULL && $this->JUEHasta->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->JUEHasta->caption(), $this->JUEHasta->RequiredErrorMessage));
			}
		}
		if (!CheckTime($this->JUEHasta->FormValue)) {
			AddMessage($FormError, $this->JUEHasta->errorMessage());
		}
		if ($this->VIEDesde->Required) {
			if (!$this->VIEDesde->IsDetailKey && $this->VIEDesde->FormValue != NULL && $this->VIEDesde->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->VIEDesde->caption(), $this->VIEDesde->RequiredErrorMessage));
			}
		}
		if (!CheckTime($this->VIEDesde->FormValue)) {
			AddMessage($FormError, $this->VIEDesde->errorMessage());
		}
		if ($this->VIEHasta->Required) {
			if (!$this->VIEHasta->IsDetailKey && $this->VIEHasta->FormValue != NULL && $this->VIEHasta->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->VIEHasta->caption(), $this->VIEHasta->RequiredErrorMessage));
			}
		}
		if (!CheckTime($this->VIEHasta->FormValue)) {
			AddMessage($FormError, $this->VIEHasta->errorMessage());
		}
		if ($this->SABDesde->Required) {
			if (!$this->SABDesde->IsDetailKey && $this->SABDesde->FormValue != NULL && $this->SABDesde->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->SABDesde->caption(), $this->SABDesde->RequiredErrorMessage));
			}
		}
		if (!CheckTime($this->SABDesde->FormValue)) {
			AddMessage($FormError, $this->SABDesde->errorMessage());
		}
		if ($this->SABHasta->Required) {
			if (!$this->SABHasta->IsDetailKey && $this->SABHasta->FormValue != NULL && $this->SABHasta->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->SABHasta->caption(), $this->SABHasta->RequiredErrorMessage));
			}
		}
		if (!CheckTime($this->SABHasta->FormValue)) {
			AddMessage($FormError, $this->SABHasta->errorMessage());
		}
		if ($this->DOMDesde->Required) {
			if (!$this->DOMDesde->IsDetailKey && $this->DOMDesde->FormValue != NULL && $this->DOMDesde->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DOMDesde->caption(), $this->DOMDesde->RequiredErrorMessage));
			}
		}
		if (!CheckTime($this->DOMDesde->FormValue)) {
			AddMessage($FormError, $this->DOMDesde->errorMessage());
		}
		if ($this->DOMHasta->Required) {
			if (!$this->DOMHasta->IsDetailKey && $this->DOMHasta->FormValue != NULL && $this->DOMHasta->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DOMHasta->caption(), $this->DOMHasta->RequiredErrorMessage));
			}
		}
		if (!CheckTime($this->DOMHasta->FormValue)) {
			AddMessage($FormError, $this->DOMHasta->errorMessage());
		}
		if ($this->Foto->Required) {
			if (!$this->Foto->IsDetailKey && $this->Foto->FormValue != NULL && $this->Foto->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Foto->caption(), $this->Foto->RequiredErrorMessage));
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

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;

		// Check if valid User ID
		$validUser = FALSE;
		if ($Security->currentUserID() != "" && !EmptyValue($this->ID_Cadeteria->CurrentValue) && !$Security->isAdmin()) { // Non system admin
			$validUser = $Security->isValidUserID($this->ID_Cadeteria->CurrentValue);
			if (!$validUser) {
				$userIdMsg = str_replace("%c", CurrentUserID(), $Language->phrase("UnAuthorizedUserID"));
				$userIdMsg = str_replace("%u", $this->ID_Cadeteria->CurrentValue, $userIdMsg);
				$this->setFailureMessage($userIdMsg);
				return FALSE;
			}
		}
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// FechaCreacion
		$this->FechaCreacion->setDbValueDef($rsnew, UnFormatDateTime($this->FechaCreacion->CurrentValue, 0), CurrentDate(), strval($this->FechaCreacion->CurrentValue) == "");

		// ID_Cadeteria
		$this->ID_Cadeteria->setDbValueDef($rsnew, $this->ID_Cadeteria->CurrentValue, 0, FALSE);

		// ID_Status
		$this->ID_Status->setDbValueDef($rsnew, $this->ID_Status->CurrentValue, 0, FALSE);

		// ID_CurrentStatus
		$this->ID_CurrentStatus->setDbValueDef($rsnew, $this->ID_CurrentStatus->CurrentValue, 0, FALSE);

		// Nombre
		$this->Nombre->setDbValueDef($rsnew, $this->Nombre->CurrentValue, "", FALSE);

		// Apellido
		$this->Apellido->setDbValueDef($rsnew, $this->Apellido->CurrentValue, "", FALSE);

		// DNI
		$this->DNI->setDbValueDef($rsnew, $this->DNI->CurrentValue, "", FALSE);

		// Celular
		$this->Celular->setDbValueDef($rsnew, $this->Celular->CurrentValue, NULL, FALSE);

		// Domicilio
		$this->Domicilio->setDbValueDef($rsnew, $this->Domicilio->CurrentValue, NULL, FALSE);

		// RealLat
		$this->RealLat->setDbValueDef($rsnew, $this->RealLat->CurrentValue, NULL, FALSE);

		// RealLon
		$this->RealLon->setDbValueDef($rsnew, $this->RealLon->CurrentValue, NULL, FALSE);

		// EstimatedLat
		$this->EstimatedLat->setDbValueDef($rsnew, $this->EstimatedLat->CurrentValue, NULL, FALSE);

		// EstimatedLon
		$this->EstimatedLon->setDbValueDef($rsnew, $this->EstimatedLon->CurrentValue, NULL, FALSE);

		// LUDesde
		$this->LUDesde->setDbValueDef($rsnew, UnFormatDateTime($this->LUDesde->CurrentValue, 4), NULL, FALSE);

		// LUHasta
		$this->LUHasta->setDbValueDef($rsnew, UnFormatDateTime($this->LUHasta->CurrentValue, 4), NULL, FALSE);

		// MADesde
		$this->MADesde->setDbValueDef($rsnew, UnFormatDateTime($this->MADesde->CurrentValue, 4), NULL, FALSE);

		// MAHasta
		$this->MAHasta->setDbValueDef($rsnew, UnFormatDateTime($this->MAHasta->CurrentValue, 4), NULL, FALSE);

		// MIEDesde
		$this->MIEDesde->setDbValueDef($rsnew, UnFormatDateTime($this->MIEDesde->CurrentValue, 4), NULL, FALSE);

		// MIEHasta
		$this->MIEHasta->setDbValueDef($rsnew, UnFormatDateTime($this->MIEHasta->CurrentValue, 4), NULL, FALSE);

		// JUEDesde
		$this->JUEDesde->setDbValueDef($rsnew, UnFormatDateTime($this->JUEDesde->CurrentValue, 4), NULL, FALSE);

		// JUEHasta
		$this->JUEHasta->setDbValueDef($rsnew, UnFormatDateTime($this->JUEHasta->CurrentValue, 4), NULL, FALSE);

		// VIEDesde
		$this->VIEDesde->setDbValueDef($rsnew, UnFormatDateTime($this->VIEDesde->CurrentValue, 4), NULL, FALSE);

		// VIEHasta
		$this->VIEHasta->setDbValueDef($rsnew, UnFormatDateTime($this->VIEHasta->CurrentValue, 4), NULL, FALSE);

		// SABDesde
		$this->SABDesde->setDbValueDef($rsnew, UnFormatDateTime($this->SABDesde->CurrentValue, 4), NULL, FALSE);

		// SABHasta
		$this->SABHasta->setDbValueDef($rsnew, UnFormatDateTime($this->SABHasta->CurrentValue, 4), NULL, FALSE);

		// DOMDesde
		$this->DOMDesde->setDbValueDef($rsnew, UnFormatDateTime($this->DOMDesde->CurrentValue, 4), NULL, FALSE);

		// DOMHasta
		$this->DOMHasta->setDbValueDef($rsnew, UnFormatDateTime($this->DOMHasta->CurrentValue, 4), NULL, FALSE);

		// Foto
		$this->Foto->setDbValueDef($rsnew, $this->Foto->CurrentValue, NULL, FALSE);

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

	// Show link optionally based on User ID
	protected function showOptionLink($id = "")
	{
		global $Security;
		if ($Security->isLoggedIn() && !$Security->isAdmin() && !$this->userIDAllow($id))
			return $Security->isValidUserID($this->ID_Cadeteria->CurrentValue);
		return TRUE;
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("Cadetelist.php"), "", $this->TableVar, TRUE);
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