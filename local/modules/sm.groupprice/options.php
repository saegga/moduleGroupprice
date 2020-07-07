<?

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Config\Option;

$module_id = 'sm.groupprice';


Loc::loadMessages($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/options.php");
Loc::loadMessages(__FILE__);

\Bitrix\Main\Loader::includeModule($module_id);

$request = \Bitrix\Main\HttpApplication::getInstance()->getContext()->getRequest();

$aTabs = array(
            array(
                'DIV' => 'edit1',
                'TAB' => Loc::getMessage('SM_GROUPPRICE_MAIN_TAB_SET'),
                'TITLE' => Loc::getMessage('SM_GROUPPRICE_MAIN_TAB_SET'),
                'OPTIONS' => array(
                    array('field_text', 'test',
                        '',
                        array('textarea', 10, 50)),
                    array('field_line', 'test2',
                        '',
                        array('text', 10)),
                )
            ),
);

if ($request->isPost() && $request['Update'] && check_bitrix_sessid())
{

    foreach ($aTabs as $aTab)
    {
        //Или можно использовать __AdmSettingsSaveOptions($MODULE_ID, $arOptions);
        foreach ($aTab['OPTIONS'] as $arOption)
        {
            if (!is_array($arOption)) //Строка с подсветкой. Используется для разделения настроек в одной вкладке
                continue;

            if ($arOption['note']) //Уведомление с подсветкой
                continue;


            //Или __AdmSettingsSaveOption($MODULE_ID, $arOption);
            $optionName = $arOption[0];

            $optionValue = $request->getPost($optionName);

            Option::set($module_id, $optionName, is_array($optionValue) ? implode(",", $optionValue):$optionValue);
        }
    }
}


$tabControl = new CAdminTabControl('tabControl', $aTabs);

?>
<? $tabControl->Begin(); ?>
    <form method='post' action='<?echo $APPLICATION->GetCurPage()?>?mid=<?=htmlspecialcharsbx($request['mid'])?>&amp;lang=<?=$request['lang']?>' name='academy_d7_settings'>

        <? foreach ($aTabs as $aTab):
            if($aTab['OPTIONS']):?>
                <? $tabControl->BeginNextTab(); ?>
                <? __AdmSettingsDrawList($module_id, $aTab['OPTIONS']); ?>

            <?      endif;
        endforeach; ?>

        <?
        $tabControl->BeginNextTab();



        $tabControl->Buttons(); ?>

        <input type="submit" name="Update" value="<?echo GetMessage('MAIN_SAVE')?>">
        <input type="reset" name="reset" value="<?echo GetMessage('MAIN_RESET')?>">
        <?=bitrix_sessid_post();?>
    </form>
<? $tabControl->End(); ?>