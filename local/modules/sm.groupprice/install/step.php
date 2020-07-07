<?
use Bitrix\Main\Localization\Loc;
if(!check_bitrix_sessid()){
    return;
}
if($ex = $APPLICATION->GetException()){
    echo CAdminMessage::ShowMessage([
        'TYPE' => 'ERROR',
        'MESSAGE' => Loc::getMessage('MOD_INST_ERROR'),
        'DETAILS' => $ex->GetString(),
        'HTML' => true
    ]);
}else{
    echo CAdminMessage::ShowNote(Loc::getMessage('MOD_INST_OK'));
}

$cacheType = \Bitrix\Main\Config\Configuration::getInstance()->get('cache');
if(!$cacheType['type'] || $cacheType['type']=='none'){
    echo CAdminMessage::ShowMessage(array("MESSAGE" => Loc::getMessage("SM_GROUPPRICE_NO_CACHE"),"TYPE" => "ERROR"));
}
?>

<form action="<?=$APPLICATION->GetCurPage()?>">
    <input type="hidden" name="lang" value="<?=LANGUAGE_ID?>">
    <input type="submit" name="" value="<?=Loc::getMessage('MOD_BACK');?>">
</form>
