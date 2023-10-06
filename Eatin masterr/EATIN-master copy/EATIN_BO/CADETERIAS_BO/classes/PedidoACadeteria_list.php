<?php
namespace PHPMaker2020\BACKOFFICE_CADETERIAS;

/**
 * Page class
 */
class PedidoACadeteria_list extends PedidoACadeteria
{

	// Page ID
	public $PageID = "list";

	// Project ID
	public $ProjectID = "{68D35137-1670-419B-B841-52FFD5E14A4B}";

	// Table name
	public $TableName = 'PedidoACadeteria';

	// Page object name
	public $PageObjName = "PedidoACadeteria_list";

	// Grid form hidden field names
	public $FormName = "fPedidoACadeterialist";
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

		// Table object (PedidoACadeteria)
		if (!isset($GLOBALS["PedidoACadeteria"]) || get_class($GLOBALS["PedidoACadeteria"]) == PROJECT_NAMESPACE . "PedidoACadeteria") {
			$GLOBALS["PedidoACadeteria"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["PedidoACadeteria"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html";
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv";
		$this->AddUrl = "PedidoACadeteriaadd.php";
		$this->InlineAddUrl = $this->pageUrl() . "action=add";
		$this->GridAddUrl = $this->pageUrl() . "action=gridadd";
		$this->GridEditUrl = $this->pageUrl() . "action=gridedit";
		$this->MultiDeleteUrl = "PedidoACadeteriadelete.php";
		$this->MultiUpdateUrl = "PedidoACadeteriaupdate.php";

		// Table object (Cadeteria)
		if (!isset($GLOBALS['Cadeteria']))
			$GLOBALS['Cadeteria'] = new Cadeteria();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'list');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'PedidoACadeteria');

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
		$this->FilterOptions->TagClassName = "ew-filter-option fPedidoACadeterialistsrch";

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
		global $PedidoACadeteria;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($PedidoACadeteria);
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
		$this->ID_Usuario->setVisibility();
		$this->ID_Place1->setVisibility();
		$this->ID_Place2->setVisibility();
		$this->ID_Cadete->setVisibility();
		$this->ID_Status->setVisibility();
		$this->InstruccionesPlace1->setVisibility();
		$this->InstruccionesPlace2->setVisibility();
		$this->Direccionalidad->setVisibility();
		$this->RemitoURL->setVisibility();
		$this->Place1_Nombre->setVisibility();
		$this->Place1_Country->setVisibility();
		$this->Place1_UF->setVisibility();
		$this->Plate1_Lat->setVisibility();
		$this->Place1_Lon->setVisibility();
		$this->Place1_Calle->setVisibility();
		$this->Place1_Numero->setVisibility();
		$this->Place1_Localidad->setVisibility();
		$this->Place1_Piso->setVisibility();
		$this->Place1_Depto->setVisibility();
		$this->Place1_PersonaRecibe->setVisibility();
		$this->Place1_PersonaRecibeTelefono->setVisibility();
		$this->Place2_Nombre->setVisibility();
		$this->Place2_Country->setVisibility();
		$this->Place2_UF->setVisibility();
		$this->Place2_Lat->setVisibility();
		$this->Place2_Lon->setVisibility();
		$this->Place2_Calle->setVisibility();
		$this->Place2_Numero->setVisibility();
		$this->Place2_Localidad->setVisibility();
		$this->Place2_Piso->setVisibility();
		$this->Place2_Depto->setVisibility();
		$this->Place2_PersonaRecibe->setVisibility();
		$this->Place2_PersonaRecibeTelefono->setVisibility();
		$this->ID_Cadeteria->setVisibility();
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
		$filterList = Concat($filterList, $this->ID_Usuario->AdvancedSearch->toJson(), ","); // Field ID_Usuario
		$filterList = Concat($filterList, $this->ID_Place1->AdvancedSearch->toJson(), ","); // Field ID_Place1
		$filterList = Concat($filterList, $this->ID_Place2->AdvancedSearch->toJson(), ","); // Field ID_Place2
		$filterList = Concat($filterList, $this->ID_Cadete->AdvancedSearch->toJson(), ","); // Field ID_Cadete
		$filterList = Concat($filterList, $this->ID_Status->AdvancedSearch->toJson(), ","); // Field ID_Status
		$filterList = Concat($filterList, $this->InstruccionesPlace1->AdvancedSearch->toJson(), ","); // Field InstruccionesPlace1
		$filterList = Concat($filterList, $this->InstruccionesPlace2->AdvancedSearch->toJson(), ","); // Field InstruccionesPlace2
		$filterList = Concat($filterList, $this->Direccionalidad->AdvancedSearch->toJson(), ","); // Field Direccionalidad
		$filterList = Concat($filterList, $this->RemitoURL->AdvancedSearch->toJson(), ","); // Field RemitoURL
		$filterList = Concat($filterList, $this->Place1_Nombre->AdvancedSearch->toJson(), ","); // Field Place1_Nombre
		$filterList = Concat($filterList, $this->Place1_Country->AdvancedSearch->toJson(), ","); // Field Place1_Country
		$filterList = Concat($filterList, $this->Place1_UF->AdvancedSearch->toJson(), ","); // Field Place1_UF
		$filterList = Concat($filterList, $this->Plate1_Lat->AdvancedSearch->toJson(), ","); // Field Plate1_Lat
		$filterList = Concat($filterList, $this->Place1_Lon->AdvancedSearch->toJson(), ","); // Field Place1_Lon
		$filterList = Concat($filterList, $this->Place1_Calle->AdvancedSearch->toJson(), ","); // Field Place1_Calle
		$filterList = Concat($filterList, $this->Place1_Numero->AdvancedSearch->toJson(), ","); // Field Place1_Numero
		$filterList = Concat($filterList, $this->Place1_Localidad->AdvancedSearch->toJson(), ","); // Field Place1_Localidad
		$filterList = Concat($filterList, $this->Place1_Piso->AdvancedSearch->toJson(), ","); // Field Place1_Piso
		$filterList = Concat($filterList, $this->Place1_Depto->AdvancedSearch->toJson(), ","); // Field Place1_Depto
		$filterList = Concat($filterList, $this->Place1_PersonaRecibe->AdvancedSearch->toJson(), ","); // Field Place1_PersonaRecibe
		$filterList = Concat($filterList, $this->Place1_PersonaRecibeTelefono->AdvancedSearch->toJson(), ","); // Field Place1_PersonaRecibeTelefono
		$filterList = Concat($filterList, $this->Place2_Nombre->AdvancedSearch->toJson(), ","); // Field Place2_Nombre
		$filterList = Concat($filterList, $this->Place2_Country->AdvancedSearch->toJson(), ","); // Field Place2_Country
		$filterList = Concat($filterList, $this->Place2_UF->AdvancedSearch->toJson(), ","); // Field Place2_UF
		$filterList = Concat($filterList, $this->Place2_Lat->AdvancedSearch->toJson(), ","); // Field Place2_Lat
		$filterList = Concat($filterList, $this->Place2_Lon->AdvancedSearch->toJson(), ","); // Field Place2_Lon
		$filterList = Concat($filterList, $this->Place2_Calle->AdvancedSearch->toJson(), ","); // Field Place2_Calle
		$filterList = Concat($filterList, $this->Place2_Numero->AdvancedSearch->toJson(), ","); // Field Place2_Numero
		$filterList = Concat($filterList, $this->Place2_Localidad->AdvancedSearch->toJson(), ","); // Field Place2_Localidad
		$filterList = Concat($filterList, $this->Place2_Piso->AdvancedSearch->toJson(), ","); // Field Place2_Piso
		$filterList = Concat($filterList, $this->Place2_Depto->AdvancedSearch->toJson(), ","); // Field Place2_Depto
		$filterList = Concat($filterList, $this->Place2_PersonaRecibe->AdvancedSearch->toJson(), ","); // Field Place2_PersonaRecibe
		$filterList = Concat($filterList, $this->Place2_PersonaRecibeTelefono->AdvancedSearch->toJson(), ","); // Field Place2_PersonaRecibeTelefono
		$filterList = Concat($filterList, $this->ID_Cadeteria->AdvancedSearch->toJson(), ","); // Field ID_Cadeteria
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
			$UserProfile->setSearchFilters(CurrentUserName(), "fPedidoACadeterialistsrch", $filters);
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

		// Field ID_Usuario
		$this->ID_Usuario->AdvancedSearch->SearchValue = @$filter["x_ID_Usuario"];
		$this->ID_Usuario->AdvancedSearch->SearchOperator = @$filter["z_ID_Usuario"];
		$this->ID_Usuario->AdvancedSearch->SearchCondition = @$filter["v_ID_Usuario"];
		$this->ID_Usuario->AdvancedSearch->SearchValue2 = @$filter["y_ID_Usuario"];
		$this->ID_Usuario->AdvancedSearch->SearchOperator2 = @$filter["w_ID_Usuario"];
		$this->ID_Usuario->AdvancedSearch->save();

		// Field ID_Place1
		$this->ID_Place1->AdvancedSearch->SearchValue = @$filter["x_ID_Place1"];
		$this->ID_Place1->AdvancedSearch->SearchOperator = @$filter["z_ID_Place1"];
		$this->ID_Place1->AdvancedSearch->SearchCondition = @$filter["v_ID_Place1"];
		$this->ID_Place1->AdvancedSearch->SearchValue2 = @$filter["y_ID_Place1"];
		$this->ID_Place1->AdvancedSearch->SearchOperator2 = @$filter["w_ID_Place1"];
		$this->ID_Place1->AdvancedSearch->save();

		// Field ID_Place2
		$this->ID_Place2->AdvancedSearch->SearchValue = @$filter["x_ID_Place2"];
		$this->ID_Place2->AdvancedSearch->SearchOperator = @$filter["z_ID_Place2"];
		$this->ID_Place2->AdvancedSearch->SearchCondition = @$filter["v_ID_Place2"];
		$this->ID_Place2->AdvancedSearch->SearchValue2 = @$filter["y_ID_Place2"];
		$this->ID_Place2->AdvancedSearch->SearchOperator2 = @$filter["w_ID_Place2"];
		$this->ID_Place2->AdvancedSearch->save();

		// Field ID_Cadete
		$this->ID_Cadete->AdvancedSearch->SearchValue = @$filter["x_ID_Cadete"];
		$this->ID_Cadete->AdvancedSearch->SearchOperator = @$filter["z_ID_Cadete"];
		$this->ID_Cadete->AdvancedSearch->SearchCondition = @$filter["v_ID_Cadete"];
		$this->ID_Cadete->AdvancedSearch->SearchValue2 = @$filter["y_ID_Cadete"];
		$this->ID_Cadete->AdvancedSearch->SearchOperator2 = @$filter["w_ID_Cadete"];
		$this->ID_Cadete->AdvancedSearch->save();

		// Field ID_Status
		$this->ID_Status->AdvancedSearch->SearchValue = @$filter["x_ID_Status"];
		$this->ID_Status->AdvancedSearch->SearchOperator = @$filter["z_ID_Status"];
		$this->ID_Status->AdvancedSearch->SearchCondition = @$filter["v_ID_Status"];
		$this->ID_Status->AdvancedSearch->SearchValue2 = @$filter["y_ID_Status"];
		$this->ID_Status->AdvancedSearch->SearchOperator2 = @$filter["w_ID_Status"];
		$this->ID_Status->AdvancedSearch->save();

		// Field InstruccionesPlace1
		$this->InstruccionesPlace1->AdvancedSearch->SearchValue = @$filter["x_InstruccionesPlace1"];
		$this->InstruccionesPlace1->AdvancedSearch->SearchOperator = @$filter["z_InstruccionesPlace1"];
		$this->InstruccionesPlace1->AdvancedSearch->SearchCondition = @$filter["v_InstruccionesPlace1"];
		$this->InstruccionesPlace1->AdvancedSearch->SearchValue2 = @$filter["y_InstruccionesPlace1"];
		$this->InstruccionesPlace1->AdvancedSearch->SearchOperator2 = @$filter["w_InstruccionesPlace1"];
		$this->InstruccionesPlace1->AdvancedSearch->save();

		// Field InstruccionesPlace2
		$this->InstruccionesPlace2->AdvancedSearch->SearchValue = @$filter["x_InstruccionesPlace2"];
		$this->InstruccionesPlace2->AdvancedSearch->SearchOperator = @$filter["z_InstruccionesPlace2"];
		$this->InstruccionesPlace2->AdvancedSearch->SearchCondition = @$filter["v_InstruccionesPlace2"];
		$this->InstruccionesPlace2->AdvancedSearch->SearchValue2 = @$filter["y_InstruccionesPlace2"];
		$this->InstruccionesPlace2->AdvancedSearch->SearchOperator2 = @$filter["w_InstruccionesPlace2"];
		$this->InstruccionesPlace2->AdvancedSearch->save();

		// Field Direccionalidad
		$this->Direccionalidad->AdvancedSearch->SearchValue = @$filter["x_Direccionalidad"];
		$this->Direccionalidad->AdvancedSearch->SearchOperator = @$filter["z_Direccionalidad"];
		$this->Direccionalidad->AdvancedSearch->SearchCondition = @$filter["v_Direccionalidad"];
		$this->Direccionalidad->AdvancedSearch->SearchValue2 = @$filter["y_Direccionalidad"];
		$this->Direccionalidad->AdvancedSearch->SearchOperator2 = @$filter["w_Direccionalidad"];
		$this->Direccionalidad->AdvancedSearch->save();

		// Field RemitoURL
		$this->RemitoURL->AdvancedSearch->SearchValue = @$filter["x_RemitoURL"];
		$this->RemitoURL->AdvancedSearch->SearchOperator = @$filter["z_RemitoURL"];
		$this->RemitoURL->AdvancedSearch->SearchCondition = @$filter["v_RemitoURL"];
		$this->RemitoURL->AdvancedSearch->SearchValue2 = @$filter["y_RemitoURL"];
		$this->RemitoURL->AdvancedSearch->SearchOperator2 = @$filter["w_RemitoURL"];
		$this->RemitoURL->AdvancedSearch->save();

		// Field Place1_Nombre
		$this->Place1_Nombre->AdvancedSearch->SearchValue = @$filter["x_Place1_Nombre"];
		$this->Place1_Nombre->AdvancedSearch->SearchOperator = @$filter["z_Place1_Nombre"];
		$this->Place1_Nombre->AdvancedSearch->SearchCondition = @$filter["v_Place1_Nombre"];
		$this->Place1_Nombre->AdvancedSearch->SearchValue2 = @$filter["y_Place1_Nombre"];
		$this->Place1_Nombre->AdvancedSearch->SearchOperator2 = @$filter["w_Place1_Nombre"];
		$this->Place1_Nombre->AdvancedSearch->save();

		// Field Place1_Country
		$this->Place1_Country->AdvancedSearch->SearchValue = @$filter["x_Place1_Country"];
		$this->Place1_Country->AdvancedSearch->SearchOperator = @$filter["z_Place1_Country"];
		$this->Place1_Country->AdvancedSearch->SearchCondition = @$filter["v_Place1_Country"];
		$this->Place1_Country->AdvancedSearch->SearchValue2 = @$filter["y_Place1_Country"];
		$this->Place1_Country->AdvancedSearch->SearchOperator2 = @$filter["w_Place1_Country"];
		$this->Place1_Country->AdvancedSearch->save();

		// Field Place1_UF
		$this->Place1_UF->AdvancedSearch->SearchValue = @$filter["x_Place1_UF"];
		$this->Place1_UF->AdvancedSearch->SearchOperator = @$filter["z_Place1_UF"];
		$this->Place1_UF->AdvancedSearch->SearchCondition = @$filter["v_Place1_UF"];
		$this->Place1_UF->AdvancedSearch->SearchValue2 = @$filter["y_Place1_UF"];
		$this->Place1_UF->AdvancedSearch->SearchOperator2 = @$filter["w_Place1_UF"];
		$this->Place1_UF->AdvancedSearch->save();

		// Field Plate1_Lat
		$this->Plate1_Lat->AdvancedSearch->SearchValue = @$filter["x_Plate1_Lat"];
		$this->Plate1_Lat->AdvancedSearch->SearchOperator = @$filter["z_Plate1_Lat"];
		$this->Plate1_Lat->AdvancedSearch->SearchCondition = @$filter["v_Plate1_Lat"];
		$this->Plate1_Lat->AdvancedSearch->SearchValue2 = @$filter["y_Plate1_Lat"];
		$this->Plate1_Lat->AdvancedSearch->SearchOperator2 = @$filter["w_Plate1_Lat"];
		$this->Plate1_Lat->AdvancedSearch->save();

		// Field Place1_Lon
		$this->Place1_Lon->AdvancedSearch->SearchValue = @$filter["x_Place1_Lon"];
		$this->Place1_Lon->AdvancedSearch->SearchOperator = @$filter["z_Place1_Lon"];
		$this->Place1_Lon->AdvancedSearch->SearchCondition = @$filter["v_Place1_Lon"];
		$this->Place1_Lon->AdvancedSearch->SearchValue2 = @$filter["y_Place1_Lon"];
		$this->Place1_Lon->AdvancedSearch->SearchOperator2 = @$filter["w_Place1_Lon"];
		$this->Place1_Lon->AdvancedSearch->save();

		// Field Place1_Calle
		$this->Place1_Calle->AdvancedSearch->SearchValue = @$filter["x_Place1_Calle"];
		$this->Place1_Calle->AdvancedSearch->SearchOperator = @$filter["z_Place1_Calle"];
		$this->Place1_Calle->AdvancedSearch->SearchCondition = @$filter["v_Place1_Calle"];
		$this->Place1_Calle->AdvancedSearch->SearchValue2 = @$filter["y_Place1_Calle"];
		$this->Place1_Calle->AdvancedSearch->SearchOperator2 = @$filter["w_Place1_Calle"];
		$this->Place1_Calle->AdvancedSearch->save();

		// Field Place1_Numero
		$this->Place1_Numero->AdvancedSearch->SearchValue = @$filter["x_Place1_Numero"];
		$this->Place1_Numero->AdvancedSearch->SearchOperator = @$filter["z_Place1_Numero"];
		$this->Place1_Numero->AdvancedSearch->SearchCondition = @$filter["v_Place1_Numero"];
		$this->Place1_Numero->AdvancedSearch->SearchValue2 = @$filter["y_Place1_Numero"];
		$this->Place1_Numero->AdvancedSearch->SearchOperator2 = @$filter["w_Place1_Numero"];
		$this->Place1_Numero->AdvancedSearch->save();

		// Field Place1_Localidad
		$this->Place1_Localidad->AdvancedSearch->SearchValue = @$filter["x_Place1_Localidad"];
		$this->Place1_Localidad->AdvancedSearch->SearchOperator = @$filter["z_Place1_Localidad"];
		$this->Place1_Localidad->AdvancedSearch->SearchCondition = @$filter["v_Place1_Localidad"];
		$this->Place1_Localidad->AdvancedSearch->SearchValue2 = @$filter["y_Place1_Localidad"];
		$this->Place1_Localidad->AdvancedSearch->SearchOperator2 = @$filter["w_Place1_Localidad"];
		$this->Place1_Localidad->AdvancedSearch->save();

		// Field Place1_Piso
		$this->Place1_Piso->AdvancedSearch->SearchValue = @$filter["x_Place1_Piso"];
		$this->Place1_Piso->AdvancedSearch->SearchOperator = @$filter["z_Place1_Piso"];
		$this->Place1_Piso->AdvancedSearch->SearchCondition = @$filter["v_Place1_Piso"];
		$this->Place1_Piso->AdvancedSearch->SearchValue2 = @$filter["y_Place1_Piso"];
		$this->Place1_Piso->AdvancedSearch->SearchOperator2 = @$filter["w_Place1_Piso"];
		$this->Place1_Piso->AdvancedSearch->save();

		// Field Place1_Depto
		$this->Place1_Depto->AdvancedSearch->SearchValue = @$filter["x_Place1_Depto"];
		$this->Place1_Depto->AdvancedSearch->SearchOperator = @$filter["z_Place1_Depto"];
		$this->Place1_Depto->AdvancedSearch->SearchCondition = @$filter["v_Place1_Depto"];
		$this->Place1_Depto->AdvancedSearch->SearchValue2 = @$filter["y_Place1_Depto"];
		$this->Place1_Depto->AdvancedSearch->SearchOperator2 = @$filter["w_Place1_Depto"];
		$this->Place1_Depto->AdvancedSearch->save();

		// Field Place1_PersonaRecibe
		$this->Place1_PersonaRecibe->AdvancedSearch->SearchValue = @$filter["x_Place1_PersonaRecibe"];
		$this->Place1_PersonaRecibe->AdvancedSearch->SearchOperator = @$filter["z_Place1_PersonaRecibe"];
		$this->Place1_PersonaRecibe->AdvancedSearch->SearchCondition = @$filter["v_Place1_PersonaRecibe"];
		$this->Place1_PersonaRecibe->AdvancedSearch->SearchValue2 = @$filter["y_Place1_PersonaRecibe"];
		$this->Place1_PersonaRecibe->AdvancedSearch->SearchOperator2 = @$filter["w_Place1_PersonaRecibe"];
		$this->Place1_PersonaRecibe->AdvancedSearch->save();

		// Field Place1_PersonaRecibeTelefono
		$this->Place1_PersonaRecibeTelefono->AdvancedSearch->SearchValue = @$filter["x_Place1_PersonaRecibeTelefono"];
		$this->Place1_PersonaRecibeTelefono->AdvancedSearch->SearchOperator = @$filter["z_Place1_PersonaRecibeTelefono"];
		$this->Place1_PersonaRecibeTelefono->AdvancedSearch->SearchCondition = @$filter["v_Place1_PersonaRecibeTelefono"];
		$this->Place1_PersonaRecibeTelefono->AdvancedSearch->SearchValue2 = @$filter["y_Place1_PersonaRecibeTelefono"];
		$this->Place1_PersonaRecibeTelefono->AdvancedSearch->SearchOperator2 = @$filter["w_Place1_PersonaRecibeTelefono"];
		$this->Place1_PersonaRecibeTelefono->AdvancedSearch->save();

		// Field Place2_Nombre
		$this->Place2_Nombre->AdvancedSearch->SearchValue = @$filter["x_Place2_Nombre"];
		$this->Place2_Nombre->AdvancedSearch->SearchOperator = @$filter["z_Place2_Nombre"];
		$this->Place2_Nombre->AdvancedSearch->SearchCondition = @$filter["v_Place2_Nombre"];
		$this->Place2_Nombre->AdvancedSearch->SearchValue2 = @$filter["y_Place2_Nombre"];
		$this->Place2_Nombre->AdvancedSearch->SearchOperator2 = @$filter["w_Place2_Nombre"];
		$this->Place2_Nombre->AdvancedSearch->save();

		// Field Place2_Country
		$this->Place2_Country->AdvancedSearch->SearchValue = @$filter["x_Place2_Country"];
		$this->Place2_Country->AdvancedSearch->SearchOperator = @$filter["z_Place2_Country"];
		$this->Place2_Country->AdvancedSearch->SearchCondition = @$filter["v_Place2_Country"];
		$this->Place2_Country->AdvancedSearch->SearchValue2 = @$filter["y_Place2_Country"];
		$this->Place2_Country->AdvancedSearch->SearchOperator2 = @$filter["w_Place2_Country"];
		$this->Place2_Country->AdvancedSearch->save();

		// Field Place2_UF
		$this->Place2_UF->AdvancedSearch->SearchValue = @$filter["x_Place2_UF"];
		$this->Place2_UF->AdvancedSearch->SearchOperator = @$filter["z_Place2_UF"];
		$this->Place2_UF->AdvancedSearch->SearchCondition = @$filter["v_Place2_UF"];
		$this->Place2_UF->AdvancedSearch->SearchValue2 = @$filter["y_Place2_UF"];
		$this->Place2_UF->AdvancedSearch->SearchOperator2 = @$filter["w_Place2_UF"];
		$this->Place2_UF->AdvancedSearch->save();

		// Field Place2_Lat
		$this->Place2_Lat->AdvancedSearch->SearchValue = @$filter["x_Place2_Lat"];
		$this->Place2_Lat->AdvancedSearch->SearchOperator = @$filter["z_Place2_Lat"];
		$this->Place2_Lat->AdvancedSearch->SearchCondition = @$filter["v_Place2_Lat"];
		$this->Place2_Lat->AdvancedSearch->SearchValue2 = @$filter["y_Place2_Lat"];
		$this->Place2_Lat->AdvancedSearch->SearchOperator2 = @$filter["w_Place2_Lat"];
		$this->Place2_Lat->AdvancedSearch->save();

		// Field Place2_Lon
		$this->Place2_Lon->AdvancedSearch->SearchValue = @$filter["x_Place2_Lon"];
		$this->Place2_Lon->AdvancedSearch->SearchOperator = @$filter["z_Place2_Lon"];
		$this->Place2_Lon->AdvancedSearch->SearchCondition = @$filter["v_Place2_Lon"];
		$this->Place2_Lon->AdvancedSearch->SearchValue2 = @$filter["y_Place2_Lon"];
		$this->Place2_Lon->AdvancedSearch->SearchOperator2 = @$filter["w_Place2_Lon"];
		$this->Place2_Lon->AdvancedSearch->save();

		// Field Place2_Calle
		$this->Place2_Calle->AdvancedSearch->SearchValue = @$filter["x_Place2_Calle"];
		$this->Place2_Calle->AdvancedSearch->SearchOperator = @$filter["z_Place2_Calle"];
		$this->Place2_Calle->AdvancedSearch->SearchCondition = @$filter["v_Place2_Calle"];
		$this->Place2_Calle->AdvancedSearch->SearchValue2 = @$filter["y_Place2_Calle"];
		$this->Place2_Calle->AdvancedSearch->SearchOperator2 = @$filter["w_Place2_Calle"];
		$this->Place2_Calle->AdvancedSearch->save();

		// Field Place2_Numero
		$this->Place2_Numero->AdvancedSearch->SearchValue = @$filter["x_Place2_Numero"];
		$this->Place2_Numero->AdvancedSearch->SearchOperator = @$filter["z_Place2_Numero"];
		$this->Place2_Numero->AdvancedSearch->SearchCondition = @$filter["v_Place2_Numero"];
		$this->Place2_Numero->AdvancedSearch->SearchValue2 = @$filter["y_Place2_Numero"];
		$this->Place2_Numero->AdvancedSearch->SearchOperator2 = @$filter["w_Place2_Numero"];
		$this->Place2_Numero->AdvancedSearch->save();

		// Field Place2_Localidad
		$this->Place2_Localidad->AdvancedSearch->SearchValue = @$filter["x_Place2_Localidad"];
		$this->Place2_Localidad->AdvancedSearch->SearchOperator = @$filter["z_Place2_Localidad"];
		$this->Place2_Localidad->AdvancedSearch->SearchCondition = @$filter["v_Place2_Localidad"];
		$this->Place2_Localidad->AdvancedSearch->SearchValue2 = @$filter["y_Place2_Localidad"];
		$this->Place2_Localidad->AdvancedSearch->SearchOperator2 = @$filter["w_Place2_Localidad"];
		$this->Place2_Localidad->AdvancedSearch->save();

		// Field Place2_Piso
		$this->Place2_Piso->AdvancedSearch->SearchValue = @$filter["x_Place2_Piso"];
		$this->Place2_Piso->AdvancedSearch->SearchOperator = @$filter["z_Place2_Piso"];
		$this->Place2_Piso->AdvancedSearch->SearchCondition = @$filter["v_Place2_Piso"];
		$this->Place2_Piso->AdvancedSearch->SearchValue2 = @$filter["y_Place2_Piso"];
		$this->Place2_Piso->AdvancedSearch->SearchOperator2 = @$filter["w_Place2_Piso"];
		$this->Place2_Piso->AdvancedSearch->save();

		// Field Place2_Depto
		$this->Place2_Depto->AdvancedSearch->SearchValue = @$filter["x_Place2_Depto"];
		$this->Place2_Depto->AdvancedSearch->SearchOperator = @$filter["z_Place2_Depto"];
		$this->Place2_Depto->AdvancedSearch->SearchCondition = @$filter["v_Place2_Depto"];
		$this->Place2_Depto->AdvancedSearch->SearchValue2 = @$filter["y_Place2_Depto"];
		$this->Place2_Depto->AdvancedSearch->SearchOperator2 = @$filter["w_Place2_Depto"];
		$this->Place2_Depto->AdvancedSearch->save();

		// Field Place2_PersonaRecibe
		$this->Place2_PersonaRecibe->AdvancedSearch->SearchValue = @$filter["x_Place2_PersonaRecibe"];
		$this->Place2_PersonaRecibe->AdvancedSearch->SearchOperator = @$filter["z_Place2_PersonaRecibe"];
		$this->Place2_PersonaRecibe->AdvancedSearch->SearchCondition = @$filter["v_Place2_PersonaRecibe"];
		$this->Place2_PersonaRecibe->AdvancedSearch->SearchValue2 = @$filter["y_Place2_PersonaRecibe"];
		$this->Place2_PersonaRecibe->AdvancedSearch->SearchOperator2 = @$filter["w_Place2_PersonaRecibe"];
		$this->Place2_PersonaRecibe->AdvancedSearch->save();

		// Field Place2_PersonaRecibeTelefono
		$this->Place2_PersonaRecibeTelefono->AdvancedSearch->SearchValue = @$filter["x_Place2_PersonaRecibeTelefono"];
		$this->Place2_PersonaRecibeTelefono->AdvancedSearch->SearchOperator = @$filter["z_Place2_PersonaRecibeTelefono"];
		$this->Place2_PersonaRecibeTelefono->AdvancedSearch->SearchCondition = @$filter["v_Place2_PersonaRecibeTelefono"];
		$this->Place2_PersonaRecibeTelefono->AdvancedSearch->SearchValue2 = @$filter["y_Place2_PersonaRecibeTelefono"];
		$this->Place2_PersonaRecibeTelefono->AdvancedSearch->SearchOperator2 = @$filter["w_Place2_PersonaRecibeTelefono"];
		$this->Place2_PersonaRecibeTelefono->AdvancedSearch->save();

		// Field ID_Cadeteria
		$this->ID_Cadeteria->AdvancedSearch->SearchValue = @$filter["x_ID_Cadeteria"];
		$this->ID_Cadeteria->AdvancedSearch->SearchOperator = @$filter["z_ID_Cadeteria"];
		$this->ID_Cadeteria->AdvancedSearch->SearchCondition = @$filter["v_ID_Cadeteria"];
		$this->ID_Cadeteria->AdvancedSearch->SearchValue2 = @$filter["y_ID_Cadeteria"];
		$this->ID_Cadeteria->AdvancedSearch->SearchOperator2 = @$filter["w_ID_Cadeteria"];
		$this->ID_Cadeteria->AdvancedSearch->save();
		$this->BasicSearch->setKeyword(@$filter[Config("TABLE_BASIC_SEARCH")]);
		$this->BasicSearch->setType(@$filter[Config("TABLE_BASIC_SEARCH_TYPE")]);
	}

