<?php
namespace PHPMaker2020\BACKOFFICE_CADETERIAS;

/**
 * Page class
 */
class Cadete_list extends Cadete
{

	// Page ID
	public $PageID = "list";

	// Project ID
	public $ProjectID = "{68D35137-1670-419B-B841-52FFD5E14A4B}";

	// Table name
	public $TableName = 'Cadete';

	// Page object name
	public $PageObjName = "Cadete_list";

	// Grid form hidden field names
	public $FormName = "fCadetelist";
	public $FormActionName = "k_action";
	public $FormKeyName = "k_key";
	public $FormOldKeyName = "k_oldkey";
	public $FormBlankRowName = "k_blankrow";
	public $FormKeyCountName = "key_count";

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

		// Table object (Cadete)
		if (!isset($GLOBALS["Cadete"]) || get_class($GLOBALS["Cadete"]) == PROJECT_NAMESPACE . "Cadete") {
			$GLOBALS["Cadete"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["Cadete"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html";
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv";
		$this->AddUrl = "Cadeteadd.php";
		$this->InlineAddUrl = $this->pageUrl() . "action=add";
		$this->GridAddUrl = $this->pageUrl() . "action=gridadd";
		$this->GridEditUrl = $this->pageUrl() . "action=gridedit";
		$this->MultiDeleteUrl = "Cadetedelete.php";
		$this->MultiUpdateUrl = "Cadeteupdate.php";

		// Table object (Cadeteria)
		if (!isset($GLOBALS['Cadeteria']))
			$GLOBALS['Cadeteria'] = new Cadeteria();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'list');

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

		// List options
		$this->ListOptions = new ListOptions();
		$this->ListOptions->TableVar = $this->TableVar;

		// Export options
		$this->ExportOptions = new ListOptions("div");
		$this->ExportOptions->TagClassName = "ew-export-option";

		// Import options
		$this->ImportOptions = new ListOptions("div");
		$this->ImportOptions->TagClassName = "ew-import-option";

		// Other options
		if (!$this->OtherOptions)
			$this->OtherOptions = new ListOptionsArray();
		$this->OtherOptions["addedit"] = new ListOptions("div");
		$this->OtherOptions["addedit"]->TagClassName = "ew-add-edit-option";
		$this->OtherOptions["detail"] = new ListOptions("div");
		$this->OtherOptions["detail"]->TagClassName = "ew-detail-option";
		$this->OtherOptions["action"] = new ListOptions("div");
		$this->OtherOptions["action"]->TagClassName = "ew-action-option";

		// Filter options
		$this->FilterOptions = new ListOptions("div");
		$this->FilterOptions->TagClassName = "ew-filter-option fCadetelistsrch";

		// List actions
		$this->ListActions = new ListActions();
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
			SaveDebugMessage();
			AddHeader("Location", $url);
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
						if ($fld->DataType == DATATYPE_MEMO && $fld->MemoMaxLength > 0)
							$val = TruncateMemo($val, $fld->MemoMaxLength, $fld->TruncateMemoRemoveHtml);
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

	// Class variables
	public $ListOptions; // List options
	public $ExportOptions; // Export options
	public $SearchOptions; // Search options
	public $OtherOptions; // Other options
	public $FilterOptions; // Filter options
	public $ImportOptions; // Import options
	public $ListActions; // List actions
	public $SelectedCount = 0;
	public $SelectedIndex = 0;
	public $DisplayRecords = 20;
	public $StartRecord;
	public $StopRecord;
	public $TotalRecords = 0;
	public $RecordRange = 10;
	public $PageSizes = "10,20,50,-1"; // Page sizes (comma separated)
	public $DefaultSearchWhere = ""; // Default search WHERE clause
	public $SearchWhere = ""; // Search WHERE clause
	public $SearchPanelClass = "ew-search-panel collapse show"; // Search Panel class
	public $SearchRowCount = 0; // For extended search
	public $SearchColumnCount = 0; // For extended search
	public $SearchFieldsPerRow = 1; // For extended search
	public $RecordCount = 0; // Record count
	public $EditRowCount;
	public $StartRowCount = 1;
	public $RowCount = 0;
	public $Attrs = []; // Row attributes and cell attributes
	public $RowIndex = 0; // Row index
	public $KeyCount = 0; // Key count
	public $RowAction = ""; // Row action
	public $RowOldKey = ""; // Row old key (for copy)
	public $MultiColumnClass = "col-sm";
	public $MultiColumnEditClass = "w-100";
	public $DbMasterFilter = ""; // Master filter
	public $DbDetailFilter = ""; // Detail filter
	public $MasterRecordExists;
	public $MultiSelectKey;
	public $Command;
	public $RestoreSearch = FALSE;
	public $DetailPages;
	public $OldRecordset;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$FormError, $SearchError;

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
			if (!$Security->canList()) {
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
			if (!$Security->canList()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				$this->terminate(GetUrl("index.php"));
				return;
			}
			if ($Security->isLoggedIn()) {
				$Security->UserID_Loading();
				$Security->loadUserID();
				$Security->UserID_Loaded();
				if (strval($Security->currentUserID()) == "") {
					$this->setFailureMessage(DeniedMessage()); // Set no permission
					$this->terminate();
					return;
				}
			}
		}
		$this->CurrentAction = Param("action"); // Set up current action

		// Get grid add count
		$gridaddcnt = Get(Config("TABLE_GRID_ADD_ROW_COUNT"), "");
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->setupListOptions();
		$this->ID->setVisibility();
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

		// Setup other options
		$this->setupOtherOptions();

		// Set up custom action (compatible with old version)
		foreach ($this->CustomActions as $name => $action)
			$this->ListActions->add($name, $action);

		// Show checkbox column if multiple action
		foreach ($this->ListActions->Items as $listaction) {
			if ($listaction->Select == ACTION_MULTIPLE && $listaction->Allow) {
				$this->ListOptions["checkbox"]->Visible = TRUE;
				break;
			}
		}

		// Set up lookup cache
		// Search filters

		$srchAdvanced = ""; // Advanced search filter
		$srchBasic = ""; // Basic search filter
		$filter = "";

		// Get command
		$this->Command = strtolower(Get("cmd"));
		if ($this->isPageRequest()) { // Validate request

			// Process list action first
			if ($this->processListAction()) // Ajax request
				$this->terminate();

			// Set up records per page
			$this->setupDisplayRecords();

			// Handle reset command
			$this->resetCmd();

			// Set up Breadcrumb
			if (!$this->isExport())
				$this->setupBreadcrumb();

			// Hide list options
			if ($this->isExport()) {
				$this->ListOptions->hideAllOptions(["sequence"]);
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			} elseif ($this->isGridAdd() || $this->isGridEdit()) {
				$this->ListOptions->hideAllOptions();
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			}

			// Hide options
			if ($this->isExport() || $this->CurrentAction) {
				$this->ExportOptions->hideAllOptions();
				$this->FilterOptions->hideAllOptions();
				$this->ImportOptions->hideAllOptions();
			}

			// Hide other options
			if ($this->isExport())
				$this->OtherOptions->hideAllOptions();

			// Get default search criteria
			AddFilter($this->DefaultSearchWhere, $this->basicSearchWhere(TRUE));

			// Get basic search values
			$this->loadBasicSearchValues();

			// Process filter list
			if ($this->processFilterList())
				$this->terminate();

			// Restore search parms from Session if not searching / reset / export
			if (($this->isExport() || $this->Command != "search" && $this->Command != "reset" && $this->Command != "resetall") && $this->Command != "json" && $this->checkSearchParms())
				$this->restoreSearchParms();

			// Call Recordset SearchValidated event
			$this->Recordset_SearchValidated();

			// Set up sorting order
			$this->setupSortOrder();

			// Get basic search criteria
			if ($SearchError == "")
				$srchBasic = $this->basicSearchWhere();
		}

		// Restore display records
		if ($this->Command != "json" && $this->getRecordsPerPage() != "") {
			$this->DisplayRecords = $this->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecords = 20; // Load default
			$this->setRecordsPerPage($this->DisplayRecords); // Save default to Session
		}

		// Load Sorting Order
		if ($this->Command != "json")
			$this->loadSortOrder();

		// Load search default if no existing search criteria
		if (!$this->checkSearchParms()) {

			// Load basic search from default
			$this->BasicSearch->loadDefault();
			if ($this->BasicSearch->Keyword != "")
				$srchBasic = $this->basicSearchWhere();
		}

		// Build search criteria
		AddFilter($this->SearchWhere, $srchAdvanced);
		AddFilter($this->SearchWhere, $srchBasic);

		// Call Recordset_Searching event
		$this->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->Command == "search" && !$this->RestoreSearch) {
			$this->setSearchWhere($this->SearchWhere); // Save to Session
			$this->StartRecord = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRecord);
		} elseif ($this->Command != "json") {
			$this->SearchWhere = $this->getSearchWhere();
		}

