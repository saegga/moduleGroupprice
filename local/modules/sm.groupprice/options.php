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
        array(
            'DIV' => 'edit1',
            'TAB' => Loc::getMessage('SM_GROUPPRICE_MAIN_TAB_SET'),
            'OPTIONS' => array(
                array('field_text', Loc::getMessage('test1'),
                    '',
                    array('textarea', 10, 50)),
                array('field_line', Loc::getMessage('test2'),
                    '',
                    array('text', 10)),
            )
        ),
    )
);