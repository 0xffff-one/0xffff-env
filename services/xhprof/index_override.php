<?php

// flarum entry with xhprof profiler

/*
 * This file is part of Flarum.
 *
 * For detailed copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */

tideways_xhprof_enable(TIDEWAYS_XHPROF_FLAGS_MEMORY | TIDEWAYS_XHPROF_FLAGS_CPU);

$site = require '../site.php';

/*
|-------------------------------------------------------------------------------
| Accept incoming HTTP requests
|-------------------------------------------------------------------------------
|
| Every HTTP request pointed to the web server that cannot be served by simply
| responding with one of the files in the "public" directory will be sent to
| this file. Now is the time to boot up Flarum's internal HTTP server, which
| will try its best to interpret the request and return the appropriate
| response, which could be a JSON document (for API responses) or a lot of HTML.
|
*/

$server = new Flarum\Http\Server($site);
$server->listen();

$data = tideways_xhprof_disable();
$wt = 0;
foreach ($data as $d) {
    $wt += $d['wt'];
}

$profileName = str_replace('/', '_', explode('?', $_SERVER['REQUEST_URI'])[0]);
file_put_contents(
    "/tmp/" . time(). ".0.0.{$wt}.{$profileName}.xhprof",
    serialize($data)
);
