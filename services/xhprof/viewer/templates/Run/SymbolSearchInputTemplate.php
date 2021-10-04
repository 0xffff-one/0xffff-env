<?php
/**
 * © 2016 SugarCRM Inc.  Licensed by SugarCRM under the Apache 2.0 license.
 */

namespace Sugarcrm\XHProf\Viewer\Templates\Run;


use Sugarcrm\XHProf\Viewer\Templates\Helpers\CurrentPageHelper as CurrentPage;

class SymbolSearchInputTemplate
{
    public static function render()
    {
        ?>
        <div class="input-group input-group-sm input-group-symbol">
            <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
            <table class="input-suggestions">
            </table>
            <input class="form-control input-group-sm" style="width:20vw;" name="search"
                   placeholder="Search Functions Here" autocomplete="off" type="text" list="symbols">

        </div>

        <?php if (CurrentPage::getParam('symbol')) { ?>
        <a class="btn btn-primary btn-sm" href="<?php echo CurrentPage::url(array('symbol' => '')) ?>">
            <span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span>
            View Top Level Run Report
        </a>
        <?php }
    }
}
