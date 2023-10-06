<?php namespace PHPMaker2020\EATIN_BO; ?>
<?php

/**
 * Table class for ItemxPedido
 */
class ItemxPedido extends DbTable
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
	public $ID_Item;
	public $ID_Restaurant;
	public $ID_Client;
	public $DateCreation;
	public $DateLastUpdate;
	public $Comments;
	public $ID_Pedido;
	public $Compartir;
	public $Cantidad;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'ItemxPedido';
		$this->TableName = 'ItemxPedido';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "[dbo].[ItemxPedido]";
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
		$this->ID = new DbField('ItemxPedido', 'ItemxPedido', 'x_ID', 'ID', '[ID]', 'CAST([ID] AS NVARCHAR)', 20, 8, -1, FALSE, '[ID]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->ID->IsAutoIncrement = TRUE; // Autoincrement field
		$this->ID->IsPrimaryKey = TRUE; // Primary key field
		$this->ID->Nullable = FALSE; // NOT NULL field
		$this->ID->Sortable = TRUE; // Allow sort
		$this->ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ID'] = &$this->ID;

		// ID_Item
		$this->ID_Item = new DbField('ItemxPedido', 'ItemxPedido', 'x_ID_Item', 'ID_Item', '[ID_Item]', 'CAST([ID_Item] AS NVARCHAR)', 20, 8, -1, FALSE, '[ID_Item]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ID_Item->Nullable = FALSE; // NOT NULL field
		$this->ID_Item->Required = TRUE; // Required field
		$this->ID_Item->Sortable = TRUE; // Allow sort
		$this->ID_Item->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ID_Item->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->ID_Item->Lookup = new Lookup('ID_Item', 'Items', FALSE, 'ID', ["Nombre","Precio","",""], [], [], [], [], [], [], '', '');
				break;
			default:
				$this->ID_Item->Lookup = new Lookup('ID_Item', 'Items', FALSE, 'ID', ["Nombre","Precio","",""], [], [], [], [], [], [], '', '');
				break;
		}
		$this->ID_Item->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ID_Item'] = &$this->ID_Item;

		// ID_Restaurant
		$this->ID_Restaurant = new DbField('ItemxPedido', 'ItemxPedido', 'x_ID_Restaurant', 'ID_Restaurant', '[ID_Restaurant]', 'CAST([ID_Restaurant] AS NVARCHAR)', 20, 8, -1, FALSE, '[ID_Restaurant]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ID_Restaurant->Nullable = FALSE; // NOT NULL field
		$this->ID_Restaurant->Required = TRUE; // Required field
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

		// ID_Client
		$this->ID_Client = new DbField('ItemxPedido', 'ItemxPedido', 'x_ID_Client', 'ID_Client', '[ID_Client]', 'CAST([ID_Client] AS NVARCHAR)', 20, 8, -1, FALSE, '[ID_Client]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ID_Client->Nullable = FALSE; // NOT NULL field
		$this->ID_Client->Required = TRUE; // Required field
		$this->ID_Client->Sortable = TRUE; // Allow sort
		$this->ID_Client->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ID_Client->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "en":
				$this->ID_Client->Lookup = new Lookup('ID_Client', 'Client', FALSE, 'ID', ["Email","","",""], [], [], [], [], [], [], '', '');
				break;
			default:
				$this->ID_Client->Lookup = new Lookup('ID_Client', 'Client', FALSE, 'ID', ["Email","","",""], [], [], [], [], [], [], '', '');
				break;
		}
		$this->ID_Client->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ID_Client'] = &$this->ID_Client;

		// DateCreation
		$this->DateCreation = new DbField('ItemxPedido', 'ItemxPedido', 'x_DateCreation', 'DateCreation', '[DateCreation]', CastDateFieldForLike("[DateCreation]", 0, "DB"), 135, 8, 0, FALSE, '[DateCreation]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DateCreation->Sortable = TRUE; // Allow sort
		$this->DateCreation->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['DateCreation'] = &$this->DateCreation;

		// DateLastUpdate
		$this->DateLastUpdate = new DbField('ItemxPedido', 'ItemxPedido', 'x_DateLastUpdate', 'DateLastUpdate', '[DateLastUpdate]', CastDateFieldForLike("[DateLastUpdate]", 0, "DB"), 135, 8, 0, FALSE, '[DateLastUpdate]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DateLastUpdate->Sortable = TRUE; // Allow sort
		$this->DateLastUpdate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['DateLastUpdate'] = &$this->DateLastUpdate;

		// Comments
		$this->Comments = new DbField('ItemxPedido', 'ItemxPedido', 'x_Comments', 'Comments', '[Comments]', '[Comments]', 202, 100, -1, FALSE, '[Comments]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Comments->Sortable = TRUE; // Allow sort
		$this->fields['Comments'] = &$this->Comments;

		// ID_Pedido
		$this->ID_Pedido = new DbField('ItemxPedido', 'ItemxPedido', 'x_ID_Pedido', 'ID_Pedido', '[ID_Pedido]', 'CAST([ID_Pedido] AS NVARCHAR)', 20, 8, -1, FALSE, '[ID_Pedido]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ID_Pedido->IsForeignKey = TRUE; // Foreign key field
		$this->ID_Pedido->Nullable = FALSE; // NOT NULL field
		$this->ID_Pedido->Required = TRUE; // Required field
		$this->ID_Pedido->Sortable = TRUE; // Allow sort
		$this->ID_Pedido->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ID_Pedido'] = &$this->ID_Pedido;

		// Compartir
		$this->Compartir = new DbField('ItemxPedido', 'ItemxPedido', 'x_Compartir', 'Compartir', '[Compartir]', 'CAST([Compartir] AS NVARCHAR)', 3, 4, -1, FALSE, '[Compartir]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->Compartir->Sortable = TRUE; // Allow sort
		switch ($CurrentLanguage) {
			case "en":
				$this->Compartir->Lookup = new Lookup('Compartir', 'ItemxPedido', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
			default:
				$this->Compartir->Lookup = new Lookup('Compartir', 'ItemxPedido', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
		}
		$this->Compartir->OptionCount = 2;
		$this->Compartir->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Compartir'] = &$this->Compartir;

		// Cantidad
		$this->Cantidad = new DbField('ItemxPedido', 'ItemxPedido', 'x_Cantidad', 'Cantidad', '[Cantidad]', 'CAST([Cantidad] AS NVARCHAR)', 3, 4, -1, FALSE, '[Cantidad]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Cantidad->Sortable = TRUE; // Allow sort
		$this->Cantidad->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Cantidad'] = &$this->Cantidad;
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
		if ($this->getCurrentMasterTable() == "Pedido") {
			if ($this->ID_Pedido->getSessionValue() != "")
				$masterFilter .= "[ID]=" . QuotedValue($this->ID_Pedido->getSessionValue(), DATATYPE_NUMBER, "DB");
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
		if ($this->getCurrentMasterTable() == "Pedido") {
			if ($this->ID_Pedido->getSessionValue() != "")
				$detailFilter .= "[ID_Pedido]=" . QuotedValue($this->ID_Pedido->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_Pedido()
	{
		return "[ID]=@ID@";
	}

	// Detail filter
	public function sqlDetailFilter_Pedido()
	{
		return "[ID_Pedido]=@ID_Pedido@";
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[ItemxPedido]";
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
		$this->ID_Item->DbValue = $row['ID_Item'];
		$this->ID_Restaurant->DbValue = $row['ID_Restaurant'];
		$this->ID_Client->DbValue = $row['ID_Client'];
		$this->DateCreation->DbValue = $row['DateCreation'];
		$this->DateLastUpdate->DbValue = $row['DateLastUpdate'];
		$this->Comments->DbValue = $row['Comments'];
		$this->ID_Pedido->DbValue = $row['ID_Pedido'];
		$this->Compartir->DbValue = $row['Compartir'];
		$this->Cantidad->DbValue = $row['Cantidad'];
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
			return "ItemxPedidolist.php";
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
		if ($pageName == "ItemxPedidoview.php")
			return $Language->phrase("View");
		elseif ($pageName == "ItemxPedidoedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "ItemxPedidoadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "ItemxPedidolist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("ItemxPedidoview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("ItemxPedidoview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "ItemxPedidoadd.php?" . $this->getUrlParm($parm);
		else
			$url = "ItemxPedidoadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("ItemxPedidoedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("ItemxPedidoadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("ItemxPedidodelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "Pedido" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_ID=" . urlencode($this->ID_Pedido->CurrentValue);
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
		$this->ID_Item->setDbValue($rs->fields('ID_Item'));
		$this->ID_Restaurant->setDbValue($rs->fields('ID_Restaurant'));
		$this->ID_Client->setDbValue($rs->fields('ID_Client'));
		$this->DateCreation->setDbValue($rs->fields('DateCreation'));
		$this->DateLastUpdate->setDbValue($rs->fields('DateLastUpdate'));
		$this->Comments->setDbValue($rs->fields('Comments'));
		$this->ID_Pedido->setDbValue($rs->fields('ID_Pedido'));
		$this->Compartir->setDbValue($rs->fields('Compartir'));
		$this->Cantidad->setDbValue($rs->fields('Cantidad'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// ID
		// ID_Item
		// ID_Restaurant
		// ID_Client
		// DateCreation
		// DateLastUpdate
		// Comments
		// ID_Pedido
		// Compartir
		// Cantidad
		// ID

		$this->ID->ViewValue = $this->ID->CurrentValue;
		$this->ID->ViewValue = FormatNumber($this->ID->ViewValue, 0, -2, -2, -2);
		$this->ID->ViewCustomAttributes = "";

		// ID_Item
		$curVal = strval($this->ID_Item->CurrentValue);
		if ($curVal != "") {
			$this->ID_Item->ViewValue = $this->ID_Item->lookupCacheOption($curVal);
			if ($this->ID_Item->ViewValue === NULL) { // Lookup from database
				$filterWrk = "[ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->ID_Item->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = FormatNumber($rswrk->fields('df2'), 2, -2, -2, -2);
					$this->ID_Item->ViewValue = $this->ID_Item->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ID_Item->ViewValue = $this->ID_Item->CurrentValue;
				}
			}
		} else {
			$this->ID_Item->ViewValue = NULL;
		}
		$this->ID_Item->ViewCustomAttributes = "";

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

		// ID_Client
		$curVal = strval($this->ID_Client->CurrentValue);
		if ($curVal != "") {
			$this->ID_Client->ViewValue = $this->ID_Client->lookupCacheOption($curVal);
			if ($this->ID_Client->ViewValue === NULL) { // Lookup from database
				$filterWrk = "[ID]" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->ID_Client->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->ID_Client->ViewValue = $this->ID_Client->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ID_Client->ViewValue = $this->ID_Client->CurrentValue;
				}
			}
		} else {
			$this->ID_Client->ViewValue = NULL;
		}
		$this->ID_Client->ViewCustomAttributes = "";

		// DateCreation
		$this->DateCreation->ViewValue = $this->DateCreation->CurrentValue;
		$this->DateCreation->ViewValue = FormatDateTime($this->DateCreation->ViewValue, 0);
		$this->DateCreation->ViewCustomAttributes = "";

		// DateLastUpdate
		$this->DateLastUpdate->ViewValue = $this->DateLastUpdate->CurrentValue;
		$this->DateLastUpdate->ViewValue = FormatDateTime($this->DateLastUpdate->ViewValue, 0);
		$this->DateLastUpdate->ViewCustomAttributes = "";

		// Comments
		$this->Comments->ViewValue = $this->Comments->CurrentValue;
		$this->Comments->ViewCustomAttributes = "";

		// ID_Pedido
		$this->ID_Pedido->ViewValue = $this->ID_Pedido->CurrentValue;
		$this->ID_Pedido->ViewValue = FormatNumber($this->ID_Pedido->ViewValue, 0, -2, -2, -2);
		$this->ID_Pedido->ViewCustomAttributes = "";

		// Compartir
		if (strval($this->Compartir->CurrentValue) != "") {
			$this->Compartir->ViewValue = $this->Compartir->optionCaption($this->Compartir->CurrentValue);
		} else {
			$this->Compartir->ViewValue = NULL;
		}
		$this->Compartir->ViewCustomAttributes = "";

		// Cantidad
		$this->Cantidad->ViewValue = $this->Cantidad->CurrentValue;
		$this->Cantidad->ViewValue = FormatNumber($this->Cantidad->ViewValue, 0, -2, -2, -2);
		$this->Cantidad->ViewCustomAttributes = "";

		// ID
		$this->ID->LinkCustomAttributes = "";
		$this->ID->HrefValue = "";
		$this->ID->TooltipValue = "";

		// ID_Item
		$this->ID_Item->LinkCustomAttributes = "";
		$this->ID_Item->HrefValue = "";
		$this->ID_Item->TooltipValue = "";

		// ID_Restaurant
		$this->ID_Restaurant->LinkCustomAttributes = "";
		$this->ID_Restaurant->HrefValue = "";
		$this->ID_Restaurant->TooltipValue = "";

		// ID_Client
		$this->ID_Client->LinkCustomAttributes = "";
		$this->ID_Client->HrefValue = "";
		$this->ID_Client->TooltipValue = "";

		// DateCreation
		$this->DateCreation->LinkCustomAttributes = "";
		$this->DateCreation->HrefValue = "";
		$this->DateCreation->TooltipValue = "";

		// DateLastUpdate
		$this->DateLastUpdate->LinkCustomAttributes = "";
		$this->DateLastUpdate->HrefValue = "";
		$this->DateLastUpdate->TooltipValue = "";

		// Comments
		$this->Comments->LinkCustomAttributes = "";
		$this->Comments->HrefValue = "";
		$this->Comments->TooltipValue = "";

		// ID_Pedido
		$this->ID_Pedido->LinkCustomAttributes = "";
		$this->ID_Pedido->HrefValue = "";
		$this->ID_Pedido->TooltipValue = "";

		// Compartir
		$this->Compartir->LinkCustomAttributes = "";
		$this->Compartir->HrefValue = "";
		$this->Compartir->TooltipValue = "";

		// Cantidad
		$this->Cantidad->LinkCustomAttributes = "";
		$this->Cantidad->HrefValue = "";
		$this->Cantidad->TooltipValue = "";

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

		// ID_Item
		$this->ID_Item->EditAttrs["class"] = "form-control";
		$this->ID_Item->EditCustomAttributes = "";

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

		// ID_Client
		$this->ID_Client->EditAttrs["class"] = "form-control";
		$this->ID_Client->EditCustomAttributes = "";

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

		// Comments
		$this->Comments->EditAttrs["class"] = "form-control";
		$this->Comments->EditCustomAttributes = "";
		if (!$this->Comments->Raw)
			$this->Comments->CurrentValue = HtmlDecode($this->Comments->CurrentValue);
		$this->Comments->EditValue = $this->Comments->CurrentValue;
		$this->Comments->PlaceHolder = RemoveHtml($this->Comments->caption());

		// ID_Pedido
		$this->ID_Pedido->EditAttrs["class"] = "form-control";
		$this->ID_Pedido->EditCustomAttributes = "";
		if ($this->ID_Pedido->getSessionValue() != "") {
			$this->ID_Pedido->CurrentValue = $this->ID_Pedido->getSessionValue();
			$this->ID_Pedido->ViewValue = $this->ID_Pedido->CurrentValue;
			$this->ID_Pedido->ViewValue = FormatNumber($this->ID_Pedido->ViewValue, 0, -2, -2, -2);
			$this->ID_Pedido->ViewCustomAttributes = "";
		} else {
			$this->ID_Pedido->EditValue = $this->ID_Pedido->CurrentValue;
			$this->ID_Pedido->PlaceHolder = RemoveHtml($this->ID_Pedido->caption());
		}

		// Compartir
		$this->Compartir->EditCustomAttributes = "";
		$this->Compartir->EditValue = $this->Compartir->options(FALSE);

		// Cantidad
		$this->Cantidad->EditAttrs["class"] = "form-control";
		$this->Cantidad->EditCustomAttributes = "";
		$this->Cantidad->EditValue = $this->Cantidad->CurrentValue;
		$this->Cantidad->PlaceHolder = RemoveHtml($this->Cantidad->caption());

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
					$doc->exportCaption($this->ID_Item);
					$doc->exportCaption($this->ID_Restaurant);
					$doc->exportCaption($this->ID_Client);
					$doc->exportCaption($this->DateCreation);
					$doc->exportCaption($this->DateLastUpdate);
					$doc->exportCaption($this->Comments);
					$doc->exportCaption($this->ID_Pedido);
					$doc->exportCaption($this->Compartir);
					$doc->exportCaption($this->Cantidad);
				} else {
					$doc->exportCaption($this->ID);
					$doc->exportCaption($this->ID_Item);
					$doc->exportCaption($this->ID_Restaurant);
					$doc->exportCaption($this->ID_Client);
					$doc->exportCaption($this->DateCreation);
					$doc->exportCaption($this->DateLastUpdate);
					$doc->exportCaption($this->Comments);
					$doc->exportCaption($this->ID_Pedido);
					$doc->exportCaption($this->Compartir);
					$doc->exportCaption($this->Cantidad);
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
						$doc->exportField($this->ID_Item);
						$doc->exportField($this->ID_Restaurant);
						$doc->exportField($this->ID_Client);
						$doc->exportField($this->DateCreation);
						$doc->exportField($this->DateLastUpdate);
						$doc->exportField($this->Comments);
						$doc->exportField($this->ID_Pedido);
						$doc->exportField($this->Compartir);
						$doc->exportField($this->Cantidad);
					} else {
						$doc->exportField($this->ID);
						$doc->exportField($this->ID_Item);
						$doc->exportField($this->ID_Restaurant);
						$doc->exportField($this->ID_Client);
						$doc->exportField($this->DateCreation);
						$doc->exportField($this->DateLastUpdate);
						$doc->exportField($this->Comments);
						$doc->exportField($this->ID_Pedido);
						$doc->exportField($this->Compartir);
						$doc->exportField($this->Cantidad);
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
		$sql = "SELECT " . $masterfld->Expression . " FROM [dbo].[ItemxPedido]";
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