	// Return basic search SQL
	protected function basicSearchSql($arKeywords, $type)
	{
		$where = "";
		$this->buildBasicSearchSql($where, $this->InstruccionesPlace1, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->InstruccionesPlace2, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->RemitoURL, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Place1_Nombre, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Place1_Country, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Place1_UF, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Place1_Calle, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Place1_Numero, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Place1_Localidad, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Place1_Piso, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Place1_Depto, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Place1_PersonaRecibe, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Place1_PersonaRecibeTelefono, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Place2_Nombre, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Place2_Country, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Place2_UF, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Place2_Calle, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Place2_Numero, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Place2_Localidad, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Place2_Piso, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Place2_Depto, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Place2_PersonaRecibe, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->Place2_PersonaRecibeTelefono, $arKeywords, $type);
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
			$this->updateSort($this->ID_Usuario); // ID_Usuario
			$this->updateSort($this->ID_Place1); // ID_Place1
			$this->updateSort($this->ID_Place2); // ID_Place2
			$this->updateSort($this->ID_Cadete); // ID_Cadete
			$this->updateSort($this->ID_Status); // ID_Status
			$this->updateSort($this->InstruccionesPlace1); // InstruccionesPlace1
			$this->updateSort($this->InstruccionesPlace2); // InstruccionesPlace2
			$this->updateSort($this->Direccionalidad); // Direccionalidad
			$this->updateSort($this->RemitoURL); // RemitoURL
			$this->updateSort($this->Place1_Nombre); // Place1_Nombre
			$this->updateSort($this->Place1_Country); // Place1_Country
			$this->updateSort($this->Place1_UF); // Place1_UF
			$this->updateSort($this->Plate1_Lat); // Plate1_Lat
			$this->updateSort($this->Place1_Lon); // Place1_Lon
			$this->updateSort($this->Place1_Calle); // Place1_Calle
			$this->updateSort($this->Place1_Numero); // Place1_Numero
			$this->updateSort($this->Place1_Localidad); // Place1_Localidad
			$this->updateSort($this->Place1_Piso); // Place1_Piso
			$this->updateSort($this->Place1_Depto); // Place1_Depto
			$this->updateSort($this->Place1_PersonaRecibe); // Place1_PersonaRecibe
			$this->updateSort($this->Place1_PersonaRecibeTelefono); // Place1_PersonaRecibeTelefono
			$this->updateSort($this->Place2_Nombre); // Place2_Nombre
			$this->updateSort($this->Place2_Country); // Place2_Country
			$this->updateSort($this->Place2_UF); // Place2_UF
			$this->updateSort($this->Place2_Lat); // Place2_Lat
			$this->updateSort($this->Place2_Lon); // Place2_Lon
			$this->updateSort($this->Place2_Calle); // Place2_Calle
			$this->updateSort($this->Place2_Numero); // Place2_Numero
			$this->updateSort($this->Place2_Localidad); // Place2_Localidad
			$this->updateSort($this->Place2_Piso); // Place2_Piso
			$this->updateSort($this->Place2_Depto); // Place2_Depto
			$this->updateSort($this->Place2_PersonaRecibe); // Place2_PersonaRecibe
			$this->updateSort($this->Place2_PersonaRecibeTelefono); // Place2_PersonaRecibeTelefono
			$this->updateSort($this->ID_Cadeteria); // ID_Cadeteria
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
				$this->ID_Usuario->setSort("");
				$this->ID_Place1->setSort("");
				$this->ID_Place2->setSort("");
				$this->ID_Cadete->setSort("");
				$this->ID_Status->setSort("");
				$this->InstruccionesPlace1->setSort("");
				$this->InstruccionesPlace2->setSort("");
				$this->Direccionalidad->setSort("");
				$this->RemitoURL->setSort("");
				$this->Place1_Nombre->setSort("");
				$this->Place1_Country->setSort("");
				$this->Place1_UF->setSort("");
				$this->Plate1_Lat->setSort("");
				$this->Place1_Lon->setSort("");
				$this->Place1_Calle->setSort("");
				$this->Place1_Numero->setSort("");
				$this->Place1_Localidad->setSort("");
				$this->Place1_Piso->setSort("");
				$this->Place1_Depto->setSort("");
				$this->Place1_PersonaRecibe->setSort("");
				$this->Place1_PersonaRecibeTelefono->setSort("");
				$this->Place2_Nombre->setSort("");
				$this->Place2_Country->setSort("");
				$this->Place2_UF->setSort("");
				$this->Place2_Lat->setSort("");
				$this->Place2_Lon->setSort("");
				$this->Place2_Calle->setSort("");
				$this->Place2_Numero->setSort("");
				$this->Place2_Localidad->setSort("");
				$this->Place2_Piso->setSort("");
				$this->Place2_Depto->setSort("");
				$this->Place2_PersonaRecibe->setSort("");
				$this->Place2_PersonaRecibeTelefono->setSort("");
				$this->ID_Cadeteria->setSort("");
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
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"fPedidoACadeterialistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"fPedidoACadeterialistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
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
					$item->Body = "<a class=\"ew-action ew-list-action\" title=\"" . HtmlEncode($caption) . "\" data-caption=\"" . HtmlEncode($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({f:document.fPedidoACadeterialist}," . $listaction->toJson(TRUE) . "));\">" . $icon . "</a>";
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
		$this->ID_Usuario->setDbValue($row['ID_Usuario']);
		$this->ID_Place1->setDbValue($row['ID_Place1']);
		$this->ID_Place2->setDbValue($row['ID_Place2']);
		$this->ID_Cadete->setDbValue($row['ID_Cadete']);
		$this->ID_Status->setDbValue($row['ID_Status']);
		$this->InstruccionesPlace1->setDbValue($row['InstruccionesPlace1']);
		$this->InstruccionesPlace2->setDbValue($row['InstruccionesPlace2']);
		$this->Direccionalidad->setDbValue($row['Direccionalidad']);
		$this->RemitoURL->setDbValue($row['RemitoURL']);
		$this->Place1_Nombre->setDbValue($row['Place1_Nombre']);
		$this->Place1_Country->setDbValue($row['Place1_Country']);
		$this->Place1_UF->setDbValue($row['Place1_UF']);
		$this->Plate1_Lat->setDbValue($row['Plate1_Lat']);
		$this->Place1_Lon->setDbValue($row['Place1_Lon']);
		$this->Place1_Calle->setDbValue($row['Place1_Calle']);
		$this->Place1_Numero->setDbValue($row['Place1_Numero']);
		$this->Place1_Localidad->setDbValue($row['Place1_Localidad']);
		$this->Place1_Piso->setDbValue($row['Place1_Piso']);
		$this->Place1_Depto->setDbValue($row['Place1_Depto']);
		$this->Place1_PersonaRecibe->setDbValue($row['Place1_PersonaRecibe']);
		$this->Place1_PersonaRecibeTelefono->setDbValue($row['Place1_PersonaRecibeTelefono']);
		$this->Place2_Nombre->setDbValue($row['Place2_Nombre']);
		$this->Place2_Country->setDbValue($row['Place2_Country']);
		$this->Place2_UF->setDbValue($row['Place2_UF']);
		$this->Place2_Lat->setDbValue($row['Place2_Lat']);
		$this->Place2_Lon->setDbValue($row['Place2_Lon']);
		$this->Place2_Calle->setDbValue($row['Place2_Calle']);
		$this->Place2_Numero->setDbValue($row['Place2_Numero']);
		$this->Place2_Localidad->setDbValue($row['Place2_Localidad']);
		$this->Place2_Piso->setDbValue($row['Place2_Piso']);
		$this->Place2_Depto->setDbValue($row['Place2_Depto']);
		$this->Place2_PersonaRecibe->setDbValue($row['Place2_PersonaRecibe']);
		$this->Place2_PersonaRecibeTelefono->setDbValue($row['Place2_PersonaRecibeTelefono']);
		$this->ID_Cadeteria->setDbValue($row['ID_Cadeteria']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['ID'] = NULL;
		$row['ID_Usuario'] = NULL;
		$row['ID_Place1'] = NULL;
		$row['ID_Place2'] = NULL;
		$row['ID_Cadete'] = NULL;
		$row['ID_Status'] = NULL;
		$row['InstruccionesPlace1'] = NULL;
		$row['InstruccionesPlace2'] = NULL;
		$row['Direccionalidad'] = NULL;
		$row['RemitoURL'] = NULL;
		$row['Place1_Nombre'] = NULL;
		$row['Place1_Country'] = NULL;
		$row['Place1_UF'] = NULL;
		$row['Plate1_Lat'] = NULL;
		$row['Place1_Lon'] = NULL;
		$row['Place1_Calle'] = NULL;
		$row['Place1_Numero'] = NULL;
		$row['Place1_Localidad'] = NULL;
		$row['Place1_Piso'] = NULL;
		$row['Place1_Depto'] = NULL;
		$row['Place1_PersonaRecibe'] = NULL;
		$row['Place1_PersonaRecibeTelefono'] = NULL;
		$row['Place2_Nombre'] = NULL;
		$row['Place2_Country'] = NULL;
		$row['Place2_UF'] = NULL;
		$row['Place2_Lat'] = NULL;
		$row['Place2_Lon'] = NULL;
		$row['Place2_Calle'] = NULL;
		$row['Place2_Numero'] = NULL;
		$row['Place2_Localidad'] = NULL;
		$row['Place2_Piso'] = NULL;
		$row['Place2_Depto'] = NULL;
		$row['Place2_PersonaRecibe'] = NULL;
		$row['Place2_PersonaRecibeTelefono'] = NULL;
		$row['ID_Cadeteria'] = NULL;
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
		if ($this->Plate1_Lat->FormValue == $this->Plate1_Lat->CurrentValue && is_numeric(ConvertToFloatString($this->Plate1_Lat->CurrentValue)))
			$this->Plate1_Lat->CurrentValue = ConvertToFloatString($this->Plate1_Lat->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Place1_Lon->FormValue == $this->Place1_Lon->CurrentValue && is_numeric(ConvertToFloatString($this->Place1_Lon->CurrentValue)))
			$this->Place1_Lon->CurrentValue = ConvertToFloatString($this->Place1_Lon->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Place2_Lat->FormValue == $this->Place2_Lat->CurrentValue && is_numeric(ConvertToFloatString($this->Place2_Lat->CurrentValue)))
			$this->Place2_Lat->CurrentValue = ConvertToFloatString($this->Place2_Lat->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Place2_Lon->FormValue == $this->Place2_Lon->CurrentValue && is_numeric(ConvertToFloatString($this->Place2_Lon->CurrentValue)))
			$this->Place2_Lon->CurrentValue = ConvertToFloatString($this->Place2_Lon->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// ID
		// ID_Usuario
		// ID_Place1
		// ID_Place2
		// ID_Cadete
		// ID_Status
		// InstruccionesPlace1
		// InstruccionesPlace2
		// Direccionalidad
		// RemitoURL
		// Place1_Nombre
		// Place1_Country
		// Place1_UF
		// Plate1_Lat
		// Place1_Lon
		// Place1_Calle
		// Place1_Numero
		// Place1_Localidad
		// Place1_Piso
		// Place1_Depto
		// Place1_PersonaRecibe
		// Place1_PersonaRecibeTelefono
		// Place2_Nombre
		// Place2_Country
		// Place2_UF
		// Place2_Lat
		// Place2_Lon
		// Place2_Calle
		// Place2_Numero
		// Place2_Localidad
		// Place2_Piso
		// Place2_Depto
		// Place2_PersonaRecibe
		// Place2_PersonaRecibeTelefono
		// ID_Cadeteria

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// ID
			$this->ID->ViewValue = $this->ID->CurrentValue;
			$this->ID->ViewValue = FormatNumber($this->ID->ViewValue, 0, -2, -2, -2);
			$this->ID->ViewCustomAttributes = "";

			// ID_Usuario
			$this->ID_Usuario->ViewValue = $this->ID_Usuario->CurrentValue;
			$this->ID_Usuario->ViewValue = FormatNumber($this->ID_Usuario->ViewValue, 0, -2, -2, -2);
			$this->ID_Usuario->ViewCustomAttributes = "";

			// ID_Place1
			$this->ID_Place1->ViewValue = $this->ID_Place1->CurrentValue;
			$this->ID_Place1->ViewValue = FormatNumber($this->ID_Place1->ViewValue, 0, -2, -2, -2);
			$this->ID_Place1->ViewCustomAttributes = "";

			// ID_Place2
			$this->ID_Place2->ViewValue = $this->ID_Place2->CurrentValue;
			$this->ID_Place2->ViewValue = FormatNumber($this->ID_Place2->ViewValue, 0, -2, -2, -2);
			$this->ID_Place2->ViewCustomAttributes = "";

			// ID_Cadete
			$this->ID_Cadete->ViewValue = $this->ID_Cadete->CurrentValue;
			$this->ID_Cadete->ViewValue = FormatNumber($this->ID_Cadete->ViewValue, 0, -2, -2, -2);
			$this->ID_Cadete->ViewCustomAttributes = "";

			// ID_Status
			$this->ID_Status->ViewValue = $this->ID_Status->CurrentValue;
			$this->ID_Status->ViewValue = FormatNumber($this->ID_Status->ViewValue, 0, -2, -2, -2);
			$this->ID_Status->ViewCustomAttributes = "";

			// InstruccionesPlace1
			$this->InstruccionesPlace1->ViewValue = $this->InstruccionesPlace1->CurrentValue;
			$this->InstruccionesPlace1->ViewCustomAttributes = "";

			// InstruccionesPlace2
			$this->InstruccionesPlace2->ViewValue = $this->InstruccionesPlace2->CurrentValue;
			$this->InstruccionesPlace2->ViewCustomAttributes = "";

			// Direccionalidad
			$this->Direccionalidad->ViewValue = $this->Direccionalidad->CurrentValue;
			$this->Direccionalidad->ViewValue = FormatNumber($this->Direccionalidad->ViewValue, 0, -2, -2, -2);
			$this->Direccionalidad->ViewCustomAttributes = "";

			// RemitoURL
			$this->RemitoURL->ViewValue = $this->RemitoURL->CurrentValue;
			$this->RemitoURL->ViewCustomAttributes = "";

			// Place1_Nombre
			$this->Place1_Nombre->ViewValue = $this->Place1_Nombre->CurrentValue;
			$this->Place1_Nombre->ViewCustomAttributes = "";

			// Place1_Country
			$this->Place1_Country->ViewValue = $this->Place1_Country->CurrentValue;
			$this->Place1_Country->ViewCustomAttributes = "";

			// Place1_UF
			$this->Place1_UF->ViewValue = $this->Place1_UF->CurrentValue;
			$this->Place1_UF->ViewCustomAttributes = "";

			// Plate1_Lat
			$this->Plate1_Lat->ViewValue = $this->Plate1_Lat->CurrentValue;
			$this->Plate1_Lat->ViewValue = FormatNumber($this->Plate1_Lat->ViewValue, 2, -2, -2, -2);
			$this->Plate1_Lat->ViewCustomAttributes = "";

			// Place1_Lon
			$this->Place1_Lon->ViewValue = $this->Place1_Lon->CurrentValue;
			$this->Place1_Lon->ViewValue = FormatNumber($this->Place1_Lon->ViewValue, 2, -2, -2, -2);
			$this->Place1_Lon->ViewCustomAttributes = "";

			// Place1_Calle
			$this->Place1_Calle->ViewValue = $this->Place1_Calle->CurrentValue;
			$this->Place1_Calle->ViewCustomAttributes = "";

			// Place1_Numero
			$this->Place1_Numero->ViewValue = $this->Place1_Numero->CurrentValue;
			$this->Place1_Numero->ViewCustomAttributes = "";

			// Place1_Localidad
			$this->Place1_Localidad->ViewValue = $this->Place1_Localidad->CurrentValue;
			$this->Place1_Localidad->ViewCustomAttributes = "";

			// Place1_Piso
			$this->Place1_Piso->ViewValue = $this->Place1_Piso->CurrentValue;
			$this->Place1_Piso->ViewCustomAttributes = "";

			// Place1_Depto
			$this->Place1_Depto->ViewValue = $this->Place1_Depto->CurrentValue;
			$this->Place1_Depto->ViewCustomAttributes = "";

			// Place1_PersonaRecibe
			$this->Place1_PersonaRecibe->ViewValue = $this->Place1_PersonaRecibe->CurrentValue;
			$this->Place1_PersonaRecibe->ViewCustomAttributes = "";

			// Place1_PersonaRecibeTelefono
			$this->Place1_PersonaRecibeTelefono->ViewValue = $this->Place1_PersonaRecibeTelefono->CurrentValue;
			$this->Place1_PersonaRecibeTelefono->ViewCustomAttributes = "";

			// Place2_Nombre
			$this->Place2_Nombre->ViewValue = $this->Place2_Nombre->CurrentValue;
			$this->Place2_Nombre->ViewCustomAttributes = "";

			// Place2_Country
			$this->Place2_Country->ViewValue = $this->Place2_Country->CurrentValue;
			$this->Place2_Country->ViewCustomAttributes = "";

			// Place2_UF
			$this->Place2_UF->ViewValue = $this->Place2_UF->CurrentValue;
			$this->Place2_UF->ViewCustomAttributes = "";

			// Place2_Lat
			$this->Place2_Lat->ViewValue = $this->Place2_Lat->CurrentValue;
			$this->Place2_Lat->ViewValue = FormatNumber($this->Place2_Lat->ViewValue, 2, -2, -2, -2);
			$this->Place2_Lat->ViewCustomAttributes = "";

			// Place2_Lon
			$this->Place2_Lon->ViewValue = $this->Place2_Lon->CurrentValue;
			$this->Place2_Lon->ViewValue = FormatNumber($this->Place2_Lon->ViewValue, 2, -2, -2, -2);
			$this->Place2_Lon->ViewCustomAttributes = "";

			// Place2_Calle
			$this->Place2_Calle->ViewValue = $this->Place2_Calle->CurrentValue;
			$this->Place2_Calle->ViewCustomAttributes = "";

			// Place2_Numero
			$this->Place2_Numero->ViewValue = $this->Place2_Numero->CurrentValue;
			$this->Place2_Numero->ViewCustomAttributes = "";

			// Place2_Localidad
			$this->Place2_Localidad->ViewValue = $this->Place2_Localidad->CurrentValue;
			$this->Place2_Localidad->ViewCustomAttributes = "";

			// Place2_Piso
			$this->Place2_Piso->ViewValue = $this->Place2_Piso->CurrentValue;
			$this->Place2_Piso->ViewCustomAttributes = "";

			// Place2_Depto
			$this->Place2_Depto->ViewValue = $this->Place2_Depto->CurrentValue;
			$this->Place2_Depto->ViewCustomAttributes = "";

			// Place2_PersonaRecibe
			$this->Place2_PersonaRecibe->ViewValue = $this->Place2_PersonaRecibe->CurrentValue;
			$this->Place2_PersonaRecibe->ViewCustomAttributes = "";

			// Place2_PersonaRecibeTelefono
			$this->Place2_PersonaRecibeTelefono->ViewValue = $this->Place2_PersonaRecibeTelefono->CurrentValue;
			$this->Place2_PersonaRecibeTelefono->ViewCustomAttributes = "";

			// ID_Cadeteria
			$this->ID_Cadeteria->ViewValue = $this->ID_Cadeteria->CurrentValue;
			$this->ID_Cadeteria->ViewValue = FormatNumber($this->ID_Cadeteria->ViewValue, 0, -2, -2, -2);
			$this->ID_Cadeteria->ViewCustomAttributes = "";

			// ID
			$this->ID->LinkCustomAttributes = "";
			$this->ID->HrefValue = "";
			$this->ID->TooltipValue = "";

			// ID_Usuario
			$this->ID_Usuario->LinkCustomAttributes = "";
			$this->ID_Usuario->HrefValue = "";
			$this->ID_Usuario->TooltipValue = "";

			// ID_Place1
			$this->ID_Place1->LinkCustomAttributes = "";
			$this->ID_Place1->HrefValue = "";
			$this->ID_Place1->TooltipValue = "";

			// ID_Place2
			$this->ID_Place2->LinkCustomAttributes = "";
			$this->ID_Place2->HrefValue = "";
			$this->ID_Place2->TooltipValue = "";

			// ID_Cadete
			$this->ID_Cadete->LinkCustomAttributes = "";
			$this->ID_Cadete->HrefValue = "";
			$this->ID_Cadete->TooltipValue = "";

			// ID_Status
			$this->ID_Status->LinkCustomAttributes = "";
			$this->ID_Status->HrefValue = "";
			$this->ID_Status->TooltipValue = "";

			// InstruccionesPlace1
			$this->InstruccionesPlace1->LinkCustomAttributes = "";
			$this->InstruccionesPlace1->HrefValue = "";
			$this->InstruccionesPlace1->TooltipValue = "";

			// InstruccionesPlace2
			$this->InstruccionesPlace2->LinkCustomAttributes = "";
			$this->InstruccionesPlace2->HrefValue = "";
			$this->InstruccionesPlace2->TooltipValue = "";

			// Direccionalidad
			$this->Direccionalidad->LinkCustomAttributes = "";
			$this->Direccionalidad->HrefValue = "";
			$this->Direccionalidad->TooltipValue = "";

			// RemitoURL
			$this->RemitoURL->LinkCustomAttributes = "";
			$this->RemitoURL->HrefValue = "";
			$this->RemitoURL->TooltipValue = "";

			// Place1_Nombre
			$this->Place1_Nombre->LinkCustomAttributes = "";
			$this->Place1_Nombre->HrefValue = "";
			$this->Place1_Nombre->TooltipValue = "";

			// Place1_Country
			$this->Place1_Country->LinkCustomAttributes = "";
			$this->Place1_Country->HrefValue = "";
			$this->Place1_Country->TooltipValue = "";

			// Place1_UF
			$this->Place1_UF->LinkCustomAttributes = "";
			$this->Place1_UF->HrefValue = "";
			$this->Place1_UF->TooltipValue = "";

			// Plate1_Lat
			$this->Plate1_Lat->LinkCustomAttributes = "";
			$this->Plate1_Lat->HrefValue = "";
			$this->Plate1_Lat->TooltipValue = "";

			// Place1_Lon
			$this->Place1_Lon->LinkCustomAttributes = "";
			$this->Place1_Lon->HrefValue = "";
			$this->Place1_Lon->TooltipValue = "";

			// Place1_Calle
			$this->Place1_Calle->LinkCustomAttributes = "";
			$this->Place1_Calle->HrefValue = "";
			$this->Place1_Calle->TooltipValue = "";

			// Place1_Numero
			$this->Place1_Numero->LinkCustomAttributes = "";
			$this->Place1_Numero->HrefValue = "";
			$this->Place1_Numero->TooltipValue = "";

			// Place1_Localidad
			$this->Place1_Localidad->LinkCustomAttributes = "";
			$this->Place1_Localidad->HrefValue = "";
			$this->Place1_Localidad->TooltipValue = "";

			// Place1_Piso
			$this->Place1_Piso->LinkCustomAttributes = "";
			$this->Place1_Piso->HrefValue = "";
			$this->Place1_Piso->TooltipValue = "";

			// Place1_Depto
			$this->Place1_Depto->LinkCustomAttributes = "";
			$this->Place1_Depto->HrefValue = "";
			$this->Place1_Depto->TooltipValue = "";

			// Place1_PersonaRecibe
			$this->Place1_PersonaRecibe->LinkCustomAttributes = "";
			$this->Place1_PersonaRecibe->HrefValue = "";
			$this->Place1_PersonaRecibe->TooltipValue = "";

			// Place1_PersonaRecibeTelefono
			$this->Place1_PersonaRecibeTelefono->LinkCustomAttributes = "";
			$this->Place1_PersonaRecibeTelefono->HrefValue = "";
			$this->Place1_PersonaRecibeTelefono->TooltipValue = "";

			// Place2_Nombre
			$this->Place2_Nombre->LinkCustomAttributes = "";
			$this->Place2_Nombre->HrefValue = "";
			$this->Place2_Nombre->TooltipValue = "";

			// Place2_Country
			$this->Place2_Country->LinkCustomAttributes = "";
			$this->Place2_Country->HrefValue = "";
			$this->Place2_Country->TooltipValue = "";

			// Place2_UF
			$this->Place2_UF->LinkCustomAttributes = "";
			$this->Place2_UF->HrefValue = "";
			$this->Place2_UF->TooltipValue = "";

			// Place2_Lat
			$this->Place2_Lat->LinkCustomAttributes = "";
			$this->Place2_Lat->HrefValue = "";
			$this->Place2_Lat->TooltipValue = "";

			// Place2_Lon
			$this->Place2_Lon->LinkCustomAttributes = "";
			$this->Place2_Lon->HrefValue = "";
			$this->Place2_Lon->TooltipValue = "";

			// Place2_Calle
			$this->Place2_Calle->LinkCustomAttributes = "";
			$this->Place2_Calle->HrefValue = "";
			$this->Place2_Calle->TooltipValue = "";

			// Place2_Numero
			$this->Place2_Numero->LinkCustomAttributes = "";
			$this->Place2_Numero->HrefValue = "";
			$this->Place2_Numero->TooltipValue = "";

			// Place2_Localidad
			$this->Place2_Localidad->LinkCustomAttributes = "";
			$this->Place2_Localidad->HrefValue = "";
			$this->Place2_Localidad->TooltipValue = "";

			// Place2_Piso
			$this->Place2_Piso->LinkCustomAttributes = "";
			$this->Place2_Piso->HrefValue = "";
			$this->Place2_Piso->TooltipValue = "";

			// Place2_Depto
			$this->Place2_Depto->LinkCustomAttributes = "";
			$this->Place2_Depto->HrefValue = "";
			$this->Place2_Depto->TooltipValue = "";

			// Place2_PersonaRecibe
			$this->Place2_PersonaRecibe->LinkCustomAttributes = "";
			$this->Place2_PersonaRecibe->HrefValue = "";
			$this->Place2_PersonaRecibe->TooltipValue = "";

			// Place2_PersonaRecibeTelefono
			$this->Place2_PersonaRecibeTelefono->LinkCustomAttributes = "";
			$this->Place2_PersonaRecibeTelefono->HrefValue = "";
			$this->Place2_PersonaRecibeTelefono->TooltipValue = "";

			// ID_Cadeteria
			$this->ID_Cadeteria->LinkCustomAttributes = "";
			$this->ID_Cadeteria->HrefValue = "";
			$this->ID_Cadeteria->TooltipValue = "";
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
		$item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fPedidoACadeterialistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
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