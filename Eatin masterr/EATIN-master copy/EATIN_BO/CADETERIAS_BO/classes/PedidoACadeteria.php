<?php namespace PHPMaker2020\BACKOFFICE_CADETERIAS; ?>
<?php

/**
 * Table class for PedidoACadeteria
 */
class PedidoACadeteria extends DbTable
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
	public $ID_Usuario;
	public $ID_Place1;
	public $ID_Place2;
	public $ID_Cadete;
	public $ID_Status;
	public $InstruccionesPlace1;
	public $InstruccionesPlace2;
	public $Direccionalidad;
	public $RemitoURL;
	public $Place1_Nombre;
	public $Place1_Country;
	public $Place1_UF;
	public $Plate1_Lat;
	public $Place1_Lon;
	public $Place1_Calle;
	public $Place1_Numero;
	public $Place1_Localidad;
	public $Place1_Piso;
	public $Place1_Depto;
	public $Place1_PersonaRecibe;
	public $Place1_PersonaRecibeTelefono;
	public $Place2_Nombre;
	public $Place2_Country;
	public $Place2_UF;
	public $Place2_Lat;
	public $Place2_Lon;
	public $Place2_Calle;
	public $Place2_Numero;
	public $Place2_Localidad;
	public $Place2_Piso;
	public $Place2_Depto;
	public $Place2_PersonaRecibe;
	public $Place2_PersonaRecibeTelefono;
	public $ID_Cadeteria;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'PedidoACadeteria';
		$this->TableName = 'PedidoACadeteria';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "[dbo].[PedidoACadeteria]";
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
		$this->ID = new DbField('PedidoACadeteria', 'PedidoACadeteria', 'x_ID', 'ID', '[ID]', 'CAST([ID] AS NVARCHAR)', 20, 8, -1, FALSE, '[ID]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ID->IsPrimaryKey = TRUE; // Primary key field
		$this->ID->Nullable = FALSE; // NOT NULL field
		$this->ID->Required = TRUE; // Required field
		$this->ID->Sortable = TRUE; // Allow sort
		$this->ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ID'] = &$this->ID;

		// ID_Usuario
		$this->ID_Usuario = new DbField('PedidoACadeteria', 'PedidoACadeteria', 'x_ID_Usuario', 'ID_Usuario', '[ID_Usuario]', 'CAST([ID_Usuario] AS NVARCHAR)', 20, 8, -1, FALSE, '[ID_Usuario]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ID_Usuario->Sortable = TRUE; // Allow sort
		$this->ID_Usuario->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ID_Usuario'] = &$this->ID_Usuario;

		// ID_Place1
		$this->ID_Place1 = new DbField('PedidoACadeteria', 'PedidoACadeteria', 'x_ID_Place1', 'ID_Place1', '[ID_Place1]', 'CAST([ID_Place1] AS NVARCHAR)', 20, 8, -1, FALSE, '[ID_Place1]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ID_Place1->Sortable = TRUE; // Allow sort
		$this->ID_Place1->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ID_Place1'] = &$this->ID_Place1;

		// ID_Place2
		$this->ID_Place2 = new DbField('PedidoACadeteria', 'PedidoACadeteria', 'x_ID_Place2', 'ID_Place2', '[ID_Place2]', 'CAST([ID_Place2] AS NVARCHAR)', 20, 8, -1, FALSE, '[ID_Place2]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ID_Place2->Sortable = TRUE; // Allow sort
		$this->ID_Place2->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ID_Place2'] = &$this->ID_Place2;

		// ID_Cadete
		$this->ID_Cadete = new DbField('PedidoACadeteria', 'PedidoACadeteria', 'x_ID_Cadete', 'ID_Cadete', '[ID_Cadete]', 'CAST([ID_Cadete] AS NVARCHAR)', 20, 8, -1, FALSE, '[ID_Cadete]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ID_Cadete->Sortable = TRUE; // Allow sort
		$this->ID_Cadete->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ID_Cadete'] = &$this->ID_Cadete;

		// ID_Status
		$this->ID_Status = new DbField('PedidoACadeteria', 'PedidoACadeteria', 'x_ID_Status', 'ID_Status', '[ID_Status]', 'CAST([ID_Status] AS NVARCHAR)', 20, 8, -1, FALSE, '[ID_Status]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ID_Status->Sortable = TRUE; // Allow sort
		$this->ID_Status->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ID_Status'] = &$this->ID_Status;

		// InstruccionesPlace1
		$this->InstruccionesPlace1 = new DbField('PedidoACadeteria', 'PedidoACadeteria', 'x_InstruccionesPlace1', 'InstruccionesPlace1', '[InstruccionesPlace1]', '[InstruccionesPlace1]', 202, 400, -1, FALSE, '[InstruccionesPlace1]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->InstruccionesPlace1->Sortable = TRUE; // Allow sort
		$this->fields['InstruccionesPlace1'] = &$this->InstruccionesPlace1;

		// InstruccionesPlace2
		$this->InstruccionesPlace2 = new DbField('PedidoACadeteria', 'PedidoACadeteria', 'x_InstruccionesPlace2', 'InstruccionesPlace2', '[InstruccionesPlace2]', '[InstruccionesPlace2]', 202, 400, -1, FALSE, '[InstruccionesPlace2]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->InstruccionesPlace2->Sortable = TRUE; // Allow sort
		$this->fields['InstruccionesPlace2'] = &$this->InstruccionesPlace2;

		// Direccionalidad
		$this->Direccionalidad = new DbField('PedidoACadeteria', 'PedidoACadeteria', 'x_Direccionalidad', 'Direccionalidad', '[Direccionalidad]', 'CAST([Direccionalidad] AS NVARCHAR)', 3, 4, -1, FALSE, '[Direccionalidad]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Direccionalidad->Sortable = TRUE; // Allow sort
		$this->Direccionalidad->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Direccionalidad'] = &$this->Direccionalidad;

		// RemitoURL
		$this->RemitoURL = new DbField('PedidoACadeteria', 'PedidoACadeteria', 'x_RemitoURL', 'RemitoURL', '[RemitoURL]', '[RemitoURL]', 202, 100, -1, FALSE, '[RemitoURL]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->RemitoURL->Sortable = TRUE; // Allow sort
		$this->fields['RemitoURL'] = &$this->RemitoURL;

		// Place1_Nombre
		$this->Place1_Nombre = new DbField('PedidoACadeteria', 'PedidoACadeteria', 'x_Place1_Nombre', 'Place1_Nombre', '[Place1_Nombre]', '[Place1_Nombre]', 202, 50, -1, FALSE, '[Place1_Nombre]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Place1_Nombre->Sortable = TRUE; // Allow sort
		$this->fields['Place1_Nombre'] = &$this->Place1_Nombre;

		// Place1_Country
		$this->Place1_Country = new DbField('PedidoACadeteria', 'PedidoACadeteria', 'x_Place1_Country', 'Place1_Country', '[Place1_Country]', '[Place1_Country]', 202, 50, -1, FALSE, '[Place1_Country]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Place1_Country->Sortable = TRUE; // Allow sort
		$this->fields['Place1_Country'] = &$this->Place1_Country;

		// Place1_UF
		$this->Place1_UF = new DbField('PedidoACadeteria', 'PedidoACadeteria', 'x_Place1_UF', 'Place1_UF', '[Place1_UF]', '[Place1_UF]', 202, 50, -1, FALSE, '[Place1_UF]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Place1_UF->Sortable = TRUE; // Allow sort
		$this->fields['Place1_UF'] = &$this->Place1_UF;

		// Plate1_Lat
		$this->Plate1_Lat = new DbField('PedidoACadeteria', 'PedidoACadeteria', 'x_Plate1_Lat', 'Plate1_Lat', '[Plate1_Lat]', 'CAST([Plate1_Lat] AS NVARCHAR)', 5, 8, -1, FALSE, '[Plate1_Lat]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Plate1_Lat->Sortable = TRUE; // Allow sort
		$this->Plate1_Lat->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Plate1_Lat'] = &$this->Plate1_Lat;

		// Place1_Lon
		$this->Place1_Lon = new DbField('PedidoACadeteria', 'PedidoACadeteria', 'x_Place1_Lon', 'Place1_Lon', '[Place1_Lon]', 'CAST([Place1_Lon] AS NVARCHAR)', 5, 8, -1, FALSE, '[Place1_Lon]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Place1_Lon->Sortable = TRUE; // Allow sort
		$this->Place1_Lon->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Place1_Lon'] = &$this->Place1_Lon;

		// Place1_Calle
		$this->Place1_Calle = new DbField('PedidoACadeteria', 'PedidoACadeteria', 'x_Place1_Calle', 'Place1_Calle', '[Place1_Calle]', '[Place1_Calle]', 202, 50, -1, FALSE, '[Place1_Calle]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Place1_Calle->Sortable = TRUE; // Allow sort
		$this->fields['Place1_Calle'] = &$this->Place1_Calle;

		// Place1_Numero
		$this->Place1_Numero = new DbField('PedidoACadeteria', 'PedidoACadeteria', 'x_Place1_Numero', 'Place1_Numero', '[Place1_Numero]', '[Place1_Numero]', 202, 50, -1, FALSE, '[Place1_Numero]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Place1_Numero->Sortable = TRUE; // Allow sort
		$this->fields['Place1_Numero'] = &$this->Place1_Numero;

		// Place1_Localidad
		$this->Place1_Localidad = new DbField('PedidoACadeteria', 'PedidoACadeteria', 'x_Place1_Localidad', 'Place1_Localidad', '[Place1_Localidad]', '[Place1_Localidad]', 202, 50, -1, FALSE, '[Place1_Localidad]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Place1_Localidad->Sortable = TRUE; // Allow sort
		$this->fields['Place1_Localidad'] = &$this->Place1_Localidad;

		// Place1_Piso
		$this->Place1_Piso = new DbField('PedidoACadeteria', 'PedidoACadeteria', 'x_Place1_Piso', 'Place1_Piso', '[Place1_Piso]', '[Place1_Piso]', 202, 50, -1, FALSE, '[Place1_Piso]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Place1_Piso->Sortable = TRUE; // Allow sort
		$this->fields['Place1_Piso'] = &$this->Place1_Piso;

		// Place1_Depto
		$this->Place1_Depto = new DbField('PedidoACadeteria', 'PedidoACadeteria', 'x_Place1_Depto', 'Place1_Depto', '[Place1_Depto]', '[Place1_Depto]', 202, 50, -1, FALSE, '[Place1_Depto]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Place1_Depto->Sortable = TRUE; // Allow sort
		$this->fields['Place1_Depto'] = &$this->Place1_Depto;

		// Place1_PersonaRecibe
		$this->Place1_PersonaRecibe = new DbField('PedidoACadeteria', 'PedidoACadeteria', 'x_Place1_PersonaRecibe', 'Place1_PersonaRecibe', '[Place1_PersonaRecibe]', '[Place1_PersonaRecibe]', 202, 50, -1, FALSE, '[Place1_PersonaRecibe]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Place1_PersonaRecibe->Sortable = TRUE; // Allow sort
		$this->fields['Place1_PersonaRecibe'] = &$this->Place1_PersonaRecibe;

		// Place1_PersonaRecibeTelefono
		$this->Place1_PersonaRecibeTelefono = new DbField('PedidoACadeteria', 'PedidoACadeteria', 'x_Place1_PersonaRecibeTelefono', 'Place1_PersonaRecibeTelefono', '[Place1_PersonaRecibeTelefono]', '[Place1_PersonaRecibeTelefono]', 202, 50, -1, FALSE, '[Place1_PersonaRecibeTelefono]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Place1_PersonaRecibeTelefono->Sortable = TRUE; // Allow sort
		$this->fields['Place1_PersonaRecibeTelefono'] = &$this->Place1_PersonaRecibeTelefono;

		// Place2_Nombre
		$this->Place2_Nombre = new DbField('PedidoACadeteria', 'PedidoACadeteria', 'x_Place2_Nombre', 'Place2_Nombre', '[Place2_Nombre]', '[Place2_Nombre]', 202, 50, -1, FALSE, '[Place2_Nombre]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Place2_Nombre->Sortable = TRUE; // Allow sort
		$this->fields['Place2_Nombre'] = &$this->Place2_Nombre;

		// Place2_Country
		$this->Place2_Country = new DbField('PedidoACadeteria', 'PedidoACadeteria', 'x_Place2_Country', 'Place2_Country', '[Place2_Country]', '[Place2_Country]', 202, 50, -1, FALSE, '[Place2_Country]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Place2_Country->Sortable = TRUE; // Allow sort
		$this->fields['Place2_Country'] = &$this->Place2_Country;

		// Place2_UF
		$this->Place2_UF = new DbField('PedidoACadeteria', 'PedidoACadeteria', 'x_Place2_UF', 'Place2_UF', '[Place2_UF]', '[Place2_UF]', 202, 50, -1, FALSE, '[Place2_UF]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Place2_UF->Sortable = TRUE; // Allow sort
		$this->fields['Place2_UF'] = &$this->Place2_UF;

		// Place2_Lat
		$this->Place2_Lat = new DbField('PedidoACadeteria', 'PedidoACadeteria', 'x_Place2_Lat', 'Place2_Lat', '[Place2_Lat]', 'CAST([Place2_Lat] AS NVARCHAR)', 5, 8, -1, FALSE, '[Place2_Lat]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Place2_Lat->Sortable = TRUE; // Allow sort
		$this->Place2_Lat->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Place2_Lat'] = &$this->Place2_Lat;

		// Place2_Lon
		$this->Place2_Lon = new DbField('PedidoACadeteria', 'PedidoACadeteria', 'x_Place2_Lon', 'Place2_Lon', '[Place2_Lon]', 'CAST([Place2_Lon] AS NVARCHAR)', 5, 8, -1, FALSE, '[Place2_Lon]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Place2_Lon->Sortable = TRUE; // Allow sort
		$this->Place2_Lon->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Place2_Lon'] = &$this->Place2_Lon;

		// Place2_Calle
		$this->Place2_Calle = new DbField('PedidoACadeteria', 'PedidoACadeteria', 'x_Place2_Calle', 'Place2_Calle', '[Place2_Calle]', '[Place2_Calle]', 202, 50, -1, FALSE, '[Place2_Calle]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Place2_Calle->Sortable = TRUE; // Allow sort
		$this->fields['Place2_Calle'] = &$this->Place2_Calle;

		// Place2_Numero
		$this->Place2_Numero = new DbField('PedidoACadeteria', 'PedidoACadeteria', 'x_Place2_Numero', 'Place2_Numero', '[Place2_Numero]', '[Place2_Numero]', 202, 50, -1, FALSE, '[Place2_Numero]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Place2_Numero->Sortable = TRUE; // Allow sort
		$this->fields['Place2_Numero'] = &$this->Place2_Numero;

		// Place2_Localidad
		$this->Place2_Localidad = new DbField('PedidoACadeteria', 'PedidoACadeteria', 'x_Place2_Localidad', 'Place2_Localidad', '[Place2_Localidad]', '[Place2_Localidad]', 202, 50, -1, FALSE, '[Place2_Localidad]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Place2_Localidad->Sortable = TRUE; // Allow sort
		$this->fields['Place2_Localidad'] = &$this->Place2_Localidad;

		// Place2_Piso
		$this->Place2_Piso = new DbField('PedidoACadeteria', 'PedidoACadeteria', 'x_Place2_Piso', 'Place2_Piso', '[Place2_Piso]', '[Place2_Piso]', 202, 50, -1, FALSE, '[Place2_Piso]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Place2_Piso->Sortable = TRUE; // Allow sort
		$this->fields['Place2_Piso'] = &$this->Place2_Piso;

		// Place2_Depto
		$this->Place2_Depto = new DbField('PedidoACadeteria', 'PedidoACadeteria', 'x_Place2_Depto', 'Place2_Depto', '[Place2_Depto]', '[Place2_Depto]', 202, 50, -1, FALSE, '[Place2_Depto]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Place2_Depto->Sortable = TRUE; // Allow sort
		$this->fields['Place2_Depto'] = &$this->Place2_Depto;

		// Place2_PersonaRecibe
		$this->Place2_PersonaRecibe = new DbField('PedidoACadeteria', 'PedidoACadeteria', 'x_Place2_PersonaRecibe', 'Place2_PersonaRecibe', '[Place2_PersonaRecibe]', '[Place2_PersonaRecibe]', 202, 50, -1, FALSE, '[Place2_PersonaRecibe]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Place2_PersonaRecibe->Sortable = TRUE; // Allow sort
		$this->fields['Place2_PersonaRecibe'] = &$this->Place2_PersonaRecibe;

		// Place2_PersonaRecibeTelefono
		$this->Place2_PersonaRecibeTelefono = new DbField('PedidoACadeteria', 'PedidoACadeteria', 'x_Place2_PersonaRecibeTelefono', 'Place2_PersonaRecibeTelefono', '[Place2_PersonaRecibeTelefono]', '[Place2_PersonaRecibeTelefono]', 202, 50, -1, FALSE, '[Place2_PersonaRecibeTelefono]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Place2_PersonaRecibeTelefono->Sortable = TRUE; // Allow sort
		$this->fields['Place2_PersonaRecibeTelefono'] = &$this->Place2_PersonaRecibeTelefono;

		// ID_Cadeteria
		$this->ID_Cadeteria = new DbField('PedidoACadeteria', 'PedidoACadeteria', 'x_ID_Cadeteria', 'ID_Cadeteria', '[ID_Cadeteria]', 'CAST([ID_Cadeteria] AS NVARCHAR)', 20, 8, -1, FALSE, '[ID_Cadeteria]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ID_Cadeteria->Sortable = TRUE; // Allow sort
		$this->ID_Cadeteria->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ID_Cadeteria'] = &$this->ID_Cadeteria;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "[dbo].[PedidoACadeteria]";
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
		$this->ID_Usuario->DbValue = $row['ID_Usuario'];
		$this->ID_Place1->DbValue = $row['ID_Place1'];
		$this->ID_Place2->DbValue = $row['ID_Place2'];
		$this->ID_Cadete->DbValue = $row['ID_Cadete'];
		$this->ID_Status->DbValue = $row['ID_Status'];
		$this->InstruccionesPlace1->DbValue = $row['InstruccionesPlace1'];
		$this->InstruccionesPlace2->DbValue = $row['InstruccionesPlace2'];
		$this->Direccionalidad->DbValue = $row['Direccionalidad'];
		$this->RemitoURL->DbValue = $row['RemitoURL'];
		$this->Place1_Nombre->DbValue = $row['Place1_Nombre'];
		$this->Place1_Country->DbValue = $row['Place1_Country'];
		$this->Place1_UF->DbValue = $row['Place1_UF'];
		$this->Plate1_Lat->DbValue = $row['Plate1_Lat'];
		$this->Place1_Lon->DbValue = $row['Place1_Lon'];
		$this->Place1_Calle->DbValue = $row['Place1_Calle'];
		$this->Place1_Numero->DbValue = $row['Place1_Numero'];
		$this->Place1_Localidad->DbValue = $row['Place1_Localidad'];
		$this->Place1_Piso->DbValue = $row['Place1_Piso'];
		$this->Place1_Depto->DbValue = $row['Place1_Depto'];
		$this->Place1_PersonaRecibe->DbValue = $row['Place1_PersonaRecibe'];
		$this->Place1_PersonaRecibeTelefono->DbValue = $row['Place1_PersonaRecibeTelefono'];
		$this->Place2_Nombre->DbValue = $row['Place2_Nombre'];
		$this->Place2_Country->DbValue = $row['Place2_Country'];
		$this->Place2_UF->DbValue = $row['Place2_UF'];
		$this->Place2_Lat->DbValue = $row['Place2_Lat'];
		$this->Place2_Lon->DbValue = $row['Place2_Lon'];
		$this->Place2_Calle->DbValue = $row['Place2_Calle'];
		$this->Place2_Numero->DbValue = $row['Place2_Numero'];
		$this->Place2_Localidad->DbValue = $row['Place2_Localidad'];
		$this->Place2_Piso->DbValue = $row['Place2_Piso'];
		$this->Place2_Depto->DbValue = $row['Place2_Depto'];
		$this->Place2_PersonaRecibe->DbValue = $row['Place2_PersonaRecibe'];
		$this->Place2_PersonaRecibeTelefono->DbValue = $row['Place2_PersonaRecibeTelefono'];
		$this->ID_Cadeteria->DbValue = $row['ID_Cadeteria'];
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
			return "PedidoACadeterialist.php";
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
		if ($pageName == "PedidoACadeteriaview.php")
			return $Language->phrase("View");
		elseif ($pageName == "PedidoACadeteriaedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "PedidoACadeteriaadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "PedidoACadeterialist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("PedidoACadeteriaview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("PedidoACadeteriaview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "PedidoACadeteriaadd.php?" . $this->getUrlParm($parm);
		else
			$url = "PedidoACadeteriaadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("PedidoACadeteriaedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("PedidoACadeteriaadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("PedidoACadeteriadelete.php", $this->getUrlParm());
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
		$this->ID_Usuario->setDbValue($rs->fields('ID_Usuario'));
		$this->ID_Place1->setDbValue($rs->fields('ID_Place1'));
		$this->ID_Place2->setDbValue($rs->fields('ID_Place2'));
		$this->ID_Cadete->setDbValue($rs->fields('ID_Cadete'));
		$this->ID_Status->setDbValue($rs->fields('ID_Status'));
		$this->InstruccionesPlace1->setDbValue($rs->fields('InstruccionesPlace1'));
		$this->InstruccionesPlace2->setDbValue($rs->fields('InstruccionesPlace2'));
		$this->Direccionalidad->setDbValue($rs->fields('Direccionalidad'));
		$this->RemitoURL->setDbValue($rs->fields('RemitoURL'));
		$this->Place1_Nombre->setDbValue($rs->fields('Place1_Nombre'));
		$this->Place1_Country->setDbValue($rs->fields('Place1_Country'));
		$this->Place1_UF->setDbValue($rs->fields('Place1_UF'));
		$this->Plate1_Lat->setDbValue($rs->fields('Plate1_Lat'));
		$this->Place1_Lon->setDbValue($rs->fields('Place1_Lon'));
		$this->Place1_Calle->setDbValue($rs->fields('Place1_Calle'));
		$this->Place1_Numero->setDbValue($rs->fields('Place1_Numero'));
		$this->Place1_Localidad->setDbValue($rs->fields('Place1_Localidad'));
		$this->Place1_Piso->setDbValue($rs->fields('Place1_Piso'));
		$this->Place1_Depto->setDbValue($rs->fields('Place1_Depto'));
		$this->Place1_PersonaRecibe->setDbValue($rs->fields('Place1_PersonaRecibe'));
		$this->Place1_PersonaRecibeTelefono->setDbValue($rs->fields('Place1_PersonaRecibeTelefono'));
		$this->Place2_Nombre->setDbValue($rs->fields('Place2_Nombre'));
		$this->Place2_Country->setDbValue($rs->fields('Place2_Country'));
		$this->Place2_UF->setDbValue($rs->fields('Place2_UF'));
		$this->Place2_Lat->setDbValue($rs->fields('Place2_Lat'));
		$this->Place2_Lon->setDbValue($rs->fields('Place2_Lon'));
		$this->Place2_Calle->setDbValue($rs->fields('Place2_Calle'));
		$this->Place2_Numero->setDbValue($rs->fields('Place2_Numero'));
		$this->Place2_Localidad->setDbValue($rs->fields('Place2_Localidad'));
		$this->Place2_Piso->setDbValue($rs->fields('Place2_Piso'));
		$this->Place2_Depto->setDbValue($rs->fields('Place2_Depto'));
		$this->Place2_PersonaRecibe->setDbValue($rs->fields('Place2_PersonaRecibe'));
		$this->Place2_PersonaRecibeTelefono->setDbValue($rs->fields('Place2_PersonaRecibeTelefono'));
		$this->ID_Cadeteria->setDbValue($rs->fields('ID_Cadeteria'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
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
		$this->ID->PlaceHolder = RemoveHtml($this->ID->caption());

		// ID_Usuario
		$this->ID_Usuario->EditAttrs["class"] = "form-control";
		$this->ID_Usuario->EditCustomAttributes = "";
		$this->ID_Usuario->EditValue = $this->ID_Usuario->CurrentValue;
		$this->ID_Usuario->PlaceHolder = RemoveHtml($this->ID_Usuario->caption());

		// ID_Place1
		$this->ID_Place1->EditAttrs["class"] = "form-control";
		$this->ID_Place1->EditCustomAttributes = "";
		$this->ID_Place1->EditValue = $this->ID_Place1->CurrentValue;
		$this->ID_Place1->PlaceHolder = RemoveHtml($this->ID_Place1->caption());

		// ID_Place2
		$this->ID_Place2->EditAttrs["class"] = "form-control";
		$this->ID_Place2->EditCustomAttributes = "";
		$this->ID_Place2->EditValue = $this->ID_Place2->CurrentValue;
		$this->ID_Place2->PlaceHolder = RemoveHtml($this->ID_Place2->caption());

		// ID_Cadete
		$this->ID_Cadete->EditAttrs["class"] = "form-control";
		$this->ID_Cadete->EditCustomAttributes = "";
		$this->ID_Cadete->EditValue = $this->ID_Cadete->CurrentValue;
		$this->ID_Cadete->PlaceHolder = RemoveHtml($this->ID_Cadete->caption());

		// ID_Status
		$this->ID_Status->EditAttrs["class"] = "form-control";
		$this->ID_Status->EditCustomAttributes = "";
		$this->ID_Status->EditValue = $this->ID_Status->CurrentValue;
		$this->ID_Status->PlaceHolder = RemoveHtml($this->ID_Status->caption());

		// InstruccionesPlace1
		$this->InstruccionesPlace1->EditAttrs["class"] = "form-control";
		$this->InstruccionesPlace1->EditCustomAttributes = "";
		if (!$this->InstruccionesPlace1->Raw)
			$this->InstruccionesPlace1->CurrentValue = HtmlDecode($this->InstruccionesPlace1->CurrentValue);
		$this->InstruccionesPlace1->EditValue = $this->InstruccionesPlace1->CurrentValue;
		$this->InstruccionesPlace1->PlaceHolder = RemoveHtml($this->InstruccionesPlace1->caption());

		// InstruccionesPlace2
		$this->InstruccionesPlace2->EditAttrs["class"] = "form-control";
		$this->InstruccionesPlace2->EditCustomAttributes = "";
		if (!$this->InstruccionesPlace2->Raw)
			$this->InstruccionesPlace2->CurrentValue = HtmlDecode($this->InstruccionesPlace2->CurrentValue);
		$this->InstruccionesPlace2->EditValue = $this->InstruccionesPlace2->CurrentValue;
		$this->InstruccionesPlace2->PlaceHolder = RemoveHtml($this->InstruccionesPlace2->caption());

		// Direccionalidad
		$this->Direccionalidad->EditAttrs["class"] = "form-control";
		$this->Direccionalidad->EditCustomAttributes = "";
		$this->Direccionalidad->EditValue = $this->Direccionalidad->CurrentValue;
		$this->Direccionalidad->PlaceHolder = RemoveHtml($this->Direccionalidad->caption());

		// RemitoURL
		$this->RemitoURL->EditAttrs["class"] = "form-control";
		$this->RemitoURL->EditCustomAttributes = "";
		if (!$this->RemitoURL->Raw)
			$this->RemitoURL->CurrentValue = HtmlDecode($this->RemitoURL->CurrentValue);
		$this->RemitoURL->EditValue = $this->RemitoURL->CurrentValue;
		$this->RemitoURL->PlaceHolder = RemoveHtml($this->RemitoURL->caption());

		// Place1_Nombre
		$this->Place1_Nombre->EditAttrs["class"] = "form-control";
		$this->Place1_Nombre->EditCustomAttributes = "";
		if (!$this->Place1_Nombre->Raw)
			$this->Place1_Nombre->CurrentValue = HtmlDecode($this->Place1_Nombre->CurrentValue);
		$this->Place1_Nombre->EditValue = $this->Place1_Nombre->CurrentValue;
		$this->Place1_Nombre->PlaceHolder = RemoveHtml($this->Place1_Nombre->caption());

		// Place1_Country
		$this->Place1_Country->EditAttrs["class"] = "form-control";
		$this->Place1_Country->EditCustomAttributes = "";
		if (!$this->Place1_Country->Raw)
			$this->Place1_Country->CurrentValue = HtmlDecode($this->Place1_Country->CurrentValue);
		$this->Place1_Country->EditValue = $this->Place1_Country->CurrentValue;
		$this->Place1_Country->PlaceHolder = RemoveHtml($this->Place1_Country->caption());

		// Place1_UF
		$this->Place1_UF->EditAttrs["class"] = "form-control";
		$this->Place1_UF->EditCustomAttributes = "";
		if (!$this->Place1_UF->Raw)
			$this->Place1_UF->CurrentValue = HtmlDecode($this->Place1_UF->CurrentValue);
		$this->Place1_UF->EditValue = $this->Place1_UF->CurrentValue;
		$this->Place1_UF->PlaceHolder = RemoveHtml($this->Place1_UF->caption());

		// Plate1_Lat
		$this->Plate1_Lat->EditAttrs["class"] = "form-control";
		$this->Plate1_Lat->EditCustomAttributes = "";
		$this->Plate1_Lat->EditValue = $this->Plate1_Lat->CurrentValue;
		$this->Plate1_Lat->PlaceHolder = RemoveHtml($this->Plate1_Lat->caption());
		if (strval($this->Plate1_Lat->EditValue) != "" && is_numeric($this->Plate1_Lat->EditValue))
			$this->Plate1_Lat->EditValue = FormatNumber($this->Plate1_Lat->EditValue, -2, -2, -2, -2);
		

		// Place1_Lon
		$this->Place1_Lon->EditAttrs["class"] = "form-control";
		$this->Place1_Lon->EditCustomAttributes = "";
		$this->Place1_Lon->EditValue = $this->Place1_Lon->CurrentValue;
		$this->Place1_Lon->PlaceHolder = RemoveHtml($this->Place1_Lon->caption());
		if (strval($this->Place1_Lon->EditValue) != "" && is_numeric($this->Place1_Lon->EditValue))
			$this->Place1_Lon->EditValue = FormatNumber($this->Place1_Lon->EditValue, -2, -2, -2, -2);
		

		// Place1_Calle
		$this->Place1_Calle->EditAttrs["class"] = "form-control";
		$this->Place1_Calle->EditCustomAttributes = "";
		if (!$this->Place1_Calle->Raw)
			$this->Place1_Calle->CurrentValue = HtmlDecode($this->Place1_Calle->CurrentValue);
		$this->Place1_Calle->EditValue = $this->Place1_Calle->CurrentValue;
		$this->Place1_Calle->PlaceHolder = RemoveHtml($this->Place1_Calle->caption());

		// Place1_Numero
		$this->Place1_Numero->EditAttrs["class"] = "form-control";
		$this->Place1_Numero->EditCustomAttributes = "";
		if (!$this->Place1_Numero->Raw)
			$this->Place1_Numero->CurrentValue = HtmlDecode($this->Place1_Numero->CurrentValue);
		$this->Place1_Numero->EditValue = $this->Place1_Numero->CurrentValue;
		$this->Place1_Numero->PlaceHolder = RemoveHtml($this->Place1_Numero->caption());

		// Place1_Localidad
		$this->Place1_Localidad->EditAttrs["class"] = "form-control";
		$this->Place1_Localidad->EditCustomAttributes = "";
		if (!$this->Place1_Localidad->Raw)
			$this->Place1_Localidad->CurrentValue = HtmlDecode($this->Place1_Localidad->CurrentValue);
		$this->Place1_Localidad->EditValue = $this->Place1_Localidad->CurrentValue;
		$this->Place1_Localidad->PlaceHolder = RemoveHtml($this->Place1_Localidad->caption());

		// Place1_Piso
		$this->Place1_Piso->EditAttrs["class"] = "form-control";
		$this->Place1_Piso->EditCustomAttributes = "";
		if (!$this->Place1_Piso->Raw)
			$this->Place1_Piso->CurrentValue = HtmlDecode($this->Place1_Piso->CurrentValue);
		$this->Place1_Piso->EditValue = $this->Place1_Piso->CurrentValue;
		$this->Place1_Piso->PlaceHolder = RemoveHtml($this->Place1_Piso->caption());

		// Place1_Depto
		$this->Place1_Depto->EditAttrs["class"] = "form-control";
		$this->Place1_Depto->EditCustomAttributes = "";
		if (!$this->Place1_Depto->Raw)
			$this->Place1_Depto->CurrentValue = HtmlDecode($this->Place1_Depto->CurrentValue);
		$this->Place1_Depto->EditValue = $this->Place1_Depto->CurrentValue;
		$this->Place1_Depto->PlaceHolder = RemoveHtml($this->Place1_Depto->caption());

		// Place1_PersonaRecibe
		$this->Place1_PersonaRecibe->EditAttrs["class"] = "form-control";
		$this->Place1_PersonaRecibe->EditCustomAttributes = "";
		if (!$this->Place1_PersonaRecibe->Raw)
			$this->Place1_PersonaRecibe->CurrentValue = HtmlDecode($this->Place1_PersonaRecibe->CurrentValue);
		$this->Place1_PersonaRecibe->EditValue = $this->Place1_PersonaRecibe->CurrentValue;
		$this->Place1_PersonaRecibe->PlaceHolder = RemoveHtml($this->Place1_PersonaRecibe->caption());

		// Place1_PersonaRecibeTelefono
		$this->Place1_PersonaRecibeTelefono->EditAttrs["class"] = "form-control";
		$this->Place1_PersonaRecibeTelefono->EditCustomAttributes = "";
		if (!$this->Place1_PersonaRecibeTelefono->Raw)
			$this->Place1_PersonaRecibeTelefono->CurrentValue = HtmlDecode($this->Place1_PersonaRecibeTelefono->CurrentValue);
		$this->Place1_PersonaRecibeTelefono->EditValue = $this->Place1_PersonaRecibeTelefono->CurrentValue;
		$this->Place1_PersonaRecibeTelefono->PlaceHolder = RemoveHtml($this->Place1_PersonaRecibeTelefono->caption());

		// Place2_Nombre
		$this->Place2_Nombre->EditAttrs["class"] = "form-control";
		$this->Place2_Nombre->EditCustomAttributes = "";
		if (!$this->Place2_Nombre->Raw)
			$this->Place2_Nombre->CurrentValue = HtmlDecode($this->Place2_Nombre->CurrentValue);
		$this->Place2_Nombre->EditValue = $this->Place2_Nombre->CurrentValue;
		$this->Place2_Nombre->PlaceHolder = RemoveHtml($this->Place2_Nombre->caption());

		// Place2_Country
		$this->Place2_Country->EditAttrs["class"] = "form-control";
		$this->Place2_Country->EditCustomAttributes = "";
		if (!$this->Place2_Country->Raw)
			$this->Place2_Country->CurrentValue = HtmlDecode($this->Place2_Country->CurrentValue);
		$this->Place2_Country->EditValue = $this->Place2_Country->CurrentValue;
		$this->Place2_Country->PlaceHolder = RemoveHtml($this->Place2_Country->caption());

		// Place2_UF
		$this->Place2_UF->EditAttrs["class"] = "form-control";
		$this->Place2_UF->EditCustomAttributes = "";
		if (!$this->Place2_UF->Raw)
			$this->Place2_UF->CurrentValue = HtmlDecode($this->Place2_UF->CurrentValue);
		$this->Place2_UF->EditValue = $this->Place2_UF->CurrentValue;
		$this->Place2_UF->PlaceHolder = RemoveHtml($this->Place2_UF->caption());

		// Place2_Lat
		$this->Place2_Lat->EditAttrs["class"] = "form-control";
		$this->Place2_Lat->EditCustomAttributes = "";
		$this->Place2_Lat->EditValue = $this->Place2_Lat->CurrentValue;
		$this->Place2_Lat->PlaceHolder = RemoveHtml($this->Place2_Lat->caption());
		if (strval($this->Place2_Lat->EditValue) != "" && is_numeric($this->Place2_Lat->EditValue))
			$this->Place2_Lat->EditValue = FormatNumber($this->Place2_Lat->EditValue, -2, -2, -2, -2);
		

		// Place2_Lon
		$this->Place2_Lon->EditAttrs["class"] = "form-control";
		$this->Place2_Lon->EditCustomAttributes = "";
		$this->Place2_Lon->EditValue = $this->Place2_Lon->CurrentValue;
		$this->Place2_Lon->PlaceHolder = RemoveHtml($this->Place2_Lon->caption());
		if (strval($this->Place2_Lon->EditValue) != "" && is_numeric($this->Place2_Lon->EditValue))
			$this->Place2_Lon->EditValue = FormatNumber($this->Place2_Lon->EditValue, -2, -2, -2, -2);
		

		// Place2_Calle
		$this->Place2_Calle->EditAttrs["class"] = "form-control";
		$this->Place2_Calle->EditCustomAttributes = "";
		if (!$this->Place2_Calle->Raw)
			$this->Place2_Calle->CurrentValue = HtmlDecode($this->Place2_Calle->CurrentValue);
		$this->Place2_Calle->EditValue = $this->Place2_Calle->CurrentValue;
		$this->Place2_Calle->PlaceHolder = RemoveHtml($this->Place2_Calle->caption());

		// Place2_Numero
		$this->Place2_Numero->EditAttrs["class"] = "form-control";
		$this->Place2_Numero->EditCustomAttributes = "";
		if (!$this->Place2_Numero->Raw)
			$this->Place2_Numero->CurrentValue = HtmlDecode($this->Place2_Numero->CurrentValue);
		$this->Place2_Numero->EditValue = $this->Place2_Numero->CurrentValue;
		$this->Place2_Numero->PlaceHolder = RemoveHtml($this->Place2_Numero->caption());

		// Place2_Localidad
		$this->Place2_Localidad->EditAttrs["class"] = "form-control";
		$this->Place2_Localidad->EditCustomAttributes = "";
		if (!$this->Place2_Localidad->Raw)
			$this->Place2_Localidad->CurrentValue = HtmlDecode($this->Place2_Localidad->CurrentValue);
		$this->Place2_Localidad->EditValue = $this->Place2_Localidad->CurrentValue;
		$this->Place2_Localidad->PlaceHolder = RemoveHtml($this->Place2_Localidad->caption());

		// Place2_Piso
		$this->Place2_Piso->EditAttrs["class"] = "form-control";
		$this->Place2_Piso->EditCustomAttributes = "";
		if (!$this->Place2_Piso->Raw)
			$this->Place2_Piso->CurrentValue = HtmlDecode($this->Place2_Piso->CurrentValue);
		$this->Place2_Piso->EditValue = $this->Place2_Piso->CurrentValue;
		$this->Place2_Piso->PlaceHolder = RemoveHtml($this->Place2_Piso->caption());

		// Place2_Depto
		$this->Place2_Depto->EditAttrs["class"] = "form-control";
		$this->Place2_Depto->EditCustomAttributes = "";
		if (!$this->Place2_Depto->Raw)
			$this->Place2_Depto->CurrentValue = HtmlDecode($this->Place2_Depto->CurrentValue);
		$this->Place2_Depto->EditValue = $this->Place2_Depto->CurrentValue;
		$this->Place2_Depto->PlaceHolder = RemoveHtml($this->Place2_Depto->caption());

		// Place2_PersonaRecibe
		$this->Place2_PersonaRecibe->EditAttrs["class"] = "form-control";
		$this->Place2_PersonaRecibe->EditCustomAttributes = "";
		if (!$this->Place2_PersonaRecibe->Raw)
			$this->Place2_PersonaRecibe->CurrentValue = HtmlDecode($this->Place2_PersonaRecibe->CurrentValue);
		$this->Place2_PersonaRecibe->EditValue = $this->Place2_PersonaRecibe->CurrentValue;
		$this->Place2_PersonaRecibe->PlaceHolder = RemoveHtml($this->Place2_PersonaRecibe->caption());

		// Place2_PersonaRecibeTelefono
		$this->Place2_PersonaRecibeTelefono->EditAttrs["class"] = "form-control";
		$this->Place2_PersonaRecibeTelefono->EditCustomAttributes = "";
		if (!$this->Place2_PersonaRecibeTelefono->Raw)
			$this->Place2_PersonaRecibeTelefono->CurrentValue = HtmlDecode($this->Place2_PersonaRecibeTelefono->CurrentValue);
		$this->Place2_PersonaRecibeTelefono->EditValue = $this->Place2_PersonaRecibeTelefono->CurrentValue;
		$this->Place2_PersonaRecibeTelefono->PlaceHolder = RemoveHtml($this->Place2_PersonaRecibeTelefono->caption());

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
					$doc->exportCaption($this->ID_Usuario);
					$doc->exportCaption($this->ID_Place1);
					$doc->exportCaption($this->ID_Place2);
					$doc->exportCaption($this->ID_Cadete);
					$doc->exportCaption($this->ID_Status);
					$doc->exportCaption($this->InstruccionesPlace1);
					$doc->exportCaption($this->InstruccionesPlace2);
					$doc->exportCaption($this->Direccionalidad);
					$doc->exportCaption($this->RemitoURL);
					$doc->exportCaption($this->Place1_Nombre);
					$doc->exportCaption($this->Place1_Country);
					$doc->exportCaption($this->Place1_UF);
					$doc->exportCaption($this->Plate1_Lat);
					$doc->exportCaption($this->Place1_Lon);
					$doc->exportCaption($this->Place1_Calle);
					$doc->exportCaption($this->Place1_Numero);
					$doc->exportCaption($this->Place1_Localidad);
					$doc->exportCaption($this->Place1_Piso);
					$doc->exportCaption($this->Place1_Depto);
					$doc->exportCaption($this->Place1_PersonaRecibe);
					$doc->exportCaption($this->Place1_PersonaRecibeTelefono);
					$doc->exportCaption($this->Place2_Nombre);
					$doc->exportCaption($this->Place2_Country);
					$doc->exportCaption($this->Place2_UF);
					$doc->exportCaption($this->Place2_Lat);
					$doc->exportCaption($this->Place2_Lon);
					$doc->exportCaption($this->Place2_Calle);
					$doc->exportCaption($this->Place2_Numero);
					$doc->exportCaption($this->Place2_Localidad);
					$doc->exportCaption($this->Place2_Piso);
					$doc->exportCaption($this->Place2_Depto);
					$doc->exportCaption($this->Place2_PersonaRecibe);
					$doc->exportCaption($this->Place2_PersonaRecibeTelefono);
					$doc->exportCaption($this->ID_Cadeteria);
				} else {
					$doc->exportCaption($this->ID);
					$doc->exportCaption($this->ID_Usuario);
					$doc->exportCaption($this->ID_Place1);
					$doc->exportCaption($this->ID_Place2);
					$doc->exportCaption($this->ID_Cadete);
					$doc->exportCaption($this->ID_Status);
					$doc->exportCaption($this->InstruccionesPlace1);
					$doc->exportCaption($this->InstruccionesPlace2);
					$doc->exportCaption($this->Direccionalidad);
					$doc->exportCaption($this->RemitoURL);
					$doc->exportCaption($this->Place1_Nombre);
					$doc->exportCaption($this->Place1_Country);
					$doc->exportCaption($this->Place1_UF);
					$doc->exportCaption($this->Plate1_Lat);
					$doc->exportCaption($this->Place1_Lon);
					$doc->exportCaption($this->Place1_Calle);
					$doc->exportCaption($this->Place1_Numero);
					$doc->exportCaption($this->Place1_Localidad);
					$doc->exportCaption($this->Place1_Piso);
					$doc->exportCaption($this->Place1_Depto);
					$doc->exportCaption($this->Place1_PersonaRecibe);
					$doc->exportCaption($this->Place1_PersonaRecibeTelefono);
					$doc->exportCaption($this->Place2_Nombre);
					$doc->exportCaption($this->Place2_Country);
					$doc->exportCaption($this->Place2_UF);
					$doc->exportCaption($this->Place2_Lat);
					$doc->exportCaption($this->Place2_Lon);
					$doc->exportCaption($this->Place2_Calle);
					$doc->exportCaption($this->Place2_Numero);
					$doc->exportCaption($this->Place2_Localidad);
					$doc->exportCaption($this->Place2_Piso);
					$doc->exportCaption($this->Place2_Depto);
					$doc->exportCaption($this->Place2_PersonaRecibe);
					$doc->exportCaption($this->Place2_PersonaRecibeTelefono);
					$doc->exportCaption($this->ID_Cadeteria);
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
						$doc->exportField($this->ID_Usuario);
						$doc->exportField($this->ID_Place1);
						$doc->exportField($this->ID_Place2);
						$doc->exportField($this->ID_Cadete);
						$doc->exportField($this->ID_Status);
						$doc->exportField($this->InstruccionesPlace1);
						$doc->exportField($this->InstruccionesPlace2);
						$doc->exportField($this->Direccionalidad);
						$doc->exportField($this->RemitoURL);
						$doc->exportField($this->Place1_Nombre);
						$doc->exportField($this->Place1_Country);
						$doc->exportField($this->Place1_UF);
						$doc->exportField($this->Plate1_Lat);
						$doc->exportField($this->Place1_Lon);
						$doc->exportField($this->Place1_Calle);
						$doc->exportField($this->Place1_Numero);
						$doc->exportField($this->Place1_Localidad);
						$doc->exportField($this->Place1_Piso);
						$doc->exportField($this->Place1_Depto);
						$doc->exportField($this->Place1_PersonaRecibe);
						$doc->exportField($this->Place1_PersonaRecibeTelefono);
						$doc->exportField($this->Place2_Nombre);
						$doc->exportField($this->Place2_Country);
						$doc->exportField($this->Place2_UF);
						$doc->exportField($this->Place2_Lat);
						$doc->exportField($this->Place2_Lon);
						$doc->exportField($this->Place2_Calle);
						$doc->exportField($this->Place2_Numero);
						$doc->exportField($this->Place2_Localidad);
						$doc->exportField($this->Place2_Piso);
						$doc->exportField($this->Place2_Depto);
						$doc->exportField($this->Place2_PersonaRecibe);
						$doc->exportField($this->Place2_PersonaRecibeTelefono);
						$doc->exportField($this->ID_Cadeteria);
					} else {
						$doc->exportField($this->ID);
						$doc->exportField($this->ID_Usuario);
						$doc->exportField($this->ID_Place1);
						$doc->exportField($this->ID_Place2);
						$doc->exportField($this->ID_Cadete);
						$doc->exportField($this->ID_Status);
						$doc->exportField($this->InstruccionesPlace1);
						$doc->exportField($this->InstruccionesPlace2);
						$doc->exportField($this->Direccionalidad);
						$doc->exportField($this->RemitoURL);
						$doc->exportField($this->Place1_Nombre);
						$doc->exportField($this->Place1_Country);
						$doc->exportField($this->Place1_UF);
						$doc->exportField($this->Plate1_Lat);
						$doc->exportField($this->Place1_Lon);
						$doc->exportField($this->Place1_Calle);
						$doc->exportField($this->Place1_Numero);
						$doc->exportField($this->Place1_Localidad);
						$doc->exportField($this->Place1_Piso);
						$doc->exportField($this->Place1_Depto);
						$doc->exportField($this->Place1_PersonaRecibe);
						$doc->exportField($this->Place1_PersonaRecibeTelefono);
						$doc->exportField($this->Place2_Nombre);
						$doc->exportField($this->Place2_Country);
						$doc->exportField($this->Place2_UF);
						$doc->exportField($this->Place2_Lat);
						$doc->exportField($this->Place2_Lon);
						$doc->exportField($this->Place2_Calle);
						$doc->exportField($this->Place2_Numero);
						$doc->exportField($this->Place2_Localidad);
						$doc->exportField($this->Place2_Piso);
						$doc->exportField($this->Place2_Depto);
						$doc->exportField($this->Place2_PersonaRecibe);
						$doc->exportField($this->Place2_PersonaRecibeTelefono);
						$doc->exportField($this->ID_Cadeteria);
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
		$sql = "SELECT " . $masterfld->Expression . " FROM [dbo].[PedidoACadeteria]";
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