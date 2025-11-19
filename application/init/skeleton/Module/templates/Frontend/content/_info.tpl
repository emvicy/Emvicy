<div class="row padding20">
    <table class="col-md-12 small table table-hover table-borderless table-sm">
        {if 'true' === getenv('IS_DDEV_PROJECT')}

            <tr>
                <td width="200">
                    phpMyAdmin
                </td>
                <td>
                    <a href="{$sHost}:8037/" target="_blank">{$sHost}:8037/</a>
                </td>
            </tr>
            <tr>
                <td>
                    Mailpit
                </td>
                <td>
                    <a href="{$sHost}:8026/" target="_blank">{$sHost}:8026/</a>
                </td>
            </tr>
        {/if}
        <!---------------------------->
        <tr>
            <td>Demonstration</td>
            <td>
                An API Endpoint <a href="{href('api')}" target="_blank">{href('api')}</a>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                Downloading a file <a href="{href('download')}">{href('download')}</a>
            </td>
        </tr>
        <!---------------------------->
        <tr>
            <td width="200">module's Directory</td><td><code>{MVC\Config::get_MVC_MODULE_PRIMARY_DIR()}</code></td>
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
            <td>Device Pixel Ratio</td><td><div id="oDevicePixelRatio"></div></td>
        </tr>
        <tr>
            <td>
                Date/time
            </td>
            <td>
                creation: <kbd class="text-bg-light">{$smarty.now|dateformat:"Y-m-d H:i:s"}</kbd>
                <br>
                current: <code>{ldelim}nocache{rdelim}</code>: <kbd class="text-bg-light">{nocache}{$smarty.now|dateformat:"Y-m-d H:i:s"}{/nocache}</kbd>
            </td>
        </tr>
    </table>
</div>
<script>
    {literal}
    let remove = null;
    const oDevicePixelRatio = document.querySelector("#oDevicePixelRatio");
    const updatePixelRatio = () => {
        remove?.();
        const mqString = `(resolution: ${window.devicePixelRatio}dppx)`;
        const media = matchMedia(mqString);
        media.addEventListener("change", updatePixelRatio);
        remove = () => {media.removeEventListener("change", updatePixelRatio);};
        oDevicePixelRatio.textContent = `${window.devicePixelRatio} dppx`;
    };
    updatePixelRatio();
    {/literal}
</script>
