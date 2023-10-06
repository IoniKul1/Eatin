<?php namespace PHPMaker2020\BACKOFFICE_CADETERIAS; ?>
<?php

/**
 * Table class for Cadete
 */
class Cadete extends DbTable
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
	public $FechaCreacion;
	public $ID_Cadeteria;
	public $ID_Status;
	public $ID_CurrentStatus;
	public $Nombre;
	public $Apellido;
	public $DNI;
	public $Celular;
	public $Domicilio;
	public $RealLat;
	public $RealLon;
	public $EstimatedLat;
	public $EstimatedLon;
	public $LUDesde;
	public $LUHasta;
	public $MADesde;
	public $MAHasta;
	public $MIEDesde;
	public $MIEHasta;
	public $JUEDesde;
	public $JUEHasta;
	public $VIEDesde;
	public $VIEHasta;
	public $SABDesde;
	public $SABHasta;
	public $DOMDesde;
	public $DOMHasta;
	public $Foto;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'Cadete';
		$this->TableName = 'Cadete';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "[dbo].[Cadete]";
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
		$this->ID = new DbField('Cadete', 'Cadete', 'x_ID', 'ID', '[ID]', 'CAST([ID] AS NVARCHAR)', 20, 8, -1, FALSE, '[ID]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->ID->IsAutoIncrement = TRUE; // Autoincrement field
		$this->ID->IsPrimaryKey = TRUE; // Primary key field
		$this->ID->Nullable = FALSE; // NOT NULL field
		$this->ID->Sortable = TRUE; // Allow sort
		$this->ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ID'] = &$this->ID;

		// FechaCreacion
		$this->FechaCreacion = new DbField('Cadete', 'Cadete', 'x_FechaCreacion', 'FechaCreacion', '[FechaCreacion]', CastDateFieldForLike("[FechaCreacion]", 0, "DB"), 135, 8, 0, FALSE, '[FechaCreacion]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->FechaCreacion->Nullable = FALSE; // NOT NULL field
		$this->FechaCreacion->Required = TRUE; // Required field
		$this->FechaCreacion->Sortable = TRUE; // Allow sort
		$this->FechaCreacion->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['FechaCreacion'] = &$this->FechaCreacion;

		// ID_Cadeteria
		$this->ID_Cadeteria = new DbField('Cadete', 'Cadete', 'x_ID_Cadeteria', 'ID_Cadeteria', '[ID_Cadeteria]', 'CAST([ID_Cadeteria] AS NVARCHAR)', 20, 8, -1, FALSE, '[ID_Cadeteria]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ID_Cadeteria->Nullable = FALSE; // NOT NULL field
		$this->ID_Cadeteria->Required = TRUE; // Required field
		$this->ID_Cadeteria->Sortable = TRUE; // Allow sort
		$this->ID_Cadeteria->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ID_Cadeteria'] = &$this->ID_Cadeteria;

		// ID_Status
		$this->ID_Status = new DbField('Cadete', 'Cadete', 'x_ID_Status', 'ID_Status', '[ID_Status]', 'CAST([ID_Status] AS NVARCHAR)', 20, 8, -1, FALSE, '[ID_Status]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ID_Status->Nullable = FALSE; // NOT NULL field
		$this->ID_Status->Required = TRUE; // Required field
		$this->ID_Status->Sortable = TRUE; // Allow sort
		$this->ID_Status->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ID_Status'] = &$this->ID_Status;

		// ID_CurrentStatus
		$this->ID_CurrentStatus = new DbField('Cadete', 'Cadete', 'x_ID_CurrentStatus', 'ID_CurrentStatus', '[ID_CurrentStatus]', 'CAST([ID_CurrentStatus] AS NVARCHAR)', 20, 8, -1, FALSE, '[ID_CurrentStatus]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ID_CurrentStatus->Nullable = FALSE; // NOT NULL field
		$this->ID_CurrentStatus->Required = TRUE; // Required field
		$this->ID_CurrentStatus->Sortable = TRUE; // Allow sort
		$this->ID_CurrentStatus->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ID_CurrentStatus'] = &$this->ID_CurrentStatus;

		// Nombre
		$this->Nombre = new DbField('Cadete', 'Cadete', 'x_Nombre', 'Nombre', '[Nombre]', '[Nombre]', 202, 50, -1, FALSE, '[Nombre]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Nombre->Nullable = FALSE; // NOT NULL field
		$this->Nombre->Required = TRUE; // Required field
		$this->Nombre->Sortable = TRUE; // Allow sort
		$this->fields['Nombre'] = &$this->Nombre;

		// Apellido
		$this->Apellido = new DbField('Cadete', 'Cadete', 'x_Apellido', 'Apellido', '[Apellido]', '[Apellido]', 202, 50, -1, FALSE, '[Apellido]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Apellido->Nullable = FALSE; // NOT NULL field
		$this->Apellido->Required = TRUE; // Required field
		$this->Apellido->Sortable = TRUE; // Allow sort
		$this->fields['Apellido'] = &$this->Apellido;

		// DNI
		$this->DNI = new DbField('Cadete', 'Cadete', 'x_DNI', 'DNI', '[DNI]', '[DNI]', 202, 50, -1, FALSE, '[DNI]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DNI->Nullable = FALSE; // NOT NULL field
		$this->DNI->Required = TRUE; // Required field
		$this->DNI->Sortable = TRUE; // Allow sort
		$this->fields['DNI'] = &$this->DNI;

		// Celular
		$this->Celular = new DbField('Cadete', 'Cadete', 'x_Celular', 'Celular', '[Celular]', '[Celular]', 202, 50, -1, FALSE, '[Celular]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Celular->Sortable = TRUE; // Allow sort
		$this->fields['Celular'] = &$this->Celular;

		// Domicilio
		$this->Domicilio = new DbField('Cadete', 'Cadete', 'x_Domicilio', 'Domicilio', '[Domicilio]', '[Domicilio]', 202, 100, -1, FALSE, '[Domicilio]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Domicilio->Sortable = TRUE; // Allow sort
		$this->fields['Domicilio'] = &$this->Domicilio;

		// RealLat
		$this->RealLat = new DbField('Cadete', 'Cadete', 'x_RealLat', 'RealLat', '[RealLat]', 'CAST([RealLat] AS NVARCHAR)', 5, 8, -1, FALSE, '[RealLat]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->RealLat->Sortable = TRUE; // Allow sort
		$this->RealLat->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['RealLat'] = &$this->RealLat;

		// RealLon
		$this->RealLon = new DbField('Cadete', 'Cadete', 'x_RealLon', 'RealLon', '[RealLon]', 'CAST([RealLon] AS NVARCHAR)', 5, 8, -1, FALSE, '[RealLon]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->RealLon->Sortable = TRUE; // Allow sort
		$this->RealLon->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['RealLon'] = &$this->RealLon;

		// EstimatedLat
		$this->EstimatedLat = new DbField('Cadete', 'Cadete', 'x_EstimatedLat', 'EstimatedLat', '[EstimatedLat]', 'CAST([EstimatedLat] AS NVARCHAR)', 5, 8, -1, FALSE, '[EstimatedLat]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->EstimatedLat->Sortable = TRUE; // Allow sort
		$this->EstimatedLat->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['EstimatedLat'] = &$this->EstimatedLat;

		// EstimatedLon
		$this->EstimatedLon = new DbField('Cadete', 'Cadete', 'x_EstimatedLon', 'EstimatedLon', '[EstimatedLon]', 'CAST([EstimatedLon] AS NVARCHAR)', 5, 8, -1, FALSE, '[EstimatedLon]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->EstimatedLon->Sortable = TRUE; // Allow sort
		$this->EstimatedLon->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['EstimatedLon'] = &$this->EstimatedLon;

		// LUDesde
		$this->LUDesde = new DbField('Cadete', 'Cadete', 'x_LUDesde', 'LUDesde', '[LUDesde]', CastDateFieldForLike("[LUDesde]", 4, "DB"), 145, 8, 4, FALSE, '[LUDesde]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LUDesde->Sortable = TRUE; // Allow sort
		$this->LUDesde->DefaultErrorMessage = str_replace("%s", $GLOBALS["TIME_SEPARATOR"], $Language->phrase("IncorrectTime"));
		$this->fields['LUDesde'] = &$this->LUDesde;

		// LUHasta
		$this->LUHasta = new DbField('Cadete', 'Cadete', 'x_LUHasta', 'LUHasta', '[LUHasta]', CastDateFieldForLike("[LUHasta]", 4, "DB"), 145, 8, 4, FALSE, '[LUHasta]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LUHasta->Sortable = TRUE; // Allow sort
		$this->LUHasta->DefaultErrorMessage = str_replace("%s", $GLOBALS["TIME_SEPARATOR"], $Language->phrase("IncorrectTime"));
		$this->fields['LUHasta'] = &$this->LUHasta;

		// MADesde
		$this->MADesde = new DbField('Cadete', 'Cadete', 'x_MADesde', 'MADesde', '[MADesde]', CastDateFieldForLike("[MADesde]", 4, "DB"), 145, 8, 4, FALSE, '[MADesde]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->MADesde->Sortable = TRUE; // Allow sort
		$this->MADesde->DefaultErrorMessage = str_replace("%s", $GLOBALS["TIME_SEPARATOR"], $Language->phrase("IncorrectTime"));
		$this->fields['MADesde'] = &$this->MADesde;

		// MAHasta
		$this->MAHasta = new DbField('Cadete', 'Cadete', 'x_MAHasta', 'MAHasta', '[MAHasta]', CastDateFieldForLike("[MAHasta]", 4, "DB"), 145, 8, 4, FALSE, '[MAHasta]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->MAHasta->Sortable = TRUE; // Allow sort
		$this->MAHasta->DefaultErrorMessage = str_replace("%s", $GLOBALS["TIME_SEPARATOR"], $Language->phrase("IncorrectTime"));
		$this->fields['MAHasta'] = &$this->MAHasta;

		// MIEDesde
		$this->MIEDesde = new DbField('Cadete', 'Cadete', 'x_MIEDesde', 'MIEDesde', '[MIEDesde]', CastDateFieldForLike("[MIEDesde]", 4, "DB"), 145, 8, 4, FALSE, '[MIEDesde]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->MIEDesde->Sortable = TRUE; // Allow sort
		$this->MIEDesde->DefaultErrorMessage = str_replace("%s", $GLOBALS["TIME_SEPARATOR"], $Language->phrase("IncorrectTime"));
		$this->fields['MIEDesde'] = &$this->MIEDesde;

		// MIEHasta
		$this->MIEHasta = new DbField('Cadete', 'Cadete', 'x_MIEHasta', 'MIEHasta', '[MIEHasta]', CastDateFieldForLike("[MIEHasta]", 4, "DB"), 145, 8, 4, FALSE, '[MIEHasta]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->MIEHasta->Sortable = TRUE; // Allow sort
		$this->MIEHasta->DefaultErrorMessage = str_replace("%s", $GLOBALS["TIME_SEPARATOR"], $Language->phrase("IncorrectTime"));
		$this->fields['MIEHasta'] = &$this->MIEHasta;

		// JUEDesde
		$this->JUEDesde = new DbField('Cadete', 'Cadete', 'x_JUEDesde', 'JUEDesde', '[JUEDesde]', CastDateFieldForLike("[JUEDesde]", 4, "DB"), 145, 8, 4, FALSE, '[JUEDesde]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->JUEDesde->Sortable = TRUE; // Allow sort
		$this->JUEDesde->DefaultErrorMessage = str_replace("%s", $GLOBALS["TIME_SEPARATOR"], $Language->phrase("IncorrectTime"));
		$this->fields['JUEDesde'] = &$this->JUEDesde;

		// JUEHasta
		$this->JUEHasta = new DbField('Cadete', 'Cadete', 'x_JUEHasta', 'JUEHasta', '[JUEHasta]', CastDateFieldForLike("[JUEHasta]", 4, "DB"), 145, 8, 4, FALSE, '[JUEHasta]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->JUEHasta->Sortable = TRUE; // Allow sort
		$this->JUEHasta->DefaultErrorMessage = str_replace("%s", $GLOBALS["TIME_SEPARATOR"], $Language->phrase("IncorrectTime"));
		$this->fields['JUEHasta'] = &$this->JUEHasta;

		// VIEDesde
		$this->VIEDesde = new DbField('Cadete', 'Cadete', 'x_VIEDesde', 'VIEDesde', '[VIEDesde]', CastDateFieldForLike("[VIEDesde]", 4, "DB"), 145, 8, 4, FALSE, '[VIEDesde]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->VIEDesde->Sortable = TRUE; // Allow sort
		$this->VIEDesde->DefaultErrorMessage = str_replace("%s", $GLOBALS["TIME_SEPARATOR"], $Language->phrase("IncorrectTime"));
		$this->fields['VIEDesde'] = &$this->VIEDesde;

		// VIEHasta
		$this->VIEHasta = new DbField('Cadete', 'Cadete', 'x_VIEHasta', 'VIEHasta', '[VIEHasta]', CastDateFieldForLike("[VIEHasta]", 4, "DB"), 145, 8, 4, FALSE, '[VIEHasta]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->VIEHasta->Sortable = TRUE; // Allow sort
		$this->VIEHasta->DefaultErrorMessage = str_replace("%s", $GLOBALS["TIME_SEPARATOR"], $Language->phrase("IncorrectTime"));
		$this->fields['VIEHasta'] = &$this->VIEHasta;

		// SABDesde
		$this->SABDesde = new DbField('Cadete', 'Cadete', 'x_SABDesde', 'SABDesde', '[SABDesde]', CastDateFieldForLike("[SABDesde]", 4, "DB"), 145, 8, 4, FALSE, '[SABDesde]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->SABDesde->Sortable = TRUE; // Allow sort
		$this->SABDesde->DefaultErrorMessage = str_replace("%s", $GLOBALS["TIME_SEPARATOR"], $Language->phrase("IncorrectTime"));
		$this->fields['SABDesde'] = &$this->SABDesde;

		// SABHasta
		$this->SABHasta = new DbField('Cadete', 'Cadete', 'x_SABHasta', 'SABHasta', '[SABHasta]', CastDateFieldForLike("[SABHasta]", 4, "DB"), 145, 8, 4, FALSE, '[SABHasta]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->SABHasta->Sortable = TRUE; // Allow sort
		$this->SABHasta->DefaultErrorMessage = str_replace("%s", $GLOBALS["TIME_SEPARATOR"], $Language->phrase("IncorrectTime"));
		$this->fields['SABHasta'] = &$this->SABHasta;

		// DOMDesde
		$this->DOMDesde = new DbField('Cadete', 'Cadete', 'x_DOMDesde', 'DOMDesde', '[DOMDesde]', CastDateFieldForLike("[DOMDesde]", 4, "DB"), 145, 8, 4, FALSE, '[DOMDesde]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DOMDesde->Sortable = TRUE; // Allow sort
		$this->DOMDesde->DefaultErrorMessage = str_replace("%s", $GLOBALS["TIME_SEPARATOR"], $Language->phrase("IncorrectTime"));
		$this->fields['DOMDesde'] = &$this->DOMDesde;

		// DOMHasta
		$this->DOMHasta = new DbField('Cadete', 'Cadete', 'x_DOMHasta', 'DOMHasta', '[DOMHasta]', CastDateFieldForLike("[DOMHasta]", 4, "DB"), 145, 8, 4, FALSE, '[DOMHasta]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DOMHasta->Sortable = TRUE; // Allow sort
		$this->DOMHasta->DefaultErrorMessage = str_replace("%s", $GLOBALS["TIME_SEPARATOR"], $Language->phrase("IncorrectTime"));
		$this->fields['DOMHasta'] = &$this->DOMHasta;

		// Foto
		$this->Foto = new DbField('Cadete', 'Cadete', 'x_Foto', 'Foto', '[Foto]', '[Foto]', 202, 100, -1, FALSE, '[Foto]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Foto->Sortable = TRUE; // Allow sort
		$this->fields['Foto'] = &$this->Foto;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[Cadete]";
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
		$this->FechaCreacion->DbValue = $row['FechaCreacion'];
		$this->ID_Cadeteria->DbValue = $row['ID_Cadeteria'];
		$this->ID_Status->DbValue = $row['ID_Status'];
		$this->ID_CurrentStatus->DbValue = $row['ID_CurrentStatus'];
		$this->Nombre->DbValue = $row['Nombre'];
		$this->Apellido->DbValue = $row['Apellido'];
		$this->DNI->DbValue = $row['DNI'];
		$this->Celular->DbValue = $row['Celular'];
		$this->Domicilio->DbValue = $row['Domicilio'];
		$this->RealLat->DbValue = $row['RealLat'];
		$this->RealLon->DbValue = $row['RealLon'];
		$this->EstimatedLat->DbValue = $row['EstimatedLat'];
		$this->EstimatedLon->DbValue = $row['EstimatedLon'];
		$this->LUDesde->DbValue = $row['LUDesde'];
		$this->LUHasta->DbValue = $row['LUHasta'];
		$this->MADesde->DbValue = $row['MADesde'];
		$this->MAHasta->DbValue = $row['MAHasta'];
		$this->MIEDesde->DbValue = $row['MIEDesde'];
		$this->MIEHasta->DbValue = $row['MIEHasta'];
		$this->JUEDesde->DbValue = $row['JUEDesde'];
		$this->JUEHasta->DbValue = $row['JUEHasta'];
		$this->VIEDesde->DbValue = $row['VIEDesde'];
		$this->VIEHasta->DbValue = $row['VIEHasta'];
		$this->SABDesde->DbValue = $row['SABDesde'];
		$this->SABHasta->DbValue = $row['SABHasta'];
		$this->DOMDesde->DbValue = $row['DOMDesde'];
		$this->DOMHasta->DbValue = $row['DOMHasta'];
		$this->Foto->DbValue = $row['Foto'];
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
			return "Cadetelist.php";
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
		if ($pageName == "Cadeteview.php")
			return $Language->phrase("View");
		elseif ($pageName == "Cadeteedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "Cadeteadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "Cadetelist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("Cadeteview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("Cadeteview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "Cadeteadd.php?" . $this->getUrlParm($parm);
		else
			$url = "Cadeteadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("Cadeteedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("Cadeteadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("Cadetedelete.php", $this->getUrlParm());
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
		$this->FechaCreacion->setDbValue($rs->fields('FechaCreacion'));
		$this->ID_Cadeteria->setDbValue($rs->fields('ID_Cadeteria'));
		$this->ID_Status->setDbValue($rs->fields('ID_Status'));
		$this->ID_CurrentStatus->setDbValue($rs->fields('ID_CurrentStatus'));
		$this->Nombre->setDbValue($rs->fields('Nombre'));
		$this->Apellido->setDbValue($rs->fields('Apellido'));
		$this->DNI->setDbValue($rs->fields('DNI'));
		$this->Celular->setDbValue($rs->fields('Celular'));
		$this->Domicilio->setDbValue($rs->fields('Domicilio'));
		$this->RealLat->setDbValue($rs->fields('RealLat'));
		$this->RealLon->setDbValue($rs->fields('RealLon'));
		$this->EstimatedLat->setDbValue($rs->fields('EstimatedLat'));
		$this->EstimatedLon->setDbValue($rs->fields('EstimatedLon'));
		$this->LUDesde->setDbValue($rs->fields('LUDesde'));
		$this->LUHasta->setDbValue($rs->fields('LUHasta'));
		$this->MADesde->setDbValue($rs->fields('MADesde'));
		$this->MAHasta->setDbValue($rs->fields('MAHasta'));
		$this->MIEDesde->setDbValue($rs->fields('MIEDesde'));
		$this->MIEHasta->setDbValue($rs->fields('MIEHasta'));
		$this->JUEDesde->setDbValue($rs->fields('JUEDesde'));
		$this->JUEHasta->setDbValue($rs->fields('JUEHasta'));
		$this->VIEDesde->setDbValue($rs->fields('VIEDesde'));
		$this->VIEHasta->setDbValue($rs->fields('VIEHasta'));
		$this->SABDesde->setDbValue($rs->fields('SABDesde'));
		$this->SABHasta->setDbValue($rs->fields('SABHasta'));
		$this->DOMDesde->setDbValue($rs->fields('DOMDesde'));
		$this->DOMHasta->setDbValue($rs->fields('DOMHasta'));
		$this->Foto->setDbValue($rs->fields('Foto'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
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

		// FechaCreacion
		$this->FechaCreacion->EditAttrs["class"] = "form-control";
		$this->FechaCreacion->EditCustomAttributes = "";
		$this->FechaCreacion->EditValue = FormatDateTime($this->FechaCreacion->CurrentValue, 8);
		$this->FechaCreacion->PlaceHolder = RemoveHtml($this->FechaCreacion->caption());

		// ID_Cadeteria
		$this->ID_Cadeteria->EditAttrs["class"] = "form-control";
		$this->ID_Cadeteria->EditCustomAttributes = "";
		if (!$Security->isAdmin() && $Security->isLoggedIn() && !$this->userIDAllow("info")) { // Non system admin
			$this->ID_Cadeteria->CurrentValue = CurrentUserID();
			$this->ID_Cadeteria->EditValue = $this->ID_Cadeteria->CurrentValue;
			$this->ID_Cadeteria->EditValue = FormatNumber($this->ID_Cadeteria->EditValue, 0, -2, -2, -2);
			$this->ID_Cadeteria->ViewCustomAttributes = "";
		} else {
			$this->ID_Cadeteria->EditValue = $this->ID_Cadeteria->CurrentValue;
			$this->ID_Cadeteria->PlaceHolder = RemoveHtml($this->ID_Cadeteria->caption());
		}

		// ID_Status
		$this->ID_Status->EditAttrs["class"] = "form-control";
		$this->ID_Status->EditCustomAttributes = "";
		$this->ID_Status->EditValue = $this->ID_Status->CurrentValue;
		$this->ID_Status->PlaceHolder = RemoveHtml($this->ID_Status->caption());

		// ID_CurrentStatus
		$this->ID_CurrentStatus->EditAttrs["class"] = "form-control";
		$this->ID_CurrentStatus->EditCustomAttributes = "";
		$this->ID_CurrentStatus->EditValue = $this->ID_CurrentStatus->CurrentValue;
		$this->ID_CurrentStatus->PlaceHolder = RemoveHtml($this->ID_CurrentStatus->caption());

		// Nombre
		$this->Nombre->EditAttrs["class"] = "form-control";
		$this->Nombre->EditCustomAttributes = "";
		if (!$this->Nombre->Raw)
			$this->Nombre->CurrentValue = HtmlDecode($this->Nombre->CurrentValue);
		$this->Nombre->EditValue = $this->Nombre->CurrentValue;
		$this->Nombre->PlaceHolder = RemoveHtml($this->Nombre->caption());

		// Apellido
		$this->Apellido->EditAttrs["class"] = "form-control";
		$this->Apellido->EditCustomAttributes = "";
		if (!$this->Apellido->Raw)
			$this->Apellido->CurrentValue = HtmlDecode($this->Apellido->CurrentValue);
		$this->Apellido->EditValue = $this->Apellido->CurrentValue;
		$this->Apellido->PlaceHolder = RemoveHtml($this->Apellido->caption());

		// DNI
		$this->DNI->EditAttrs["class"] = "form-control";
		$this->DNI->EditCustomAttributes = "";
		if (!$this->DNI->Raw)
			$this->DNI->CurrentValue = HtmlDecode($this->DNI->CurrentValue);
		$this->DNI->EditValue = $this->DNI->CurrentValue;
		$this->DNI->PlaceHolder = RemoveHtml($this->DNI->caption());

		// Celular
		$this->Celular->EditAttrs["class"] = "form-control";
		$this->Celular->EditCustomAttributes = "";
		if (!$this->Celular->Raw)
			$this->Celular->CurrentValue = HtmlDecode($this->Celular->CurrentValue);
		$this->Celular->EditValue = $this->Celular->CurrentValue;
		$this->Celular->PlaceHolder = RemoveHtml($this->Celular->caption());

		// Domicilio
		$this->Domicilio->EditAttrs["class"] = "form-control";
		$this->Domicilio->EditCustomAttributes = "";
		if (!$this->Domicilio->Raw)
			$this->Domicilio->CurrentValue = HtmlDecode($this->Domicilio->CurrentValue);
		$this->Domicilio->EditValue = $this->Domicilio->CurrentValue;
		$this->Domicilio->PlaceHolder = RemoveHtml($this->Domicilio->caption());

		// RealLat
		$this->RealLat->EditAttrs["class"] = "form-control";
		$this->RealLat->EditCustomAttributes = "";
		$this->RealLat->EditValue = $this->RealLat->CurrentValue;
		$this->RealLat->PlaceHolder = RemoveHtml($this->RealLat->caption());
		if (strval($this->RealLat->EditValue) != "" && is_numeric($this->RealLat->EditValue))
			$this->RealLat->EditValue = FormatNumber($this->RealLat->EditValue, -2, -2, -2, -2);
		

		// RealLon
		$this->RealLon->EditAttrs["class"] = "form-control";
		$this->RealLon->EditCustomAttributes = "";
		$this->RealLon->EditValue = $this->RealLon->CurrentValue;
		$this->RealLon->PlaceHolder = RemoveHtml($this->RealLon->caption());
		if (strval($this->RealLon->EditValue) != "" && is_numeric($this->RealLon->EditValue))
			$this->RealLon->EditValue = FormatNumber($this->RealLon->EditValue, -2, -2, -2, -2);
		

		// EstimatedLat
		$this->EstimatedLat->EditAttrs["class"] = "form-control";
		$this->EstimatedLat->EditCustomAttributes = "";
		$this->EstimatedLat->EditValue = $this->EstimatedLat->CurrentValue;
		$this->EstimatedLat->PlaceHolder = RemoveHtml($this->EstimatedLat->caption());
		if (strval($this->EstimatedLat->EditValue) != "" && is_numeric($this->EstimatedLat->EditValue))
			$this->EstimatedLat->EditValue = FormatNumber($this->EstimatedLat->EditValue, -2, -2, -2, -2);
		

		// EstimatedLon
		$this->EstimatedLon->EditAttrs["class"] = "form-control";
		$this->EstimatedLon->EditCustomAttributes = "";
		$this->EstimatedLon->EditValue = $this->EstimatedLon->CurrentValue;
		$this->EstimatedLon->PlaceHolder = RemoveHtml($this->EstimatedLon->caption());
		if (strval($this->EstimatedLon->EditValue) != "" && is_numeric($this->EstimatedLon->EditValue))
			$this->EstimatedLon->EditValue = FormatNumber($this->EstimatedLon->EditValue, -2, -2, -2, -2);
		

		// LUDesde
		$this->LUDesde->EditAttrs["class"] = "form-control";
		$this->LUDesde->EditCustomAttributes = "";
		$this->LUDesde->EditValue = $this->LUDesde->CurrentValue;
		$this->LUDesde->PlaceHolder = RemoveHtml($this->LUDesde->caption());

		// LUHasta
		$this->LUHasta->EditAttrs["class"] = "form-control";
		$this->LUHasta->EditCustomAttributes = "";
		$this->LUHasta->EditValue = $this->LUHasta->CurrentValue;
		$this->LUHasta->PlaceHolder = RemoveHtml($this->LUHasta->caption());

		// MADesde
		$this->MADesde->EditAttrs["class"] = "form-control";
		$this->MADesde->EditCustomAttributes = "";
		$this->MADesde->EditValue = $this->MADesde->CurrentValue;
		$this->MADesde->PlaceHolder = RemoveHtml($this->MADesde->caption());

		// MAHasta
		$this->MAHasta->EditAttrs["class"] = "form-control";
		$this->MAHasta->EditCustomAttributes = "";
		$this->MAHasta->EditValue = $this->MAHasta->CurrentValue;
		$this->MAHasta->PlaceHolder = RemoveHtml($this->MAHasta->caption());

		// MIEDesde
		$this->MIEDesde->EditAttrs["class"] = "form-control";
		$this->MIEDesde->EditCustomAttributes = "";
		$this->MIEDesde->EditValue = $this->MIEDesde->CurrentValue;
		$this->MIEDesde->PlaceHolder = RemoveHtml($this->MIEDesde->caption());

		// MIEHasta
		$this->MIEHasta->EditAttrs["class"] = "form-control";
		$this->MIEHasta->EditCustomAttributes = "";
		$this->MIEHasta->EditValue = $this->MIEHasta->CurrentValue;
		$this->MIEHasta->PlaceHolder = RemoveHtml($this->MIEHasta->caption());

		// JUEDesde
		$this->JUEDesde->EditAttrs["class"] = "form-control";
		$this->JUEDesde->EditCustomAttributes = "";
		$this->JUEDesde->EditValue = $this->JUEDesde->CurrentValue;
		$this->JUEDesde->PlaceHolder = RemoveHtml($this->JUEDesde->caption());

		// JUEHasta
		$this->JUEHasta->EditAttrs["class"] = "form-control";
		$this->JUEHasta->EditCustomAttributes = "";
		$this->JUEHasta->EditValue = $this->JUEHasta->CurrentValue;
		$this->JUEHasta->PlaceHolder = RemoveHtml($this->JUEHasta->caption());

		// VIEDesde
		$this->VIEDesde->EditAttrs["class"] = "form-control";
		$this->VIEDesde->EditCustomAttributes = "";
		$this->VIEDesde->EditValue = $this->VIEDesde->CurrentValue;
		$this->VIEDesde->PlaceHolder = RemoveHtml($this->VIEDesde->caption());

		// VIEHasta
		$this->VIEHasta->EditAttrs["class"] = "form-control";
		$this->VIEHasta->EditCustomAttributes = "";
		$this->VIEHasta->EditValue = $this->VIEHasta->CurrentValue;
		$this->VIEHasta->PlaceHolder = RemoveHtml($this->VIEHasta->caption());

		// SABDesde
		$this->SABDesde->EditAttrs["class"] = "form-control";
		$this->SABDesde->EditCustomAttributes = "";
		$this->SABDesde->EditValue = $this->SABDesde->CurrentValue;
		$this->SABDesde->PlaceHolder = RemoveHtml($this->SABDesde->caption());

		// SABHasta
		$this->SABHasta->EditAttrs["class"] = "form-control";
		$this->SABHasta->EditCustomAttributes = "";
		$this->SABHasta->EditValue = $this->SABHasta->CurrentValue;
		$this->SABHasta->PlaceHolder = RemoveHtml($this->SABHasta->caption());

		// DOMDesde
		$this->DOMDesde->EditAttrs["class"] = "form-control";
		$this->DOMDesde->EditCustomAttributes = "";
		$this->DOMDesde->EditValue = $this->DOMDesde->CurrentValue;
		$this->DOMDesde->PlaceHolder = RemoveHtml($this->DOMDesde->caption());

		// DOMHasta
		$this->DOMHasta->EditAttrs["class"] = "form-control";
		$this->DOMHasta->EditCustomAttributes = "";
		$this->DOMHasta->EditValue = $this->DOMHasta->CurrentValue;
		$this->DOMHasta->PlaceHolder = RemoveHtml($this->DOMHasta->caption());

		// Foto
		$this->Foto->EditAttrs["class"] = "form-control";
		$this->Foto->EditCustomAttributes = "";
		if (!$this->Foto->Raw)
			$this->Foto->CurrentValue = HtmlDecode($this->Foto->CurrentValue);
		$this->Foto->EditValue = $this->Foto->CurrentValue;
		$this->Foto->PlaceHolder = RemoveHtml($this->Foto->caption());

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
					$doc->exportCaption($this->FechaCreacion);
					$doc->exportCaption($this->ID_Cadeteria);
					$doc->exportCaption($this->ID_Status);
					$doc->exportCaption($this->ID_CurrentStatus);
					$doc->exportCaption($this->Nombre);
					$doc->exportCaption($this->Apellido);
					$doc->exportCaption($this->DNI);
					$doc->exportCaption($this->Celular);
					$doc->exportCaption($this->Domicilio);
					$doc->exportCaption($this->RealLat);
					$doc->exportCaption($this->RealLon);
					$doc->exportCaption($this->EstimatedLat);
					$doc->exportCaption($this->EstimatedLon);
					$doc->exportCaption($this->LUDesde);
					$doc->exportCaption($this->LUHasta);
					$doc->exportCaption($this->MADesde);
					$doc->exportCaption($this->MAHasta);
					$doc->exportCaption($this->MIEDesde);
					$doc->exportCaption($this->MIEHasta);
					$doc->exportCaption($this->JUEDesde);
					$doc->exportCaption($this->JUEHasta);
					$doc->exportCaption($this->VIEDesde);
					$doc->exportCaption($this->VIEHasta);
					$doc->exportCaption($this->SABDesde);
					$doc->exportCaption($this->SABHasta);
					$doc->exportCaption($this->DOMDesde);
					$doc->exportCaption($this->DOMHasta);
					$doc->exportCaption($this->Foto);
				} else {
					$doc->exportCaption($this->ID);
					$doc->exportCaption($this->FechaCreacion);
					$doc->exportCaption($this->ID_Cadeteria);
					$doc->exportCaption($this->ID_Status);
					$doc->exportCaption($this->ID_CurrentStatus);
					$doc->exportCaption($this->Nombre);
					$doc->exportCaption($this->Apellido);
					$doc->exportCaption($this->DNI);
					$doc->exportCaption($this->Celular);
					$doc->exportCaption($this->Domicilio);
					$doc->exportCaption($this->RealLat);
					$doc->exportCaption($this->RealLon);
					$doc->exportCaption($this->EstimatedLat);
					$doc->exportCaption($this->EstimatedLon);
					$doc->exportCaption($this->LUDesde);
					$doc->exportCaption($this->LUHasta);
					$doc->exportCaption($this->MADesde);
					$doc->exportCaption($this->MAHasta);
					$doc->exportCaption($this->MIEDesde);
					$doc->exportCaption($this->MIEHasta);
					$doc->exportCaption($this->JUEDesde);
					$doc->exportCaption($this->JUEHasta);
					$doc->exportCaption($this->VIEDesde);
					$doc->exportCaption($this->VIEHasta);
					$doc->exportCaption($this->SABDesde);
					$doc->exportCaption($this->SABHasta);
					$doc->exportCaption($this->DOMDesde);
					$doc->exportCaption($this->DOMHasta);
					$doc->exportCaption($this->Foto);
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
						$doc->exportField($this->FechaCreacion);
						$doc->exportField($this->ID_Cadeteria);
						$doc->exportField($this->ID_Status);
						$doc->exportField($this->ID_CurrentStatus);
						$doc->exportField($this->Nombre);
						$doc->exportField($this->Apellido);
						$doc->exportField($this->DNI);
						$doc->exportField($this->Celular);
						$doc->exportField($this->Domicilio);
						$doc->exportField($this->RealLat);
						$doc->exportField($this->RealLon);
						$doc->exportField($this->EstimatedLat);
						$doc->exportField($this->EstimatedLon);
						$doc->exportField($this->LUDesde);
						$doc->exportField($this->LUHasta);
						$doc->exportField($this->MADesde);
						$doc->exportField($this->MAHasta);
						$doc->exportField($this->MIEDesde);
						$doc->exportField($this->MIEHasta);
						$doc->exportField($this->JUEDesde);
						$doc->exportField($this->JUEHasta);
						$doc->exportField($this->VIEDesde);
						$doc->exportField($this->VIEHasta);
						$doc->exportField($this->SABDesde);
						$doc->exportField($this->SABHasta);
						$doc->exportField($this->DOMDesde);
						$doc->exportField($this->DOMHasta);
						$doc->exportField($this->Foto);
					} else {
						$doc->exportField($this->ID);
						$doc->exportField($this->FechaCreacion);
						$doc->exportField($this->ID_Cadeteria);
						$doc->exportField($this->ID_Status);
						$doc->exportField($this->ID_CurrentStatus);
						$doc->exportField($this->Nombre);
						$doc->exportField($this->Apellido);
						$doc->exportField($this->DNI);
						$doc->exportField($this->Celular);
						$doc->exportField($this->Domicilio);
						$doc->exportField($this->RealLat);
						$doc->exportField($this->RealLon);
						$doc->exportField($this->EstimatedLat);
						$doc->exportField($this->EstimatedLon);
						$doc->exportField($this->LUDesde);
						$doc->exportField($this->LUHasta);
						$doc->exportField($this->MADesde);
						$doc->exportField($this->MAHasta);
						$doc->exportField($this->MIEDesde);
						$doc->exportField($this->MIEHasta);
						$doc->exportField($this->JUEDesde);
						$doc->exportField($this->JUEHasta);
						$doc->exportField($this->VIEDesde);
						$doc->exportField($this->VIEHasta);
						$doc->exportField($this->SABDesde);
						$doc->exportField($this->SABHasta);
						$doc->exportField($this->DOMDesde);
						$doc->exportField($this->DOMHasta);
						$doc->exportField($this->Foto);
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
				$filterWrk = '[ID_Cadeteria] IN (' . $filterWrk . ')';
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
		$sql = "SELECT " . $masterfld->Expression . " FROM [dbo].[Cadete]";
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