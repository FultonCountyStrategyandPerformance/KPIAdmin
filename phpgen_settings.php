<?php

//  define('SHOW_VARIABLES', 1);
//  define('DEBUG_LEVEL', 1);

//  error_reporting(E_ALL ^ E_NOTICE);
//  ini_set('display_errors', 'On');

set_include_path('.' . PATH_SEPARATOR . get_include_path());


include_once dirname(__FILE__) . '/' . 'components/utils/system_utils.php';

//  SystemUtils::DisableMagicQuotesRuntime();

SystemUtils::SetTimeZoneIfNeed('America/New_York');

function GetGlobalConnectionOptions()
{
    return array(
  'server' => '',
  'username' => '',
  'password' => '',
  'database' => ''
);
}

function HasAdminPage()
{
    return false;
}

function GetPageGroups()
{
    $result = array('Default');
    return $result;
}

function GetPageInfos()
{
    $result = array();
    $result[] = array('caption' => 'Dbo.PerformanceManagement ProgramKPIs', 'short_caption' => 'Dbo.PerformanceManagement ProgramKPIs', 'filename' => 'dbo.PerformanceManagement_ProgramKPIs.php', 'name' => 'dbo.PerformanceManagement_ProgramKPIs', 'group_name' => 'Default', 'add_separator' => false);
    $result[] = array('caption' => 'Dbo.PerformanceManagement ProgramValues', 'short_caption' => 'Dbo.PerformanceManagement ProgramValues', 'filename' => 'dbo.PerformanceManagement_ProgramValues.php', 'name' => 'dbo.PerformanceManagement_ProgramValues', 'group_name' => 'Default', 'add_separator' => false);
    $result[] = array('caption' => 'Dbo.PerformanceManagement ProgramValues Staging', 'short_caption' => 'Dbo.PerformanceManagement ProgramValues Staging', 'filename' => 'dbo.PerformanceManagement_ProgramValues_staging.php', 'name' => 'dbo.PerformanceManagement_ProgramValues_staging', 'group_name' => 'Default', 'add_separator' => false);
    $result[] = array('caption' => 'Dbo.PerformanceManagement StartDates', 'short_caption' => 'Dbo.PerformanceManagement StartDates', 'filename' => 'dbo.PerformanceManagement_StartDates.php', 'name' => 'dbo.PerformanceManagement_StartDates', 'group_name' => 'Default', 'add_separator' => false);
    $result[] = array('caption' => 'Dbo.PerformanceManagement Users', 'short_caption' => 'Dbo.PerformanceManagement Users', 'filename' => 'dbo.PerformanceManagement_Users.php', 'name' => 'dbo.PerformanceManagement_Users', 'group_name' => 'Default', 'add_separator' => false);
    $result[] = array('caption' => 'Dbo.PerformanceManagement ProgramTargets', 'short_caption' => 'Dbo.PerformanceManagement ProgramTargets', 'filename' => 'dbo.PerformanceManagement_ProgramTargets.php', 'name' => 'dbo.PerformanceManagement_ProgramTargets', 'group_name' => 'Default', 'add_separator' => false);
    return $result;
}

function GetPagesHeader()
{
    return
    '';
}

function GetPagesFooter()
{
    return
        '';
    }

function ApplyCommonPageSettings(Page $page, Grid $grid)
{
    $page->SetShowUserAuthBar(false);
    $page->OnCustomHTMLHeader->AddListener('Global_CustomHTMLHeaderHandler');
    $page->OnGetCustomTemplate->AddListener('Global_GetCustomTemplateHandler');
    $grid->BeforeUpdateRecord->AddListener('Global_BeforeUpdateHandler');
    $grid->BeforeDeleteRecord->AddListener('Global_BeforeDeleteHandler');
    $grid->BeforeInsertRecord->AddListener('Global_BeforeInsertHandler');
}

/*
  Default code page: 1252
*/
function GetAnsiEncoding() { return 'windows-1252'; }

function Global_CustomHTMLHeaderHandler($page, &$customHtmlHeaderText)
{

}

function Global_GetCustomTemplateHandler($part, $mode, &$result, &$params, Page $page = null)
{

}

function Global_BeforeUpdateHandler($page, &$rowData, &$cancel, &$message, $tableName)
{

}

function Global_BeforeDeleteHandler($page, &$rowData, &$cancel, &$message, $tableName)
{

}

function Global_BeforeInsertHandler($page, &$rowData, &$cancel, &$message, $tableName)
{

}

function GetDefaultDateFormat()
{
    return 'Y-m-d';
}

function GetFirstDayOfWeek()
{
    return 0;
}

function GetEnableLessFilesRunTimeCompilation()
{
    return false;
}



?>
