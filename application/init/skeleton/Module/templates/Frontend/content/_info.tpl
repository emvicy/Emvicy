
<div class="row padding20">
    <table class="col-md-12 small table table-hover table-borderless table-sm">
        <tr>
            <td>
                <a href="https://emvicy2x.ddev.site:8037/" target="_blank">https://emvicy2x.ddev.site:8037/</a>
            </td>
        </tr>
        <tr>
            <td>
                <a href="https://emvicy2x.ddev.site/api/" target="_blank">https://emvicy2x.ddev.site/api/</a>
            </td>
        </tr>
        <tr>
            <td>
                <a href="https://emvicy2x.ddev.site/download/">https://emvicy2x.ddev.site/download/</a>
            </td>
        </tr>
        <tr>
            <td>module's Directory</td><td><code>{MVC\Config::get_MVC_MODULE_PRIMARY_DIR()}</code></td>
        </tr>
        <tr>
            <td>Controller</td><td><code>{MVC\Route::getCurrent()->get_query()}</code></td>
        </tr>
        <tr>
            <td>stage config file</td><td><code>{MVC\Config::get_MVC_MODULE_PRIMARY_STAGING_CONFIG_DIR()}/{MVC\Config::get_MVC_ENV()}.php</code></td>
        </tr>
        <tr>
            <td>template file</td><td><code>{MVC\Config::get_MVC_VIEW_TEMPLATE_DIR()}/{$oDTRoutingAdditional->get_sTemplate()}</code></td>
        </tr>
        <tr>
            <td>smarty caching active</td><td><code>{MVC\Convert::boolToString(MVC\Config::get_MVC_MODULE_PRIMARY_VIEW()->caching)}</code></td>
        </tr>
        <tr>
            <td colspan="2">
                Date/time: <kbd class="text-bg-light">{$smarty.now|dateformat:"Y-m-d H:i:s"}</kbd>
                <br>
                Date/time: with <code>{ldelim}nocache{rdelim}</code>: <kbd class="text-bg-light">{nocache}{$smarty.now|dateformat:"Y-m-d H:i:s"}{/nocache}</kbd>
            </td>
        </tr>
    </table>
</div>
