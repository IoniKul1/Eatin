<?php
namespace PHPMaker2020\EATIN_BO;

/**
 * Page class
 */
class Restaurant_view extends Restaurant
{

	// Page ID
	public $PageID = "view";

	// Project ID
	public $ProjectID = "{CC19BE4C-23D6-4992-89EF-6304995797F2}";

	// Table name
	public $TableName = 'Restaurant';

	// Page object name
	public $PageObjName = "Restaurant_view";

	// Page URLs
	public $AddUrl;
	public $EditUrl;
	public $CopyUrl;
	public $DeleteUrl;
	public $ViewUrl;
	public $ListUrl;

	// Export URLs
	public $ExportPrintUrl;
	public $ExportHtmlUrl;
	public $ExportExcelUrl;
	public $ExportWordUrl;
	public $ExportXmlUrl;
	public $ExportCsvUrl;
	public $ExportPdfUrl;

	// Custom export
	public $ExportExcelCustom = FALSE;
	public $ExportWordCustom = FALSE;
	public $ExportPdfCustom = FALSE;
	public $ExportEmailCustom = FALSE;

	// Update URLs
	public $InlineAddUrl;
	public $InlineCopyUrl;
	public $InlineEditUrl;
	public $GridAddUrl;
	public $GridEditUrl;
	public $MultiDeleteUrl;
	public $MultiUpdateUrl;

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
		$keyUrl = "";
		if (Get("ID") !== NULL) {
			$this->RecKey["ID"] = Get("ID");
			$keyUrl .= "&amp;ID=" . urlencode($this->RecKey["ID"]);
		}
		$this->ExportPrintUrl = $this->pageUrl() . "export=print" . $keyUrl;
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html" . $keyUrl;
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel" . $keyUrl;
		$this->ExportWordUrl = $this->pageUrl() . "export=word" . $keyUrl;
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml" . $keyUrl;
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv" . $keyUrl;
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf" . $keyUrl;

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'view');

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

		// Export options
		$this->ExportOptions = new ListOptions("div");
		$this->ExportOptions->TagClassName = "ew-export-option";

		// Other options
		if (!$this->OtherOptions)
			$this->OtherOptions = new ListOptionsArray();
		$this->OtherOptions["action"] = new ListOptions("div");
		$this->OtherOptions["action"]->TagClassName = "ew-action-option";
		$this->OtherOptions["detail"] = new ListOptions("div");
		$this->OtherOptions["detail"]->TagClassName = "ew-detail-option";
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
	public $ExportOptions; // Export options
	public $OtherOptions; // Other options
	public $DisplayRecords = 1;
	public $DbMasterFilter;
	public $DbDetailFilter;
	public $StartRecord;
	public $StopRecord;
	public $TotalRecords = 0;
	public $RecordRange = 10;
	public $RecKey = [];
	public $IsModal = FALSE;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$SkipHeaderFooter;

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
			if (!$Security->canView()) {
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
			if (!$Security->canView()) {
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
		$this->CurrentAction = Param("action"); // Set up current action
		$this->ID->setVisibility();
		$this->ID_State->setVisibility();
		$this->DateCreation->setVisibility();
		$this->DateLastUpdate->setVisibility();
		$this->Nombre->setVisibility();
		$this->Lat->setVisibility();
		$this->Lon->setVisibility();
		$this->GoogleGeocodeAddress->setVisibility();
		$this->Address->setVisibility();
		$this->Deactivated->setVisibility();
		$this->Suspended->setVisibility();
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

		if (!$Security->canView()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("Restaurantlist.php");
			return;
		}

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;

		// Load current record
		$loadCurrentRecord = FALSE;
		$returnUrl = "";
		$matchRecord = FALSE;
		if ($this->isPageRequest()) { // Validate request
			if (Get("ID") !== NULL) {
				$this->ID->setQueryStringValue(Get("ID"));
				$this->RecKey["ID"] = $this->ID->QueryStringValue;
			} elseif (IsApi() && Key(0) !== NULL) {
				$this->ID->setQueryStringValue(Key(0));
				$this->RecKey["ID"] = $this->ID->QueryStringValue;
			} elseif (Post("ID") !== NULL) {
				$this->ID->setFormValue(Post("ID"));
				$this->RecKey["ID"] = $this->ID->FormValue;
			} elseif (IsApi() && Route(2) !== NULL) {
				$this->ID->setFormValue(Route(2));
				$this->RecKey["ID"] = $this->ID->FormValue;
			} else {
				$returnUrl = "Restaurantlist.php"; // Return to list
			}

			// Get action
			$this->CurrentAction = "show"; // Display
			switch ($this->CurrentAction) {
				case "show": // Get a record to display

					// Load record based on key
					if (IsApi()) {
						$filter = $this->getRecordFilter();
						$this->CurrentFilter = $filter;
						$sql = $this->getCurrentSql();
						$conn = $this->getConnection();
						$this->Recordset = LoadRecordset($sql, $conn);
						$res = $this->Recordset && !$this->Recordset->EOF;
					} else {
						$res = $this->loadRow();
					}
					if (!$res) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
						$returnUrl = "Restaurantlist.php"; // No matching record, return to list
					}
			}
		} else {
			$returnUrl = "Restaurantlist.php"; // Not page request, return to list
		}
		if ($returnUrl != "") {
			$this->terminate($returnUrl);
			return;
		}

		// Set up Breadcrumb
		if (!$this->isExport())
			$this->setupBreadcrumb();

		// Render row
		$this->RowType = ROWTYPE_VIEW;
		$this->resetAttributes();
		$this->renderRow();

		// Set up detail parameters
		$this->setupDetailParms();

		// Normal return
		if (IsApi()) {
			$rows = $this->getRecordsFromRecordset($this->Recordset, TRUE); // Get current record only
			$this->Recordset->close();
			WriteJson(["success" => TRUE, $this->TableVar => $rows]);
			$this->terminate(TRUE);
		}
	}

	// Set up other options
	protected function setupOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = $options["action"];

		// Edit
		$item = &$option->add("edit");
		$editcaption = HtmlTitle($Language->phrase("ViewPageEditLink"));
		if ($this->IsModal) // Modal
			$item->Body = "<a class=\"ew-action ew-edit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,url:'" . HtmlEncode($this->EditUrl) . "'});\">" . $Language->phrase("ViewPageEditLink") . "</a>";
		else
			$item->Body = "<a class=\"ew-action ew-edit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"" . HtmlEncode($this->EditUrl) . "\">" . $Language->phrase("ViewPageEditLink") . "</a>";
		$item->Visible = ($this->EditUrl != "" && $Security->canEdit()&& $this->showOptionLink('edit'));
		$option = $options["detail"];
		$detailTableLink = "";
		$detailViewTblVar = "";
		$detailCopyTblVar = "";
		$detailEditTblVar = "";

		// "detail_Client"
		$item = &$option->add("detail_Client");
		$body = $Language->phrase("ViewPageDetailLink") . $Language->TablePhrase("Client", "TblCaption");
		$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("Clientlist.php?" . Config("TABLE_SHOW_MASTER") . "=Restaurant&fk_ID=" . urlencode(strval($this->ID->CurrentValue)) . "") . "\">" . $body . "</a>";
		$links = "";
		if (!isset($GLOBALS["Client_grid"]))
			$GLOBALS["Client_grid"] = new Client_grid();
		if ($GLOBALS["Client_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'Restaurant')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailViewLink")) . "\" href=\"" . HtmlEncode($this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=Client")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailViewLink")) . "</a></li>";
			if ($detailViewTblVar != "")
				$detailViewTblVar .= ",";
			$detailViewTblVar .= "Client";
		}
		if ($GLOBALS["Client_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'Restaurant')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailEditLink")) . "\" href=\"" . HtmlEncode($this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=Client")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailEditLink")) . "</a></li>";
			if ($detailEditTblVar != "")
				$detailEditTblVar .= ",";
			$detailEditTblVar .= "Client";
		}
		if ($links != "") {
			$body .= "<button class=\"dropdown-toggle btn btn-default ew-detail\" data-toggle=\"dropdown\"></button>";
			$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
		}
		$body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
		$item->Body = $body;
		$item->Visible = $Security->allowList(CurrentProjectID() . 'Client');
		if ($item->Visible) {
			if ($detailTableLink != "")
				$detailTableLink .= ",";
			$detailTableLink .= "Client";
		}
		if ($this->ShowMultipleDetails)
			$item->Visible = FALSE;

		// "detail_Categorias"
		$item = &$option->add("detail_Categorias");
		$body = $Language->phrase("ViewPageDetailLink") . $Language->TablePhrase("Categorias", "TblCaption");
		$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("Categoriaslist.php?" . Config("TABLE_SHOW_MASTER") . "=Restaurant&fk_ID=" . urlencode(strval($this->ID->CurrentValue)) . "") . "\">" . $body . "</a>";
		$links = "";
		if (!isset($GLOBALS["Categorias_grid"]))
			$GLOBALS["Categorias_grid"] = new Categorias_grid();
		if ($GLOBALS["Categorias_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'Restaurant')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailViewLink")) . "\" href=\"" . HtmlEncode($this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=Categorias")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailViewLink")) . "</a></li>";
			if ($detailViewTblVar != "")
				$detailViewTblVar .= ",";
			$detailViewTblVar .= "Categorias";
		}
		if ($GLOBALS["Categorias_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'Restaurant')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailEditLink")) . "\" href=\"" . HtmlEncode($this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=Categorias")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailEditLink")) . "</a></li>";
			if ($detailEditTblVar != "")
				$detailEditTblVar .= ",";
			$detailEditTblVar .= "Categorias";
		}
		if ($links != "") {
			$body .= "<button class=\"dropdown-toggle btn btn-default ew-detail\" data-toggle=\"dropdown\"></button>";
			$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
		}
		$body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
		$item->Body = $body;
		$item->Visible = $Security->allowList(CurrentProjectID() . 'Categorias');
		if ($item->Visible) {
			if ($detailTableLink != "")
				$detailTableLink .= ",";
			$detailTableLink .= "Categorias";
		}
		if ($this->ShowMultipleDetails)
			$item->Visible = FALSE;

		// "detail__Table"
		$item = &$option->add("detail__Table");
		$body = $Language->phrase("ViewPageDetailLink") . $Language->TablePhrase("_Table", "TblCaption");
		$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("_Tablelist.php?" . Config("TABLE_SHOW_MASTER") . "=Restaurant&fk_ID=" . urlencode(strval($this->ID->CurrentValue)) . "") . "\">" . $body . "</a>";
		$links = "";
		if (!isset($GLOBALS["_Table_grid"]))
			$GLOBALS["_Table_grid"] = new _Table_grid();
		if ($GLOBALS["_Table_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'Restaurant')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailViewLink")) . "\" href=\"" . HtmlEncode($this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=_Table")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailViewLink")) . "</a></li>";
			if ($detailViewTblVar != "")
				$detailViewTblVar .= ",";
			$detailViewTblVar .= "_Table";
		}
		if ($GLOBALS["_Table_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'Restaurant')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailEditLink")) . "\" href=\"" . HtmlEncode($this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=_Table")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailEditLink")) . "</a></li>";
			if ($detailEditTblVar != "")
				$detailEditTblVar .= ",";
			$detailEditTblVar .= "_Table";
		}
		if ($links != "") {
			$body .= "<button class=\"dropdown-toggle btn btn-default ew-detail\" data-toggle=\"dropdown\"></button>";
			$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
		}
		$body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
		$item->Body = $body;
		$item->Visible = $Security->allowList(CurrentProjectID() . 'Table');
		if ($item->Visible) {
			if ($detailTableLink != "")
				$detailTableLink .= ",";
			$detailTableLink .= "_Table";
		}
		if ($this->ShowMultipleDetails)
			$item->Visible = FALSE;

		// Multiple details
		if ($this->ShowMultipleDetails) {
			$body = "<div class=\"btn-group btn-group-sm ew-btn-group\">";
			$links = "";
			if ($detailViewTblVar != "") {
				$links .= "<li><a class=\"ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailViewLink")) . "\" href=\"" . HtmlEncode($this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailViewTblVar)) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailViewLink")) . "</a></li>";
			}
			if ($detailEditTblVar != "") {
				$links .= "<li><a class=\"ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailEditLink")) . "\" href=\"" . HtmlEncode($this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailEditTblVar)) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailEditLink")) . "</a></li>";
			}
			if ($detailCopyTblVar != "") {
				$links .= "<li><a class=\"ew-row-link ew-detail-copy\" data-action=\"add\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailCopyLink")) . "\" href=\"" . HtmlEncode($this->getCopyUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailCopyTblVar)) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailCopyLink")) . "</a></li>";
			}
			if ($links != "") {
				$body .= "<button class=\"dropdown-toggle btn btn-default ew-master-detail\" title=\"" . HtmlTitle($Language->phrase("MultipleMasterDetails")) . "\" data-toggle=\"dropdown\">" . $Language->phrase("MultipleMasterDetails") . "</button>";
				$body .= "<ul class=\"dropdown-menu ew-menu\">". $links . "</ul>";
			}
			$body .= "</div>";

			// Multiple details
			$item = &$option->add("details");
			$item->Body = $body;
		}

		// Set up detail default
		$option = $options["detail"];
		$options["detail"]->DropDownButtonPhrase = $Language->phrase("ButtonDetails");
		$ar = explode(",", $detailTableLink);
		$cnt = count($ar);
		$option->UseDropDownButton = ($cnt > 1);
		$option->UseButtonGroup = TRUE;
		$item = &$option->add($option->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Set up action default
		$option = $options["action"];
		$option->DropDownButtonPhrase = $Language->phrase("ButtonActions");
		$option->UseDropDownButton = TRUE;
		$option->UseButtonGroup = TRUE;
		$item = &$option->add($option->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
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

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		$this->AddUrl = $this->getAddUrl();
		$this->EditUrl = $this->getEditUrl();
		$this->CopyUrl = $this->getCopyUrl();
		$this->DeleteUrl = $this->getDeleteUrl();
		$this->ListUrl = $this->getListUrl();
		$this->setupOtherOptions();

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

			// DateCreation
			$this->DateCreation->LinkCustomAttributes = "";
			$this->DateCreation->HrefValue = "";
			$this->DateCreation->TooltipValue = "";

			// DateLastUpdate
			$this->DateLastUpdate->LinkCustomAttributes = "";
			$this->DateLastUpdate->HrefValue = "";
			$this->DateLastUpdate->TooltipValue = "";

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

			// Suspended
			$this->Suspended->LinkCustomAttributes = "";
			$this->Suspended->HrefValue = "";
			$this->Suspended->TooltipValue = "";

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
		}

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
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
				if ($GLOBALS["Client_grid"]->DetailView) {
					$GLOBALS["Client_grid"]->CurrentMode = "view";

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
				if ($GLOBALS["Categorias_grid"]->DetailView) {
					$GLOBALS["Categorias_grid"]->CurrentMode = "view";

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
				if ($GLOBALS["_Table_grid"]->DetailView) {
					$GLOBALS["_Table_grid"]->CurrentMode = "view";

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
		$pageId = "view";
		$Breadcrumb->add("view", $pageId, $url);
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

	// Page Exporting event
	// $this->ExportDoc = export document object
	function Page_Exporting() {

		//$this->ExportDoc->Text = "my header"; // Export header
		//return FALSE; // Return FALSE to skip default export and use Row_Export event

		return TRUE; // Return TRUE to use default export and skip Row_Export event
	}

	// Row Export event
	// $this->ExportDoc = export document object
	function Row_Export($rs) {

		//$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
	}

	// Page Exported event
	// $this->ExportDoc = export document object
	function Page_Exported() {

		//$this->ExportDoc->Text .= "my footer"; // Export footer
		//echo $this->ExportDoc->Text;

	}
} // End class
?>