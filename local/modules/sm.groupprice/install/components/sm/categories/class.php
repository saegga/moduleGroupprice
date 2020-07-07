<?

use \Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;
use Bitrix\Main\Diag;

class Categories extends CBitrixComponent{

    public function onPrepareComponentParams($arParams)
    {

    }

    public function executeComponent()
    {
        $this->includeComponentLang('class.php');

        try{
            $this->checkModule();
            // todo main code

            $this->includeComponentTemplate();
        }catch (\Bitrix\Main\LoaderException $e) {
            Diag\Debug::dumpToFile($e, "e", "debug.txt");
        }
    }
    protected function checkModule(){
        if (!Loader::includeModule('sm.groupprice'))
        {
            throw new \Bitrix\Main\LoaderException(Loc::getMessage('SM_GROUPPRICE_NOINSTALL'));
        }
    }


}