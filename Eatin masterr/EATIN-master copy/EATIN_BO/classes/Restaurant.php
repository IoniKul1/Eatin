<?php namespace PHPMaker2020\EATIN_BO; ?>
<?php

/**
 * Table class for Restaurant
 */
class Restaurant extends DbTable
{
	protected $SqlFrom = "";
	protected $SqlSelect = "";
	protected $SqlSelectList = "";
	protected $SqlWhere = "";
	protected $SqlGroupBy = "";
	protected $SqlHaving = "";
	protected $SqlOrderBy = "";
	public $UseSessionForListSql = TRUE;

	// Column CSS classes
	public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
	public $RightColumnClass = "col-sm-10";
	public $OffsetColumnClass = "col-sm-10 offset-sm-2";
	public $TableLeftColumnClass = "w-col-2";

	// Export
	public $ExportDoc;

	// Fields
	public $ID;
	public $ID_State;
	public $DateCreation;
	public $DateLastUpdate;
	public $Nombre;
	public $Lat;
	public $Lon;
	public $GoogleGeocodeAddress;
	public $Address;
	public $Deactivated;
	public $Suspended;
	public $ActualQRGrantCode;
	public $_Email;
	public $Password;
	public $SplashImg;
	public $LogoSize1;
	public $LogoSize2;
	public $AppCSS;
	public $SplashVideo;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'Restaurant';
		$this->TableName = 'Restaurant';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "[dbo].[Restaurant]";
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// ID
		$this->ID = new DbField('Restaurant', 'Restaurant', 'x_ID', 'ID', '[ID]', 'CAST([ID] AS NVARCHAR)', 20, 8, -1, FALSE, '[ID]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->ID->IsAutoIncrement = TRUE; // Autoincrement field
		$this->ID->IsPrimaryKey = TRUE; // Primary key field
		$this->ID->IsForeignKey = TRUE; // Foreign key field
		$this->ID->Nullable = FALSE; // NOT NULL field
		$this->ID->Sortable = TRUE; // Allow sort
		$this->ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ID'] = &$this->ID;

		// ID_State
		$this->ID_State = new DbField('Restaurant', 'Restaurant', 'x_ID_State', 'ID_State', '[ID_State]', 'CAST([ID_State] AS NVARCHAR)', 20, 8, -1, FALSE, '[ID_State]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ID_State->Sortable = TRUE; // Allow sort
		$this->ID_State->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ID_State'] = &$this->ID_State;

		// DateCreation
		$this->DateCreation = new DbField('Restaurant', 'Restaurant', 'x_DateCreation', 'DateCreation', '[DateCreation]', CastDateFieldForLike("[DateCreation]", 0, "DB"), 135, 8, 0, FALSE, '[DateCreation]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DateCreation->Sortable = TRUE; // Allow sort
		$this->DateCreation->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['DateCreation'] = &$this->DateCreation;

		// DateLastUpdate
		$this->DateLastUpdate = new DbField('Restaurant', 'Restaurant', 'x_DateLastUpdate', 'DateLastUpdate', '[DateLastUpdate]', CastDateFieldForLike("[DateLastUpdate]", 0, "DB"), 135, 8, 0, FALSE, '[DateLastUpdate]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DateLastUpdate->Sortable = TRUE; // Allow sort
		$this->DateLastUpdate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['DateLastUpdate'] = &$this->DateLastUpdate;

		// Nombre
		$this->Nombre = new DbField('Restaurant', 'Restaurant', 'x_Nombre', 'Nombre', '[Nombre]', '[Nombre]', 202, 50, -1, FALSE, '[Nombre]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Nombre->Sortable = TRUE; // Allow sort
		$this->fields['Nombre'] = &$this->Nombre;

		// Lat
		$this->Lat = new DbField('Restaurant', 'Restaurant', 'x_Lat', 'Lat', '[Lat]', 'CAST([Lat] AS NVARCHAR)', 5, 8, -1, FALSE, '[Lat]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Lat->Sortable = TRUE; // Allow sort
		$this->Lat->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Lat'] = &$this->Lat;

		// Lon
		$this->Lon = new DbField('Restaurant', 'Restaurant', 'x_Lon', 'Lon', '[Lon]', 'CAST([Lon] AS NVARCHAR)', 5, 8, -1, FALSE, '[Lon]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Lon->Sortable = TRUE; // Allow sort
		$this->Lon->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Lon'] = &$this->Lon;

		// GoogleGeocodeAddress
		$this->GoogleGeocodeAddress = new DbField('Restaurant', 'Restaurant', 'x_GoogleGeocodeAddress', 'GoogleGeocodeAddress', '[GoogleGeocodeAddress]', '[GoogleGeocodeAddress]', 202, 200, -1, FALSE, '[GoogleGeocodeAddress]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->GoogleGeocodeAddress->Sortable = TRUE; // Allow sort
		$this->fields['GoogleGeocodeAddress'] = &$this->GoogleGeocodeAddress;

		// Address
		$this->Address = new DbField('Restaurant', 'Restaurant', 'x_Address', 'Address', '[Address]', '[Address]', 202, 200, -1, FALSE, '[Address]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Address->Sortable = TRUE; // Allow sort
		$this->fields['Address'] = &$this->Address;

		// Deactivated
		$this->Deactivated = new DbField('Restaurant', 'Restaurant', 'x_Deactivated', 'Deactivated', '[Deactivated]', 'CAST([Deactivated] AS NVARCHAR)', 3, 4, -1, FALSE, '[Deactivated]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->Deactivated->Sortable = TRUE; // Allow sort
		switch ($CurrentLanguage) {
			case "en":
				$this->Deactivated->Lookup = new Lookup('Deactivated', 'Restaurant', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
			default:
				$this->Deactivated->Lookup = new Lookup('Deactivated', 'Restaurant', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
		}
		$this->Deactivated->OptionCount = 2;
		$this->Deactivated->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Deactivated'] = &$this->Deactivated;

		// Suspended
		$this->Suspended = new DbField('Restaurant', 'Restaurant', 'x_Suspended', 'Suspended', '[Suspended]', 'CAST([Suspended] AS NVARCHAR)', 3, 4, -1, FALSE, '[Suspended]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->Suspended->Sortable = TRUE; // Allow sort
		switch ($CurrentLanguage) {
			case "en":
				$this->Suspended->Lookup = new Lookup('Suspended', 'Restaurant', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
			default:
				$this->Suspended->Lookup = new Lookup('Suspended', 'Restaurant', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
		}
		$this->Suspended->OptionCount = 2;
		$this->Suspended->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Suspended'] = &$this->Suspended;

		// ActualQRGrantCode
		$this->ActualQRGrantCode = new DbField('Restaurant', 'Restaurant', 'x_ActualQRGrantCode', 'ActualQRGrantCode', '[ActualQRGrantCode]', '[ActualQRGrantCode]', 202, 50, -1, FALSE, '[ActualQRGrantCode]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ActualQRGrantCode->Sortable = TRUE; // Allow sort
		$this->fields['ActualQRGrantCode'] = &$this->ActualQRGrantCode;

		// Email
		$this->_Email = new DbField('Restaurant', 'Restaurant', 'x__Email', 'Email', '[Email]', '[Email]', 202, 50, -1, FALSE, '[Email]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->_Email->Required = TRUE; // Required field
		$this->_Email->Sortable = TRUE; // Allow sort
		$this->fields['Email'] = &$this->_Email;

		// Password
		$this->Password = new DbField('Restaurant', 'Restaurant', 'x_Password', 'Password', '[Password]', '[Password]', 202, 50, -1, FALSE, '[Password]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'PASSWORD');
		$this->Password->Required = TRUE; // Required field
		$this->Password->Sortable = TRUE; // Allow sort
		$this->fields['Password'] = &$this->Password;

		// SplashImg
		$this->SplashImg = new DbField('Restaurant', 'Restaurant', 'x_SplashImg', 'SplashImg', '[SplashImg]', '[SplashImg]', 202, 80, -1, TRUE, '[SplashImg]', FALSE, FALSE, FALSE, 'IMAGE', 'FILE');
		$this->SplashImg->Sortable = TRUE; // Allow sort
		$this->fields['SplashImg'] = &$this->SplashImg;

		// LogoSize1
		$this->LogoSize1 = new DbField('Restaurant', 'Restaurant', 'x_LogoSize1', 'LogoSize1', '[LogoSize1]', '[LogoSize1]', 202, 80, -1, TRUE, '[LogoSize1]', FALSE, FALSE, FALSE, 'IMAGE', 'FILE');
		$this->LogoSize1->Sortable = TRUE; // Allow sort
		$this->fields['LogoSize1'] = &$this->LogoSize1;

		// LogoSize2
		$this->LogoSize2 = new DbField('Restaurant', 'Restaurant', 'x_LogoSize2', 'LogoSize2', '[LogoSize2]', '[LogoSize2]', 202, 80, -1, TRUE, '[LogoSize2]', FALSE, FALSE, FALSE, 'IMAGE', 'FILE');
		$this->LogoSize2->Sortable = TRUE; // Allow sort
		$this->fields['LogoSize2'] = &$this->LogoSize2;

		// AppCSS
		$this->AppCSS = new DbField('Restaurant', 'Restaurant', 'x_AppCSS', 'AppCSS', '[AppCSS]', '[AppCSS]', 202, 80, -1, TRUE, '[AppCSS]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->AppCSS->Sortable = TRUE; // Allow sort
		$this->AppCSS->UploadAllowedFileExt = "css";
		$this->fields['AppCSS'] = &$this->AppCSS;

		// SplashVideo
		$this->SplashVideo = new DbField('Restaurant', 'Restaurant', 'x_SplashVideo', 'SplashVideo', '[SplashVideo]', '[SplashVideo]', 202, 80, -1, TRUE, '[SplashVideo]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->SplashVideo->Sortable = TRUE; // Allow sort
		$this->fields['SplashVideo'] = &$this->SplashVideo;
	}

	// Field Visibility
	public function getFieldVisibility($fldParm)
	{
		global $Security;
		return $this->$fldParm->Visible; // Returns original value
	}

	// Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
	function setLeftColumnClass($class)
	{
		if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
			$this->LeftColumnClass = $class . " col-form-label ew-label";
			$this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
			$this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
			$this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
		}
	}

	// Single column sort
	public function updateSort(&$fld)
	{
		if ($this->CurrentOrder == $fld->Name) {
			$sortField = $fld->Expression;
			$lastSort = $fld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$thisSort = $this->CurrentOrderType;
			} else {
				$thisSort = ($lastSort == "ASC") ? "DESC" : "ASC";
			}
			$fld->setSort($thisSort);
			$this->setSessionOrderBy($sortField . " " . $thisSort); // Save to Session
		} else {
			$fld->setSort("");
		}
	}

	// Current detail table name
	public function getCurrentDetailTable()
	{
		return @$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_DETAIL_TABLE")];
	}
	public function setCurrentDetailTable($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_DETAIL_TABLE")] = $v;
	}

	// Get detail url
	public function getDetailUrl()
	{

		// Detail url
		$detailUrl = "";
		if ($this->getCurrentDetailTable() == "Client") {
			$detailUrl = $GLOBALS["Client"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_ID=" . urlencode($this->ID->CurrentValue);
		}
		if ($this->getCurrentDetailTable() == "Categorias") {
			$detailUrl = $GLOBALS["Categorias"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_ID=" . urlencode($this->ID->CurrentValue);
		}
		if ($this->getCurrentDetailTable() == "_Table") {
			$detailUrl = $GLOBALS["_Table"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_ID=" . urlencode($this->ID->CurrentValue);
		}
		if ($detailUrl == "")
			$detailUrl = "Restaurantlist.php";
		return $detailUrl;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[Restaurant]";
	}
	public function sqlFrom() // For backward compatibility
	{
		return $this->getSqlFrom();
	}
	public function setSqlFrom($v)
	{
		$this->SqlFrom = $v;
	}
	public function getSqlSelect() // Select
	{
		return ($this->SqlSelect != "") ? $this->SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}
	public function sqlSelect() // For backward compatibility
	{
		return $this->getSqlSelect();
	}
	public function setSqlSelect($v)
	{
		$this->SqlSelect = $v;
	}
	public function getSqlWhere() // Where
	{
		$where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
		$this->TableFilter = "";
		AddFilter($where, $this->TableFilter);
		return $where;
	}
	public function sqlWhere() // For backward compatibility
	{
		return $this->getSqlWhere();
	}
	public function setSqlWhere($v)
	{
		$this->SqlWhere = $v;
	}
	public function getSqlGroupBy() // Group By
	{
		return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "";
	}
	public function sqlGroupBy() // For backward compatibility
	{
		return $this->getSqlGroupBy();
	}
	public function setSqlGroupBy($v)
	{
		$this->SqlGroupBy = $v;
	}
	public function getSqlHaving() // Having
	{
		return ($this->SqlHaving != "") ? $this->SqlHaving : "";
	}
	public function sqlHaving() // For backward compatibility
	{
		return $this->getSqlHaving();
	}
	public function setSqlHaving($v)
	{
		$this->SqlHaving = $v;
	}
	public function getSqlOrderBy() // Order By
	{
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "";
	}
	public function sqlOrderBy() // For backward compatibility
	{
		return $this->getSqlOrderBy();
	}
	public function setSqlOrderBy($v)
	{
		$this->SqlOrderBy = $v;
	}

	// Apply User ID filters
	public function applyUserIDFilters($filter, $id = "")
	{
		global $Security;

		// Add User ID filter
		if ($Security->currentUserID() != "" && !$Security->isAdmin()) { // Non system admin
			$filter = $this->addUserIDFilter($filter, $id);
		}
		return $filter;
	}

	// Check if User ID security allows view all
	public function userIDAllow($id = "")
	{
		$allow = $this->UserIDAllowSecurity;
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			case "lookup":
				return (($allow & 256) == 256);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get recordset
	public function getRecordset($sql, $rowcnt = -1, $offset = -1)
	{
		$conn = $this->getConnection();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->selectLimit($sql, $rowcnt, $offset);
		$conn->raiseErrorFn = "";
		return $rs;
	}

	// Get record count
	public function getRecordCount($sql, $c = NULL)
	{
		$cnt = -1;
		$rs = NULL;
		$sql = preg_replace('/\/\*BeginOrderBy\*\/[\s\S]+\/\*EndOrderBy\*\//', "", $sql); // Remove ORDER BY clause (MSSQL)
		$pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';

		// Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
			preg_match($pattern, $sql) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sql) &&
			!preg_match('/^\s*select\s+distinct\s+/i', $sql) && !preg_match('/\s+order\s+by\s+/i', $sql)) {
			$sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sql);
		} else {
			$sqlwrk = "SELECT COUNT(*) FROM (" . $sql . ") COUNT_TABLE";
		}
		$conn = $c ?: $this->getConnection();
		if ($rs = $conn->execute($sqlwrk)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->close();
			}
			return (int)$cnt;
		}

		// Unable to get count, get record count directly
		if ($rs = $conn->execute($sql)) {
			$cnt = $rs->RecordCount();
			$rs->close();
			return (int)$cnt;
		}
		return $cnt;
	}

	// Get SQL
	public function getSql($where, $orderBy = "")
	{
		return BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderBy);
	}

	// Table SQL
	public function getCurrentSql()
	{
		$filter = $this->CurrentFilter;
		$filter = $this->applyUserIDFilters($filter);
		$sort = $this->getSessionOrderBy();
		return $this->getSql($filter, $sort);
	}

	// Table SQL with List page filter
	public function getListSql()
	{
		$filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->getSqlSelect();
		$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
	}

	// Get record count based on filter (for detail record count in master table pages)
	public function loadRecordCount($filter)
	{
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $filter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
		$cnt = $this->getRecordCount($sql);
		$this->CurrentFilter = $origFilter;
		return $cnt;
	}

	// Get record count (for current List page)
	public function listRecordCount()
	{
		$filter = $this->getSessionWhere();
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		$cnt = $this->getRecordCount($sql);
		return $cnt;
	}

	// INSERT statement
	protected function insertSql(&$rs)
	{
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom)
				continue;
			if (Config("ENCRYPTED_PASSWORD") && $name == Config("LOGIN_PASSWORD_FIELD_NAME"))
				$value = Config("CASE_SENSITIVE_PASSWORD") ? EncryptPassword($value) : EncryptPassword(strtolower($value));
			$names .= $this->fields[$name]->Expression . ",";
			$values .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$names = preg_replace('/,+$/', "", $names);
		$values = preg_replace('/,+$/', "", $values);
		return "INSERT INTO " . $this->UpdateTable . " (" . $names . ") VALUES (" . $values . ")";
	}

	// Insert
	public function insert(&$rs)
	{
		$conn = $this->getConnection();
		$success = $conn->execute($this->insertSql($rs));
		if ($success) {

			// Get insert id if necessary
			$this->ID->setDbValue($conn->insert_ID());
			$rs['ID'] = $this->ID->DbValue;
		}
		return $success;
	}

	// UPDATE statement
	protected function updateSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom || $this->fields[$name]->IsAutoIncrement)
				continue;
			if (Config("ENCRYPTED_PASSWORD") && $name == Config("LOGIN_PASSWORD_FIELD_NAME")) {
				if ($value == $this->fields[$name]->OldValue) // No need to update hashed password if not changed
					continue;
				$value = Config("CASE_SENSITIVE_PASSWORD") ? EncryptPassword($value) : EncryptPassword(strtolower($value));
			}
			$sql .= $this->fields[$name]->Expression . "=";
			$sql .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$sql = preg_replace('/,+$/', "", $sql);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		AddFilter($filter, $where);
		if ($filter != "")
			$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	public function update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE)
	{
		$conn = $this->getConnection();
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
			if (array_key_exists('ID', $rs))
				AddFilter($where, QuotedName('ID', $this->Dbid) . '=' . QuotedValue($rs['ID'], $this->ID->DataType, $this->Dbid));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		AddFilter($filter, $where);
		if ($filter != "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	public function delete(&$rs, $where = "", $curfilter = FALSE)
	{
		$success = TRUE;
		$conn = $this->getConnection();
		if ($success)
			$success = $conn->execute($this->deleteSql($rs, $where, $curfilter));
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->ID->DbValue = $row['ID'];
		$this->ID_State->DbValue = $row['ID_State'];
		$this->DateCreation->DbValue = $row['DateCreation'];
		$this->DateLastUpdate->DbValue = $row['DateLastUpdate'];
		$this->Nombre->DbValue = $row['Nombre'];
		$this->Lat->DbValue = $row['Lat'];
		$this->Lon->DbValue = $row['Lon'];
		$this->GoogleGeocodeAddress->DbValue = $row['GoogleGeocodeAddress'];
		$this->Address->DbValue = $row['Address'];
		$this->Deactivated->DbValue = $row['Deactivated'];
		$this->Suspended->DbValue = $row['Suspended'];
		$this->ActualQRGrantCode->DbValue = $row['ActualQRGrantCode'];
		$this->_Email->DbValue = $row['Email'];
		$this->Password->DbValue = $row['Password'];
		$this->SplashImg->Upload->DbValue = $row['SplashImg'];
		$this->LogoSize1->Upload->DbValue = $row['LogoSize1'];
		$this->LogoSize2->Upload->DbValue = $row['LogoSize2'];
		$this->AppCSS->Upload->DbValue = $row['AppCSS'];
		$this->SplashVideo->Upload->DbValue = $row['SplashVideo'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
		$oldFiles = EmptyValue($row['SplashImg']) ? [] : [$row['SplashImg']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->SplashImg->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->SplashImg->oldPhysicalUploadPath() . $oldFile);
		}
		$oldFiles = EmptyValue($row['LogoSize1']) ? [] : [$row['LogoSize1']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->LogoSize1->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->LogoSize1->oldPhysicalUploadPath() . $oldFile);
		}
		$oldFiles = EmptyValue($row['LogoSize2']) ? [] : [$row['LogoSize2']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->LogoSize2->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->LogoSize2->oldPhysicalUploadPath() . $oldFile);
		}
		$oldFiles = EmptyValue($row['AppCSS']) ? [] : [$row['AppCSS']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->AppCSS->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->AppCSS->oldPhysicalUploadPath() . $oldFile);
		}
		$oldFiles = EmptyValue($row['SplashVideo']) ? [] : [$row['SplashVideo']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->SplashVideo->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->SplashVideo->oldPhysicalUploadPath() . $oldFile);
		}
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "[ID] = @ID@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('ID', $row) ? $row['ID'] : NULL;
		else
			$val = $this->ID->OldValue !== NULL ? $this->ID->OldValue : $this->ID->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		return $keyFilter;
	}

	// Return page URL
	public function getReturnUrl()
	{
		$name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");

		// Get referer URL automatically
		if (ServerVar("HTTP_REFERER") != "" && ReferPageName() != CurrentPageName() && ReferPageName() != "login.php") // Referer not same page or login page
			$_SESSION[$name] = ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] != "") {
			return $_SESSION[$name];
		} else {
			return "Restaurantlist.php";
		}
	}
	public function setReturnUrl($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
	}

	// Get modal caption
	public function getModalCaption($pageName)
	{
		global $Language;
		if ($pageName == "Restaurantview.php")
			return $Language->phrase("View");
		elseif ($pageName == "Restaurantedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "Restaurantadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "Restaurantlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("Restaurantview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("Restaurantview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "Restaurantadd.php?" . $this->getUrlParm($parm);
		else
			$url = "Restaurantadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("Restaurantedit.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("Restaurantedit.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Inline edit URL
	public function getInlineEditUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
		return $this->addMasterUrl($url);
	}

	// Copy URL
	public function getCopyUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("Restaurantadd.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("Restaurantadd.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Inline copy URL
	public function getInlineCopyUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
		return $this->addMasterUrl($url);
	}

	// Delete URL
	public function getDeleteUrl()
	{
		return $this->keyUrl("Restaurantdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "ID:" . JsonEncode($this->ID->CurrentValue, "number");
		$json = "{" . $json . "}";
		if ($htmlEncode)
			$json = HtmlEncode($json);
		return $json;
	}

	// Add key value to URL
	public function keyUrl($url, $parm = "")
	{
		$url = $url . "?";
		if ($parm != "")
			$url .= $parm . "&";
		if ($this->ID->CurrentValue != NULL) {
			$url .= "ID=" . urlencode($this->ID->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		return $url;
	}

	// Sort URL
	public function sortUrl(&$fld)
	{
		if ($this->CurrentAction || $this->isExport() ||
			in_array($fld->Type, [141, 201, 203, 128, 204, 205])) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->reverseSort());
			return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
		} else {
			return "";
		}
	}

	// Get record keys from Post/Get/Session
	public function getRecordKeys()
	{
		$arKeys = [];
		$arKey = [];
		if (Param("key_m") !== NULL) {
			$arKeys = Param("key_m");
			$cnt = count($arKeys);
		} else {
			if (Param("ID") !== NULL)
				$arKeys[] = Param("ID");
			elseif (IsApi() && Key(0) !== NULL)
				$arKeys[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKeys[] = Route(2);
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = [];
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get filter from record keys
	public function getFilterFromRecordKeys($setCurrent = TRUE)
	{
		$arKeys = $this->getRecordKeys();
		$keyFilter = "";
		foreach ($arKeys as $key) {
			if ($keyFilter != "") $keyFilter .= " OR ";
			if ($setCurrent)
				$this->ID->CurrentValue = $key;
			else
				$this->ID->OldValue = $key;
			$keyFilter .= "(" . $this->getRecordFilter() . ")";
		}
		return $keyFilter;
	}

	// Load rows based on filter
	public function &loadRs($filter)
	{

		// Set up filter (WHERE Clause)
		$sql = $this->getSql($filter);
		$conn = $this->getConnection();
		$rs = $conn->execute($sql);
		return $rs;
	}

	// Load row values from recordset
	public function loadListRowValues(&$rs)
	{
		$this->ID->setDbValue($rs->fields('ID'));
		$this->ID_State->setDbValue($rs->fields('ID_State'));
		$this->DateCreation->setDbValue($rs->fields('DateCreation'));
		$this->DateLastUpdate->setDbValue($rs->fields('DateLastUpdate'));
		$this->Nombre->setDbValue($rs->fields('Nombre'));
		$this->Lat->setDbValue($rs->fields('Lat'));
		$this->Lon->setDbValue($rs->fields('Lon'));
		$this->GoogleGeocodeAddress->setDbValue($rs->fields('GoogleGeocodeAddress'));
		$this->Address->setDbValue($rs->fields('Address'));
		$this->Deactivated->setDbValue($rs->fields('Deactivated'));
		$this->Suspended->setDbValue($rs->fields('Suspended'));
		$this->ActualQRGrantCode->setDbValue($rs->fields('ActualQRGrantCode'));
		$this->_Email->setDbValue($rs->fields('Email'));
		$this->Password->setDbValue($rs->fields('Password'));
		$this->SplashImg->Upload->DbValue = $rs->fields('SplashImg');
		$this->LogoSize1->Upload->DbValue = $rs->fields('LogoSize1');
		$this->LogoSize2->Upload->DbValue = $rs->fields('LogoSize2');
		$this->AppCSS->Upload->DbValue = $rs->fields('AppCSS');
		$this->SplashVideo->Upload->DbValue = $rs->fields('SplashVideo');
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
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

		// Call Row Rendered event
		$this->Row_Rendered();

		// Save data for Custom Template
		$this->Rows[] = $this->customTemplateFieldValues();
	}

	// Render edit row values
	public function renderEditRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// ID
		$this->ID->EditAttrs["class"] = "form-control";
		$this->ID->EditCustomAttributes = "";
		$this->ID->EditValue = $this->ID->CurrentValue;
		$this->ID->ViewCustomAttributes = "";

		// ID_State
		$this->ID_State->EditAttrs["class"] = "form-control";
		$this->ID_State->EditCustomAttributes = "";
		$this->ID_State->EditValue = $this->ID_State->CurrentValue;
		$this->ID_State->PlaceHolder = RemoveHtml($this->ID_State->caption());

		// DateCreation
		$this->DateCreation->EditAttrs["class"] = "form-control";
		$this->DateCreation->EditCustomAttributes = "";
		$this->DateCreation->EditValue = FormatDateTime($this->DateCreation->CurrentValue, 8);
		$this->DateCreation->PlaceHolder = RemoveHtml($this->DateCreation->caption());

		// DateLastUpdate
		$this->DateLastUpdate->EditAttrs["class"] = "form-control";
		$this->DateLastUpdate->EditCustomAttributes = "";
		$this->DateLastUpdate->EditValue = FormatDateTime($this->DateLastUpdate->CurrentValue, 8);
		$this->DateLastUpdate->PlaceHolder = RemoveHtml($this->DateLastUpdate->caption());

		// Nombre
		$this->Nombre->EditAttrs["class"] = "form-control";
		$this->Nombre->EditCustomAttributes = "";
		if (!$this->Nombre->Raw)
			$this->Nombre->CurrentValue = HtmlDecode($this->Nombre->CurrentValue);
		$this->Nombre->EditValue = $this->Nombre->CurrentValue;
		$this->Nombre->PlaceHolder = RemoveHtml($this->Nombre->caption());

		// Lat
		$this->Lat->EditAttrs["class"] = "form-control";
		$this->Lat->EditCustomAttributes = "";
		$this->Lat->EditValue = $this->Lat->CurrentValue;
		$this->Lat->PlaceHolder = RemoveHtml($this->Lat->caption());
		if (strval($this->Lat->EditValue) != "" && is_numeric($this->Lat->EditValue))
			$this->Lat->EditValue = FormatNumber($this->Lat->EditValue, -2, -2, -2, -2);
		

		// Lon
		$this->Lon->EditAttrs["class"] = "form-control";
		$this->Lon->EditCustomAttributes = "";
		$this->Lon->EditValue = $this->Lon->CurrentValue;
		$this->Lon->PlaceHolder = RemoveHtml($this->Lon->caption());
		if (strval($this->Lon->EditValue) != "" && is_numeric($this->Lon->EditValue))
			$this->Lon->EditValue = FormatNumber($this->Lon->EditValue, -2, -2, -2, -2);
		

		// GoogleGeocodeAddress
		$this->GoogleGeocodeAddress->EditAttrs["class"] = "form-control";
		$this->GoogleGeocodeAddress->EditCustomAttributes = "";
		if (!$this->GoogleGeocodeAddress->Raw)
			$this->GoogleGeocodeAddress->CurrentValue = HtmlDecode($this->GoogleGeocodeAddress->CurrentValue);
		$this->GoogleGeocodeAddress->EditValue = $this->GoogleGeocodeAddress->CurrentValue;
		$this->GoogleGeocodeAddress->PlaceHolder = RemoveHtml($this->GoogleGeocodeAddress->caption());

		// Address
		$this->Address->EditAttrs["class"] = "form-control";
		$this->Address->EditCustomAttributes = "";
		if (!$this->Address->Raw)
			$this->Address->CurrentValue = HtmlDecode($this->Address->CurrentValue);
		$this->Address->EditValue = $this->Address->CurrentValue;
		$this->Address->PlaceHolder = RemoveHtml($this->Address->caption());

		// Deactivated
		$this->Deactivated->EditAttrs["class"] = "form-control";
		$this->Deactivated->EditCustomAttributes = "";
		if (strval($this->Deactivated->CurrentValue) != "") {
			$this->Deactivated->EditValue = new OptionValues();
			$arwrk = explode(",", strval($this->Deactivated->CurrentValue));
			$cnt = count($arwrk);
			for ($ari = 0; $ari < $cnt; $ari++)
				$this->Deactivated->EditValue->add($this->Deactivated->optionCaption(trim($arwrk[$ari])));
		} else {
			$this->Deactivated->EditValue = NULL;
		}
		$this->Deactivated->ViewCustomAttributes = "";

		// Suspended
		$this->Suspended->EditAttrs["class"] = "form-control";
		$this->Suspended->EditCustomAttributes = "";
		if (strval($this->Suspended->CurrentValue) != "") {
			$this->Suspended->EditValue = $this->Suspended->optionCaption($this->Suspended->CurrentValue);
		} else {
			$this->Suspended->EditValue = NULL;
		}
		$this->Suspended->ViewCustomAttributes = "";

		// ActualQRGrantCode
		$this->ActualQRGrantCode->EditAttrs["class"] = "form-control";
		$this->ActualQRGrantCode->EditCustomAttributes = "";
		if (!$this->ActualQRGrantCode->Raw)
			$this->ActualQRGrantCode->CurrentValue = HtmlDecode($this->ActualQRGrantCode->CurrentValue);
		$this->ActualQRGrantCode->EditValue = $this->ActualQRGrantCode->CurrentValue;
		$this->ActualQRGrantCode->PlaceHolder = RemoveHtml($this->ActualQRGrantCode->caption());

		// Email
		$this->_Email->EditAttrs["class"] = "form-control";
		$this->_Email->EditCustomAttributes = "";
		if (!$this->_Email->Raw)
			$this->_Email->CurrentValue = HtmlDecode($this->_Email->CurrentValue);
		$this->_Email->EditValue = $this->_Email->CurrentValue;
		$this->_Email->PlaceHolder = RemoveHtml($this->_Email->caption());

		// Password
		$this->Password->EditAttrs["class"] = "form-control";
		$this->Password->EditCustomAttributes = "";
		$this->Password->EditValue = $this->Password->CurrentValue;
		$this->Password->PlaceHolder = RemoveHtml($this->Password->caption());

		// SplashImg
		$this->SplashImg->EditAttrs["class"] = "form-control";
		$this->SplashImg->EditCustomAttributes = "";
		if (!EmptyValue($this->SplashImg->Upload->DbValue)) {
			$this->SplashImg->ImageWidth = 0;
			$this->SplashImg->ImageHeight = 200;
			$this->SplashImg->ImageAlt = $this->SplashImg->alt();
			$this->SplashImg->EditValue = $this->SplashImg->Upload->DbValue;
		} else {
			$this->SplashImg->EditValue = "";
		}
		if (!EmptyValue($this->SplashImg->CurrentValue))
				$this->SplashImg->Upload->FileName = $this->SplashImg->CurrentValue;

		// LogoSize1
		$this->LogoSize1->EditAttrs["class"] = "form-control";
		$this->LogoSize1->EditCustomAttributes = "";
		if (!EmptyValue($this->LogoSize1->Upload->DbValue)) {
			$this->LogoSize1->ImageWidth = 0;
			$this->LogoSize1->ImageHeight = 200;
			$this->LogoSize1->ImageAlt = $this->LogoSize1->alt();
			$this->LogoSize1->EditValue = $this->LogoSize1->Upload->DbValue;
		} else {
			$this->LogoSize1->EditValue = "";
		}
		if (!EmptyValue($this->LogoSize1->CurrentValue))
				$this->LogoSize1->Upload->FileName = $this->LogoSize1->CurrentValue;

		// LogoSize2
		$this->LogoSize2->EditAttrs["class"] = "form-control";
		$this->LogoSize2->EditCustomAttributes = "";
		if (!EmptyValue($this->LogoSize2->Upload->DbValue)) {
			$this->LogoSize2->ImageWidth = 0;
			$this->LogoSize2->ImageHeight = 200;
			$this->LogoSize2->ImageAlt = $this->LogoSize2->alt();
			$this->LogoSize2->EditValue = $this->LogoSize2->Upload->DbValue;
		} else {
			$this->LogoSize2->EditValue = "";
		}
		if (!EmptyValue($this->LogoSize2->CurrentValue))
				$this->LogoSize2->Upload->FileName = $this->LogoSize2->CurrentValue;

		// AppCSS
		$this->AppCSS->EditAttrs["class"] = "form-control";
		$this->AppCSS->EditCustomAttributes = "";
		if (!EmptyValue($this->AppCSS->Upload->DbValue)) {
			$this->AppCSS->EditValue = $this->AppCSS->Upload->DbValue;
		} else {
			$this->AppCSS->EditValue = "";
		}
		if (!EmptyValue($this->AppCSS->CurrentValue))
				$this->AppCSS->Upload->FileName = $this->AppCSS->CurrentValue;

		// SplashVideo
		$this->SplashVideo->EditAttrs["class"] = "form-control";
		$this->SplashVideo->EditCustomAttributes = "";
		if (!EmptyValue($this->SplashVideo->Upload->DbValue)) {
			$this->SplashVideo->EditValue = $this->SplashVideo->Upload->DbValue;
		} else {
			$this->SplashVideo->EditValue = "";
		}
		if (!EmptyValue($this->SplashVideo->CurrentValue))
				$this->SplashVideo->Upload->FileName = $this->SplashVideo->CurrentValue;

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
	{
		if (!$recordset || !$doc)
			return;
		if (!$doc->ExportCustom) {

			// Write header
			$doc->exportTableHeader();
			if ($doc->Horizontal) { // Horizontal format, write header
				$doc->beginExportRow();
				if ($exportPageType == "view") {
					$doc->exportCaption($this->ID);
					$doc->exportCaption($this->ID_State);
					$doc->exportCaption($this->DateCreation);
					$doc->exportCaption($this->DateLastUpdate);
					$doc->exportCaption($this->Nombre);
					$doc->exportCaption($this->Lat);
					$doc->exportCaption($this->Lon);
					$doc->exportCaption($this->GoogleGeocodeAddress);
					$doc->exportCaption($this->Address);
					$doc->exportCaption($this->Deactivated);
					$doc->exportCaption($this->Suspended);
					$doc->exportCaption($this->ActualQRGrantCode);
					$doc->exportCaption($this->_Email);
					$doc->exportCaption($this->Password);
					$doc->exportCaption($this->SplashImg);
					$doc->exportCaption($this->LogoSize1);
					$doc->exportCaption($this->LogoSize2);
					$doc->exportCaption($this->AppCSS);
					$doc->exportCaption($this->SplashVideo);
				} else {
					$doc->exportCaption($this->ID);
					$doc->exportCaption($this->ID_State);
					$doc->exportCaption($this->DateCreation);
					$doc->exportCaption($this->DateLastUpdate);
					$doc->exportCaption($this->Nombre);
					$doc->exportCaption($this->Lat);
					$doc->exportCaption($this->Lon);
					$doc->exportCaption($this->GoogleGeocodeAddress);
					$doc->exportCaption($this->Address);
					$doc->exportCaption($this->Deactivated);
					$doc->exportCaption($this->Suspended);
					$doc->exportCaption($this->ActualQRGrantCode);
					$doc->exportCaption($this->_Email);
					$doc->exportCaption($this->Password);
					$doc->exportCaption($this->SplashImg);
					$doc->exportCaption($this->LogoSize1);
					$doc->exportCaption($this->LogoSize2);
					$doc->exportCaption($this->AppCSS);
					$doc->exportCaption($this->SplashVideo);
				}
				$doc->endExportRow();
			}
		}

		// Move to first record
		$recCnt = $startRec - 1;
		if (!$recordset->EOF) {
			$recordset->moveFirst();
			if ($startRec > 1)
				$recordset->move($startRec - 1);
		}
		while (!$recordset->EOF && $recCnt < $stopRec) {
			$recCnt++;
			if ($recCnt >= $startRec) {
				$rowCnt = $recCnt - $startRec + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0)
						$doc->exportPageBreak();
				}
				$this->loadListRowValues($recordset);

				// Render row
				$this->RowType = ROWTYPE_VIEW; // Render view
				$this->resetAttributes();
				$this->renderListRow();
				if (!$doc->ExportCustom) {
					$doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
					if ($exportPageType == "view") {
						$doc->exportField($this->ID);
						$doc->exportField($this->ID_State);
						$doc->exportField($this->DateCreation);
						$doc->exportField($this->DateLastUpdate);
						$doc->exportField($this->Nombre);
						$doc->exportField($this->Lat);
						$doc->exportField($this->Lon);
						$doc->exportField($this->GoogleGeocodeAddress);
						$doc->exportField($this->Address);
						$doc->exportField($this->Deactivated);
						$doc->exportField($this->Suspended);
						$doc->exportField($this->ActualQRGrantCode);
						$doc->exportField($this->_Email);
						$doc->exportField($this->Password);
						$doc->exportField($this->SplashImg);
						$doc->exportField($this->LogoSize1);
						$doc->exportField($this->LogoSize2);
						$doc->exportField($this->AppCSS);
						$doc->exportField($this->SplashVideo);
					} else {
						$doc->exportField($this->ID);
						$doc->exportField($this->ID_State);
						$doc->exportField($this->DateCreation);
						$doc->exportField($this->DateLastUpdate);
						$doc->exportField($this->Nombre);
						$doc->exportField($this->Lat);
						$doc->exportField($this->Lon);
						$doc->exportField($this->GoogleGeocodeAddress);
						$doc->exportField($this->Address);
						$doc->exportField($this->Deactivated);
						$doc->exportField($this->Suspended);
						$doc->exportField($this->ActualQRGrantCode);
						$doc->exportField($this->_Email);
						$doc->exportField($this->Password);
						$doc->exportField($this->SplashImg);
						$doc->exportField($this->LogoSize1);
						$doc->exportField($this->LogoSize2);
						$doc->exportField($this->AppCSS);
						$doc->exportField($this->SplashVideo);
					}
					$doc->endExportRow($rowCnt);
				}
			}

			// Call Row Export server event
			if ($doc->ExportCustom)
				$this->Row_Export($recordset->fields);
			$recordset->moveNext();
		}
		if (!$doc->ExportCustom) {
			$doc->exportTableFooter();
		}
	}

	// User ID filter
	public function getUserIDFilter($userId)
	{
		$userIdFilter = '[ID] = ' . QuotedValue($userId, DATATYPE_NUMBER, Config("USER_TABLE_DBID"));
		return $userIdFilter;
	}

	// Add User ID filter
	public function addUserIDFilter($filter = "", $id = "")
	{
		global $Security;
		$filterWrk = "";
		if ($id == "")
			$id = (CurrentPageID() == "list") ? $this->CurrentAction : CurrentPageID();
		if (!$this->userIDAllow($id) && !$Security->isAdmin()) {
			$filterWrk = $Security->userIdList();
			if ($filterWrk != "")
				$filterWrk = '[ID] IN (' . $filterWrk . ')';
		}

		// Call User ID Filtering event
		$this->UserID_Filtering($filterWrk);
		AddFilter($filter, $filterWrk);
		return $filter;
	}

	// User ID subquery
	public function getUserIDSubquery(&$fld, &$masterfld)
	{
		global $UserTable;
		$wrk = "";
		$sql = "SELECT " . $masterfld->Expression . " FROM [dbo].[Restaurant]";
		$filter = $this->addUserIDFilter("");
		if ($filter != "")
			$sql .= " WHERE " . $filter;

		// Use subquery
		if (Config("USE_SUBQUERY_FOR_MASTER_USER_ID")) {
			$wrk = $sql;
		} else {

			// List all values
			if ($rs = Conn($UserTable->Dbid)->execute($sql)) {
				while (!$rs->EOF) {
					if ($wrk != "")
						$wrk .= ",";
					$wrk .= QuotedValue($rs->fields[0], $masterfld->DataType, Config("USER_TABLE_DBID"));
					$rs->moveNext();
				}
				$rs->close();
			}
		}
		if ($wrk != "")
			$wrk = $fld->Expression . " IN (" . $wrk . ")";
		return $wrk;
	}

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0)
	{
		$width = ($width > 0) ? $width : Config("THUMBNAIL_DEFAULT_WIDTH");
		$height = ($height > 0) ? $height : Config("THUMBNAIL_DEFAULT_HEIGHT");

		// Set up field name / file name field / file type field
		$fldName = "";
		$fileNameFld = "";
		$fileTypeFld = "";
		if ($fldparm == 'SplashImg') {
			$fldName = "SplashImg";
			$fileNameFld = "SplashImg";
		} elseif ($fldparm == 'LogoSize1') {
			$fldName = "LogoSize1";
			$fileNameFld = "LogoSize1";
		} elseif ($fldparm == 'LogoSize2') {
			$fldName = "LogoSize2";
			$fileNameFld = "LogoSize2";
		} elseif ($fldparm == 'AppCSS') {
			$fldName = "AppCSS";
			$fileNameFld = "AppCSS";
		} elseif ($fldparm == 'SplashVideo') {
			$fldName = "SplashVideo";
			$fileNameFld = "SplashVideo";
		} else {
			return FALSE; // Incorrect field
		}

		// Set up key values
		$ar = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
		if (count($ar) == 1) {
			$this->ID->CurrentValue = $ar[0];
		} else {
			return FALSE; // Incorrect key
		}

		// Set up filter (WHERE Clause)
		$filter = $this->getRecordFilter();
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$dbtype = GetConnectionType($this->Dbid);
		if (($rs = $conn->execute($sql)) && !$rs->EOF) {
			$val = $rs->fields($fldName);
			if (!EmptyValue($val)) {
				$fld = $this->fields[$fldName];

				// Binary data
				if ($fld->DataType == DATATYPE_BLOB) {
					if ($dbtype != "MYSQL") {
						if (is_array($val) || is_object($val)) // Byte array
							$val = BytesToString($val);
					}
					if ($resize)
						ResizeBinary($val, $width, $height);

					// Write file type
					if ($fileTypeFld != "" && !EmptyValue($rs->fields($fileTypeFld))) {
						AddHeader("Content-type", $rs->fields($fileTypeFld));
					} else {
						AddHeader("Content-type", ContentType($val));
					}

					// Write file name
					$downloadPdf = !Config("EMBED_PDF") && Config("DOWNLOAD_PDF_FILE");
					if ($fileNameFld != "" && !EmptyValue($rs->fields($fileNameFld))) {
						$fileName = $rs->fields($fileNameFld);
						$pathinfo = pathinfo($fileName);
						$ext = strtolower(@$pathinfo["extension"]);
						$isPdf = SameText($ext, "pdf");
						if ($downloadPdf || !$isPdf) // Skip header if not download PDF
							AddHeader("Content-Disposition", "attachment; filename=\"" . $fileName . "\"");
					} else {
						$ext = ContentExtension($val);
						$isPdf = SameText($ext, ".pdf");
						if ($isPdf && $downloadPdf) // Add header if download PDF
							AddHeader("Content-Disposition", "attachment; filename=\"" . $fileName . "\"");
					}

					// Write file data
					if (StartsString("PK", $val) && ContainsString($val, "[Content_Types].xml") &&
						ContainsString($val, "_rels") && ContainsString($val, "docProps")) { // Fix Office 2007 documents
						if (!EndsString("\0\0\0", $val)) // Not ends with 3 or 4 \0
							$val .= "\0\0\0\0";
					}

					// Clear any debug message
					if (ob_get_length())
						ob_end_clean();

					// Write binary data
					Write($val);

				// Upload to folder
				} else {
					if ($fld->UploadMultiple)
						$files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
					else
						$files = [$val];
					$data = [];
					$ar = [];
					foreach ($files as $file) {
						if (!EmptyValue($file))
							$ar[$file] = FullUrl($fld->hrefPath() . $file);
					}
					$data[$fld->Param] = $ar;
					WriteJson($data);
				}
			}
			$rs->close();
			return TRUE;
		}
		return FALSE;
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending($email, &$args) {

		//var_dump($email); var_dump($args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>