<?php namespace PHPMaker2020\EATIN_BO; ?>
<?php

/**
 * Table class for Items
 */
class Items extends DbTable
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
	public $ID_Categorias;
	public $ID_Restaurant;
	public $DateCreation;
	public $DateLastUpdate;
	public $Nombre;
	public $Precio;
	public $Active;
	public $Stock;
	public $Img1;
	public $Img2;
	public $Img3;
	public $Img4;
	public $Vid1;
	public $Vid2;
	public $Descripcion;
	public $NombreEN;
	public $DescripcionEN;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'Items';
		$this->TableName = 'Items';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "[dbo].[Items]";
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
		$this->ID = new DbField('Items', 'Items', 'x_ID', 'ID', '[ID]', 'CAST([ID] AS NVARCHAR)', 20, 8, -1, FALSE, '[ID]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->ID->IsAutoIncrement = TRUE; // Autoincrement field
		$this->ID->IsPrimaryKey = TRUE; // Primary key field
		$this->ID->Nullable = FALSE; // NOT NULL field
		$this->ID->Sortable = TRUE; // Allow sort
		$this->ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ID'] = &$this->ID;

		// ID_Categorias
		$this->ID_Categorias = new DbField('Items', 'Items', 'x_ID_Categorias', 'ID_Categorias', '[ID_Categorias]', 'CAST([ID_Categorias] AS NVARCHAR)', 20, 8, -1, FALSE, '[ID_Categorias]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ID_Categorias->IsForeignKey = TRUE; // Foreign key field
		$this->ID_Categorias->Nullable = FALSE; // NOT NULL field
		$this->ID_Categorias->Required = TRUE; // Required field
		$this->ID_Categorias->Sortable = TRUE; // Allow sort
		$this->ID_Categorias->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ID_Categorias->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->ID_Categorias->Lookup = new Lookup('ID_Categorias', 'Categorias', FALSE, 'ID', ["Nombre","","",""], [], [], [], [], [], [], '', '');
				break;
			default:
				$this->ID_Categorias->Lookup = new Lookup('ID_Categorias', 'Categorias', FALSE, 'ID', ["Nombre","","",""], [], [], [], [], [], [], '', '');
				break;
		}
		$this->ID_Categorias->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ID_Categorias'] = &$this->ID_Categorias;

		// ID_Restaurant
		$this->ID_Restaurant = new DbField('Items', 'Items', 'x_ID_Restaurant', 'ID_Restaurant', '[ID_Restaurant]', 'CAST([ID_Restaurant] AS NVARCHAR)', 20, 8, -1, FALSE, '[ID_Restaurant]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ID_Restaurant->Sortable = TRUE; // Allow sort
		$this->ID_Restaurant->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ID_Restaurant->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->ID_Restaurant->Lookup = new Lookup('ID_Restaurant', 'Restaurant', FALSE, 'ID', ["Nombre","","",""], [], [], [], [], [], [], '', '');
				break;
			default:
				$this->ID_Restaurant->Lookup = new Lookup('ID_Restaurant', 'Restaurant', FALSE, 'ID', ["Nombre","","",""], [], [], [], [], [], [], '', '');
				break;
		}
		$this->ID_Restaurant->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ID_Restaurant'] = &$this->ID_Restaurant;

		// DateCreation
		$this->DateCreation = new DbField('Items', 'Items', 'x_DateCreation', 'DateCreation', '[DateCreation]', CastDateFieldForLike("[DateCreation]", 0, "DB"), 135, 8, 0, FALSE, '[DateCreation]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DateCreation->Sortable = TRUE; // Allow sort
		$this->DateCreation->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['DateCreation'] = &$this->DateCreation;

		// DateLastUpdate
		$this->DateLastUpdate = new DbField('Items', 'Items', 'x_DateLastUpdate', 'DateLastUpdate', '[DateLastUpdate]', CastDateFieldForLike("[DateLastUpdate]", 0, "DB"), 135, 8, 0, FALSE, '[DateLastUpdate]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DateLastUpdate->Sortable = TRUE; // Allow sort
		$this->DateLastUpdate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['DateLastUpdate'] = &$this->DateLastUpdate;

		// Nombre
		$this->Nombre = new DbField('Items', 'Items', 'x_Nombre', 'Nombre', '[Nombre]', '[Nombre]', 202, 50, -1, FALSE, '[Nombre]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Nombre->Sortable = TRUE; // Allow sort
		$this->fields['Nombre'] = &$this->Nombre;

		// Precio
		$this->Precio = new DbField('Items', 'Items', 'x_Precio', 'Precio', '[Precio]', 'CAST([Precio] AS NVARCHAR)', 6, 8, -1, FALSE, '[Precio]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Precio->Sortable = TRUE; // Allow sort
		$this->Precio->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Precio'] = &$this->Precio;

		// Active
		$this->Active = new DbField('Items', 'Items', 'x_Active', 'Active', '[Active]', 'CAST([Active] AS NVARCHAR)', 3, 4, -1, FALSE, '[Active]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->Active->Sortable = TRUE; // Allow sort
		switch ($CurrentLanguage) {
			case "en":
				$this->Active->Lookup = new Lookup('Active', 'Items', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
			default:
				$this->Active->Lookup = new Lookup('Active', 'Items', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
		}
		$this->Active->OptionCount = 2;
		$this->Active->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Active'] = &$this->Active;

		// Stock
		$this->Stock = new DbField('Items', 'Items', 'x_Stock', 'Stock', '[Stock]', 'CAST([Stock] AS NVARCHAR)', 20, 8, -1, FALSE, '[Stock]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Stock->Sortable = TRUE; // Allow sort
		$this->Stock->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Stock'] = &$this->Stock;

		// Img1
		$this->Img1 = new DbField('Items', 'Items', 'x_Img1', 'Img1', '[Img1]', '[Img1]', 202, 80, -1, TRUE, '[Img1]', FALSE, FALSE, FALSE, 'IMAGE', 'FILE');
		$this->Img1->Sortable = TRUE; // Allow sort
		$this->fields['Img1'] = &$this->Img1;

		// Img2
		$this->Img2 = new DbField('Items', 'Items', 'x_Img2', 'Img2', '[Img2]', '[Img2]', 202, 80, -1, TRUE, '[Img2]', FALSE, FALSE, FALSE, 'IMAGE', 'FILE');
		$this->Img2->Sortable = TRUE; // Allow sort
		$this->fields['Img2'] = &$this->Img2;

		// Img3
		$this->Img3 = new DbField('Items', 'Items', 'x_Img3', 'Img3', '[Img3]', '[Img3]', 202, 80, -1, TRUE, '[Img3]', FALSE, FALSE, FALSE, 'IMAGE', 'FILE');
		$this->Img3->Sortable = TRUE; // Allow sort
		$this->fields['Img3'] = &$this->Img3;

		// Img4
		$this->Img4 = new DbField('Items', 'Items', 'x_Img4', 'Img4', '[Img4]', '[Img4]', 202, 80, -1, TRUE, '[Img4]', FALSE, FALSE, FALSE, 'IMAGE', 'FILE');
		$this->Img4->Sortable = TRUE; // Allow sort
		$this->fields['Img4'] = &$this->Img4;

		// Vid1
		$this->Vid1 = new DbField('Items', 'Items', 'x_Vid1', 'Vid1', '[Vid1]', '[Vid1]', 202, 80, -1, TRUE, '[Vid1]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->Vid1->Sortable = TRUE; // Allow sort
		$this->fields['Vid1'] = &$this->Vid1;

		// Vid2
		$this->Vid2 = new DbField('Items', 'Items', 'x_Vid2', 'Vid2', '[Vid2]', '[Vid2]', 202, 80, -1, TRUE, '[Vid2]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->Vid2->Sortable = TRUE; // Allow sort
		$this->fields['Vid2'] = &$this->Vid2;

		// Descripcion
		$this->Descripcion = new DbField('Items', 'Items', 'x_Descripcion', 'Descripcion', '[Descripcion]', '[Descripcion]', 202, 200, -1, FALSE, '[Descripcion]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Descripcion->Sortable = TRUE; // Allow sort
		$this->fields['Descripcion'] = &$this->Descripcion;

		// NombreEN
		$this->NombreEN = new DbField('Items', 'Items', 'x_NombreEN', 'NombreEN', '[NombreEN]', '[NombreEN]', 202, 50, -1, FALSE, '[NombreEN]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->NombreEN->Sortable = TRUE; // Allow sort
		$this->fields['NombreEN'] = &$this->NombreEN;

		// DescripcionEN
		$this->DescripcionEN = new DbField('Items', 'Items', 'x_DescripcionEN', 'DescripcionEN', '[DescripcionEN]', '[DescripcionEN]', 202, 200, -1, FALSE, '[DescripcionEN]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DescripcionEN->Sortable = TRUE; // Allow sort
		$this->fields['DescripcionEN'] = &$this->DescripcionEN;
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

	// Current master table name
	public function getCurrentMasterTable()
	{
		return @$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_MASTER_TABLE")];
	}
	public function setCurrentMasterTable($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_MASTER_TABLE")] = $v;
	}

	// Session master WHERE clause
	public function getMasterFilter()
	{

		// Master filter
		$masterFilter = "";
		if ($this->getCurrentMasterTable() == "Categorias") {
			if ($this->ID_Categorias->getSessionValue() != "")
				$masterFilter .= "[ID]=" . QuotedValue($this->ID_Categorias->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $masterFilter;
	}

	// Session detail WHERE clause
	public function getDetailFilter()
	{

		// Detail filter
		$detailFilter = "";
		if ($this->getCurrentMasterTable() == "Categorias") {
			if ($this->ID_Categorias->getSessionValue() != "")
				$detailFilter .= "[ID_Categorias]=" . QuotedValue($this->ID_Categorias->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_Categorias()
	{
		return "[ID]=@ID@";
	}

	// Detail filter
	public function sqlDetailFilter_Categorias()
	{
		return "[ID_Categorias]=@ID_Categorias@";
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[Items]";
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
		$this->ID_Categorias->DbValue = $row['ID_Categorias'];
		$this->ID_Restaurant->DbValue = $row['ID_Restaurant'];
		$this->DateCreation->DbValue = $row['DateCreation'];
		$this->DateLastUpdate->DbValue = $row['DateLastUpdate'];
		$this->Nombre->DbValue = $row['Nombre'];
		$this->Precio->DbValue = $row['Precio'];
		$this->Active->DbValue = $row['Active'];
		$this->Stock->DbValue = $row['Stock'];
		$this->Img1->Upload->DbValue = $row['Img1'];
		$this->Img2->Upload->DbValue = $row['Img2'];
		$this->Img3->Upload->DbValue = $row['Img3'];
		$this->Img4->Upload->DbValue = $row['Img4'];
		$this->Vid1->Upload->DbValue = $row['Vid1'];
		$this->Vid2->Upload->DbValue = $row['Vid2'];
		$this->Descripcion->DbValue = $row['Descripcion'];
		$this->NombreEN->DbValue = $row['NombreEN'];
		$this->DescripcionEN->DbValue = $row['DescripcionEN'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
		$oldFiles = EmptyValue($row['Img1']) ? [] : [$row['Img1']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->Img1->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->Img1->oldPhysicalUploadPath() . $oldFile);
		}
		$oldFiles = EmptyValue($row['Img2']) ? [] : [$row['Img2']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->Img2->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->Img2->oldPhysicalUploadPath() . $oldFile);
		}
		$oldFiles = EmptyValue($row['Img3']) ? [] : [$row['Img3']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->Img3->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->Img3->oldPhysicalUploadPath() . $oldFile);
		}
		$oldFiles = EmptyValue($row['Img4']) ? [] : [$row['Img4']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->Img4->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->Img4->oldPhysicalUploadPath() . $oldFile);
		}
		$oldFiles = EmptyValue($row['Vid1']) ? [] : [$row['Vid1']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->Vid1->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->Vid1->oldPhysicalUploadPath() . $oldFile);
		}
		$oldFiles = EmptyValue($row['Vid2']) ? [] : [$row['Vid2']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->Vid2->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->Vid2->oldPhysicalUploadPath() . $oldFile);
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
			return "Itemslist.php";
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
		if ($pageName == "Itemsview.php")
			return $Language->phrase("View");
		elseif ($pageName == "Itemsedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "Itemsadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "Itemslist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("Itemsview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("Itemsview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "Itemsadd.php?" . $this->getUrlParm($parm);
		else
			$url = "Itemsadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("Itemsedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("Itemsadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("Itemsdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "Categorias" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_ID=" . urlencode($this->ID_Categorias->CurrentValue);
		}
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
		$this->ID_Categorias->setDbValue($rs->fields('ID_Categorias'));
		$this->ID_Restaurant->setDbValue($rs->fields('ID_Restaurant'));
		$this->DateCreation->setDbValue($rs->fields('DateCreation'));
		$this->DateLastUpdate->setDbValue($rs->fields('DateLastUpdate'));
		$this->Nombre->setDbValue($rs->fields('Nombre'));
		$this->Precio->setDbValue($rs->fields('Precio'));
		$this->Active->setDbValue($rs->fields('Active'));
		$this->Stock->setDbValue($rs->fields('Stock'));
		$this->Img1->Upload->DbValue = $rs->fields('Img1');
		$this->Img2->Upload->DbValue = $rs->fields('Img2');
		$this->Img3->Upload->DbValue = $rs->fields('Img3');
		$this->Img4->Upload->DbValue = $rs->fields('Img4');
		$this->Vid1->Upload->DbValue = $rs->fields('Vid1');
		$this->Vid2->Upload->DbValue = $rs->fields('Vid2');
		$this->Descripcion->setDbValue($rs->fields('Descripcion'));
		$this->NombreEN->setDbValue($rs->fields('NombreEN'));
		$this->DescripcionEN->setDbValue($rs->fields('DescripcionEN'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// ID
		// ID_Categorias
		// ID_Restaurant
		// DateCreation
		// DateLastUpdate
		// Nombre
		// Precio
		// Active
		// Stock
		// Img1
		// Img2
		// Img3
		// Img4
		// Vid1
		// Vid2
		// Descripcion
		// NombreEN
		// DescripcionEN
		// ID

		$this->ID->ViewValue = $this->ID->CurrentValue;
		$this->ID->ViewValue = FormatNumber($this->ID->ViewValue, 0, -2, -2, -2);
		$this->ID->ViewCustomAttributes = "";

		// ID_Categorias
		$curVal = strval($this->ID_Categorias->CurrentValue);
		if ($curVal != "") {
			$this->ID_Categorias->ViewValue = $this->ID_Categorias->lookupCacheOption($curVal);
			if ($this->ID_Categorias->ViewValue === NULL) { // Lookup from database
				$filterWrk = "[ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->ID_Categorias->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->ID_Categorias->ViewValue = $this->ID_Categorias->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ID_Categorias->ViewValue = $this->ID_Categorias->CurrentValue;
				}
			}
		} else {
			$this->ID_Categorias->ViewValue = NULL;
		}
		$this->ID_Categorias->ViewCustomAttributes = "";

		// ID_Restaurant
		$curVal = strval($this->ID_Restaurant->CurrentValue);
		if ($curVal != "") {
			$this->ID_Restaurant->ViewValue = $this->ID_Restaurant->lookupCacheOption($curVal);
			if ($this->ID_Restaurant->ViewValue === NULL) { // Lookup from database
				$filterWrk = "[ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->ID_Restaurant->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->ID_Restaurant->ViewValue = $this->ID_Restaurant->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ID_Restaurant->ViewValue = $this->ID_Restaurant->CurrentValue;
				}
			}
		} else {
			$this->ID_Restaurant->ViewValue = NULL;
		}
		$this->ID_Restaurant->ViewCustomAttributes = "";

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

		// Precio
		$this->Precio->ViewValue = $this->Precio->CurrentValue;
		$this->Precio->ViewValue = FormatNumber($this->Precio->ViewValue, 2, -2, -2, -2);
		$this->Precio->ViewCustomAttributes = "";

		// Active
		if (strval($this->Active->CurrentValue) != "") {
			$this->Active->ViewValue = $this->Active->optionCaption($this->Active->CurrentValue);
		} else {
			$this->Active->ViewValue = NULL;
		}
		$this->Active->ViewCustomAttributes = "";

		// Stock
		$this->Stock->ViewValue = $this->Stock->CurrentValue;
		$this->Stock->ViewValue = FormatNumber($this->Stock->ViewValue, 0, -2, -2, -2);
		$this->Stock->ViewCustomAttributes = "";

		// Img1
		if (!EmptyValue($this->Img1->Upload->DbValue)) {
			$this->Img1->ImageWidth = 0;
			$this->Img1->ImageHeight = 60;
			$this->Img1->ImageAlt = $this->Img1->alt();
			$this->Img1->ViewValue = $this->Img1->Upload->DbValue;
		} else {
			$this->Img1->ViewValue = "";
		}
		$this->Img1->ViewCustomAttributes = "";

		// Img2
		if (!EmptyValue($this->Img2->Upload->DbValue)) {
			$this->Img2->ImageWidth = 0;
			$this->Img2->ImageHeight = 60;
			$this->Img2->ImageAlt = $this->Img2->alt();
			$this->Img2->ViewValue = $this->Img2->Upload->DbValue;
		} else {
			$this->Img2->ViewValue = "";
		}
		$this->Img2->ViewCustomAttributes = "";

		// Img3
		if (!EmptyValue($this->Img3->Upload->DbValue)) {
			$this->Img3->ImageWidth = 0;
			$this->Img3->ImageHeight = 60;
			$this->Img3->ImageAlt = $this->Img3->alt();
			$this->Img3->ViewValue = $this->Img3->Upload->DbValue;
		} else {
			$this->Img3->ViewValue = "";
		}
		$this->Img3->ViewCustomAttributes = "";

		// Img4
		if (!EmptyValue($this->Img4->Upload->DbValue)) {
			$this->Img4->ImageWidth = 0;
			$this->Img4->ImageHeight = 60;
			$this->Img4->ImageAlt = $this->Img4->alt();
			$this->Img4->ViewValue = $this->Img4->Upload->DbValue;
		} else {
			$this->Img4->ViewValue = "";
		}
		$this->Img4->ViewCustomAttributes = "";

		// Vid1
		if (!EmptyValue($this->Vid1->Upload->DbValue)) {
			$this->Vid1->ViewValue = $this->Vid1->Upload->DbValue;
		} else {
			$this->Vid1->ViewValue = "";
		}
		$this->Vid1->ViewCustomAttributes = "";

		// Vid2
		if (!EmptyValue($this->Vid2->Upload->DbValue)) {
			$this->Vid2->ViewValue = $this->Vid2->Upload->DbValue;
		} else {
			$this->Vid2->ViewValue = "";
		}
		$this->Vid2->ViewCustomAttributes = "";

		// Descripcion
		$this->Descripcion->ViewValue = $this->Descripcion->CurrentValue;
		$this->Descripcion->ViewCustomAttributes = "";

		// NombreEN
		$this->NombreEN->ViewValue = $this->NombreEN->CurrentValue;
		$this->NombreEN->ViewCustomAttributes = "";

		// DescripcionEN
		$this->DescripcionEN->ViewValue = $this->DescripcionEN->CurrentValue;
		$this->DescripcionEN->ViewCustomAttributes = "";

		// ID
		$this->ID->LinkCustomAttributes = "";
		$this->ID->HrefValue = "";
		$this->ID->TooltipValue = "";

		// ID_Categorias
		$this->ID_Categorias->LinkCustomAttributes = "";
		$this->ID_Categorias->HrefValue = "";
		$this->ID_Categorias->TooltipValue = "";

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

		// Nombre
		$this->Nombre->LinkCustomAttributes = "";
		$this->Nombre->HrefValue = "";
		$this->Nombre->TooltipValue = "";

		// Precio
		$this->Precio->LinkCustomAttributes = "";
		$this->Precio->HrefValue = "";
		$this->Precio->TooltipValue = "";

		// Active
		$this->Active->LinkCustomAttributes = "";
		$this->Active->HrefValue = "";
		$this->Active->TooltipValue = "";

		// Stock
		$this->Stock->LinkCustomAttributes = "";
		$this->Stock->HrefValue = "";
		$this->Stock->TooltipValue = "";

		// Img1
		$this->Img1->LinkCustomAttributes = "";
		if (!EmptyValue($this->Img1->Upload->DbValue)) {
			$this->Img1->HrefValue = GetFileUploadUrl($this->Img1, $this->Img1->htmlDecode($this->Img1->Upload->DbValue)); // Add prefix/suffix
			$this->Img1->LinkAttrs["target"] = ""; // Add target
			if ($this->isExport())
				$this->Img1->HrefValue = FullUrl($this->Img1->HrefValue, "href");
		} else {
			$this->Img1->HrefValue = "";
		}
		$this->Img1->ExportHrefValue = $this->Img1->UploadPath . $this->Img1->Upload->DbValue;
		$this->Img1->TooltipValue = "";
		if ($this->Img1->UseColorbox) {
			if (EmptyValue($this->Img1->TooltipValue))
				$this->Img1->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
			$this->Img1->LinkAttrs["data-rel"] = "Items_x_Img1";
			$this->Img1->LinkAttrs->appendClass("ew-lightbox");
		}

		// Img2
		$this->Img2->LinkCustomAttributes = "";
		if (!EmptyValue($this->Img2->Upload->DbValue)) {
			$this->Img2->HrefValue = GetFileUploadUrl($this->Img2, $this->Img2->htmlDecode($this->Img2->Upload->DbValue)); // Add prefix/suffix
			$this->Img2->LinkAttrs["target"] = ""; // Add target
			if ($this->isExport())
				$this->Img2->HrefValue = FullUrl($this->Img2->HrefValue, "href");
		} else {
			$this->Img2->HrefValue = "";
		}
		$this->Img2->ExportHrefValue = $this->Img2->UploadPath . $this->Img2->Upload->DbValue;
		$this->Img2->TooltipValue = "";
		if ($this->Img2->UseColorbox) {
			if (EmptyValue($this->Img2->TooltipValue))
				$this->Img2->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
			$this->Img2->LinkAttrs["data-rel"] = "Items_x_Img2";
			$this->Img2->LinkAttrs->appendClass("ew-lightbox");
		}

		// Img3
		$this->Img3->LinkCustomAttributes = "";
		if (!EmptyValue($this->Img3->Upload->DbValue)) {
			$this->Img3->HrefValue = GetFileUploadUrl($this->Img3, $this->Img3->htmlDecode($this->Img3->Upload->DbValue)); // Add prefix/suffix
			$this->Img3->LinkAttrs["target"] = ""; // Add target
			if ($this->isExport())
				$this->Img3->HrefValue = FullUrl($this->Img3->HrefValue, "href");
		} else {
			$this->Img3->HrefValue = "";
		}
		$this->Img3->ExportHrefValue = $this->Img3->UploadPath . $this->Img3->Upload->DbValue;
		$this->Img3->TooltipValue = "";
		if ($this->Img3->UseColorbox) {
			if (EmptyValue($this->Img3->TooltipValue))
				$this->Img3->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
			$this->Img3->LinkAttrs["data-rel"] = "Items_x_Img3";
			$this->Img3->LinkAttrs->appendClass("ew-lightbox");
		}

		// Img4
		$this->Img4->LinkCustomAttributes = "";
		if (!EmptyValue($this->Img4->Upload->DbValue)) {
			$this->Img4->HrefValue = GetFileUploadUrl($this->Img4, $this->Img4->htmlDecode($this->Img4->Upload->DbValue)); // Add prefix/suffix
			$this->Img4->LinkAttrs["target"] = ""; // Add target
			if ($this->isExport())
				$this->Img4->HrefValue = FullUrl($this->Img4->HrefValue, "href");
		} else {
			$this->Img4->HrefValue = "";
		}
		$this->Img4->ExportHrefValue = $this->Img4->UploadPath . $this->Img4->Upload->DbValue;
		$this->Img4->TooltipValue = "";
		if ($this->Img4->UseColorbox) {
			if (EmptyValue($this->Img4->TooltipValue))
				$this->Img4->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
			$this->Img4->LinkAttrs["data-rel"] = "Items_x_Img4";
			$this->Img4->LinkAttrs->appendClass("ew-lightbox");
		}

		// Vid1
		$this->Vid1->LinkCustomAttributes = "";
		$this->Vid1->HrefValue = "";
		$this->Vid1->ExportHrefValue = $this->Vid1->UploadPath . $this->Vid1->Upload->DbValue;
		$this->Vid1->TooltipValue = "";

		// Vid2
		$this->Vid2->LinkCustomAttributes = "";
		$this->Vid2->HrefValue = "";
		$this->Vid2->ExportHrefValue = $this->Vid2->UploadPath . $this->Vid2->Upload->DbValue;
		$this->Vid2->TooltipValue = "";

		// Descripcion
		$this->Descripcion->LinkCustomAttributes = "";
		$this->Descripcion->HrefValue = "";
		$this->Descripcion->TooltipValue = "";

		// NombreEN
		$this->NombreEN->LinkCustomAttributes = "";
		$this->NombreEN->HrefValue = "";
		$this->NombreEN->TooltipValue = "";

		// DescripcionEN
		$this->DescripcionEN->LinkCustomAttributes = "";
		$this->DescripcionEN->HrefValue = "";
		$this->DescripcionEN->TooltipValue = "";

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
		$this->ID->EditValue = FormatNumber($this->ID->EditValue, 0, -2, -2, -2);
		$this->ID->ViewCustomAttributes = "";

		// ID_Categorias
		$this->ID_Categorias->EditAttrs["class"] = "form-control";
		$this->ID_Categorias->EditCustomAttributes = "";
		if ($this->ID_Categorias->getSessionValue() != "") {
			$this->ID_Categorias->CurrentValue = $this->ID_Categorias->getSessionValue();
			$curVal = strval($this->ID_Categorias->CurrentValue);
			if ($curVal != "") {
				$this->ID_Categorias->ViewValue = $this->ID_Categorias->lookupCacheOption($curVal);
				if ($this->ID_Categorias->ViewValue === NULL) { // Lookup from database
					$filterWrk = "[ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ID_Categorias->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ID_Categorias->ViewValue = $this->ID_Categorias->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ID_Categorias->ViewValue = $this->ID_Categorias->CurrentValue;
					}
				}
			} else {
				$this->ID_Categorias->ViewValue = NULL;
			}
			$this->ID_Categorias->ViewCustomAttributes = "";
		} else {
		}

		// ID_Restaurant
		$this->ID_Restaurant->EditAttrs["class"] = "form-control";
		$this->ID_Restaurant->EditCustomAttributes = "";
		if (!$Security->isAdmin() && $Security->isLoggedIn() && !$this->userIDAllow("info")) { // Non system admin
			$this->ID_Restaurant->CurrentValue = CurrentUserID();
			$curVal = strval($this->ID_Restaurant->CurrentValue);
			if ($curVal != "") {
				$this->ID_Restaurant->EditValue = $this->ID_Restaurant->lookupCacheOption($curVal);
				if ($this->ID_Restaurant->EditValue === NULL) { // Lookup from database
					$filterWrk = "[ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ID_Restaurant->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ID_Restaurant->EditValue = $this->ID_Restaurant->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ID_Restaurant->EditValue = $this->ID_Restaurant->CurrentValue;
					}
				}
			} else {
				$this->ID_Restaurant->EditValue = NULL;
			}
			$this->ID_Restaurant->ViewCustomAttributes = "";
		} else {
		}

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

		// Precio
		$this->Precio->EditAttrs["class"] = "form-control";
		$this->Precio->EditCustomAttributes = "";
		$this->Precio->EditValue = $this->Precio->CurrentValue;
		$this->Precio->PlaceHolder = RemoveHtml($this->Precio->caption());
		if (strval($this->Precio->EditValue) != "" && is_numeric($this->Precio->EditValue))
			$this->Precio->EditValue = FormatNumber($this->Precio->EditValue, -2, -2, -2, -2);
		

		// Active
		$this->Active->EditCustomAttributes = "";
		$this->Active->EditValue = $this->Active->options(FALSE);

		// Stock
		$this->Stock->EditAttrs["class"] = "form-control";
		$this->Stock->EditCustomAttributes = "";
		$this->Stock->EditValue = $this->Stock->CurrentValue;
		$this->Stock->PlaceHolder = RemoveHtml($this->Stock->caption());

		// Img1
		$this->Img1->EditAttrs["class"] = "form-control";
		$this->Img1->EditCustomAttributes = "";
		if (!EmptyValue($this->Img1->Upload->DbValue)) {
			$this->Img1->ImageWidth = 0;
			$this->Img1->ImageHeight = 60;
			$this->Img1->ImageAlt = $this->Img1->alt();
			$this->Img1->EditValue = $this->Img1->Upload->DbValue;
		} else {
			$this->Img1->EditValue = "";
		}
		if (!EmptyValue($this->Img1->CurrentValue))
				$this->Img1->Upload->FileName = $this->Img1->CurrentValue;

		// Img2
		$this->Img2->EditAttrs["class"] = "form-control";
		$this->Img2->EditCustomAttributes = "";
		if (!EmptyValue($this->Img2->Upload->DbValue)) {
			$this->Img2->ImageWidth = 0;
			$this->Img2->ImageHeight = 60;
			$this->Img2->ImageAlt = $this->Img2->alt();
			$this->Img2->EditValue = $this->Img2->Upload->DbValue;
		} else {
			$this->Img2->EditValue = "";
		}
		if (!EmptyValue($this->Img2->CurrentValue))
				$this->Img2->Upload->FileName = $this->Img2->CurrentValue;

		// Img3
		$this->Img3->EditAttrs["class"] = "form-control";
		$this->Img3->EditCustomAttributes = "";
		if (!EmptyValue($this->Img3->Upload->DbValue)) {
			$this->Img3->ImageWidth = 0;
			$this->Img3->ImageHeight = 60;
			$this->Img3->ImageAlt = $this->Img3->alt();
			$this->Img3->EditValue = $this->Img3->Upload->DbValue;
		} else {
			$this->Img3->EditValue = "";
		}
		if (!EmptyValue($this->Img3->CurrentValue))
				$this->Img3->Upload->FileName = $this->Img3->CurrentValue;

		// Img4
		$this->Img4->EditAttrs["class"] = "form-control";
		$this->Img4->EditCustomAttributes = "";
		if (!EmptyValue($this->Img4->Upload->DbValue)) {
			$this->Img4->ImageWidth = 0;
			$this->Img4->ImageHeight = 60;
			$this->Img4->ImageAlt = $this->Img4->alt();
			$this->Img4->EditValue = $this->Img4->Upload->DbValue;
		} else {
			$this->Img4->EditValue = "";
		}
		if (!EmptyValue($this->Img4->CurrentValue))
				$this->Img4->Upload->FileName = $this->Img4->CurrentValue;

		// Vid1
		$this->Vid1->EditAttrs["class"] = "form-control";
		$this->Vid1->EditCustomAttributes = "";
		if (!EmptyValue($this->Vid1->Upload->DbValue)) {
			$this->Vid1->EditValue = $this->Vid1->Upload->DbValue;
		} else {
			$this->Vid1->EditValue = "";
		}
		if (!EmptyValue($this->Vid1->CurrentValue))
				$this->Vid1->Upload->FileName = $this->Vid1->CurrentValue;

		// Vid2
		$this->Vid2->EditAttrs["class"] = "form-control";
		$this->Vid2->EditCustomAttributes = "";
		if (!EmptyValue($this->Vid2->Upload->DbValue)) {
			$this->Vid2->EditValue = $this->Vid2->Upload->DbValue;
		} else {
			$this->Vid2->EditValue = "";
		}
		if (!EmptyValue($this->Vid2->CurrentValue))
				$this->Vid2->Upload->FileName = $this->Vid2->CurrentValue;

		// Descripcion
		$this->Descripcion->EditAttrs["class"] = "form-control";
		$this->Descripcion->EditCustomAttributes = "";
		if (!$this->Descripcion->Raw)
			$this->Descripcion->CurrentValue = HtmlDecode($this->Descripcion->CurrentValue);
		$this->Descripcion->EditValue = $this->Descripcion->CurrentValue;
		$this->Descripcion->PlaceHolder = RemoveHtml($this->Descripcion->caption());

		// NombreEN
		$this->NombreEN->EditAttrs["class"] = "form-control";
		$this->NombreEN->EditCustomAttributes = "";
		if (!$this->NombreEN->Raw)
			$this->NombreEN->CurrentValue = HtmlDecode($this->NombreEN->CurrentValue);
		$this->NombreEN->EditValue = $this->NombreEN->CurrentValue;
		$this->NombreEN->PlaceHolder = RemoveHtml($this->NombreEN->caption());

		// DescripcionEN
		$this->DescripcionEN->EditAttrs["class"] = "form-control";
		$this->DescripcionEN->EditCustomAttributes = "";
		if (!$this->DescripcionEN->Raw)
			$this->DescripcionEN->CurrentValue = HtmlDecode($this->DescripcionEN->CurrentValue);
		$this->DescripcionEN->EditValue = $this->DescripcionEN->CurrentValue;
		$this->DescripcionEN->PlaceHolder = RemoveHtml($this->DescripcionEN->caption());

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
					$doc->exportCaption($this->ID_Categorias);
					$doc->exportCaption($this->ID_Restaurant);
					$doc->exportCaption($this->DateCreation);
					$doc->exportCaption($this->DateLastUpdate);
					$doc->exportCaption($this->Nombre);
					$doc->exportCaption($this->Precio);
					$doc->exportCaption($this->Active);
					$doc->exportCaption($this->Stock);
					$doc->exportCaption($this->Img1);
					$doc->exportCaption($this->Img2);
					$doc->exportCaption($this->Img3);
					$doc->exportCaption($this->Img4);
					$doc->exportCaption($this->Vid1);
					$doc->exportCaption($this->Vid2);
					$doc->exportCaption($this->Descripcion);
					$doc->exportCaption($this->NombreEN);
					$doc->exportCaption($this->DescripcionEN);
				} else {
					$doc->exportCaption($this->ID);
					$doc->exportCaption($this->ID_Categorias);
					$doc->exportCaption($this->ID_Restaurant);
					$doc->exportCaption($this->DateCreation);
					$doc->exportCaption($this->DateLastUpdate);
					$doc->exportCaption($this->Nombre);
					$doc->exportCaption($this->Precio);
					$doc->exportCaption($this->Active);
					$doc->exportCaption($this->Stock);
					$doc->exportCaption($this->Img1);
					$doc->exportCaption($this->Img2);
					$doc->exportCaption($this->Img3);
					$doc->exportCaption($this->Img4);
					$doc->exportCaption($this->Vid1);
					$doc->exportCaption($this->Vid2);
					$doc->exportCaption($this->Descripcion);
					$doc->exportCaption($this->NombreEN);
					$doc->exportCaption($this->DescripcionEN);
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
						$doc->exportField($this->ID_Categorias);
						$doc->exportField($this->ID_Restaurant);
						$doc->exportField($this->DateCreation);
						$doc->exportField($this->DateLastUpdate);
						$doc->exportField($this->Nombre);
						$doc->exportField($this->Precio);
						$doc->exportField($this->Active);
						$doc->exportField($this->Stock);
						$doc->exportField($this->Img1);
						$doc->exportField($this->Img2);
						$doc->exportField($this->Img3);
						$doc->exportField($this->Img4);
						$doc->exportField($this->Vid1);
						$doc->exportField($this->Vid2);
						$doc->exportField($this->Descripcion);
						$doc->exportField($this->NombreEN);
						$doc->exportField($this->DescripcionEN);
					} else {
						$doc->exportField($this->ID);
						$doc->exportField($this->ID_Categorias);
						$doc->exportField($this->ID_Restaurant);
						$doc->exportField($this->DateCreation);
						$doc->exportField($this->DateLastUpdate);
						$doc->exportField($this->Nombre);
						$doc->exportField($this->Precio);
						$doc->exportField($this->Active);
						$doc->exportField($this->Stock);
						$doc->exportField($this->Img1);
						$doc->exportField($this->Img2);
						$doc->exportField($this->Img3);
						$doc->exportField($this->Img4);
						$doc->exportField($this->Vid1);
						$doc->exportField($this->Vid2);
						$doc->exportField($this->Descripcion);
						$doc->exportField($this->NombreEN);
						$doc->exportField($this->DescripcionEN);
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
				$filterWrk = '[ID_Restaurant] IN (' . $filterWrk . ')';
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
		$sql = "SELECT " . $masterfld->Expression . " FROM [dbo].[Items]";
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
		if ($fldparm == 'Img1') {
			$fldName = "Img1";
			$fileNameFld = "Img1";
		} elseif ($fldparm == 'Img2') {
			$fldName = "Img2";
			$fileNameFld = "Img2";
		} elseif ($fldparm == 'Img3') {
			$fldName = "Img3";
			$fileNameFld = "Img3";
		} elseif ($fldparm == 'Img4') {
			$fldName = "Img4";
			$fileNameFld = "Img4";
		} elseif ($fldparm == 'Vid1') {
			$fldName = "Vid1";
			$fileNameFld = "Vid1";
		} elseif ($fldparm == 'Vid2') {
			$fldName = "Vid2";
			$fileNameFld = "Vid2";
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