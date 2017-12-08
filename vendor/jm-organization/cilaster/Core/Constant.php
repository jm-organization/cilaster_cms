<?php
/**
 * @Created in JM Organization.
 * @Author: Magicmen
 * @Date: 17.08.2017
 * @Time: 13:16
 */

namespace Cilaster\Core;


class Constant {
    const MAIN_ROOT = __DIR__ . '\..\..\cilaster_cms';

    const CONFIG_ROOT = self::MAIN_ROOT.'\config';
    const INCLUDE_ROOT = self::MAIN_ROOT.'\includes';
    const THEMES_ROOT = self::MAIN_ROOT.'\themes';
    const MODULES_ROOT = self::MAIN_ROOT.'\modules';
    const LOCALES_ROOT = self::MAIN_ROOT.'\i18n';

    const VCS = self::MAIN_ROOT.'\vcs';
}