<?php
/**
 * @Created in JM Organization.
 * @Author: Magicmen
 * @Date: 17.08.2017
 * @Time: 13:16
 */

namespace Cilaster\Core;


class Constant {
    const MAIN_ROOT = __DIR__.'\..\..\..';

    const CONFIG_ROOT = self::MAIN_ROOT.'\configs';
    const INCLUDE_ROOT = self::MAIN_ROOT.'\includes';
    const THEMES_ROOT = self::MAIN_ROOT.'\themes';
    const MODULES_ROOT = self::MAIN_ROOT.'\modules';
    const LOCALES_ROOT = self::INCLUDE_ROOT.'\localization';

    const MANAGER = self::MAIN_ROOT.'\manager';
}