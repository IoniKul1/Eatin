<?php
namespace PHPMaker2020\BACKOFFICE_CADETERIAS;

/**
 * Page class
 */
class PedidoACadeteria_delete extends PedidoACadeteria
{

	// Page ID
	public $PageID = "delete";

	// Project ID
	public $ProjectID = "{68D35137-1670-419B-B841-52FFD5E14A4B}";

	// Table name
	public $TableName = 'PedidoACadeteria';

	// Page object name
	public $PageObjName = "PedidoACadeteria_delete";

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
			define(PROJECT_NAMESPACE . "PAGE_ID", 'delete');

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
	public $DbMasterFilter = "";
	public $DbDetailFilter = "";
	public $StartRecord;
	public $TotalRecords = 0;
	public $RecordCount;
	public $RecKeys = [];
	public $StartRowCount = 1;
	public $RowCount = 0;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm;

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
			if (!$Security->canDelete()) {
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
			if (!$Security->canDelete()) {
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

		if (!$Security->canDelete()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("PedidoACadeterialist.php");
			return;
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Load key parameters
		$this->RecKeys = $this->getRecordKeys(); // Load record keys
		$filter = $this->getFilterFromRecordKeys();
		if ($filter == "") {
			$this->terminate("PedidoACadeterialist.php"); // Prevent SQL injection, return to list
			return;
		}

		// Set up filter (WHERE Clause)
		$this->CurrentFilter = $filter;

		// Check if valid User ID
		$conn = $this->getConnection();
		$sql = $this->getSql($this->CurrentFilter);
		if ($rs = LoadRecordset($sql, $conn)) {
			$res = TRUE;
			while (!$rs->EOF) {
				$this->loadRowValues($rs);
				if (!$this->showOptionLink('delete')) {
					$userIdMsg = $Language->phrase("NoDeletePermission");
					$this->setFailureMessage($userIdMsg);
					$res = FALSE;
					break;
				}
				$rs->moveNext();
			}
			$rs->close();
			if (!$res) {
				$this->terminate("PedidoACadeterialist.php"); // Return to list
				return;
			}
		}

		// Get action
		if (IsApi()) {
			$this->CurrentAction = "delete"; // Delete record directly
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action");
		} elseif (Get("action") == "1") {
			$this->CurrentAction = "delete"; // Delete record directly
		} else {
			$this->CurrentAction = "show"; // Display record
		}
		if ($this->isDelete()) {
			$this->SendEmail = TRUE; // Send email on delete success
			if ($this->deleteRows()) { // Delete rows
				if ($this->getSuccessMessage() == "")
					$this->setSuccessMessage($Language->phrase("DeleteSuccess")); // Set up success message
				if (IsApi()) {
					$this->terminate(TRUE);
					return;
				} else {
					$this->terminate($this->getReturnUrl()); // Return to caller
				}
			} else { // Delete failed
				if (IsApi()) {
					$this->terminate();
					return;
				}
				$this->CurrentAction = "show"; // Display record
			}
		}
		if ($this->isShow()) { // Load records for display
			if ($this->Recordset = $this->loadRecordset())
				$this->TotalRecords = $this->Recordset->RecordCount(); // Get record count
			if ($this->TotalRecords <= 0) { // No record found, exit
				if ($this->Recordset)
					$this->Recordset->close();
				$this->terminate("PedidoACadeterialist.php"); // Return to list
			}
		}
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
		}

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Delete records based on current filter
	protected function deleteRows()
	{
		global $Language, $Security;
		if (!$Security->canDelete()) {
			$this->setFailureMessage($Language->phrase("NoDeletePermission")); // No delete permission
			return FALSE;
		}
		$deleteRows = TRUE;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = "";
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
			$rs->close();
			return FALSE;
		}
		$rows = ($rs) ? $rs->getRows() : [];
		$conn->beginTrans();

		// Clone old rows
		$rsold = $rows;
		if ($rs)
			$rs->close();

		// Call row deleting event
		if ($deleteRows) {
			foreach ($rsold as $row) {
				$deleteRows = $this->Row_Deleting($row);
				if (!$deleteRows)
					break;
			}
		}
		if ($deleteRows) {
			$key = "";
			foreach ($rsold as $row) {
				$thisKey = "";
				if ($thisKey != "")
					$thisKey .= Config("COMPOSITE_KEY_SEPARATOR");
				$thisKey .= $row['ID'];
				if (Config("DELETE_UPLOADED_FILES")) // Delete old files
					$this->deleteUploadedFiles($row);
				$conn->raiseErrorFn = Config("ERROR_FUNC");
				$deleteRows = $this->delete($row); // Delete
				$conn->raiseErrorFn = "";
				if ($deleteRows === FALSE)
					break;
				if ($key != "")
					$key .= ", ";
				$key .= $thisKey;
			}
		}
		if (!$deleteRows) {

			// Set up error message
			if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage != "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("DeleteCancelled"));
			}
		}
		if ($deleteRows) {
			$conn->commitTrans(); // Commit the changes
		} else {
			$conn->rollbackTrans(); // Rollback changes
		}

		// Call Row Deleted event
		if ($deleteRows) {
			foreach ($rsold as $row) {
				$this->Row_Deleted($row);
			}
		}

		// Write JSON for API request (Support single row only)
		if (IsApi() && $deleteRows) {
			$row = $this->getRecordsFromRecordset($rsold, TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $deleteRows;
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
		$pageId = "delete";
		$Breadcrumb->add("delete", $pageId, $url);
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
} // End class
?>