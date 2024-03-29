<?
global $MESS;
IncludeModuleLangFile(__FILE__);

Class red_favorite extends CModule
{
    var $MODULE_ID = "red.favorite";
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME;
	var $MODULE_DESCRIPTION;
	var $MODULE_CSS;
	var $MODULE_GROUP_RIGHTS = "Y";

	function red_favorite()
	{
		$arModuleVersion = array();

		$path = str_replace("\\", "/", __FILE__);
		$path = substr($path, 0, strlen($path) - strlen("/index.php"));
		include($path."/version.php");

        if (is_array($arModuleVersion) && array_key_exists("VERSION", $arModuleVersion)) {
            $this->MODULE_VERSION = $arModuleVersion["VERSION"];
            $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        } else {
            $this->MODULE_VERSION = "1.0.0";
            $this->MODULE_VERSION_DATE = "2014.01.01";
        }

		$this->MODULE_NAME = GetMessage("RS.FAVORITE.INSTALL_NAME");
		$this->MODULE_DESCRIPTION = GetMessage("RS.FAVORITE.INSTALL_DESCRIPTION");
		$this->PARTNER_NAME = GetMessage("RS.FAVORITE.INSTALL_COPMPANY_NAME");
        $this->PARTNER_URI  = "http://asdaff.ru/";
	}

	// Install functions
	function InstallDB()
	{
		global $DB, $DBType, $APPLICATION;
		RegisterModule("red.favorite");
		$DB->RunSQLBatch($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/red.favorite/install/db/".$DBType."/install.sql");
		return TRUE;
	}

	function InstallEvents()
	{
		return TRUE;
	}

	function InstallOptions()
	{
		return TRUE;
	}

	function InstallFiles()
	{
		CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/red.favorite/install/components", $_SERVER["DOCUMENT_ROOT"]."/bitrix/components", true, true);
		return TRUE;
	}

	function InstallPublic()
	{
		return TRUE;
	}

	// UnInstal functions
	function UnInstallDB()
	{
		global $DB, $DBType, $APPLICATION;
		$DB->RunSQLBatch($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/red.favorite/install/db/".$DBType."/uninstall.sql");
		UnRegisterModule("red.favorite");
		return TRUE;
	}

	function UnInstallEvents()
	{
		return TRUE;
	}

	function UnInstallOptions()
	{
		return TRUE;
	}

	function UnInstallFiles()
	{
		return TRUE;
	}

	function UnInstallPublic()
	{
		return TRUE;
	}

    function DoInstall()
    {
		global $APPLICATION, $step;
		$keyGoodDB = $this->InstallDB();
		$keyGoodEvents = $this->InstallEvents();
		$keyGoodOptions = $this->InstallOptions();
		$keyGoodFiles = $this->InstallFiles();
		$keyGoodPublic = $this->InstallPublic();
		$APPLICATION->IncludeAdminFile(GetMessage("SPER_INSTALL_TITLE"), $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/red.favorite/install/install.php");
    }

    function DoUninstall()
    {
		global $APPLICATION, $step;
		$keyGoodFiles = $this->UnInstallFiles();
		$keyGoodEvents = $this->UnInstallEvents();
		$keyGoodOptions = $this->UnInstallOptions();
		$keyGoodDB = $this->UnInstallDB();
		$keyGoodPublic = $this->UnInstallPublic();
		$APPLICATION->IncludeAdminFile(GetMessage("SPER_UNINSTALL_TITLE"), $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/red.favorite/install/uninstall.php");
    }
}
