USE [master]
GO
/****** Object:  Database [EATIN]    Script Date: 10/07/2020 20:11:46 ******/
CREATE DATABASE [EATIN]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'EATIN', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL11.MSSQLSERVER\MSSQL\DATA\EATIN.mdf' , SIZE = 102400KB , MAXSIZE = UNLIMITED, FILEGROWTH = 1024KB )
 LOG ON 
( NAME = N'EATIN_log', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL11.MSSQLSERVER\MSSQL\DATA\EATIN_log.ldf' , SIZE = 2048KB , MAXSIZE = 2048GB , FILEGROWTH = 100%)
GO
ALTER DATABASE [EATIN] SET COMPATIBILITY_LEVEL = 110
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [EATIN].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [EATIN] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [EATIN] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [EATIN] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [EATIN] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [EATIN] SET ARITHABORT OFF 
GO
ALTER DATABASE [EATIN] SET AUTO_CLOSE OFF 
GO
ALTER DATABASE [EATIN] SET AUTO_CREATE_STATISTICS ON 
GO
ALTER DATABASE [EATIN] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [EATIN] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [EATIN] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [EATIN] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [EATIN] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [EATIN] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [EATIN] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [EATIN] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [EATIN] SET  DISABLE_BROKER 
GO
ALTER DATABASE [EATIN] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [EATIN] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [EATIN] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [EATIN] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [EATIN] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [EATIN] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [EATIN] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [EATIN] SET RECOVERY FULL 
GO
ALTER DATABASE [EATIN] SET  MULTI_USER 
GO
ALTER DATABASE [EATIN] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [EATIN] SET DB_CHAINING OFF 
GO
ALTER DATABASE [EATIN] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [EATIN] SET TARGET_RECOVERY_TIME = 0 SECONDS 
GO
USE [EATIN]
GO
/****** Object:  StoredProcedure [dbo].[__GetSprocParameters]    Script Date: 10/07/2020 20:11:46 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


create procedure [dbo].[__GetSprocParameters]
	@SprocName		varchar(max)
as
BEGIN
	set nocount on;
	SET TRANSACTION ISOLATION LEVEL READ UNCOMMITTED;

	--SELECT * FROM vwCountry
	--return

	-- todos los parametros de cada stored procedure
	SELECT parm.parameter_id as ParameterID, parm.name AS Parameter, parm.is_output as IsOutput, parm.has_default_value as HasDefaultValue, parm.[default_value] as DefaultValue, parm.max_length as DataSize,
	typ.name AS [Type]
	FROM sys.procedures sp
	JOIN sys.parameters parm ON sp.object_id = parm.object_id
	JOIN sys.types typ ON parm.system_type_id = typ.system_type_id
	WHERE sp.schema_id=1 and sp.name = @SprocName and typ.name!='sysname'
	order by parm.parameter_id


end
GO
/****** Object:  StoredProcedure [dbo].[_GenerateSprocsObject]    Script Date: 10/07/2020 20:11:46 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



create procedure [dbo].[_GenerateSprocsObject]
as
begin

	set nocount on;
	
	declare @Name as varchar(100)
	declare @ParametersString as varchar(max)

print 
'{
	'

	declare crs cursor local scroll for select Name from sys.procedures where schema_id=1 and not ([Name] like 'sp_%') and ([Name] like '%[a-z]%' + '[_]%[a-z]') order by [Name]
	open crs
	fetch first from crs into @Name
	while (@@fetch_status=0)
	begin
print '
		"'+ @Name +'":
		{
			"InputParameters": {
'			
			exec _GenerateSprocsObjectsParameters @Name=@Name, @retval=@ParametersString output
print
'				' + @ParametersString
print '			}
		},'
		fetch next from crs into @Name
	end
	close crs
	deallocate crs
print
'	
}';

end


GO
/****** Object:  StoredProcedure [dbo].[_GenerateSprocsObjectsParameters]    Script Date: 10/07/2020 20:11:46 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


create procedure [dbo].[_GenerateSprocsObjectsParameters]
	@Name			varchar(100),
	@retval			varchar(max) output
as
begin

	set nocount on;

	declare @ParameterName as varchar(50)
	declare @Type as varchar(50)
	declare @DataSize as varchar(50)
	declare @str as varchar(max) = ''

	CREATE TABLE #SprocParameters
	(
		ParameterID			VARCHAR(MAX)	null,
		Parameter			VARCHAR(MAX)	null,
		IsOutput			VARCHAR(MAX)	null,
		HasDefaultValue		VARCHAR(MAX)	null,
		DefaultValue		sql_variant		null,
		DataSize			VARCHAR(MAX)	null,
		[Type]				VARCHAR(MAX)	null
	)
	INSERT INTO #SprocParameters
	EXEC dbo.[__GetSprocParameters] @SprocName=@Name

	declare crs cursor local scroll for select Parameter, [Type], DataSize from #SprocParameters
	open crs
	fetch first from crs into @ParameterName, @Type, @DataSize
	while (@@fetch_status=0)
	begin
		set @ParameterName=replace(@ParameterName, '@', '');
		set @str = @str + '"'+ @ParameterName +'": { "Name":"'+  @ParameterName +'", "Type" : "'+ @Type +'", "Size" : "'+ @DataSize +'" },'
		fetch next from crs into @ParameterName, @Type, @DataSize
	end
	if (@str!='')
	begin
		set @str = LEFT(@str, LEN(@str) - 1)
	end

	close crs
	deallocate crs

	set @retval = @str

end

GO
/****** Object:  StoredProcedure [dbo].[Categorias_View]    Script Date: 10/07/2020 20:11:46 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE procedure [dbo].[Categorias_View]
	@ID_Restaurant		bigint
as
begin


	select * from Categorias where ID_Restaurant=@ID_Restaurant


end

GO
/****** Object:  StoredProcedure [dbo].[Checkin_Add]    Script Date: 10/07/2020 20:11:46 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


create procedure [dbo].[Checkin_Add]
	@ID_Client	bigint,
	@ID_Restaurant	bigint
as
begin

	insert into Checkin(ID_Client, ID_Restaurant)
	values(@ID_Client, @ID_Restaurant)

	select * from Checkin where ID=scope_identity()


end

GO
/****** Object:  StoredProcedure [dbo].[Client_GetFromToken]    Script Date: 10/07/2020 20:11:46 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


create procedure [dbo].[Client_GetFromToken]
	@ID_Restaurant		bigint,
	@ClientToken		nvarchar(50)
as
begin

	if (exists (select ID from Client where ID_Restaurant=@ID_Restaurant and ClientToken=@ClientToken)  )
	begin
		select * from Client where ID_Restaurant=@ID_Restaurant and ClientToken=@ClientToken
	end
	else
	begin
		select -1 as ErrorCode
	end


end

GO
/****** Object:  StoredProcedure [dbo].[Client_Login]    Script Date: 10/07/2020 20:11:46 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

create procedure [dbo].[Client_Login]
	@Email			nvarchar(50),
	@Hashpass		nvarchar(50)
as
begin

	if (not exists (select ID from Client where Email=@Email and Hashpass=@Hashpass))
	begin
		select -1 as ErrorCode
		return;
	end

	select * from Client where Email=@Email and Hashpass=@Hashpass


end



GO
/****** Object:  StoredProcedure [dbo].[Client_Register]    Script Date: 10/07/2020 20:11:46 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE procedure [dbo].[Client_Register]
	@ID_Restaurant	bigint,
	@Email		nvarchar(50),
	@Hashpass	nvarchar(50),
	@FirstName	nvarchar(50),
	@LastName	nvarchar(50),
	@Phone		nvarchar(50)
as
begin

	if ( exists (select ID from Client where Email=@Email) )
	begin
		select -1 as ErrorCode
		return;
	end

	insert into Client(Email, Hashpass, FirstName, LastName, Phone, ID_Restaurant)
	values (@Email, @Hashpass, @FirstName, @LastName, @Phone, @ID_Restaurant)
	select * from Client where ID=scope_identity()


end

GO
/****** Object:  StoredProcedure [dbo].[Countries_View]    Script Date: 10/07/2020 20:11:46 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
create procedure [dbo].[Countries_View]
as
begin

	select * from Countries

end

GO
/****** Object:  StoredProcedure [dbo].[Items_View]    Script Date: 10/07/2020 20:11:46 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE procedure [dbo].[Items_View]
	@ID					bigint,
	@ID_Categorias		bigint,
	@ID_Restaurant		bigint
as
begin

	if (@ID is not null)
	begin
		select * from Items where ID=@ID
		return;
	end



	select * from Items where ID_Categorias=@ID_Categorias and ID_Restaurant=@ID_Restaurant


end

GO
/****** Object:  StoredProcedure [dbo].[ItemxPedido_Add]    Script Date: 10/07/2020 20:11:46 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE procedure [dbo].[ItemxPedido_Add]
	@ID_Pedido		bigint,
	@ID_Item		bigint,
	@ID_Restaurant	bigint,
	@ID_Client		bigint,
	@Comments		nvarchar(100),
	@Compartir		int = 0,
	@Cantidad		int
as
begin

	insert into ItemxPedido(ID_Pedido, ID_Item, ID_Restaurant, ID_Client, Comments, Compartir, Cantidad)
	values (@ID_Pedido, @ID_Item, @ID_Restaurant, @ID_Client, @Comments, @Compartir, @Cantidad)

	select * from ItemxPedido where ID=scope_identity()	


end


GO
/****** Object:  StoredProcedure [dbo].[Pedido_Add]    Script Date: 10/07/2020 20:11:46 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


create procedure [dbo].[Pedido_Add]
	@ID_Client		bigint,
	@ID_Status		bigint,
	@ID_Restaurant	bigint,
	@ID_Table		bigint
as
begin

	declare @ID_Pedido as bigint
	insert into Pedido(ID_Client, ID_Status, ID_Restaurant, ID_Table)
	values (@ID_Client, @ID_Status, @ID_Restaurant, @ID_Table)

	set @ID_Pedido = scope_identity()
	select * from Pedido where ID=@ID_Pedido
end


GO
/****** Object:  StoredProcedure [dbo].[Restaurant_View]    Script Date: 10/07/2020 20:11:46 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


create procedure [dbo].[Restaurant_View]
	@ID		bigint
as
begin

	if (@ID is not null)
	begin
		select * from Restaurant where ID=@ID
	end



end

GO
/****** Object:  StoredProcedure [dbo].[State_View]    Script Date: 10/07/2020 20:11:46 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


create procedure [dbo].[State_View]
as
begin

	select * from [State]

end

GO
/****** Object:  StoredProcedure [dbo].[Table_View]    Script Date: 10/07/2020 20:11:46 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE procedure [dbo].[Table_View]
	@ID_Restaurant		bigint,
	@ID					bigint
as
begin

	select * from [Table] where ID_Restaurant=@ID_Restaurant and ID=@ID



end

GO
/****** Object:  Table [dbo].[Categorias]    Script Date: 10/07/2020 20:11:46 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Categorias](
	[ID] [bigint] IDENTITY(1,1) NOT NULL,
	[ID_Restaurant] [bigint] NOT NULL,
	[DateCreation] [datetime] NULL,
	[DateLastUpdate] [datetime] NULL,
	[Active] [int] NULL,
	[Nombre] [nvarchar](50) NOT NULL,
	[NombreEN] [nvarchar](50) NULL,
 CONSTRAINT [PK_Categorias] PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Checkin]    Script Date: 10/07/2020 20:11:46 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Checkin](
	[ID] [bigint] IDENTITY(1,1) NOT NULL,
	[ID_Client] [bigint] NOT NULL,
	[ID_Restaurant] [bigint] NOT NULL,
	[DateCreation] [datetime] NULL,
 CONSTRAINT [PK_Checkin] PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Client]    Script Date: 10/07/2020 20:11:46 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Client](
	[ID] [bigint] IDENTITY(1,1) NOT NULL,
	[ID_Restaurant] [bigint] NULL,
	[DateCreation] [datetime] NULL,
	[DateLastUpdate] [datetime] NULL,
	[Hash] [nvarchar](50) NULL,
	[FirstName] [nvarchar](50) NULL,
	[LastName] [nvarchar](50) NULL,
	[Email] [nvarchar](50) NULL,
	[Hashpass] [nvarchar](50) NULL,
	[Phone] [nvarchar](50) NULL,
	[Banned] [int] NULL,
	[Comments] [ntext] NULL,
	[ClientToken] [nvarchar](50) NULL,
 CONSTRAINT [PK_Client] PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Countries]    Script Date: 10/07/2020 20:11:46 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Countries](
	[ID] [bigint] IDENTITY(1,1) NOT NULL,
	[Name] [nvarchar](50) NOT NULL,
 CONSTRAINT [PK_Countries] PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[ItemOptions]    Script Date: 10/07/2020 20:11:46 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ItemOptions](
	[ID] [bigint] IDENTITY(1,1) NOT NULL,
	[ID_Item] [bigint] NOT NULL,
	[ID_Restaurant] [bigint] NULL,
 CONSTRAINT [PK_ItemOptions] PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Items]    Script Date: 10/07/2020 20:11:46 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Items](
	[ID] [bigint] IDENTITY(1,1) NOT NULL,
	[ID_Categorias] [bigint] NOT NULL,
	[ID_Restaurant] [bigint] NULL,
	[DateCreation] [datetime] NULL,
	[DateLastUpdate] [datetime] NULL,
	[Nombre] [nvarchar](50) NULL,
	[Precio] [money] NULL,
	[Active] [int] NULL,
	[Stock] [bigint] NULL,
	[Img1] [nvarchar](80) NULL,
	[Img2] [nvarchar](80) NULL,
	[Img3] [nvarchar](80) NULL,
	[Img4] [nvarchar](80) NULL,
	[Vid1] [nvarchar](80) NULL,
	[Vid2] [nvarchar](80) NULL,
	[Descripcion] [nvarchar](200) NULL,
	[NombreEN] [nvarchar](50) NULL,
	[DescripcionEN] [nvarchar](200) NULL,
 CONSTRAINT [PK_Items] PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[ItemxPedido]    Script Date: 10/07/2020 20:11:46 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ItemxPedido](
	[ID] [bigint] IDENTITY(1,1) NOT NULL,
	[ID_Item] [bigint] NOT NULL,
	[ID_Pedido] [bigint] NOT NULL,
	[ID_Restaurant] [bigint] NOT NULL,
	[ID_Client] [bigint] NOT NULL,
	[DateCreation] [datetime] NULL,
	[DateLastUpdate] [datetime] NULL,
	[Comments] [nvarchar](100) NULL,
	[Compartir] [int] NULL,
	[Cantidad] [int] NULL,
 CONSTRAINT [PK_ItemxPedido] PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Pedido]    Script Date: 10/07/2020 20:11:46 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Pedido](
	[ID] [bigint] IDENTITY(1,1) NOT NULL,
	[ID_Client] [bigint] NOT NULL,
	[ID_Status] [bigint] NULL,
	[ID_Restaurant] [bigint] NOT NULL,
	[ID_Table] [bigint] NOT NULL,
	[DateCreation] [datetime] NULL,
	[DateLastUpdate] [datetime] NULL,
 CONSTRAINT [PK_Pedido] PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Restaurant]    Script Date: 10/07/2020 20:11:46 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Restaurant](
	[ID] [bigint] IDENTITY(1,1) NOT NULL,
	[ID_State] [bigint] NULL,
	[DateCreation] [datetime] NULL,
	[DateLastUpdate] [datetime] NULL,
	[Nombre] [nvarchar](50) NULL,
	[Lat] [float] NULL,
	[Lon] [float] NULL,
	[GoogleGeocodeAddress] [nvarchar](200) NULL,
	[Address] [nvarchar](200) NULL,
	[Deactivated] [int] NULL,
	[Suspended] [int] NULL,
	[ActualQRGrantCode] [nvarchar](50) NULL,
	[Email] [nvarchar](50) NULL,
	[Password] [nvarchar](50) NULL,
	[SplashImg] [nvarchar](80) NULL,
	[LogoSize1] [nvarchar](80) NULL,
	[LogoSize2] [nvarchar](80) NULL,
	[AppCSS] [nvarchar](80) NULL,
	[SplashVideo] [nvarchar](80) NULL,
 CONSTRAINT [PK_Restaurant] PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[State]    Script Date: 10/07/2020 20:11:46 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[State](
	[ID] [bigint] IDENTITY(1,1) NOT NULL,
	[Name] [nvarchar](50) NOT NULL,
 CONSTRAINT [PK_State] PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Table]    Script Date: 10/07/2020 20:11:46 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Table](
	[ID] [bigint] IDENTITY(1,1) NOT NULL,
	[ID_Restaurant] [bigint] NOT NULL,
	[QRCode] [nvarchar](500) NULL,
	[Numero] [int] NOT NULL,
 CONSTRAINT [PK_Table] PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
ALTER TABLE [dbo].[Categorias] ADD  CONSTRAINT [DF_Categorias_Active]  DEFAULT ((1)) FOR [Active]
GO
ALTER TABLE [dbo].[Checkin] ADD  CONSTRAINT [DF_Checkin_DateCreation]  DEFAULT (getdate()) FOR [DateCreation]
GO
ALTER TABLE [dbo].[Client] ADD  CONSTRAINT [DF_Client_DateCreation]  DEFAULT (getdate()) FOR [DateCreation]
GO
ALTER TABLE [dbo].[Client] ADD  CONSTRAINT [DF_Client_DateLastUpdate]  DEFAULT (getdate()) FOR [DateLastUpdate]
GO
ALTER TABLE [dbo].[ItemxPedido] ADD  CONSTRAINT [DF_ItemxPedido_DateCreation]  DEFAULT (getdate()) FOR [DateCreation]
GO
ALTER TABLE [dbo].[ItemxPedido] ADD  CONSTRAINT [DF_ItemxPedido_Compartir]  DEFAULT ((0)) FOR [Compartir]
GO
ALTER TABLE [dbo].[ItemxPedido] ADD  CONSTRAINT [DF_ItemxPedido_Cantidad]  DEFAULT ((1)) FOR [Cantidad]
GO
ALTER TABLE [dbo].[Pedido] ADD  CONSTRAINT [DF_Pedido_ID_Status]  DEFAULT ((1)) FOR [ID_Status]
GO
ALTER TABLE [dbo].[Pedido] ADD  CONSTRAINT [DF_Pedido_DateCreation]  DEFAULT (getdate()) FOR [DateCreation]
GO
ALTER TABLE [dbo].[Pedido] ADD  CONSTRAINT [DF_Pedido_DateLastUpdate]  DEFAULT (getdate()) FOR [DateLastUpdate]
GO
ALTER TABLE [dbo].[Restaurant] ADD  CONSTRAINT [DF_Restaurant_DateCreation]  DEFAULT (getdate()) FOR [DateCreation]
GO
ALTER TABLE [dbo].[Restaurant] ADD  CONSTRAINT [DF_Restaurant_DateLastUpdate]  DEFAULT (getdate()) FOR [DateLastUpdate]
GO
ALTER TABLE [dbo].[Restaurant] ADD  CONSTRAINT [DF_Restaurant_Deactivated]  DEFAULT ((0)) FOR [Deactivated]
GO
ALTER TABLE [dbo].[Restaurant] ADD  CONSTRAINT [DF_Restaurant_Suspended]  DEFAULT ((0)) FOR [Suspended]
GO
USE [master]
GO
ALTER DATABASE [EATIN] SET  READ_WRITE 
GO
