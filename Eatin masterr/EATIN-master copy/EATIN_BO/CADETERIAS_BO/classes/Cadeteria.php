<?php namespace PHPMaker2020\BACKOFFICE_CADETERIAS; ?>
<?php

/**
 * Table class for Cadeteria
 */
class Cadeteria extends DbTable
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
	public $ID_Status;
	public $Nombre;
	public $Lat;
	public $Lon;
	public $_Email;
	public $Hashpass;
	public $fMult1;
	public $fMult2;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'Cadeteria';
		$this->TableName = 'Cadeteria';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "[dbo].[Cadeteria]";
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
		$this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// ID
		$this->ID = new DbField('Cadeteria', 'Cadeteria', 'x_ID', 'ID', '[ID]', 'CAST([ID] AS NVARCHAR)', 20, 8, -1, FALSE, '[ID]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->ID->IsAutoIncrement = TRUE; // Autoincrement field
		$this->ID->IsPrimaryKey = TRUE; // Primary key field
		$this->ID->Nullable = FALSE; // NOT NULL field
		$this->ID->Sortable = TRUE; // Allow sort
		$this->ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ID'] = &$this->ID;

		// ID_Status
		$this->ID_Status = new DbField('Cadeteria', 'Cadeteria', 'x_ID_Status', 'ID_Status', '[ID_Status]', 'CAST([ID_Status] AS NVARCHAR)', 20, 8, -1, FALSE, '[ID_Status]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ID_Status->Nullable = FALSE; // NOT NULL field
		$this->ID_Status->Required = TRUE; // Required field
		$this->ID_Status->Sortable = TRUE; // Allow sort
		$this->ID_Status->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ID_Status'] = &$this->ID_Status;

		// Nombre
		$this->Nombre = new DbField('Cadeteria', 'Cadeteria', 'x_Nombre', 'Nombre', '[Nombre]', '[Nombre]', 202, 100, -1, FALSE, '[Nombre]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Nombre->Nullable = FALSE; // NOT NULL field
		$this->Nombre->Required = TRUE; // Required field
		$this->Nombre->Sortable = TRUE; // Allow sort
		$this->fields['Nombre'] = &$this->Nombre;

		// Lat
		$this->Lat = new DbField('Cadeteria', 'Cadeteria', 'x_Lat', 'Lat', '[Lat]', 'CAST([Lat] AS NVARCHAR)', 5, 8, -1, FALSE, '[Lat]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Lat->Nullable = FALSE; // NOT NULL field
		$this->Lat->Required = TRUE; // Required field
		$this->Lat->Sortable = TRUE; // Allow sort
		$this->Lat->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Lat'] = &$this->Lat;

		// Lon
		$this->Lon = new DbField('Cadeteria', 'Cadeteria', 'x_Lon', 'Lon', '[Lon]', 'CAST([Lon] AS NVARCHAR)', 5, 8, -1, FALSE, '[Lon]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Lon->Nullable = FALSE; // NOT NULL field
		$this->Lon->Required = TRUE; // Required field
		$this->Lon->Sortable = TRUE; // Allow sort
		$this->Lon->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Lon'] = &$this->Lon;

		// Email
		$this->_Email = new DbField('Cadeteria', 'Cadeteria', 'x__Email', 'Email', '[Email]', '[Email]', 202, 50, -1, FALSE, '[Email]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->_Email->Nullable = FALSE; // NOT NULL field
		$this->_Email->Required = TRUE; // Required field
		$this->_Email->Sortable = TRUE; // Allow sort
		$this->fields['Email'] = &$this->_Email;

		// Hashpass
		$this->Hashpass = new DbField('Cadeteria', 'Cadeteria', 'x_Hashpass', 'Hashpass', '[Hashpass]', '[Hashpass]', 202, 50, -1, FALSE, '[Hashpass]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Hashpass->Nullable = FALSE; // NOT NULL field
		$this->Hashpass->Required = TRUE; // Required field
		$this->Hashpass->Sortable = TRUE; // Allow sort
		$this->fields['Hashpass'] = &$this->Hashpass;

		// fMult1
		$this->fMult1 = new DbField('Cadeteria', 'Cadeteria', 'x_fMult1', 'fMult1', '[fMult1]', 'CAST([fMult1] AS NVARCHAR)', 5, 8, -1, FALSE, '[fMult1]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fMult1->Nullable = FALSE; // NOT NULL field
		$this->fMult1->Required = TRUE; // Required field
		$this->fMult1->Sortable = TRUE; // Allow sort
		$this->fMult1->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['fMult1'] = &$this->fMult1;

		// fMult2
		$this->fMult2 = new DbField('Cadeteria', 'Cadeteria', 'x_fMult2', 'fMult2', '[fMult2]', 'CAST([fMult2] AS NVARCHAR)', 5, 8, -1, FALSE, '[fMult2]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fMult2->Nullable = FALSE; // NOT NULL field
		$this->fMult2->Required = TRUE; // Required field
		$this->fMult2->Sortable = TRUE; // Allow sort
		$this->fMult2->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['fMult2'] = &$this->fMult2;
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

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[Cadeteria]";
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
		$this->ID_Status->DbValue = $row['ID_Status'];
		$this->Nombre->DbValue = $row['Nombre'];
		$this->Lat->DbValue = $row['Lat'];
		$this->Lon->DbValue = $row['Lon'];
		$this->_Email->DbValue = $row['Email'];
		$this->Hashpass->DbValue = $row['Hashpass'];
		$this->fMult1->DbValue = $row['fMult1'];
		$this->fMult2->DbValue = $row['fMult2'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
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
			return "Cadeterialist.php";
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
		if ($pageName == "Cadeteriaview.php")
			return $Language->phrase("View");
		elseif ($pageName == "Cadeteriaedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "Cadeteriaadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "Cadeterialist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("Cadeteriaview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("Cadeteriaview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "Cadeteriaadd.php?" . $this->getUrlParm($parm);
		else
			$url = "Cadeteriaadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("Cadeteriaedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("Cadeteriaadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("Cadeteriadelete.php", $this->getUrlParm());
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
		$this->ID_Status->setDbValue($rs->fields('ID_Status'));
		$this->Nombre->setDbValue($rs->fields('Nombre'));
		$this->Lat->setDbValue($rs->fields('Lat'));
		$this->Lon->setDbValue($rs->fields('Lon'));
		$this->_Email->setDbValue($rs->fields('Email'));
		$this->Hashpass->setDbValue($rs->fields('Hashpass'));
		$this->fMult1->setDbValue($rs->fields('fMult1'));
		$this->fMult2->setDbValue($rs->fields('fMult2'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// ID
		// ID_Status
		// Nombre
		// Lat
		// Lon
		// Email
		// Hashpass
		// fMult1
		// fMult2
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

		// ID
		$this->ID->LinkCustomAttributes = "";
		$this->ID->HrefValue = "";
		$this->ID->TooltipValue = "";

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

		// ID_Status
		$this->ID_Status->EditAttrs["class"] = "form-control";
		$this->ID_Status->EditCustomAttributes = "";
		$this->ID_Status->EditValue = $this->ID_Status->CurrentValue;
		$this->ID_Status->PlaceHolder = RemoveHtml($this->ID_Status->caption());

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
		

		// Email
		$this->_Email->EditAttrs["class"] = "form-control";
		$this->_Email->EditCustomAttributes = "";
		if (!$this->_Email->Raw)
			$this->_Email->CurrentValue = HtmlDecode($this->_Email->CurrentValue);
		$this->_Email->EditValue = $this->_Email->CurrentValue;
		$this->_Email->PlaceHolder = RemoveHtml($this->_Email->caption());

		// Hashpass
		$this->Hashpass->EditAttrs["class"] = "form-control";
		$this->Hashpass->EditCustomAttributes = "";
		if (!$this->Hashpass->Raw)
			$this->Hashpass->CurrentValue = HtmlDecode($this->Hashpass->CurrentValue);
		$this->Hashpass->EditValue = $this->Hashpass->CurrentValue;
		$this->Hashpass->PlaceHolder = RemoveHtml($this->Hashpass->caption());

		// fMult1
		$this->fMult1->EditAttrs["class"] = "form-control";
		$this->fMult1->EditCustomAttributes = "";
		$this->fMult1->EditValue = $this->fMult1->CurrentValue;
		$this->fMult1->PlaceHolder = RemoveHtml($this->fMult1->caption());
		if (strval($this->fMult1->EditValue) != "" && is_numeric($this->fMult1->EditValue))
			$this->fMult1->EditValue = FormatNumber($this->fMult1->EditValue, -2, -2, -2, -2);
		

		// fMult2
		$this->fMult2->EditAttrs["class"] = "form-control";
		$this->fMult2->EditCustomAttributes = "";
		$this->fMult2->EditValue = $this->fMult2->CurrentValue;
		$this->fMult2->PlaceHolder = RemoveHtml($this->fMult2->caption());
		if (strval($this->fMult2->EditValue) != "" && is_numeric($this->fMult2->EditValue))
			$this->fMult2->EditValue = FormatNumber($this->fMult2->EditValue, -2, -2, -2, -2);
		

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
					$doc->exportCaption($this->ID_Status);
					$doc->exportCaption($this->Nombre);
					$doc->exportCaption($this->Lat);
					$doc->exportCaption($this->Lon);
					$doc->exportCaption($this->_Email);
					$doc->exportCaption($this->Hashpass);
					$doc->exportCaption($this->fMult1);
					$doc->exportCaption($this->fMult2);
				} else {
					$doc->exportCaption($this->ID);
					$doc->exportCaption($this->ID_Status);
					$doc->exportCaption($this->Nombre);
					$doc->exportCaption($this->Lat);
					$doc->exportCaption($this->Lon);
					$doc->exportCaption($this->_Email);
					$doc->exportCaption($this->Hashpass);
					$doc->exportCaption($this->fMult1);
					$doc->exportCaption($this->fMult2);
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
						$doc->exportField($this->ID_Status);
						$doc->exportField($this->Nombre);
						$doc->exportField($this->Lat);
						$doc->exportField($this->Lon);
						$doc->exportField($this->_Email);
						$doc->exportField($this->Hashpass);
						$doc->exportField($this->fMult1);
						$doc->exportField($this->fMult2);
					} else {
						$doc->exportField($this->ID);
						$doc->exportField($this->ID_Status);
						$doc->exportField($this->Nombre);
						$doc->exportField($this->Lat);
						$doc->exportField($this->Lon);
						$doc->exportField($this->_Email);
						$doc->exportField($this->Hashpass);
						$doc->exportField($this->fMult1);
						$doc->exportField($this->fMult2);
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

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0)
	{

		// No binary fields
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