<?php
namespace PHPMaker2020\BACKOFFICE_CADETERIAS;

/**
 * Page class
 */
class PedidoACadeteria_view extends PedidoACadeteria
{

	// Page ID
	public $PageID = "view";

	// Project ID
	public $ProjectID = "{68D35137-1670-419B-B841-52FFD5E14A4B}";

	// Table name
	public $TableName = 'PedidoACadeteria';

	// Page object name
	public $PageObjName = "PedidoACadeteria_view";

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

		// Table object (Cadeteria)
		if (!isset($GLOBALS['Cadeteria']))
			$GLOBALS['Cadeteria'] = new Cadeteria();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'view');

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

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = ["url" => $url, "modal" => "1"];
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "PedidoACadeteriaview.php")
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
					$this->terminate(GetUrl("PedidoACadeterialist.php"));
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
					$this->terminate(GetUrl("PedidoACadeterialist.php"));
					return;
				}
			}
		}
		$this->CurrentAction = Param("action"); // Set up current action
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
			$this->terminate("PedidoACadeterialist.php");
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
				$returnUrl = "PedidoACadeterialist.php"; // Return to list
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
						$returnUrl = "PedidoACadeterialist.php"; // No matching record, return to list
					}
			}
		} else {
			$returnUrl = "PedidoACadeterialist.php"; // Not page request, return to list
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

		// Add
		$item = &$option->add("add");
		$addcaption = HtmlTitle($Language->phrase("ViewPageAddLink"));
		if ($this->IsModal) // Modal
			$item->Body = "<a class=\"ew-action ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,url:'" . HtmlEncode($this->AddUrl) . "'});\">" . $Language->phrase("ViewPageAddLink") . "</a>";
		else
			$item->Body = "<a class=\"ew-action ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode($this->AddUrl) . "\">" . $Language->phrase("ViewPageAddLink") . "</a>";
		$item->Visible = ($this->AddUrl != "" && $Security->canAdd());

		// Edit
		$item = &$option->add("edit");
		$editcaption = HtmlTitle($Language->phrase("ViewPageEditLink"));
		if ($this->IsModal) // Modal
			$item->Body = "<a class=\"ew-action ew-edit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,url:'" . HtmlEncode($this->EditUrl) . "'});\">" . $Language->phrase("ViewPageEditLink") . "</a>";
		else
			$item->Body = "<a class=\"ew-action ew-edit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"" . HtmlEncode($this->EditUrl) . "\">" . $Language->phrase("ViewPageEditLink") . "</a>";
		$item->Visible = ($this->EditUrl != "" && $Security->canEdit()&& $this->showOptionLink('edit'));

		// Copy
		$item = &$option->add("copy");
		$copycaption = HtmlTitle($Language->phrase("ViewPageCopyLink"));
		if ($this->IsModal) // Modal
			$item->Body = "<a class=\"ew-action ew-copy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'AddBtn',url:'" . HtmlEncode($this->CopyUrl) . "'});\">" . $Language->phrase("ViewPageCopyLink") . "</a>";
		else
			$item->Body = "<a class=\"ew-action ew-copy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"" . HtmlEncode($this->CopyUrl) . "\">" . $Language->phrase("ViewPageCopyLink") . "</a>";
		$item->Visible = ($this->CopyUrl != "" && $Security->canAdd() && $this->showOptionLink('add'));

		// Delete
		$item = &$option->add("delete");
		if ($this->IsModal) // Handle as inline delete
			$item->Body = "<a onclick=\"return ew.confirmDelete(this);\" class=\"ew-action ew-delete\" title=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" href=\"" . HtmlEncode(UrlAddQuery($this->DeleteUrl, "action=1")) . "\">" . $Language->phrase("ViewPageDeleteLink") . "</a>";
		else
			$item->Body = "<a class=\"ew-action ew-delete\" title=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" href=\"" . HtmlEncode($this->DeleteUrl) . "\">" . $Language->phrase("ViewPageDeleteLink") . "</a>";
		$item->Visible = ($this->DeleteUrl != "" && $Security->canDelete() && $this->showOptionLink('delete'));

		// Set up action default
		$option = $options["action"];
		$option->DropDownButtonPhrase = $Language->phrase("ButtonActions");
		$option->UseDropDownButton = FALSE;
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("PedidoACadeterialist.php"), "", $this->TableVar, TRUE);
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