<?php
namespace PHPMaker2020\BACKOFFICE_CADETERIAS;

/**
 * Page class
 */
class PedidoACadeteria_edit extends PedidoACadeteria
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{68D35137-1670-419B-B841-52FFD5E14A4B}";

	// Table name
	public $TableName = 'PedidoACadeteria';

	// Page object name
	public $PageObjName = "PedidoACadeteria_edit";

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

		// Table object (Cadeteria)
		if (!isset($GLOBALS['Cadeteria']))
			$GLOBALS['Cadeteria'] = new Cadeteria();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

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

		// Create form object
		$CurrentForm = new HttpForm();
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

		if (!$Security->canEdit()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("PedidoACadeterialist.php");
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
					$this->terminate("PedidoACadeterialist.php"); // No matching record, return to list
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "PedidoACadeterialist.php")
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
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'ID' first before field var 'x_ID'
		$val = $CurrentForm->hasValue("ID") ? $CurrentForm->getValue("ID") : $CurrentForm->getValue("x_ID");
		if (!$this->ID->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ID->Visible = FALSE; // Disable update for API request
			else
				$this->ID->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ID"))
			$this->ID->setOldValue($CurrentForm->getValue("o_ID"));

		// Check field name 'ID_Usuario' first before field var 'x_ID_Usuario'
		$val = $CurrentForm->hasValue("ID_Usuario") ? $CurrentForm->getValue("ID_Usuario") : $CurrentForm->getValue("x_ID_Usuario");
		if (!$this->ID_Usuario->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ID_Usuario->Visible = FALSE; // Disable update for API request
			else
				$this->ID_Usuario->setFormValue($val);
		}

		// Check field name 'ID_Place1' first before field var 'x_ID_Place1'
		$val = $CurrentForm->hasValue("ID_Place1") ? $CurrentForm->getValue("ID_Place1") : $CurrentForm->getValue("x_ID_Place1");
		if (!$this->ID_Place1->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ID_Place1->Visible = FALSE; // Disable update for API request
			else
				$this->ID_Place1->setFormValue($val);
		}

		// Check field name 'ID_Place2' first before field var 'x_ID_Place2'
		$val = $CurrentForm->hasValue("ID_Place2") ? $CurrentForm->getValue("ID_Place2") : $CurrentForm->getValue("x_ID_Place2");
		if (!$this->ID_Place2->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ID_Place2->Visible = FALSE; // Disable update for API request
			else
				$this->ID_Place2->setFormValue($val);
		}

		// Check field name 'ID_Cadete' first before field var 'x_ID_Cadete'
		$val = $CurrentForm->hasValue("ID_Cadete") ? $CurrentForm->getValue("ID_Cadete") : $CurrentForm->getValue("x_ID_Cadete");
		if (!$this->ID_Cadete->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ID_Cadete->Visible = FALSE; // Disable update for API request
			else
				$this->ID_Cadete->setFormValue($val);
		}

		// Check field name 'ID_Status' first before field var 'x_ID_Status'
		$val = $CurrentForm->hasValue("ID_Status") ? $CurrentForm->getValue("ID_Status") : $CurrentForm->getValue("x_ID_Status");
		if (!$this->ID_Status->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ID_Status->Visible = FALSE; // Disable update for API request
			else
				$this->ID_Status->setFormValue($val);
		}

		// Check field name 'InstruccionesPlace1' first before field var 'x_InstruccionesPlace1'
		$val = $CurrentForm->hasValue("InstruccionesPlace1") ? $CurrentForm->getValue("InstruccionesPlace1") : $CurrentForm->getValue("x_InstruccionesPlace1");
		if (!$this->InstruccionesPlace1->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->InstruccionesPlace1->Visible = FALSE; // Disable update for API request
			else
				$this->InstruccionesPlace1->setFormValue($val);
		}

		// Check field name 'InstruccionesPlace2' first before field var 'x_InstruccionesPlace2'
		$val = $CurrentForm->hasValue("InstruccionesPlace2") ? $CurrentForm->getValue("InstruccionesPlace2") : $CurrentForm->getValue("x_InstruccionesPlace2");
		if (!$this->InstruccionesPlace2->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->InstruccionesPlace2->Visible = FALSE; // Disable update for API request
			else
				$this->InstruccionesPlace2->setFormValue($val);
		}

		// Check field name 'Direccionalidad' first before field var 'x_Direccionalidad'
		$val = $CurrentForm->hasValue("Direccionalidad") ? $CurrentForm->getValue("Direccionalidad") : $CurrentForm->getValue("x_Direccionalidad");
		if (!$this->Direccionalidad->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Direccionalidad->Visible = FALSE; // Disable update for API request
			else
				$this->Direccionalidad->setFormValue($val);
		}

		// Check field name 'RemitoURL' first before field var 'x_RemitoURL'
		$val = $CurrentForm->hasValue("RemitoURL") ? $CurrentForm->getValue("RemitoURL") : $CurrentForm->getValue("x_RemitoURL");
		if (!$this->RemitoURL->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->RemitoURL->Visible = FALSE; // Disable update for API request
			else
				$this->RemitoURL->setFormValue($val);
		}

		// Check field name 'Place1_Nombre' first before field var 'x_Place1_Nombre'
		$val = $CurrentForm->hasValue("Place1_Nombre") ? $CurrentForm->getValue("Place1_Nombre") : $CurrentForm->getValue("x_Place1_Nombre");
		if (!$this->Place1_Nombre->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Place1_Nombre->Visible = FALSE; // Disable update for API request
			else
				$this->Place1_Nombre->setFormValue($val);
		}

		// Check field name 'Place1_Country' first before field var 'x_Place1_Country'
		$val = $CurrentForm->hasValue("Place1_Country") ? $CurrentForm->getValue("Place1_Country") : $CurrentForm->getValue("x_Place1_Country");
		if (!$this->Place1_Country->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Place1_Country->Visible = FALSE; // Disable update for API request
			else
				$this->Place1_Country->setFormValue($val);
		}

		// Check field name 'Place1_UF' first before field var 'x_Place1_UF'
		$val = $CurrentForm->hasValue("Place1_UF") ? $CurrentForm->getValue("Place1_UF") : $CurrentForm->getValue("x_Place1_UF");
		if (!$this->Place1_UF->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Place1_UF->Visible = FALSE; // Disable update for API request
			else
				$this->Place1_UF->setFormValue($val);
		}

		// Check field name 'Plate1_Lat' first before field var 'x_Plate1_Lat'
		$val = $CurrentForm->hasValue("Plate1_Lat") ? $CurrentForm->getValue("Plate1_Lat") : $CurrentForm->getValue("x_Plate1_Lat");
		if (!$this->Plate1_Lat->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Plate1_Lat->Visible = FALSE; // Disable update for API request
			else
				$this->Plate1_Lat->setFormValue($val);
		}

		// Check field name 'Place1_Lon' first before field var 'x_Place1_Lon'
		$val = $CurrentForm->hasValue("Place1_Lon") ? $CurrentForm->getValue("Place1_Lon") : $CurrentForm->getValue("x_Place1_Lon");
		if (!$this->Place1_Lon->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Place1_Lon->Visible = FALSE; // Disable update for API request
			else
				$this->Place1_Lon->setFormValue($val);
		}

		// Check field name 'Place1_Calle' first before field var 'x_Place1_Calle'
		$val = $CurrentForm->hasValue("Place1_Calle") ? $CurrentForm->getValue("Place1_Calle") : $CurrentForm->getValue("x_Place1_Calle");
		if (!$this->Place1_Calle->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Place1_Calle->Visible = FALSE; // Disable update for API request
			else
				$this->Place1_Calle->setFormValue($val);
		}

		// Check field name 'Place1_Numero' first before field var 'x_Place1_Numero'
		$val = $CurrentForm->hasValue("Place1_Numero") ? $CurrentForm->getValue("Place1_Numero") : $CurrentForm->getValue("x_Place1_Numero");
		if (!$this->Place1_Numero->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Place1_Numero->Visible = FALSE; // Disable update for API request
			else
				$this->Place1_Numero->setFormValue($val);
		}

		// Check field name 'Place1_Localidad' first before field var 'x_Place1_Localidad'
		$val = $CurrentForm->hasValue("Place1_Localidad") ? $CurrentForm->getValue("Place1_Localidad") : $CurrentForm->getValue("x_Place1_Localidad");
		if (!$this->Place1_Localidad->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Place1_Localidad->Visible = FALSE; // Disable update for API request
			else
				$this->Place1_Localidad->setFormValue($val);
		}

		// Check field name 'Place1_Piso' first before field var 'x_Place1_Piso'
		$val = $CurrentForm->hasValue("Place1_Piso") ? $CurrentForm->getValue("Place1_Piso") : $CurrentForm->getValue("x_Place1_Piso");
		if (!$this->Place1_Piso->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Place1_Piso->Visible = FALSE; // Disable update for API request
			else
				$this->Place1_Piso->setFormValue($val);
		}

		// Check field name 'Place1_Depto' first before field var 'x_Place1_Depto'
		$val = $CurrentForm->hasValue("Place1_Depto") ? $CurrentForm->getValue("Place1_Depto") : $CurrentForm->getValue("x_Place1_Depto");
		if (!$this->Place1_Depto->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Place1_Depto->Visible = FALSE; // Disable update for API request
			else
				$this->Place1_Depto->setFormValue($val);
		}

		// Check field name 'Place1_PersonaRecibe' first before field var 'x_Place1_PersonaRecibe'
		$val = $CurrentForm->hasValue("Place1_PersonaRecibe") ? $CurrentForm->getValue("Place1_PersonaRecibe") : $CurrentForm->getValue("x_Place1_PersonaRecibe");
		if (!$this->Place1_PersonaRecibe->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Place1_PersonaRecibe->Visible = FALSE; // Disable update for API request
			else
				$this->Place1_PersonaRecibe->setFormValue($val);
		}

		// Check field name 'Place1_PersonaRecibeTelefono' first before field var 'x_Place1_PersonaRecibeTelefono'
		$val = $CurrentForm->hasValue("Place1_PersonaRecibeTelefono") ? $CurrentForm->getValue("Place1_PersonaRecibeTelefono") : $CurrentForm->getValue("x_Place1_PersonaRecibeTelefono");
		if (!$this->Place1_PersonaRecibeTelefono->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Place1_PersonaRecibeTelefono->Visible = FALSE; // Disable update for API request
			else
				$this->Place1_PersonaRecibeTelefono->setFormValue($val);
		}

		// Check field name 'Place2_Nombre' first before field var 'x_Place2_Nombre'
		$val = $CurrentForm->hasValue("Place2_Nombre") ? $CurrentForm->getValue("Place2_Nombre") : $CurrentForm->getValue("x_Place2_Nombre");
		if (!$this->Place2_Nombre->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Place2_Nombre->Visible = FALSE; // Disable update for API request
			else
				$this->Place2_Nombre->setFormValue($val);
		}

		// Check field name 'Place2_Country' first before field var 'x_Place2_Country'
		$val = $CurrentForm->hasValue("Place2_Country") ? $CurrentForm->getValue("Place2_Country") : $CurrentForm->getValue("x_Place2_Country");
		if (!$this->Place2_Country->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Place2_Country->Visible = FALSE; // Disable update for API request
			else
				$this->Place2_Country->setFormValue($val);
		}

		// Check field name 'Place2_UF' first before field var 'x_Place2_UF'
		$val = $CurrentForm->hasValue("Place2_UF") ? $CurrentForm->getValue("Place2_UF") : $CurrentForm->getValue("x_Place2_UF");
		if (!$this->Place2_UF->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Place2_UF->Visible = FALSE; // Disable update for API request
			else
				$this->Place2_UF->setFormValue($val);
		}

		// Check field name 'Place2_Lat' first before field var 'x_Place2_Lat'
		$val = $CurrentForm->hasValue("Place2_Lat") ? $CurrentForm->getValue("Place2_Lat") : $CurrentForm->getValue("x_Place2_Lat");
		if (!$this->Place2_Lat->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Place2_Lat->Visible = FALSE; // Disable update for API request
			else
				$this->Place2_Lat->setFormValue($val);
		}

		// Check field name 'Place2_Lon' first before field var 'x_Place2_Lon'
		$val = $CurrentForm->hasValue("Place2_Lon") ? $CurrentForm->getValue("Place2_Lon") : $CurrentForm->getValue("x_Place2_Lon");
		if (!$this->Place2_Lon->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Place2_Lon->Visible = FALSE; // Disable update for API request
			else
				$this->Place2_Lon->setFormValue($val);
		}

		// Check field name 'Place2_Calle' first before field var 'x_Place2_Calle'
		$val = $CurrentForm->hasValue("Place2_Calle") ? $CurrentForm->getValue("Place2_Calle") : $CurrentForm->getValue("x_Place2_Calle");
		if (!$this->Place2_Calle->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Place2_Calle->Visible = FALSE; // Disable update for API request
			else
				$this->Place2_Calle->setFormValue($val);
		}

		// Check field name 'Place2_Numero' first before field var 'x_Place2_Numero'
		$val = $CurrentForm->hasValue("Place2_Numero") ? $CurrentForm->getValue("Place2_Numero") : $CurrentForm->getValue("x_Place2_Numero");
		if (!$this->Place2_Numero->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Place2_Numero->Visible = FALSE; // Disable update for API request
			else
				$this->Place2_Numero->setFormValue($val);
		}

		// Check field name 'Place2_Localidad' first before field var 'x_Place2_Localidad'
		$val = $CurrentForm->hasValue("Place2_Localidad") ? $CurrentForm->getValue("Place2_Localidad") : $CurrentForm->getValue("x_Place2_Localidad");
		if (!$this->Place2_Localidad->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Place2_Localidad->Visible = FALSE; // Disable update for API request
			else
				$this->Place2_Localidad->setFormValue($val);
		}

		// Check field name 'Place2_Piso' first before field var 'x_Place2_Piso'
		$val = $CurrentForm->hasValue("Place2_Piso") ? $CurrentForm->getValue("Place2_Piso") : $CurrentForm->getValue("x_Place2_Piso");
		if (!$this->Place2_Piso->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Place2_Piso->Visible = FALSE; // Disable update for API request
			else
				$this->Place2_Piso->setFormValue($val);
		}

		// Check field name 'Place2_Depto' first before field var 'x_Place2_Depto'
		$val = $CurrentForm->hasValue("Place2_Depto") ? $CurrentForm->getValue("Place2_Depto") : $CurrentForm->getValue("x_Place2_Depto");
		if (!$this->Place2_Depto->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Place2_Depto->Visible = FALSE; // Disable update for API request
			else
				$this->Place2_Depto->setFormValue($val);
		}

		// Check field name 'Place2_PersonaRecibe' first before field var 'x_Place2_PersonaRecibe'
		$val = $CurrentForm->hasValue("Place2_PersonaRecibe") ? $CurrentForm->getValue("Place2_PersonaRecibe") : $CurrentForm->getValue("x_Place2_PersonaRecibe");
		if (!$this->Place2_PersonaRecibe->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Place2_PersonaRecibe->Visible = FALSE; // Disable update for API request
			else
				$this->Place2_PersonaRecibe->setFormValue($val);
		}

		// Check field name 'Place2_PersonaRecibeTelefono' first before field var 'x_Place2_PersonaRecibeTelefono'
		$val = $CurrentForm->hasValue("Place2_PersonaRecibeTelefono") ? $CurrentForm->getValue("Place2_PersonaRecibeTelefono") : $CurrentForm->getValue("x_Place2_PersonaRecibeTelefono");
		if (!$this->Place2_PersonaRecibeTelefono->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Place2_PersonaRecibeTelefono->Visible = FALSE; // Disable update for API request
			else
				$this->Place2_PersonaRecibeTelefono->setFormValue($val);
		}

		// Check field name 'ID_Cadeteria' first before field var 'x_ID_Cadeteria'
		$val = $CurrentForm->hasValue("ID_Cadeteria") ? $CurrentForm->getValue("ID_Cadeteria") : $CurrentForm->getValue("x_ID_Cadeteria");
		if (!$this->ID_Cadeteria->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ID_Cadeteria->Visible = FALSE; // Disable update for API request
			else
				$this->ID_Cadeteria->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->ID->CurrentValue = $this->ID->FormValue;
		$this->ID_Usuario->CurrentValue = $this->ID_Usuario->FormValue;
		$this->ID_Place1->CurrentValue = $this->ID_Place1->FormValue;
		$this->ID_Place2->CurrentValue = $this->ID_Place2->FormValue;
		$this->ID_Cadete->CurrentValue = $this->ID_Cadete->FormValue;
		$this->ID_Status->CurrentValue = $this->ID_Status->FormValue;
		$this->InstruccionesPlace1->CurrentValue = $this->InstruccionesPlace1->FormValue;
		$this->InstruccionesPlace2->CurrentValue = $this->InstruccionesPlace2->FormValue;
		$this->Direccionalidad->CurrentValue = $this->Direccionalidad->FormValue;
		$this->RemitoURL->CurrentValue = $this->RemitoURL->FormValue;
		$this->Place1_Nombre->CurrentValue = $this->Place1_Nombre->FormValue;
		$this->Place1_Country->CurrentValue = $this->Place1_Country->FormValue;
		$this->Place1_UF->CurrentValue = $this->Place1_UF->FormValue;
		$this->Plate1_Lat->CurrentValue = $this->Plate1_Lat->FormValue;
		$this->Place1_Lon->CurrentValue = $this->Place1_Lon->FormValue;
		$this->Place1_Calle->CurrentValue = $this->Place1_Calle->FormValue;
		$this->Place1_Numero->CurrentValue = $this->Place1_Numero->FormValue;
		$this->Place1_Localidad->CurrentValue = $this->Place1_Localidad->FormValue;
		$this->Place1_Piso->CurrentValue = $this->Place1_Piso->FormValue;
		$this->Place1_Depto->CurrentValue = $this->Place1_Depto->FormValue;
		$this->Place1_PersonaRecibe->CurrentValue = $this->Place1_PersonaRecibe->FormValue;
		$this->Place1_PersonaRecibeTelefono->CurrentValue = $this->Place1_PersonaRecibeTelefono->FormValue;
		$this->Place2_Nombre->CurrentValue = $this->Place2_Nombre->FormValue;
		$this->Place2_Country->CurrentValue = $this->Place2_Country->FormValue;
		$this->Place2_UF->CurrentValue = $this->Place2_UF->FormValue;
		$this->Place2_Lat->CurrentValue = $this->Place2_Lat->FormValue;
		$this->Place2_Lon->CurrentValue = $this->Place2_Lon->FormValue;
		$this->Place2_Calle->CurrentValue = $this->Place2_Calle->FormValue;
		$this->Place2_Numero->CurrentValue = $this->Place2_Numero->FormValue;
		$this->Place2_Localidad->CurrentValue = $this->Place2_Localidad->FormValue;
		$this->Place2_Piso->CurrentValue = $this->Place2_Piso->FormValue;
		$this->Place2_Depto->CurrentValue = $this->Place2_Depto->FormValue;
		$this->Place2_PersonaRecibe->CurrentValue = $this->Place2_PersonaRecibe->FormValue;
		$this->Place2_PersonaRecibeTelefono->CurrentValue = $this->Place2_PersonaRecibeTelefono->FormValue;
		$this->ID_Cadeteria->CurrentValue = $this->ID_Cadeteria->FormValue;
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
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// ID
			$this->ID->EditAttrs["class"] = "form-control";
			$this->ID->EditCustomAttributes = "";
			$this->ID->EditValue = HtmlEncode($this->ID->CurrentValue);
			$this->ID->PlaceHolder = RemoveHtml($this->ID->caption());

			// ID_Usuario
			$this->ID_Usuario->EditAttrs["class"] = "form-control";
			$this->ID_Usuario->EditCustomAttributes = "";
			$this->ID_Usuario->EditValue = HtmlEncode($this->ID_Usuario->CurrentValue);
			$this->ID_Usuario->PlaceHolder = RemoveHtml($this->ID_Usuario->caption());

			// ID_Place1
			$this->ID_Place1->EditAttrs["class"] = "form-control";
			$this->ID_Place1->EditCustomAttributes = "";
			$this->ID_Place1->EditValue = HtmlEncode($this->ID_Place1->CurrentValue);
			$this->ID_Place1->PlaceHolder = RemoveHtml($this->ID_Place1->caption());

			// ID_Place2
			$this->ID_Place2->EditAttrs["class"] = "form-control";
			$this->ID_Place2->EditCustomAttributes = "";
			$this->ID_Place2->EditValue = HtmlEncode($this->ID_Place2->CurrentValue);
			$this->ID_Place2->PlaceHolder = RemoveHtml($this->ID_Place2->caption());

			// ID_Cadete
			$this->ID_Cadete->EditAttrs["class"] = "form-control";
			$this->ID_Cadete->EditCustomAttributes = "";
			$this->ID_Cadete->EditValue = HtmlEncode($this->ID_Cadete->CurrentValue);
			$this->ID_Cadete->PlaceHolder = RemoveHtml($this->ID_Cadete->caption());

			// ID_Status
			$this->ID_Status->EditAttrs["class"] = "form-control";
			$this->ID_Status->EditCustomAttributes = "";
			$this->ID_Status->EditValue = HtmlEncode($this->ID_Status->CurrentValue);
			$this->ID_Status->PlaceHolder = RemoveHtml($this->ID_Status->caption());

			// InstruccionesPlace1
			$this->InstruccionesPlace1->EditAttrs["class"] = "form-control";
			$this->InstruccionesPlace1->EditCustomAttributes = "";
			if (!$this->InstruccionesPlace1->Raw)
				$this->InstruccionesPlace1->CurrentValue = HtmlDecode($this->InstruccionesPlace1->CurrentValue);
			$this->InstruccionesPlace1->EditValue = HtmlEncode($this->InstruccionesPlace1->CurrentValue);
			$this->InstruccionesPlace1->PlaceHolder = RemoveHtml($this->InstruccionesPlace1->caption());

			// InstruccionesPlace2
			$this->InstruccionesPlace2->EditAttrs["class"] = "form-control";
			$this->InstruccionesPlace2->EditCustomAttributes = "";
			if (!$this->InstruccionesPlace2->Raw)
				$this->InstruccionesPlace2->CurrentValue = HtmlDecode($this->InstruccionesPlace2->CurrentValue);
			$this->InstruccionesPlace2->EditValue = HtmlEncode($this->InstruccionesPlace2->CurrentValue);
			$this->InstruccionesPlace2->PlaceHolder = RemoveHtml($this->InstruccionesPlace2->caption());

			// Direccionalidad
			$this->Direccionalidad->EditAttrs["class"] = "form-control";
			$this->Direccionalidad->EditCustomAttributes = "";
			$this->Direccionalidad->EditValue = HtmlEncode($this->Direccionalidad->CurrentValue);
			$this->Direccionalidad->PlaceHolder = RemoveHtml($this->Direccionalidad->caption());

			// RemitoURL
			$this->RemitoURL->EditAttrs["class"] = "form-control";
			$this->RemitoURL->EditCustomAttributes = "";
			if (!$this->RemitoURL->Raw)
				$this->RemitoURL->CurrentValue = HtmlDecode($this->RemitoURL->CurrentValue);
			$this->RemitoURL->EditValue = HtmlEncode($this->RemitoURL->CurrentValue);
			$this->RemitoURL->PlaceHolder = RemoveHtml($this->RemitoURL->caption());

			// Place1_Nombre
			$this->Place1_Nombre->EditAttrs["class"] = "form-control";
			$this->Place1_Nombre->EditCustomAttributes = "";
			if (!$this->Place1_Nombre->Raw)
				$this->Place1_Nombre->CurrentValue = HtmlDecode($this->Place1_Nombre->CurrentValue);
			$this->Place1_Nombre->EditValue = HtmlEncode($this->Place1_Nombre->CurrentValue);
			$this->Place1_Nombre->PlaceHolder = RemoveHtml($this->Place1_Nombre->caption());

			// Place1_Country
			$this->Place1_Country->EditAttrs["class"] = "form-control";
			$this->Place1_Country->EditCustomAttributes = "";
			if (!$this->Place1_Country->Raw)
				$this->Place1_Country->CurrentValue = HtmlDecode($this->Place1_Country->CurrentValue);
			$this->Place1_Country->EditValue = HtmlEncode($this->Place1_Country->CurrentValue);
			$this->Place1_Country->PlaceHolder = RemoveHtml($this->Place1_Country->caption());

			// Place1_UF
			$this->Place1_UF->EditAttrs["class"] = "form-control";
			$this->Place1_UF->EditCustomAttributes = "";
			if (!$this->Place1_UF->Raw)
				$this->Place1_UF->CurrentValue = HtmlDecode($this->Place1_UF->CurrentValue);
			$this->Place1_UF->EditValue = HtmlEncode($this->Place1_UF->CurrentValue);
			$this->Place1_UF->PlaceHolder = RemoveHtml($this->Place1_UF->caption());

			// Plate1_Lat
			$this->Plate1_Lat->EditAttrs["class"] = "form-control";
			$this->Plate1_Lat->EditCustomAttributes = "";
			$this->Plate1_Lat->EditValue = HtmlEncode($this->Plate1_Lat->CurrentValue);
			$this->Plate1_Lat->PlaceHolder = RemoveHtml($this->Plate1_Lat->caption());
			if (strval($this->Plate1_Lat->EditValue) != "" && is_numeric($this->Plate1_Lat->EditValue))
				$this->Plate1_Lat->EditValue = FormatNumber($this->Plate1_Lat->EditValue, -2, -2, -2, -2);
			

			// Place1_Lon
			$this->Place1_Lon->EditAttrs["class"] = "form-control";
			$this->Place1_Lon->EditCustomAttributes = "";
			$this->Place1_Lon->EditValue = HtmlEncode($this->Place1_Lon->CurrentValue);
			$this->Place1_Lon->PlaceHolder = RemoveHtml($this->Place1_Lon->caption());
			if (strval($this->Place1_Lon->EditValue) != "" && is_numeric($this->Place1_Lon->EditValue))
				$this->Place1_Lon->EditValue = FormatNumber($this->Place1_Lon->EditValue, -2, -2, -2, -2);
			

			// Place1_Calle
			$this->Place1_Calle->EditAttrs["class"] = "form-control";
			$this->Place1_Calle->EditCustomAttributes = "";
			if (!$this->Place1_Calle->Raw)
				$this->Place1_Calle->CurrentValue = HtmlDecode($this->Place1_Calle->CurrentValue);
			$this->Place1_Calle->EditValue = HtmlEncode($this->Place1_Calle->CurrentValue);
			$this->Place1_Calle->PlaceHolder = RemoveHtml($this->Place1_Calle->caption());

			// Place1_Numero
			$this->Place1_Numero->EditAttrs["class"] = "form-control";
			$this->Place1_Numero->EditCustomAttributes = "";
			if (!$this->Place1_Numero->Raw)
				$this->Place1_Numero->CurrentValue = HtmlDecode($this->Place1_Numero->CurrentValue);
			$this->Place1_Numero->EditValue = HtmlEncode($this->Place1_Numero->CurrentValue);
			$this->Place1_Numero->PlaceHolder = RemoveHtml($this->Place1_Numero->caption());

			// Place1_Localidad
			$this->Place1_Localidad->EditAttrs["class"] = "form-control";
			$this->Place1_Localidad->EditCustomAttributes = "";
			if (!$this->Place1_Localidad->Raw)
				$this->Place1_Localidad->CurrentValue = HtmlDecode($this->Place1_Localidad->CurrentValue);
			$this->Place1_Localidad->EditValue = HtmlEncode($this->Place1_Localidad->CurrentValue);
			$this->Place1_Localidad->PlaceHolder = RemoveHtml($this->Place1_Localidad->caption());

			// Place1_Piso
			$this->Place1_Piso->EditAttrs["class"] = "form-control";
			$this->Place1_Piso->EditCustomAttributes = "";
			if (!$this->Place1_Piso->Raw)
				$this->Place1_Piso->CurrentValue = HtmlDecode($this->Place1_Piso->CurrentValue);
			$this->Place1_Piso->EditValue = HtmlEncode($this->Place1_Piso->CurrentValue);
			$this->Place1_Piso->PlaceHolder = RemoveHtml($this->Place1_Piso->caption());

			// Place1_Depto
			$this->Place1_Depto->EditAttrs["class"] = "form-control";
			$this->Place1_Depto->EditCustomAttributes = "";
			if (!$this->Place1_Depto->Raw)
				$this->Place1_Depto->CurrentValue = HtmlDecode($this->Place1_Depto->CurrentValue);
			$this->Place1_Depto->EditValue = HtmlEncode($this->Place1_Depto->CurrentValue);
			$this->Place1_Depto->PlaceHolder = RemoveHtml($this->Place1_Depto->caption());

			// Place1_PersonaRecibe
			$this->Place1_PersonaRecibe->EditAttrs["class"] = "form-control";
			$this->Place1_PersonaRecibe->EditCustomAttributes = "";
			if (!$this->Place1_PersonaRecibe->Raw)
				$this->Place1_PersonaRecibe->CurrentValue = HtmlDecode($this->Place1_PersonaRecibe->CurrentValue);
			$this->Place1_PersonaRecibe->EditValue = HtmlEncode($this->Place1_PersonaRecibe->CurrentValue);
			$this->Place1_PersonaRecibe->PlaceHolder = RemoveHtml($this->Place1_PersonaRecibe->caption());

			// Place1_PersonaRecibeTelefono
			$this->Place1_PersonaRecibeTelefono->EditAttrs["class"] = "form-control";
			$this->Place1_PersonaRecibeTelefono->EditCustomAttributes = "";
			if (!$this->Place1_PersonaRecibeTelefono->Raw)
				$this->Place1_PersonaRecibeTelefono->CurrentValue = HtmlDecode($this->Place1_PersonaRecibeTelefono->CurrentValue);
			$this->Place1_PersonaRecibeTelefono->EditValue = HtmlEncode($this->Place1_PersonaRecibeTelefono->CurrentValue);
			$this->Place1_PersonaRecibeTelefono->PlaceHolder = RemoveHtml($this->Place1_PersonaRecibeTelefono->caption());

			// Place2_Nombre
			$this->Place2_Nombre->EditAttrs["class"] = "form-control";
			$this->Place2_Nombre->EditCustomAttributes = "";
			if (!$this->Place2_Nombre->Raw)
				$this->Place2_Nombre->CurrentValue = HtmlDecode($this->Place2_Nombre->CurrentValue);
			$this->Place2_Nombre->EditValue = HtmlEncode($this->Place2_Nombre->CurrentValue);
			$this->Place2_Nombre->PlaceHolder = RemoveHtml($this->Place2_Nombre->caption());

			// Place2_Country
			$this->Place2_Country->EditAttrs["class"] = "form-control";
			$this->Place2_Country->EditCustomAttributes = "";
			if (!$this->Place2_Country->Raw)
				$this->Place2_Country->CurrentValue = HtmlDecode($this->Place2_Country->CurrentValue);
			$this->Place2_Country->EditValue = HtmlEncode($this->Place2_Country->CurrentValue);
			$this->Place2_Country->PlaceHolder = RemoveHtml($this->Place2_Country->caption());

			// Place2_UF
			$this->Place2_UF->EditAttrs["class"] = "form-control";
			$this->Place2_UF->EditCustomAttributes = "";
			if (!$this->Place2_UF->Raw)
				$this->Place2_UF->CurrentValue = HtmlDecode($this->Place2_UF->CurrentValue);
			$this->Place2_UF->EditValue = HtmlEncode($this->Place2_UF->CurrentValue);
			$this->Place2_UF->PlaceHolder = RemoveHtml($this->Place2_UF->caption());

			// Place2_Lat
			$this->Place2_Lat->EditAttrs["class"] = "form-control";
			$this->Place2_Lat->EditCustomAttributes = "";
			$this->Place2_Lat->EditValue = HtmlEncode($this->Place2_Lat->CurrentValue);
			$this->Place2_Lat->PlaceHolder = RemoveHtml($this->Place2_Lat->caption());
			if (strval($this->Place2_Lat->EditValue) != "" && is_numeric($this->Place2_Lat->EditValue))
				$this->Place2_Lat->EditValue = FormatNumber($this->Place2_Lat->EditValue, -2, -2, -2, -2);
			

			// Place2_Lon
			$this->Place2_Lon->EditAttrs["class"] = "form-control";
			$this->Place2_Lon->EditCustomAttributes = "";
			$this->Place2_Lon->EditValue = HtmlEncode($this->Place2_Lon->CurrentValue);
			$this->Place2_Lon->PlaceHolder = RemoveHtml($this->Place2_Lon->caption());
			if (strval($this->Place2_Lon->EditValue) != "" && is_numeric($this->Place2_Lon->EditValue))
				$this->Place2_Lon->EditValue = FormatNumber($this->Place2_Lon->EditValue, -2, -2, -2, -2);
			

			// Place2_Calle
			$this->Place2_Calle->EditAttrs["class"] = "form-control";
			$this->Place2_Calle->EditCustomAttributes = "";
			if (!$this->Place2_Calle->Raw)
				$this->Place2_Calle->CurrentValue = HtmlDecode($this->Place2_Calle->CurrentValue);
			$this->Place2_Calle->EditValue = HtmlEncode($this->Place2_Calle->CurrentValue);
			$this->Place2_Calle->PlaceHolder = RemoveHtml($this->Place2_Calle->caption());

			// Place2_Numero
			$this->Place2_Numero->EditAttrs["class"] = "form-control";
			$this->Place2_Numero->EditCustomAttributes = "";
			if (!$this->Place2_Numero->Raw)
				$this->Place2_Numero->CurrentValue = HtmlDecode($this->Place2_Numero->CurrentValue);
			$this->Place2_Numero->EditValue = HtmlEncode($this->Place2_Numero->CurrentValue);
			$this->Place2_Numero->PlaceHolder = RemoveHtml($this->Place2_Numero->caption());

			// Place2_Localidad
			$this->Place2_Localidad->EditAttrs["class"] = "form-control";
			$this->Place2_Localidad->EditCustomAttributes = "";
			if (!$this->Place2_Localidad->Raw)
				$this->Place2_Localidad->CurrentValue = HtmlDecode($this->Place2_Localidad->CurrentValue);
			$this->Place2_Localidad->EditValue = HtmlEncode($this->Place2_Localidad->CurrentValue);
			$this->Place2_Localidad->PlaceHolder = RemoveHtml($this->Place2_Localidad->caption());

			// Place2_Piso
			$this->Place2_Piso->EditAttrs["class"] = "form-control";
			$this->Place2_Piso->EditCustomAttributes = "";
			if (!$this->Place2_Piso->Raw)
				$this->Place2_Piso->CurrentValue = HtmlDecode($this->Place2_Piso->CurrentValue);
			$this->Place2_Piso->EditValue = HtmlEncode($this->Place2_Piso->CurrentValue);
			$this->Place2_Piso->PlaceHolder = RemoveHtml($this->Place2_Piso->caption());

			// Place2_Depto
			$this->Place2_Depto->EditAttrs["class"] = "form-control";
			$this->Place2_Depto->EditCustomAttributes = "";
			if (!$this->Place2_Depto->Raw)
				$this->Place2_Depto->CurrentValue = HtmlDecode($this->Place2_Depto->CurrentValue);
			$this->Place2_Depto->EditValue = HtmlEncode($this->Place2_Depto->CurrentValue);
			$this->Place2_Depto->PlaceHolder = RemoveHtml($this->Place2_Depto->caption());

			// Place2_PersonaRecibe
			$this->Place2_PersonaRecibe->EditAttrs["class"] = "form-control";
			$this->Place2_PersonaRecibe->EditCustomAttributes = "";
			if (!$this->Place2_PersonaRecibe->Raw)
				$this->Place2_PersonaRecibe->CurrentValue = HtmlDecode($this->Place2_PersonaRecibe->CurrentValue);
			$this->Place2_PersonaRecibe->EditValue = HtmlEncode($this->Place2_PersonaRecibe->CurrentValue);
			$this->Place2_PersonaRecibe->PlaceHolder = RemoveHtml($this->Place2_PersonaRecibe->caption());

			// Place2_PersonaRecibeTelefono
			$this->Place2_PersonaRecibeTelefono->EditAttrs["class"] = "form-control";
			$this->Place2_PersonaRecibeTelefono->EditCustomAttributes = "";
			if (!$this->Place2_PersonaRecibeTelefono->Raw)
				$this->Place2_PersonaRecibeTelefono->CurrentValue = HtmlDecode($this->Place2_PersonaRecibeTelefono->CurrentValue);
			$this->Place2_PersonaRecibeTelefono->EditValue = HtmlEncode($this->Place2_PersonaRecibeTelefono->CurrentValue);
			$this->Place2_PersonaRecibeTelefono->PlaceHolder = RemoveHtml($this->Place2_PersonaRecibeTelefono->caption());

			// ID_Cadeteria
			$this->ID_Cadeteria->EditAttrs["class"] = "form-control";
			$this->ID_Cadeteria->EditCustomAttributes = "";
			if (!$Security->isAdmin() && $Security->isLoggedIn() && !$this->userIDAllow("edit")) { // Non system admin
				$this->ID_Cadeteria->CurrentValue = CurrentUserID();
				$this->ID_Cadeteria->EditValue = $this->ID_Cadeteria->CurrentValue;
				$this->ID_Cadeteria->EditValue = FormatNumber($this->ID_Cadeteria->EditValue, 0, -2, -2, -2);
				$this->ID_Cadeteria->ViewCustomAttributes = "";
			} else {
				$this->ID_Cadeteria->EditValue = HtmlEncode($this->ID_Cadeteria->CurrentValue);
				$this->ID_Cadeteria->PlaceHolder = RemoveHtml($this->ID_Cadeteria->caption());
			}

			// Edit refer script
			// ID

			$this->ID->LinkCustomAttributes = "";
			$this->ID->HrefValue = "";

			// ID_Usuario
			$this->ID_Usuario->LinkCustomAttributes = "";
			$this->ID_Usuario->HrefValue = "";

			// ID_Place1
			$this->ID_Place1->LinkCustomAttributes = "";
			$this->ID_Place1->HrefValue = "";

			// ID_Place2
			$this->ID_Place2->LinkCustomAttributes = "";
			$this->ID_Place2->HrefValue = "";

			// ID_Cadete
			$this->ID_Cadete->LinkCustomAttributes = "";
			$this->ID_Cadete->HrefValue = "";

			// ID_Status
			$this->ID_Status->LinkCustomAttributes = "";
			$this->ID_Status->HrefValue = "";

			// InstruccionesPlace1
			$this->InstruccionesPlace1->LinkCustomAttributes = "";
			$this->InstruccionesPlace1->HrefValue = "";

			// InstruccionesPlace2
			$this->InstruccionesPlace2->LinkCustomAttributes = "";
			$this->InstruccionesPlace2->HrefValue = "";

			// Direccionalidad
			$this->Direccionalidad->LinkCustomAttributes = "";
			$this->Direccionalidad->HrefValue = "";

			// RemitoURL
			$this->RemitoURL->LinkCustomAttributes = "";
			$this->RemitoURL->HrefValue = "";

			// Place1_Nombre
			$this->Place1_Nombre->LinkCustomAttributes = "";
			$this->Place1_Nombre->HrefValue = "";

			// Place1_Country
			$this->Place1_Country->LinkCustomAttributes = "";
			$this->Place1_Country->HrefValue = "";

			// Place1_UF
			$this->Place1_UF->LinkCustomAttributes = "";
			$this->Place1_UF->HrefValue = "";

			// Plate1_Lat
			$this->Plate1_Lat->LinkCustomAttributes = "";
			$this->Plate1_Lat->HrefValue = "";

			// Place1_Lon
			$this->Place1_Lon->LinkCustomAttributes = "";
			$this->Place1_Lon->HrefValue = "";

			// Place1_Calle
			$this->Place1_Calle->LinkCustomAttributes = "";
			$this->Place1_Calle->HrefValue = "";

			// Place1_Numero
			$this->Place1_Numero->LinkCustomAttributes = "";
			$this->Place1_Numero->HrefValue = "";

			// Place1_Localidad
			$this->Place1_Localidad->LinkCustomAttributes = "";
			$this->Place1_Localidad->HrefValue = "";

			// Place1_Piso
			$this->Place1_Piso->LinkCustomAttributes = "";
			$this->Place1_Piso->HrefValue = "";

			// Place1_Depto
			$this->Place1_Depto->LinkCustomAttributes = "";
			$this->Place1_Depto->HrefValue = "";

			// Place1_PersonaRecibe
			$this->Place1_PersonaRecibe->LinkCustomAttributes = "";
			$this->Place1_PersonaRecibe->HrefValue = "";

			// Place1_PersonaRecibeTelefono
			$this->Place1_PersonaRecibeTelefono->LinkCustomAttributes = "";
			$this->Place1_PersonaRecibeTelefono->HrefValue = "";

			// Place2_Nombre
			$this->Place2_Nombre->LinkCustomAttributes = "";
			$this->Place2_Nombre->HrefValue = "";

			// Place2_Country
			$this->Place2_Country->LinkCustomAttributes = "";
			$this->Place2_Country->HrefValue = "";

			// Place2_UF
			$this->Place2_UF->LinkCustomAttributes = "";
			$this->Place2_UF->HrefValue = "";

			// Place2_Lat
			$this->Place2_Lat->LinkCustomAttributes = "";
			$this->Place2_Lat->HrefValue = "";

			// Place2_Lon
			$this->Place2_Lon->LinkCustomAttributes = "";
			$this->Place2_Lon->HrefValue = "";

			// Place2_Calle
			$this->Place2_Calle->LinkCustomAttributes = "";
			$this->Place2_Calle->HrefValue = "";

			// Place2_Numero
			$this->Place2_Numero->LinkCustomAttributes = "";
			$this->Place2_Numero->HrefValue = "";

			// Place2_Localidad
			$this->Place2_Localidad->LinkCustomAttributes = "";
			$this->Place2_Localidad->HrefValue = "";

			// Place2_Piso
			$this->Place2_Piso->LinkCustomAttributes = "";
			$this->Place2_Piso->HrefValue = "";

			// Place2_Depto
			$this->Place2_Depto->LinkCustomAttributes = "";
			$this->Place2_Depto->HrefValue = "";

			// Place2_PersonaRecibe
			$this->Place2_PersonaRecibe->LinkCustomAttributes = "";
			$this->Place2_PersonaRecibe->HrefValue = "";

			// Place2_PersonaRecibeTelefono
			$this->Place2_PersonaRecibeTelefono->LinkCustomAttributes = "";
			$this->Place2_PersonaRecibeTelefono->HrefValue = "";

			// ID_Cadeteria
			$this->ID_Cadeteria->LinkCustomAttributes = "";
			$this->ID_Cadeteria->HrefValue = "";
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
		if (!CheckInteger($this->ID->FormValue)) {
			AddMessage($FormError, $this->ID->errorMessage());
		}
		if ($this->ID_Usuario->Required) {
			if (!$this->ID_Usuario->IsDetailKey && $this->ID_Usuario->FormValue != NULL && $this->ID_Usuario->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ID_Usuario->caption(), $this->ID_Usuario->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->ID_Usuario->FormValue)) {
			AddMessage($FormError, $this->ID_Usuario->errorMessage());
		}
		if ($this->ID_Place1->Required) {
			if (!$this->ID_Place1->IsDetailKey && $this->ID_Place1->FormValue != NULL && $this->ID_Place1->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ID_Place1->caption(), $this->ID_Place1->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->ID_Place1->FormValue)) {
			AddMessage($FormError, $this->ID_Place1->errorMessage());
		}
		if ($this->ID_Place2->Required) {
			if (!$this->ID_Place2->IsDetailKey && $this->ID_Place2->FormValue != NULL && $this->ID_Place2->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ID_Place2->caption(), $this->ID_Place2->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->ID_Place2->FormValue)) {
			AddMessage($FormError, $this->ID_Place2->errorMessage());
		}
		if ($this->ID_Cadete->Required) {
			if (!$this->ID_Cadete->IsDetailKey && $this->ID_Cadete->FormValue != NULL && $this->ID_Cadete->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ID_Cadete->caption(), $this->ID_Cadete->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->ID_Cadete->FormValue)) {
			AddMessage($FormError, $this->ID_Cadete->errorMessage());
		}
		if ($this->ID_Status->Required) {
			if (!$this->ID_Status->IsDetailKey && $this->ID_Status->FormValue != NULL && $this->ID_Status->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ID_Status->caption(), $this->ID_Status->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->ID_Status->FormValue)) {
			AddMessage($FormError, $this->ID_Status->errorMessage());
		}
		if ($this->InstruccionesPlace1->Required) {
			if (!$this->InstruccionesPlace1->IsDetailKey && $this->InstruccionesPlace1->FormValue != NULL && $this->InstruccionesPlace1->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->InstruccionesPlace1->caption(), $this->InstruccionesPlace1->RequiredErrorMessage));
			}
		}
		if ($this->InstruccionesPlace2->Required) {
			if (!$this->InstruccionesPlace2->IsDetailKey && $this->InstruccionesPlace2->FormValue != NULL && $this->InstruccionesPlace2->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->InstruccionesPlace2->caption(), $this->InstruccionesPlace2->RequiredErrorMessage));
			}
		}
		if ($this->Direccionalidad->Required) {
			if (!$this->Direccionalidad->IsDetailKey && $this->Direccionalidad->FormValue != NULL && $this->Direccionalidad->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Direccionalidad->caption(), $this->Direccionalidad->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->Direccionalidad->FormValue)) {
			AddMessage($FormError, $this->Direccionalidad->errorMessage());
		}
		if ($this->RemitoURL->Required) {
			if (!$this->RemitoURL->IsDetailKey && $this->RemitoURL->FormValue != NULL && $this->RemitoURL->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->RemitoURL->caption(), $this->RemitoURL->RequiredErrorMessage));
			}
		}
		if ($this->Place1_Nombre->Required) {
			if (!$this->Place1_Nombre->IsDetailKey && $this->Place1_Nombre->FormValue != NULL && $this->Place1_Nombre->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Place1_Nombre->caption(), $this->Place1_Nombre->RequiredErrorMessage));
			}
		}
		if ($this->Place1_Country->Required) {
			if (!$this->Place1_Country->IsDetailKey && $this->Place1_Country->FormValue != NULL && $this->Place1_Country->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Place1_Country->caption(), $this->Place1_Country->RequiredErrorMessage));
			}
		}
		if ($this->Place1_UF->Required) {
			if (!$this->Place1_UF->IsDetailKey && $this->Place1_UF->FormValue != NULL && $this->Place1_UF->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Place1_UF->caption(), $this->Place1_UF->RequiredErrorMessage));
			}
		}
		if ($this->Plate1_Lat->Required) {
			if (!$this->Plate1_Lat->IsDetailKey && $this->Plate1_Lat->FormValue != NULL && $this->Plate1_Lat->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Plate1_Lat->caption(), $this->Plate1_Lat->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->Plate1_Lat->FormValue)) {
			AddMessage($FormError, $this->Plate1_Lat->errorMessage());
		}
		if ($this->Place1_Lon->Required) {
			if (!$this->Place1_Lon->IsDetailKey && $this->Place1_Lon->FormValue != NULL && $this->Place1_Lon->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Place1_Lon->caption(), $this->Place1_Lon->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->Place1_Lon->FormValue)) {
			AddMessage($FormError, $this->Place1_Lon->errorMessage());
		}
		if ($this->Place1_Calle->Required) {
			if (!$this->Place1_Calle->IsDetailKey && $this->Place1_Calle->FormValue != NULL && $this->Place1_Calle->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Place1_Calle->caption(), $this->Place1_Calle->RequiredErrorMessage));
			}
		}
		if ($this->Place1_Numero->Required) {
			if (!$this->Place1_Numero->IsDetailKey && $this->Place1_Numero->FormValue != NULL && $this->Place1_Numero->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Place1_Numero->caption(), $this->Place1_Numero->RequiredErrorMessage));
			}
		}
		if ($this->Place1_Localidad->Required) {
			if (!$this->Place1_Localidad->IsDetailKey && $this->Place1_Localidad->FormValue != NULL && $this->Place1_Localidad->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Place1_Localidad->caption(), $this->Place1_Localidad->RequiredErrorMessage));
			}
		}
		if ($this->Place1_Piso->Required) {
			if (!$this->Place1_Piso->IsDetailKey && $this->Place1_Piso->FormValue != NULL && $this->Place1_Piso->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Place1_Piso->caption(), $this->Place1_Piso->RequiredErrorMessage));
			}
		}
		if ($this->Place1_Depto->Required) {
			if (!$this->Place1_Depto->IsDetailKey && $this->Place1_Depto->FormValue != NULL && $this->Place1_Depto->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Place1_Depto->caption(), $this->Place1_Depto->RequiredErrorMessage));
			}
		}
		if ($this->Place1_PersonaRecibe->Required) {
			if (!$this->Place1_PersonaRecibe->IsDetailKey && $this->Place1_PersonaRecibe->FormValue != NULL && $this->Place1_PersonaRecibe->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Place1_PersonaRecibe->caption(), $this->Place1_PersonaRecibe->RequiredErrorMessage));
			}
		}
		if ($this->Place1_PersonaRecibeTelefono->Required) {
			if (!$this->Place1_PersonaRecibeTelefono->IsDetailKey && $this->Place1_PersonaRecibeTelefono->FormValue != NULL && $this->Place1_PersonaRecibeTelefono->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Place1_PersonaRecibeTelefono->caption(), $this->Place1_PersonaRecibeTelefono->RequiredErrorMessage));
			}
		}
		if ($this->Place2_Nombre->Required) {
			if (!$this->Place2_Nombre->IsDetailKey && $this->Place2_Nombre->FormValue != NULL && $this->Place2_Nombre->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Place2_Nombre->caption(), $this->Place2_Nombre->RequiredErrorMessage));
			}
		}
		if ($this->Place2_Country->Required) {
			if (!$this->Place2_Country->IsDetailKey && $this->Place2_Country->FormValue != NULL && $this->Place2_Country->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Place2_Country->caption(), $this->Place2_Country->RequiredErrorMessage));
			}
		}
		if ($this->Place2_UF->Required) {
			if (!$this->Place2_UF->IsDetailKey && $this->Place2_UF->FormValue != NULL && $this->Place2_UF->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Place2_UF->caption(), $this->Place2_UF->RequiredErrorMessage));
			}
		}
		if ($this->Place2_Lat->Required) {
			if (!$this->Place2_Lat->IsDetailKey && $this->Place2_Lat->FormValue != NULL && $this->Place2_Lat->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Place2_Lat->caption(), $this->Place2_Lat->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->Place2_Lat->FormValue)) {
			AddMessage($FormError, $this->Place2_Lat->errorMessage());
		}
		if ($this->Place2_Lon->Required) {
			if (!$this->Place2_Lon->IsDetailKey && $this->Place2_Lon->FormValue != NULL && $this->Place2_Lon->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Place2_Lon->caption(), $this->Place2_Lon->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->Place2_Lon->FormValue)) {
			AddMessage($FormError, $this->Place2_Lon->errorMessage());
		}
		if ($this->Place2_Calle->Required) {
			if (!$this->Place2_Calle->IsDetailKey && $this->Place2_Calle->FormValue != NULL && $this->Place2_Calle->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Place2_Calle->caption(), $this->Place2_Calle->RequiredErrorMessage));
			}
		}
		if ($this->Place2_Numero->Required) {
			if (!$this->Place2_Numero->IsDetailKey && $this->Place2_Numero->FormValue != NULL && $this->Place2_Numero->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Place2_Numero->caption(), $this->Place2_Numero->RequiredErrorMessage));
			}
		}
		if ($this->Place2_Localidad->Required) {
			if (!$this->Place2_Localidad->IsDetailKey && $this->Place2_Localidad->FormValue != NULL && $this->Place2_Localidad->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Place2_Localidad->caption(), $this->Place2_Localidad->RequiredErrorMessage));
			}
		}
		if ($this->Place2_Piso->Required) {
			if (!$this->Place2_Piso->IsDetailKey && $this->Place2_Piso->FormValue != NULL && $this->Place2_Piso->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Place2_Piso->caption(), $this->Place2_Piso->RequiredErrorMessage));
			}
		}
		if ($this->Place2_Depto->Required) {
			if (!$this->Place2_Depto->IsDetailKey && $this->Place2_Depto->FormValue != NULL && $this->Place2_Depto->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Place2_Depto->caption(), $this->Place2_Depto->RequiredErrorMessage));
			}
		}
		if ($this->Place2_PersonaRecibe->Required) {
			if (!$this->Place2_PersonaRecibe->IsDetailKey && $this->Place2_PersonaRecibe->FormValue != NULL && $this->Place2_PersonaRecibe->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Place2_PersonaRecibe->caption(), $this->Place2_PersonaRecibe->RequiredErrorMessage));
			}
		}
		if ($this->Place2_PersonaRecibeTelefono->Required) {
			if (!$this->Place2_PersonaRecibeTelefono->IsDetailKey && $this->Place2_PersonaRecibeTelefono->FormValue != NULL && $this->Place2_PersonaRecibeTelefono->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Place2_PersonaRecibeTelefono->caption(), $this->Place2_PersonaRecibeTelefono->RequiredErrorMessage));
			}
		}
		if ($this->ID_Cadeteria->Required) {
			if (!$this->ID_Cadeteria->IsDetailKey && $this->ID_Cadeteria->FormValue != NULL && $this->ID_Cadeteria->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ID_Cadeteria->caption(), $this->ID_Cadeteria->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->ID_Cadeteria->FormValue)) {
			AddMessage($FormError, $this->ID_Cadeteria->errorMessage());
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

			// ID
			$this->ID->setDbValueDef($rsnew, $this->ID->CurrentValue, 0, $this->ID->ReadOnly);

			// ID_Usuario
			$this->ID_Usuario->setDbValueDef($rsnew, $this->ID_Usuario->CurrentValue, NULL, $this->ID_Usuario->ReadOnly);

			// ID_Place1
			$this->ID_Place1->setDbValueDef($rsnew, $this->ID_Place1->CurrentValue, NULL, $this->ID_Place1->ReadOnly);

			// ID_Place2
			$this->ID_Place2->setDbValueDef($rsnew, $this->ID_Place2->CurrentValue, NULL, $this->ID_Place2->ReadOnly);

			// ID_Cadete
			$this->ID_Cadete->setDbValueDef($rsnew, $this->ID_Cadete->CurrentValue, NULL, $this->ID_Cadete->ReadOnly);

			// ID_Status
			$this->ID_Status->setDbValueDef($rsnew, $this->ID_Status->CurrentValue, NULL, $this->ID_Status->ReadOnly);

			// InstruccionesPlace1
			$this->InstruccionesPlace1->setDbValueDef($rsnew, $this->InstruccionesPlace1->CurrentValue, NULL, $this->InstruccionesPlace1->ReadOnly);

			// InstruccionesPlace2
			$this->InstruccionesPlace2->setDbValueDef($rsnew, $this->InstruccionesPlace2->CurrentValue, NULL, $this->InstruccionesPlace2->ReadOnly);

			// Direccionalidad
			$this->Direccionalidad->setDbValueDef($rsnew, $this->Direccionalidad->CurrentValue, NULL, $this->Direccionalidad->ReadOnly);

			// RemitoURL
			$this->RemitoURL->setDbValueDef($rsnew, $this->RemitoURL->CurrentValue, NULL, $this->RemitoURL->ReadOnly);

			// Place1_Nombre
			$this->Place1_Nombre->setDbValueDef($rsnew, $this->Place1_Nombre->CurrentValue, NULL, $this->Place1_Nombre->ReadOnly);

			// Place1_Country
			$this->Place1_Country->setDbValueDef($rsnew, $this->Place1_Country->CurrentValue, NULL, $this->Place1_Country->ReadOnly);

			// Place1_UF
			$this->Place1_UF->setDbValueDef($rsnew, $this->Place1_UF->CurrentValue, NULL, $this->Place1_UF->ReadOnly);

			// Plate1_Lat
			$this->Plate1_Lat->setDbValueDef($rsnew, $this->Plate1_Lat->CurrentValue, NULL, $this->Plate1_Lat->ReadOnly);

			// Place1_Lon
			$this->Place1_Lon->setDbValueDef($rsnew, $this->Place1_Lon->CurrentValue, NULL, $this->Place1_Lon->ReadOnly);

			// Place1_Calle
			$this->Place1_Calle->setDbValueDef($rsnew, $this->Place1_Calle->CurrentValue, NULL, $this->Place1_Calle->ReadOnly);

			// Place1_Numero
			$this->Place1_Numero->setDbValueDef($rsnew, $this->Place1_Numero->CurrentValue, NULL, $this->Place1_Numero->ReadOnly);

			// Place1_Localidad
			$this->Place1_Localidad->setDbValueDef($rsnew, $this->Place1_Localidad->CurrentValue, NULL, $this->Place1_Localidad->ReadOnly);

			// Place1_Piso
			$this->Place1_Piso->setDbValueDef($rsnew, $this->Place1_Piso->CurrentValue, NULL, $this->Place1_Piso->ReadOnly);

			// Place1_Depto
			$this->Place1_Depto->setDbValueDef($rsnew, $this->Place1_Depto->CurrentValue, NULL, $this->Place1_Depto->ReadOnly);

			// Place1_PersonaRecibe
			$this->Place1_PersonaRecibe->setDbValueDef($rsnew, $this->Place1_PersonaRecibe->CurrentValue, NULL, $this->Place1_PersonaRecibe->ReadOnly);

			// Place1_PersonaRecibeTelefono
			$this->Place1_PersonaRecibeTelefono->setDbValueDef($rsnew, $this->Place1_PersonaRecibeTelefono->CurrentValue, NULL, $this->Place1_PersonaRecibeTelefono->ReadOnly);

			// Place2_Nombre
			$this->Place2_Nombre->setDbValueDef($rsnew, $this->Place2_Nombre->CurrentValue, NULL, $this->Place2_Nombre->ReadOnly);

			// Place2_Country
			$this->Place2_Country->setDbValueDef($rsnew, $this->Place2_Country->CurrentValue, NULL, $this->Place2_Country->ReadOnly);

			// Place2_UF
			$this->Place2_UF->setDbValueDef($rsnew, $this->Place2_UF->CurrentValue, NULL, $this->Place2_UF->ReadOnly);

			// Place2_Lat
			$this->Place2_Lat->setDbValueDef($rsnew, $this->Place2_Lat->CurrentValue, NULL, $this->Place2_Lat->ReadOnly);

			// Place2_Lon
			$this->Place2_Lon->setDbValueDef($rsnew, $this->Place2_Lon->CurrentValue, NULL, $this->Place2_Lon->ReadOnly);

			// Place2_Calle
			$this->Place2_Calle->setDbValueDef($rsnew, $this->Place2_Calle->CurrentValue, NULL, $this->Place2_Calle->ReadOnly);

			// Place2_Numero
			$this->Place2_Numero->setDbValueDef($rsnew, $this->Place2_Numero->CurrentValue, NULL, $this->Place2_Numero->ReadOnly);

			// Place2_Localidad
			$this->Place2_Localidad->setDbValueDef($rsnew, $this->Place2_Localidad->CurrentValue, NULL, $this->Place2_Localidad->ReadOnly);

			// Place2_Piso
			$this->Place2_Piso->setDbValueDef($rsnew, $this->Place2_Piso->CurrentValue, NULL, $this->Place2_Piso->ReadOnly);

			// Place2_Depto
			$this->Place2_Depto->setDbValueDef($rsnew, $this->Place2_Depto->CurrentValue, NULL, $this->Place2_Depto->ReadOnly);

			// Place2_PersonaRecibe
			$this->Place2_PersonaRecibe->setDbValueDef($rsnew, $this->Place2_PersonaRecibe->CurrentValue, NULL, $this->Place2_PersonaRecibe->ReadOnly);

			// Place2_PersonaRecibeTelefono
			$this->Place2_PersonaRecibeTelefono->setDbValueDef($rsnew, $this->Place2_PersonaRecibeTelefono->CurrentValue, NULL, $this->Place2_PersonaRecibeTelefono->ReadOnly);

			// ID_Cadeteria
			$this->ID_Cadeteria->setDbValueDef($rsnew, $this->ID_Cadeteria->CurrentValue, NULL, $this->ID_Cadeteria->ReadOnly);

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