		// Build filter
		$filter = "";
		if (!$Security->canList())
			$filter = "(0=1)"; // Filter all records
		AddFilter($filter, $this->DbDetailFilter);
		AddFilter($filter, $this->SearchWhere);

		// Set up filter
		if ($this->Command == "json") {
			$this->UseSessionForListSql = FALSE; // Do not use session for ListSQL
			$this->CurrentFilter = $filter;
		} else {
			$this->setSessionWhere($filter);
			$this->CurrentFilter = "";
		}
		if ($this->isGridAdd()) {
			$this->CurrentFilter = "0=1";
			$this->StartRecord = 1;
			$this->DisplayRecords = $this->GridAddRowCount;
			$this->TotalRecords = $this->DisplayRecords;
			$this->StopRecord = $this->DisplayRecords;
		} else {
			$selectLimit = $this->UseSelectLimit;
			if ($selectLimit) {
				$this->TotalRecords = $this->listRecordCount();
			} else {
				if ($this->Recordset = $this->loadRecordset())
					$this->TotalRecords = $this->Recordset->RecordCount();
			}
			$this->StartRecord = 1;
			if ($this->DisplayRecords <= 0 || ($this->isExport() && $this->ExportAll)) // Display all records
				$this->DisplayRecords = $this->TotalRecords;
			if (!($this->isExport() && $this->ExportAll)) // Set up start record position
				$this->setupStartRecord();
			if ($selectLimit)
				$this->Recordset = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords);

