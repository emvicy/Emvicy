<!doctype html>{* @see https://getbootstrap.com/docs/5.3/getting-started/introduction/ *}
<!--410.tpl-->
<html lang="en">
    <head>
        {include file="Frontend/layout/_head.tpl"}
    </head>
    <body>

        <!------------------------------------------------------------------------------------------------------------->
        {include file="Frontend/layout/menu.tpl"}
        <!------------------------------------------------------------------------------------------------------------->

        {* @see https://getbootstrap.com/docs/5.3/examples/cheatsheet/ *}
        <div class="container py-4 shadow bg-white padding20">
            <div class="text-center">
                <h1 id="h1Title" class="text-danger">410 - Gone</h1>
                <p>
                    the source you requested does not exist anymore
                </p>
                {include file="Frontend/parts/see_documentation.tpl"}
            </div>
            <br>
            {include file="Frontend/content/_info.tpl"}
        </div>

        <!------------------------------------------------------------------------------------------------------------->
        {include file="Frontend/layout/footer.tpl"}
        {include file="Frontend/content/_noscript.tpl"}
        {include file="Frontend/content/_cookieConsent.tpl"}
        <!------------------------------------------------------------------------------------------------------------->

        <!------------------------------------------------------------------------------------------------------------->
        {include file="Frontend/layout/_script.tpl"}
        <!------------------------------------------------------------------------------------------------------------->
    </body>
</html>