			// Set no record found message
			if (!$this->CurrentAction && $this->TotalRecords == 0) {
				if (!$Security->canList())
					$this->setWarningMessage(DeniedMessage());
				if ($this->SearchWhere == "0=101")
					$this->setWarningMessage($Language->phrase("EnterSearchCriteria"));
				else
					$this->setWarningMessage($Language->phrase("NoRecord"));
			}
		}

		// Search options
		$this->setupSearchOptions();

		// Set up search panel class
		if ($this->SearchWhere != "")
			AppendClass($this->SearchPanelClass, "show");

		// Normal return
		if (IsApi()) {
			$rows = $this->getRecordsFromRecordset($this->Recordset);
			$this->Recordset->close();
			WriteJson(["success" => TRUE, $this->TableVar => $rows, "totalRecordCount" => $this->TotalRecords]);
			$this->terminate(TRUE);
		}

		// Set up pager
		$this->Pager = new PrevNextPager($this->StartRecord, $this->getRecordsPerPage(), $this->TotalRecords, $this->PageSizes, $this->RecordRange, $this->AutoHidePager, $this->AutoHidePageSizeSelector);
	}

	// Set up number of records displayed per page
	protected function setupDisplayRecords()
	{
		$wrk = Get(Config("TABLE_REC_PER_PAGE"), "");
		if ($wrk != "") {
			if (is_numeric($wrk)) {
				$this->DisplayRecords = (int)$wrk;
			} else {
				if (SameText($wrk, "all")) { // Display all records
					$this->DisplayRecords = -1;
				} else {
					$this->DisplayRecords = 20; // Non-numeric, load default
				}
			}
			$this->setRecordsPerPage($this->DisplayRecords); // Save to Session

			// Reset start position
			$this->StartRecord = 1;
			$this->setStartRecordNumber($this->StartRecord);
		}
	}

	// Build filter for all keys
	protected function buildKeyFilter()
	{
		global $CurrentForm;
		$wrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$CurrentForm->Index = $rowindex;
		$thisKey = strval($CurrentForm->getValue($this->FormKeyName));
		while ($thisKey != "") {
			if ($this->setupKeyValues($thisKey)) {
				$filter = $this->getRecordFilter();
				if ($wrkFilter != "")
					$wrkFilter .= " OR ";
				$wrkFilter .= $filter;
			} else {
				$wrkFilter = "0=1";
				break;
			}

			// Update row index and get row key
			$rowindex++; // Next row
			$CurrentForm->Index = $rowindex;
			$thisKey = strval($CurrentForm->getValue($this->FormKeyName));
		}
		return $wrkFilter;
	}

	// Set up key values
	protected function setupKeyValues($key)
	{
		$arKeyFlds = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
		if (count($arKeyFlds) >= 1) {
			$this->ID->setOldValue($arKeyFlds[0]);
			if (!is_numeric($this->ID->OldValue))
				return FALSE;
		}
		return TRUE;
	}

	// Get list of filters
	public function getFilterList()
	{
		global $UserProfile;

		// Initialize
		$filterList = "";
		$savedFilterList = "";
		$filterList = Concat($filterList, $this->ID->AdvancedSearch->toJson(), ","); // Field ID
		$filterList = Concat($filterList, $this->FechaCreacion->AdvancedSearch->toJson(), ","); // Field FechaCreacion
		$filterList = Concat($filterList, $this->ID_Cadeteria->AdvancedSearch->toJson(), ","); // Field ID_Cadeteria
		$filterList = Concat($filterList, $this->ID_Status->AdvancedSearch->toJson(), ","); // Field ID_Status
		$filterList = Concat($filterList, $this->ID_CurrentStatus->AdvancedSearch->toJson(), ","); // Field ID_CurrentStatus
		$filterList = Concat($filterList, $this->Nombre->AdvancedSearch->toJson(), ","); // Field Nombre
		$filterList = Concat($filterList, $this->Apellido->AdvancedSearch->toJson(), ","); // Field Apellido
		$filterList = Concat($filterList, $this->DNI->AdvancedSearch->toJson(), ","); // Field DNI
		$filterList = Concat($filterList, $this->Celular->AdvancedSearch->toJson(), ","); // Field Celular
		$filterList = Concat($filterList, $this->Domicilio->AdvancedSearch->toJson(), ","); // Field Domicilio
		$filterList = Concat($filterList, $this->RealLat->AdvancedSearch->toJson(), ","); // Field RealLat
		$filterList = Concat($filterList, $this->RealLon->AdvancedSearch->toJson(), ","); // Field RealLon
		$filterList = Concat($filterList, $this->EstimatedLat->AdvancedSearch->toJson(), ","); // Field EstimatedLat
		$filterList = Concat($filterList, $this->EstimatedLon->AdvancedSearch->toJson(), ","); // Field EstimatedLon
		$filterList = Concat($filterList, $this->LUDesde->AdvancedSearch->toJson(), ","); // Field LUDesde
		$filterList = Concat($filterList, $this->LUHasta->AdvancedSearch->toJson(), ","); // Field LUHasta
		$filterList = Concat($filterList, $this->MADesde->AdvancedSearch->toJson(), ","); // Field MADesde
		$filterList = Concat($filterList, $this->MAHasta->AdvancedSearch->toJson(), ","); // Field MAHasta
		$filterList = Concat($filterList, $this->MIEDesde->AdvancedSearch->toJson(), ","); // Field MIEDesde
		$filterList = Concat($filterList, $this->MIEHasta->AdvancedSearch->toJson(), ","); // Field MIEHasta
		$filterList = Concat($filterList, $this->JUEDesde->AdvancedSearch->toJson(), ","); // Field JUEDesde
		$filterList = Concat($filterList, $this->JUEHasta->AdvancedSearch->toJson(), ","); // Field JUEHasta
		$filterList = Concat($filterList, $this->VIEDesde->AdvancedSearch->toJson(), ","); // Field VIEDesde
		$filterList = Concat($filterList, $this->VIEHasta->AdvancedSearch->toJson(), ","); // Field VIEHasta
		$filterList = Concat($filterList, $this->SABDesde->AdvancedSearch->toJson(), ","); // Field SABDesde
		$filterList = Concat($filterList, $this->SABHasta->AdvancedSearch->toJson(), ","); // Field SABHasta
		$filterList = Concat($filterList, $this->DOMDesde->AdvancedSearch->toJson(), ","); // Field DOMDesde
		$filterList = Concat($filterList, $this->DOMHasta->AdvancedSearch->toJson(), ","); // Field DOMHasta
		$filterList = Concat($filterList, $this->Foto->AdvancedSearch->toJson(), ","); // Field Foto
		if ($this->BasicSearch->Keyword != "") {
			$wrk = "\"" . Config("TABLE_BASIC_SEARCH") . "\":\"" . JsEncode($this->BasicSearch->Keyword) . "\",\"" . Config("TABLE_BASIC_SEARCH_TYPE") . "\":\"" . JsEncode($this->BasicSearch->Type) . "\"";
			$filterList = Concat($filterList, $wrk, ",");
		}

		// Return filter list in JSON
		if ($filterList != "")
			$filterList = "\"data\":{" . $filterList . "}";
		if ($savedFilterList != "")
			$filterList = Concat($filterList, "\"filters\":" . $savedFilterList, ",");
		return ($filterList != "") ? "{" . $filterList . "}" : "null";
	}

	// Process filter list
	protected function processFilterList()
	{
		global $UserProfile;
		if (Post("ajax") == "savefilters") { // Save filter request (Ajax)
			$filters = Post("filters");
			$UserProfile->setSearchFilters(CurrentUserName(), "fCadetelistsrch", $filters);
			WriteJson([["success" => TRUE]]); // Success
			return TRUE;
		} elseif (Post("cmd") == "resetfilter") {
			$this->restoreFilterList();
		}
		return FALSE;
	}

	// Restore list of filters
	protected function restoreFilterList()
	{

		// Return if not reset filter
		if (Post("cmd") !== "resetfilter")
			return FALSE;
		$filter = json_decode(Post("filter"), TRUE);
		$this->Command = "search";

		// Field ID
		$this->ID->AdvancedSearch->SearchValue = @$filter["x_ID"];
		$this->ID->AdvancedSearch->SearchOperator = @$filter["z_ID"];
		$this->ID->AdvancedSearch->SearchCondition = @$filter["v_ID"];
		$this->ID->AdvancedSearch->SearchValue2 = @$filter["y_ID"];
		$this->ID->AdvancedSearch->SearchOperator2 = @$filter["w_ID"];
		$this->ID->AdvancedSearch->save();

		// Field FechaCreacion
		$this->FechaCreacion->AdvancedSearch->SearchValue = @$filter["x_FechaCreacion"];
		$this->FechaCreacion->AdvancedSearch->SearchOperator = @$filter["z_FechaCreacion"];
		$this->FechaCreacion->AdvancedSearch->SearchCondition = @$filter["v_FechaCreacion"];
		$this->FechaCreacion->AdvancedSearch->SearchValue2 = @$filter["y_FechaCreacion"];
		$this->FechaCreacion->AdvancedSearch->SearchOperator2 = @$filter["w_FechaCreacion"];
		$this->FechaCreacion->AdvancedSearch->save();

		// Field ID_Cadeteria
		$this->ID_Cadeteria->AdvancedSearch->SearchValue = @$filter["x_ID_Cadeteria"];
		$this->ID_Cadeteria->AdvancedSearch->SearchOperator = @$filter["z_ID_Cadeteria"];
		$this->ID_Cadeteria->AdvancedSearch->SearchCondition = @$filter["v_ID_Cadeteria"];
		$this->ID_Cadeteria->AdvancedSearch->SearchValue2 = @$filter["y_ID_Cadeteria"];
		$this->ID_Cadeteria->AdvancedSearch->SearchOperator2 = @$filter["w_ID_Cadeteria"];
		$this->ID_Cadeteria->AdvancedSearch->save();

		// Field ID_Status
		$this->ID_Status->AdvancedSearch->SearchValue = @$filter["x_ID_Status"];
		$this->ID_Status->AdvancedSearch->SearchOperator = @$filter["z_ID_Status"];
		$this->ID_Status->AdvancedSearch->SearchCondition = @$filter["v_ID_Status"];
		$this->ID_Status->AdvancedSearch->SearchValue2 = @$filter["y_ID_Status"];
		$this->ID_Status->AdvancedSearch->SearchOperator2 = @$filter["w_ID_Status"];
		$this->ID_Status->AdvancedSearch->save();

		// Field ID_CurrentStatus
		$this->ID_CurrentStatus->AdvancedSearch->SearchValue = @$filter["x_ID_CurrentStatus"];
		$this->ID_CurrentStatus->AdvancedSearch->SearchOperator = @$filter["z_ID_CurrentStatus"];
		$this->ID_CurrentStatus->AdvancedSearch->SearchCondition = @$filter["v_ID_CurrentStatus"];
		$this->ID_CurrentStatus->AdvancedSearch->SearchValue2 = @$filter["y_ID_CurrentStatus"];
		$this->ID_CurrentStatus->AdvancedSearch->SearchOperator2 = @$filter["w_ID_CurrentStatus"];
		$this->ID_CurrentStatus->AdvancedSearch->save();

		// Field Nombre
		$this->Nombre->AdvancedSearch->SearchValue = @$filter["x_Nombre"];
		$this->Nombre->AdvancedSearch->SearchOperator = @$filter["z_Nombre"];
		$this->Nombre->AdvancedSearch->SearchCondition = @$filter["v_Nombre"];
		$this->Nombre->AdvancedSearch->SearchValue2 = @$filter["y_Nombre"];
		$this->Nombre->AdvancedSearch->SearchOperator2 = @$filter["w_Nombre"];
		$this->Nombre->AdvancedSearch->save();

		// Field Apellido
		$this->Apellido->AdvancedSearch->SearchValue = @$filter["x_Apellido"];
		$this->Apellido->AdvancedSearch->SearchOperator = @$filter["z_Apellido"];
		$this->Apellido->AdvancedSearch->SearchCondition = @$filter["v_Apellido"];
		$this->Apellido->AdvancedSearch->SearchValue2 = @$filter["y_Apellido"];
		$this->Apellido->AdvancedSearch->SearchOperator2 = @$filter["w_Apellido"];
		$this->Apellido->AdvancedSearch->save();

		// Field DNI
		$this->DNI->AdvancedSearch->SearchValue = @$filter["x_DNI"];
		$this->DNI->AdvancedSearch->SearchOperator = @$filter["z_DNI"];
		$this->DNI->AdvancedSearch->SearchCondition = @$filter["v_DNI"];
		$this->DNI->AdvancedSearch->SearchValue2 = @$filter["y_DNI"];
		$this->DNI->AdvancedSearch->SearchOperator2 = @$filter["w_DNI"];
		$this->DNI->AdvancedSearch->save();

		// Field Celular
		$this->Celular->AdvancedSearch->SearchValue = @$filter["x_Celular"];
		$this->Celular->AdvancedSearch->SearchOperator = @$filter["z_Celular"];
		$this->Celular->AdvancedSearch->SearchCondition = @$filter["v_Celular"];
		$this->Celular->AdvancedSearch->SearchValue2 = @$filter["y_Celular"];
		$this->Celular->AdvancedSearch->SearchOperator2 = @$filter["w_Celular"];
		$this->Celular->AdvancedSearch->save();

		// Field Domicilio
		$this->Domicilio->AdvancedSearch->SearchValue = @$filter["x_Domicilio"];
		$this->Domicilio->AdvancedSearch->SearchOperator = @$filter["z_Domicilio"];
		$this->Domicilio->AdvancedSearch->SearchCondition = @$filter["v_Domicilio"];
		$this->Domicilio->AdvancedSearch->SearchValue2 = @$filter["y_Domicilio"];
		$this->Domicilio->AdvancedSearch->SearchOperator2 = @$filter["w_Domicilio"];
		$this->Domicilio->AdvancedSearch->save();

		// Field RealLat
		$this->RealLat->AdvancedSearch->SearchValue = @$filter["x_RealLat"];
		$this->RealLat->AdvancedSearch->SearchOperator = @$filter["z_RealLat"];
		$this->RealLat->AdvancedSearch->SearchCondition = @$filter["v_RealLat"];
		$this->RealLat->AdvancedSearch->SearchValue2 = @$filter["y_RealLat"];
		$this->RealLat->AdvancedSearch->SearchOperator2 = @$filter["w_RealLat"];
		$this->RealLat->AdvancedSearch->save();

		// Field RealLon
		$this->RealLon->AdvancedSearch->SearchValue = @$filter["x_RealLon"];
		$this->RealLon->AdvancedSearch->SearchOperator = @$filter["z_RealLon"];
		$this->RealLon->AdvancedSearch->SearchCondition = @$filter["v_RealLon"];
		$this->RealLon->AdvancedSearch->SearchValue2 = @$filter["y_RealLon"];
		$this->RealLon->AdvancedSearch->SearchOperator2 = @$filter["w_RealLon"];
		$this->RealLon->AdvancedSearch->save();

		// Field EstimatedLat
		$this->EstimatedLat->AdvancedSearch->SearchValue = @$filter["x_EstimatedLat"];
		$this->EstimatedLat->AdvancedSearch->SearchOperator = @$filter["z_EstimatedLat"];
		$this->EstimatedLat->AdvancedSearch->SearchCondition = @$filter["v_EstimatedLat"];
		$this->EstimatedLat->AdvancedSearch->SearchValue2 = @$filter["y_EstimatedLat"];
		$this->EstimatedLat->AdvancedSearch->SearchOperator2 = @$filter["w_EstimatedLat"];
		$this->EstimatedLat->AdvancedSearch->save();

		// Field EstimatedLon
		$this->EstimatedLon->AdvancedSearch->SearchValue = @$filter["x_EstimatedLon"];
		$this->EstimatedLon->AdvancedSearch->SearchOperator = @$filter["z_EstimatedLon"];
		$this->EstimatedLon->AdvancedSearch->SearchCondition = @$filter["v_EstimatedLon"];
		$this->EstimatedLon->AdvancedSearch->SearchValue2 = @$filter["y_EstimatedLon"];
		$this->EstimatedLon->AdvancedSearch->SearchOperator2 = @$filter["w_EstimatedLon"];
		$this->EstimatedLon->AdvancedSearch->save();

		// Field LUDesde
		$this->LUDesde->AdvancedSearch->SearchValue = @$filter["x_LUDesde"];
		$this->LUDesde->AdvancedSearch->SearchOperator = @$filter["z_LUDesde"];
		$this->LUDesde->AdvancedSearch->SearchCondition = @$filter["v_LUDesde"];
		$this->LUDesde->AdvancedSearch->SearchValue2 = @$filter["y_LUDesde"];
		$this->LUDesde->AdvancedSearch->SearchOperator2 = @$filter["w_LUDesde"];
		$this->LUDesde->AdvancedSearch->save();

		// Field LUHasta
		$this->LUHasta->AdvancedSearch->SearchValue = @$filter["x_LUHasta"];
		$this->LUHasta->AdvancedSearch->SearchOperator = @$filter["z_LUHasta"];
		$this->LUHasta->AdvancedSearch->SearchCondition = @$filter["v_LUHasta"];
		$this->LUHasta->AdvancedSearch->SearchValue2 = @$filter["y_LUHasta"];
		$this->LUHasta->AdvancedSearch->SearchOperator2 = @$filter["w_LUHasta"];
		$this->LUHasta->AdvancedSearch->save();

		// Field MADesde
		$this->MADesde->AdvancedSearch->SearchValue = @$filter["x_MADesde"];
		$this->MADesde->AdvancedSearch->SearchOperator = @$filter["z_MADesde"];
		$this->MADesde->AdvancedSearch->SearchCondition = @$filter["v_MADesde"];
		$this->MADesde->AdvancedSearch->SearchValue2 = @$filter["y_MADesde"];
		$this->MADesde->AdvancedSearch->SearchOperator2 = @$filter["w_MADesde"];
		$this->MADesde->AdvancedSearch->save();

		// Field MAHasta
		$this->MAHasta->AdvancedSearch->SearchValue = @$filter["x_MAHasta"];
		$this->MAHasta->AdvancedSearch->SearchOperator = @$filter["z_MAHasta"];
		$this->MAHasta->AdvancedSearch->SearchCondition = @$filter["v_MAHasta"];
		$this->MAHasta->AdvancedSearch->SearchValue2 = @$filter["y_MAHasta"];
		$this->MAHasta->AdvancedSearch->SearchOperator2 = @$filter["w_MAHasta"];
		$this->MAHasta->AdvancedSearch->save();

		// Field MIEDesde
		$this->MIEDesde->AdvancedSearch->SearchValue = @$filter["x_MIEDesde"];
		$this->MIEDesde->AdvancedSearch->SearchOperator = @$filter["z_MIEDesde"];
		$this->MIEDesde->AdvancedSearch->SearchCondition = @$filter["v_MIEDesde"];
		$this->MIEDesde->AdvancedSearch->SearchValue2 = @$filter["y_MIEDesde"];
		$this->MIEDesde->AdvancedSearch->SearchOperator2 = @$filter["w_MIEDesde"];
		$this->MIEDesde->AdvancedSearch->save();

		// Field MIEHasta
		$this->MIEHasta->AdvancedSearch->SearchValue = @$filter["x_MIEHasta"];
		$this->MIEHasta->AdvancedSearch->SearchOperator = @$filter["z_MIEHasta"];
		$this->MIEHasta->AdvancedSearch->SearchCondition = @$filter["v_MIEHasta"];
		$this->MIEHasta->AdvancedSearch->SearchValue2 = @$filter["y_MIEHasta"];
		$this->MIEHasta->AdvancedSearch->SearchOperator2 = @$filter["w_MIEHasta"];
		$this->MIEHasta->AdvancedSearch->save();

		// Field JUEDesde
		$this->JUEDesde->AdvancedSearch->SearchValue = @$filter["x_JUEDesde"];
		$this->JUEDesde->AdvancedSearch->SearchOperator = @$filter["z_JUEDesde"];
		$this->JUEDesde->AdvancedSearch->SearchCondition = @$filter["v_JUEDesde"];
		$this->JUEDesde->AdvancedSearch->SearchValue2 = @$filter["y_JUEDesde"];
		$this->JUEDesde->AdvancedSearch->SearchOperator2 = @$filter["w_JUEDesde"];
		$this->JUEDesde->AdvancedSearch->save();

		// Field JUEHasta
		$this->JUEHasta->AdvancedSearch->SearchValue = @$filter["x_JUEHasta"];
		$this->JUEHasta->AdvancedSearch->SearchOperator = @$filter["z_JUEHasta"];
		$this->JUEHasta->AdvancedSearch->SearchCondition = @$filter["v_JUEHasta"];
		$this->JUEHasta->AdvancedSearch->SearchValue2 = @$filter["y_JUEHasta"];
		$this->JUEHasta->AdvancedSearch->SearchOperator2 = @$filter["w_JUEHasta"];
		$this->JUEHasta->AdvancedSearch->save();

		// Field VIEDesde
		$this->VIEDesde->AdvancedSearch->SearchValue = @$filter["x_VIEDesde"];
		$this->VIEDesde->AdvancedSearch->SearchOperator = @$filter["z_VIEDesde"];
		$this->VIEDesde->AdvancedSearch->SearchCondition = @$filter["v_VIEDesde"];
		$this->VIEDesde->AdvancedSearch->SearchValue2 = @$filter["y_VIEDesde"];
		$this->VIEDesde->AdvancedSearch->SearchOperator2 = @$filter["w_VIEDesde"];
		$this->VIEDesde->AdvancedSearch->save();

		// Field VIEHasta
		$this->VIEHasta->AdvancedSearch->SearchValue = @$filter["x_VIEHasta"];
		$this->VIEHasta->AdvancedSearch->SearchOperator = @$filter["z_VIEHasta"];
		$this->VIEHasta->AdvancedSearch->SearchCondition = @$filter["v_VIEHasta"];
		$this->VIEHasta->AdvancedSearch->SearchValue2 = @$filter["y_VIEHasta"];
		$this->VIEHasta->AdvancedSearch->SearchOperator2 = @$filter["w_VIEHasta"];
		$this->VIEHasta->AdvancedSearch->save();

		// Field SABDesde
		$this->SABDesde->AdvancedSearch->SearchValue = @$filter["x_SABDesde"];
		$this->SABDesde->AdvancedSearch->SearchOperator = @$filter["z_SABDesde"];
		$this->SABDesde->AdvancedSearch->SearchCondition = @$filter["v_SABDesde"];
		$this->SABDesde->AdvancedSearch->SearchValue2 = @$filter["y_SABDesde"];
		$this->SABDesde->AdvancedSearch->SearchOperator2 = @$filter["w_SABDesde"];
		$this->SABDesde->AdvancedSearch->save();

		// Field SABHasta
		$this->SABHasta->AdvancedSearch->SearchValue = @$filter["x_SABHasta"];
		$this->SABHasta->AdvancedSearch->SearchOperator = @$filter["z_SABHasta"];
		$this->SABHasta->AdvancedSearch->SearchCondition = @$filter["v_SABHasta"];
		$this->SABHasta->AdvancedSearch->SearchValue2 = @$filter["y_SABHasta"];
		$this->SABHasta->AdvancedSearch->SearchOperator2 = @$filter["w_SABHasta"];
		$this->SABHasta->AdvancedSearch->save();

		// Field DOMDesde
		$this->DOMDesde->AdvancedSearch->SearchValue = @$filter["x_DOMDesde"];
		$this->DOMDesde->AdvancedSearch->SearchOperator = @$filter["z_DOMDesde"];
		$this->DOMDesde->AdvancedSearch->SearchCondition = @$filter["v_DOMDesde"];
		$this->DOMDesde->AdvancedSearch->SearchValue2 = @$filter["y_DOMDesde"];
		$this->DOMDesde->AdvancedSearch->SearchOperator2 = @$filter["w_DOMDesde"];
		$this->DOMDesde->AdvancedSearch->save();

		// Field DOMHasta
		$this->DOMHasta->AdvancedSearch->SearchValue = @$filter["x_DOMHasta"];
		$this->DOMHasta->AdvancedSearch->SearchOperator = @$filter["z_DOMHasta"];
		$this->DOMHasta->AdvancedSearch->SearchCondition = @$filter["v_DOMHasta"];
		$this->DOMHasta->AdvancedSearch->SearchValue2 = @$filter["y_DOMHasta"];
		$this->DOMHasta->AdvancedSearch->SearchOperator2 = @$filter["w_DOMHasta"];
		$this->DOMHasta->AdvancedSearch->save();

		// Field Foto
		$this->Foto->AdvancedSearch->SearchValue = @$filter["x_Foto"];
		$this->Foto->AdvancedSearch->SearchOperator = @$filter["z_Foto"];
		$this->Foto->AdvancedSearch->SearchCondition = @$filter["v_Foto"];
		$this->Foto->AdvancedSearch->SearchValue2 = @$filter["y_Foto"];
		$this->Foto->AdvancedSearch->SearchOperator2 = @$filter["w_Foto"];
		$this->Foto->AdvancedSearch->save();
		$this->BasicSearch->setKeyword(@$filter[Config("TABLE_BASIC_SEARCH")]);
		$this->BasicSearch->setType(@$filter[Config("TABLE_BASIC_SEARCH_TYPE")]);
	}

	// Return basic search SQL
	protected function basicSearchSql($arKeywords, $type)
	{
		$where = "";
		$this->buildBasicSearchSql($where, $this->Nombre, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Apellido, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->DNI, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Celular, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Domicilio, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Foto, $arKeywords, $type);
		return $where;
	}

	// Build basic search SQL
	protected function buildBasicSearchSql(&$where, &$fld, $arKeywords, $type)
	{
		$defCond = ($type == "OR") ? "OR" : "AND";
		$arSql = []; // Array for SQL parts
		$arCond = []; // Array for search conditions
		$cnt = count($arKeywords);
		$j = 0; // Number of SQL parts
		for ($i = 0; $i < $cnt; $i++) {
			$keyword = $arKeywords[$i];
			$keyword = trim($keyword);
			if (Config("BASIC_SEARCH_IGNORE_PATTERN") != "") {
				$keyword = preg_replace(Config("BASIC_SEARCH_IGNORE_PATTERN"), "\\", $keyword);
				$ar = explode("\\", $keyword);
			} else {
				$ar = [$keyword];
			}
			foreach ($ar as $keyword) {
				if ($keyword != "") {
					$wrk = "";
					if ($keyword == "OR" && $type == "") {
						if ($j > 0)
							$arCond[$j - 1] = "OR";
					} elseif ($keyword == Config("NULL_VALUE")) {
						$wrk = $fld->Expression . " IS NULL";
					} elseif ($keyword == Config("NOT_NULL_VALUE")) {
						$wrk = $fld->Expression . " IS NOT NULL";
					} elseif ($fld->IsVirtual) {
						$wrk = $fld->VirtualExpression . Like(QuotedValue("%" . $keyword . "%", DATATYPE_STRING, $this->Dbid), $this->Dbid);
					} elseif ($fld->DataType != DATATYPE_NUMBER || is_numeric($keyword)) {
						$wrk = $fld->BasicSearchExpression . Like(QuotedValue("%" . $keyword . "%", DATATYPE_STRING, $this->Dbid), $this->Dbid);
					}
					if ($wrk != "") {
						$arSql[$j] = $wrk;
						$arCond[$j] = $defCond;
						$j += 1;
					}
				}
			}
		}
		$cnt = count($arSql);
		$quoted = FALSE;
		$sql = "";
		if ($cnt > 0) {
			for ($i = 0; $i < $cnt - 1; $i++) {
				if ($arCond[$i] == "OR") {
					if (!$quoted)
						$sql .= "(";
					$quoted = TRUE;
				}
				$sql .= $arSql[$i];
				if ($quoted && $arCond[$i] != "OR") {
					$sql .= ")";
					$quoted = FALSE;
				}
				$sql .= " " . $arCond[$i] . " ";
			}
			$sql .= $arSql[$cnt - 1];
			if ($quoted)
				$sql .= ")";
		}
		if ($sql != "") {
			if ($where != "")
				$where .= " OR ";
			$where .= "(" . $sql . ")";
		}
	}

	// Return basic search WHERE clause based on search keyword and type
	protected function basicSearchWhere($default = FALSE)
	{
		global $Security;
		$searchStr = "";
		if (!$Security->canSearch())
			return "";
		$searchKeyword = ($default) ? $this->BasicSearch->KeywordDefault : $this->BasicSearch->Keyword;
		$searchType = ($default) ? $this->BasicSearch->TypeDefault : $this->BasicSearch->Type;

		// Get search SQL
		if ($searchKeyword != "") {
			$ar = $this->BasicSearch->keywordList($default);

			// Search keyword in any fields
			if (($searchType == "OR" || $searchType == "AND") && $this->BasicSearch->BasicSearchAnyFields) {
				foreach ($ar as $keyword) {
					if ($keyword != "") {
						if ($searchStr != "")
							$searchStr .= " " . $searchType . " ";
						$searchStr .= "(" . $this->basicSearchSql([$keyword], $searchType) . ")";
					}
				}
			} else {
				$searchStr = $this->basicSearchSql($ar, $searchType);
			}
			if (!$default && in_array($this->Command, ["", "reset", "resetall"]))
				$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->BasicSearch->setKeyword($searchKeyword);
			$this->BasicSearch->setType($searchType);
		}
		return $searchStr;
	}

	// Check if search parm exists
	protected function checkSearchParms()
	{

		// Check basic search
		if ($this->BasicSearch->issetSession())
			return TRUE;
		return FALSE;
	}

	// Clear all search parameters
	protected function resetSearchParms()
	{

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$this->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->resetBasicSearchParms();
	}

	// Load advanced search default values
	protected function loadAdvancedSearchDefault()
	{
		return FALSE;
	}

	// Clear all basic search parameters
	protected function resetBasicSearchParms()
	{
		$this->BasicSearch->unsetSession();
	}

	// Restore all search parameters
	protected function restoreSearchParms()
	{
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->load();
	}

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
			$this->updateSort($this->ID); // ID
			$this->updateSort($this->FechaCreacion); // FechaCreacion
			$this->updateSort($this->ID_Cadeteria); // ID_Cadeteria
			$this->updateSort($this->ID_Status); // ID_Status
			$this->updateSort($this->ID_CurrentStatus); // ID_CurrentStatus
			$this->updateSort($this->Nombre); // Nombre
			$this->updateSort($this->Apellido); // Apellido
			$this->updateSort($this->DNI); // DNI
			$this->updateSort($this->Celular); // Celular
			$this->updateSort($this->Domicilio); // Domicilio
			$this->updateSort($this->RealLat); // RealLat
			$this->updateSort($this->RealLon); // RealLon
			$this->updateSort($this->EstimatedLat); // EstimatedLat
			$this->updateSort($this->EstimatedLon); // EstimatedLon
			$this->updateSort($this->LUDesde); // LUDesde
			$this->updateSort($this->LUHasta); // LUHasta
			$this->updateSort($this->MADesde); // MADesde
			$this->updateSort($this->MAHasta); // MAHasta
			$this->updateSort($this->MIEDesde); // MIEDesde
			$this->updateSort($this->MIEHasta); // MIEHasta
			$this->updateSort($this->JUEDesde); // JUEDesde
			$this->updateSort($this->JUEHasta); // JUEHasta
			$this->updateSort($this->VIEDesde); // VIEDesde
			$this->updateSort($this->VIEHasta); // VIEHasta
			$this->updateSort($this->SABDesde); // SABDesde
			$this->updateSort($this->SABHasta); // SABHasta
			$this->updateSort($this->DOMDesde); // DOMDesde
			$this->updateSort($this->DOMHasta); // DOMHasta
			$this->updateSort($this->Foto); // Foto
			$this->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	protected function loadSortOrder()
	{
		$orderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
		if ($orderBy == "") {
			if ($this->getSqlOrderBy() != "") {
				$orderBy = $this->getSqlOrderBy();
				$this->setSessionOrderBy($orderBy);
			}
		}
	}

	// Reset command
	// - cmd=reset (Reset search parameters)
	// - cmd=resetall (Reset search and master/detail parameters)
	// - cmd=resetsort (Reset sort parameters)

	protected function resetCmd()
	{

		// Check if reset command
		if (StartsString("reset", $this->Command)) {

			// Reset search criteria
			if ($this->Command == "reset" || $this->Command == "resetall")
				$this->resetSearchParms();

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$orderBy = "";
				$this->setSessionOrderBy($orderBy);
				$this->ID->setSort("");
				$this->FechaCreacion->setSort("");
				$this->ID_Cadeteria->setSort("");
				$this->ID_Status->setSort("");
				$this->ID_CurrentStatus->setSort("");
				$this->Nombre->setSort("");
				$this->Apellido->setSort("");
				$this->DNI->setSort("");
				$this->Celular->setSort("");
				$this->Domicilio->setSort("");
				$this->RealLat->setSort("");
				$this->RealLon->setSort("");
				$this->EstimatedLat->setSort("");
				$this->EstimatedLon->setSort("");
				$this->LUDesde->setSort("");
				$this->LUHasta->setSort("");
				$this->MADesde->setSort("");
				$this->MAHasta->setSort("");
				$this->MIEDesde->setSort("");
				$this->MIEHasta->setSort("");
				$this->JUEDesde->setSort("");
				$this->JUEHasta->setSort("");
				$this->VIEDesde->setSort("");
				$this->VIEHasta->setSort("");
				$this->SABDesde->setSort("");
				$this->SABHasta->setSort("");
				$this->DOMDesde->setSort("");
				$this->DOMHasta->setSort("");
				$this->Foto->setSort("");
			}

			// Reset start position
			$this->StartRecord = 1;
			$this->setStartRecordNumber($this->StartRecord);
		}
	}

	// Set up list options
	protected function setupListOptions()
	{
		global $Security, $Language;

		// Add group option item
		$item = &$this->ListOptions->add($this->ListOptions->GroupOptionName);
		$item->Body = "";
		$item->OnLeft = FALSE;
		$item->Visible = FALSE;

		// "view"
		$item = &$this->ListOptions->add("view");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canView();
		$item->OnLeft = FALSE;

		// "edit"
		$item = &$this->ListOptions->add("edit");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canEdit();
		$item->OnLeft = FALSE;

		// "copy"
		$item = &$this->ListOptions->add("copy");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canAdd();
		$item->OnLeft = FALSE;

		// "delete"
		$item = &$this->ListOptions->add("delete");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canDelete();
		$item->OnLeft = FALSE;

		// List actions
		$item = &$this->ListOptions->add("listactions");
		$item->CssClass = "text-nowrap";
		$item->OnLeft = FALSE;
		$item->Visible = FALSE;
		$item->ShowInButtonGroup = FALSE;
		$item->ShowInDropDown = FALSE;

		// "checkbox"
		$item = &$this->ListOptions->add("checkbox");
		$item->Visible = FALSE;
		$item->OnLeft = FALSE;
		$item->Header = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" name=\"key\" id=\"key\" class=\"custom-control-input\" onclick=\"ew.selectAllKey(this);\"><label class=\"custom-control-label\" for=\"key\"></label></div>";
		$item->ShowInDropDown = FALSE;
		$item->ShowInButtonGroup = FALSE;

		// Drop down button for ListOptions
		$this->ListOptions->UseDropDownButton = FALSE;
		$this->ListOptions->DropDownButtonPhrase = $Language->phrase("ButtonListOptions");
		$this->ListOptions->UseButtonGroup = FALSE;
		if ($this->ListOptions->UseButtonGroup && IsMobile())
			$this->ListOptions->UseDropDownButton = TRUE;

		//$this->ListOptions->ButtonClass = ""; // Class for button group
		// Call ListOptions_Load event

		$this->ListOptions_Load();
		$this->setupListOptionsExt();
		$item = $this->ListOptions[$this->ListOptions->GroupOptionName];
		$item->Visible = $this->ListOptions->groupOptionVisible();
	}

	// Render list options
	public function renderListOptions()
	{
		global $Security, $Language, $CurrentForm;
		$this->ListOptions->loadDefault();

		// Call ListOptions_Rendering event
		$this->ListOptions_Rendering();

		// "view"
		$opt = $this->ListOptions["view"];
		$viewcaption = HtmlTitle($Language->phrase("ViewLink"));
		if ($Security->canView() && $this->showOptionLink('view')) {
			$opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-caption=\"" . $viewcaption . "\" href=\"" . HtmlEncode($this->ViewUrl) . "\">" . $Language->phrase("ViewLink") . "</a>";
		} else {
			$opt->Body = "";
		}

		// "edit"
		$opt = $this->ListOptions["edit"];
		$editcaption = HtmlTitle($Language->phrase("EditLink"));
		if ($Security->canEdit() && $this->showOptionLink('edit')) {
			$opt->Body = "<a class=\"ew-row-link ew-edit\" title=\"" . HtmlTitle($Language->phrase("EditLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("EditLink")) . "\" href=\"" . HtmlEncode($this->EditUrl) . "\">" . $Language->phrase("EditLink") . "</a>";
		} else {
			$opt->Body = "";
		}

		// "copy"
		$opt = $this->ListOptions["copy"];
		$copycaption = HtmlTitle($Language->phrase("CopyLink"));
		if ($Security->canAdd() && $this->showOptionLink('add')) {
			$opt->Body = "<a class=\"ew-row-link ew-copy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"" . HtmlEncode($this->CopyUrl) . "\">" . $Language->phrase("CopyLink") . "</a>";
		} else {
			$opt->Body = "";
		}

		// "delete"
		$opt = $this->ListOptions["delete"];
		if ($Security->canDelete() && $this->showOptionLink('delete'))
			$opt->Body = "<a class=\"ew-row-link ew-delete\"" . "" . " title=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" href=\"" . HtmlEncode($this->DeleteUrl) . "\">" . $Language->phrase("DeleteLink") . "</a>";
		else
			$opt->Body = "";

		// Set up list action buttons
		$opt = $this->ListOptions["listactions"];
		if ($opt && !$this->isExport() && !$this->CurrentAction) {
			$body = "";
			$links = [];
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == ACTION_SINGLE && $listaction->Allow) {
					$action = $listaction->Action;
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon != "") ? "<i class=\"" . HtmlEncode(str_replace(" ew-icon", "", $listaction->Icon)) . "\" data-caption=\"" . HtmlTitle($caption) . "\"></i> " : "";
					$links[] = "<li><a class=\"dropdown-item ew-action ew-list-action\" data-action=\"" . HtmlEncode($action) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({key:" . $this->keyToJson(TRUE) . "}," . $listaction->toJson(TRUE) . "));\">" . $icon . $listaction->Caption . "</a></li>";
					if (count($links) == 1) // Single button
						$body = "<a class=\"ew-action ew-list-action\" data-action=\"" . HtmlEncode($action) . "\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({key:" . $this->keyToJson(TRUE) . "}," . $listaction->toJson(TRUE) . "));\">" . $icon . $listaction->Caption . "</a>";
				}
			}
			if (count($links) > 1) { // More than one buttons, use dropdown
				$body = "<button class=\"dropdown-toggle btn btn-default ew-actions\" title=\"" . HtmlTitle($Language->phrase("ListActionButton")) . "\" data-toggle=\"dropdown\">" . $Language->phrase("ListActionButton") . "</button>";
				$content = "";
				foreach ($links as $link)
					$content .= "<li>" . $link . "</li>";
				$body .= "<ul class=\"dropdown-menu" . ($opt->OnLeft ? "" : " dropdown-menu-right") . "\">". $content . "</ul>";
				$body = "<div class=\"btn-group btn-group-sm\">" . $body . "</div>";
			}
			if (count($links) > 0) {
				$opt->Body = $body;
				$opt->Visible = TRUE;
			}
		}

		// "checkbox"
		$opt = $this->ListOptions["checkbox"];
		$opt->Body = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"custom-control-input ew-multi-select\" value=\"" . HtmlEncode($this->ID->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\"><label class=\"custom-control-label\" for=\"key_m_" . $this->RowCount . "\"></label></div>";
		$this->renderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set up other options
	protected function setupOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = $options["addedit"];

		// Add
		$item = &$option->add("add");
		$addcaption = HtmlTitle($Language->phrase("AddLink"));
		$item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode($this->AddUrl) . "\">" . $Language->phrase("AddLink") . "</a>";
		$item->Visible = $this->AddUrl != "" && $Security->canAdd();
		$option = $options["action"];

		// Set up options default
		foreach ($options as $option) {
			$option->UseDropDownButton = FALSE;
			$option->UseButtonGroup = TRUE;

			//$option->ButtonClass = ""; // Class for button group
			$item = &$option->add($option->GroupOptionName);
			$item->Body = "";
			$item->Visible = FALSE;
		}
		$options["addedit"]->DropDownButtonPhrase = $Language->phrase("ButtonAddEdit");
		$options["detail"]->DropDownButtonPhrase = $Language->phrase("ButtonDetails");
		$options["action"]->DropDownButtonPhrase = $Language->phrase("ButtonActions");

		// Filter button
		$item = &$this->FilterOptions->add("savecurrentfilter");
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"fCadetelistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"fCadetelistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
		$item->Visible = TRUE;
		$this->FilterOptions->UseDropDownButton = TRUE;
		$this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
		$this->FilterOptions->DropDownButtonPhrase = $Language->phrase("Filters");

		// Add group option item
		$item = &$this->FilterOptions->add($this->FilterOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Render other options
	public function renderOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
			$option = $options["action"];

			// Set up list action buttons
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == ACTION_MULTIPLE) {
					$item = &$option->add("custom_" . $listaction->Action);
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon != "") ? "<i class=\"" . HtmlEncode($listaction->Icon) . "\" data-caption=\"" . HtmlEncode($caption) . "\"></i> " . $caption : $caption;
					$item->Body = "<a class=\"ew-action ew-list-action\" title=\"" . HtmlEncode($caption) . "\" data-caption=\"" . HtmlEncode($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({f:document.fCadetelist}," . $listaction->toJson(TRUE) . "));\">" . $icon . "</a>";
					$item->Visible = $listaction->Allow;
				}
			}

			// Hide grid edit and other options
			if ($this->TotalRecords <= 0) {
				$option = $options["addedit"];
				$item = $option["gridedit"];
				if ($item)
					$item->Visible = FALSE;
				$option = $options["action"];
				$option->hideAllOptions();
			}
	}

	// Process list action
	protected function processListAction()
	{
		global $Language, $Security;
		$userlist = "";
		$user = "";
		$filter = $this->getFilterFromRecordKeys();
		$userAction = Post("useraction", "");
		if ($filter != "" && $userAction != "") {

			// Check permission first
			$actionCaption = $userAction;
			if (array_key_exists($userAction, $this->ListActions->Items)) {
				$actionCaption = $this->ListActions[$userAction]->Caption;
				if (!$this->ListActions[$userAction]->Allow) {
					$errmsg = str_replace('%s', $actionCaption, $Language->phrase("CustomActionNotAllowed"));
					if (Post("ajax") == $userAction) // Ajax
						echo "<p class=\"text-danger\">" . $errmsg . "</p>";
					else
						$this->setFailureMessage($errmsg);
					return FALSE;
				}
			}
			$this->CurrentFilter = $filter;
			$sql = $this->getCurrentSql();
			$conn = $this->getConnection();
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			$rs = $conn->execute($sql);
			$conn->raiseErrorFn = "";
			$this->CurrentAction = $userAction;

			// Call row action event
			if ($rs && !$rs->EOF) {
				$conn->beginTrans();
				$this->SelectedCount = $rs->RecordCount();
				$this->SelectedIndex = 0;
				while (!$rs->EOF) {
					$this->SelectedIndex++;
					$row = $rs->fields;
					$processed = $this->Row_CustomAction($userAction, $row);
					if (!$processed)
						break;
					$rs->moveNext();
				}
				if ($processed) {
					$conn->commitTrans(); // Commit the changes
					if ($this->getSuccessMessage() == "" && !ob_get_length()) // No output
						$this->setSuccessMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionCompleted"))); // Set up success message
				} else {
					$conn->rollbackTrans(); // Rollback changes

					// Set up error message
					if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

						// Use the message, do nothing
					} elseif ($this->CancelMessage != "") {
						$this->setFailureMessage($this->CancelMessage);
						$this->CancelMessage = "";
					} else {
						$this->setFailureMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionFailed")));
					}
				}
			}
			if ($rs)
				$rs->close();
			$this->CurrentAction = ""; // Clear action
			if (Post("ajax") == $userAction) { // Ajax
				if ($this->getSuccessMessage() != "") {
					echo "<p class=\"text-success\">" . $this->getSuccessMessage() . "</p>";
					$this->clearSuccessMessage(); // Clear message
				}
				if ($this->getFailureMessage() != "") {
					echo "<p class=\"text-danger\">" . $this->getFailureMessage() . "</p>";
					$this->clearFailureMessage(); // Clear message
				}
				return TRUE;
			}
		}
		return FALSE; // Not ajax request
	}

	// Set up list options (extended codes)
	protected function setupListOptionsExt()
	{
	}

	// Render list options (extended codes)
	protected function renderListOptionsExt()
	{
	}

	// Load basic search values
	protected function loadBasicSearchValues()
	{
		$this->BasicSearch->setKeyword(Get(Config("TABLE_BASIC_SEARCH"), ""), FALSE);
		if ($this->BasicSearch->Keyword != "" && $this->Command == "")
			$this->Command = "search";
		$this->BasicSearch->setType(Get(Config("TABLE_BASIC_SEARCH_TYPE"), ""), FALSE);
	}

	// Load recordset
	public function loadRecordset($offset = -1, $rowcnt = -1)
	{

		// Load List page SQL
		$sql = $this->getListSql();
		$conn = $this->getConnection();

		// Load recordset
		$dbtype = GetConnectionType($this->Dbid);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			if ($dbtype == "MSSQL") {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset, ["_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderBy())]);
			} else {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = "";
		} else {
			$rs = LoadRecordset($sql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
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
		$row = [];
		$row['ID'] = NULL;
		$row['FechaCreacion'] = NULL;
		$row['ID_Cadeteria'] = NULL;
		$row['ID_Status'] = NULL;
		$row['ID_CurrentStatus'] = NULL;
		$row['Nombre'] = NULL;
		$row['Apellido'] = NULL;
		$row['DNI'] = NULL;
		$row['Celular'] = NULL;
		$row['Domicilio'] = NULL;
		$row['RealLat'] = NULL;
		$row['RealLon'] = NULL;
		$row['EstimatedLat'] = NULL;
		$row['EstimatedLon'] = NULL;
		$row['LUDesde'] = NULL;
		$row['LUHasta'] = NULL;
		$row['MADesde'] = NULL;
		$row['MAHasta'] = NULL;
		$row['MIEDesde'] = NULL;
		$row['MIEHasta'] = NULL;
		$row['JUEDesde'] = NULL;
		$row['JUEHasta'] = NULL;
		$row['VIEDesde'] = NULL;
		$row['VIEHasta'] = NULL;
		$row['SABDesde'] = NULL;
		$row['SABHasta'] = NULL;
		$row['DOMDesde'] = NULL;
		$row['DOMHasta'] = NULL;
		$row['Foto'] = NULL;
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
		$this->ViewUrl = $this->getViewUrl();
		$this->EditUrl = $this->getEditUrl();
		$this->InlineEditUrl = $this->getInlineEditUrl();
		$this->CopyUrl = $this->getCopyUrl();
		$this->InlineCopyUrl = $this->getInlineCopyUrl();
		$this->DeleteUrl = $this->getDeleteUrl();

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

			// ID
			$this->ID->LinkCustomAttributes = "";
			$this->ID->HrefValue = "";
			$this->ID->TooltipValue = "";

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
		}

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Set up search options
	protected function setupSearchOptions()
	{
		global $Language;
		$this->SearchOptions = new ListOptions("div");
		$this->SearchOptions->TagClassName = "ew-search-option";

		// Search button
		$item = &$this->SearchOptions->add("searchtoggle");
		$searchToggleClass = ($this->SearchWhere != "") ? " active" : " active";
		$item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fCadetelistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->add("showall");
		$item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" href=\"" . $this->pageUrl() . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere != $this->DefaultSearchWhere && $this->SearchWhere != "0=101");

		// Button group for search
		$this->SearchOptions->UseDropDownButton = FALSE;
		$this->SearchOptions->UseButtonGroup = TRUE;
		$this->SearchOptions->DropDownButtonPhrase = $Language->phrase("ButtonSearch");

		// Add group option item
		$item = &$this->SearchOptions->add($this->SearchOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Hide search options
		if ($this->isExport() || $this->CurrentAction)
			$this->SearchOptions->hideAllOptions();
		global $Security;
		if (!$Security->canSearch()) {
			$this->SearchOptions->hideAllOptions();
			$this->FilterOptions->hideAllOptions();
		}
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
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
		$Breadcrumb->add("list", $this->TableVar, $url, "", $this->TableVar, TRUE);
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

	// ListOptions Load event
	function ListOptions_Load() {

		// Example:
		//$opt = &$this->ListOptions->Add("new");
		//$opt->Header = "xxx";
		//$opt->OnLeft = TRUE; // Link on left
		//$opt->MoveTo(0); // Move to first column

	}

	// ListOptions Rendering event
	function ListOptions_Rendering() {

		//$GLOBALS["xxx_grid"]->DetailAdd = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailEdit = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailView = (...condition...); // Set to TRUE or FALSE conditionally

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example:
		//$this->ListOptions["new"]->Body = "xxx";

	}

	// Row Custom Action event
	function Row_CustomAction($action, $row) {

		// Return FALSE to abort
		return TRUE;
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

	// Page Importing event
	function Page_Importing($reader, &$options) {

		//var_dump($reader); // Import data reader
		//var_dump($options); // Show all options for importing
		//return FALSE; // Return FALSE to skip import

		return TRUE;
	}

	// Row Import event
	function Row_Import(&$row, $cnt) {

		//echo $cnt; // Import record count
		//var_dump($row); // Import row
		//return FALSE; // Return FALSE to skip import

		return TRUE;
	}

	// Page Imported event
	function Page_Imported($reader, $results) {

		//var_dump($reader); // Import data reader
		//var_dump($results); // Import results

	}
} // End class
?>